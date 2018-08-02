<?php
	session_start();
	if(isset($_SESSION['admin_ID']) || !empty($_SESSION['admin_ID'])){
		session_unset();
        session_destroy();
        header('Location: ../');
	}
?>