<h3 class="page-title">Actividades</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCity" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Nova Actividade</button>
                <div id="addCity" class="row collapse">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(PT)</span>
                            <input type="text" name="activityName-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(EN)</span>
                            <input type="text" name="activityName-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Descrição(PT)</span>
                        <textarea name="activityDesc-PT" id="activityDescPT" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Descrição(EN)</span>
                        <textarea name="activityDesc-EN" id="activityDescEN" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Cidade</span>
                            <select class="js-example-basic-multiple bg-white" name="activityCityName" style="width: 100%;">
                                <option value="AL">Alabama</option>
                                    ...
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
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
                    <th>Cidade</th>
                    <th>Nome(PT)</th>
                    <th>Descrição(PT)</th>
                    <th>Nome(EN)</th>
                    <th>Descrição(EN)</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Portimão
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
                            Alvor
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
                            Lisboa
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
                            Lisboa
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
                            Leiria
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
        CKEDITOR.replace( 'activityDescPT' );
        CKEDITOR.replace( 'activityDescEN' );
        $('.js-example-basic-multiple').select2();
    });
</script>