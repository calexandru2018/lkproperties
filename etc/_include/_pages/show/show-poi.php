<h3 class="page-title">Pontos de Interesse(Point Of Interest)</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCity" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Novo POI</button>
                <div id="addCity" class="row collapse">
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(PT)</span>
                            <input type="text" name="poiName-PT" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Nome(EN)</span>
                            <input type="text" name="poiName-EN" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Descrição(PT)</span>
                        <textarea name="poiDesc-PT" id="poiDescPT" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                        <span class="input-group-addon" >Descrição(EN)</span>
                        <textarea name="poiDesc-EN" id="poiDescEN" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <div class="input-group">
                            <span class="input-group-addon">Cidade</span>
                            <select class="js-example-basic-multiple bg-white" multiple="multiple" name="poiCityName" style="width: 100%;">
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
        POI Existentes
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
                    <th>Galeria</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    <tr data-poi-id="1">
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
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique iusto earum voluptate quis excepturi. Quia doloribus veniam eligendi voluptatem ex vel sit explicabo facere maxime perferendis. Facilis eveniet mollitia voluptatem.
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-1" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                            <a href="?edit=poi&id=2" class="btn btn-info btn-xs pull-left"style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
                        </td>
                    </tr>
                    
                    <tr id="collapseGallery-1" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr data-poi-id="2">
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
                        <td class="text-center">
                            <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-2" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                            <a href="?edit=poi&id=2" class="btn btn-info btn-xs pull-left"style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
                        </td>
                    </tr>
                    
                    <tr id="collapseGallery-2" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr data-poi-id="3">
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
                        <td class="text-center">
                            <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-3" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                            <a href="?edit=poi&id=2" class="btn btn-info btn-xs pull-left"style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
                        </td>
                    </tr>
                    
                    <tr id="collapseGallery-3" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr data-poi-id="4">
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
                        <td class="text-center">
                            <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-4" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                            <a href="?edit=poi&id=2" class="btn btn-info btn-xs pull-left"style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
                        </td>
                    </tr>
                    
                    <tr id="collapseGallery-4" class="collapse">
                        <td colspan="14" class="bg-info">
                            <form action="upload.php" class="dropzone"></form>
                        </td>
                    </tr>
                    <tr data-poi-id="5">
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
                        <td class="text-center">
                            <button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-5" data-toggle="collapse">
                                <i class="lnr lnr-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                            <a href="?edit=poi&id=2" class="btn btn-info btn-xs pull-left"style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                            <button class="btn btn-danger btn-xs pull-right"><span class="lnr lnr-trash"></span></button>
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
    $( document ).ready(function() {
        CKEDITOR.replace( 'poiDescPT' );
        CKEDITOR.replace( 'poiDescEN' );
        $('.js-example-basic-multiple').select2();
    });
</script>