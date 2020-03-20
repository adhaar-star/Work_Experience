<?php include_once $this->getPart('/admin/common/header.php'); ?> 

<div class="login">
    <div class="app app-default">
        <div class="app-container admin-login">
            <div class="flex-center">
                <div class="app-body">
                    <div class="app-block">
                        <div class="app-form">
                            <div class="form-header">
                                <div class="app-brand"><img src="<?= $app['base_assets_admin_url']; ?>images/brain_logo.png" alt="logo"></div>
                            </div>

                            <form name="admin_login_form" id="admin_login_form">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input name="username" id="username" class="form-control" placeholder="User Name" autocomplete="new-password" type="text">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2">
                                        <i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input name="password" id="password" class="form-control" placeholder="Password" autocomplete="new-password" type="password">
                                </div>
                                <div class="text-center">

                                    <input name="redirect_url" type="hidden">
                                    <input class="btn btn-success btn-submit" type="submit" id="login_submit" value="Login"> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--<div class="login">
        <div class="app app-default">
            <div class="app-container app-login">
                <div class="flex-center">
                    <div class="app-body">
                        <div class="app-block">
                            <div class="app-form">
                                <div class="form-header">
                                    <div class="app-brand"><img src="<?= $app['base_assets_admin_url']; ?>images/ds-tanker-icon_1.png" alt="logo" style="    width: 130px;"></div>
                                </div>
    
                                <form name="admin_login_form" id="admin_login_form" autocomplete="off" >
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-user" aria-hidden="true"></i></span>
                                        <input name="username" id="username" class="form-control" placeholder="User Name" aria-describedby="basic-addon1" autocomplete="new-password" type="text">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon2">
                                                <i class="fa fa-key" aria-hidden="true"></i></span>
                                        <input name="password" id="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" autocomplete="new-password" type="password">
                                    </div>
                                    <div class="text-center">
                                        <input class="common_button form-control btn btn-success btn-submit" type="submit" id="login_submit" value="Login"> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    <script src="<?= $app['base_assets_admin_url']; ?>js/jquery.validate.min.js" type="text/javascript"></script>

    <script type="text/javascript">


        /*
         * Validate while login
         */
        $('#admin_login_form').validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: 'Please enter user name.'
                },
                password: {
                    required: 'Please enter password.'
                }
            },
            submitHandler: function () {

                toastr.clear();
                $('#login_submit').attr('disabled', true);
                $(".loader").show(); // show loader
                var data = {};
                data.body = $('#admin_login_form').serializeObject();
                $.when(adminLogin(data)).then(function (data) {
                    $(".loader").hide(); // show loader
                    if (data.meta.success) { // ajax success
                        if (data.data.user) { // user exist check
                            // if data sucess redirect to dashboard
                            window.location.href = Data.base_admin_url + 'dashboard/';
                        }
                    } else { // ajax error case
                        $('#login_submit').attr('disabled', false);
                    }
                });
            }
        });
    </script>
    <div class="loader_img-outer loader" style="display:none;">
        <div class="loader_img">
            <img alt="Loader" src="<?= $app['base_assets_url']; ?>images/loading-icon.gif">
        </div>
    </div>
</div>

</html>