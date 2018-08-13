<?php
    include_once('_include/_models/to-rent.php');
    $toRent = new ToRent($MAIN->db);
    $toRentData = $toRent->fetchToRent($_GET['id']);
    $canEdit = $toRent->showEditPage($_GET["edit"], $_GET["id"], empty($toRentData));
    print_r($toRentData);
    $propertyType = ['Apartamento', 'Casa', 'Vila', 'Bungalow'];
    $propertyView = ['Nenhuma', 'Praia', 'Piscina'];
    if($canEdit === 1)
    {
?>
    <h3 class="page-title">Editar Objecto de Aluguer: <?php echo $toRentData['pt_0'][0]['title']?></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Tipo de Prioridade
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Tipo de Properiedade</span>
                        <select class="select bg-white" name="propertyType" id="propertyType" style="width: 100%;">
                            <?php
                            echo $toRentData['pt_0'][0]['propertyType'];
                                for($c = 0; $c < count($propertyType); $c++){
                                    echo '<option value="'.$c.'"'.(($c == $toRentData['pt_0'][0]['propertyType']) ? 'selected="selected"':'').'>'.$propertyType[$c].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_rent-propertyType">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Nome
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Nome(PT)</span>
                        <input type="text" name="to_rentPropertyName-PT" class="form-control" value="<?php echo $toRentData['pt_0'][0]['title']?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Nome(EN)</span>
                        <input type="text" name="to_rentPropertyName-EN" class="form-control" value="<?php echo $toRentData['en_7'][0]['title']?>">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_rent-saveName">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Descrição Curta
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Descrição(PT)</span>
                        <input type="text" name="to_rentDescShort-PT" class="form-control" value="<?php echo $toRentData['pt_0'][0]['shortDescription']?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                        <input type="text" name="to_rentDescShort-EN" class="form-control" value="<?php echo $toRentData['en_7'][0]['shortDescription']?>">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_rent-shortDesc">Guardar Alteração</button>
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
                    <textarea name="to_rentPropertyDesc-PT" class="form-control" id="propertyDescPT" rows="4"></textarea>
                    <div id="toRentDescPTHolder" style="visibility: hidden"><?php echo $toRentData['pt_0'][0]['longDescription'];?></div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                    <textarea name="to_rentPropertyDesc-EN" class="form-control" id="propertyDescEN" rows="4"></textarea>
                    <div id="toRentDescENHolder" style="visibility: hidden"><?php echo $toRentData['en_7'][0]['longDescription'];?></div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button  type="button" class="btn btn-success pull-right save" id="to_rent-longDesc">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Detalhes
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Qtd de Residentes</span>
                        <input type="text" name="maxAllowedGuests" class="form-control" value="<?php echo $toRentData['pt_0'][0]['maxAllowedGuests']; ?>">
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nr de Quartos</span>
                        <input type="text" name="roomAmmount" class="form-control" value="<?php echo $toRentData['pt_0'][0]['roomAmmount']; ?>">
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Distancia da praia</span>
                        <input type="text" name="beachDistance" class="form-control" value="<?php echo $toRentData['pt_0'][0]['beachDistance']; ?>">
                    </div>
                </div>
                <div class="col-xs-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="hasPoolAccess" value="1" <?php echo (($toRentData['pt_0'][0]['hasPoolAccess'] == 1) ? 'checked="checked"':'');?>><span>Acesso a Piscina</span>
                    </label>
                </div><!-- 
                <div class="clearclearfix"></div> -->
                <div class="col-xs-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="isVisible" value="1" <?php echo (($toRentData['pt_0'][0]['isVisible'] == 1) ? 'checked="checked"':'');?>><span>Publicar</span>
                    </label>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">POI</span>
                        <select class="select bg-white" name="city-poi" id="city-poi" style="width: 100%;">
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
                                            <option value="'.$r->city_poi_link_ID.'-'.$r->postalCode.'"'.(($toRentData['pt_0'][0]['city_poi_link_ID'] == $r->city_poi_link_ID) ? 'selected="selected"':'').'>'.$r->cityName.' - '.$r->poiName.'</option>
                                        ';
                                    }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Vista</span>
                        <select class="select bg-white" name="viewType" id="viewType" style="width: 100%;">
                            <?php
                                for($c = 0; $c < count($propertyView); $c++){
                                    echo '<option value="'.$c.'"'.(($c == $toRentData['pt_0'][0]['propertyType']) ? 'selected="selected"':'').'>'.$propertyView[$c].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Serviços</span>
                        <select class="select bg-white" name="services" multiple="multiple" id="services" style="width: 100%;">
                            <option value="1">Utensilios de Cozinha</option>
                            <option value="2">Utensilios de Loiça</option>
                            <option value="2">Utensilios de Roupa</option>
                            <option value="2">Utensilios de Limpeza</option>
                            <option value="2">Maquina de lavar</option>
                            <option value="null">Nenhuma</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Serviços Unicos</span>
                        <select class="select bg-white" name="unique-services" multiple="multiple" id="unique-services" style="width: 100%;">
                            <option value="1">Barbque</option>
                            <option value="2">Piscina Privada</option>
                            <option value="null">Nenhuma</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_rent-details">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Preços
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <input type="text" name="cat1" class="form-control" placeholder="Nov-Abr">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                    <div class="input-group">
                        <input type="text" name="cat2" class="form-control" placeholder="Maio">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                    <div class="input-group">
                        <input type="text" name="cat3" class="form-control" placeholder="1 1/2 Junho">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                    <div class="input-group">
                        <input type="text" name="cat4" class="form-control" placeholder="2 1/2 Junho">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                    <div class="input-group">
                        <input type="text" name="cat3" class="form-control" placeholder="1 1/2 Julho">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                    <div class="input-group">
                        <input type="text" name="cat4" class="form-control" placeholder="2 1/2 Julho">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                    <div class="input-group">
                        <input type="text" name="cat1" class="form-control" placeholder="Agosto">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                    <div class="input-group">
                        <input type="text" name="cat2" class="form-control" placeholder="1 1/2 Setembro">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;"> 
                    <div class="input-group">
                        <input type="text" name="cat3" class="form-control" placeholder="2 1/2 Setembro">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;">  
                    <div class="input-group">
                        <input type="text" name="cat4" class="form-control" placeholder="Out">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_rent-price">Guardar Alteração</button>
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

                </div>
            </section>
        </div>
    </div>
    <script>
        $( document ).ready(function() {
            baguetteBox.run('.gallery-block');
            CKEDITOR.replace( 'propertyDescPT' );
            CKEDITOR.replace( 'propertyDescEN' );
            var descPT = document.querySelector('#toRentDescPTHolder').innerHTML;
            var descEN = document.querySelector('#toRentDescENHolder').innerHTML;
            CKEDITOR.instances['propertyDescPT'].setData(descPT) ;
            CKEDITOR.instances['propertyDescEN'].setData(descEN) ;
            $('#propertyType').select2();
            $('#propertyType').select2('data', {id: '1049', text: 'MyLabel'});
            $('#viewType').select2();
            $('#city-poi').select2();
            $('#services').select2();
            $('#unique-services').select2();
        });
/*         function show(){
            console.log($('#propertyType').select2('data'));
            console.log($('#viewType').select2('data'));
            console.log($('#city-poi').select2('data'));
        } */
    </script>
<?php } ?>