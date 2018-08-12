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

    include_once('_include/_models/to-rent.php');
    $toRent = new ToRent($MAIN->db);
?>
<h3 class="page-title">Objectos para Aluger</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addToRent" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Novo Objecto</button>
                <button type="button" class="btn btn-warning pull-right" id="puplate-input">Populate input</button>

                <div id="addToRent" class="row collapse">
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Tipo de Properiedade</span>
                            <select class="select bg-white" name="to_rentPropertyType" id="to_rentPropertyType" style="width: 100%;">
                                <option value="" selected disabled>Escolha tipo de apartamento...</option>
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
                            <input type="text" name="to_rentName-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nome(EN)</span>
                            <input type="text" name="to_rentName-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Descrição Curta(PT)</span>
                            <input type="text" name="to_rentDescShort-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Descrição Curta(EN)</span>
                            <input type="text" name="to_rentDescShort-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" id="basic-addon1">Descrição Completa(PT)</span>
                        <textarea name="to_rentDescLong-PT" class="form-control" id="to_rentDescPT" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" id="basic-addon1">Descrição Completa(EN)</span>
                        <textarea name="to_rentDescLong-EN" class="form-control" id="to_rentDescEN" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Vista</span>
                            <select class="select bg-white" name="to_rentViewType" id="to_rentViewType" style="width: 100%;">
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
                            <input type="checkbox" name="to_rentHasPoolAccess" value="1"><span>Acesso a Piscina</span>
                        </label>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="to_rentIsVisible" value="1"><span>Publicar</span>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nr de Quartos</span>
                            <input type="number" name="to_rentRoomAmmount" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Qtd de Residentes</span>
                            <input type="number" name="to_rentMaxAllowedGuests" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Distancia da praia</span>
                            <input type="number" name="to_rentBeachDistance" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">POI</span>
                            <select class="select bg-white" name="to_rentCityPoi" id="city-poi" style="width: 100%;">
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
                            <span class="input-group-addon">Serviços</span>
                            <select class="select bg-white" name="to_rentCommonService" multiple="multiple" id="common-services" style="width: 100%;">
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
                            <span class="input-group-addon">Serviços Especificos</span>
                            <select class="select bg-white" name="to_rentUniqueService" multiple="multiple" id="unique-services" style="width: 100%;">
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
                                <h4>Preços</h4>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;">
                                <div class="input-group">
                                    <input type="number" name="to_rentCat1" class="form-control" placeholder="Nov-Abr">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="number" name="to_rentCat2" class="form-control" placeholder="Maio">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="number" name="to_rentCat3" class="form-control" placeholder="1 1/2 Junho">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="number" name="to_rentCat4" class="form-control" placeholder="2 1/2 Junho">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="number" name="to_rentCat5" class="form-control" placeholder="1 1/2 Julho">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="number" name="to_rentCat6" class="form-control" placeholder="2 1/2 Julho">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="number" name="to_rentCat7" class="form-control" placeholder="Agosto">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="number" name="to_rentCat8" class="form-control" placeholder="1 1/2 Setembro">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="number" name="to_rentCat9" class="form-control" placeholder="2 1/2 Setembro">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;">  
                                <div class="input-group">
                                    <input type="number" name="to_rentCat10" class="form-control" placeholder="Out">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" class="btn btn-success pull-right" id="add-to_rent">Inserir</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Objectos Existentes
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover" id="to_rent-table">
                <thead>
                    <th>ID Publico</th>
                    <th>Titulo(PT)</th>
                    <th>Cidade(PT)</th>
                    <th>Tipo de Propriedade</th>
                    <th>Vista</th>
                    <th>Acesso a Piscina</th>
                    <th>Qtd de Residentes</th>
                    <th>Qtd de Quartos</th>
                    <th>Distância da Praia</th>
                    <th>Visivel</th>
                    <th>Criado</th>
                    <th>Modificado</th>
                    <th>Galeria</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    <?php
                        $resp = $toRent->fetchAll();
                        for($toRentCounter = 0; $toRentCounter < count($resp); $toRentCounter++){
                            switch($resp[$toRentCounter]->propertyType){
                                case 0: $propertyType = 'Apartamento';
                                    break;
                                case 1: $propertyType = 'Casa';
                                    break;
                                case 2: $propertyType = 'Vila';
                                    break;
                                case 3: $propertyType = 'Bungalow';
                                    break;
                            };
                            switch($resp[$toRentCounter]->viewType){
                                case 0: $viewType = 'Nenhuma';
                                    break;
                                case 1: $viewType = 'Praia';
                                    break;
                                case 2: $viewType = 'Piscina';
                            };
                            // $propertyType = ['Apartamento', 'Casa', 'Vila', 'Bungalow'];
                            // $propertyView = ['Nenhuma', 'Praia', 'Piscina'];
                            echo '<tr data-content-type="to_rent" data-content-id="'.$resp[$toRentCounter]->property_ID.'">';
                            echo '<td>'.$resp[$toRentCounter]->publicID.'</td>';
                            echo '<td>'.$resp[$toRentCounter]->title.'</td>';
                            echo '<td>'.$resp[$toRentCounter]->nameTranslated.'</td>';
                            echo '<td>'.$propertyType.'</td>';
                            echo '<td>'.$viewType.'</td>';
                            echo '<td>'.(($resp[$toRentCounter]->hasPoolAccess == 1) ? 'Sim':'Não').'</td>';
                            echo '<td>'.$resp[$toRentCounter]->maxAllowedGuests.'</td>';
                            echo '<td>'.$resp[$toRentCounter]->roomAmmount.'</td>';
                            echo '<td>'.$resp[$toRentCounter]->beachDistance.'</td>';
                            echo '<td>'.(($resp[$toRentCounter]->isVisible == 1)? 'Sim':'Não').'</td>';
                            echo '<td>'.$resp[$toRentCounter]->dateCreated.'</td>';
                            echo '<td>'.$resp[$toRentCounter]->dateModified.'</td>';
                            echo '<td>
                                    <a class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$resp[$toRentCounter]->property_ID.'" data-toggle="collapse">
                                        <i class="lnr lnr-plus-circle"></i>
                                    </a>
                            </td>';
                            echo '<td>
                                <a href="?edit=to-rent&id='.$resp[$toRentCounter]->property_ID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                                <button class="btn btn-danger btn-xs pull-right" id="delete-to_rent"><span class="lnr lnr-trash"></span></button>
                            </td></tr>';
                            echo'
                            <tr data-content-type="to_rent" data-content-id="'.$resp[$toRentCounter]->property_ID.'" id="collapseGallery-'.$resp[$toRentCounter]->property_ID.'" class="collapse">
                                <td colspan="14" class="bg-info">
                                    <form enctype="multipart/form-data" method="post" class="file-upload" id="'.$resp[$toRentCounter]->property_ID.'">
                                        <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]">
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
        CKEDITOR.replace( 'to_rentDescPT' );
        CKEDITOR.replace( 'to_rentDescEN' );
        $('#to_rentPropertyType').select2();
        $('#to_rentViewType').select2();
        $('#city-poi').select2();
        $('#common-services').select2();
        $('#unique-services').select2();

        
        /* Upload script */
        var newUpload = new uploadPhotos('ajax/to-rent/add-photo-to-rent.php', document.querySelectorAll('.file-upload'));
            // newUpload.upload();
        /* Upload script */

        /* Create new entry */
            document.getElementById('add-to_rent').onclick = function(){
                addContent(this.id, false, true);
            };
        /* Create new entry */

        /* Delete poi start function */
            $(document).on('click', '#delete-to_rent', function(){
                let data = $(this).closest('tr').data();
                var contentType = data['contentType'].split('_');
                console.log(contentType);
                modalWindow('modal-window',contentType[0] + '-' + contentType[1], data['contentId']);
            });
        /* Delete poi start function */

        /* fill input with dummy text */
        document.getElementById('puplate-input').onclick = function(){
                inputFiller('to_rent');
            }
        /* fill input with dummy text */
    });
</script>