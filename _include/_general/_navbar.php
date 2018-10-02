<nav class="navbar custom-container navbar-expand-md px-md-2 navbar-light ">
    <div class="container-fluid border-bottom pb-2 mx-2 mx-md-0 px-md-2">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand mr-0" href="<?php echo $GLOBALS['absPath'].$selectedLang; ?>">
            <img src="<?php echo $GLOBALS['absPath']; ?>favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="">
            LK Properties
        </a>
        <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if(isset($_GET) && count($_GET) == 1) echo 'active'; ?>">
                    <a class="nav-link nav-hover" href="<?php echo $GLOBALS['absPath'].$selectedLang; ?>"><?php echo $lang['navbar']['home']; ?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown <?php if(isset($_GET['show']) && ($_GET['show'] == 'popular-city' || $_GET['show'] == 'popular-poi')) echo 'active';?>">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Popular</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <!-- <div class="dropdown-divider"></div> -->
                        <h5 class="dropdown-header"><?php echo $lang['navbar']['popular']['subCat1']; ?></h5>
                        <!-- Point of Interest -->
                        <?php 
                            $allPoi = fetchAllPoi($CONN->db, $selectedLang);
                            foreach((array)$allPoi as $key => $value){
                                echo '<a class="dropdown-item" href="'.$GLOBALS['absPath'].$selectedLang.'/popular/point-of-interest/'.$key.'/'.urlencode(str_replace(' ', '-', $value)).'">'.$value.'</a>';
                            }
                        ?>
                        <div class="dropdown-divider"></div>
                        <h5 class="dropdown-header"><?php echo $lang['navbar']['popular']['subCat2']; ?></h5>
                        <!-- Cities -->
                        <?php 
                            $allCities = fetchAllCity($CONN->db, $selectedLang);
                            // var_dump($allCities);
                            foreach((array)$allCities as $key => $value){
                                echo '<a class="dropdown-item" href="'.$GLOBALS['absPath'].$selectedLang.'/popular/city/'.$key.'/'.specialCharCleaner($value).'-'.$value.'">'.$value.'</a>';
                            }
                        ?>
                    </div>
                </li>
                <li class="nav-item <?php if(isset($_GET['show']) && $_GET['show'] == 'activities' ) echo 'active';?>">
                    <a class="nav-link" href="<?php echo $GLOBALS['absPath'].$selectedLang;?>/activities"><?php echo $lang['navbar']['activities']; ?></a>
                    <!-- <a class="nav-link" href="?lang=<?php //echo $selectedLang; ?>&show=activities"><?php //echo $lang['navbar']['activities']; ?></a> -->
                </li>
                <li class="nav-item <?php if(isset($_GET['show']) && $_GET['show'] == 'faq' ) echo 'active';?>">
                    <a class="nav-link" href="<?php echo $GLOBALS['absPath'].$selectedLang;?>/faq"><?php echo $lang['navbar']['faq']; ?></a>
                </li>
                <li class="nav-item <?php if(isset($_GET['show']) && $_GET['show'] == 'for-sale' ) echo 'active';?>">
                    <a class="nav-link" href="<?php echo $GLOBALS['absPath'].$selectedLang;?>/for-sale"><?php echo $lang['navbar']['realEstate']; ?></a>
                </li>
                <li class="nav-item <?php if(isset($_GET['show']) && $_GET['show'] == 'contact-us' ) echo 'active';?>">
                    <a class="nav-link" href="<?php echo $GLOBALS['absPath'].$selectedLang;?>/contact-us"><?php echo $lang['navbar']['contactUs']; ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
    function fetchAllPoi($dbConn, $langSelector){
        $queryPoi = $dbConn->query('
            select 
                poi_translation.poi_link_ID,
                poi_translation.nameTranslated
            from
                poi_link
            left join
                poi_translation
            on
                poi_link.poi_link_ID = poi_translation.poi_link_ID
            where 
                poi_link.isPopular = 1 
            and 
                poi_translation.langCode = "'.$langSelector.'"
        ');
        while($r = $queryPoi->fetch_object()){
            $output[$r->poi_link_ID] = $r->nameTranslated;
        }
        return $output;
    }
    function fetchAllCity($dbConn, $langSelector){
        $queryCity = $dbConn->query('
            select 
                city_translation.city_link_ID,
                city_translation.nameTranslated
            from
                city_link
            left join
                city_translation
            on
                city_link.city_link_ID = city_translation.city_link_ID
            where 
                city_link.isPopular = 1 
            and 
                city_translation.langCode = "'.$langSelector.'"
        ');
        while($r = $queryCity->fetch_object()){
            $output[$r->city_link_ID] = $r->nameTranslated;
        }
        return $output;
    }
    function specialCharCleaner($string){
        $cheatSheet = [
            'ç' => 'c',
            'ã' => 'a',
            'â' => 'a',
            'á' => 'a',
            'à' => 'a',
            'õ' => 'o',
            'ó' => 'o',
            'ò' => 'o',
            'ô' => 'o',
            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            ' ' => '-'
        ];
        for($c = 0; $c < strlen($string); $c++){
            // echo $string[$c].'-';
            foreach($cheatSheet as $key => $value){
                echo $key.'-'.$string[$c];
                if(strcmp($key, $string[$c]) == 0){
                    echo '1';
                    $string[$c] = $value;
                    break;
                }else{
                    echo '2';
                }
            }
        }
        return $string;
    }
?>