<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html" lang="en-US">
<head>
    <title><?php echo option_get('website-name') ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php $selected_theme = option_get('uk-theme'); ?>
    <?php echo link_tag('assets/themes/' . $this->selected_theme . '/' . UIKIT_VERSION . '/css/' . $selected_theme); ?>
    <script src="<?php echo base_url() ?>assets/themes/<?php echo $this->selected_theme ?>/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/themes/<?php echo $this->selected_theme . '/' . UIKIT_VERSION ?>/js/uikit.min.js"></script>
    <script !src="">
        document.domain = window.location.hostname;
        console.log('iframe header: '+document.domain);
    </script>
</head>
<body>