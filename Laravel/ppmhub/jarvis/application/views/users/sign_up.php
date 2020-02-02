<!---start-content---->
<style>

    body {
        background-image: url('<?php echo base_url() ?>assets/themes/default/images/1911159.jpg')  no-repeat center center fixed;
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        /* Preserve aspet ratio */
        background-size: cover;
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url("<?php echo base_url() ?>assets/themes/default/images/1911159.jpg");
        background-image: -moz-linear-gradient(top, rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url("<?php echo base_url() ?>assets/themes/default/images/1911159.jpg");
        background-image: -o-linear-gradient(top, rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url("<?php echo base_url() ?>assets/themes/default/images/1911159.jpg");
        background-image: -ms-linear-gradient(top, rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url("<?php echo base_url() ?>assets/themes/default/images/1911159.jpg");
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, .6)), to(rgba(0, 0, 0, 1))), url("<?php echo base_url() ?>assets/themes/default/images/1911159.jpg");
        background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url("<?php echo base_url() ?>assets/themes/default/images/1911159.jpg");
    }
    html, body
    {
        height: 100%;
    }
</style>
<br/><br/>
<div class="content">
    <div class="wrap uk-margin-top">
        <div class="uk-vertical-align uk-text-center">
            <div class="uk-vertical-align-middle">

                <br/><br/>
                <div class="text-white">
                    <strong>Sign Up</strong><br/>
                </div><br/><br/>
                <?php
                $attributes = array(
                    'class' => 'uk-panel uk-panel-box uk-form',
                    'method' => 'post'
                );
                echo form_open('', $attributes) ?>
                <div class="uk-form-row">
                    <?php echo form_error('username') ?>
                    <input value="<?php echo set_value('username') ?>" name="username"
                           class="uk-width-1-1 uk-form-large" type="text" placeholder="Username">
                </div>
                <div class="uk-form-row">
                    <?php echo form_error('email') ?>
                    <input value="<?php echo set_value('email') ?>" name="email"
                           class="uk-width-1-1 uk-form-large" type="text" placeholder="Email address">
                </div>
                <div class="uk-form-row">
                    <?php echo form_error('password') ?>
                    <input name="password" class="uk-width-1-1 uk-form-large" type="password"
                           placeholder="Password">
                </div>
                <div class="uk-form-row">
                    <?php echo form_error('confirmPassword') ?>
                    <input name="confirmPassword" class="uk-width-1-1 uk-form-large" type="password"
                           placeholder="Confirm password">
                </div>
                <div class="uk-form-row">
                    <button class="uk-width-1-1 uk-button uk-button-primary uk-button-large" href="#">Sign Up
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>
<br/>
<br/>
<!---//End-content---->