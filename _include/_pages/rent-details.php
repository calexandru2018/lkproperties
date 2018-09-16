<?php
    $new = new RentDetails($CONN->db);
    $fetched = $new->fetchRow($_GET['object'], $selectedLang);
    // var_dump($fetched);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<div class="custom-container mx-sm-auto px-4 px-md-2 pb-md-5 rounded text-muted">
    <div class="row">
        <div class="col-12">
            <img src="gallery/rental/<?php echo (($fetched['objectGallery']) ? $fetched['id'].'/fullsize/'.$fetched['objectGallery'][0]:'') ?>" class="img-fluid" alt="">
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
                        if(!empty($fetched['objectGallery'])){
                            for($i=0; $i < count($fetched['objectGallery']); $i++){
                                echo '
                                    <div class="col-4 item">
                                        <a class="lightbox" href="gallery/rental/'.$fetched['id'].'/fullsize/'.$fetched['objectGallery'][$i].'">
                                            <img class="img-fluid image scale-on-hover" src="gallery/rental/'.$fetched['id'].'/thumbnail/'.$fetched['objectGallery'][$i].'">
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
                        if(!empty($fetched['poiGallery'])){
                            for($i=0; $i < count($fetched['poiGallery']); $i++){
                                echo '
                                    <div class="col-4 item">
                                        <a class="lightbox" href="gallery/poi/'.$fetched['poiInfo']['id'].'/fullsize/'.$fetched['poiGallery'][$i].'">
                                            <img class="img-fluid image scale-on-hover" src="gallery/poi/'.$fetched['poiInfo']['id'].'/thumbnail/'.$fetched['poiGallery'][$i].'">
                                        </a>
                                    </div>
                                ';
                            }
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
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
    document.querySelector('#send-form').addEventListener('click', function(e){
        e.preventDefault();
        console.clear();
        collector = document.querySelectorAll('[name^=msg_]');
        
        let formData = new FormData();
        var errorCatcher = new Array();
        
        collector.forEach(function(el){
            var name = el.name.split('_');
            if(el.value != '' && (el.getAttribute('data-optional') == 'false' || el.getAttribute('data-optional') == false)){
                formData.append(name[1], el.value);
                console.log('Here: ', name[1], el.value, el.length);
            }else{
                console.log('There', name[1], el.value, el.length);
                errorCatcher = [name[1]]; 
            }
        });
        formData.append('publicID', document.querySelector('[name^=msg_]').closest('form').getAttribute('data-id'));
        formData.append('lang', '<?php echo $selectedLang; ?>');
        formData.append('type', document.querySelector('[name^=msg_]').closest('form').getAttribute('data-type'));
        
        console.log('Error Catcher: ', errorCatcher[0]);

        var error = document.getElementById('errorMessage');

        if((typeof errorCatcher === 'undefined' && errorCatcher.length == 0) || (errorCatcher[0] == 'date' && errorCatcher.length == 1)){
            fetch('ajax/send-mail.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if(!data){
                    clearInput(collector);
                    showSnackbar('Mensagem enviada!')
                    error.classList.remove('visible');
                    error.classList.add('invisible');
                }else{
                    showSnackbar('Houve um error')
                }
                console.log(data);
            })
            .catch(function(error){
                console.log(error);
            });
        }else{
            error.classList.remove('invisible');
        }
    });

    function clearInput(nodes){
        nodes.forEach(function(el){
            el.value = '';
        })
    }
</script>