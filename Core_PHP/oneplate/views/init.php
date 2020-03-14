<div class="login-form">
    <div class="row">
        <?php display_alerts(); ?>
    </div>
    <div class="login-form-head">
        <img src="<?php echo BASE_URL; ?>assets/images/logo.jpg" class="img-responsive center-block" alt="One Plate CA Logo" />
    </div>
    <div class="login-form-body">
        <form method="POST">
            <input type="hidden" name="action" value="login" />
            <div class="form-group">
                <label for="email"><span class="glyphicon glyphicon-user"></span> Username</label>
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="email" name="email" class="form-control" id="email" value="" placeholder="Username" required autofocus />
                    
                </div>
            </div>
            <div class="form-group">
                <label for="password"><span class="glyphicon glyphicon-lock"></span> Password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" id="password" value="" placeholder="Password" required autofocus />
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="show_password">
                            <span id="eye_open" class="glyphicon glyphicon-eye-open"></span>
                            <span id="eye_close" class="glyphicon glyphicon-eye-close hidden"></span>
                        </button>
                    </span>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block" id="submit" value="login">Sign in <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#show_password').click(function() {
            ("password" == $('#password').prop("type")) ? $('#password').prop("type", "text") : $('#password').prop("type", "password");    
            $('#eye_open').toggleClass('hidden');
            $('#eye_close').toggleClass('hidden');
        });
    });
</script>