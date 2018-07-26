<?php
    include_once('_include/_models/admin.php');
    $administrator = new Administrator($MAIN->db);
    //var_dump($administrator->showAll());
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
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Alexandru
                        </td>
                        <td>
                            test@test.com
                        </td>
                        <td>
                            2013-23-2
                        </td>
                        <td>
                            2018-2-2
                        </td>
                        <td>
                            Sim
                        </td>
                        <td>
                            Nao
                        </td>
                        <td>
                            Super Admin
                        </td>
                        <td>
                            <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-1" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                            <a href="?edit=administrator&id=2" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
                        </td>
                    </tr>
                    <tr id="collapseGallery-1" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            Lilia
                        </td>
                        <td>
                            test@test.com
                        </td>
                        <td>
                            2013-23-2
                        </td>
                        <td>
                            2018-2-2
                        </td>
                        <td>
                            Sim
                        </td>
                        <td>
                            Sim
                        </td>
                        <td>
                            Gestor de Conteudo
                        </td>
                        <td>
                            <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-2" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                            <a href="?edit=administrator&id=2" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
                        </td>
                    </tr>
                    <tr id="collapseGallery-2" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="ajax/gallery/gallery-admin.php" class="dropzone"></form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $('.js-example-basic-multiple').select2();

        let addAdminButton = document.getElementById('add-admin');
        addAdminButton.onclick = function(){
            let info = {};
            info = document.querySelectorAll("[name^=admin");
            var curatedObject = $.param(filterContent(info));
            /* axios.post(
                'ajax/add-admin.php', 
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
                if(response.data != false)
                    alert('Inserted with ID: ' + response.data)
                else
                    alert('Did not insert')
            })
            .catch(function (error) {
                console.log(error);
            }); */
            var tableRef = document.getElementById('admin-table').getElementsByTagName('tbody')[0];
            var firstRow   = tableRef.insertRow(tableRef.rows.length);
            // var secondRow   = tableRef.insertRow(tableRef.rows.length); gallery row
            var cell1 = firstRow.insertCell(0);
            var cell2 = firstRow.insertCell(1);
            var cell3 = firstRow.insertCell(2);
            var cell4 = firstRow.insertCell(3);
            var cell5 = firstRow.insertCell(4);
            var cell6 = firstRow.insertCell(5);
            var cell7 = firstRow.insertCell(6);
            var cell8 = firstRow.insertCell(7);
            var cell9 = firstRow.insertCell(8);
            var cell10 = firstRow.insertCell(9);
            cell1.innerHTML='1';
            cell2.innerHTML='Test';
            cell3.innerHTML='emails.test';
            cell4.innerHTML='none';
            cell5.innerHTML='none1';
            cell6.innerHTML='Yes';
            cell7.innerHTML='No';
            cell8.innerHTML='SuperAdmin';
            cell9.innerHTML=`
                <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-2" data-toggle="collapse">
                    <i class="lnr lnr-plus-circle"></i>
                </button>
            `;
            cell10.innerHTML=`
                <a href="?edit=administrator&id=2" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
                        
            `;
        } 
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

        
    });
</script>