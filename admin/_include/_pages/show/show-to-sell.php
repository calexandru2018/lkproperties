<?php 
/* Property types */
/* 
    0-Apartment
    1-House
    2-Villa
    3-Bungalow
*/
$propertyType = ['Apartamento', 'Casa', 'Vila', 'Bungalow'];
/* View Types */
/* 
    0-None
    1-Beach
    2-Pool
*/
$propertyView = ['Nenhuma', 'Praia', 'Piscina'];

    include_once('_include/_models/to-sell.php');
    $ToSell = new ToSell($MAIN->db);
?>
<h3 class="page-title">Imóvel para Venda</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addToSell" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Novo Imóvel</button>
                <button type="button" class="btn btn-warning pull-right" id="puplate-input">Populate input</button>

                <div id="addToSell" class="row collapse">
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Tipo de Imóvel</span>
                            <select class="select bg-white" name="to_sellPropertyType" id="to_sellPropertyType" style="width: 100%;" data-optional="false">
                                <option value="" selected disabled>Escolha tipo de imóvel...</option>
                                <?php
                                    for($c = 0; $c < count($propertyType); $c++){
                                        echo '<option value="'.$c.'">'.$propertyType[$c].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nome(PT)</span>
                            <input type="text" name="to_sellName-PT" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nome(EN)</span>
                            <input type="text" name="to_sellName-EN" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Descrição Curta(PT)</span>
                            <input type="text" name="to_sellDescShort-PT" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Descrição Curta(EN)</span>
                            <input type="text" name="to_sellDescShort-EN" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" id="basic-addon1">Descrição Completa(PT)</span>
                        <textarea name="to_sellDescLong-PT" class="form-control" id="to_sellDescPT" rows="4" data-optional="false"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" id="basic-addon1">Descrição Completa(EN)</span>
                        <textarea name="to_sellDescLong-EN" class="form-control" id="to_sellDescEN" rows="4" data-optional="false"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Vista</span>
                            <select class="select bg-white" name="to_sellViewType" id="to_sellViewType" style="width: 100%;" data-optional="false">
                                <option value="" selected disabled>Escolha tipo de vista...</option>
                                <?php
                                    for($c = 0; $c < count($propertyView); $c++){
                                        echo '<option value="'.$c.'">'.$propertyView[$c].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="to_sellHasPoolAccess" value="1"><span>Acesso a Piscina</span>
                        </label>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="to_sellIsVisible" value="1"><span>Publicar</span>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nr de Quartos</span>
                            <input type="number" name="to_sellRoomAmmount" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nr de Residentes</span>
                            <input type="number" name="to_sellMaxAllowedGuests" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Distancia da praia</span>
                            <input type="number" name="to_sellBeachDistance" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">POI(Ponto de Interesse)</span>
                            <select class="select bg-white" name="to_sellCityPoi" id="city-poi" style="width: 100%;" data-optional="false">
                                <option value="null" disabled selected>Escolha um POI...</option>
                                <?php
                                    $queryResult = $MAIN->db->query('
                                        select 
                                            city_poi_link.city_poi_link_ID,
                                            city_translation.nameTranslated as cityName,
                                            poi_translation.nameTranslated as poiName,
                                            city_link.postalCode
                                        from
                                            city_poi_link
                                        left join
                                            city_link
                                        on
                                            city_poi_link.city_link_ID = city_link.city_link_ID
                                        left join
                                            city_translation
                                        on
                                            city_link.city_link_ID = city_translation.city_link_ID
                                        left join
                                            poi_link
                                        on
                                            city_poi_link.poi_link_ID = poi_link.poi_link_ID
                                        left join
                                            poi_translation
                                        on
                                            poi_link.poi_link_ID = poi_translation.poi_link_ID
                                        where 
                                            city_translation.langCode = "pt"
                                            and
                                            poi_translation.langCode = "pt"
                                    ');
                                    while($r=$queryResult->fetch_object()){
                                        echo '
                                            <option value="'.$r->city_poi_link_ID.'-'.$r->postalCode.'">'.$r->cityName.' - '.$r->poiName.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Comodidades Comuns</span>
                            <select class="select bg-white" name="to_sellCommonService" multiple="multiple" id="common-services" style="width: 100%;" data-optional="false">
                                <?php
                                    $queryCSResult = $MAIN->db->query('
                                        select 
                                            *
                                        from    
                                            common_service_link
                                        left join
                                            common_service_translation
                                        on
                                            common_service_link.common_service_link_ID = common_service_translation.common_service_link_ID
                                        where
                                            langCode = "pt"
                                    ');
                                    while($cs=$queryCSResult->fetch_object()){
                                        echo '
                                            <option value="'.$cs->common_service_link_ID.'">'.$cs->serviceTranslated.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Comodidades Especiais</span>
                            <select class="select bg-white" name="to_sellUniqueService" multiple="multiple" id="unique-services" style="width: 100%;" data-optional="false">
                                <?php
                                    $queryUSResult = $MAIN->db->query('
                                        select 
                                            *
                                        from    
                                            unique_service_link
                                        left join
                                            unique_service_translation
                                        on
                                            unique_service_link.unique_service_link_ID = unique_service_translation.unique_service_link_ID
                                        where
                                            langCode = "pt"
                                    ');
                                    while($us=$queryUSResult->fetch_object()){
                                        echo '
                                            <option value="'.$us->unique_service_link_ID.'">'.$us->uniqueServiceTranslated.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Preço</h4>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;">
                                <div class="input-group">
                                    <span class="input-group-addon">Preço</span>
                                    <input type="number" name="to_sellPrice" class="form-control" data-optional="false">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" class="btn btn-success pull-right" id="add-to_sell">Inserir</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Imóveis Existentes
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover" id="to_sell-table">
                <thead>
                    <th>ID Publico</th>
                    <th>Titulo(PT)</th>
                    <th>Cidade(PT)</th>
                    <th>Tipo de Imóvel</th>
                    <th>Vista</th>
                    <th>Acesso a Piscina</th>
                    <th>Nr de Residentes</th>
                    <th>Nr de Quartos</th>
                    <th>Dist. da Praia</th>
                    <th>Visivel</th>
                    <th>Criado</th>
                    <th>Modificado</th>
                    <th>Galeria</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    <?php
                        $resp = $ToSell->fetchAll();
                        if(!empty($resp)){
                            for($ToSellCounter = 0; $ToSellCounter < count($resp); $ToSellCounter++){
                                switch($resp[$ToSellCounter]->propertyType){
                                    case 0: $propertyType = 'Apartamento';
                                        break;
                                    case 1: $propertyType = 'Casa';
                                        break;
                                    case 2: $propertyType = 'Vila';
                                        break;
                                    case 3: $propertyType = 'Bungalow';
                                        break;
                                };
                                switch($resp[$ToSellCounter]->viewType){
                                    case 0: $viewType = 'Nenhuma';
                                        break;
                                    case 1: $viewType = 'Praia';
                                        break;
                                    case 2: $viewType = 'Piscina';
                                };
                                // $propertyType = ['Apartamento', 'Casa', 'Vila', 'Bungalow'];
                                // $propertyView = ['Nenhuma', 'Praia', 'Piscina'];
                                echo '<tr data-content-type="to_sell" data-content-id="'.$resp[$ToSellCounter]->property_ID.'">';
                                echo '<td>'.$resp[$ToSellCounter]->publicID.'</td>';
                                echo '<td>'.$resp[$ToSellCounter]->title.'</td>';
                                echo '<td>'.$resp[$ToSellCounter]->nameTranslated.'</td>';
                                echo '<td>'.$propertyType.'</td>';
                                echo '<td>'.$viewType.'</td>';
                                echo '<td>'.(($resp[$ToSellCounter]->hasPoolAccess == 1) ? 'Sim':'Não').'</td>';
                                echo '<td>'.$resp[$ToSellCounter]->maxAllowedGuests.'</td>';
                                echo '<td>'.$resp[$ToSellCounter]->roomAmmount.'</td>';
                                echo '<td>'.$resp[$ToSellCounter]->beachDistance.'</td>';
                                echo '<td>'.(($resp[$ToSellCounter]->isVisible == 1)? 'Sim':'Não').'</td>';
                                echo '<td>'.$resp[$ToSellCounter]->dateCreated.'</td>';
                                echo '<td>'.$resp[$ToSellCounter]->dateModified.'</td>';
                                echo '<td>
                                        <a class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$resp[$ToSellCounter]->property_ID.'" data-toggle="collapse">
                                            <i class="lnr lnr-plus-circle"></i>
                                        </a>
                                </td>';
                                echo '<td>
                                    <a href="?edit=to-sell&id='.$resp[$ToSellCounter]->property_ID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                                    <button class="btn btn-danger btn-xs pull-right" id="delete-to_sell"><span class="lnr lnr-trash"></span></button>
                                </td></tr>';
                                echo'
                                <tr data-content-type="to_sell" data-content-id="'.$resp[$ToSellCounter]->property_ID.'" id="collapseGallery-'.$resp[$ToSellCounter]->property_ID.'" class="collapse">
                                    <td colspan="14" class="bg-info">
                                        <form enctype="multipart/form-data" method="post" class="file-upload" id="'.$resp[$ToSellCounter]->property_ID.'">
                                            <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]" multiple="multiple">
                                            <input type="submit" class="btn btn-primary pull-right" name="Submit" value="Upload">
                                        </form>
                                        <div class="loading-gif hidden">
                                            <img style="margin-left: 25%" src="assets/img/processing.gif" alt="A carregar"/>
                                        </div>
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
        CKEDITOR.replace( 'to_sellDescPT' );
        CKEDITOR.replace( 'to_sellDescEN' );
        $('#to_sellPropertyType').select2();
        $('#to_sellViewType').select2();
        $('#city-poi').select2();
        $('#common-services').select2();
        $('#unique-services').select2();

        
        /* Upload script */
        var newUpload = new uploadPhotos('ajax/to-sell/add-photo-to-sell.php', document.querySelectorAll('.file-upload'));
            newUpload.upload();
        /* Upload script */

        /* Create new entry */
            document.getElementById('add-to_sell').onclick = function(){
                addContent(this.id, true, true);
            };
        /* Create new entry */

        /* Delete poi start function */
            $(document).on('click', '#delete-to_sell', function(){
                let data = $(this).closest('tr').data();
                var contentType = data['contentType'].split('_');
                console.log(contentType);
                modalWindow('modal-window',contentType[0] + '-' + contentType[1], data['contentId']);
            });
        /* Delete poi start function */

        /* fill input with dummy text */
            document.getElementById('puplate-input').onclick = function(){
                inputFiller('to_sell');
            }
        /* fill input with dummy text */
    });
</script>