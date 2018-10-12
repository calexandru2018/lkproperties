<?php
    if(!isset($_COOKIE['acceptCookie'])){
        setcookie('acceptCookie', '0',  time()+60*60*24*30, "/lkproperties");
        // setcookie('acceptCookie', 'en',  time()+60*60*24*30, '/', '', true);
    }
    $GLOBALS['absPath'] = '/lkproperties/';
    //$GLOBALS['absPath'] = 'https://lk-properties.pt/';
    function urlPurifier($string){
        $unwanted_array = array(    
            'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', ' '=>'-'
        );
        return strtolower(strtr(str_replace(' ', '-', $string), $unwanted_array));
    }
    if(!isset($_GET['lang'])){
        $selectedLang = 'en';
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
    <?php 
        require_once('_include/_general/_navbar.php');

        if(empty($_GET['lang']) || (count($_GET) == 1)){
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
    <main role="main" class="custom-container mb-md-5 text-muted" style="box-shadow: 0px 27px 70px -35px var(--gray);">
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
    <?php         
        if(!isset($_COOKIE['acceptCookie']) || (isset($_COOKIE['acceptCookie']) && $_COOKIE['acceptCookie'] == '0')){
            include('_include/_general/_cookie-prompt.php');
        }; 
    ?>
</body>
</html>
<?php
    mysqli_close($CONN->db);
?>
