<?php

    class City{
        
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
                    *
                from 
                    city_link
                left join 
                    city_translation 
                on
                    city_link.city_link_ID = city_translation.city_link_ID
                where
                    langCode = "'.$this->langList['portuguese'].'"
            ');
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return $output;
        }
        /* fetchCity had to be fetched as an assoc array, so it could be arranged based on language */
        public function fetchCity(int $cityID){
            $sqlFetchCity = '
                select
                    *
                from
                    city_link
                left join
                    city_translation
                on
                    city_link.city_link_ID = city_translation.city_link_ID
                where
                    city_link.city_link_ID = "'.$cityID.'"
            ';
            $queryResult = $this->db->query($sqlFetchCity);
            while($r=$queryResult->fetch_assoc()){
                switch($r['langCode']){
                    case $this->langList['portuguese']: $output[$this->langList['portuguese']] = $r;
                        break;
                    case $this->langList['english']: $output[$this->langList['english']] = $r;
                        break;
                }
            }
            return $output;
        }
        public function fetchAllCityPhotos(int $cityID){
            $sqlFetchPhotos = '
                select 
                    *
                from
                    city_gallery
                where 
                    city_link_ID = "'.$cityID.'"
            ';
            $queryResult = $this->db->query($sqlFetchPhotos);
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return ((empty($output)) ? '': $output);
        }
        public function insertCity(array $inputArray){
            $cityData = $this->sanitizeInput($inputArray);
            
            $sqlCheckExists = ' 
                select 
                    city_translation_ID 
                from 
                    city_translation 
                where 
                    nameTranslated = "'.$cityData['cityName-'.strtoupper($this->langList['portuguese'])].'" and langCode = "'.$this->langList['portuguese'].'"
            ';
            /* or
                (nameTranslated = "'.$cityData['cityName-EN'].'" and langCode = "en") */
            $queryCheckExists = $this->db->query($sqlCheckExists);
            if($queryCheckExists->num_rows > 0){
                return false;
            }
            $sqlInsert = '
                insert into city_link 
                    (videoURL, postalCode, isPopular)
                values(
                    "'.((empty($cityData['cityVideoURL']) == true) ? '': $cityData['cityVideoURL']).'",
                    "'.$cityData['cityPostalCode'].'",
                    "'.$cityData['cityIsPopular'].'"
                )
            '; 
            $queryInsert = $this->db->query($sqlInsert);
            if($queryInsert){
                $lastInsertedID = $this->db->insert_id;
                $sqlInsertTranslation = '
                    insert into city_translation
                        (city_link_ID, langCode, nameTranslated, descriptionTranslated)
                    values
                        ( 
                            "'.$lastInsertedID.'",
                            "'.$this->langList['portuguese'].'",
                            "'.$cityData['cityName-'.strtoupper($this->langList['portuguese'])].'",
                            "'.$cityData['cityDesc-'.strtoupper($this->langList['portuguese'])].'"
                        ),
                        (
                            "'.$lastInsertedID.'",
                            "'.$this->langList['english'].'",
                            "'.$cityData['cityName-'.strtoupper($this->langList['english'])].'",
                            "'.$cityData['cityDesc-'.strtoupper($this->langList['english'])].'" 
                        )
                ';
                $queryInsertTranslation = $this->db->query($sqlInsertTranslation);
                if($queryInsertTranslation){
                    $arrayToReturn = [
                        $lastInsertedID,
                        $cityData['cityName-'.strtoupper($this->langList['portuguese'])],
                        $cityData['cityDesc-'.strtoupper($this->langList['portuguese'])],
                        (($cityData['cityIsPopular'] == 0) ? 'Não':'Sim'),
                        'Agora',
                        '<button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$this->db->insert_id.'" data-toggle="collapse">
                            <i class="lnr lnr-plus-circle"></i>
                        </button>',
                        '<a href="?edit=city&id='.$this->db->insert_id.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                        <button class="btn btn-danger btn-xs pull-right" id="delete-city"><span class="lnr lnr-trash"></span></button>'
                    ];
                    return $arrayToReturn;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function deleteCity(int $cityID){
            $sqlDelete = 'delete from city_link where city_link_ID = '.$cityID;
            $queryDelete = $this->db->query($sqlDelete);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateCityName(int $cityID, array $cityNames){
            $langSortedCityName = array();
            $errorCather = 0;
            $langCounter = 0;
            foreach($cityNames as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedCityName[strtolower($holder[$langCounter][1])][] = $value[0];
                $langCounter++;
            }
            foreach($langSortedCityName as $lang => $name){
                $sqlUpdateCity = '
                update 
                    city_translation 
                set 
                    nameTranslated = "'.mysqli_real_escape_string($this->db, $name[0]).'"
                where 
                    langCode = "'.$lang.'"
                and
                    city_link_ID = '.$cityID;
                $queryUpdateName = $this->db->query($sqlUpdateCity);
                if($this->db->error)
                    $errorCather += 0;
                else
                    $errorCather += 1;
                
            }
            if($errorCather == 0)
                return true;
            else
                return false;
        }
        public function updateCityDesc(int $cityID, array $cityDesc){
            $langSortedCityDesc = array();
            $errorCather = 0;
            $langCounter = 0;
            foreach($cityDesc as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedCityDesc[strtolower($holder[$langCounter][1])][] = $value;
                $langCounter++;
            }
            foreach($langSortedCityDesc as $lang => $desc){
                $sqlUpdateCity = '
                update 
                    city_translation 
                set 
                    descriptionTranslated = "'.mysqli_real_escape_string($this->db, $desc[0]).'"
                where 
                    langCode = "'.$lang.'"
                and
                    city_link_ID = '.$cityID;
                $queryUpdateDesc = $this->db->query($sqlUpdateCity);
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
        public function updateCityOther(int $cityID, int $postalCode, $videoURL, string $isPopular){
            $sqlUpdateCity = '
                update
                    city_link
                set
                    videoURL = "'.mysqli_real_escape_string($this->db, $videoURL).'",
                    postalCode = "'.mysqli_real_escape_string($this->db, $postalCode).'",
                    isPopular = "'.(($isPopular == 'checked') ? 1:0).'"
                where
                    city_link_ID = "'.$cityID.'"
            ';
            $queryUpdateCity = $this->db->query($sqlUpdateCity);
            if($this->db->error)
                return false;
            else    
                return true;
        }
        public function addCityPhoto(int $cityID, string $thumbnailURL, string  $fullsizeURL){
            $sqlInsertPhoto = '
                insert into
                    city_gallery(
                        city_link_ID,
                        thumbnailURL,
                        fullsizeURL
                    )
                    values(
                        "'.mysqli_real_escape_string($this->db, $cityID).'",
                        "'.mysqli_real_escape_string($this->db, $thumbnailURL).'",
                        "'.mysqli_real_escape_string($this->db, $fullsizeURL).'"
                    )
            ';
           $queryInsertPhoto = $this->db->query($sqlInsertPhoto);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function deleteCityPhoto(string $photoID){
            $cityPhotoID = explode('-', $photoID);
            $sqlSearchURL = '
                select 
                    fullsizeURL,
                    thumbnailURL
                from
                    city_gallery
                where 
                    city_link_ID = "'.$cityPhotoID[0].'"
                    and
                    city_gallery_ID = "'.$cityPhotoID[1].'"
            ';
            if($queryDeletePhoto = $this->db->query($sqlSearchURL)){
                $urlHolder = $queryDeletePhoto->fetch_object();
                $sqlDeletePhoto = '
                    delete from
                        city_gallery
                    where   
                        city_link_ID = "'.$cityPhotoID[0].'"
                        and
                        city_gallery_ID = "'.$cityPhotoID[1].'"';
                
                $queryDeletePhoto = $this->db->query($sqlDeletePhoto);
                if($queryDeletePhoto){
                    return $urlHolder;
                }else {
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
        public function showEditPage(string $contentCategory, int $contentID, bool $cityExists){
            if($contentCategory === "city" && is_int($contentID)){
                $x = 1;
            }else{ 
                $x = 0;
            }
            if($cityExists == false){
                $y = 1;
            }else{ 
                $y = 0;
            }
            /* if 1 then all ok, if 0 then one of the conditions has failed */
            return $x*$y;
        }
    }
?>