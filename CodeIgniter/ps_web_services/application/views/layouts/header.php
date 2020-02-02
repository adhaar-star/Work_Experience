<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
        <meta content='Flat administration template for Twitter Bootstrap. Twitter Bootstrap 3 template with Ruby on Rails support.' name='description'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/favicon.ico'; ?>" rel='shortcut icon' type='image/x-icon'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon.png'; ?>" rel='apple-touch-icon-precomposed'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon-57x57.png'; ?>" rel='apple-touch-icon-precomposed' sizes='57x57'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon-72x72.png'; ?>" rel='apple-touch-icon-precomposed' sizes='72x72'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon-114x114.png'; ?>" rel='apple-touch-icon-precomposed' sizes='114x114'>
        <link href="<?php echo base_url() . 'assets/images/meta_icons/apple-touch-icon-144x144.png'; ?>" rel='apple-touch-icon-precomposed' sizes='144x144'>
        <!-- / START - page related stylesheets [optional] -->
        <link href="<?php echo base_url() . 'assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/stylesheets/plugins/fullcalendar/fullcalendar.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/stylesheets/plugins/common/bootstrap-wysihtml5.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <!-- / END - page related stylesheets [optional] -->
        <!-- / bootstrap [required] -->
        <link href="<?php echo base_url() . 'assets/stylesheets/bootstrap/bootstrap.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <!-- / theme file [required] -->
        <link href="<?php echo base_url() . 'assets/stylesheets/light-theme.css'; ?>" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
        <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
        <link href="<?php echo base_url() . 'assets/stylesheets/theme-colors.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <!-- / demo file [not required!] -->
        <link href="<?php echo base_url() . 'assets/stylesheets/demo.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/stylesheets/custom.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/stylesheets/plugins/bootstrap_switch/bootstrap-switch.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/stylesheets/daterangepicker.css'; ?>" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/stylesheets/plugins/select2/select2.css'?>" media="all" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url() . 'assets/javascripts/jquery/jquery.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/javascripts/custom.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/javascripts/moment.js" type="text/javascript"></script>

            <style>
        .uniq {
    min-height: 680px;
}
    </style>
    </head>
    <body class='contrast-sea-blue '>
        <header>
            <nav class='navbar navbar-default'>
                <a class='navbar-brand' href='<?php echo base_url() ?>'>
                    FAZA CMS Admin
<!--                    <img width="81" height="21" class="logo" alt="Flatty" src="<?php echo base_url() . 'assets/images/logo.svg'; ?>" />
                    <img width="21" height="21" class="logo-xs" alt="Flatty" src="<?php echo base_url() . 'assets/images/logo_xs.svg'; ?>" />-->
                </a>
                <a class='toggle-nav btn pull-left' href='#'>
                    <i class='icon-reorder'></i>
                </a>
                <ul class='nav'>
                    <li class='dropdown dark user-menu'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <?php
                            $profile_image = $this->Common_model->view($this->session->userdata('admin_logged_in')['id'], TBL_ADMIN, 'profile_image');

                            $profile = base_url() . PROFILE_IMAGES . '/' . $profile_image->profile_image;

                            if ($profile_image->profile_image != '')
                                echo "<img width = '23' height = '23'  src = '" . $profile . "'/>";
                            ?>
                            <span class="user-name"> <?php echo "<strong>" . $this->session->userdata('admin_logged_in')['name'] . "</strong>"; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo site_url('home/changeProfile') ?>">
                                    <i class="icon-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('home/changePassword') ?>">
                                    <i class="icon-key"></i>
                                    Change Password
                                </a>
                            </li>
                            <li class = 'divider'></li>
                            <li>
                                <a href="<?php echo site_url('login/logout'); ?>">
                                    <i class="icon-signout"></i>
                                    Sign out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>