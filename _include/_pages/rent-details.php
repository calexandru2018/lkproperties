<?php
    $new = new RentDetails($CONN->db);
    // var_dump($_GET);
    $fetched = $new->fetchRow($_GET['id'], $selectedLang);

    if($fetched['viewType'] == 1){
        $viewType = $lang['generalFiller']['beach'];
    }elseif($fetched['viewType'] == 2){
        $viewType = $lang['generalFiller']['pool'];
    }else{
        $viewType = $lang['generalFiller']['ns'];
    }
    switch($fetched['propertyType']){
        case '0': $propertyType = $lang['generalFiller']['propertyType']['apt'];
            break;
        case '1': $propertyType = $lang['generalFiller']['propertyType']['house'];
            break;
        case '2': $propertyType = $lang['generalFiller']['propertyType']['villa'];
            break;
        case '3': $propertyType = $lang['generalFiller']['propertyType']['bungalow'];
            break;
    }
?>
<div class="custom-container mx-sm-auto px-4 px-md-2 pb-md-5 rounded text-muted">
    <div class="row mt-1">
        <div class="col-12">
            <img src="<?php echo $GLOBALS['absPath']; ?>gallery/rental/<?php echo (($fetched['objectGallery']) ? $fetched['id'].'/fullsize/'.$fetched['objectGallery'][0]:'') ?>" class="img-fluid rounded" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="col-12 my-2 px-0">
                <h2 class="pt-2"><?php echo $fetched['title']; ?></h2>
            </div>
            <div class="col-12 my-2 px-0">
                <p class="font-italic"><?php echo $lang['generalFiller']['referenceID'].' '.$fetched['publicID']; ?></p>
            </div>
            <div class="col-12 px-0 text-justify">
                <?php echo $fetched['description']; ?>
            </div>
            <div class="col-12 px-0 text-justify">
                <div class="row text-center">
                    <div class="col-4 col-sm-6 col-lg-4"><p class="card-text"><?php echo $fetched['beachDistance']; ?>(m) <i class="fas fa-umbrella-beach"></i></p></div>
                    <div class="col-4 col-sm-6 col-lg-4"><p class="card-text"><?php echo $viewType; ?> <i class="fas fa-eye"></i></p></div>
                    <div class="col-4 col-sm-6 col-lg-4 pt-sm-2 pt-lg-0"><p class="card-text"><?php echo (($fetched['hasPoolAccess'] == 1) ? $lang['generalFiller']['yes'] : $lang['generalFiller']['no']); ?> <i class="fas fa-swimming-pool"></i></p></div>
                    <div class="col-4 col-sm-6 col-lg-4 pt-2"><p class="card-text"><?php echo $fetched['roomAmmount']; ?> <i class="fas fa-bed"></i></p></div>
                    <div class="col-4 col-sm-6 col-lg-4 pt-2"><p class="card-text"><?php echo $fetched['maxAllowedGuests']; ?> <i class="fas fa-users"></i></p></div>
                    <div class="col-4 col-sm-6 col-lg-4 pt-2"><p class="card-text"><?php echo $propertyType; ?> <i class="fas fa-building"></i></p></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 my-2">
            <h2 class="py-2"><?php echo $lang['rentDetails']['services']; ?></h2>
            <ul id="custom-ul" class="list-group list-group-flush d-flex flex-row flex-wrap bg-white">
                <?php 
                    if(!empty($fetched['servicesUnique'])){
                        for($i=0; $i < count($fetched['servicesUnique']); $i++){ 
                            echo '<li class="list-group-item px-0 text-center w-50 border-bottom-0">'.$fetched['servicesUnique'][$i].'</li>';
                        }
                    }
                    if(!empty($fetched['servicesCommon'])){
                        for($i=0; $i < count($fetched['servicesCommon']); $i++){ 
                            echo '<li class="list-group-item px-0 text-center w-50 border-bottom-0">'.$fetched['servicesCommon'][$i].'</li>';
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <h4 class="py-2"><?php echo $lang['rentDetails']['galleryApt']; ?></h4>
            <section class="gallery-block grid-gallery py-0">
                <div class="row">
                    <?php
                        if($fetched['objectGallery'][0] != 'null'){
                            for($i=0; $i < count($fetched['objectGallery']); $i++){
                                echo '
                                    <div class="col-4 item">
                                        <a class="lightbox" href="'.$GLOBALS['absPath'].'gallery/rental/'.$fetched['id'].'/fullsize/'.$fetched['objectGallery'][$i].'">
                                            <img class="img-fluid image rounded scale-on-hover" src="'.$GLOBALS['absPath'].'gallery/rental/'.$fetched['id'].'/thumbnail/'.$fetched['objectGallery'][$i].'">
                                        </a>
                                    </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </section>
        </div>
        <div class="col-12 col-md-6">
            <h4 class="py-2"><?php echo $lang['rentDetails']['galleryNearby'].' '.$fetched['poiInfo']['name']; ?></h4>
            <section class="gallery-block grid-gallery py-0">
                <div class="row">
                    <?php
                        if(!$fetched['poiGallery'][0] != 'null'){
                            for($i=0; $i < count($fetched['poiGallery']); $i++){
                                echo '
                                    <div class="col-4 item">
                                        <a class="lightbox" href="'.$GLOBALS['absPath'].'gallery/poi/'.$fetched['poiInfo']['id'].'/fullsize/'.$fetched['poiGallery'][$i].'">
                                            <img class="img-fluid image rounded scale-on-hover" src="'.$GLOBALS['absPath'].'gallery/poi/'.$fetched['poiInfo']['id'].'/thumbnail/'.$fetched['poiGallery'][$i].'">
                                        </a>
                                    </div>
                                ';
                            }
                        }else{
                            echo '<div class="col">'.$lang['generalFiller']['noPhoto'].'</div>';
                        }
                    ?>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <h4 class="py-2"><?php echo $lang['rentDetails']['pricingTable']['name']; ?></h4>
            <table class="table table-hover">
                <thead>
                    <th><?php echo $lang['rentDetails']['pricingTable']['period']; ?></th>
                    <th><?php echo $lang['rentDetails']['pricingTable']['price']; ?></th>
                </thead>
                <tbody>
                    <?php 
                        for($i=0; $i < count($fetched['priceList']); $i++){
                            echo '
                                <tr>
                                    <td>'.$lang['rentDetails']['pricingTable']['months'][$i].'</td>
                                    <td>'.$fetched['priceList'][$i].'€</td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-12 col-md-6">
            <h4 class="pt-2 pb-3 border-bottom"><?php echo $lang['rentDetails']['checkAvailability']; ?></h4>
            <form data-type="1" data-id="<?php echo $fetched['publicID']; ?>">
                <div class="form-row rounded">
                    <div class="col-12 py-2">
                        <label for="textArea">*<?php echo $lang['contactUs']['describe']; ?></label>
                        <textarea class="form-control" id="textArea" name="msg_description" rows="3" data-optional="false"></textarea>
                    </div>
                    <div class="col-12 py-2">
                            <label for="subject">*<?php echo $lang['contactUs']['subject']; ?></label>
                            <input type="text" class="form-control" name="msg_subject" id="subject" data-optional="false">
                    </div>
                    <div class="col-12 py-2">
                            <label for="subject"><?php echo $lang['contactUs']['date']; ?>(<?php echo $lang['placeHolder']['optional']; ?>)</label>
                            <input type="date" class="form-control bg-white" name="msg_date" id="date" data-optional="true">
                    </div>
                    <div class="col-12 col-sm-6 pb-2 py-sm-0">
                        <label for="name">*<?php echo $lang['contactUs']['name']; ?></label>
                        <input type="text" class="form-control" name="msg_name" placeholder="<?php echo $lang['placeHolder']['name']; ?>" data-optional="false">
                    </div>
                    <div class="col-12 col-sm-6 py-2 py-sm-0">
                        <label for="exampleInputEmail1">*<?php echo $lang['contactUs']['email']; ?></label>
                        <input type="email" class="form-control" name="msg_email" aria-describedby="emailHelp" placeholder="<?php echo $lang['placeHolder']['email']; ?>" data-optional="false">
                        <small id="emailHelp" class="form-text text-white">*<?php echo $lang['contactUs']['infoSharing']; ?></small>
                    </div>
                    <div class="col-12 py-2">
                        <p class="p-0 small float-left invisible text-danger" id="errorMessage"><?php echo $lang['contactUs']['obligatory']; ?></p>
                        <button class="btn btn-info float-right" id="send-form"><?php echo $lang['placeHolder']['sendQuestion']; ?></button>
                        <div class="cssload-container float-right mt-3 invisible">
                            <div class="cssload-whirlpool ml-3"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    baguetteBox.run('.gallery-block');
    flatpickr('#date', {
        mode: 'range',
        onChange: function(selectedDates, dateStr, instance) {
            console.log(document.querySelector('#date').value);
        }
    });
    /* Send email */
    document.getElementById('send-form').onclick = function(e){
        e.preventDefault();
        sendEmail(this, '<?php echo $lang['generalFiller']['messageSent']; ?>');
    };
</script>