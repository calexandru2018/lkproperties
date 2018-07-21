<h3 class="page-title">Cidades</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCity" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Nova Cidade</button>
                <div id="addCity" class="row collapse">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nome(PT)</span>
                            <input type="text" name="cityName-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nome(EN)</span>
                            <input type="text" name="cityName-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <!-- <div class="input-group"> -->
                            <span class="input-group-addon" id="basic-addon1">Descrição(PT)</span>
                            <textarea name="cityDesc-PT" class="form-control" id="cityDescPT" rows="4"></textarea>
                        <!-- </div> -->
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <!-- <div class="input-group"> -->
                            <span class="input-group-addon" id="basic-addon1">Descrição(EN)</span>
                            <textarea name="cityDesc-EN" class="form-control" id="cityDescEN" rows="4"></textarea>
                        <!-- </div> -->
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Código Postal</span>
                            <input type="text" name="postalCode" class="form-control" placeholder="8500 ou 8200">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" class="btn btn-success mb-xs-3 pull-right">Inserir</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Cidades Existentes
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>ID</th>
                    <th>Nome(PT)</th>
                    <th>Descrição(PT)</th>
                    <th>Nome(EN)</th>
                    <th>Descrição(EN)</th>
                    <th>Galeria</th>
                </thead>
                <tbody>
                    <tr data-city-id="1">
                        <td>
                            1
                        </td>
                        <td>
                            Portimão
                        </td>
                        <td>
                            E uma cidade bonita
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis, quae perferendis sed, doloremque eligendi suscipit possimus eaque sapiente odit vero eius soluta perspiciatis vitae. Voluptatem quas fuga esse accusamus mollitia!
                        </td>
                        <td>
                            Portimão
                        </td>
                        <td>
                            It is a beatiful city
                        </td>
                        <td class="text-center">
                            <buton class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-1" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </buton>
                        </td>
                    </tr>
                    <tr id="collapseGallery-1" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr data-property-id="2">
                        <td>
                            2
                        </td>
                        <td>
                            Alvor
                        </td>
                        <td>
                            Cidade pequena e simples
                        </td>
                        <td>
                            Alvor
                        </td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur voluptatum dolores dolor deleniti. Earum, optio dolorum a ea similique dolorem autem excepturi, ratione quidem quod perferendis placeat provident modi. Quis?
                        </td>
                        <td class="text-center">
                            <buton class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-2" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </buton>
                        </td>
                    </tr>
                    <tr id="collapseGallery-2" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr data-property-id="3">
                        <td>
                            3
                        </td>
                        <td>
                            Lagos
                        </td>
                        <td>   
                            Cidade mutio turistica
                        </td>
                        <td>
                            Lagos
                        </td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione iste optio atque obcaecati accusamus, error veniam sapiente quae, quos reiciendis quidem, cupiditate dolore! Neque modi veniam cum hic, dicta officia.
                        </td>
                        <td class="text-center">
                            <buton class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-3" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </buton>
                        </td>
                    </tr>
                    <tr id="collapseGallery-3" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr data-property-id="4">
                        <td>
                            4
                        </td>
                        <td>
                            Lagoa
                        </td>
                        <td>   
                            Cidade mutio turistica
                        </td>
                        <td>
                            Lagoa
                        </td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione iste optio atque obcaecati accusamus, error veniam sapiente quae, quos reiciendis quidem, cupiditate dolore! Neque modi veniam cum hic, dicta officia.
                        </td>
                        <td class="text-center">
                            <buton class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-4" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </buton>
                        </td>
                    </tr>
                    <tr id="collapseGallery-4" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr data-property-id="5">
                        <td>
                            5
                        </td>
                        <td>
                            Lisboa
                        </td>
                        <td>   
                            Cidade mutio turistica
                        </td>
                        <td>
                            Lissbon
                        </td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione iste optio atque obcaecati accusamus, error veniam sapiente quae, quos reiciendis quidem, cupiditate dolore! Neque modi veniam cum hic, dicta officia.
                        </td>
                        <td class="text-center">
                            <buton class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-5" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </buton>
                        </td>
                    </tr>
                    <tr id="collapseGallery-5" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        CKEDITOR.replace( 'cityDescPT' );
        CKEDITOR.replace( 'cityDescEN' );
    });
</script>