<?php
    include_once('_include/_models/service-common.php');
    $sc = new SC($MAIN->db);
    $scData = $sc->fetchSC($_GET['id']);
    $canEdit = $sc->showEditPage($_GET["edit"], $_GET["id"], empty($scData));
    if($canEdit === 1)
    {
?>
    <h3 class="page-title">Editar Serviço Comum: <?php echo $scData['pt']['serviceTranslated']; ?></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Nome
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nome(PT)</span>
                        <input type="text" name="commonServiceName-PT" value="<?php echo $scData['pt']['serviceTranslated']; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nome(EN)</span>
                        <input type="text" name="commonServiceName-EN" value="<?php echo $scData['en']['serviceTranslated']; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="service_common-saveName">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
<?php }?>