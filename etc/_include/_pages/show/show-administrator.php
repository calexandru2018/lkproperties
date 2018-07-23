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
                            <input type="text" name="adminEmail" class="form-control">
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
                            <input type="checkbox" name="isActive" value="1"><span>Activar conta</span>
                        </label>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center" style="margin-top: 2%; margin-bottom: 2%;">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="isPublic" value="1"><span>Tornar conta publica</span>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Previlégio</span>
                            <select class="js-example-basic-multiple bg-white" name="poiCityName" style="width: 100%;">
                                <option value="2">Gestor de Conteudo</option>
                                    ...
                                <option value="3">Editor de Aluguer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" class="btn btn-success mb-xs-3 pull-right">Inserir</button>
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
            <table class="table table-hover">
                <thead>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Criado em</th>
                    <th>Alterado em</th>
                    <th>Activo</th>
                    <th>Publico</th>
                    <th>Previlegio</th>
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
                            <a href="?edit=administrator&id=2" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
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
                            <a href="?edit=administrator&id=2" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
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
    });
</script>