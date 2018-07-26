<?php

    class Administrator{
        
        private $DBCONN;

        function __construct($conn){
            $this->DBCONN = $conn;
        }
        public function closeConnection($conn){
            mysqli_close($conn);
        }

        /* DATABASE FUNCTIONS */
        public function showAll(){
            $queryResult = $this->DBCONN->query('select * from admin');
            return $queryResult->fetch_object();
        }
        public function fetchAdmin(string $sql){
            $queryResult = $this->DBCONN->query($sql);
            return $queryResult->fetch_object();
        }
        public function insertAdmin(array $inputArray){
            $adminData = $this->validateInput($inputArray);

            $sqlCheckExists = 'select email from admin where email = "'.$adminData['adminEmail'].'"';
            $queryCheckExists = $this->DBCONN->query($sqlCheckExists);
            if($queryCheckExists->num_rows > 0){
                return false;
            }
            $sqlInsert = 'insert into admin 
                            (name, email, password, isActive, isPublicVisible, adminPrivilege)
                        values
                            ("'.$adminData['adminName'].'","'.$adminData['adminEmail'].'","'.$adminData['adminPassword'].'","'.$adminData['adminIsActive'].'","'.$adminData['adminIsPublic'].'","'.$adminData['adminPriveliege'].'")
            '; 
            $queryInsert = $this->DBCONN->query($sqlInsert);
            if($queryInsert)
                return $this->DBCONN->insert_id;
            else
                return false;
        }
        public function deleteAdmin(array $adminData){

        }

        /* CONTROL CUSTOM FUNCTIONS */
        private function validateInput(array $inputArray){
            /* 
            ['adminName', 'adminEmail', 'adminPassword', 'adminIsActive', 'adminIsPublic', 'adminPriveliege'];
            [string, string, string, int, int, int];
            */
            $inputArray = $this->explodeArray($inputArray);
            $counter = 0;
            $filteredInput = [];
            foreach ($inputArray as $key => $value) {
                if($counter > 2)
                    $filteredInput = (int)$value;
                if($key == 'adminPassword')
                    $value = password_hash($value, PASSWORD_BCRYPT);
                
                $filteredInput[$key] = mysqli_real_escape_string($this->DBCONN, $value);
            }
            return $filteredInput;
        }
        private function explodeArray(array $post){
            $firstFilter = explode('&', $post['curatedObject']);
            for($c = 0; $c < count($firstFilter); $c++){
                $secondFilter[$c] = explode('=', $firstFilter[$c]);
                    $finalArray[$secondFilter[$c][0]] = $secondFilter[$c][1]; 
            };
            return $finalArray;
        }        

        /* Checks if requirments are met to edit the administrator */
        public function showEditPage(string $condition, bool $adminExists){
            if($condition){
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