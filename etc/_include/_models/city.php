<?php

    class City{
        
        private $db;
        private $langList = [
                'portuguese' => 'pt', 
                'english' => 'en',
                'italian' => 'it',
                'french' => 'fr'
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
                    langCode = "pt"
            ');
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return $output;
        }
        public function fetchCity(string $sql){
            $queryResult = $this->db->query($sql);
            return $queryResult->fetch_object();
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
        /* public function updateAdminPersInfo(int $adminID, string $name, string $email){
            $sqlUpdateAdmin = 'update admin set name = "'.$name.'", email = "'.$email.'" where admin_ID = '.$adminID;
            $queryUpdateAdmin = $this->db->query($sqlUpdateAdmin);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateAdminPassword(int $adminID, string $newPass){
            $sqlUpdateAdmin = 'update admin set password = "'.password_hash(mysqli_real_escape_string($this->db, $newPass), PASSWORD_BCRYPT).'" where admin_ID = '.$adminID;
            $queryUpdateAdmin = $this->db->query($sqlUpdateAdmin);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateAdminOtherSettings(int $adminID, int $privilege, string $isActive, string $isPublic){
            $sqlUpdateAdmin = 'update admin set 
                    isActive = "'.(($isActive == 'checked') ? 1:0).'", 
                    isPublicVisible = "'.(($isPublic == 'checked') ? 1:0).'", 
                    adminPrivilege = "'.$privilege.'" 
                where admin_ID = '.$adminID;
            $queryUpdateAdmin = $this->db->query($sqlUpdateAdmin);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        } */
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
        public function deleteCityPhoto(int $adminID){
            $sqlUpdateAdmin = 'update admin set 
                        thumbnailURL = NULL
                    where admin_ID = '.$adminID;
            $sqlFetchURL = 'select thumbnailURL from admin where admin_ID = '.$adminID;
            $queryFetchURL = $this->db->query($sqlFetchURL);
                if($queryFetchURL){
                    $queryFetchResult = $queryFetchURL->fetch_object();
                    $queryUpdateAdmin = $this->db->query($sqlUpdateAdmin);
                    if($this->db->affected_rows == 1)
                        return $queryFetchResult->thumbnailURL;
                    else
                        return false;
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
        public function showEditPage(string $var1, int $var2, bool $adminExists){
            if($var1 === "administrator" && is_int($var2)){
                $x = 1;
            }else{ 
                $x = 0;
            }
            if($adminExists == false){
                $y = 1;
            }else{ 
                $y = 0;
            }
            /* if 1 then all ok, if 0 then one of the conditions has failed */
            return $x*$y;
        }
    }
?>