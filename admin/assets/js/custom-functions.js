
/* Add function */
function addContent(type, debugMode, postAsync){
    console.clear();
    let splittedID = String(type).split('-');
    var info = document.querySelectorAll("[name^=" + splittedID[1]);
    
    /* In case the names contain underscores, then it should be "rewritten" */
    if((splittedID[1] == 'service_common') || (splittedID[1] == 'service_unique') || (splittedID[1] == 'to_rent') || (splittedID[1] == 'to_sell')){
        var customID = splittedID[1].split('_');
        splittedID[1] = customID[0] + '-' + customID[1].toLowerCase();
        var curatedObject = filterContent(info, splittedID[1]);
    }else{
        var curatedObject = filterContent(info, splittedID[1]);
    }
    if(debugMode == true)
        console.log(curatedObject);
    
    if(curatedObject != false){
         if(postAsync == true){
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
                if(splittedID[1].indexOf('-') > 0){
                    var idHolder = splittedID[1].split('-');
                    splittedID[1] = idHolder[0] + '_' + idHolder[1];
                }
                if(response.data != false){
                    if(debugMode == false){
                        populateTable(response.data, splittedID[1] + '-table', splittedID[1]);
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }else{
        alert('Existem campos por preencher!');
    }
}
/* Add function */

/* Populate table with new input */ 
    function populateTable(rowContent, tableName, dataName){
        var tableRef = document.getElementById(tableName).getElementsByTagName('tbody')[0];
        switch(dataName) {
            case 'admin':
                createFirstRow(rowContent, tableRef, dataName, false);
                break;
            case 'activity':
            case 'city':
            case 'poi':
            case 'to_rent':
            case 'to_sell':
                createFirstRow(rowContent, tableRef, dataName, true);
                break;
            case 'service_common':
            case 'service_unique':
                populateMultipleRows(rowContent, tableRef, dataName);
                break;
        }
    }

    function createFirstRow(data, table, dataName, secondRow){
        data[1] = data[1].replace(/\\+/g, ' ');
        
        var firstRow   = table.insertRow(table.rows.length);
        firstRow.setAttribute(dataName, data[0]);
        var cellArray = [];
        for(var counter = 0; counter < data.length; counter++){
            cellArray[counter] = firstRow.insertCell(counter);
            cellArray[counter].innerHTML = data[counter];
        }
        if(secondRow)
            createGalleryRow(table, data[0], dataName);

    }

    function createGalleryRow(table, id, dataName){
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
    function populateMultipleRows(data, table, dataName){
        for(var c = 0; c < data.length; c++){
            var cellArray = [];
            for(var c2 = 0; c2 < data[c].length; c2++){
                var newRow   = table.insertRow(table.rows.length);
                newRow.setAttribute('data-content-type', dataName);
                newRow.setAttribute('data-content-id', data[c][c2][0]);
                for(var c3 = 0; c3 < data[c][c2].length; c3++){
                    cellArray[c2] = newRow.insertCell(c3);
                    cellArray[c2].innerHTML = data[c][c2][c3];
                }
            }
        }
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
                            <button class="btn btn-danger pull-left" id="delete-yes" style="margin: 10px 60px 10px 0px" data-content-type = `  + contentType.toLowerCase() + ` data-content-id=` + contentID + ` tabindex="1">
                                Sim
                            </button>
                            <button class="btn btn-success pull-right" id="close-modal" style="margin: 10px 0px 10px 60px" tabindex="2">
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
                // console.log(response);
            }else{
                $('#modal-window').html('');
                $('#modal-window').css("display", "none");
                alert('Unable to delete');
                // console.log(response);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    });
    /* onClick confirm modal delete row */
/* Moda window function */

/* Delete photos in edit page */
    document.querySelectorAll('button.delete-photo').forEach( function(btn) {
        btn.addEventListener('click', deletePhotoInputCollector);
    });
    function deletePhotoInputCollector() {  
        console.clear();
        const thisBtn = this;
        const contentType = this.getAttribute('data-content-type');
        const contentID = this.getAttribute('data-content-id');
        // console.log(contentType, contentID);
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
            console.log(error);
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
        if(button_id[0].indexOf('_') > 0){
            var tempIDHolder = button_id[0].split('_');
            button_id[0] = tempIDHolder[0] + '-' + tempIDHolder[1];
        }
        var userInput = {};
        var buttonLocation = this;
        this.closest('.panel-body').querySelectorAll('input, select, textarea').forEach( function(inp) {
            if(inp.type == 'checkbox'){
                if(inp.checked)
                    userInput[inp.name] = 'checked';
                else
                    userInput[inp.name] = 'unchecked';
            }else if(inp.type == 'textarea'){
                userInput[inp.name] = CKEDITOR.instances[inp.id].getData();
            }else if(inp.type == 'select-multiple' && button_id[1] == 'serviceType'){
                var services = $('#' + inp.id).find(':selected');
                for(var c = 0; c < services.length; c++){
                    // console.log(services[c].label,services[c].value);
                    userInput[inp.name + '_' + c] = services[c].value;
                }
            }else if(inp.type == 'text' || inp.type == 'number' || inp.type == 'email' || inp.type == 'select-one'){
                userInput[inp.name] = [inp.value];
            }
            // console.log(inp.type, inp.value);
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
            // console.log(response.data);
            var parentNode = buttonLocation.closest('div');
            createAlert(response, parentNode);
            
        })
        .catch(function(error){
            console.log(error);
            var parentNode = buttonLocation.closest('div');
            createAlert(response, parentNode)
        });
    };
/* Edit page input collector */

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
        insertAfter(newNode, parentNode);
    }
/* Creates the alert area to indicate success or issue at update */

/* Inserts after specified parent node */
    function insertAfter(newNode, referenceNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }
/* Inserts after specified parent node */

/* Additional support functions */
    function filterContent(arrayContent, contentType){
        returnObject = {};
        var counter = 0;
        var returnMap = new Map();
        // console.log(arrayContent);
        for(let x = 0; x < arrayContent.length; x++){
            dataOptional = arrayContent[x].getAttribute('data-optional');
            if(arrayContent[x].type == 'checkbox'){
                if(arrayContent[x].checked){
                    returnObject[arrayContent[x].name] = 1;
                }else{
                    returnObject[arrayContent[x].name] = 0;
                }
            }else if(arrayContent[x].type == 'select-multiple'){
                var cityPoi = $('#' + arrayContent[x].id).find(':selected');
                if(dataOptional == 'false'){
                    if(cityPoi.length > 0)
                        for(var c = 0; c < cityPoi.length; c++){
                            returnObject[arrayContent[x].name + '_' + c] = cityPoi[c].value;
                        }
                    else
                        return false;
                }else{
                    for(var c = 0; c < cityPoi.length; c++){
                        returnObject[arrayContent[x].name + '_' + c] = cityPoi[c].value;
                    }
                }
            }else if(arrayContent[x].type == 'textarea'){
                if(dataOptional == 'false'){
                    if(CKEDITOR.instances[arrayContent[x].id].getData())
                        returnObject[arrayContent[x].name] = CKEDITOR.instances[arrayContent[x].id].getData();
                    else
                        return false;
                }else{
                    returnObject[arrayContent[x].name] = CKEDITOR.instances[arrayContent[x].id].getData();
                }
            }else{
                if(contentType == 'service-common' || contentType == 'service-unique'){
                    var name = arrayContent[x].name + counter;
                    if(dataOptional == 'false'){
                        if(arrayContent[x].value)
                            returnMap.set(name, arrayContent[x].value);
                        else 
                            return false;
                    }else{
                        returnMap.set(name, arrayContent[x].value);
                    }
                }else{
                    if(dataOptional == 'false'){
                        if(arrayContent[x].value)
                            returnObject[arrayContent[x].name] = arrayContent[x].value;
                        else
                            return false;
                    }else{
                        returnObject[arrayContent[x].name] = arrayContent[x].value;
                    }
                }
            }
            counter++;
        }
        return ((contentType == 'service-common' || contentType == 'service-unique' ) ? convertMapToObject(returnMap):returnObject);
    }

    function convertMapToObject(mapVar){
        var obj = {};
        mapVar.forEach(function(value, key) {
            obj[key] = value;
        });
        return obj;
    }
/* Additional support functions */

/* Dummy text filler function */
    function inputFiller(type){
        let info = document.querySelectorAll("[name^=" + type);
        info.forEach(function(el){
            if(el.type == 'textarea'){
                CKEDITOR.instances[el.id].setData(fill(false));
            }else if(el.name == 'cityPostalCode'){
                el.value = 8500;
            }else if(el.type == 'number'){
                el.value = fill(true);;
            }else{
                el.value = fill(false);
            }
        });
    }
    function fill(numberAlso) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        if(numberAlso == true){
            var possible = "0123456789";
            for (var i = 0; i < 4; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
        }else{
            for (var i = 0; i < 9; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
        }


        return text;
    }
/* Dummy text filler function */
