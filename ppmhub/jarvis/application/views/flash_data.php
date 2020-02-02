<div class="uk-animation-shake uk-text-large" style="z-index: 1000" data-uk-sticky>
    <?php if ($this->session->flashdata('error_msg')) { ?>
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a class="uk-alert-close uk-close"></a>
            <?php echo $this->session->flashdata('error_msg') ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('success_msg')) { ?>
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a class="uk-alert-close uk-close"></a>
            <?php echo $this->session->flashdata('success_msg') ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('info_msg')) { ?>
        <div class="uk-alert uk-notify-message-primary" data-uk-alert>
            <a class="uk-alert-close uk-close"></a>
            <?php echo $this->session->flashdata('info_msg') ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('warning_msg')) { ?>
        <div class="uk-alert uk-alert-warning" data-uk-alert style="z-index: 1000;" >
            <a class="uk-alert-close uk-close"></a>
            <?php echo $this->session->flashdata('warning_msg') ?>
        </div>
    <?php } ?>
</div>