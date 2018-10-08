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
        <div class="col-12 text-center mb-5 order-1 order-md-1">
            <div class="row">
                <div class="col-12">
                    <?php echo $lang['footer']['languages'];?>
                </div>
                <div class="col-3">
                </div>
                <div class="col-3">
                    <span title="English">
                        <a href="<?php echo $GLOBALS['absPath'].queryBuilder($_SERVER['QUERY_STRING'], 'en'); ?>" data-language="en" lang="en" target ="_self">English</a>
                    </span>
                </div>
                <div class="col-3">
                    <span title="Portuguese">
                        <a href="<?php echo $GLOBALS['absPath'].queryBuilder($_SERVER['QUERY_STRING'], 'pt'); ?>" data-language="pt" lang="pt" target ="_self">Português</a>
                    </span>
                </div>
                <div class="col-3">
                </div>
<!--                 <div class="col-3">
                </div>
                <div class="col-3">
                    <a href="?lang=fr">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAYAAAB24g05AAAB5UlEQVQoU11Sv2uUQRB9G9ET1IOYi94dEVGw0EJJlUBIoniFv4hGCRZaGIRIECJyQhQOlUDgJKIQNYiijaKFf4GFlYWFWEhqhTQplKjHneHb3dkZmf3yHZKF4W2x7817s2OqTxYF/x0mxtRIHiEEWGsjEhGMMdhb6QW3ALIAAWAARgVGh8pRQljALOjbvw0iqa4iM0fc+Po5hDzYOYj3WLk5syYwWEZz1SOE9PHAgc2RkJG1uzrJL8yBnYU4C3QV8LNWh6k+WpQzgyU0/noE5ihy5NCWtu1MRGPk52fB1kHIwmzvxo+ZBzDXHn6V0eESGq3UAXFApTeNICrI6kSFA7bO3Y7d2XmYQjeW649hJu99kbGjPfjTdPBKIMHJ/s4YRUtPdt90twrxLs7A7Chi+f5TmMuzn+V8ZRd+Ny0oMIgYpwe62iR1ot0Vc7UpBB2g8+jYWcTS/EuYC3c+ycVju/GrYeFVwAecHSq0J6/kzEHu1tU0gvfoKJaxtPAK5tz0R7l0ag9WGhZEAZ4YY4dTgfWVuzGRfqP32FDqwfdnb2COX/8gEyP71vLr0ghO9He2vzDbAcVcvQYmgoS0vr14BzN85b2sJoQkcVBsJQ5vp0twzsEnCVwI8Z4kCQ6Oj8fty7ZQB/wPRpt9H0JFi4QAAAAASUVORK5CYII=" alt="Francois" />
                    </a>
                </div>
                <div class="col-3">
                    <a href="?lang=it">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAYAAAB24g05AAABv0lEQVQoU22Sz0uUQRjHP7MkRKiHWjtIP0jqD+jgpYO0mmUUeOxciAchlsoUeyEp2aQOgQR5EAy8CHUQuuylS4cuHYKgs27anrLsXbWWd56ZJ96ZNKJ94MsM8+MzzzzP1zCH0iSGBwTqI3UKFOKS91HSpNh/Bu/BZ390EAwVNBlM/h5WT6W3gjE5QFHVsKde0BcjqNo4d5adm68xPEaT0j2+7NZx3uGcY75vno62jnB5X79SdO4qqhlqLebIcRq3qhhm0anSFBu7G4h3iFgWzi+0Bjy9hLosZGEOnyAdfxMBE6UJ1nfWESeICIulxRaAH+iTAdRnqLeY4kkak28xzKC3B+7websWAU5Y6l9qDZjti18Qi+k6RZq8wzCNlgfL1LZrZC4LGSxfWP4f8HMLfXRu/wuFYg9b999jSNCxoTHW0rXwupWMlxdf0dnW+W8Rc8DDXhQLTjBdPWw++IBhEh29PMpquop1FiuWlaGVFoDv6PTZCPAOc/Q032Y+Yiij14dvIN4GgEjexue0H2iP/d9rZd7GZ8MoDpwDdXytfMJwF6URHRgc2YTqeJXuQ93BgXlNwrhZ49iVa8GsufbiN1SBWvqjgHUUAAAAAElFTkSuQmCC" alt="Italiano" />
                    </a>
                </div>
                <div class="col-3">
                </div> -->
            </div>
        </div>
    </div>  
</footer>
<?php 
$base = explode('&', $_SERVER['QUERY_STRING']);

    function queryBuilder($string, $lang){
        $base = explode('&', $_SERVER['QUERY_STRING']);
        $urlExtension = '';
        $urlVarHolder = [];
        $urlValueHolder = [];
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
                case 'for-rent-details': $urlExtension = '/for-rent/';
                    break;
                case 'for-sell-details': $urlExtension = '/for-sale/';
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
        for ($i=0; $i < count($urlValueHolder); $i++) {
            if($i == (count($urlValueHolder)-1)) 
                $outputQuery = $outputQuery.'&'.$urlVarHolder[$i].'='.$urlValueHolder[$i];
            else if($i == 0)
                $outputQuery = $outputQuery.'?'.$urlVarHolder[$i].'='.$urlValueHolder[$i];
            else
                $outputQuery = $outputQuery.'&'.$urlVarHolder[$i].'='.$urlValueHolder[$i];
        }
        return $outputQuery;
    }
?>