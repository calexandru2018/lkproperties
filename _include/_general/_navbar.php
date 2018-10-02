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
                                echo '<a class="dropdown-item" href="'.$GLOBALS['absPath'].$selectedLang.'/popular/point-of-interest/'.$key.'/'.specialCharCleaner($value).'">'.$value.'</a>';
                            }
                        ?>
                        <div class="dropdown-divider"></div>
                        <h5 class="dropdown-header"><?php echo $lang['navbar']['popular']['subCat2']; ?></h5>
                        <!-- Cities -->
                        <?php 
                            $allCities = fetchAllCity($CONN->db, $selectedLang);
                            // var_dump($allCities);
                            foreach((array)$allCities as $key => $value){
                                echo '<a class="dropdown-item" href="'.$GLOBALS['absPath'].$selectedLang.'/popular/city/'.$key.'/'.specialCharCleaner($value).'">'.$value.'</a>';
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
        $unwanted_array = array(    
            'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', ' '=>'-'
        );
        return strtr(str_replace(' ', '-', $string), $unwanted_array);
    }
?>