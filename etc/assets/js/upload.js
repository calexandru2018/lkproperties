const url = 'ajax/admin/gallery-admin.php';
const form = document.querySelectorAll('.file-upload');

form.forEach(function(el){
    console.log(el);
    el.addEventListener('submit', e => {
        e.preventDefault();
        const files = document.querySelector('[type=file]').files;
        console.log(files);
        const formData = new FormData();

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            formData.append('image_field[]', file);
        }
        console.log(formData);
        /* Original working */
        /* fetch(url, {
            method: 'POST',
            body: formData
        }).then(response => {
            console.log(response);
        }).catch(error => {
            console.log(error);
        }); */
        axios.post(
            url, 
            {
                formData
            },
            {
                headers: { 
                    'Content-Type': 'multipart/form-data'
                }
            }
        )
        .then(response => {
            console.log(response);
        })
        .catch(error => {
            console.log(error);
        });
    });
});


