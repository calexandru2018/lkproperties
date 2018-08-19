function uploadPhotos(url, queryCollection){
    this.url = url;
    this.queryCollection = queryCollection;

    this.upload = function(){
        queryCollection.forEach(function(el){
            el.addEventListener('submit', e => {
                e.preventDefault();
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
                    if(Number.isInteger(parseInt(data)) == true)
                        alert('Upload feito');
                    else
                        alert('Erro ao inserir na base de dados');

                    console.log(data);
                })
                .catch(function(error){
                    console.log(error);
                    alert('Erro em fazer upload');
                });
            });
        });
    }
}