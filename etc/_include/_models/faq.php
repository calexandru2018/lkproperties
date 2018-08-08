<?php

    class Faq{
        
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
                    faq_link
                left join 
                    faq_question_translation 
                on
                    faq_link.faq_link_ID = faq_question_translation.faq_link_ID
                LEFT JOIN
                    faq_answer_translation
                ON
                    faq_link.faq_link_ID = faq_answer_translation.faq_link_ID
                where
                    faq_question_translation.langCode = "'.$this->langList['portuguese'].'"
                AND
                    faq_answer_translation.langCode = "'.$this->langList['portuguese'].'"
            ');
            while($r=$queryResult->fetch_object()){
                $output[] = $r;
            }
            return ((empty($output)) ? '': $output);
        }
        /* fetchfaq had to be fetched as an assoc array, so it could be arranged based on language */
        public function fetchFaq(int $faqID){
            $sqlFetch2 = '
                select 
                    *
                from 
                    faq_link
                left join 
                    faq_question_translation 
                on
                    faq_link.faq_link_ID = faq_question_translation.faq_link_ID
                LEFT JOIN
                    faq_answer_translation
                ON
                    faq_link.faq_link_ID = faq_answer_translation.faq_link_ID
                where
                    faq_link.faq_link_ID = "'.$faqID.'"
            ';
            
            $sqlFetch = '
                select
                    *
                from
                    faq_link
                left join
                    faq_translation
                on
                    faq_link.faq_link_ID = faq_translation.faq_link_ID
                where
                    faq_link.faq_link_ID = "'.$faqID.'"
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
            return $output;
        }
        public function insertFaq(array $inputArray){
            $faqData = $this->sanitizeInput($inputArray);
            $errorCatcher = array();

            $sqlCheckQuestion = '
                select 
                    questionTranslated
                from    
                    faq_question_translation
                where 
                    questionTranslated like "'.$faqData['faqQuestion-'.strtoupper($this->langList['portuguese'])].'"
                    and
                    langCode = "'.$this->langList['portuguese'].'"
            ';
            $queryCheckExists = $this->db->query($sqlCheckQuestion);
            if($queryCheckExists->num_rows > 0)
                $errorCatcher[] = $this->db->error;
            
            /* TEMPORARY VALUES */
            $sqlFaqLinkInsert = '
                insert into 
                    faq_link(
                        isVisible,
                        admin
                    )
                values(
                    1,
                    1
                )
            ';
            $queryFaqLinkInsert = $this->db->query($sqlFaqLinkInsert);
            if($this->db->error)
                $errorCatcher[] = $this->db->error;
            
            $lastInsertedID = $this->db->insert_id;  
            $sqlInsertQuestion = '
                insert into
                    faq_question_translation(
                        faq_link_ID,
                        langCode,
                        questionTranslated
                    )
                values
                    (
                        "'.$lastInsertedID.'",
                        "'.$this->langList['portuguese'].'",
                        "'.$faqData['faqQuestion-'.strtoupper($this->langList['portuguese'])].'"
                    ),
                    (
                        "'.$lastInsertedID.'",
                        "'.$this->langList['english'].'",
                        "'.$faqData['faqQuestion-'.strtoupper($this->langList['english'])].'"
                    )
            ';
            $queryInsertQuestion = $this->db->query($sqlInsertQuestion);
            if($this->db->error)
                $errorCatcher[] = $this->db->error;
                        
            $sqlInsertAnswer = '
                insert into
                    faq_answer_translation(
                        faq_link_ID,
                        langCode,
                        answerTranslated
                    )
                values
                    (
                        "'.$lastInsertedID.'",
                        "'.$this->langList['portuguese'].'",
                        "'.$faqData['faqAnswer-'.strtoupper($this->langList['portuguese'])].'"
                    ),
                    (
                        "'.$lastInsertedID.'",
                        "'.$this->langList['english'].'",
                        "'.$faqData['faqAnswer-'.strtoupper($this->langList['english'])].'"
                    )
            ';
            $queryInsertAnswer = $this->db->query($sqlInsertAnswer);
            if($this->db->error)
                $errorCatcher[] = $this->db->error;
            
            if(empty($errorCatcher)){
                $row = [
                    $lastInsertedID,
                    $faqData['faqQuestion-'.strtoupper($this->langList['portuguese'])],
                    $faqData['faqAnswer-'.strtoupper($this->langList['portuguese'])],
                    '<a href="?edit=faq&id='.$lastInsertedID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                    <button class="btn btn-danger btn-xs pull-right" id="delete-faq"><span class="lnr lnr-trash"></span></button>'
                ];
                return $row;
            }else{
                return false;
            }
                
        }
        public function deleteFaq(int $faqID){
            $sqlDelete = '
                delete from 
                    faq_link 
                where 
                    faq_link_ID = '.$faqID;
            $queryDelete = $this->db->query($sqlDelete);
            if($this->db->affected_rows == 1)
                return true;
            else
                return false;
        }
        public function updateFaqQuestion(int $faqID, array $faqNames){
            $langSortedfaqName = array();
            $errorCather = 0;
            $langCounter = 0;
            foreach($faqNames as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedfaqName[strtolower($holder[$langCounter][1])][] = $value[0];
                $langCounter++;
            }
            foreach($langSortedfaqName as $lang => $name){
                $sqlUpdatefaq = '
                    update 
                        faq_question_translation 
                    set 
                        nameTranslated = "'.mysqli_real_escape_string($this->db, $name[0]).'"
                    where 
                        langCode = "'.$lang.'"
                    and
                        faq_link_ID = '.$faqID;
                $queryUpdateDes = $this->db->query($sqlUpdatefaq);
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
        public function updateFaqAnswer(int $faqID, array $faqDescs){
            $langSortedfaqDesc = array();
            $errorCather = 0;
            $langCounter = 0;
            foreach($faqDescs as $key => $value){
                $holder[] = explode('-', $key);                
                $langSortedfaqDesc[strtolower($holder[$langCounter][1])][] = $value;
                $langCounter++;
            }
            foreach($langSortedfaqDesc as $lang => $desc){
                $sqlUpdatefaq = '
                    update 
                        faq_translation 
                    set 
                        descriptionTranslated = "'.mysqli_real_escape_string($this->db, $desc[0]).'"
                    where 
                        langCode = "'.$lang.'"
                        and
                        faq_link_ID = '.$faqID;
                $queryUpdateAdmin = $this->db->query($sqlUpdatefaq);
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
        public function showEditPage(string $contentCategory, int $contentID, bool $faqExists){
            if($contentCategory === "faq" && is_int($contentID)){
                $x = 1;
            }else{ 
                $x = 0;
            }
            if($faqExists == false){
                $y = 1;
            }else{ 
                $y = 0;
            }
            /* if 1 then all ok, if 0 then one of the conditions has failed */
            return $x*$y;
        }
    }
?>