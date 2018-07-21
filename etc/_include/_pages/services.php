<h3 class="page-title">Serviços Comuns</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCommonService" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Novo Serviço Comum</button>
                <div id="addCommonService" class="row collapse">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(PT)</span>
                            <input type="text" name="commonServiceNamePT-1" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(EN)</span>
                            <input type="text" name="commonServiceNameEN-1" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                            <span class="input-group-addon" style="padding: 0 !important">
                                <button type="button" data-toggle="collapse" class="btn btn-info btn-block pull-left" id="addFields">Adicionar</button>
                            </span>
                            <input type="text" id="rowsToAdd" class="form-control" style="padding: 17px 10px;">
                            <span class="input-group-addon">
                                Novos Campos
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <input type="hidden" id="rowCounter" name="rowCounter" />
                        <button  type="button" data-toggle="collapse" class="btn btn-success mb-xs-3 pull-right">Inserir</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Serviços Comuns
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>ID</th>
                    <th>Nome(PT)</th>
                    <th>Nome(EN)</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Maquina de Lavar
                        </td>
                        <td>
                            Washing Machine
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            Maquina de Loiça
                        </td>
                        <td>
                            Dishwashing Machine
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            Utensilios de Cozinha
                        </td>
                        <td>
                            Kitchenware
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var counter = 0;
        $(document).on('click', '#addFields', function(){
            var rowsToAdd = $('#rowsToAdd').val();
            var rowCounter = $('#rowCounter').val();
            var rowCheck;
            if(rowsToAdd > 0){
                while(true){
                    if(rowCounter == 0){
                        rowCheck = 0;
                    }else{
                        rowCheck = rowCounter;
                    }
                    console.log('Row check: ' + rowCheck);
                    counter++;
                    $('#addCommonService').prepend(`
                        <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                            <div class="input-group">
                                <span class="input-group-addon">Nome(PT)</span>
                                <input type="text" name="commonServiceNamePT-` + (parseInt(rowCheck) + parseInt((counter + 1)))  + `" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                            <div class="input-group">
                                <span class="input-group-addon">Nome(EN)</span>
                                <input type="text" name="commonServiceNameEN-` + (parseInt(rowCheck) + parseInt((counter + 1)))  + `" class="form-control">
                            </div>
                        </div>
                    `);
                    if(counter == rowsToAdd){
                        if(rowCounter == 0){
                            $('#rowCounter').val(counter);
                        }else{
                            $('#rowCounter').val(parseInt(rowCounter) + parseInt(counter));
                        }
                        counter = 0;
                        break;
                    }
                } 
            }
        });
    });
</script>