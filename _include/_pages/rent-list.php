<?php 
    $object = new RentList($CONN->db);
?>
<div class="p-0 mx-0 pb-5 mx-sm-auto">
    <div class="row mx-0 mb-5">
        <div class="col-12 my-3 px-4 px-md-2">
            <div class="form-group float-right w-25 mb-0">
                <select name="search_sortRent" class="form-control" id="sel1">
                    <option value="asc"><?php echo $lang['sortBy']['name'];?>: <?php echo $lang['sortBy']['asc'];?></option>
                    <option value="desc"><?php echo $lang['sortBy']['name'];?>: <?php echo $lang['sortBy']['desc'];?></option>
                </select>
            </div>
        </div>
        <?php
            $collector = $object->fetchAll($selectedLang);
            for($c1 = 0; $c1 < count($collector); $c1++){
                echo '
                    <div class="col-12 col-sm-6 col-lg-4 my-3 px-4 px-md-2">
                        <div class="card w-100 mx-auto mx-0-md bg-light border-0">
                            <a href="?lang='.$selectedLang.'&show=for-rent-details&object='.$collector[$c1]['publicID'].'">
                                <img class="card-img-top" src="gallery/rental/'.$collector[$c1]['id'].'/thumbnail/'.$collector[$c1]['thumbnail'].'" alt="A placeholder.">
                            </a>
                            <div class="card-body px-0 bg-white text-justify">
                                <h4 class="card-title">'.$collector[$c1]['title'].'</h4>
                                <h5 class="display-5">'.$lang['rentPriceHolder']['pre'].' '.$collector[$c1]['price'].'€/'.$lang['rentPriceHolder']['post'].'</h5>
                                <p class="card-text font-italic">'.$lang['generalFiller']['referenceID'].' '.$collector[$c1]['publicID'].'</p>
                                <p class="card-text">'.$collector[$c1]['description'].'</p>
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
    </div>
</div>
