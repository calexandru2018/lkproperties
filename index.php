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
    <script>
    function sendEmail(){
        console.clear();
        collector = document.querySelectorAll('[name^=msg_]');
        
        let formData = new FormData();
        var errorCatcher = new Array();
        
        collector.forEach(function(el){
            var name = el.name.split('_');
            if(el.value != '' && (el.getAttribute('data-optional') == 'false' || el.getAttribute('data-optional') == false)){
                if(name[1] == 'email' && validateEmail(el.value) == false)
                    errorCatcher.push(name[1]);
                
                formData.append(name[1], el.value);
                console.log('Here: ', name[1], el.value, el.length);
            }else{
                console.log('There', name[1], el.value, el.length);
                errorCatcher.push(name[1]); 
            }
        });
        formData.append('publicID', document.querySelector('[name^=msg_]').closest('form').getAttribute('data-id'));
        formData.append('lang', '<?php echo $selectedLang; ?>');
        formData.append('type', document.querySelector('[name^=msg_]').closest('form').getAttribute('data-type'));
        console.log('Error Catcher: ', errorCatcher);
        var error = document.getElementById('errorMessage');
        if((typeof errorCatcher === 'undefined' && errorCatcher.length == 0) || (errorCatcher[0] == 'date' && errorCatcher.length == 1)){
            fetch('ajax/send-mail.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if(!data){
                    clearInput(collector);
                    showSnackbar('Mensagem enviada!')
                    error.classList.remove('visible');
                    error.classList.add('invisible');
                }
                console.log(data);
            })
            .catch(function(error){
                console.log(error);
            });
        }else{
            error.classList.remove('invisible');
        }
    }

    //Input Cleaner
    function clearInput(nodes){
        nodes.forEach(function(el){
            el.value = '';
        })
    }
    //Email validator
    function validateEmail(email){
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    //Snackbar
    function showSnackbar(message) {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");
        x.innerHTML = message;
        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
    </script>
    <script src="assets/js/bootstrap.min.js"></script> 
</body>
</html>
<?php
    mysqli_close($CONN->db);
?>
