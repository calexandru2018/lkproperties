<div class="modal d-inline" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?php echo $lang['cookie']['cookieModalTitle']; ?></h5>
        </div>
        <div class="modal-body">
            <p class="font-weight-bold text-center"><?php echo $lang['cookie']['cookieModalInformation']; ?></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info text-uppercase font-weight-bold" id="cookieAgreement"><?php echo $lang['cookie']['cookieModalButton']; ?></button>
        </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('cookieAgreement').onclick = function(){
        acceptCookie(this);
    }
</script>