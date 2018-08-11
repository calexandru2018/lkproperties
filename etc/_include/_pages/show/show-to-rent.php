<?php 
/* Property types */
/* 
    1-Apartment
    2-House
    3-Villa
    4-Bungalow
*/
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
                            <select class="select bg-white" name="to_rentType" id="to_rentPropertyType" style="width: 100%;">
                                <option value="" selected disabled>Escolha tipo de apartamento...</option>
                                <option value="1">Apartamento</option>
                                <option value="2">Casa</option>
                                <option value="3">Vila</option>
                                <option value="4">Bungalow</option>
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
                        <span class="input-group-addon" id="basic-addon1">Descrição(PT)</span>
                        <textarea name="to_rentDesc-PT" class="form-control" id="to_rentDescPT" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                        <textarea name="to_rentDesc-EN" class="form-control" id="to_rentDescEN" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Vista</span>
                            <select class="select bg-white" name="to_rentViewType" id="to_rentViewType" style="width: 100%;">
                                <option value="" selected disabled>Escolha tipo de vista...</option>
                                <option value="1">Praia</option>
                                <option value="2">Piscina</option>
                                <option value="0">Nenhuma</option>
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
                            <input type="text" name="to_rentRoomAmmount" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Qtd de Residentes</span>
                            <input type="text" name="to_rentMaxAllowedGuests" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Distancia da praia</span>
                            <input type="text" name="to_rentBeachDistance" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">POI/Cidade</span>
                            <select class="select bg-white" name="to_rentCityPoi" id="city-poi" style="width: 100%;">
                                <option value="" selected disabled>Escolha um...</option>
                                <option value="1">Praia da Rocha</option>
                                <option value="2">Alvor</option>
                                <option value="3">Carvoeiro</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Serviços</span>
                            <select class="select bg-white" name="to_rentCommonService" multiple="multiple" id="common-services" style="width: 100%;">
                                <option value="1">Utensilios de Cozinha</option>
                                <option value="2">Utensilios de Loiça</option>
                                <option value="4">Utensilios de Roupa</option>
                                <option value="5">Utensilios de Limpeza</option>
                                <option value="6">Maquina de lavar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Serviços Especificos</span>
                            <select class="select bg-white" name="to_rentUniqueService" multiple="multiple" id="unique-services" style="width: 100%;">
                                <option value="1">Barbque</option>
                                <option value="2">Piscina Privada</option>
                                <option value="3">Garagem Privada</option>
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
                                    <input type="text" name="to_rentCat1" class="form-control" placeholder="Nov-Abr">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="text" name="to_rentCat2" class="form-control" placeholder="Maio">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="text" name="to_rentCat3" class="form-control" placeholder="1 1/2 Junho">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="text" name="to_rentCat4" class="form-control" placeholder="2 1/2 Junho">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="text" name="to_rentCat5" class="form-control" placeholder="1 1/2 Julho">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="text" name="to_rentCat6" class="form-control" placeholder="2 1/2 Julho">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="text" name="to_rentCat7" class="form-control" placeholder="Agosto">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="text" name="to_rentCat8" class="form-control" placeholder="1 1/2 Setembro">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;"> 
                                <div class="input-group">
                                    <input type="text" name="to_rentCat9" class="form-control" placeholder="2 1/2 Setembro">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;">  
                                <div class="input-group">
                                    <input type="text" name="to_rentCat10" class="form-control" placeholder="Out">
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
                addContent(this.id, true, true);
            };
        /* Create new entry */

        /* Delete poi start function */
            $(document).on('click', '#delete-to_rent', function(){
                let data = $(this).closest('tr').data();
                modalWindow('modal-window',data['contentType'], data['contentId']);
            });
        /* Delete poi start function */

        /* fill input with dummy text */
        document.getElementById('puplate-input').onclick = function(){
                inputFiller('to_rent');
            }
        /* fill input with dummy text */
    });
</script>