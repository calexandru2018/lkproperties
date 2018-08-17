<?php
    include_once('_include/_models/activity.php');
    $activity = new Activity($MAIN->db);
    $activityData = $activity->fetchActivity($_GET['id']);
    var_dump($activityData);
    $canEdit = $activity->showEditPage($_GET["edit"], $_GET["id"], empty($activityData));
    if($canEdit === 1)
    {
?>
    <h3 class="page-title">Editar Actividade: <?php echo $activityData['pt']['nameTranslated']; ?></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Nome
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nome(PT)</span>
                        <input type="text" name="activityName-PT" class="form-control" value="<?php echo $activityData['pt']['nameTranslated'];?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nome(EN)</span>
                        <input type="text" name="activityName-EN" class="form-control" value="<?php echo $activityData['en']['nameTranslated'];?>">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="activity-saveName">Guardar Alteração</button>
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
                    <textarea name="activityDesc-PT" id="activityDescPT" class="form-control" rows="4"></textarea>
                    <div id="activityDescPTHolder" style="visibility: hidden"><?php echo $activityData['pt']['descriptionTranslated'];?></div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <span class="input-group-addon" >Descrição(EN)</span>
                    <textarea name="activityDesc-EN" id="activityDescEN" class="form-control" rows="4"></textarea>
                    <div id="activityDescENHolder" style="visibility: hidden"><?php echo $activityData['en']['descriptionTranslated'];?></div>
               </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button  type="button" class="btn btn-success pull-right save" id="activity-saveDesc">Guardar Alteração</button>
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
                        <select class="js-example-basic-multiple bg-white" name="activityCityName" style="width: 100%;">
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
                                    <option value="'.$r->city_link_ID.'"'.(($activityData['pt']['city_link_ID'] == $r->city_link_ID) ? 'selected="selected"':'').'>'.$r->nameTranslated.'</option>
                                ';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button  type="button" class="btn btn-success pull-right save" id="activity-saveOther">Guardar Alteração</button>
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
                    $resp = $activity->fetchAllActivityPhotos($_GET['id']);
                    if(!empty($resp)){
                        for($photoCounter = 0; $photoCounter < count($resp); $photoCounter++){
                            echo '
                                <div class="col-xs-4 item" style="margin: 5px 0">
                                    <a class="lightbox" href="../gallery/activity/'.$_GET['id'].'/fullsize/'.$resp[$photoCounter]->fullsizeURL.'">
                                        <img class="img-responsive image scale-on-hover" src="../gallery/activity/'.$_GET['id'].'/thumbnail/'.$resp[$photoCounter]->fullsizeURL.'"g">
                                    </a>
                                    <button class="btn btn-danger delete-photo" data-content-type="activity" data-content-id="'.$_GET['id'].'-'.$resp[$photoCounter]->activity_gallery_ID.'"  style="position: absolute;z-index: 1;top: 0;">
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
            CKEDITOR.replace( 'activityDescPT' );
            CKEDITOR.replace( 'activityDescEN' );
            var descPT = document.querySelector('#activityDescPTHolder').innerHTML;
            var descEN = document.querySelector('#activityDescENHolder').innerHTML;
            CKEDITOR.instances['activityDescPT'].setData(descPT) ;
            CKEDITOR.instances['activityDescEN'].setData(descEN) ;
            $('.js-example-basic-multiple').select2();
        });
    </script>
<?php }?>