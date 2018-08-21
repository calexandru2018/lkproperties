<?php
    session_start();
    if(!isset($_GET['lang']) || empty($_GET['lang']) || (!isset($_SESSION['crsf_token']) || empty($_SESSION['crsf_token']))){
        $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
        header('Location: index.php?lang=en');
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
<html lang="<?php $selectedLang; ?>" class="fullscreen-bg">
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
                        break;
                    case 'for-rent-details':    include('_include/_models/rent-details.php');  
                                                include('_include/_pages/rent-details.php');
                        break;
                    case 'for-sell-details':    include('_include/_models/sell-details.php'); 
                                                include('_include/_pages/sell-details.php');
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
    <script src="assets/js/bootstrap.min.js"></script> 
</body>
</html>
<?php
    mysqli_close($CONN->db);
?>
