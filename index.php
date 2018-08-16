<?php
    session_start();
    require_once('_include/_models/db.php');
    $CONN = new Database();
?>
<!DOCTYPE html>
<html lang="pt" class="fullscreen-bg">
<head>
	<?php require_once('_include/_general/_head.php'); ?>
</head>
<body>
    <?php require_once('_include/_general/_navbar.php'); ?>
    <?php 
        if(empty($_GET)){

        }
            require_once('_include/_general/_home.php');            
            require_once('_include/_general/_search.php'); 
    ?>

    <main role="main" class="custom-container p-0 mb-md-5 text-muted" style="box-shadow: 0px 27px 70px -35px var(--gray);">
        <?php 
        
            if(isset($_GET['show']) && !empty($_GET['show'])){
                switch ($_GET['show']){
                    case 'popular': include('_include/_pages/popular.php');
                        break;
                    case 'activities': include('_include/_pages/activity-list.php');
                        break;
                    case 'faq': include('_include/_pages/faq.php');;
                        break;
                    case 'for-sale': include('_include/_pages/sell-list.php');;
                        break;
                    case 'contact-us': include('_include/_pages/contact-us.php');;
                        break;
                }
            }else{
                include('_include/_pages/rent-list.php');
            }
        require_once('_include/_general/_footer.php'); ?>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script> 
</body>
</html>