<?php
    include_once('_include/_models/service-common.php');
    $sc = new SC($MAIN->db);
    // var_dump($administrator->showAll());
?>
<h3 class="page-title">Serviços Comuns</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCommonService" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Novo Serviço Comum</button>
                <button type="button" class="btn btn-warning pull-right" id="puplate-input">Populate input</button>

                <div id="addCommonService" class="row collapse">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(PT)</span>
                            <input type="text" name="service_CommonName-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(EN)</span>
                            <input type="text" name="service_CommonName-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                            <span class="input-group-addon">
                                Novos Campos
                            </span>
                            <input type="text" id="rowsToAdd" class="form-control" style="padding: 17px 10px;">
                            <span class="input-group-addon" style="padding: 0 !important">
                                <button type="button" data-toggle="collapse" class="btn btn-info btn-block pull-left" id="addFields">Adicionar</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <input type="hidden" id="rowCounter" name="rowCounter" />
                        <button  type="button" data-toggle="collapse" class="btn btn-success pull-right"  id="add-service_Common">Inserir</button>
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
            <table class="table table-hover" id="service_Common-table">
                <thead>
                    <th>ID</th>
                    <th>Nome(PT)</th>
                    <th>Adicionado</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                <?php
                    $resp = $sc->fetchAll();
                    for($scCounter = 0; $scCounter < count($resp); $scCounter++){
                        echo '<tr data-content-type="service_Common" data-content-id="'.$resp[$scCounter]->common_service_link_ID.'">';
                        echo '<td>'.$resp[$scCounter]->common_service_link_ID.'</td>';
                        echo '<td>'.$resp[$scCounter]->serviceTranslated.'</td>';
                        echo '<td>'.$resp[$scCounter]->dateCreated.'</td>';
                        echo '<td>
                            <a href="?edit=service-common&id='.$resp[$scCounter]->common_service_link_ID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right" id="delete-service_Common"><span class="lnr lnr-trash"></span></button>
                        </td></tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        /* Create new entry */
            document.getElementById('add-service_Common').onclick = function(){
                addContent(this.id, true, true);
            };
        /* Create new entry */

        /* Delete service_Common start function */
            $(document).on('click', '#delete-service_Common', function(){
                let data = $(this).closest('tr').data();
                modalWindow('modal-window',data['contentType'], data['contentId']);
            });
        /* Delete service_Common start function */

        /* fill input with dummy text */
            document.getElementById('puplate-input').onclick = function(){
                inputFiller('service_Common');
            }
        /* fill input with dummy text */

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
                                <input type="text" name="service_CommonName-PT" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                            <div class="input-group">
                                <span class="input-group-addon">Nome(EN)</span>
                                <input type="text" name="service_CommonName-EN" class="form-control">
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