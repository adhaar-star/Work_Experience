<?php include_once $this->getPart('/web/common/header.php'); ?> 
<section class="thanks_info forgot_password_outer">
    <div class="thanks_info_inner">
        <div class="thank_outter">
            <div class="thanks_frame">
                <div class="forgot_password_inner">
                    <form name="reset_password_form" id="reset_password_form" action="" method="POST" autocomplete="off">
                        <p>You can reset the password for "<?= $email; ?>"</p>
                        <div class="fild_outer">
                            <span class="fild_name">New Password</span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" type="password" name="new_reset_password" id="new_reset_password" autocomplete="new-password" /> 
                            </div>
                        </div>
                        <div class="fild_outer">
                            <span class="fild_name">Confirm Password</span>
                            <div class="form-group">
                                <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_reset_password" id="confirm_reset_password" autocomplete="new-password" /> 
                            </div>
                        </div>
                        <div class="fild_outer submit_outer">
                            <span class="fild_name">&nbsp;</span>
                            <div class="form-group">
                                <button class="btn button-effects" type="submit" name="reset_password_submit" id="reset_password_submit" value="Reset Password" >Submit</button>
                            </div>
                        </div>
                        <input class="form-control" placeholder="Email" type="hidden" name="email" id="email" value="<?= $email; ?>" autocomplete="new-password" /> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= $app['base_assets_url']; ?>js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">

    /*
     * Validate generate password form
     */
    $('#reset_password_form').validate({
        rules: {
            new_reset_password: {
                required: true,
                minlength: 6
            },
            confirm_reset_password: {
                required: true,
                equalTo: "#new_reset_password"
            }
        },
        messages: {
            new_reset_password: {
                required: "Please enter new password.",
                minlength: "Password must contain minimum 6 characters"
            },
            confirm_reset_password: {
                required: "Please enter the confirm password.",
                equalTo: "Password and confirm password must be same."
            }
        },
        submitHandler: function () {

            toastr.clear();

            $('#reset_password_submit').attr('disabled', true);

            var data = {};
            var user_data = $('#reset_password_form').serializeObject();
            var new_reset_password = user_data['new_reset_password'];
            var confirm_reset_password = user_data['confirm_reset_password'];
            delete user_data.new_reset_password;
            delete user_data.confirm_reset_password;
            user_data['password'] = new_reset_password;
            user_data['confirm_password'] = confirm_reset_password;
            data.body = user_data;

            $.when(resetPassword(data)).then(function (data) {

                if (data.meta.success) { // in case success
                    window.location.href = Data.base_url;
                } else { // in case error
                    $(".loader_box").hide();
                    $('#reset_password_submit').attr('disabled', false);
                }
            });
        }
    });
</script>
<?php include_once $this->getPart('/web/common/footer.php'); ?>