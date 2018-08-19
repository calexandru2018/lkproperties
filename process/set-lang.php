<?php
    session_start();
    if(isset($_POST["lang"]) && !empty($_POST["lang"])){
        setcookie("lang", $_POST["lang"],  time()+60*60*24*30, "/");
        echo true;
    }
?>