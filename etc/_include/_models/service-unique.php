<?php
    /* SU stands for Service Unique */
    class SU{
        
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
                    unique_service_link
                left join 
                    unique_service_translation 
                on
                    unique_service_link.unique_service_link_ID = unique_service_translation.unique_service_link_ID
                where
                    langCode = "'.$this->langList['portuguese'].'"
            ');
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return ((empty($output)) ? '': $output);
        }
        /* fetchsc had to be fetched as an assoc array, so it could be arranged based on language */
        public function fetchSU(int $suID){
            $sqlFetch = '
                select
                    *
                from
                    unique_service_translation
                where
                    unique_service_translation.unique_service_link_ID = "'.$suID.'"
            ';
            $queryResult = $this->db->query($sqlFetch);
            while($r=$queryResult->fetch_assoc()){
                $output[$r['langCode']] = $r;
            }
            return $output;
        }
        public function insertSU(array $inputArray){
            $scData = $this->sanitizeInput($inputArray);
            $c = 1;
            $content = array();
            $errorCatcher = array();
            $insertedID = array();

            foreach($scData as $key => $value){
                if($c % 2 == 0){
                    $content[$this->langList['english']][] = $value;
                }else{
                    $content[$this->langList['portuguese']][] = $value;
                }
                $c++;
            }
            for($c = 0; $c < (count($scData)/2); $c++){
                $sqlInsertSULink = '
                    insert into
                        unique_service_link
                    values
                        (default, default)
                ';
                $queryInsertSULink = $this->db->query($sqlInsertSULink);
                if($this->db->error)
                    $errorCather[] = $this->db->error;
                else
                    $insertedID[] = $this->db->insert_id;
            }

            for($c = 0; $c < (count($scData)/2); $c++){
                $sqlInsertSUTranslation = '
                    insert into
                        unique_service_translation 
                        (
                            unique_service_link_ID,
                            langCode,
                            uniqueServiceTranslated    
                        )
                    values
                        (
                            "'.$insertedID[$c].'",
                            "'.$this->langList['portuguese'].'",
                            "'.$content[$this->langList['portuguese']][$c].'"
                        ),
                        (
                            "'.$insertedID[$c].'",
                            "'.$this->langList['english'].'",
                            "'.$content[$this->langList['english']][$c].'"
                        )
                ';
                $toReturn[$c][] = [
                    $insertedID[$c],
                    $content[$this->langList['portuguese']][$c],
                    'Agora',
                    '<a href="?edit=service-unique&id='.$insertedID[$c].'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                    <button class="btn btn-danger btn-xs pull-right" id="delete-service_unique"><span class="lnr lnr-trash"></span></button>'
                        
                ];
                $queryInsertSUTranslation = $this->db->query($sqlInsertSUTranslation);
                
                if($this->db->error)
                    $errorCather[] = $this->db->error;
                
            }
            if(empty($errorCatcher))
                return $toReturn;
            else
                return $errorCatcher;
        }
        public function deleteSU(int $suID){
            $sqlDelete = '
                delete from 
                    unique_service_link 
                where 
                    unique_service_link_ID = '.$suID;
            $queryDelete = $this->db->query($sqlDelete);
            if($this->db->error)
                return $this->db->error;
            else
                return true;
        }
        public function updateSU(int $suID, array $scNames){
            $langSortedscName = array();
            $errorCatcher = array();
            $langCounter = 0;
            foreach($scNames as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedscName[strtolower($holder[$langCounter][1])][] = $value[0];
                $langCounter++;
            }
            foreach($langSortedscName as $lang => $name){
                $sqlUpdatesc = '
                    update 
                        unique_service_translation 
                    set 
                        uniqueServiceTranslated = "'.mysqli_real_escape_string($this->db, $name[0]).'"
                    where 
                        langCode = "'.$lang.'"
                    and
                        unique_service_link_ID = '.$suID;
                $queryUpdateDes = $this->db->query($sqlUpdatesc);
                if($this->db->error)
                    $errorCather[] = $this->db->error;
            }
            if(empty($errorCather))
                return true;
            else
                return $errorCather;
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
        public function showEditPage(string $contentCategory, int $contentID, bool $scExists){
            if($contentCategory === "service-unique" && is_int($contentID)){
                $x = 1;
            }else{ 
                $x = 0;
            }
            if($scExists == false){
                $y = 1;
            }else{ 
                $y = 0;
            }
            /* if 1 then all ok, if 0 then one of the conditions has failed */
            return $x*$y;
        }
    }
?>