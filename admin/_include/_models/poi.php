<?php

    class Poi{
        
        private $db;
        private $langList = [
                'portuguese' => 'pt', 
                'english' => 'en',
                'italian' => 'it',
                'french' => 'fr', 
                'neutral'=> 'na'
        ];

        function __construct($conn){
            $this->db = $conn;
        }
        public function closeConnection($conn){
            mysqli_close($conn);
        }

        /* DATABASE FUNCTIONS */
        public function fetchAll(){
            $queryResult = $this->db->query('
                select 
                    city_translation.nameTranslated as cityNameTranslated,
                    poi_link.poi_link_ID,
                    poi_translation.nameTranslated,
                    poi_translation.descriptionTranslated,
                    poi_link.isPopular,
                    poi_link.dateCreated
                from 
                    city_poi_link
                left join 
                    city_link 
                on
                    city_poi_link.city_link_ID = city_link.city_link_ID
                left JOIN
                    city_translation
                ON
                    city_link.city_link_ID = city_translation.city_link_ID
                left join 
                    poi_link
                ON	
                    city_poi_link.poi_link_ID = poi_link.poi_link_ID
                LEFT JOIN
                    poi_translation
                ON
                    poi_link.poi_link_ID = poi_translation.poi_link_ID
                where
                    poi_translation.langCode = "'.$this->langList['portuguese'].'"
                AND
                    city_translation.langCode = "'.$this->langList['portuguese'].'"
            ');
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return ((empty($output)) ? '': $output);
        }
        /* fetchpoi had to be fetched as an assoc array, so it could be arranged based on language */
        public function fetchPoi(int $poiID){
            $sqlFetch2 = '
                select 
                    city_poi_link.isAlgarve,
                    city_poi_link.city_poi_link_ID,
                    city_link.city_link_ID,
                    poi_link.poi_link_ID,
                    poi_translation.nameTranslated,
                    poi_translation.descriptionTranslated,
                    poi_link.isPopular,
                    poi_translation.langCode
                from 
                    city_poi_link
                left join 
                    city_link 
                on
                    city_poi_link.city_link_ID = city_link.city_link_ID
                left JOIN
                    city_translation
                ON
                    city_link.city_link_ID = city_translation.city_link_ID
                left join 
                    poi_link
                ON	
                    city_poi_link.poi_link_ID = poi_link.poi_link_ID
                LEFT JOIN
                    poi_translation
                ON
                    poi_link.poi_link_ID = poi_translation.poi_link_ID
                WHERE
                    poi_link.poi_link_ID = "'.$poiID.'"
                GROUP BY
                    poi_translation.langCode
            ';
            
            $sqlFetch = '
                select
                    *
                from
                    poi_link
                left join
                    poi_translation
                on
                    poi_link.poi_link_ID = poi_translation.poi_link_ID
                where
                    poi_link.poi_link_ID = "'.$poiID.'"
            ';
            $queryResult = $this->db->query($sqlFetch2);
            while($r=$queryResult->fetch_assoc()){
                switch($r['langCode']){
                    case $this->langList['portuguese']: $output[$this->langList['portuguese']] = $r;
                        break;
                    case $this->langList['english']: $output[$this->langList['english']] = $r;
                        break;
                }
            }
            return ((empty($output)) ? '': $output);
        }
        public function fetchAllPoiPhotos(int $poiID){
            $sqlFetch = '
                select 
                    *
                from
                    poi_gallery
                where 
                    poi_link_ID = "'.$poiID.'"
            ';
            $queryResult = $this->db->query($sqlFetch);
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return ((empty($output)) ? '': $output);
        }
        public function insertPoi(array $inputArray){
            $poiData = $this->sanitizeInput($inputArray);
            $sqlCheckExists = ' 
                select 
                    poi_translation_ID 
                from 
                    poi_translation 
                where 
                    nameTranslated = "'.$poiData['poiName-'.strtoupper($this->langList['portuguese'])].'" and langCode = "'.$this->langList['portuguese'].'"
            ';
            /* or
                (nameTranslated = "'.$poiData['poiName-EN'].'" and langCode = "en") */
            $queryCheckExists = $this->db->query($sqlCheckExists);
            if($queryCheckExists->num_rows > 0){
                return false;
            }
            $sqlInsert = '
                insert into 
                    poi_link(
                        videoURL, 
                        isPopular
                    )
                values(
                    "'.((empty($poiData['poiVideoURL']) == true) ? '': $poiData['poiVideoURL']).'",
                    "'.$poiData['poiIsPopular'].'"
                )
            '; 
            $queryInsert = $this->db->query($sqlInsert);
            if($queryInsert){
                $lastInsertedID = $this->db->insert_id;
                $sqlInsertTranslation = '
                    insert into poi_translation
                        (poi_link_ID, langCode, nameTranslated, descriptionTranslated)
                    values
                        ( 
                            "'.$lastInsertedID.'",
                            "'.$this->langList['portuguese'].'",
                            "'.$poiData['poiName-'.strtoupper($this->langList['portuguese'])].'",
                            "'.$poiData['poiDesc-'.strtoupper($this->langList['portuguese'])].'"
                        ),
                        (
                            "'.$lastInsertedID.'",
                            "'.$this->langList['english'].'",
                            "'.$poiData['poiName-'.strtoupper($this->langList['english'])].'",
                            "'.$poiData['poiDesc-'.strtoupper($this->langList['english'])].'" 
                        )
                ';
                $queryInsertTranslation = $this->db->query($sqlInsertTranslation);
                if($queryInsertTranslation){
                    $sqlCreateCityPoiLink = '
                        insert into 
                            city_poi_link(
                                city_link_ID,
                                poi_link_ID,
                                isAlgarve
                            )
                        values(
                            "'.$poiData['poiCityName'].'",
                            "'.$lastInsertedID.'",
                            "1"
                        )

                    ';
                    $queryCreateCityPoiLink = $this->db->query($sqlCreateCityPoiLink);
                    if($queryCreateCityPoiLink){
                        $sqlCityName = '
                            select 
                                nameTranslated
                            from    
                                city_translation
                            where
                                city_link_ID = "'.$poiData['poiCityName'].'"
                            and
                                langCode = "'.$this->langList['portuguese'].'"
                        ';
                        $queryCityName = $this->db->query($sqlCityName);
                        if($queryCityName->num_rows == 1){
                            $fetchCityName = $queryCityName->fetch_object();
                            $arrayToReturn = [
                                $lastInsertedID,
                                $fetchCityName->nameTranslated,
                                $poiData['poiName-'.strtoupper($this->langList['portuguese'])],
                                $poiData['poiDesc-'.strtoupper($this->langList['portuguese'])],
                                (($poiData['poiIsPopular'] == 0) ? 'Não':'Sim'),
                                'Agora',
                                '<button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$this->db->insert_id.'" data-toggle="collapse">
                                    <i class="lnr lnr-plus-circle"></i>
                                </button>',
                                '<a href="?edit=poi&id='.$this->db->insert_id.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                                <button class="btn btn-danger btn-xs pull-right" id="delete-poi"><span class="lnr lnr-trash"></span></button>'
                            ];
                            return $arrayToReturn;
                        }else{
                            return false;
                        }
                    }else{
                        return $this->db->error;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function deletePoi(int $poiID, string $basePath){
            $sqlGetURL = '
            select 
                poi_gallery_ID
            from
                poi_gallery
            where
                poi_link_ID = '.$poiID.'
            ';

            $queryGetURL = $this->db->query($sqlGetURL);

            if($this->db->error)
                return $this->db->error;
            
            while($r=$queryGetURL->fetch_object()){
                $t = $this->deletePhoto($poiID.'-'.$r->poi_gallery_ID, $basePath, true);
                if($t !== true)
                    return $t;
            }

            if(file_exists($basePath.$poiID)){
                if(file_exists($basePath.$poiID.'/fullsize'))
                    rmdir($basePath.$poiID.'/fullsize');
                
                if(file_exists($basePath.$poiID.'/thumbnail'))
                    rmdir($basePath.$poiID.'/thumbnail');

                if(!rmdir($basePath.$poiID))
                    return false;
            }

            $sqlDelete = '
                delete from 
                    poi_link 
                where 
                    poi_link_ID = '.$poiID;
            $queryDelete = $this->db->query($sqlDelete);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updatePoiName(int $poiID, array $poiNames){
            $langSortedpoiName = array();
            $errorCather = 0;
            $langCounter = 0;
            foreach($poiNames as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedpoiName[strtolower($holder[$langCounter][1])][] = $value[0];
                $langCounter++;
            }
            foreach($langSortedpoiName as $lang => $name){
                $sqlUpdatepoi = '
                    update 
                        poi_translation 
                    set 
                        nameTranslated = "'.mysqli_real_escape_string($this->db, $name[0]).'"
                    where 
                        langCode = "'.$lang.'"
                    and
                        poi_link_ID = '.$poiID;
                $queryUpdateDes = $this->db->query($sqlUpdatepoi);
                if($this->db->error)
                    $errorCather += 1;
                else
                    $errorCather += 0;
                
            }
            if($errorCather == 0)
                return true;
            else
                return false;
        }
        public function updatePoiDesc(int $poiID, array $poiDescs){
            $langSortedpoiDesc = array();
            $errorCather = 0;
            $langCounter = 0;
            foreach($poiDescs as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedpoiDesc[strtolower($holder[$langCounter][1])][] = $value;
                $langCounter++;
            }
            foreach($langSortedpoiDesc as $lang => $desc){
                $sqlUpdatepoi = '
                    update 
                        poi_translation 
                    set 
                        descriptionTranslated = "'.mysqli_real_escape_string($this->db, $desc[0]).'"
                    where 
                        langCode = "'.$lang.'"
                        and
                        poi_link_ID = '.$poiID;
                $queryUpdateAdmin = $this->db->query($sqlUpdatepoi);
                if($this->db->error)
                    $errorCather += 1;
                else
                    $errorCather += 0;
                
            }
            if($errorCather == 0)
                return true;
            else
                return false;
        }
        public function updatePoiOther(int $poiID, string $isPopular, string $isAlgarve, int $cityID, int $cityPoiLinkID){
            $errorCather = [];
            $sqlUpdateIsAlgarve = '
                update
                    city_poi_link
                set
                    isAlgarve = "'.(($isAlgarve == 'checked') ? 1:0).'"
                where
                    city_poi_link_ID = "'.$cityPoiLinkID.'"
            ';
            $queryUpdate = $this->db->query($sqlUpdateIsAlgarve);
            if($this->db->error)
                $errorCather[] = $this->db->error;

            $sqlUpdateCity = '
                update
                    city_poi_link
                set 
                    city_link_ID = "'.$cityID.'"
                where
                    city_poi_link_ID = "'.$cityPoiLinkID.'"
            ';
            $queryUpdateCity = $this->db->query($sqlUpdateCity);
            if($this->db->error)
                $errorCather[] = $this->db->error;

            $sqlUpdateIsPopular = '
                update 
                    poi_link
                set 
                    isPopular = "'.(($isPopular == 'checked') ? 1:0).'"
            ';
            $queryUpdateIsPopular = $this->db->query($sqlUpdateIsPopular);
            if($this->db->error)
                $errorCather[] = $this->db->error;

            /* if($errorCather == 0 || $errorCather == '0')
                return true;
            else  */
                return $errorCather;
            
        }
        public function addPoiPhoto(int $poiID, string $thumbnailURL, string  $fullsizeURL){
            $sqlInsert = '
                insert into
                    poi_gallery(
                        poi_link_ID,
                        thumbnailURL,
                        fullsizeURL
                    )
                    values(
                        "'.mysqli_real_escape_string($this->db, $poiID).'",
                        "'.mysqli_real_escape_string($this->db, $thumbnailURL).'",
                        "'.mysqli_real_escape_string($this->db, $fullsizeURL).'"
                    )
            ';
            $queryInsert = $this->db->query($sqlInsert);
            if($this->db->error)
                return $this->db->error;
            else
                return true;
        }
        public function deletePhoto(string $photoID, string $basePath, int $deleteAll = null){
            $photoID = explode('-', $photoID);
            $sqlSearchURL = '
                select 
                    fullsizeURL,
                    thumbnailURL
                from
                    poi_gallery
                where 
                    poi_link_ID = "'.$photoID[0].'"
                and
                    poi_gallery_ID = "'.$photoID[1].'"
            ';
            if($queryDelete = $this->db->query($sqlSearchURL)){
                $urlHolder = $queryDelete->fetch_object();
                $sqlDeletePhoto = '
                    delete from
                        poi_gallery
                    where   
                        poi_link_ID = "'.$photoID[0].'"
                    and
                        poi_gallery_ID = "'.$photoID[1].'"';
                
                $queryDelete = $this->db->query($sqlDeletePhoto);
                if($deleteAll)
                    $basePath = $basePath.'/'.$photoID[0].'/';
                if($queryDelete){
                    if(unlink($basePath.'fullsize/'.$urlHolder->fullsizeURL) && unlink($basePath.'thumbnail/'.$urlHolder->thumbnailURL))
                        return true;
                    else 
                        return false;
                }else{
                    return false;
                }
            }
        }

        /* CONTROL CUSTOM FUNCTIONS */
        private function sanitizeInput(array $inputArray){
            $counter = 0;
            $filteredInput = [];
            foreach ($inputArray as $key => $value) {
                $filteredInput[$key] = mysqli_real_escape_string($this->db, $value);
            }
            return $filteredInput;
        }

        /* Checks if requirments are met to edit the administrator */
        public function showEditPage(string $contentCategory, int $contentID, bool $poiExists){
            if($contentCategory === "poi" && is_int($contentID)){
                $x = 1;
            }else{ 
                $x = 0;
            }
            if($poiExists == false){
                $y = 1;
            }else{ 
                $y = 0;
            }
            /* if 1 then all ok, if 0 then one of the conditions has failed */
            return $x*$y;
        }
    }
?>