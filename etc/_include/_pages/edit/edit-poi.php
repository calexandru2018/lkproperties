<h3 class="page-title">Editar POI: [Nome]</h3>
<div class="panel panel-primary">
    <div class="panel-heading">
        Nome
    </div>
    <div class="panel-body">
        <div class="row">
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
                <span class="input-group-addon" >Descrição(PT)</span>
                <textarea name="poiDesc-PT" id="poiDescPT" class="form-control" rows="4"></textarea>
            </div>
            <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                <span class="input-group-addon" >Descrição(EN)</span>
                <textarea name="poiDesc-EN" id="poiDescEN" class="form-control" rows="4"></textarea>
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
        Outro
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Cidade</span>
                    <select class="js-example-basic-multiple bg-white" multiple="multiple" name="poiCityName" style="width: 100%;">
                        <option value="AL">Alabama</option>
                            ...
                        <option value="WY">Wyoming</option>
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
    $(document).ready(function() {
        baguetteBox.run('.gallery-block');
        CKEDITOR.replace( 'poiDescPT' );
        CKEDITOR.replace( 'poiDescEN' );
        $('.js-example-basic-multiple').select2();
    });
</script>