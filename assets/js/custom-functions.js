function sendEmail(thisButton, lang){
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
        if(el.value != '' && (el.getAttribute('data-optional') == 'false' || el.getAttribute('data-optional') == false)){
            if(name[1] == 'email' && validateEmail(el.value) == false)
                errorCatcher.push(name[1]);
            
            formData.append(name[1], el.value);
            console.log('Here: ', name[1], el.value);
        }else{
            console.log('There', name[1], el.value);
            errorCatcher.push(name[1]); 
        }
    });
    if(dataType < 3)
        formData.append('publicID', form.getAttribute('data-id'));
    formData.append('lang', lang);
    formData.append('type', dataType);
    console.log('Error Catcher: ', errorCatcher);
    console.log('DataType: ', dataType);
    console.log(loader);
    if((dataType === 4 && (errorCatcher.length >= 0 && errorCatcher.length <= 2)) || ((typeof errorCatcher === 'undefined' && errorCatcher.length == 0) || (errorCatcher[0] == 'date' && errorCatcher.length == 1))){
        thisButton.classList.add('invisible');
        loader.classList.remove('invisible');
        error.classList.add('invisible');
        clearInput(collector);
        fetch('ajax/send-mail.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if(!data)
                showSnackbar('Mensagem enviada!')
            loader.classList.add('invisible');
            thisButton.classList.remove('invisible');
        });
    }else{
        error.classList.remove('invisible');
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