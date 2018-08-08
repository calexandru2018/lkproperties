<?php
    include_once('_include/_models/faq.php');
    $faq = new Faq($MAIN->db);
    $faqData = $faq->fetchFaq($_GET['id']);
    $canEdit = $faq->showEditPage($_GET["edit"], $_GET["id"], empty($faqData));
    var_dump($faqData);
    if($canEdit === 1)
    {
?>
    <h3 class="page-title">FAQ: <?php echo $faqData['pt']['questionTranslated']; ?></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Perguntas
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Pergunta(PT)</span>
                        <input type="text" name="faqQuestion-PT" class="form-control" value="<?php echo $faqData['pt']['questionTranslated'];?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                        <span class="input-group-addon">Pergunta(EN)</span>
                        <input type="text" name="faqQuestion-EN" class="form-control" value="<?php echo $faqData['en']['questionTranslated'];?>">
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-success pull-right save" id="faq-saveQuestion">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Respostas
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <span class="input-group-addon" >Resposta(PT)</span>
                    <textarea name="faqAnswer-PT" id="faqAnswerPT" class="form-control" rows="4"></textarea>
                    <div id="faqDescENHolder" style="visibility: hidden"><?php echo $faqData['pt']['answerTranslated'];?></div>
                    </div>
                <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <span class="input-group-addon" >Resposta(EN)</span>
                    <textarea name="faqAnswer-EN" id="faqAnswerEN" class="form-control" rows="4"></textarea>
                    <div id="faqDescENHolder" style="visibility: hidden"><?php echo $faqData['en']['answerTranslated'];?></div>
                    </div>
                <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                    <button  type="button" class="btn btn-success pull-right save" id="faq-saveAnswer">Guardar Alteração</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            baguetteBox.run('.gallery-block');
            CKEDITOR.replace( 'faqAnswerPT' );
            CKEDITOR.replace( 'faqAnswerEN' );
            var descPT = document.querySelector('#faqDescPTHolder').innerHTML;
            var descEN = document.querySelector('#faqDescENHolder').innerHTML;
            CKEDITOR.instances['faqDescPT'].setData(descPT) ;
            CKEDITOR.instances['faqDescEN'].setData(descEN) ;
        });
    </script>
<?php } ?>