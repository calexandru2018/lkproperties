function sendEmail(thisButton, successMessage, path){
    console.clear();
    var error = thisButton.previousElementSibling;
    var loader = thisButton.nextElementSibling;
    var form = thisButton.closest('form');
    var collector = form.querySelectorAll('[name^=msg_]');
    var formData = new FormData();
    var errorCatcher = new Array();    
    var dataType = form.getAttribute('data-type');

    collector.forEach(function(el){
        var name = el.name.split('_');
        if(el.value != '' || name[1] == 'date'){
                if(name[1] == 'email' && validateEmail(el.value) == false)
                    errorCatcher.push(name[1]);
                else
                    formData.append(name[1], el.value);
        }else{
            errorCatcher.push(name[1]); 
        }
    });
    if(dataType < 3)
        formData.append('publicID', form.getAttribute('data-id'));

    formData.append('type', dataType);
    console.log('Error Catcher: ', errorCatcher);
    console.log(loader);
    if((typeof errorCatcher === 'undefined' || errorCatcher.length == 0) || (errorCatcher[0] == 'date' && errorCatcher.length == 1)){
        error.classList.add('d-none');
        thisButton.classList.add('d-none');
        loader.classList.remove('d-none');
        fetch(path + 'ajax/send-mail.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if(!data)
                showSnackbar(successMessage)
            loader.classList.add('d-none');
            thisButton.classList.remove('d-none');
            console.log(data);
        });
    }else{
        error.classList.remove('d-none');
    }
}
//Input Cleaner
function clearInput(nodes){
    nodes.forEach(function(el){
        el.value = '';
    })
}
//Email validator
function validateEmail(email){
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
//Snackbar
function showSnackbar(message) {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
    x.innerHTML = message;
    // Add the "show" class to DIV
    x.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
function urlBuilder(input){
    var url = '';
    for (var key in input) {
        var name = key.split('_');
        url = url + '&' + name[1] + "=" + input[key];
    }
    return url;
}
function collectInput(arrayContent){
    returnedObject = {};
    for(let x = 0; x < arrayContent.length; x++){
        if(arrayContent[x].type == 'radio'){
            if(arrayContent[x].checked)
                returnedObject[arrayContent[x].name] = arrayContent[x].value;
        }else if(arrayContent[x].type == 'select-multiple'){
            // console.log(arrayContent[x].id);
            var cityPoi = $('#' + arrayContent[x].id).find(':selected');
            for(var c = 0; c < cityPoi.length; c++){
                // console.log(cityPoi[c].value);
                returnedObject['search_' + cityPoi[c].value] = cityPoi[c].value.substr(cityPoi[c].value.length - 1);
            }
        }else{
            returnedObject[arrayContent[x].name] = arrayContent[x].value;
        }
    }
    return returnedObject;
}
function loadMore(button, loader, lang, path, type, message){
    button.classList.add('invisible');
    loader.classList.remove('invisible');
    var elCount = button.getAttribute('data-count');
    // console.log(elCount);
    var formData = new FormData();
    formData.append('itemCount', elCount);
    formData.append('type', type);
    formData.append('lang', lang);
    formData.append('path', path);
    fetch(((type == 2) ? '../':'') + 'ajax/load-more.php', {
        method: 'POST',
        body: formData
    })
    .then((response) => response.text())
    .then((data) => {
        button.classList.remove('invisible');
        loader.classList.add('invisible');
        if(data.length <= 2){
            button.innerHTML = message;
            button.setAttribute('disabled', 'disabled');
            button.removeEventListener('onclick', function(){});
        }else{
            $('#card-holder').append(data);
            button.setAttribute('data-count', $('#card-holder > div').length-1);
        }
        console.log(data.length);
    });
}
function acceptCookie(button){
    var formData = new FormData()
    formData.append('accept-cookie', 1);
    fetch('/lkproperties/ajax/cookie-update.php', {
        method: 'POST',
        body: formData
    })
    .then(() => {
        fadeOut(button.closest('.modal'));
    });
}
function fadeOut(el){
    el.style.opacity = 1;

    (function fade() {
        if ((el.style.opacity -= .1) < 0) {
        el.style.display = "none";
        } else {
        requestAnimationFrame(fade);
        }
    })();
}