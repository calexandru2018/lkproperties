<?php 
    class formAuthorizer {
        //checks if register form gets expected input
        public function userRegistration(array $input){
            if(empty($input[1])){//first name
                return "Var god och fyll ditt förnamn."; 
            }else if(empty($input[2])){//last name
                return "Var god och fyll ditt efternamn"; 
            }else if(empty($input[3])){//email
                return "Var god och fyll i mejlet."; 
            }elseif(!preg_match("/.+@.+\..+/", $input[3])){//email validity
                return "Ogiltig mejl, mejlet måste följa example@live.com"; 
            }else if(empty($input[4])){//password
                return "Var god och fyll i lösenordet."; 
            }elseif (strlen($input[4]) < 6) {//password validity
                return "Löserordet måste bestå av minst 6 tecken.";
            }elseif ($input[4] !== $input[5]) {//password validity
                return "Lösenord måste vara likadana.";
            }elseif (time() < strtotime('+16 years', strtotime($input[6]))) {//age validity - should be working
                return "Du måste vara minst 18 år gammal för att registrera dig själv eller minst 16 och ha målsmans godkännande ";
            }elseif ($input[7] == "none") {//gender validity, correct values 0, 1, 2
                return "Ogiltig kön.";
            }else{
                return 1;//if all ok then return 1
            }
        }
        //checks if login form gets expected input
        public function userLogin(array $input){
            if(empty($input[1])){
                return "Var god och fyll i mejlet."; 
            }
            elseif(!preg_match("/.+@.+\..+/", $input[1])){
                return "Ogiltig mejl."; 
            }else if(empty($input[2])){
                return "Var god och fyll i lösenordet.";
            }else{
                return 1;//if all ok then return 1
            }
        }
        public function postComment(array $input){
            if(strlen($input[1]) == 0){
                echo "Fyll i rubriken"; 
            }else if(strlen($input[2]) == 0){
                echo "Fyll i kommentars fältet.";
            }else {
                return 1;//if all ok then return 1
            }
        }
        //returns all "converted" input
        public function sanitizeInput(array $input){
            $sanitizedInput = array();
            for($i = 1; $i <= count($input)-1; $i++ ){
                $sanitizedInput[$i] = mysqli_real_escape_string($input[0], $input[$i]);
            }
            return $sanitizedInput;
        }
        public function hash($pwd){
            $salt = md5($pwd);
            $pwd = hash("sha256", $salt.$pwd.$salt);
            return $pwd;
        }
        // validate birthday - stackoverflow https://stackoverflow.com/questions/1812589/validate-if-age-is-over-18-years-old
        /*function validateAge($birthday, $age = 18)
        {
            // $birthday can be UNIX_TIMESTAMP or just a string-date.
            if(is_string($birthday)) {
                $birthday = strtotime($birthday);
            }

            // check
            // 31536000 is the number of seconds in a 365 days year.
            if(time() - $birthday < $age * 31536000)  {
                return false;
            }

            return true;
        }*/
    }
?>