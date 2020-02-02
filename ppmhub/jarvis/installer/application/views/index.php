<!---start-content---->
<div class="content">
    <div class="wrap">
        <div id="main" role="main">
            <div class="uk-text-center">
                <div class="uk-width-1-2 uk-align-center">
                    <br/>

                    <p class="uk-h1 uk-text-muted">
                        <i class="uk-icon-large uk-icon-download"></i>
                        Web Installler
                    </p>
                    <br/>
                    <?php
                    $attributes = array(
                        'class' => 'uk-panel uk-panel-box uk-form',
                        'method' => 'post'
                    );
                    echo form_open('install', $attributes) ?>
                    <b class="uk-h4 uk-align-left"><i class="uk-icon-info-circle"></i> Database Information</b>

                    <div class="uk-form-row">
                        <?php echo form_error('hostname') ?>
                        <input class="uk-width-1-1 uk-form-large" name="hostname" type="text" value="localhost">
                    </div>
                    <div class="uk-form-row">
                        <?php echo form_error('database_name') ?>
                        <input class="uk-width-1-1 uk-form-large" name="database_name" type="text"
                               placeholder="Database Name" value="jarvis-chat">
                    </div>
                    <div class="uk-form-row">
                        <?php echo form_error('database_user') ?>
                        <input class="uk-width-1-1 uk-form-large" name="database_user" type="text"
                               placeholder="Database Username" value="root">
                    </div>
                    <div class="uk-form-row">
                        <?php echo form_error('database_password') ?>
                        <input class="uk-width-1-1 uk-form-large" name="database_password" type="password"
                               placeholder="Database User password">
                    </div>
                    <br/>
                    <b class="uk-h4 uk-align-left"><i class="uk-icon-user"></i> Admin Information</b>

                    <div class="uk-form-row">
                        <?php echo form_error('admin_username') ?>
                        <input class="uk-width-1-1 uk-form-large" name="admin_username" type="text"
                               placeholder="Username" value="admin">
                    </div>
                    <div class="uk-form-row">
                        <?php echo form_error('admin_email') ?>
                        <input class="uk-width-1-1 uk-form-large" name="admin_email" type="text"
                               placeholder="E-mail" value="php.power.arts@gmail.com" />
                    </div>
                    <div class="uk-form-row">
                        <?php echo form_error('admin_password') ?>
                        <input class="uk-width-1-1 uk-form-large" name="admin_password" type="password"
                               placeholder="Password">
                    </div>
                    <div class="uk-form-row">
                        <button class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Install</button>
                    </div>

                    <?php echo form_close() ?>

                </div>
            </div>
            <br class="clear"/><br class="clear"/>
        </div>
    </div>
</div>
<!---//End-content---->