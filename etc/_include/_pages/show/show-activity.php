<?php
    include_once('_include/_models/activity.php');
    $activity = new Activity($MAIN->db);
    var_dump($activity->fetchAll());
?>
<h3 class="page-title">Actividades</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCity" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Nova Actividade</button>
                <button type="button" class="btn btn-warning pull-right" id="puplate-input">Populate input</button>

                <div id="addCity" class="row collapse">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(PT)</span>
                            <input type="text" name="activityName-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(EN)</span>
                            <input type="text" name="activityName-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Descrição(PT)</span>
                        <textarea name="activityDesc-PT" id="activityDescPT" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Descrição(EN)</span>
                        <textarea name="activityDesc-EN" id="activityDescEN" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Cidade</span>
                            <select class="js-example-basic-multiple bg-white" name="activityCityName" style="width: 100%;">
                                <option value="null" disabled selected>Escolha um cidade...</option>
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
                                            <option value="'.$r->city_link_ID.'">'.$r->nameTranslated.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" class="btn btn-success pull-right" id="add-activity">Inserir</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Actividades Existentes
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover" id="activity-table">
                <thead>
                    <th>ID</th>
                    <th>Cidade</th>
                    <th>Nome(PT)</th>
                    <th>Descrição(PT)</th>
                    <th>Adicionado</th>
                    <th>Galeria</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                <?php
                    $resp = $activity->fetchAll();
                    for($activityCounter = 0; $activityCounter < count($resp); $activityCounter++){
                        echo '<tr data-content-type="activity" data-content-id="'.$resp[$activityCounter]->activity_link_ID.'">';
                        echo '<td>'.$resp[$activityCounter]->activity_link_ID.'</td>';
                        echo '<td>'.$resp[$activityCounter]->cityNameTranslated.'</td>';
                        echo '<td>'.$resp[$activityCounter]->nameTranslated.'</td>';
                        echo '<td>'.$resp[$activityCounter]->descriptionTranslated.'</td>';
                        echo '<td>'.$resp[$activityCounter]->dateCreated.'</td>';
                        echo '<td>
                                <a class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$resp[$activityCounter]->activity_link_ID.'" data-toggle="collapse">
                                    <i class="lnr lnr-plus-circle"></i>
                                </a>
                        </td>';
                        echo '<td>
                            <a href="?edit=activity&id='.$resp[$activityCounter]->activity_link_ID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right" id="delete-activity"><span class="lnr lnr-trash"></span></button>
                        </td></tr>';
                        echo'
                        <tr data-content-type="activity" data-content-id="'.$resp[$activityCounter]->activity_link_ID.'" id="collapseGallery-'.$resp[$activityCounter]->activity_link_ID.'" class="collapse">
                            <td colspan="14" class="bg-info">
                                <form enctype="multipart/form-data" method="post" class="file-upload" id="'.$resp[$activityCounter]->activity_link_ID.'">
                                    <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]" multiple="multiple">
                                    <input type="submit" class="btn btn-primary pull-right" name="Submit" value="Upload">
                                </form>
                            </td>
                        </tr>
                        ';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        CKEDITOR.replace( 'activityDescPT' );
        CKEDITOR.replace( 'activityDescEN' );
        $('.js-example-basic-multiple').select2();

        /* Upload script */
            var newUpload = new uploadPhotos('ajax/activity/add-photo-activity.php', document.querySelectorAll('.file-upload'));
            newUpload.upload();
        /* Upload script */

        /* Create new entry */
            document.getElementById('add-activity').onclick = function(){
                addContent(this.id, false, true);
            };
        /* Create new entry */

        /* Delete activity start function */
            $(document).on('click', '#delete-activity', function(){
                let data = $(this).closest('tr').data();
                modalWindow('modal-window',data['contentType'], data['contentId']);
            });
        /* Delete activity start function */

        /* fill input with dummy text */
            document.getElementById('puplate-input').onclick = function(){
                inputFiller('activity');
            }
        /* fill input with dummy text */
    });
</script>