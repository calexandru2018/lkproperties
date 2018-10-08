<?php
    include_once('_include/_models/admin.php');
    $administrator = new Administrator($MAIN->db);
    $adminData = $administrator->fetchAdmin('edit','', (int)$_GET['id']);
    $canEdit = $administrator->showEditPage($_GET["edit"], $_GET["id"], empty($adminData));
    if($canEdit === 1)
    {
?>
        <h3 class="page-title">Editar Administrador: <?php echo $adminData->name; ?></h3>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Informação Pessoal
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome</span>
                            <input type="text" name="adminName" class="form-control" value="<?php echo $adminData->name; ?>">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input type="text" name="adminEmail" class="form-control" value="<?php echo $adminData->email; ?>">
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button type="button" class="btn btn-success pull-right save" id="admin-savePersInfo">Guardar Alteração</button>
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
                            <input type="text" name="adminPassword" class="form-control" placeholder="Escreva ou pressione no botao para gerar">
                            <span class="input-group-addon" style="padding:0">
                                <a class="btn btn-xs btn-info" id="generate-password">Gerar Nova Password</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" class="btn btn-success pull-right save" id="admin-savePassword" >Guardar Alteração</button>
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
                            <select class="js-example-basic-multiple bg-white" name="adminPriveliege" style="width: 100%;">
                                <?php
                                    if($_SESSION['admin_privilege'] == 1)
                                        echo '<option value="2"'.(($adminData->adminPrivilege == 2)? "select=selected":"").'>Super Admin</option>';
                                ?>
                                <option value="2" <?php echo (($adminData->adminPrivilege == 2)? 'select=selected':''); ?>>Gestor de Conteudo</option>
                                <option value="3" <?php echo (($adminData->adminPrivilege == 3)? 'select=selected':''); ?>>Editor de Aluguer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="adminIsActive" value="1" <?php echo (($adminData->isActive == 1)? 'checked=checked':''); ?>><span>Activar conta</span>
                        </label>
                    </div>
                    <div class="col-xs-6 col-md-6 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="adminIsPublic" value="1" <?php echo (($adminData->isPublicVisible == 1)? 'checked=checked':''); ?>><span>Tornar conta publica</span>
                        </label>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" class="btn btn-success pull-right save" id="admin-saveOtherInfo">Guardar Alteração</button>
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
                    <?php if($adminData->thumbnailURL !== null){?>
                        <div class="col-xs-6 item" style="margin: 5px 0">
                            <a class="lightbox" href="../gallery/ourstaff/<?php echo $adminData->thumbnailURL; ?>">
                                <img class="img-responsive image scale-on-hover" src="../gallery/ourstaff/<?php echo $adminData->thumbnailURL; ?>">
                            </a>
                            <button class="btn btn-danger delete-photo" data-content-type="admin" data-content-id="<?php echo $adminData->admin_ID ;?>" style="position: absolute;z-index: 1;top: 0;">
                                <i class="lnr lnr-trash"></i>
                            </button>
                        </div>
                    <?php }?>
                    </div>
                </section>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                baguetteBox.run('.gallery-block');
                $('.js-example-basic-multiple').select2();
                document.getElementById("generate-password").onclick = function() {
                    generatePassword();
                };
                function generatePassword() {
                    var length = 8,
                        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                        retVal = "";
                    for (var i = 0, n = charset.length; i < length; ++i) {
                        retVal += charset.charAt(Math.floor(Math.random() * n));
                    }
                    document.querySelector('input[name="adminPassword"]').value = retVal;
                    // return retVal;
                }
            });
        </script>
<?php
    $administrator->closeConnection($MAIN->db);
    }
?>
