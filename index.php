<?php
    $GLOBALS['absPath'] = '/lkproperties/';
    session_start();
    if(!isset($_GET['lang']) || empty($_GET['lang']) || (!isset($_SESSION['crsf_token']) || empty($_SESSION['crsf_token']))){
        $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
        header('Location: '.$GLOBALS['absPath'].'en');
    }else{
        switch($_GET['lang']){
            case 'en': $selectedLang = 'en';
                break;
            case 'pt': $selectedLang = 'pt';
                break;
            default:   $selectedLang = 'en';
                break;
        }
    }
    include("assets/lang/".$selectedLang.".php"); 
    require_once('_include/_models/db.php');
    $CONN = new Database();
?>
<!DOCTYPE html>
<html lang="<?php echo $selectedLang; ?>" class="fullscreen-bg">
<head>
	<?php require_once('_include/_general/_head.php'); ?>
</head>
<body>
    <?php require_once('_include/_general/_navbar.php'); ?>
    <?php 
        if(!empty($_GET['lang']) && (count($_GET) == 1)){
            include_once('_include/_general/_home.php');            
            include_once('_include/_general/_search.php'); 
        }
        if((!empty($_GET['show']) && ($_GET['show'] == 'contact-us' || $_GET['show'] == 'for-sale' || $_GET['show'] == 'filter'))){
            include_once('_include/_general/_home.php'); 
        }
        if(!empty($_GET['show']) && ($_GET['show'] == 'for-sale' || $_GET['show'] == 'filter')){
            include_once('_include/_general/_search.php'); 
        }
    ?>
    <main role="main" class="custom-container p-0 mb-md-5 text-muted" style="box-shadow: 0px 27px 70px -35px var(--gray);">
        <?php 
            if((isset($_GET['show']) || !empty($_GET['show'])) && (isset($_GET['lang']))){
                switch ($_GET['show']){
                    case 'popular-poi':
                    case 'popular-city':        include('_include/_pages/popular.php');
                        break;
                    case 'activities':          include('_include/_models/activity-list.php');
                                                include('_include/_pages/activity-list.php');
                        break;
                    case 'faq':                 include('_include/_pages/faq.php');
                        break;
                    case 'for-sale':            include('_include/_models/sell-list.php');
                                                include('_include/_pages/sell-list.php');
                        break;
                    case 'contact-us':          include('_include/_pages/contact-us.php');
                                                include('assets/mail/PHPMailer.php');
                                                include('assets/mail/SMTP.php');
                        break;
                    case 'for-rent-details':    include('_include/_models/rent-details.php');  
                                                include('_include/_pages/rent-details.php');
                                                include('assets/mail/PHPMailer.php');
                                                include('assets/mail/SMTP.php');
                        break;
                    case 'for-sell-details':    include('_include/_models/sell-details.php'); 
                                                include('_include/_pages/sell-details.php');
                                                include('assets/mail/PHPMailer.php');
                                                include('assets/mail/SMTP.php');
                        break;
                    case 'filter':              include('_include/_models/filter-search.php'); 
                                                include('_include/_pages/filter-search.php');
                        break;
                }
            }else{
                include('_include/_models/rent-list.php');
                include('_include/_pages/rent-list.php');
            }
        include_once('_include/_general/_footer.php'); ?>
    </main>
    <div class=".bg-success" id="snackbar"></div>
    <script src="<?php echo $GLOBALS['absPath']; ?>assets/js/bootstrap.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="<?php echo $GLOBALS['absPath']; ?>assets/js/range-slider.min.js"></script> 
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="<?php echo $GLOBALS['absPath']; ?>assets/js/custom-functions.js"></script>
</body>
</html>
<?php
    mysqli_close($CONN->db);
?>
