<div class="pb-5 px-3 px-sm-0">
    <div class="row mb-5">
        <div class="col-12 my-3 px-2">
            <div class="form-group float-right w-auto mb-0">
                <select name="<?php 
                    if(isset($_GET['sortSell'])){
                        $orderBy = $_GET['sortSell'];
                        echo 'search_sortSell';
                    }
                    if(isset($_GET['sortRent'])){
                        $orderBy = $_GET['sortRent'];
                        echo 'search_sortRent';
                    }
                         
                ?>" class="form-control">
                    <option value="asc" <?php echo (($orderBy == 'asc') ? 'selected':''); ?>><?php echo $lang['sortBy']['name'].': '.$lang['sortBy']['asc'];?></option>
                    <option value="desc" <?php echo (($orderBy == 'desc') ? 'selected':''); ?>><?php echo $lang['sortBy']['name'].': '.$lang['sortBy']['desc'];?></option>
                </select>
            </div>
        </div>
        <?php 
        // var_dump($_GET);
            $new = new FilterSearch($CONN->db);
            /* DEFAULT VALUES */
            if(isset($_GET) && count($_GET) > 1 && $_GET['show'] === 'filter'){
                $collector = $new->fetchAll($_GET, $selectedLang);
                // print_r($collector);
                if($collector != false || !empty($collector)){
                    for($c1 = 0; $c1 < count($collector); $c1++){
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
                        echo '
                            <div class="col-12 col-sm-6 col-lg-4 my-3 px-2">
                                <div class="card w-100 h-100 mx-auto mx-0-md bg-light border-0">
                                    <a href="'.$GLOBALS['absPath'].$selectedLang.'/'.(($collector[$c1]['forSale'] == 1) ? 'for-sell-details':'for-rent-details').'/'.$collector[$c1]['publicID'].'/'.urlPurifier($collector[$c1]['title']).'">
                                        <img class="card-img-top" src="'.$GLOBALS['absPath'].'gallery/'.(($collector[$c1]['forSale'] == 1) ? 'sale':'rental').'/'.$collector[$c1]['id'].'/thumbnail/'.$collector[$c1]['thumbnail'].'" alt="Card image cap">
                                    </a>
                                    <div class="card-body px-0 bg-white text-justify">
                                        <h4 class="card-title">'.$collector[$c1]['title'].'</h4>
                                        '.(($collector[$c1]['forSale'] == 0) ? '<h5 class="display-5">'.$lang['rentPriceHolder']['pre'].' '.$collector[$c1]['price'].'€/'.$lang['rentPriceHolder']['post'].'</h5>':'<h5 class="display-5">'.$lang['realEstate']['price'].' '.$collector[$c1]['price'].'€</h5>').'
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
                                        echo '
                                            <li class="list-group-item px-0 text-center w-50 border-0">'.$collector[$c1]['services'][$c2].'</li>
                                        ';
                                    }
                        echo ' 
                                    </ul>
                                </div>
                            </div>';
                    }
                }else{
                    echo '<div class="container-fluid mt-5 mb-3 text-center"><h2>'.$lang['searchbar']['noResults'].'</h2></div>';
                }
            }
        ?>
    </div>
</div>