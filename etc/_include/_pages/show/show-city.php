<?php
    include_once('_include/_models/city.php');
    $city = new City($MAIN->db);
    // var_dump($administrator->showAll());
?>
<h3 class="page-title">Cidades</h3>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav">
            <li>
                <button href="#addCity" type="button" data-toggle="collapse" class="btn btn-primary collapsed mb-xs-3">Adicionar Nova Cidade</button>
                <button type="button" class="btn btn-warning pull-right" id="puplate-input">Populate input</button>
                
                <div id="addCity" class="row collapse">
                    <div class="col-xs-12" style="margin-top: 2%">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="cityIsPopular" value="1"><span>Destacar como "Popular"</span>
                        </label>
                    </div>
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
                            <input type="text" name="cityPostalCode" class="form-control" placeholder="8500 ou 8200">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" style="margin-top: 2%; margin-bottom: 2%;">
                    <div class="input-group">
                            <span class="input-group-addon">Video(URL opcional)</span>
                            <input type="text" name="cityVideoURL" class="form-control" placeholder="8500 ou 8200">
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin-top: 2%; margin-bottom: 2%;">
                        <button  type="button" data-toggle="collapse" class="btn btn-success pull-right" id="add-city">Inserir</button>
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
            <table class="table table-hover" id="city-table">
                <thead>
                    <th>ID</th>
                    <th>Nome(PT)</th>
                    <th>Descrição(PT)</th>
                    <!-- <th>Nome(EN)</th>
                    <th>Descrição(EN)</th> -->
                    <th>Popular</th>
                    <th>Data Adicionado</th>
                    <th>Galeria</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    <?php
                        $resp = $city->fetchAll();
                        for($cityCounter = 0; $cityCounter < count($resp); $cityCounter++){
                            switch($resp[$cityCounter]->isPopular){
                                case 0: $isPopular = 'Nao';
                                    break;
                                case 1: $isPopular = 'Sim';
                                    break;
                            };
                            echo '<tr data-content-type="city" data-content-id="'.$resp[$cityCounter]->city_link_ID.'">';
                            echo '<td>'.$resp[$cityCounter]->city_link_ID.'</td>';
                            echo '<td>'.$resp[$cityCounter]->nameTranslated.'</td>';
                            echo '<td>'.$resp[$cityCounter]->descriptionTranslated.'</td>';
                            echo '<td>'.$isPopular.'</td>';
                            echo '<td>'.$resp[$cityCounter]->dateCreated.'</td>';
                            echo '<td>
                                    <a class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$resp[$cityCounter]->city_link_ID.'" data-toggle="collapse">
                                        <i class="lnr lnr-plus-circle"></i>
                                    </a>
                            </td>';
                            echo '<td>
                                <a href="?edit=city&id='.$resp[$cityCounter]->city_link_ID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
                                <button class="btn btn-danger btn-xs pull-right" id="delete-city"><span class="lnr lnr-trash"></span></button>
                            </td></tr>';
                            echo'
                            <tr data-content-type="city" data-content-id="'.$resp[$cityCounter]->city_link_ID.'" id="collapseGallery-'.$resp[$cityCounter]->city_link_ID.'" class="collapse">
                                <td colspan="14" class="bg-info">
                                    <form enctype="multipart/form-data" method="post" class="file-upload" id="'.$resp[$cityCounter]->city_link_ID.'">
                                        <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]" multiple="multiple">
                                        <input type="submit" class="btn btn-primary pull-right" name="Submit" value="Upload">
                                    </form>
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    /* Plugin scripts */
        CKEDITOR.replace( 'cityDescPT' );
        CKEDITOR.replace( 'cityDescEN' );
    /* Plugin scripts */

    /* Upload script */
        var newUpload = new uploadPhotos('ajax/city/add-photo-city.php', document.querySelectorAll('.file-upload'));
        newUpload.upload();
    /* Upload script */

    /* Add City */
        document.getElementById('add-city').onclick = function(){
            let responseData = {}; 
            let info = document.querySelectorAll("[name^=city");
            var curatedObject = filterContent(info);
            axios.post(
                'ajax/city/add-city.php', 
                {
                    curatedObject,
                }, 
                {
                    headers: { 
                        'Content-Type': 'application/x-www-form-urlencoded',
                    }
                } 
            )
            .then(function (response) {
                if(response.data != false)
                    populateTable(response.data, 'city-table', 'data-city-id');
                
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        };
    /* Add City */

    /* Delete City */
        $(document).on('click', '#delete-city', function(){
            let data = $(this).closest('tr').data();
            modalWindow('modal-window',data['contentType'], data['contentId']);
        });
    /* Delete City */

    /* Additional support functions */
        function filterContent(arrayContent){
            cityObject = {};
            for(let x = 0; x < arrayContent.length; x++){
               if(arrayContent[x].type == 'checkbox')
                    if(arrayContent[x].checked){
                        arrayContent[x].value = 1;
                    }else{
                        arrayContent[x].value = 0;
                    }
                    if(arrayContent[x].type == 'textarea'){
                        cityObject[arrayContent[x].name] = CKEDITOR.instances[arrayContent[x].id].getData();
                    }else{
                        cityObject[arrayContent[x].name] = arrayContent[x].value;
                    }
            }
            return cityObject;
        }
    /* Additional support functions */

    /* Populate with dummy text */
        document.getElementById('puplate-input').onclick = function(){
            let info = document.querySelectorAll("[name^=city");
            info.forEach(function(el){
                if(el.type == 'textarea'){
                    CKEDITOR.instances[el.id].setData(fill()) ;
                }else if(el.name == 'cityPostalCode'){
                    el.value = 8500;
                }else{
                    el.value = fill();
                }
            });
            function fill() {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                for (var i = 0; i < 9; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));

                return text;
            }
        }
    /* Populate with dummy text */
    });
</script>