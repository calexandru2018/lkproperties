<h3 class="page-title">Editar Objecto de Venda: [Nome]</h3>
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
                        <option value="1">Apartamento</option>
                        <option value="2">Casa</option>
                        <option value="3">Vila</option>
                        <option value="4">Bungalow</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <button type="button" class="btn btn-success pull-right btn-toastr" data-context="success" data-message="Hi, I'm here" data-position="top-right">Guardar Alteração</button>
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert"> <!-- alert-success OR alert-danger-->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> Error ao guardar alterações  <!-- fa fa-check-circle OR fa fa-times-circle-->
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
                    <input type="text" name="propertyName-PT" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Nome(EN)</span>
                    <input type="text" name="propertyName-EN" class="form-control">
                </div>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <button type="button" class="btn btn-success pull-right btn-toastr" data-context="success" data-message="Hi, I'm here" data-position="top-right">Guardar Alteração</button>
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert"> <!-- alert-success OR alert-danger-->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> Error ao guardar alterações  <!-- fa fa-check-circle OR fa fa-times-circle-->
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
                <textarea name="propertyDesc-PT" class="form-control" id="propertyDescPT" rows="4"></textarea>
            </div>
            <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                <textarea name="propertyDesc-EN" class="form-control" id="propertyDescEN" rows="4"></textarea>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <button  type="button" class="btn btn-success pull-right btn-toastr" data-context="success" data-message="Hi, I'm here" data-position="top-right">Guardar Alteração</button>
            </div>
            <div class="alert alert-success alert-dismissible" role="alert"> <!-- alert-success OR alert-danger-->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check-circle"></i> Alteração realizada com sucesso  <!-- fa fa-check-circle OR fa fa-times-circle-->
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
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Nr de Quartos</span>
                    <input type="text" name="roomAmmount" class="form-control">
                </div>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Qtd de Residentes</span>
                    <input type="text" name="maxAllowedGuests" class="form-control">
                </div>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Distancia da praia</span>
                    <input type="text" name="beachDistance" class="form-control">
                </div>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Vista</span>
                    <select class="select bg-white" name="viewType" id="viewType" style="width: 100%;">
                        <option value="1">Praia</option>
                        <option value="2">Piscina</option>
                        <option value="0">Nenhuma</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
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
            <!-- <div class="clearclearfix"></div> -->
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
                    <span class="input-group-addon">Serviços Especificos</span>
                    <select class="select bg-white" name="unique-services" multiple="multiple" id="unique-services" style="width: 100%;">
                        <option value="1">Barbque</option>
                        <option value="2">Piscina Privada</option>
                        <option value="null">Nenhuma</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="hasPoolAccess" value="1"><span>Acesso a Piscina</span>
                </label>
            </div>
            <div class="col-xs-6 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="isVisible" value="1"><span>Publicar</span>
                </label>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <button type="button" class="btn btn-success pull-right btn-toastr" data-context="success" data-message="Hi, I'm here" data-position="top-right">Guardar Alteração</button>
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert"> <!-- alert-success OR alert-danger-->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> Error ao guardar alterações  <!-- fa fa-check-circle OR fa fa-times-circle-->
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
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Preço</span>
                    <input type="text" name="propertyPrice" class="form-control">
                    <span class="input-group-addon">€</span>
                </div>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <button type="button" class="btn btn-success pull-right btn-toastr" data-context="success" data-message="Hi, I'm here" data-position="top-right">Guardar Alteração</button>
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert"> <!-- alert-success OR alert-danger-->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> Error ao guardar alterações  <!-- fa fa-check-circle OR fa fa-times-circle-->
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
                <div class="col-xs-4 item" style="margin: 5px 0">
                    <a class="lightbox" href="../assets/img/mod2.jpg">
                        <img class="img-responsive image scale-on-hover" src="../assets/img/mod2.jpg">
                    </a>
                    <button class="btn btn-danger" style="position: absolute;z-index: 1;top: 0;">
                        <i class="lnr lnr-trash"></i>
                    </button>
                </div>
                <div class="col-xs-4 item" style="margin: 5px 0">
                    <a class="lightbox" href="../assets/img/mod2.jpg">
                        <img class="img-responsive image scale-on-hover" src="../assets/img/mod2.jpg">
                    </a>
                    <button class="btn btn-danger" style="position: absolute;z-index: 1;top: 0;">
                        <i class="lnr lnr-trash"></i>
                    </button>
                </div>
                <div class="col-xs-4 item" style="margin: 5px 0">
                    <a class="lightbox" href="../assets/img/mod2.jpg">
                        <img class="img-responsive image scale-on-hover" src="../assets/img/mod2.jpg">
                    </a>
                    <button class="btn btn-danger" style="position: absolute;z-index: 1;top: 0;">
                        <i class="lnr lnr-trash"></i>
                    </button>
                </div>
                <div class="col-xs-4 item" style="margin: 5px 0">
                    <a class="lightbox" href="../assets/img/mod2.jpg">
                        <img class="img-responsive image scale-on-hover" src="../assets/img/mod2.jpg">
                    </a>
                    <button class="btn btn-danger" style="position: absolute;z-index: 1;top: 0;">
                        <i class="lnr lnr-trash"></i>
                    </button>
                </div>
                <div class="col-xs-4 item" style="margin: 5px 0">
                    <a class="lightbox" href="../assets/img/mod2.jpg">
                        <img class="img-responsive image scale-on-hover" src="../assets/img/mod2.jpg">
                    </a>
                    <button class="btn btn-danger" style="position: absolute;z-index: 1;top: 0;">
                        <i class="lnr lnr-trash"></i>
                    </button>
                </div>
                <div class="col-xs-4 item" style="margin: 5px 0">
                    <a class="lightbox" href="../assets/img/mod2.jpg">
                        <img class="img-responsive image scale-on-hover" src="../assets/img/mod2.jpg">
                    </a>
                    <button class="btn btn-danger" style="position: absolute;z-index: 1;top: 0;">
                        <i class="lnr lnr-trash"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $( document ).ready(function() {
        baguetteBox.run('.gallery-block');
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
    $(document).on('click', '#show-gallery', function(){
        console.log($(this).closest('tr').data('property-id'));
    });
</script>