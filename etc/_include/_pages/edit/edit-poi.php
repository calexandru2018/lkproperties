<?php
    include_once('_include/_models/poi.php');
    $poi = new Poi($MAIN->db);
    $poiData = $poi->fetchPoi($_GET['id']);
    $canEdit = $poi->showEditPage($_GET["edit"], $_GET["id"], empty($poiData));
    var_dump($poiData);
    if($canEdit === 1)
    {
?>
    <h3 class="page-title">Editar POI:  <?php echo $poiData['pt']['nameTranslated']; ?></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Nome
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nome(PT)</span>
                        <input type="text" name="poiName-PT" class="form-control" value="<?php echo $poiData['pt']['nameTranslated'];?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nome(EN)</span>
                        <input type="text" name="poiName-EN" class="form-control" value="<?php echo $poiData['en']['nameTranslated'];?>">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="poi-saveName">Guardar Alteração</button>
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
                    <span class="input-group-addon" >Descrição(PT)</span>
                    <textarea name="poiDesc-PT" id="poiDescPT" class="form-control" rows="4"></textarea>
                    <div id="poiDescPTHolder" style="visibility: hidden"><?php echo $poiData['pt']['descriptionTranslated'];?></div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <span class="input-group-addon" >Descrição(EN)</span>
                    <textarea name="poiDesc-EN" id="poiDescEN" class="form-control" rows="4"></textarea>
                    <div id="poiDescENHolder" style="visibility: hidden"><?php echo $poiData['en']['descriptionTranslated'];?></div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button  type="button" class="btn btn-success pull-right save" id="poi-saveDesc">Guardar Alteração</button>
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
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Cidade</span>
                        <select class="city-selector bg-white" name="poiCityName" style="width: 100%;">
                        <?php
                            $queryResult = $MAIN->db->query('
                                select 
                                    *
                                from 
                                    city_link
                                left join 
                                    city_translation 
                                on
                                    city_link.city_link_ID = city_translation.city_link_ID
                                where
                                    langCode = "pt"
                            ');
                            while($r=$queryResult->fetch_object()){
                                echo '
                                    <option value="'. $poiData['pt']['city_poi_link_ID'].'-'.$r->city_link_ID.'"'.(($poiData['pt']['city_link_ID'] == $r->city_link_ID) ? 'selected="selected"':'').'>'.$r->nameTranslated.'</option>
                                ';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 2%">
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="poiIsPopular" value="1" <?php echo (($poiData['pt']['isPopular'] == 1) ? 'checked="check"':'')?>><span>Destacar como "Popular"</span>
                    </label>
                </div>
                <div class="col-xs-6" style="margin-top: 2%">
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="poiIsAlgarve" value="1" <?php echo (($poiData['pt']['isAlgarve'] == 1) ? 'checked="check"':'')?>><span>Algarve</span>
                    </label>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="poi-saveOther">Guardar Alteração</button>
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
                    $resp = $poi->fetchAllPoiPhotos($_GET['id']);
                    if(!empty($resp)){
                        for($photoCounter = 0; $photoCounter < count($resp); $photoCounter++){
                            echo '
                                <div class="col-xs-4 item" style="margin: 5px 0">
                                    <a class="lightbox" href="../assets/img/gallery/poi/'.$_GET['id'].'/fullsize/'.$resp[$photoCounter]->fullsizeURL.'">
                                        <img class="img-responsive image scale-on-hover" src="../assets/img/gallery/poi/'.$_GET['id'].'/thumbnail/'.$resp[$photoCounter]->fullsizeURL.'"g">
                                    </a>
                                    <button class="btn btn-danger delete-photo" data-content-type="poi" data-content-id="'.$_GET['id'].'-'.$resp[$photoCounter]->poi_gallery_ID.'"  style="position: absolute;z-index: 1;top: 0;">
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
            CKEDITOR.replace( 'poiDescPT' );
            CKEDITOR.replace( 'poiDescEN' );
            var descPT = document.querySelector('#poiDescPTHolder').innerHTML;
            var descEN = document.querySelector('#poiDescENHolder').innerHTML;
            CKEDITOR.instances['poiDescPT'].setData(descPT) ;
            CKEDITOR.instances['poiDescEN'].setData(descEN) ;
            $('.city-selector').select2();
        });
    </script>
<?php }?>