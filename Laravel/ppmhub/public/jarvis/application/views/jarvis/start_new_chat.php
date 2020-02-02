<?php
/**
 * Created by PhpStorm.
 * User: muhammed
 * Date: 12/08/2015
 * Time: 08:44 ص
 */
?>
<!-- end Content -->
<div class="uk-width-1-1" style="position: fixed;bottom: 0;">
    <?php echo form_open('jarvis/start_chat') ?>
    <p class="uk-margin-left uk-text-warning uk-text-small">
        <?php l('Please fill the following form to start chat') ?>
    </p>
    <br/>
    <br/>
    <br/>
    <div class="uk-form uk-text-center">
        <div class="uk-slidenav-position">
            <img src="<?php echo base_url() ?>assets/themes/default/images/male.png" />
            <img src="<?php echo base_url() ?>assets/themes/default/images/female.png" />
        </div>
        <br/>
        <br/>
        <div class="uk-form-icon ">
            <i class="uk-icon-at"></i>
            <input name="client-email" type="email" required placeholder="<?php l('your email please') ?>"
                   class="uk-form-large uk-width-1-1" />
        </div>
        <br/>
        <br/>

        <div class="uk-form-row uk-margin-bottom">
            <button class="uk-button uk-button-large uk-button-success" style="width: 90%">
                Start
                <i class="uk-icon-arrow-circle-o-right"></i>
            </button>
        </div>
    </div>
    <?php echo form_close() ?>
</div>