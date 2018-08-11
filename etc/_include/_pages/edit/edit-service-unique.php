<?php
    include_once('_include/_models/service-unique.php');
    $su = new SU($MAIN->db);
    $suData = $su->fetchSU($_GET['id']);
    $canEdit = $su->showEditPage($_GET["edit"], $_GET["id"], empty($suData));
    if($canEdit === 1)
    {
?>
    <h3 class="page-title">Editar Serviço Único: <?php echo $suData['pt']['uniqueServiceTranslated']; ?></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Nome
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nome(PT)</span>
                        <input type="text" name="uniqueServiceName-PT" value="<?php echo $suData['pt']['uniqueServiceTranslated']; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Nome(EN)</span>
                        <input type="text" name="uniqueServiceName-EN"  value="<?php echo $suData['en']['uniqueServiceTranslated']; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="service_unique-saveName">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
<?php }?>