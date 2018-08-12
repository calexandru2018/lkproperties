<?php

    class ToRent{
                
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }
        public function closeConnection($conn){
            mysqli_close($conn);
        }

        /* Database Functions */
            public function fetchAll(){

            }

            public function fetchToRent(){

            }

            public function insertToRent(array $inputArray){
                $errorCatcher = Array();
                
                $toRentData = $this->sanitizeInput($inputArray);
                $poiPostalCode = explode('-', $toRentData['cityPoi']);
                $sqlProperty = '
                    insert into
                        property
                            (
                                isForSale,
                                propertyType,
                                viewType,
                                hasPoolAccess,
                                isVisible,
                                roomAmmount,
                                maxAllowedGuests,
                                beachDistance,
                                publicID
                            )
                        values
                            (
                                "0",
                                "'.$toRentData['propertyType'].'",
                                "'.$toRentData['viewType'].'",
                                "'.$toRentData['hasPoolAccess'].'",
                                "'.$toRentData['isVisible'].'",
                                "'.$toRentData['roomAmmount'].'",
                                "'.$toRentData['maxAllowedGuests'].'",
                                "'.$toRentData['beachDistance'].'",
                                "'.$this->generatePublicID($poiPostalCode[1]).'",
                            )

                ';
                $queryProperty = $this->db->query($sqlPropertyInsert);
                if($this->db->error)
                    $errorCatcher['Property Table'][] = $this->db->error;
                
                $propertyID = $this->db->insert_id;

                $sqlPropertyTitle = '
                    insert into
                        title_link
                            (
                                title_link_ID,
                                dateCreated
                            )
                        values
                            (
                                default,
                                default
                            )
                ';
                $queryPropertyTitle = $this->db->query($sqlPropertyTitle);
                if($this->db->error)
                    $errorCatcher['Title Link table'][] = $this->db->error;
                
                $titleLinkID = $this->db->insert_id;
                $sqlTitleTranslation = '
                    
                ';
                $sqlPropertyCityPoi = '
                    insert into
                        property_city_poi
                            (
                                propertyID,
                                city_poi_link_ID
                            )
                        values
                            (
                                "'.$propertyID.'",
                                "'.$poiPostalCode[1].'"
                            )
                        
                ';
                $queryPropertyCityPoi = $this->db->query($sqlPropertyCityPoi);
                if($this->db->error)
                    $errorCatcher['propertyCityPoi table'][] = $this->db->error;

                
                
                return $sqlPropertyInsert;
            }

            public function deleteToRent(){

            }

            public function addToRentPhoto(){
                
            }
            public function deleteToRentPhoto(){

            }
        /* Database Functions */

        /* Check and attributes new publicID  */
            private function generatePublicID($postalCode){
                $publicID = (int)($postalCode.intval('0'.rand(1,9).rand(0,9).rand(0,9)));
                $CheckExists = $this->db->query('
                    select 
                        publicID 
                    from
                        property
                ');
                while($r=$CheckExists->fetch_object()){
                    if($r->publicID == $publicID)
                        $publicID = (int)($postalCode.intval('0'.rand(1,9).rand(0,9).rand(0,9)));
                }
                return $publicID;
            }
        /* Check and attributes new publicID  */

        /* CONTROL CUSTOM FUNCTIONS */
            private function sanitizeInput(array $inputArray){
                $counter = 0;
                $filteredInput = [];
                foreach ($inputArray as $key => $value) {
                    if(substr($key, 0, 21) == "to_rentCommonService_"){
                        $filteredInput['commonServiceList'][] = mysqli_real_escape_string($this->db, $value);
                        unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 21) == "to_rentUniqueService_"){
                        $filteredInput['uniqueServiceList'][] = mysqli_real_escape_string($this->db, $value);
                        unset($filteredInput[$key]);
                    }else{
                        $filteredInput[lcfirst(substr($key, 7))] = mysqli_real_escape_string($this->db, $value);
                    }
                }
                unset($filteredInput['commonService']);
                unset($filteredInput['uniqueService']);
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
            /* Checks if requirments are met to edit the administrator */

        /* CONTROL CUSTOM FUNCTIONS */
    }
?>