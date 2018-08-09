<?php
    include_once('_include/_models/faq.php');
    $faq = new Faq($MAIN->db);
    // var_dump($faq->fetchAll());
?>
<h3 class="page-title">Perguntas e Respostas</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addFaq" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Nova Pergunta&Resposta</button>
                <button type="button" class="btn btn-warning pull-right" id="puplate-input">Populate input</button>

                <div id="addFaq" class="row collapse">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Pergunta(PT)</span>
                            <input type="text" name="faqQuestion-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Pergunta(EN)</span>
                            <input type="text" name="faqQuestion-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Resposta(PT)</span>
                        <textarea name="faqAnswer-PT" id="faqAnswerPT" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Resposta(EN)</span>
                        <textarea name="faqAnswer-EN" id="faqAnswerEN" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" class="btn btn-success pull-right" id="add-faq">Inserir</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Actividades Existentes
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover" id="faq-table">
                <thead>
                    <th>ID</th>
                    <th>Pergunta(PT)</th>
                    <th>Resposta(PT)</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                <?php
                    $resp = $faq->fetchAll();
                    if(!empty($resp)){
                        for($faqCounter = 0; $faqCounter < count($resp); $faqCounter++){
                            echo '<tr data-content-type="faq" data-content-id="'.$resp[$faqCounter]->faq_link_ID.'">';
                            echo '<td>'.$resp[$faqCounter]->faq_link_ID.'</td>';
                            echo '<td>'.$resp[$faqCounter]->questionTranslated.'</td>';
                            echo '<td>'.$resp[$faqCounter]->answerTranslated.'</td>';
                            echo '<td>
                                <a href="?edit=faq&id='.$resp[$faqCounter]->faq_link_ID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                                <button class="btn btn-danger btn-xs pull-right" id="delete-faq"><span class="lnr lnr-trash"></span></button>
                            </td></tr>';
                            echo'
                            <tr data-content-type="faq" data-content-id="'.$resp[$faqCounter]->faq_link_ID.'" id="collapseGallery-'.$resp[$faqCounter]->faq_link_ID.'" class="collapse">
                                <td colspan="14" class="bg-info">
                                    <form enctype="multipart/form-data" method="post" class="file-upload" id="'.$resp[$faqCounter]->faq_link_ID.'">
                                        <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]" multiple="multiple">
                                        <input type="submit" class="btn btn-primary pull-right" name="Submit" value="Upload">
                                    </form>
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
    $( document ).ready(function() {
        CKEDITOR.replace( 'faqAnswerPT' );
        CKEDITOR.replace( 'faqAnswerEN' );
        
        /* Create new entry */
            document.getElementById('add-faq').onclick = function(){
                addContent(this.id);
            };
        /* Create new entry */

        /* Delete faq start function */
            $(document).on('click', '#delete-faq', function(){
                let data = $(this).closest('tr').data();
                modalWindow('modal-window',data['contentType'], data['contentId']);
            });
        /* Delete faq start function */

        /* fill input with dummy text */
            document.getElementById('puplate-input').onclick = function(){
                inputFiller('faq');
            };
        /* fill input with dummy text */
    });
</script>