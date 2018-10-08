<?php

    class Activity{
        
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
                    activity_link.activity_link_ID,
                    activity_link.dateCreated,
                    activity_translation.nameTranslated,
                    activity_translation.descriptionTranslated
                from 
                    activity_link
                left join 
                    city_link 
                on
                    activity_link.city_link_ID = city_link.city_link_ID
                left JOIN
                    city_translation
                ON
                    city_link.city_link_ID = city_translation.city_link_ID
                LEFT JOIN
                    activity_translation
                ON
                    activity_link.activity_link_ID = activity_translation.activity_link_ID
                where
                    activity_translation.langCode = "'.$this->langList['portuguese'].'"
                AND
                    city_translation.langCode = "'.$this->langList['portuguese'].'"
            ');
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return ((empty($output)) ? '': $output);
        }
        /* fetchactivity had to be fetched as an assoc array, so it could be arranged based on language */
        public function fetchActivity(int $activityID){
            $sqlFetch2 = '
                select 
                    city_translation.nameTranslated as cityNameTranslated,
                    activity_link.activity_link_ID,
                    activity_link.city_link_ID,
                    activity_link.dateCreated,
                    activity_translation.langCode,
                    activity_translation.nameTranslated,
                    activity_translation.descriptionTranslated
                from 
                    activity_link
                left join 
                    city_link 
                on
                    activity_link.city_link_ID = city_link.city_link_ID
                left JOIN
                    city_translation
                ON
                    city_link.city_link_ID = city_translation.city_link_ID
                LEFT JOIN
                    activity_translation
                ON
                    activity_link.activity_link_ID = activity_translation.activity_link_ID
                where
                    activity_link.activity_link_ID = "'.$activityID.'"
                GROUP BY
                    activity_translation.langCode
            ';
            
            $sqlFetch = '
                select
                    *
                from
                    activity_link
                left join
                    activity_translation
                on
                    activity_link.activity_link_ID = activity_translation.activity_link_ID
                where
                    activity_link.activity_link_ID = "'.$activityID.'"
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
        public function fetchAllActivityPhotos(int $activityID){
            $sqlFetch = '
                select 
                    *
                from
                    activity_gallery
                where 
                    activity_link_ID = "'.$activityID.'"
            ';
            $queryResult = $this->db->query($sqlFetch);
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return ((empty($output)) ? '': $output);
        }
        public function insertActivity(array $inputArray){
            $activityData = $this->sanitizeInput($inputArray);
            $sqlCheckExists = ' 
                select 
                    activity_translation_ID 
                from 
                    activity_translation 
                where 
                    nameTranslated like "'.$activityData['activityName-'.strtoupper($this->langList['portuguese'])].'" and langCode = "'.$this->langList['portuguese'].'"
            ';
            /* or
                (nameTranslated = "'.$activityData['activityName-EN'].'" and langCode = "en") */
            $queryCheckExists = $this->db->query($sqlCheckExists);
            if($queryCheckExists->num_rows > 0){
                return false;
            }
            $sqlInsert = '
                insert into 
                    activity_link(
                        city_link_ID
                    )
                values(
                    "'.(int)$activityData['activityCityName'].'"
                )
            '; 
            $queryInsert = $this->db->query($sqlInsert);
            if($queryInsert){
                $lastInsertedID = $this->db->insert_id;
                $sqlInsertTranslation = '
                    insert into activity_translation
                        (activity_link_ID, langCode, nameTranslated, descriptionTranslated)
                    values
                        ( 
                            "'.$lastInsertedID.'",
                            "'.$this->langList['portuguese'].'",
                            "'.$activityData['activityName-'.strtoupper($this->langList['portuguese'])].'",
                            "'.$activityData['activityDesc-'.strtoupper($this->langList['portuguese'])].'"
                        ),
                        (
                            "'.$lastInsertedID.'",
                            "'.$this->langList['english'].'",
                            "'.$activityData['activityName-'.strtoupper($this->langList['english'])].'",
                            "'.$activityData['activityDesc-'.strtoupper($this->langList['english'])].'" 
                        )
                ';
                $queryInsertTranslation = $this->db->query($sqlInsertTranslation);
                if($queryInsertTranslation){
                    $sqlCityName = '
                        select 
                            nameTranslated
                        from    
                            city_translation
                        where
                            city_link_ID = "'.$activityData['activityCityName'].'"
                        and
                            langCode = "'.$this->langList['portuguese'].'"
                    ';
                    $queryCityName = $this->db->query($sqlCityName);
                    if($queryCityName->num_rows == 1){
                        $fetchCityName = $queryCityName->fetch_object();
                        $arrayToReturn = [
                            $lastInsertedID,
                            $fetchCityName->nameTranslated,
                            $activityData['activityName-'.strtoupper($this->langList['portuguese'])],
                            $activityData['activityDesc-'.strtoupper($this->langList['portuguese'])],
                            'Agora',
                            '<button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$this->db->insert_id.'" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>',
                            '<a href="?edit=activity&id='.$this->db->insert_id.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right" id="delete-activity"><span class="lnr lnr-trash"></span></button>'
                        ];
                        return $arrayToReturn;
                    }else{
                        false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function deleteActivity(int $activityID, string $basePath){
            $sqlGetURL = '
            select 
                activity_gallery_ID
            from
                activity_gallery
            where
                activity_link_ID = '.$activityID.'
            ';

            $queryGetURL = $this->db->query($sqlGetURL);

            if($this->db->error)
                return $this->db->error;
            
            while($r=$queryGetURL->fetch_object()){
                $t = $this->deletePhoto($activityID.'-'.$r->activity_gallery_ID, $basePath, true);
                if($t !== true)
                    return $t;
            }
            
            if(file_exists($basePath.$activityID)){
                if(file_exists($basePath.$activityID.'/fullsize'))
                    rmdir($basePath.$activityID.'/fullsize');
                
                if(file_exists($basePath.$activityID.'/thumbnail'))
                    rmdir($basePath.$activityID.'/thumbnail');

                if(!rmdir($basePath.$activityID))
                    return false;
            }

            $sqlDelete = '
                delete from 
                    activity_link 
                where 
                    activity_link_ID = '.$activityID;
            $queryDelete = $this->db->query($sqlDelete);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateActivityName(int $activityID, array $activityNames){
            $langSortedactivityName = array();
            $errorCather = 0;
            $langCounter = 0;
            foreach($activityNames as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedactivityName[strtolower($holder[$langCounter][1])][] = $value[0];
                $langCounter++;
            }
            foreach($langSortedactivityName as $lang => $name){
                $sqlUpdateactivity = '
                    update 
                        activity_translation 
                    set 
                        nameTranslated = "'.mysqli_real_escape_string($this->db, $name[0]).'"
                    where 
                        langCode = "'.$lang.'"
                    and
                        activity_link_ID = '.$activityID;
                $queryUpdateDes = $this->db->query($sqlUpdateactivity);
                if($this->db->affected_rows == 1)
                    $errorCather += 0;
                else
                    $errorCather += 1;
                
            }
            if($errorCather == 0)
                return true;
            else
                return false;
        }
        public function updateActivityDesc(int $activityID, array $activityDescs){
            $langSortedactivityDesc = array();
            $errorCather = 0;
            $langCounter = 0;
            foreach($activityDescs as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedactivityDesc[strtolower($holder[$langCounter][1])][] = $value;
                $langCounter++;
            }
            foreach($langSortedactivityDesc as $lang => $desc){
                $sqlUpdateactivity = '
                    update 
                        activity_translation 
                    set 
                        descriptionTranslated = "'.mysqli_real_escape_string($this->db, $desc[0]).'"
                    where 
                        langCode = "'.$lang.'"
                        and
                        activity_link_ID = '.$activityID;
                $queryUpdateAdmin = $this->db->query($sqlUpdateactivity);
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
        public function updateActivityOther(int $activityID, int $newCityID){
            $sqlUpdateIsPopular = '
                update 
                    activity_link
                set 
                    city_link_ID = "'.$newCityID.'"
                where
                    activity_link_ID = "'.$activityID.'"

            ';
            $queryUpdateIsPopular = $this->db->query($sqlUpdateIsPopular);
            if($this->db->error)
                return $this->db->error;
            else
                return true;
        }
        public function addActivityPhoto(int $activityID, string $thumbnailURL, string  $fullsizeURL){
            $sqlInsert = '
                insert into
                    activity_gallery(
                        activity_link_ID,
                        thumbnailURL,
                        fullsizeURL
                    )
                    values(
                        "'.mysqli_real_escape_string($this->db, $activityID).'",
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
                    activity_gallery
                where 
                    activity_link_ID = "'.$photoID[0].'"
                and
                    activity_gallery_ID = "'.$photoID[1].'"
            ';
            if($queryDelete = $this->db->query($sqlSearchURL)){
                $urlHolder = $queryDelete->fetch_object();
                $sqlDeletePhoto = '
                    delete from
                        activity_gallery
                    where   
                        activity_link_ID = "'.$photoID[0].'"
                    and
                        activity_gallery_ID = "'.$photoID[1].'"';
                
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
        public function showEditPage(string $contentCategory, int $contentID, bool $activityExists){
            if($contentCategory === "activity" && is_int($contentID)){
                $x = 1;
            }else{ 
                $x = 0;
            }
            if($activityExists == false){
                $y = 1;
            }else{ 
                $y = 0;
            }
            /* if 1 then all ok, if 0 then one of the conditions has failed */
            return $x*$y;
        }
    }
?>