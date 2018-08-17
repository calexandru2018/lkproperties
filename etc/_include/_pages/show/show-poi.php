<?php
    include_once('_include/_models/poi.php');
    $poi = new Poi($MAIN->db);
?>
<h3 class="page-title">Pontos de Interesse(Point Of Interest)</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addPoi" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Novo POI</button>
                <button type="button" class="btn btn-warning pull-right" id="puplate-input">Populate input</button>

                <div id="addPoi" class="row collapse">
                    <div class="col-xs-12" style="margin-top: 2%">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="poiIsPopular" value="1"><span>Destacar como "Popular"</span>
                        </label>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(PT)</span>
                            <input type="text" name="poiName-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(EN)</span>
                            <input type="text" name="poiName-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Descrição(PT)</span>
                        <textarea name="poiDesc-PT" id="poiDescPT" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Descrição(EN)</span>
                        <textarea name="poiDesc-EN" id="poiDescEN" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Cidade</span>
                            <select class="poiSelector bg-white" name="poiCityName" style="width: 100%;">  
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
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Video(URL opcional)</span>
                            <input type="text" name="poiVideoURL" class="form-control" placeholder="https://...">
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" class="btn btn-success pull-right" id="add-poi">Inserir</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        POI Existentes
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover" id="poi-table">
                <thead>
                    <th>ID</th>
                    <th>Cidade</th>
                    <th>Nome(PT)</th>
                    <th>Descrição(PT)</th>
                    <th>Popular</th>
                    <th>Adicionado</th>
                    <th>Galeria</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                <?php
                    $resp = $poi->fetchAll();
                    if(!empty($resp)){
                        for($poiCounter = 0; $poiCounter < count($resp); $poiCounter++){
                            switch($resp[$poiCounter]->isPopular){
                                case 0: $isPopular = 'Nao';
                                    break;
                                case 1: $isPopular = 'Sim';
                                    break;
                            };
                            echo '<tr data-content-type="poi" data-content-id="'.$resp[$poiCounter]->poi_link_ID.'">';
                            echo '<td>'.$resp[$poiCounter]->poi_link_ID.'</td>';
                            echo '<td>'.$resp[$poiCounter]->cityNameTranslated.'</td>';
                            echo '<td>'.$resp[$poiCounter]->nameTranslated.'</td>';
                            echo '<td>'.$resp[$poiCounter]->descriptionTranslated.'</td>';
                            echo '<td>'.$isPopular.'</td>';
                            echo '<td>'.$resp[$poiCounter]->dateCreated.'</td>';
                            echo '<td>
                                    <a class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$resp[$poiCounter]->poi_link_ID.'" data-toggle="collapse">
                                        <i class="lnr lnr-plus-circle"></i>
                                    </a>
                            </td>';
                            echo '<td>
                                <a href="?edit=poi&id='.$resp[$poiCounter]->poi_link_ID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                                <button class="btn btn-danger btn-xs pull-right" id="delete-poi"><span class="lnr lnr-trash"></span></button>
                            </td></tr>';
                            echo'
                            <tr data-content-type="poi" data-content-id="'.$resp[$poiCounter]->poi_link_ID.'" id="collapseGallery-'.$resp[$poiCounter]->poi_link_ID.'" class="collapse">
                                <td colspan="14" class="bg-info">
                                    <form enctype="multipart/form-data" method="post" class="file-upload" id="'.$resp[$poiCounter]->poi_link_ID.'">
                                        <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]" multiple="multiple">
                                        <input type="submit" class="btn btn-primary pull-right" name="Submit" value="Upload">
                                    </form>
                                </td>
                            </tr>
                            ';
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        CKEDITOR.replace( 'poiDescPT' );
        CKEDITOR.replace( 'poiDescEN' );
        $('.poiSelector').select2();

        /* Upload script */
            var newUpload = new uploadPhotos('ajax/poi/add-photo-poi.php', document.querySelectorAll('.file-upload'));
            newUpload.upload();
        /* Upload script */

        /* Create new entry */
            document.getElementById('add-poi').onclick = function(){
                addContent(this.id, false, true);
            };
        /* Create new entry */

        /* Delete poi start function */
            $(document).on('click', '#delete-poi', function(){
                let data = $(this).closest('tr').data();
                modalWindow('modal-window',data['contentType'], data['contentId']);
            });
        /* Delete poi start function */

        /* fill input with dummy text */
        document.getElementById('puplate-input').onclick = function(){
                inputFiller('poi');
            }
        /* fill input with dummy text */
    });
</script>