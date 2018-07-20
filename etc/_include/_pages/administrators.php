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
                                <button class="btn btn-xs btn-warning">Gerar password</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;">
                        <h5>Activar Conta</h5>
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Sim
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Não
                        </label>
                    </div>
                    <div class="col-xs-6 col-md-3" style="margin-top: 2%; margin-bottom: 2%;">
                        <h5>Tornar Publico</h5>
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Sim
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Não
                        </label>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>