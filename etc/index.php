<!doctype html>
<html lang="pt" class="fullscreen-bg">

<head>
	<title>LK Properties - Painel de Administração</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/favicon.jpg">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/favicon.ico">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
        <?php
            if(!isset($_SESSION['admin'])){
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
                            foreach ($_GET as $key => $value) {
                                switch ($key) {
                                    case 'home' : include('_include/_pages/main.php');
                                        break;
                                    case 'cities' : include('_include/_pages/cities.php');
                                        break;
                                    case 'poi' : include('_include/_pages/poi.php');
                                        break;
                                    case 'activities' : include('_include/_pages/activities.php');
                                        break;
                                    case 'faq' : include('_include/_pages/faq.php');
                                        break;
                                    default :
                                        include('_include/_pages/main.php');
                                        break;
                                }
                            }
                        ?>
                    </div>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
            <div class="clearfix"></div>
            <footer>
                <div class="container-fluid">
                    <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
                </div>
            </footer>
        <?php } ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<script src="assets/js/klorofil-common.js"></script>
</body>

</html>
