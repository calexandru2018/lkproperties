<?php 
/* 
    type 1 -> Rent
    type 2 -> Sell
*/
    include('../_include/_models/db.php');
    include('../assets/lang/'.$_POST['lang'].'.php');

    $CONN = new Database();

    $ammountToAdd = 6;

    if((int)$_POST['type'] == 1){
        include('../_include/_models/rent-list.php');
        $object = new RentList($CONN->db);
    }
    elseif((int)$_POST['type'] == 2){
        include('../_include/_models/sell-list.php');
        $object = new SellList($CONN->db);
    }else{
        include('../_include/_models/rent-list.php');
        $object = new RentList($CONN->db);
    }

    $totalObjectQuantity = $object->getObjectsNumber();

    $collector = $object->fetchAll($_POST['lang'], $ammountToAdd, $_POST['itemCount']);
    $objectCounter = (int)$_POST['itemCount'];
    $post = '';
    for($c1 = 0; $c1 < count($collector); $c1++){
        $objectCounter++;
        if($collector[$c1]['viewType'] == 1){
            $viewType = $lang['generalFiller']['beach'];
        }elseif($collector[$c1]['viewType'] == 2){
            $viewType = $lang['generalFiller']['pool'];
        }else{
            $viewType = $lang['generalFiller']['ns'];
        }
        switch($collector[$c1]['propertyType']){
            case '0': $propertyType = $lang['generalFiller']['propertyType']['apt'];
                break;
            case '1': $propertyType = $lang['generalFiller']['propertyType']['house'];
                break;
            case '2': $propertyType = $lang['generalFiller']['propertyType']['villa'];
                break;
            case '3': $propertyType = $lang['generalFiller']['propertyType']['bungalow'];
                break;
        }
        $post = $post.'
            <div class=" col-12 col-sm-6 col-lg-4 my-3 px-4 px-md-2">
                <div class="card w-100 h-100 mx-auto mx-0-md bg-light border-0">
                    <a href="'.$_POST['path'].$_POST['lang'].'/for-rent-details/'.$collector[$c1]['publicID'].'/'.urlPurifier($collector[$c1]['title']).'">
                        <img class="card-img-top" src="gallery/rental/'.$collector[$c1]['id'].'/thumbnail/'.$collector[$c1]['thumbnail'].'" alt="A placeholder.">
                    </a>
                    <div class="card-body px-0 bg-white text-justify">
                        <h4 class="card-title">'.$collector[$c1]['title'].'</h4>
                        <h5 class="display-5">'.$lang['rentPriceHolder']['pre'].' '.$collector[$c1]['price'].'€/'.$lang['rentPriceHolder']['post'].'</h5>
                        <p class="card-text font-italic">'.$lang['generalFiller']['referenceID'].' '.$collector[$c1]['publicID'].'</p>
                        <p class="card-text">'.$collector[$c1]['description'].'</p>
                        <div class="row text-center">
                            <div class="col-4 col-sm-6 col-lg-4"><p class="card-text">'.$collector[$c1]['beachDistance'].'(m) <i class="fas fa-umbrella-beach"></i></p></div>
                            <div class="col-4 col-sm-6 col-lg-4"><p class="card-text">'.$viewType.' <i class="fas fa-eye"></i></p></div>
                            <div class="col-4 col-sm-6 col-lg-4 pt-sm-2 pt-lg-0"><p class="card-text">'.(($collector[$c1]['hasPoolAccess'] == 1) ? $lang['generalFiller']['yes'] : $lang['generalFiller']['no']).' <i class="fas fa-swimming-pool"></i></p></div>
                            <div class="col-4 col-sm-6 col-lg-4 pt-2"><p class="card-text">'.$collector[$c1]['roomAmmount'].' <i class="fas fa-bed"></i></p></div>
                            <div class="col-4 col-sm-6 col-lg-4 pt-2"><p class="card-text">'.$collector[$c1]['maxAllowedGuests'].' <i class="fas fa-users"></i></p></div>
                            <div class="col-4 col-sm-6 col-lg-4 pt-2"><p class="card-text">'.$propertyType.' <i class="fas fa-building"></i></p></div>
                        </div>
                    </div>
                    <ul id="custom-ul" class="list-group list-group-flush d-flex flex-row flex-wrap bg-white border-top">';
                    for($c2 = 0; $c2 < count($collector[$c1]['services']); $c2++){
                        $post = $post.'
                            <li class="list-group-item px-0 text-center w-50 border-0">'.$collector[$c1]['services'][$c2].'</li>
                        ';
                    }
        $post = $post.' 
                    </ul>
                </div>
            </div>';
    }
    echo $post;
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
?>