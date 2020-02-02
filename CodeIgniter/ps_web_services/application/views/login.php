<!DOCTYPE html>
<html>
    <head>
        <title>Sign in | FAZA CMS Admin</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
        <meta content='Flat administration template for Twitter Bootstrap. Twitter Bootstrap 3 template with Ruby on Rails support.' name='description'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/favicon.ico' ?>" rel='shortcut icon' type='image/x-icon'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon.png' ?>" rel='apple-touch-icon-precomposed'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon-57x57.png' ?>" rel='apple-touch-icon-precomposed' sizes='57x57'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon-72x72.png' ?>" rel='apple-touch-icon-precomposed' sizes='72x72'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon-114x114.png' ?>" rel='apple-touch-icon-precomposed' sizes='114x114'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon-144x144.png' ?>" rel='apple-touch-icon-precomposed' sizes='144x144'>
        <!-- / START - page related stylesheets [optional] -->

        <!-- / END - page related stylesheets [optional] -->
        <!-- / bootstrap [required] -->
        <link href="<?php echo base_url() . 'assets/stylesheets/bootstrap/bootstrap.css' ?>" media="all" rel="stylesheet" type="text/css" />
        <!-- / theme file [required] -->
        <link href="<?php echo base_url() . 'assets/stylesheets/light-theme.css' ?>" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
        <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
        <link href="<?php echo base_url() . 'assets/stylesheets/theme-colors.css' ?>" media="all" rel="stylesheet" type="text/css" />
        <!-- / demo file [not required!] -->
        <link href="<?php echo base_url() . 'assets/stylesheets/demo.css' ?>" media="all" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
          <script src="assets/admin/javascripts/ie/html5shiv.js" type="text/javascript"></script>
          <script src="assets/admin/javascripts/ie/respond.min.js" type="text/javascript"></script>
        <![endif]-->
    </head>
    <body class='contrast-sea-blue login contrast-background'>
        <div class='middle-container'>
            <div class='middle-row'>
                <div class='middle-wrapper'>
                    <div class='login-container-header'>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='text-center'>
                                        <!--<img src="<?php echo base_url() . 'assets/images/logo.png'; ?>" />-->
                                       <p style="color: white; font-size: 30px;"> FAZA CMS</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='login-container'>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-4 col-sm-offset-4'>
                                    <h1 class='text-center title'>Sign in</h1>
                                    <?php
                                    if (isset($msg)) {
                                        echo "<div class='alert alert-danger'>" . $msg . "</div>";
                                    }
                                    if (validation_errors())
                                        echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
                                    ?>
                                    <?php
//                    echo $this->session->flashdata('message');
                                    if ($this->session->flashdata('error')) {
                                        echo '<div class="alert alert-danger alert-dismissable">
                                <a class="close" href="#" data-dismiss="alert"> × </a>
                   ' .
                                        $this->session->flashdata('error') .
                                        '</div>';
                                    } elseif ($this->session->flashdata('success')) {
                                        echo '<div class="alert alert-success alert-dismissable">
                                 <a class="close" href="#" data-dismiss="alert"> × </a>
                               ' .
                                        $this->session->flashdata('success') .
                                        '</div>';
                                    } else if ($this->session->flashdata('warning')) {
                                        echo '<div class="alert alert-warning alert-dismissable">
                                <a class="close" href="#" data-dismiss="alert"> × </a>
                    ' .
                                        $this->session->flashdata('warning') .
                                        '</div>';
                                    } else if ($this->session->flashdata('info')) {
                                        echo '<div class="alert alert-info alert-dismissable">
                                   <a class="close" href="#" data-dismiss="alert"> × </a>
                                '
                                        . $this->session->flashdata('info') .
                                        '</div>';
                                    }
//                                    $action = ($this->input->get('redirect')) ? base_url() . "login?redirect=" . $this->input->get('redirect') : base_url() . "login";
                                    ?>

                                   <form action='<?php echo site_url() . "/login/login";?>' class='validate-form' method='post'>
                                        <div class='form-group'>
                                            <div class='controls with-icon-over-input'>
                                                <input value="" placeholder="E-mail" class="form-control" data-rule-required="true" name="email" type="text" />
                                                <i class='icon-user text-muted'></i>
                                            </div>
                                        </div>
                                        <div class='form-group'>
                                            <div class='controls with-icon-over-input'>
                                                <input value="" placeholder="Password" class="form-control" data-rule-required="true" name="password" type="password" />
                                                <i class='icon-lock text-muted'></i>
                                            </div>
                                        </div>
                                        <button class='btn btn-block'>Sign in</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='login-container-footer'>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='text-center'>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / jquery [required] -->
        <script src="<?php echo base_url() . 'assets/javascripts/jquery/jquery.min.js'; ?>" type="text/javascript"></script>
        <!-- / jquery mobile (for touch events) -->
        <script src="<?php echo base_url() . 'assets/javascripts/jquery/jquery.mobile.custom.min.js'; ?>" type="text/javascript"></script>
        <!-- / jquery migrate (for compatibility with new jquery) [required] -->
        <script src="<?php echo base_url() . 'assets/javascripts/jquery/jquery-migrate.min.js'; ?>" type="text/javascript"></script>
        <!-- / jquery ui -->
        <script src="<?php echo base_url() . 'assets/javascripts/jquery/jquery-ui.min.js'; ?>" type="text/javascript"></script>
        <!-- / jQuery UI Touch Punch -->
        <script src="<?php echo base_url() . 'assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js'; ?>" type="text/javascript"></script>
        <!-- / bootstrap [required] -->
        <script src="<?php echo base_url() . 'assets/javascripts/bootstrap/bootstrap.js'; ?>" type="text/javascript"></script>
        <!-- / modernizr -->
        <script src="<?php echo base_url() . 'assets/javascripts/plugins/modernizr/modernizr.min.js' ?>" type="text/javascript"></script>
        <!-- / retina -->
        <script src="<?php echo base_url() . 'assets/javascripts/plugins/retina/retina.js' ?>" type="text/javascript"></script>
        <!-- / theme file [required] -->
        <script src="<?php echo base_url() . 'assets/javascripts/theme.js' ?>" type="text/javascript"></script>
        <!-- / demo file [not required!] -->
        <script src="<?php echo base_url() . 'assets/javascripts/demo.js' ?>" type="text/javascript"></script>
        <!-- / START - page related files and scripts [optional] -->
        <script src="<?php echo base_url() . 'assets/javascripts/plugins/validate/jquery.validate.min.js' ?>" type="text/javascript"></script>
        <script src="<?php echo base_url() . 'assets/javascripts/plugins/validate/additional-methods.js' ?>" type="text/javascript"></script>
        <!-- / END - page related files and scripts [optional] -->
        <script>
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 7000);
        </script>
    </body>
</html>
