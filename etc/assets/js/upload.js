function uploadPhotos(url, queryCollection){
    this.url = url;
    this.queryCollection = queryCollection;

    this.upload = function(){
        queryCollection.forEach(function(el){
            el.addEventListener('submit', e => {
                e.preventDefault();
                console.clear();
                const files = el.querySelector('[type=file]').files;
                const contentID = el.closest('tr').getAttribute('data-content-id');
                console.log(contentID);
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    formData.append('image_field[]', file, contentID + '___' + file.name);
                }
                console.log(files);
                /* Original working */
                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(function(response){
                    console.log(response);
                    alert('Upload feito');
                })
                .catch(function(error){
                    console.log(error);
                });
            });
        });
    }
}