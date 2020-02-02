<div class="uk-grid uk-margin-top" data-uk-grid-margin>
    <div class="uk-width-1-1">
        <div class="uk-clearfix uk-panel-box uk-align-center">
            <h2>
                <i class="uk-icon-calendar-o"></i>
                Member since: <?php echo date("F j, Y", $user->user_created_date) ?>
            </h2>
            <br/>

            <div class="uk-panel-box">
                <h3>Edit Your Profile</h3>
                <hr class="uk-article-divider">
                <?php
                $attributes = array(
                    'class' => 'uk-form uk-form-stacked',
                    'method' => 'post'
                );
                echo form_open_multipart('users/profile/' . $user->user_username, $attributes) ?>
                <div class="uk-form-controls uk-margin-top">
                    <label class="uk-form-label">Update your avatar?</label>

                    <div class="uk-form-controls">
                        <img class="uk-border-circle" src="<?php echo display_image_path($user->user_photo) ?>"
                             width="100"
                             title="user-name"/>
                        <input name="user_photo" class="uk-width-100 uk-form-large uk-margin-bottom" type="file"
                               placeholder="">
                    </div>
                </div>
                <div class="uk-form-controls">
                    <label class="uk-form-label">Username:</label>

                    <div class="uk-form-controls">
                        <input class="uk-width-100 uk-form-large uk-margin-bottom" type="text"
                               name="username" placeholder="username" value="<?php echo $user->user_username ?>">
                        <?php echo form_error('username') ?>
                    </div>
                </div>
                <div class="uk-form-controls">
                    <label class="uk-form-label">Email Address:</label>

                    <div class="uk-form-controls">
                        <input name="email" class="uk-width-100 uk-form-large uk-margin-bottom" type="text"
                               placeholder="Email Address" value="<?php echo $user->user_email ?>">
                        <?php echo form_error('email') ?>
                    </div>
                </div>
                <div class="uk-form-controls">
                    <label class="uk-form-label">Password (leave blank to keep the original password):</label>

                    <div class="uk-form-controls">
                        <input name="password" class="uk-width-100 uk-form-large uk-margin-bottom" type="password"
                               placeholder="Password"/>
                        <?php echo form_error('password') ?>
                    </div>
                </div>
                <div class="uk-margin-top">
                    <button class="uk-button uk-button-large uk-button-danger uk-modal-close">cancel</button>
                    <button class="uk-button uk-align-right uk-button-large uk-button-success">Update</button>
                </div>
                </form>
            </div>
        </div>
        <!-- This is the modal -->
        <br/>
    </div>
</div>
<!--  -->
