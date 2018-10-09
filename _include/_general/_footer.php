<footer class="custom-container bg-white border-top text-center py-2 py-md-3">
    <div class="row">
        <div class="col-12 col-sm-4 text-md-left order-2 order-md-2">
            <small class="text-muted"> 
                © 2018 <?php echo $lang['footer']['copyright'];?>: <a href="/">LK-Properties</a>
            </small>
        </div>
        <div class="col-12 col-sm-4 text-md-center order-3 order-md-3 text-secondary">
            <small class="text-muted">
                <a href=""><?php echo $lang['footer']['privacyPolicy']['name'];?></a> <?php echo $lang['footer']['filler'];?> <a href=""><?php echo $lang['footer']['cookiePolicy']['name'];?></a>
            </small>
        </div>
        <div class="col-12 col-sm-4 text-md-right order-4 order-md-4 text-secondary">
            <small class="text-muted">
                <?php echo $lang['footer']['developerInfo'];?>: <a href="https://se.linkedin.com/in/calexandru2018/en">Alexandru Cheltuitor</a>
            </small>
        </div>
        <div class="col-12 text-center mt-3 mb-5 order-1 order-md-1">
            <div class="row">
                <div class="col-12">
                    <?php echo $lang['footer']['languages'];?>
                </div>
                <div class="col-0 col-sm-3">
                </div>
                <div class="col-6 col-sm-3 mt-2">
                    <span title="English">
                        <a href="<?php echo $GLOBALS['absPath'].queryBuilder($_SERVER['QUERY_STRING'], 'en'); ?>" data-language="en" lang="en" target ="_self">English</a>
                    </span>
                </div>
                <div class="col-6 col-sm-3 mt-2">
                    <span title="Portuguese">
                        <a href="<?php echo $GLOBALS['absPath'].queryBuilder($_SERVER['QUERY_STRING'], 'pt'); ?>" data-language="pt" lang="pt" target ="_self">Português</a>
                    </span>
                </div>
                <div class="col-0 col-sm-3">
                </div>
            </div>
        </div>
    </div>  
</footer>
<?php
    function queryBuilder($string, $lang){
        $base = explode('&', $string);
        $urlExtension = '';
        $urlVarHolder = [];
        $urlValueHolder = [];
        $counter = 0;
        
        for($c = 2; $c < count($base); $c++){
            $tempHolder = explode('=', $base[$c]);
            if(count($tempHolder) > 1){
                $urlVarHolder[] = $tempHolder[0];
                $urlValueHolder[] = $tempHolder[1];
            }
        }
        if(count($base) > 1 ){
            $showType = explode('=', $base[1]);
            switch($showType[1]){
                case 'for-rent-details': $urlExtension = '/for-rent-details/';
                    break;
                case 'for-sell-details': $urlExtension = '/for-sale-details/';
                    break;
                case 'for-sale': $urlExtension = '/for-sale';
                    break;
                case 'contact-us': $urlExtension = '/contact-us';
                    break;
                case 'activities': $urlExtension = '/activities';
                    break;
                case 'popular-poi': $urlExtension = '/popular/point-of-interest/';
                    break;
                case 'popular-city': $urlExtension = '/popular/city/';
                    break;
                case 'faq': $urlExtension = '/faq';
                    break;
                case 'filter': $urlExtension = '/filter';
                    break;
                default: $urlExtension = '';
                    break;
            }
        }
        $outputQuery = $lang.$urlExtension;

        if($urlExtension === '/filter'){
            for ($i=0; $i < count($urlValueHolder); $i++) {
                if($i == (count($urlValueHolder)-1)) 
                    $outputQuery = $outputQuery.'&'.$urlVarHolder[$i].'='.$urlValueHolder[$i];
                else if($i == 0)
                    $outputQuery = $outputQuery.'?'.$urlVarHolder[$i].'='.$urlValueHolder[$i];
                else
                    $outputQuery = $outputQuery.'&'.$urlVarHolder[$i].'='.$urlValueHolder[$i];
            }
        }else{
            for ($i=0; $i < count($urlValueHolder); $i++) {
                if($i == (count($urlValueHolder)-1)) 
                    $outputQuery = $outputQuery.$urlValueHolder[$i];
                else
                    $outputQuery = $outputQuery.$urlValueHolder[$i].'/';
            }
        }
        return $outputQuery;
    }
?>