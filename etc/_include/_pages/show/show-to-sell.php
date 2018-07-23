<?php 
/* Property types */
/* 
    1-Apartment
    2-House
    3-Villa
    4-Bungalow
*/
?>
<h3 class="page-title">Objectos para Venda</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCity" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Novo Objecto</button>
                <div id="addCity" class="row collapse">
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Tipo de Properiedade</span>
                            <select class="select bg-white" name="propertyType" id="propertyType" style="width: 100%;">
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
                            <input type="text" name="propertyName-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nome(EN)</span>
                            <input type="text" name="propertyName-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <!-- <div class="input-group"> -->
                            <span class="input-group-addon" id="basic-addon1">Descrição(PT)</span>
                            <textarea name="propertyDesc-PT" class="form-control" id="propertyDescPT" rows="4"></textarea>
                        <!-- </div> -->
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <!-- <div class="input-group"> -->
                            <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                            <textarea name="propertyDesc-EN" class="form-control" id="propertyDescEN" rows="4"></textarea>
                        <!-- </div> -->
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Vista</span>
                            <select class="select bg-white" name="viewType" id="viewType" style="width: 100%;">
                                <option value="1">Praia</option>
                                <option value="2">Piscina</option>
                                <option value="0">Nenhuma</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="hasPoolAccess" value="1"><span>Acesso a Piscina</span>
                        </label>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="isVisible" value="1"><span>Publicar</span>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nr de Quartos</span>
                            <input type="text" name="roomAmmount" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Qtd de Residentes</span>
                            <input type="text" name="maxAllowedGuests" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Distancia da praia</span>
                            <input type="text" name="beachDistance" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">POI/Cidade</span>
                            <select class="select bg-white" name="city-poi" id="city-poi" style="width: 100%;">
                                <option value="1">Praia da Rocha</option>
                                <option value="2">Alvor</option>
                                <option value="2">Alvor</option>
                                <option value="null">Nenhuma</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
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
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Serviços Especificos</span>
                            <select class="select bg-white" name="unique-services" multiple="multiple" id="unique-services" style="width: 100%;">
                                <option value="1">Barbque</option>
                                <option value="2">Piscina Privada</option>
                                <option value="null">Nenhuma</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Preço</span>
                            <input type="text" name="propertyPrice" class="form-control">
                            <span class="input-group-addon">€</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" onClick="show()" class="btn btn-success mb-xs-3 pull-right">Inserir</button>
                    </div>
                    <div class="clearfix"></div>
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
            <table class="table table-hover">
                <thead>
                    <th>ID Publico</th>
                    <th>Preço</th>
                    <th>Titulo(PT)</th>
                    <th>Cidade(PT)</th>
                    <th>Tipo de Propriedade</th>
                    <th>Vista</th>
                    <th>Acesso a Piscina</th>
                    <th>Qtd de Residentes</th>
                    <th>Distância da Praia</th>
                    <th>Visivel</th>
                    <th>Criado</th>
                    <th>Modificado</th>
                    <th>Galeria</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    <tr data-property-id="1">
                        <td>
                            85-2345
                        </td>
                        <td>
                            110 000€
                        </td>
                        <td>
                            Encosta da Marina
                        </td>
                        <td>
                            Portimao
                        </td>
                        <td>
                            Apartamento
                        </td>
                        <td>
                            Piscina
                        </td>
                        <td>
                            Sim
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                            800m
                        </td>
                        <td>
                            Sim
                        </td>
                        <td>
                            2018-09-23
                        </td>
                        <td>
                            2018-09-23
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-1" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                             <a href="?edit=to-sell&id=2" class="btn btn-info btn-xs pull-left"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
                        </td>
                    </tr>
                    <tr id="collapseGallery-1" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        CKEDITOR.replace( 'propertyDescPT' );
        CKEDITOR.replace( 'propertyDescEN' );
        $('#propertyType').select2();
        $('#viewType').select2();
        $('#city-poi').select2();
        $('#services').select2();
        $('#unique-services').select2();
    });
    function show(){
        console.log($('#propertyType').select2('data'));
        console.log($('#viewType').select2('data'));
        console.log($('#city-poi').select2('data'));
    }
</script>