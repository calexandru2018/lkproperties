<?php
    /* SC stands for Service Common */
    class SC{
        
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
                    common_service_link
                left join 
                    common_service_translation 
                on
                common_service_link.common_service_link_ID = common_service_translation.common_service_link_ID
                where
                    langCode = "'.$this->langList['portuguese'].'"
            ');
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return ((empty($output)) ? '': $output);
        }
        /* fetchsc had to be fetched as an assoc array, so it could be arranged based on language */
        public function fetchSC(int $scID){
            $sqlFetch2 = '
                SELECT 
                    sc_question_translation.questionTranslated as contentResponse, 
                    sc_question_translation.langCode 
                FROM 
                    sc_question_translation
                where 
                    sc_question_translation.sc_link_ID = "'.$scID.'"
                UNION
                SELECT 
                    sc_answer_translation.answerTranslated, 
                    sc_answer_translation.langCode 
                FROM 
                    sc_answer_translation
                where 
                    sc_answer_translation.sc_link_ID = "'.$scID.'"
            ';
            
            $sqlFetch = '
                select
                    *
                from
                    sc_link
                left join
                    sc_translation
                on
                    sc_link.sc_link_ID = sc_translation.sc_link_ID
                where
                    sc_link.sc_link_ID = "'.$scID.'"
            ';
            $queryResult = $this->db->query($sqlFetch2);
            while($r=$queryResult->fetch_assoc()){
                $output[$r['langCode']][] = $r['contentResponse'];
            }
            return $output;
        }
        public function insertSC(array $inputArray){
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
                $sqlInsertSCLink = '
                    insert into
                        common_service_link
                    values
                        (default, default)
                ';
                $queryInsertSCLink = $this->db->query($sqlInsertSCLink);
                if($this->db->error)
                    $errorCather[] = $this->db->error;
                else
                    $insertedID[] = $this->db->insert_id;
            }

            for($c = 0; $c < (count($scData)/2); $c++){
                $sqlInsertSCTranslation = '
                    insert into
                        common_service_translation 
                        (
                            common_service_link_ID,
                            langCode,
                            serviceTranslated    
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
                $queryInsertSCTranslation = $this->db->query($sqlInsertSCTranslation);
                
                if($this->db->error)
                    $errorCather[] = $this->db->error;
                else
                    $errorCather[$c][] = 'worked';
                
            }
            if(empty($errorCatcher))
                return true;
            else
                return $errorCatcher;
        }
        public function deleteSC(int $scID){
            $sqlDelete = '
                delete from 
                    sc_link 
                where 
                    sc_link_ID = '.$scID;
            $queryDelete = $this->db->query($sqlDelete);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateSCQuestion(int $scID, array $scNames){
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
                        sc_question_translation 
                    set 
                        questionTranslated = "'.mysqli_real_escape_string($this->db, $name[0]).'"
                    where 
                        langCode = "'.$lang.'"
                    and
                        sc_link_ID = '.$scID;
                $queryUpdateDes = $this->db->query($sqlUpdatesc);
                if($this->db->error)
                    $errorCather[] = $this->db->error;
                
            }
            if(empty($errorCather))
                return true;
            else
                return $errorCather;
        }
        public function updateSCAnswer(int $scID, array $scDescs){
            $langSortedscDesc = array();
            $errorCatcher = array();
            $langCounter = 0;
            foreach($scDescs as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedscDesc[strtolower($holder[$langCounter][1])][] = $value;
                $langCounter++;
            }
            foreach($langSortedscDesc as $lang => $desc){
                $sqlUpdatesc = '
                    update 
                        sc_answer_translation 
                    set 
                        answerTranslated = "'.mysqli_real_escape_string($this->db, $desc[0]).'"
                    where 
                        langCode = "'.$lang.'"
                        and
                        sc_link_ID = '.$scID;
                $queryUpdateAdmin = $this->db->query($sqlUpdatesc);
                if($this->db->error)
                    $errorCather[] = $this->db->error;
                
            }
            if(empty($errorCather))
                return true;
            else
                return false;
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
            if($contentCategory === "sc" && is_int($contentID)){
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