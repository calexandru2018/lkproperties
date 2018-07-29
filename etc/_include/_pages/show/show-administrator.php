<?php
    include_once('_include/_models/admin.php');
    $administrator = new Administrator($MAIN->db);
    // var_dump($administrator->showAll());
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
                            <input type="text" name="adminName" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input type="email" name="adminEmail" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Password</span>
                            <input type="text" name="adminPassword" class="form-control">
                            <span class="input-group-addon" style="padding:0">
                                <button class="btn btn-xs btn-info">Gerar password</button>
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
                                <option value="2">Gestor de Conteudo</option>
                                    ...
                                <option value="3">Editor de Aluguer</option>
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
                        $resp = $administrator->showAll();
                            for($adminCounter = 0; $adminCounter < count($resp); $adminCounter++){
                                switch($resp[$adminCounter]->adminPrivilege){
                                    case 1: $adminPriv = 'Super Admin';
                                        break;
                                    case 2: $adminPriv = 'Gestor de Conteudo';
                                        break;
                                    case 3: $adminPriv = 'Editor de Aluguer';
                                        break;
                                };
                                echo '<tr  data-content-type="admin" data-content-id="'.$resp[$adminCounter]->admin_ID.'"><td>'.$resp[$adminCounter]->admin_ID.'</td>';
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
                                <tr id="collapseGallery-'.$resp[$adminCounter]->admin_ID.'" class="collapse">
                                    <td colspan="14" class="bg-info">
                                        <form action="ajax/admin/gallery-admin.php" class="dropzone" id="dropzoneId'.$adminCounter.'" name="dropzoneId'.$adminCounter.'"></form>
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
    $(document).ready(function() {
    /* Plugin scripts */
        $('.js-example-basic-multiple').select2();
    /* Plugin scripts */

    /* Add Admin functions */
        document.getElementById('add-admin').onclick = function(){
            let responseData = {}; 
            let info = document.querySelectorAll("[name^=admin");
            var curatedObject = $.param(filterContent(info));
            axios.post(
                'ajax/admin/add-admin.php', 
                {
                    curatedObject,
                }, 
                {
                    headers: { 
                        'Content-Type': 'application/x-www-form-urlencoded',
                    }
                } 
            )
            .then(function (response) {
                if(response.data != false){
                    console.log('Inserted with ID: ' + response.data);
                    populateTable(response.data, 'admin-table', 'data-admin-id');
                }else{
                    alert('Did not insert');
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    /* Add Admin functions */

    /* Delete Admin start function */
    $(document).on('click', '#delete-admin', function(){
        let data = $(this).closest('tr').data();
        modalWindow('modal-window',data['contentType'], data['contentId']);
    });
    /* Delete Admin start function */

    /* Additional support functions */
        function filterContent(arrayContent){
            adminObject = {};
            for(let x = 0; x < arrayContent.length; x++){
                if(arrayContent[x].type == 'checkbox')
                    if(arrayContent[x].checked){
                        arrayContent[x].value = 1;
                    }else{
                        arrayContent[x].value = 0;
                    }
                adminObject[arrayContent[x].name] = arrayContent[x].value;
            }
            return adminObject;
        }
    /* Additional support functions */
    });
</script>