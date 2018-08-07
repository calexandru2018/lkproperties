<?php
    include_once('_include/_models/city.php');
    $city = new City($MAIN->db);
    $cityData = $city->fetchCity($_GET['id']);
    $canEdit = $city->showEditPage($_GET["edit"], $_GET["id"], empty($cityData));
    if($canEdit === 1)
    {
?>
    <h3 class="page-title">Editar Cidade: <?php echo utf8_encode($cityData['pt']['nameTranslated']); ?></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Nome
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Nome(PT)</span>
                        <input type="text" name="cityName-PT" class="form-control" value="<?php echo utf8_encode($cityData['pt']['nameTranslated']);?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Nome(EN)</span>
                        <input type="text" name="cityName-EN" class="form-control" value="<?php echo utf8_encode($cityData['en']['nameTranslated']);?>">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="city-saveName">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Descrição
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <span class="input-group-addon" id="basic-addon1">Descrição(PT)</span>
                    <textarea name="cityDesc-PT" class="form-control" id="cityDescPT" rows="4"></textarea>
                    <div id="cityDescPTHolder" style="visibility: hidden"><?php echo utf8_encode($cityData['pt']['descriptionTranslated']);?></div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                    <textarea name="cityDesc-EN" class="form-control" id="cityDescEN" rows="4"></textarea>
                    <div id="cityDescENHolder" style="visibility: hidden"><?php echo utf8_encode($cityData['en']['descriptionTranslated']);?></div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="city-saveDesc">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Outro
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Código Postal</span>
                        <input type="text" name="postalCode" class="form-control" value="<?php echo $cityData['pt']['postalCode'];?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Video(URL opcional)</span>
                        <input type="text" name="cityVideoURL" class="form-control" placeholder="https://..." value="<?php echo $cityData['pt']['videoURL'];?>">
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 2%">
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="cityIsPopular" value="1" <?php echo (($cityData['pt']['isPopular'] == 1) ? 'checked="check"':'')?>><span>Destacar como "Popular"</span>
                    </label>
                </div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="city-saveOther">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Galeria
        </div>
        <div class="panel-body">
            <section class="gallery-block grid-gallery">
                <div class="row" id="rowGallery">
                    <?php
                        $resp = $city->fetchAllCityPhotos($_GET['id']);
                        if(!empty($resp)){
                            for($photoCounter = 0; $photoCounter < count($resp); $photoCounter++){
                                echo '
                                    <div class="col-xs-4 item" style="margin: 5px 0">
                                        <a class="lightbox" href="../assets/img/gallery/city/'.$_GET['id'].'/fullsize/'.$resp[$photoCounter]->fullsizeURL.'">
                                            <img class="img-responsive image scale-on-hover" src="../assets/img/gallery/city/'.$_GET['id'].'/thumbnail/'.$resp[$photoCounter]->fullsizeURL.'"g">
                                        </a>
                                        <button class="btn btn-danger delete-photo" data-content-type="city" data-content-id="'.$_GET['id'].'-'.$resp[$photoCounter]->city_gallery_ID.'"  style="position: absolute;z-index: 1;top: 0;">
                                            <i class="lnr lnr-trash"></i>
                                        </button>
                                    </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </section>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            baguetteBox.run('.gallery-block');
            CKEDITOR.replace( 'cityDescPT' );
            CKEDITOR.replace( 'cityDescEN' );
            var descPT = document.querySelector('#cityDescPTHolder').innerHTML;
            var descEN = document.querySelector('#cityDescENHolder').innerHTML;
            CKEDITOR.instances['cityDescPT'].setData(descPT) ;
            CKEDITOR.instances['cityDescEN'].setData(descEN) ;
        });
    </script>
<?php } ?>