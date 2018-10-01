function uploadPhotos(url, queryCollection){
    this.url = url;
    this.queryCollection = queryCollection;

    this.upload = function(){
        queryCollection.forEach(function(el){
            el.addEventListener('submit', e => {
                e.preventDefault();
                loadingGifEl = el.nextElementSibling;
                button = el.closest('form').querySelector('input[type=submit]');
                console.log(loadingGifEl);
                console.log(button);
                
                if (loadingGifEl.classList.contains('hidden')) {
                    loadingGifEl.classList.remove('hidden');
                    button.classList.add('hidden');
                }
                 const files = el.querySelector('[type=file]').files;
                // const contentID = el.closest('tr').getAttribute('data-content-id');
                if(el.closest('tr') == null){
                    var contentID = 0;
                }else{
                    var contentID = el.closest('tr').getAttribute('data-content-id');
                }
                let formData = new FormData();
                
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    formData.append('image_field[]', file, contentID + '___' + file.name);
                }
                /* Original working */
                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (button.classList.contains('hidden')) {
                        button.classList.remove('hidden');
                        loadingGifEl.classList.add('hidden');
                    }
                    if(Number.isInteger(parseInt(data)) != true)
                        alert('Erro ao inserir na base de dados');

                    console.log(data);
                })
                .catch(function(error){
                    if (button.classList.contains('hidden')) {
                        button.classList.remove('hidden');
                        loadingGifEl.classList.add('hidden');
                    }
                    alert('Erro em fazer upload');
                    console.log(error);
                });
            });
        });
    }
}