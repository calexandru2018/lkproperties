<?php
    include_once('_include/_models/admin.php');
    $administrator = new Administrator($MAIN->db);
    if($_SESSION['admin_privilege'] == 1 || $_SESSION['admin_privilege'] == 99){
?>
<h3 class="page-title">Gestão de Administradores</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCity" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Novo Administrador</button>
                <div id="addCity" class="row collapse">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome</span>
                            <input type="text" name="adminName" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input type="email" name="adminEmail" class="form-control" data-optional="false">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Password</span>
                            <input type="text" name="adminPassword" class="form-control">
                            <span class="input-group-addon" style="padding:0" data-optional="false">
                                <button class="btn btn-xs btn-info" id="generate-password">Gerar password</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="adminIsActive" value="1"><span>Activar conta</span>
                        </label>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="adminIsPublic" value="1"><span>Tornar conta publica</span>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Previlégio</span>
                            <select class="js-example-basic-multiple bg-white" name="adminPriveliege" style="width: 100%;">
                                <option value="" selected disable>Escolha um previlegio...</option>
                                <option value="1">Administrador</option>
                                <option value="2">Gestor de Conteudo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <button type="button" data-toggle="collapse" class="btn btn-success pull-right" id="add-admin">Inserir</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Administradores Existentes
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover" id="admin-table">
                <thead>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Criado em</th>
                    <th>Alterado em</th>
                    <th>Activo</th>
                    <th>Publico</th>
                    <th>Previlegio</th>
                    <th>Galeria</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    <?php
                        $resp = $administrator->fetchAll();
                        if(!empty($resp)){
                            for($adminCounter = 0; $adminCounter < count($resp); $adminCounter++){
                                switch($resp[$adminCounter]->adminPrivilege){
                                    case 1: $adminPriv = 'Administrador';
                                        break;
                                    case 2: $adminPriv = 'Gestor de Conteudo';
                                        break;
                                    case 99: $adminPriv = 'Super Admin';
                                        break;
                                };
                                echo '<tr data-content-type="admin" data-content-id="'.$resp[$adminCounter]->admin_ID.'">';
                                echo '<td>'.$resp[$adminCounter]->admin_ID.'</td>';
                                echo '<td>'.$resp[$adminCounter]->name.'</td>';
                                echo '<td>'.$resp[$adminCounter]->email.'</td>';
                                echo '<td>'.$resp[$adminCounter]->dateCreated.'</td>';
                                echo '<td>'.$resp[$adminCounter]->dateModified.'</td>';
                                echo '<td>'.(($resp[$adminCounter]->isActive == 1)? 'Sim':'Não').'</td>';
                                echo '<td>'.(($resp[$adminCounter]->isPublicVisible == 1)? 'Sim':'Não').'</td>';
                                echo '<td>'.$adminPriv.'</td>';
                                echo '<td>
                                        <a class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$resp[$adminCounter]->admin_ID.'" data-toggle="collapse">
                                            <i class="lnr lnr-plus-circle"></i>
                                        </a>
                                </td>';
                                echo '<td>
                                    <a href="?edit=administrator&id='.$resp[$adminCounter]->admin_ID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                                    <button class="btn btn-danger btn-xs pull-right" id="delete-admin"><span class="lnr lnr-trash"></span></button>
                                </td></tr>';
                                echo'
                                <tr data-content-type="admin" data-content-id="'.$resp[$adminCounter]->admin_ID.'" id="collapseGallery-'.$resp[$adminCounter]->admin_ID.'" class="collapse">
                                    <td colspan="14" class="bg-info">
                                        <form enctype="multipart/form-data" method="post" class="file-upload" id="'.$resp[$adminCounter]->admin_ID.'">
                                            <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]">
                                            <input type="submit" class="btn btn-primary pull-right" name="Submit" value="Upload">
                                        </form>
                                        <div class="cssload-container hidden">
                                            <div class="cssload-whirlpool"></div>
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
    $(document).ready(function(e) {
        /* Plugin scripts */
            $('.js-example-basic-multiple').select2();
        /* Plugin scripts */

        /* Upload script */
            var newUpload = new uploadPhotos('ajax/admin/add-photo-admin.php', document.querySelectorAll('.file-upload'));
            newUpload.upload();
        /* Upload script */

        /* Create new entry */
            document.getElementById('add-admin').onclick = function(){
                addContent(this.id, false, true);
            };
        /* Create new entry */

        /* Delete Admin start function */
            $(document).on('click', '#delete-admin', function(){
                let data = $(this).closest('tr').data();
                modalWindow('modal-window',data['contentType'], data['contentId']);
            });
        /* Delete Admin start function */

        /* Password generator */
        document.getElementById('generate-password').onclick = function(){
            let info = document.querySelectorAll("[name=adminPassword");
                info[0].value = fill();
        }
        /* Password generator */
    });
</script>
<?php } ?>