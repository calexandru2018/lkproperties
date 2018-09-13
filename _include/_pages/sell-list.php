<?php 
    $object = new SellList($CONN->db);
?>
<div class="p-0 mx-0 pb-5 mx-sm-auto">
    <div class="row mx-0">
        <div class="col-12 my-3 px-4 px-md-2">
            <h1><?php echo $lang['realEstate']['title'];?></h1>
            <p>
                <?php echo $lang['realEstate']['info'];?>
            </p>
        </div>
    </div>
    <div class="row mx-0 mb-5">
        <div class="col-12 my-3 px-4 px-md-2">
            <div class="form-group float-right w-25 mb-0">
                <select class="form-control" id="sel1">
                    <option><?php echo $lang['sortBy']['name'];?>: <?php echo $lang['sortBy']['asc'];?></option>
                    <option><?php echo $lang['sortBy']['name'];?>: <?php echo $lang['sortBy']['desc'];?></option>
                </select>
            </div>
        </div>
        <?php
            $collector = $object->fetchAll($selectedLang);
            // var_dump($collector);
            for($c1 = 0; $c1 < count($collector); $c1++){
                echo '
                    <div class="col-12 col-sm-6 col-lg-4 my-3 px-4 px-md-2">
                        <div class="card w-100 mx-auto mx-0-md bg-light border-0">
                            <a href="?lang='.$selectedLang.'&show=for-sell-details&object='.$collector[$c1]['publicID'].'">
                                <img class="card-img-top" src="gallery/sale/'.$collector[$c1]['id'].'/thumbnail/'.$collector[$c1]['thumbnail'].'" alt="Card image cap">
                            </a>
                            <div class="card-body px-0 bg-white text-justify">
                                <h4 class="card-title">'.$collector[$c1]['title'].'</h4>
                                <h5 class="display-5">'.$lang['realEstate']['price'].' '.$collector[$c1]['price'][0].'€</h5>
                                <p class="card-text font-italic">'.$lang['generalFiller']['referenceID'].' '.$collector[$c1]['publicID'].'</p>
                                <p class="card-text">'.$collector[$c1]['description'].'</p>
                                <div class="row">
                                    <div class="col-6"><p class="card-text">Beds: '.$collector[$c1]['roomAmmount'].' <i class="fas fa-bed"></i></p></div>
                                    <div class="col-6"><p class="card-text">Guests: '.$collector[$c1]['maxAllowedGuest'].' <i class="fas fa-users"></i></p></div>
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
        ?>
<!--         <div class="col-12 col-sm-6 col-lg-4 my-3 px-4 px-md-2">
            <div class="card w-100 mx-auto mx-0-md bg-light border-0">
                <a href="?show=for-sell-details&object=777">
                    <img class="card-img-top" src="assets/img/org.jpg" alt="Card image cap">
                </a>
                <div class="card-body px-0 bg-white text-justify">
                    <h4 class="card-title">Card title</h4>
                    <!--<tr><td>Nov-Apr</td><h5 class="display-5">From 150€/night</h5></tr>-->
<!--                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul id="custom-ul" class="list-group list-group-flush d-flex flex-row flex-wrap bg-white">
                    <li class="list-group-item px-0 text-center w-50">Barbeque</li>
                    <li class="list-group-item px-0 text-center w-50">Quick beach access</li>
                    <li class="list-group-item px-0 text-center w-50">Parking</li>
                    <li class="list-group-item px-0 text-center w-50">Something else</li>
                    <li class="list-group-item px-0 text-center w-50">Test 5</li>
                </ul>
            </div>
        </div>        -->                  
    </div>
</div>