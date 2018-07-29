<?php

    class Administrator{
        
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }
        public function closeConnection($conn){
            mysqli_close($conn);
        }

        /* DATABASE FUNCTIONS */
        public function showAll(){
            $queryResult = $this->db->query('select  admin_ID , name , email , dateCreated , dateModified , isActive , isPublicVisible , adminPrivilege  from admin');
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return $output;
        }
        public function fetchAdmin(string $sql){
            $queryResult = $this->db->query($sql);
            return $queryResult->fetch_object();
        }
        public function insertAdmin(array $inputArray){
            $adminData = $this->validateInput($inputArray);

            $sqlCheckExists = 'select email from admin where email = "'.$adminData['adminEmail'].'"';
            $queryCheckExists = $this->db->query($sqlCheckExists);
            if($queryCheckExists->num_rows > 0){
                return false;
            }
            $sqlInsert = 'insert into admin 
                            (name, email, password, isActive, isPublicVisible, adminPrivilege)
                        values
                            ("'.str_replace('+',' ',$adminData['adminName']).'","'.$adminData['adminEmail'].'","'.$adminData['adminPassword'].'","'.$adminData['adminIsActive'].'","'.$adminData['adminIsPublic'].'","'.$adminData['adminPriveliege'].'")
            '; 
            $queryInsert = $this->db->query($sqlInsert);
            if($queryInsert){
                switch($adminData['adminPriveliege']){
                    case 1: $adminPriv = 'Super Admin';
                        break;
                    case 2: $adminPriv = 'Gestor de Conteudo';
                        break;
                    case 3: $adminPriv = 'Editor de Aluguer';
                        break;
                };
                $arrayToReturn = [
                    $this->db->insert_id,
                    str_replace('+',' ',$adminData['adminName']),
                    $adminData['adminEmail'],
                    date("Y-m-d H:i:s"),
                    '',
                    (($adminData['adminIsActive'] == 1)? 'Sim':'Não'),
                    (($adminData['adminIsPublic'] == 1)? 'Sim':'Não'),
                    $adminPriv,
                    '<button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$this->db->insert_id.'" data-toggle="collapse">
                        <i class="lnr lnr-plus-circle"></i>
                    </button>',
                    '<a href="?edit=administrator&id='.$this->db->insert_id.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                    <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>'
                ];
                return $arrayToReturn;
            }else{
                return false;
            }
        }
        public function deleteAdmin(int $adminID){
            $sqlDelete = 'delete from admin where admin_ID = '.(int)$adminID;
            $queryDelete = $this->db->query($sqlDelete);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateAdminPersInfo(int $adminID, string $name, string $email){
            $sqlUpdateAdmin = 'update admin set name = "'.$name.'", email = "'.$email.'" where admin_ID = '.$adminID;
            $queryUpdateAdmin = $this->db->query($sqlUpdateAdmin);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateAdminPassword(id $adminID, string $newPass){
            $sqlUpdateAdmin = 'update admin set password = '.password_hash($newPass, PASSWORD_BCRYPT).' where admin_ID = '.$adminID;
            $queryUpdateAdmin = $this->db->query($sqlUpdateAdmin);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateAdminOtherSettings(id $adminID, int $privilege, int $isActive, int $isPublic){
            $sqlUpdateAdmin = 'update admin set isActive = '.$isActive.', isPublicVisible = '.$isPublic.', adminPrivilege = '.$privilege.' where admin_ID = '.$adminID;
            $queryUpdateAdmin = $this->db->query($sqlUpdateAdmin);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }

        /* CONTROL CUSTOM FUNCTIONS */
        private function validateInput(array $inputArray){
            $inputArray = $this->explodeArray($inputArray);
            $counter = 0;
            $filteredInput = [];
            foreach ($inputArray as $key => $value) {
                if($counter > 2)
                    $filteredInput = (int)$value;
                if($key == 'adminPassword')
                    $value = password_hash($value, PASSWORD_BCRYPT);
                
                $filteredInput[$key] = mysqli_real_escape_string($this->db, $value);
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