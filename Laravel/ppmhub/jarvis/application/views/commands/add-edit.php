<br/>
<div class="uk-container uk-container-center uk-panel ">
    <div class="uk-width-1-1 uk-panel-box">
        <div class="uk-animation-fade">
            <div class="">
                <div class="artical-content">
                    <h2><i class="<?php echo $form_icon ?>"></i>
                        <?php echo $form_title ?>
                    </h2>
                    <hr class="uk-article-divider">
                    <?php
                    $attributes = array(
                        'class' => 'uk-form uk-form-stacked',
                        'method' => 'post'
                    );
                    echo form_open($form_action, $attributes) ?>
                    <div class="uk-form-controls">
                        <div class="uk-form-controls uk-margin-bottom">
                            <label class="uk-form-label"> Command</label>
                            <textarea name="command"
                                      class="uk-width-100 uk-form-large"><?php echo set_value('command', @$command->command) ?></textarea>
                            <?php echo form_error('command'); ?>
                        </div>
                    </div>

                    <div class="uk-form-controls">
                        <div class="uk-form-controls uk-margin-bottom">
                            <label class="uk-form-label"> Response</label>
                            <textarea rows="20" name="response"
                                   class="uk-width-100 uk-form-large"><?php echo set_value('response', @$command->response) ?></textarea>
                            <?php echo form_error('response'); ?>
                        </div>
                    </div>

                    <br/>
                    <button
                        class="uk-button uk-button-primary uk-button-large"><?php echo $form_submit ?></button>

                    </form>
                </div>
            </div>