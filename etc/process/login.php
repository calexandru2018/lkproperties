<?php
	if(isset($_SESSION['admin']) || !empty($_SESSION['admin'])){
		session_unset();
        session_destroy();
        header('Refresh:0');
	}
?>