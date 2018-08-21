<h3 class="page-title">Página Principal</h3>
<div class="panel">
    <div class="panel-heading">
        Imagem da pagina principal
    </div>
    <div class="panel-body">
        <form enctype="multipart/form-data" method="post" class="file-upload">
            <input type="file" class="btn btn-info pull-left" size="100" name="image_field[]">
            <input type="submit" class="btn btn-primary pull-right" name="Submit" value="Upload">
        </form>
    </div>
</div>
<script>
    /* Upload script */
        var newUpload = new uploadPhotos('ajax/main/add-main-photo.php', document.querySelectorAll('.file-upload'));
        newUpload.upload();
    /* Upload script */
</script>