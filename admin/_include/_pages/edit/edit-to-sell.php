<?php
    include_once('_include/_models/to-sell.php');
    $toSell = new ToSell($MAIN->db);
    $toSellData = $toSell->fetch($_GET['id']);
    $serviceCommonList = $toSell->fetchServiceCommon((int)$_GET['id']);
    $uniqueServiceList = $toSell->fetchServiceUnique((int)$_GET['id']);
    $priceList = $toSell->fetchPrice((int)$_GET['id']);
    $priceCategorization =[
        [
            'name'=>'to_sellCat1', 
            'placeholder' => 'Nov-Abr'
        ],
        [
            'name'=>'to_sellCat2', 
            'placeholder' => 'Maio'
        ],
        [
            'name'=>'to_sellCat3', 
            'placeholder' => '1 1/2 Junho'
        ],
        [
            'name'=>'to_sellCat4', 
            'placeholder' => '2 1/2 Junho'
        ],
        [
            'name'=>'to_sellCat5', 
            'placeholder' => '1 1/2 Julho'
        ],
        [
            'name'=>'to_sellCat6', 
            'placeholder' => '2 1/2 Julho'
        ],
        [
            'name'=>'to_sellCat7', 
            'placeholder' => 'Agosto'
        ],
        [            
            'name'=>'to_sellCat8', 
            'placeholder' => '1 1/2 Setembro'
        ],
        [            
            'name'=>'to_sellCat9', 
            'placeholder' => '2 1/2 Setembro'
        ],
        [            
            'name'=>'to_sellCat10', 
            'placeholder' => 'Out'
        ],
    ];
    // print_r($serviceCommonList);
    $canEdit = $toSell->showEditPage($_GET["edit"], $_GET["id"], empty($toSellData));
    $propertyType = ['Apartamento', 'Casa', 'Vila', 'Bungalow'];
    $propertyView = ['Nenhuma', 'Praia', 'Piscina'];
    if($canEdit === 1)
    {
?>
    <h3 class="page-title">Editar Objecto de Aluguer: <?php echo $toSellData['pt_0'][0]['title']?></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Nome
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Nome(PT)</span>
                        <input type="text" name="to_sellPropertyName-PT" class="form-control" value="<?php echo $toSellData['pt_0'][0]['title']?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Nome(EN)</span>
                        <input type="text" name="to_sellPropertyName-EN" class="form-control" value="<?php echo $toSellData['en_7'][0]['title']?>">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_sell-saveName">Guardar Alteração</button>
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
                        <input type="text" name="to_sellDescShort-PT" class="form-control" value="<?php echo $toSellData['pt_0'][0]['shortDescription']?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                        <input type="text" name="to_sellDescShort-EN" class="form-control" value="<?php echo $toSellData['en_7'][0]['shortDescription']?>">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_sell-shortDesc">Guardar Alteração</button>
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
                    <textarea name="to_sellDescLong-PT" class="form-control" id="propertyDescPT" rows="4"></textarea>
                    <div id="toSellDescPTHolder" style="visibility: hidden"><?php echo $toSellData['pt_0'][0]['longDescription'];?></div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                    <textarea name="to_sellDescLong-EN" class="form-control" id="propertyDescEN" rows="4"></textarea>
                    <div id="toSellDescENHolder" style="visibility: hidden"><?php echo $toSellData['en_7'][0]['longDescription'];?></div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button  type="button" class="btn btn-success pull-right save" id="to_sell-longDesc">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Tipos de Serviço
        </div>
        <div class="panel-body">
            <div class="row">
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Serviços</span>
                        <select class="select bg-white" name="to_sellCommonService" multiple="multiple" id="services" style="width: 100%;">
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
                                    $serviceList[$cs->common_service_link_ID] = $cs->serviceTranslated;
                                }
                                foreach($serviceList as $key => $value){
                                    $toShowCS = '<option value="'.$key.'">'.$value.'</option>';
                                    for($c = 0; $c < count($serviceCommonList); $c++){
                                        if($serviceCommonList[$c]['common_service_link_ID'] == $key){
                                            $toShowCS = '<option value="'.$key.'"selected="selected">'.$value.'</option>';
                                        }
                                    }
                                    echo $toShowCS;
                                }  
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Serviços Unicos</span>
                        <select class="select bg-white" name="to_sellUniqueService" multiple="multiple" id="unique-services" style="width: 100%;">
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
                                    $unqiueServiceList[$us->unique_service_link_ID] = $us->uniqueServiceTranslated;
                                }
                                foreach($unqiueServiceList as $key => $value){
                                    $toShowUS = '<option value="'.$key.'">'.$value.'</option>';
                                    for($c = 0; $c < count($uniqueServiceList); $c++){
                                        if($uniqueServiceList[$c]['unique_service_link_ID'] == $key){
                                            $toShowUS = '<option value="'.$key.'"selected="selected">'.$value.'</option>';
                                        }
                                    }
                                    echo $toShowUS;
                                }  
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_sell-serviceType">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Outros Detalhes
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nr de Quartos</span>
                        <input type="text" name="to_sellRoomAmmount" class="form-control" value="<?php echo $toSellData['pt_0'][0]['roomAmmount']; ?>">
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Qtd de Residentes</span>
                        <input type="text" name="to_sellMaxAllowedGuests" class="form-control" value="<?php echo $toSellData['pt_0'][0]['maxAllowedGuests']; ?>">
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Distancia da praia</span>
                        <input type="text" name="to_sellBeachDistance" class="form-control" value="<?php echo $toSellData['pt_0'][0]['beachDistance']; ?>">
                    </div>
                </div>
                <div class="col-xs-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="to_sellHasPoolAccess" value="1" <?php echo (($toSellData['pt_0'][0]['hasPoolAccess'] == 1) ? 'checked="checked"':'');?>><span>Acesso a Piscina</span>
                    </label>
                </div><!-- 
                <div class="clearclearfix"></div> -->
                <div class="col-xs-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="to_sellIsVisible" value="1" <?php echo (($toSellData['pt_0'][0]['isVisible'] == 1) ? 'checked="checked"':'');?>><span>Publicar</span>
                    </label>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">POI</span>
                        <select class="select bg-white" name="to_sellCityPoi" id="city-poi" style="width: 100%;">
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
                                            <option value="'.$toSellData['pt_0'][0]['property_city_poi_ID'].'-'.$r->city_poi_link_ID.'"'.(($toSellData['pt_0'][0]['city_poi_link_ID'] == $r->city_poi_link_ID) ? 'selected="selected"':'').'>'.$r->cityName.' - '.$r->poiName.'</option>
                                        ';
                                    }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Vista</span>
                        <select class="select bg-white" name="to_sellViewType" id="viewType" style="width: 100%;">
                            <?php
                                for($c = 0; $c < count($propertyView); $c++){
                                    echo '<option value="'.$c.'"'.(($c == $toSellData['pt_0'][0]['viewType']) ? 'selected="selected"':'').'>'.$propertyView[$c].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Tipo de Properiedade</span>
                        <select class="select bg-white" name="to_sellPropertyType" id="propertyType" style="width: 100%;">
                            <?php
                            echo $toSellData['pt_0'][0]['propertyType'];
                                for($c = 0; $c < count($propertyType); $c++){
                                    echo '<option value="'.$c.'"'.(($c == $toSellData['pt_0'][0]['propertyType']) ? 'selected="selected"':'').'>'.$propertyType[$c].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_sell-details">Guardar Alteração</button>
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
                        <span class="input-group-addon">Preço</span>
                        <input type="number" name="to_sellPrice" class="form-control" value="<?php echo $priceList[1]; ?>">
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="to_sell-price">Guardar Alteração</button>
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
                        $resp = $toSell->fetchAllPhotos($_GET['id']);
                        if(!empty($resp)){
                            for($photoCounter = 0; $photoCounter < count($resp); $photoCounter++){
                                echo '
                                    <div class="col-xs-4 item" style="margin: 5px 0">
                                        <a class="lightbox" href="../gallery/sale/'.(int)$_GET['id'].'/fullsize/'.$resp[$photoCounter]->fullsizeURL.'">
                                            <img class="img-responsive image scale-on-hover" src="../gallery/sale/'.(int)$_GET['id'].'/thumbnail/'.$resp[$photoCounter]->fullsizeURL.'">
                                        </a>
                                        <button class="btn btn-danger delete-photo" data-content-type="to-sell" data-content-id="'.(int)$_GET['id'].'-'.$resp[$photoCounter]->property_gallery_ID.'"  style="position: absolute;z-index: 1;top: 0;">
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
        $( document ).ready(function() {
            baguetteBox.run('.gallery-block');
            CKEDITOR.replace( 'propertyDescPT' );
            CKEDITOR.replace( 'propertyDescEN' );
            var descPT = document.querySelector('#toSellDescPTHolder').innerHTML;
            var descEN = document.querySelector('#toSellDescENHolder').innerHTML;
            CKEDITOR.instances['propertyDescPT'].setData(descPT) ;
            CKEDITOR.instances['propertyDescEN'].setData(descEN) ;
            $('#propertyType').select2();
            $('#propertyType').select2();
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