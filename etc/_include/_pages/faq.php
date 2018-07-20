<h3 class="page-title">Perguntas e Respostas</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCity" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Nova Pergunta&Resposta</button>
                <div id="addCity" class="row collapse">
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
                        <button  type="button" data-toggle="collapse" class="btn btn-success mb-xs-3 pull-right">Inserir</button>
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
            <table class="table table-hover">
                <thead>
                    <th>ID</th>
                    <th>Pergunta(PT)</th>
                    <th>Resposta(PT)</th>
                    <th>Pergunta(EN)</th>
                    <th>Resposta(EN)</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Praia da Rocha
                        </td>
                        <td>
                            E uma cidade bonita
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis, quae perferendis sed, doloremque eligendi suscipit possimus eaque sapiente odit vero eius soluta perspiciatis vitae. Voluptatem quas fuga esse accusamus mollitia!
                        </td>
                        <td>
                            Rocha Beach
                        </td>
                        <td>
                            It is a beatiful city
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            Praia de Alvor
                        </td>
                        <td>
                            Cidade pequena e simples
                        </td>
                        <td>
                            Alvor Beach
                        </td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur voluptatum dolores dolor deleniti. Earum, optio dolorum a ea similique dolorem autem excepturi, ratione quidem quod perferendis placeat provident modi. Quis?
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            Museu das Artes
                        </td>
                        <td>   
                            Cidade mutio turistica
                        </td>
                        <td>
                            Art Meuseum
                        </td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione iste optio atque obcaecati accusamus, error veniam sapiente quae, quos reiciendis quidem, cupiditate dolore! Neque modi veniam cum hic, dicta officia.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>
                            Parque de Atrações
                        </td>
                        <td>   
                            Cidade mutio turistica
                        </td>
                        <td>
                            Atraction Park
                        </td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione iste optio atque obcaecati accusamus, error veniam sapiente quae, quos reiciendis quidem, cupiditate dolore! Neque modi veniam cum hic, dicta officia.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5
                        </td>
                        <td>
                            Museu da Ciencia
                        </td>
                        <td>   
                            Cidade mutio turistica
                        </td>
                        <td>
                            Science museum
                        </td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione iste optio atque obcaecati accusamus, error veniam sapiente quae, quos reiciendis quidem, cupiditate dolore! Neque modi veniam cum hic, dicta officia.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        CKEDITOR.replace( 'faqAnswerPT' );
        CKEDITOR.replace( 'faqAnswerEN' );
    });
</script>