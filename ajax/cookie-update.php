<?php
    if(isset($_POST['accept-cookie']) || !empty($_POST['accept-cookie'])){
        setcookie('acceptCookie', '1',  time()+60*60*24*30, '/', '', true);
        echo true;
    }
?>