<style>
    .cookie-notice{
        position: fixed !important;
        bottom: 0 !important; 
        z-index: 9999;
    }
</style>
<div class="container-fluid py-2 bg-light cookie-notice">
    <div class="row my-2">
        <div class="col-12 col-md-8">
            <p class="font-weight-bold mt-3 text-center"><?php echo $lang['cookie']['cookieModalInformation']; ?></p>
        </div>
        <div class="col-12 col-md-4 text-center text-md-left">
            <button type="button" class="btn btn-info text-uppercase font-weight-bold mt-1" id="cookieAgreement"><?php echo $lang['cookie']['cookieModalButton']; ?></button>
        </div>
    </div>
</div>
<script>
    document.getElementById('cookieAgreement').onclick = function(){
        acceptCookie(this);
    }
</script>