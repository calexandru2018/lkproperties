<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="auth-box">
            <div class="left">
                <div class="content">
                    <div class="header">
                        <div class="logo text-center"><img src="assets/favicon.jpg" alt="LK Properties Logo" style="max-height:150px"></div>
                    </div>
                    <div class="bg-warning hide" style="margin: 20px 0px; padding: 15px 0px; color:white !important; <?php echo (($_GET['login-error']) ? 'display: block !important':'')?>">
                        Houve um problema ao fazer login
                    </div>
                    <form class="form-auth-small" method="POST" action="process/process-login.php">
                        <div class="form-group">
                            <label for="signin-email" class="control-label sr-only">Email</label>
                            <input name="email" type="email" class="form-control" id="signin-email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="signin-password" class="control-label sr-only">Password</label>
                            <input name="password" type="password" class="form-control" id="signin-password" placeholder="Password">
                        </div>
                        <input type="hidden" name="crsf_token" value="<?php echo $_SESSION['crsf_token'] ?>">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                        <div class="bottom">
                            <span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Esqueceu-se da password?</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    //echo password_hash(mysqli_real_escape_string($MAIN->db, 'test'), PASSWORD_BCRYPT);
?>