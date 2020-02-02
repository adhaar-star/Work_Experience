<div class="uk-animation-shake uk-position-relative">
    <?php if ($this->session->flashdata('error_msg')) { ?>
        <div id="ddd" class="uk-alert uk-alert-danger">
            <?php echo $this->session->flashdata('error_msg') ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('success_msg')) { ?>
        <div class="uk-alert uk-alert-success">
            <i class="uk-icon-check"></i>
            <?php echo $this->session->flashdata('success_msg') ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('info_msg')) { ?>
        <div class="uk-alert uk-notify-message-primary">
            <i class="uk-icon-info"></i>
            <?php echo $this->session->flashdata('info_msg') ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('warning_msg')) { ?>
        <div class="uk-alert uk-alert-warning">
            <i class="uk-icon-warning"></i>
            <?php echo $this->session->flashdata('warning_msg') ?>
        </div>
    <?php } ?>
</div>
