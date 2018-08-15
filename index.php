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
        if((!isset($_GET) && empty($_GET)) || (isset($_GET['details']) && ((int)_GET['details'] == true))){
            require_once('_include/_general/_home.php');
            require_once('_include/_general/_search.php'); 

        }
    ?>

    <main role="main" class="custom-container p-0 mb-md-5 text-muted" style="box-shadow: 0px 27px 70px -35px var(--gray);">
        <?php 
        
            if(isset($_GET) && !empty($_GET)){
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
    <script src="assets/js/range-slider.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script> 
    <script>
        feather.replace({'width' : 15}); 
    </script> 
</body>
</html>