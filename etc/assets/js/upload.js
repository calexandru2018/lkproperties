const url = 'ajax/admin/add-photo-admin.php';
const form = document.querySelectorAll('.file-upload');

form.forEach(function(el){
    el.addEventListener('submit', e => {
        e.preventDefault();
        console.clear();
        const files = el.querySelector('[type=file]').files;
        const adminID = el.closest('tr').getAttribute('data-content-id');
        console.log(adminID);
        let formData = new FormData();

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            formData.append('image_field[]', file, adminID + '___' + file.name);
        }
        /* Original working */
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // console.log(response);
            alert('Upload feito');
        })
        .catch(error => {
            console.log(error);
        });
        /* Original working */

        /* axios.post(
            url, 
            {
                body: formData
            }
            ,
            {
                headers: { 
                    'Content-Type': 'multipart/form-data; charset=utf-8; boundary="???"'
                }
            }
        )
        .then(response => {
            console.log(response);
        })
        .catch(error => {
            console.log(error);
        }); */
    });
});


