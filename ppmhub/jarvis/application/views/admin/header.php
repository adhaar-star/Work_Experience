<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html" lang="en-US">
<head>
    <title><?php echo option_get('website-name') ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php $selected_theme = option_get('uk-theme'); ?>
    <?php echo link_tag('assets/themes/' . $this->selected_theme . '/' . UIKIT_VERSION . '/css/' . $selected_theme); ?>
    <script src="<?php echo base_url() ?>assets/themes/<?php echo $this->selected_theme ?>/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/themes/<?php echo $this->selected_theme . '/' . UIKIT_VERSION ?>/js/uikit.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('widget') ?>"></script>
</head>
<body>
<nav class="uk-navbar" style="z-index: 1000">
<div class="uk-container uk-container-center">
    <ul class="uk-margin-left uk-navbar-nav uk-hidden-small">
        <li class="uk-active">
            <a href="<?php echo base_url() ?>admin/setting">
                <i class="uk-icon-cog"></i> <?php l('Setting') ?>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url() ?>commands">
                <i class="uk-icon-cogs"></i> Command List
            </a>
        </li>
        <li>
            <a href="<?php echo base_url() ?>commands/add">
                <i class="uk-icon-plus"></i> Add Command
            </a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>messages">
                <i class="uk-icon-file-text"></i> Messages
            </a>
        </li>
        <?php if (isset($this->authority->user->user_id) && is_object($this->authority->user)) { ?>
            <li class="uk-active uk-hidden-small uk-hidden-medium" data-uk-dropdown="" >
                <a href='javascript:void(0)'>
                    <?php echo $this->authority->user->user_username ?>
                    <i class="uk-icon-caret-down"></i>
                </a>
                <div class="uk-dropdown uk-dropdown-navbar uk-margin-top-remove">
                    <ul class="uk-nav uk-nav-navbar">
                        <li>
                            <a href="<?php echo base_url() ?>users/profile/<?php echo $this->authority->user->user_username ?>">
                                <i class="uk-icon-user"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('users/sign_out') ?>">
                                <i class="uk-icon-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php } else { ?>
            <li class="uk-display-inline uk-hidden-small uk-hidden-medium">
                <a href="<?php echo site_url('users/login') ?>">
                    Login
                </a>
            </li>
        <?php } ?>
        <li>
            <!-- This is an anchor toggling the modal -->
            <a href="#my-id" data-uk-modal class="uk-text-success ">
                <span class="uk-text-bold"> Get Widget Script <i class="uk-icon-download"></i></span>
            </a>
            <!-- This is the modal -->
            <div id="my-id" class="uk-modal">
                <div class="uk-modal-dialog">
                    <a class="uk-modal-close uk-close"></a>
                    <textarea class="uk-text-success uk-text-large" cols="50" rows="10"><script type="text/javascript" src="<?php echo site_url('widget') ?>"></script></textarea>
                </div>
            </div>
        </li>
    </ul>
    <a href="#my-id" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
</div>
</nav>
<div class="uk-container uk-container-center">
<?php $this->load->view('flash_data') ?>