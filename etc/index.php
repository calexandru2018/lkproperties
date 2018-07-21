<?php session_start();?>
<!doctype html>
<html lang="pt" class="fullscreen-bg">
<head>
	<title>LK Properties - Painel de Administração</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/dropzone.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/favicon.jpg">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/favicon.ico">
    
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
        <?php
            if(!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
                include('_include/_pages/login.php');
            }else{
        ?>
		<!-- NAVBAR -->
            <?php include('_include/_general/_navbar.php'); ?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
            <?php include('_include/_general/_left-sidebar.php'); ?>
		<!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
            <div class="main">
                <!-- MAIN CONTENT -->
                <div class="main-content">
                    <div class="container-fluid">
                    
                        <?php
                        if(isset($_GET) && !empty($_GET)){
                            foreach ($_GET as $key => $value) {
                                switch ($value) {
                                    case 'home' : include('_include/_pages/main.php');
                                        break;
                                    case 'cities' : include('_include/_pages/cities.php');
                                        break;
                                    case 'poi' : include('_include/_pages/poi.php');
                                        break;
                                    case 'services' : include('_include/_pages/services.php');
                                        break;
                                    case 'unique-services' : include('_include/_pages/unique-services.php');
                                        break;
                                    case 'to-rent' : include('_include/_pages/to-rent.php');
                                        break;
                                    case 'activities' : include('_include/_pages/activities.php');
                                        break;
                                    case 'faq' : include('_include/_pages/faq.php');
                                        break;
                                    case 'to-sell' : include('_include/_pages/to-sell.php');
                                        break;
                                    case 'contact-us' : include('_include/_pages/contact-us.php');
                                        break;
                                    case 'administrators' : include('_include/_pages/administrators.php');
                                        break;
                                    default :
                                        include('_include/_pages/main.php');
                                        break;
                                }
                            }
                        }else{
                            include('_include/_pages/main.php');   
                        }
                        ?>
                    </div>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
        <?php } ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/klorofil-common.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</body>
</html>
