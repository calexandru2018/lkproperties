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
            public function fetchAll(){
                $queryResult = $this->db->query('select  admin_ID , name , email , dateCreated , dateModified , isActive , isPublicVisible , adminPrivilege  from admin');
                while($r=$queryResult->fetch_object()){
                    $output[] = $r;
                }
                return ((empty($output)) ? '': $output);
            }
            public function fetchAdmin(string $actionType, string $email, int $adminID){
                if($actionType == 'login')
                    $sqlFetchAdmin = 'select admin_ID, adminPrivilege, thumbnailURL, email, password, name from admin where email = "'.$email.'"';
                else if($actionType == 'edit')    
                    $sqlFetchAdmin = 'select * from admin where admin_ID = "'.$adminID.'"';
                
                $queryResult = $this->db->query($sqlFetchAdmin);
                return $queryResult->fetch_object();
            }
            public function insertAdmin(array $inputArray){
                $adminData = $this->sanitizeInput($inputArray);
                
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
                        <button class="btn btn-danger btn-xs pull-right" id="delete-admin"><span class="lnr lnr-trash"></span></button>'
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
            }
            public function addAdminPhoto(int $adminID, string  $url){
                $sqlUpdateAdmin = 'update admin set 
                        thumbnailURL = "'.$url.'"
                    where admin_ID = '.$adminID;
                $queryUpdateAdmin = $this->db->query($sqlUpdateAdmin);
                if($this->db->error)
                    return $this->db->error;
                else
                    return true;
            }
            public function deleteAdminPhoto(int $adminID){
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
        /* DATABASE FUNCTIONS */

        /* CONTROL CUSTOM FUNCTIONS */
            private function sanitizeInput(array $inputArray){
                $counter = 0;
                $filteredInput = [];
                foreach ($inputArray as $key => $value) {
                    if($key == 'adminIsActive' || $key == 'adminIsPublic' || $key == 'adminPriveliege'){
                        $filteredInput[$key] = (int)$value;
                    }else if($key == 'adminPassword'){
                        $filteredInput[$key] = password_hash(mysqli_real_escape_string($this->db, $value), PASSWORD_BCRYPT);
                    }else{
                        $filteredInput[$key] = mysqli_real_escape_string($this->db, $value);
                    }
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
            /* Checks if requirments are met to edit the administrator */

        /* CONTROL CUSTOM FUNCTIONS */


        

    }
?>