<?php
    session_start();
    require_once('_include/_models/db.php');
    $MAIN = new Database();
    if(!isset($_SESSION['crsf_token']) || empty($_SESSION['crsf_token'])){
        $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
        header('Refresh: 0');
    }
    // echo phpinfo();
?>
<!DOCTYPE html>
<html lang="pt" class="fullscreen-bg">
<head>
	<?php require_once('_include/_general/_head.php'); ?>
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
                <div class="container" id="modal-window" style="z-index: 50; background-color: rgba(150,150,150, 0.2); height: 100%; width: 100%; position: absolute; display:none">
                    
                </div>
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
                    <script src="assets/js/custom-functions.js"></script>
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
    <script src="assets/js/axios.min.js"></script>
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
</body>
</html>
