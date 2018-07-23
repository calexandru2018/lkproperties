<?php
    class Database{
        function __construct(){
            $this->db = mysqli_connect('localhost', 'root', '', 'lkproper_lk');
            if ($this->db->connect_error) {
                $code  = $mysqli->connect_errno;
                die("Error: ($code)".$this->db->connect_error);
            }
        }
        public function q($sql){
            return $this->db->query($sql);
        }
        public function lastError(){
            return $this->db->error;
        }
    }
?>