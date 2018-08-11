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
                $toRentData = $this->sanitizeInput($inputArray);

                return $toRentData;
            }

            public function deleteToRent(){

            }

            public function addToRentPhoto(){
                
            }
            public function deleteToRentPhoto(){

            }
        /* Database Functions */

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
                        $filteredInput[$key] = mysqli_real_escape_string($this->db, $value);
                    }
                }
                unset($filteredInput['to_rentCommonService']);
                unset($filteredInput['to_rentUniqueService']);
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