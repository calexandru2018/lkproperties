<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="alternate" hreflang="en" href="https://lk-properties.pt/en" />
    <link rel="alternate" hreflang="pt" href="https://lk-properties.pt/pt" />
    <link rel="alternate" href="http://example.com/en" hreflang="x-default" />

    <link rel="preload" href="<?php echo $GLOBALS['absPath']; ?>assets/css/bootstrap-reboot.css" as="style">
    <link rel="preload" href="<?php echo $GLOBALS['absPath']; ?>assets/css/bootstrap.css" as="style">
    <link rel="preload" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" as="style" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" as="style" crossorigin>
    <link rel="preload" href="https://code.jquery.com/jquery-3.3.1.slim.min.js" as="script" crossorigin>
    <link rel="prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" as="style">
    <link rel="prefetch" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"" as="style">

    <link rel="stylesheet" href="<?php echo $GLOBALS['absPath']; ?>assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="<?php echo $GLOBALS['absPath']; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' type='text/css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<?php
    if((isset($_GET['lang']) && (count($_GET) == 1)) || (!isset($_GET['lang']) && (count($_GET) == 0))){
        $headVar = 'index';
    }elseif(isset($_GET['show']) && $_GET['show'] == 'popular-poi'){
        $headVar = 'popular-poi';
    }elseif(isset($_GET['show']) && $_GET['show'] == 'popular-city'){
        $headVar = 'popular-city';
    }elseif(isset($_GET['show']) && $_GET['show'] == 'activities'){
        $headVar = 'activity';
    }elseif(isset($_GET['show']) && $_GET['show'] == 'faq'){
        $headVar = 'faq';
    }elseif(isset($_GET['show']) && $_GET['show'] == 'for-sale'){
        $headVar = 'for-sale';
    }elseif(isset($_GET['show']) && $_GET['show'] == 'contact-us'){
        $headVar = 'contact-us';
    }else{
        $headVar = 'index';
    }
?>
    <title>LK Properties - <?php echo $lang['head'][$headVar]['title'] ;?></title>
    <meta name="description" content="<?php echo $lang['head'][$headVar]['description'] ;?>"/>
</head>
