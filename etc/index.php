<?php
    session_start();
    require_once('_include/_models/db.php');
    $conn = new Database();
    if(!isset($_SESSION['crsf_token']) || empty($_SESSION['crsf_token'])){
        $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
        header('Refresh: 0');
    }
    
?>
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
	<link rel="stylesheet" href="assets/css/toastr.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />

	<link rel="apple-touch-icon" sizes="76x76" href="assets/favicon.jpg">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/favicon.ico">
    
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
        <?php
            if(!isset($_SESSION['admin_ID']) || empty($_SESSION['admin_ID'])){
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
                                if($key == 'show'){
                                    switch ($value) {
                                        case 'home' : include('_include/_pages/show/show-main.php');
                                            break;
                                        case 'city' : include('_include/_pages/show/show-city.php');
                                            break;
                                        case 'poi' : include('_include/_pages/show/show-poi.php');
                                            break;
                                        case 'service-common' : include('_include/_pages/show/show-service-common.php');
                                            break;
                                        case 'service-unique' : include('_include/_pages/show/show-service-unique.php');
                                            break;
                                        case 'activity' : include('_include/_pages/show/show-activity.php');
                                            break;
                                        case 'to-rent' : include('_include/_pages/show/show-to-rent.php');
                                            break;
                                        case 'to-sell' : include('_include/_pages/show/show-to-sell.php');
                                            break;
                                        case 'faq' : include('_include/_pages/show/show-faq.php');
                                            break;
                                        case 'administrator' : include('_include/_pages/show/show-administrator.php');
                                            break;
                                    }
                                }
                                if($key == 'edit'){
                                    switch ($value) {
                                        case 'city' : include('_include/_pages/edit/edit-city.php');
                                            break;
                                        case 'poi' : include('_include/_pages/edit/edit-poi.php');
                                            break;
                                        case 'service-common' : include('_include/_pages/edit/edit-service-common.php');
                                            break;
                                        case 'service-unique' : include('_include/_pages/edit/edit-service-unique.php');
                                            break;
                                        case 'activity' : include('_include/_pages/edit/edit-activity.php');
                                            break;
                                        case 'to-rent' : include('_include/_pages/edit/edit-to-rent.php');
                                            break;
                                        case 'to-sell' : include('_include/_pages/edit/edit-to-sell.php');
                                            break;
                                        case 'faq' : include('_include/_pages/edit/edit-faq.php');
                                            break;
                                        case 'administrator' : include('_include/_pages/edit/edit-administrator.php');
                                            break;
                                    }
                                }
                            }
                        }else{
                            include('_include/_pages/show/show-main.php');   
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
    <script src="assets/js/toastr.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
</body>
</html>
