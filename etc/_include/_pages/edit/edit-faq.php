<h3 class="page-title">FAQ: [Pergunta]</h3>
<div class="panel panel-primary">
    <div class="panel-heading">
        Perguntas
    </div>
    <div class="panel-body">
        <div class="row">
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
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <button type="button" class="btn btn-success pull-right btn-toastr" data-context="success" data-message="Hi, I'm here" data-position="top-right">Guardar Alteração</button>
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert"> <!-- alert-success OR alert-danger-->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> Error ao guardar alterações  <!-- fa fa-check-circle OR fa fa-times-circle-->
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
            </div>
            <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                <span class="input-group-addon" >Resposta(EN)</span>
                <textarea name="faqAnswer-EN" id="faqAnswerEN" class="form-control" rows="4"></textarea>
            </div>
            <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                <button  type="button" class="btn btn-success pull-right btn-toastr" data-context="success" data-message="Hi, I'm here" data-position="top-right">Guardar Alteração</button>
            </div>
            <div class="alert alert-success alert-dismissible" role="alert"> <!-- alert-success OR alert-danger-->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check-circle"></i> Alteração realizada com sucesso  <!-- fa fa-check-circle OR fa fa-times-circle-->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        baguetteBox.run('.gallery-block');
        CKEDITOR.replace( 'faqAnswerPT' );
        CKEDITOR.replace( 'faqAnswerEN' );
    });
</script>