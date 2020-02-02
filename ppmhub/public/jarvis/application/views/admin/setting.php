<div class="uk-container uk-container-center uk-width-1-1 uk-margin-large-bottom">
    <div class="uk-grid uk-margin-top" data-uk-grid-margin>
        <div class="uk-width-1-1">
            <div>
                <?php
                $attributes = array(
                    'class' => 'uk-form uk-form-stacked uk-panel-box uk-panel-box-primary',
                    'method' => 'post'
                );
                echo form_open_multipart('', $attributes) ?>
                <h2><i class="uk-icon-cog"></i> <?php l('Setting') ?></h2>

                <div class="uk-form-row uk-margin-top uk-text-center">
                    <button
                        class="uk-button uk-width-1-1 uk-button-large uk-button-success"><span
                            class="uk-h3"> Save </span>
                        <i class="uk-icon-save"></i></button>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="website-name"><?php l('select-theme') ?></label>

                    <div class="uk-form-controls">
                        <select name="chat-theme" class="uk-width-1-1">
                            <option
                                value="default" <?php echo (option_get('chat-theme') == 'default') ? 'selected="true"' : '' ?>>
                                Default
                            </option>
                            <option
                                value="muted" <?php echo (option_get('chat-theme') == 'muted') ? 'selected="true"' : '' ?>>
                                Gray
                            </option>
                            <option
                                value="primary" <?php echo (option_get('chat-theme') == 'primary') ? 'selected="true"' : '' ?>>
                                Primary
                            </option>
                            <option
                                value="secondary" <?php echo (option_get('chat-theme') == 'secondary') ? 'selected="true"' : '' ?>>
                                Dark
                            </option>
                        </select>
                    </div>
                </div>
                <br/>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="visibility"><?php l('Chat Visibility') ?></label>
                    <div class="uk-form-controls">
                        <label class="uk-text-success" for="online">Enable</label>
                        <input id="online" type="radio" name="chat-visible" value="true"
                            <?php echo (option_get('chat-visible') == 'true') ? 'checked' : '' ?>
                            />
                        <label class="uk-text-danger" for="Offline">Disable</label>
                        <input id="Offline"
                               type="radio" <?php echo (option_get('chat-visible') == 'false') ? 'checked' : '' ?>
                               name="chat-visible" value="false"/>
                        <?php //dump_exit(option_get('chat-visible')) ?>
                    </div>
                </div>

                <br/>
                <div class="uk-form-row">
                    <label class="uk-form-label" ><?php l('Chat Alignment') ?></label>
                    <label for="left"> <i class="uk-icon-align-left"></i> Left  </label>
                    <input id="left" type="radio" name="chat-alignment" value="left"
                        <?php echo (option_get('chat-alignment') == 'left') ? 'checked' : '' ?>
                        />
                    <label for="Right"> Right <i class="uk-icon-align-right"></i> </label>
                    <input id="Right"
                           type="radio" <?php echo (option_get('chat-alignment') == 'right') ? 'checked' : '' ?>
                           name="chat-alignment" value="right"/>
                </div>
                <br/>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="website-name">
                        <?php l('Application name') ?>
                    </label>

                    <div class="uk-form-controls">
                        <input class="uk-width-100 uk-form-large" type="text"
                               placeholder="<?php l('Application name') ?>"
                               name="website-name"
                               id="website-name"
                               value="<?php echo set_value('website-name', $this->option->get('website-name')) ?>"/>
                        <?php echo form_error('website-name') ?>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="chat-header-title"><?php l('Chat header title') ?></label>

                    <div class="uk-form-controls">
                                <textarea name='chat-header-title' id='chat-header-title'
                                          class="uk-width-100 uk-form-large uk-margin-bottom"
                                          placeholder="chat header title..."><?php echo set_value('chat-header-title',
                                        $this->option->get('chat-header-title')) ?></textarea>
                        <?php echo form_error('chat-header-title') ?>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="Message-Limit"><?php l('Message Limit') ?> <small><?php l('the system will force the visitor to just insert messages with this character limit');?></small></label>
                    <div class="uk-form-controls">
                                <input type="number" name='Message-Limit' id='Message-Limit'
                                          class="uk-width-100 uk-form-large uk-margin-bottom"
                                          placeholder="Message Limit..." value="<?php echo set_value('Message-Limit',
                                        $this->option->get('Message-Limit')) ?>">
                        <?php echo form_error('Message-Limit') ?>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="ads-header">Header advertisement you can add
                        html below:</label>

                    <div class="uk-form-controls">
                                <textarea name='ads-header' id='ads-header'
                                          class="uk-width-100 uk-form-large uk-margin-bottom"
                                          placeholder="Html code"><?php echo set_value('ads-header',
                                        $this->option->get('ads-header')) ?></textarea>
                        <?php echo form_error('ads-header') ?>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-text-bold"
                           for="default-message"><?php l('Default Message When Start chat') ?></label>

                    <div class="uk-form-controls">
                        <textarea name="default-message" class="uk-width-100 uk-form-large uk-margin-bottom"
                                  id="default-message" rows="5"><?php echo option_get('default-message') ?></textarea>
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-text-bold"
                           for="default-cannot-understand-message"><?php l('Default Message When Cannot Understand the visitor message') ?></label>
                    <div class="uk-form-controls">
                        <textarea name="default-cannot-understand-message" class="uk-width-100 uk-form-large uk-margin-bottom"
                                  id="default-cannot-understand-message" rows="5"><?php echo option_get('default-cannot-understand-message') ?></textarea>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label"
                           for="chat-content-css"><?php l('Chat Content Css (Edit Css):') ?></label>

                    <div class="uk-form-controls">
                                <textarea name='chat-content-css' id='chat-content-css'
                                          class="uk-width-100 uk-form-large uk-margin-bottom"
                                          placeholder="Css code" rows="6"><?php echo set_value('chat-content-css',
                                        $this->option->get('chat-content-css')) ?></textarea>
                        <?php echo form_error('chat-content-css') ?>
                    </div>
                </div>


                <div class="uk-form-row uk-margin-top  uk-text-center">
                    <input type="hidden" name="submit_input" value="1"/>
                    <button
                        class="uk-button uk-button-large uk-width-1-1 uk-button-success"><span
                            class="uk-h3">Save</span>
                        <i class="uk-icon-save"></i></button>

                </div>
                </form>
                <h3> Website Upgrade </h3>
                <hr/>
                <?php
                $attributes = array(
                    'class' => 'uk-form uk-form-stacked',
                    'method' => 'post'
                );
                echo form_open_multipart('admin/upgrade', $attributes) ?>
                <div id="upgrade" class="uk-form-row uk-margin-top uk-panel-box uk-panel-box-primary">
                    <input type="file" name="hdphp" class="uk-form-large uk-display-inline-block"/>
                    <button
                        class="uk-button uk-button-large uk-button-primary">
                        <span class="uk-h3">Upgrade</span>
                        <i class="uk-icon-cloud-upload"></i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>