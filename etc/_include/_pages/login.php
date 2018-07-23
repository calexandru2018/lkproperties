<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="auth-box ">
            <div class="left">
                <div class="content">
                    <div class="header">
                        <div class="logo text-center"><img src="assets/favicon.jpg" alt="Klorofil Logo" style="max-height:150px"></div>
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
                        <!-- <div class="form-group clearfix">
                            <label class="fancy-checkbox element-left">
                                <input type="checkbox">
                                <span>Remember me</span>
                            </label>
                        </div> -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                        <div class="bottom">
                            <span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Esqueceu-se da password?</a></span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="right">
                <div class="overlay"></div>
                <div class="content text">
                    <h1 class="heading">Free Bootstrap dashboard template</h1>
                    <p>by The Develovers</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php
    echo password_hash('test', PASSWORD_BCRYPT);
?>