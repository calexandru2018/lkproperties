<h3 class="page-title">Editar Administrador: [Nome]</h3>
<div class="panel panel-primary">
    <div class="panel-heading">
        Informação Pessoal
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Nome</span>
                    <input type="text" name="adminName" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Email</span>
                    <input type="text" name="adminEmail" class="form-control">
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
        Password
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <div class="input-group">
                    <span class="input-group-addon">Password</span>
                    <input type="text" name="adminPassword" class="form-control">
                    <span class="input-group-addon" style="padding:0">
                        <button class="btn btn-xs btn-info">Gerar password</button>
                    </span>
                </div>
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
                    <span class="input-group-addon">Previlégio</span>
                    <select class="js-example-basic-multiple bg-white" name="poiCityName" style="width: 100%;">
                        <option value="2">Gestor de Conteudo</option>
                            ...
                        <option value="3">Editor de Aluguer</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="isActive" value="1"><span>Activar conta</span>
                </label>
            </div>
            <div class="col-xs-6 col-md-6 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="isPublic" value="1"><span>Tornar conta publica</span>
                </label>
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
        Foto de Perfil
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
        $('.js-example-basic-multiple').select2();
    });
</script>