<?php
    session_start();
    require_once('_include/_models/db.php');
    $MAIN = new Database();
    if(!isset($_SESSION['crsf_token']) || empty($_SESSION['crsf_token'])){
        $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
        header('Refresh: 0');
    }
    // echo phpinfo();
?>
<!DOCTYPE html>
<html lang="pt" class="fullscreen-bg">
<head>
	<?php require_once('_include/_general/_head.php'); ?>
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
        <?php
            if(!isset($_SESSION['admin_ID']) || empty($_SESSION['admin_ID'])){
                include('_include/_pages/login.php');
            }else{
        ?>
		<!-- NAVBAR -->
            <?php include('_include/_general/_navbar.php'); ?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
            <?php include('_include/_general/_left-sidebar.php'); ?>
		<!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
            <div class="main">
                <div class="container" id="modal-window" style="z-index: 50; background-color: rgba(150,150,150, 0.2); height: 100%; width: 100%; position: absolute; display:none">
                    
                </div>
                <!-- MAIN CONTENT -->
                <div class="main-content">
                    <div class="container-fluid">
                        <?php
                        if(isset($_GET) && !empty($_GET)){
                            foreach ($_GET as $key => $value) {
                                if($key == 'show'){
                                    switch ($value) {
                                        case 'home' : include('_include/_pages/show/show-main.php');
                                            break;
                                        case 'city' : include('_include/_pages/show/show-city.php');
                                            break;
                                        case 'poi' : include('_include/_pages/show/show-poi.php');
                                            break;
                                        case 'service-common' : include('_include/_pages/show/show-service-common.php');
                                            break;
                                        case 'service-unique' : include('_include/_pages/show/show-service-unique.php');
                                            break;
                                        case 'activity' : include('_include/_pages/show/show-activity.php');
                                            break;
                                        case 'to-rent' : include('_include/_pages/show/show-to-rent.php');
                                            break;
                                        case 'to-sell' : include('_include/_pages/show/show-to-sell.php');
                                            break;
                                        case 'faq' : include('_include/_pages/show/show-faq.php');
                                            break;
                                        case 'administrator' : include('_include/_pages/show/show-administrator.php');
                                            break;
                                    }
                                }
                                if($key == 'edit'){
                                    switch ($value) {
                                        case 'city' : include('_include/_pages/edit/edit-city.php');
                                            break;
                                        case 'poi' : include('_include/_pages/edit/edit-poi.php');
                                            break;
                                        case 'service-common' : include('_include/_pages/edit/edit-service-common.php');
                                            break;
                                        case 'service-unique' : include('_include/_pages/edit/edit-service-unique.php');
                                            break;
                                        case 'activity' : include('_include/_pages/edit/edit-activity.php');
                                            break;
                                        case 'to-rent' : include('_include/_pages/edit/edit-to-rent.php');
                                            break;
                                        case 'to-sell' : include('_include/_pages/edit/edit-to-sell.php');
                                            break;
                                        case 'faq' : include('_include/_pages/edit/edit-faq.php');
                                            break;
                                        case 'administrator' : include('_include/_pages/edit/edit-administrator.php');
                                            break;
                                    }
                                }
                            }
                        }else{
                            include('_include/_pages/show/show-main.php');   
                        }
                        ?>
                    </div>
                    <script>
                    /* Populate table with new input */ 
                        function populateTable(rowContent, tableName, dataName){
                            var tableRef = document.getElementById(tableName).getElementsByTagName('tbody')[0];
                            createFirstRow(rowContent, tableRef, dataName);
                        }

                        function createFirstRow(data, table, dataName){
                            data[1] = data[1].replace(/\\+/g, ' ');
                            
                            var firstRow   = table.insertRow(table.rows.length);
                            firstRow.setAttribute(dataName, data[0]);
                            var cellArray = [];
                            for(var counter = 0; counter < data.length; counter++){
                                cellArray[counter] = firstRow.insertCell(counter);
                                cellArray[counter].innerHTML = data[counter];
                            }
                            createSecondRow(table, data[0], dataName);
                        }

                        function createSecondRow(table, id, dataName){
                            var secondRow   = table.insertRow(table.rows.length);
                            var multiple = '';
                            secondRow.id = 'collapseGallery-' + id;
                            secondRow.className = 'collapse';
                            var galleryCell = secondRow.insertCell(0);
                            galleryCell.setAttribute('data-content-type', dataName);
                            galleryCell.setAttribute('data-content-id', id);
                            if(dataName != 'admin')   {
                                multiple = 'multiple = "multiple"';
                            }
                            galleryCell.className = 'bg-info'
                            galleryCell.innerHTML = `
                                <form enctype="multipart/form-data" method="post" class="file-upload" id="` + id + `">
                                    <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]" ` + multiple + `>
                                    <input type="submit" class="btn btn-primary pull-right" name="Submit" value="Upload">
                                </form>
                            `;
                            galleryCell.colSpan = 10;
                        }
                    /* Populate table with new input */ 

                    /* Table modal window function */ 
                        /* Show modal window */
                        function modalWindow(modalID, contentType, contentID){
                            let div = document.getElementById(modalID);
                            div.innerHTML = `<div class="panel panel-info text-center" style="position: absolute;top: 30%;left: 35%;">
                                            <div class="panel-heading">
                                                Eliminar ` + contentType.toUpperCase() + `
                                            </div>
                                            <div class="panel-body">
                                                <button class="btn btn-danger pull-left" id="delete-yes" style="margin: 10px 60px 10px 0px" data-content-type = `  + contentType.toLowerCase() + ` data-content-id=` + contentID + `>
                                                    Sim
                                                </button>
                                                <button class="btn btn-success pull-right" id="close-modal" style="margin: 10px 0px 10px 60px">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>`;
                            div.style.display = "block";
                        }
                        /* Show modal window */

                        /* onClick close modal */
                        $(document).on('click','#close-modal',function(){
                            $('#modal-window').html('');
                            $('#modal-window').css("display", "none");
                        });
                        /* onClick close modal */

                        /* onClick confirm modal delete row */
                        $(document).on('click','#delete-yes', function(){
                            var data = $(this).data();
                            console.log(data);
                            var url = 'ajax/' + data['contentType'] + '/delete-' + data['contentType'] + '.php';
                            axios.post(
                                url
                                , 
                                {
                                    contentID: data['contentId'],
                                }, 
                                {
                                    headers: { 
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    }
                                }  
                            )
                            .then(function (response) {
                                if(response.data == true){
                                    $('.table tr[data-content-id="' + data['contentId'] + '"]').remove();
                                    $('#modal-window').html('');
                                    $('#modal-window').css("display", "none");
                                }else{
                                    $('#modal-window').html('');
                                    $('#modal-window').css("display", "none");
                                    alert('Unable to delete');
                                    console.log(response);
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        });
                        /* onClick confirm modal delete row */
                    /* Moda window function */
                    
                    /* Add function */
                        function addContent(type){
                            var splittedID = type.split('-');
                            console.clear();
                            let responseData = {}; 
                            let info = document.querySelectorAll("[name^=" + splittedID[1]);
                            var curatedObject = filterContent(info);
                            console.log(curatedObject);
                            axios.post(
                                'ajax/' + splittedID[1] + '/add-' + splittedID[1] + '.php', 
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
                                    populateTable(response.data, splittedID[1] + '-table', 'data-' + splittedID[1] + '-id');
                                
                                console.log(response);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                    /* Add function */

                    /* Delete photos in edit page */
                        document.querySelectorAll('button.delete-photo').forEach( function(btn) {
                            btn.addEventListener('click', deletePhotoInputCollector);
                        });
                        function deletePhotoInputCollector() {  
                            console.clear();
                            const thisBtn = this;
                            const contentType = this.getAttribute('data-content-type');
                            const contentID = this.getAttribute('data-content-id');
                            console.log(contentType, contentID);
                            axios.post(
                                'ajax/' + contentType + '/delete-photo-' + contentType + '.php',
                                {
                                    contentID: contentID,
                                }, 
                                {
                                    headers: { 
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    }
                                }  
                            )
                            .then(function(response){
                                if(response.data == true){
                                    thisBtn.closest('div').remove();
                                }
                                console.log(response);
                            })
                            .catch(function(error){
                                console.log(response);
                            });
                        };
                    /* Delete photos in edit mode */

                    /* Edit page input collector */
                        document.querySelectorAll('button.save').forEach( function(btn) {
                            btn.addEventListener('click', editPageInputCollector);
                        });
                        function editPageInputCollector() {  
                            console.clear();
                            var button_id = this.id.split('-');
                            var userInput = {};
                            var buttonLocation = this;
                            this.closest('.panel-body').querySelectorAll('input, select, textarea').forEach( function(inp) {
                                if(inp.type != 'checkbox'){
                                    userInput[inp.name] = [inp.value];
                                }
                                if(inp.type == 'checkbox'){
                                    if(inp.checked)
                                        userInput[inp.name] = 'checked';
                                    else
                                        userInput[inp.name] = 'unchecked';
                                }
                                if(inp.type == 'textarea'){
                                    userInput[inp.name] = CKEDITOR.instances[inp.id].getData();
                                }
                            });
                            var url = new URL(window.location.href);
                            axios.post(
                                'ajax/' + button_id[0] + '/edit-' + button_id[0] + '.php',
                                {
                                    contentID: url.searchParams.get('id'),
                                    contentCategory: button_id[0],
                                    contentType: button_id[1],
                                    userInput
                                },
                                {
                                    headers: { 
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    }
                                }
                            )
                            .then(function(response){
                                console.log(response.data);
                                var parentNode = buttonLocation.closest('div');
                                createAlert(response, parentNode);
                                
                            })
                            .catch(function(error){
                                console.log(error);
                                var parentNode = buttonLocation.closest('div');
                                createAlert(response, parentNode)
                            });
                            
                        /* Creates the alert area to indicate success or issue at update */
                            function createAlert(response, parentNode){
                                var className = 'alert-success';
                                var iconName = 'fa fa-check-circle';
                                var text = 'Alterado com sucesso'
                                if(response == false){
                                    var className = 'alert-danger';
                                    var iconName = 'fa fa-times-circle';
                                    var text = 'Algo correu mal'
                                }
                                var newNode = document.createElement('div');
                                newNode.classList.add('alert', className, 'alert-dismissible');
                                newNode.innerHTML = `
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <i class="fa ` + iconName +`"></i> ` + text;
                                var insertedNode = insertAfter(newNode, parentNode);
                            }
                        /* Creates the alert area to indicate success or issue at update */

                        /* Inserts after specified parent node */
                            function insertAfter(newNode, referenceNode) {
                                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
                            }
                        /* Inserts after specified parent node */
                        };
                    /* Edit page input collector */

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

                    /* Dummy text filler function */
                        function inputFiller(type){
                            let info = document.querySelectorAll("[name^=" + type);
                            info.forEach(function(el){
                                if(el.type == 'textarea'){
                                    CKEDITOR.instances[el.id].setData(fill());
                                }else if(el.name == 'poiPostalCode'){
                                    el.value = 8500;
                                }else{
                                    el.value = fill();
                                }
                            });
                        }
                        function fill() {
                            var text = "";
                            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                            for (var i = 0; i < 9; i++)
                                text += possible.charAt(Math.floor(Math.random() * possible.length));

                            return text;
                        }
                    /* Dummy text filler function */
                    </script>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
        <?php } ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/klorofil-common.js"></script>
    <script src="assets/js/axios.min.js"></script>
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    sript
</body>
</html>
