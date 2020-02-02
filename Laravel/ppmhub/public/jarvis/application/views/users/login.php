<script
    src="<?php echo base_url() ?>assets/themes/default/<?php echo UIKIT_VERSION ?>/js/components/form-password.min.js"></script>
<div class="uk-vertical-align uk-text-center">
    <div class="uk-panel uk-vertical-align-bottom uk-margin-large-top">
        <br>
        <br>
        <br>
        <div>
            <i class="uk-icon-user uk-text-primary uk-heading-large text-white uk-icon-large"></i>
        </div>
        <p class="uk-text-large">Sign In With Your Email Address</p>
        <?php
        $attributes = array(
            'class' => 'uk-panel-box uk-form',
            'method' => 'post'
        );
        echo form_open('', $attributes) ?>
        <div class="uk-form-row">
            <?php echo form_error('email') ?>
            <input name="email" class="uk-width-1-1  uk-form-large" type="email" placeholder="Email "  />
        </div>
        <div class="uk-form-row uk-form-password">
            <?php echo form_error('password') ?>
            <input name="password" class="uk-form-password uk-form-width-large uk-form-large" type="password">
            <a class="uk-form-password-toggle" data-uk-form-password>Show</a>
        </div>
        <div class="uk-form-row">
            <button class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Login</button>
        </div>

        </form>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
    </div>
</div>
