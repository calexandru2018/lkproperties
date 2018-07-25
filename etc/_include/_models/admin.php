<?php

    class Administrator{
        
        private $DBCONN;

        function __construct($conn){
            $this->DBCONN = $conn;
        }

        public function fetchAdmin(string $sql){
            $queryResult = $this->DBCONN->query($sql);
            return $queryResult->fetch_object();
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