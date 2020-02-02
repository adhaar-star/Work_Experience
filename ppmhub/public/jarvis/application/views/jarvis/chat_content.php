<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 12/08/2015
 * Time: 08:30 ص
 */

?>
<style type="text/css">
    <?php echo $this->option->get('chat-content-css') ?>
</style>
    <!-- Chat Content -->
    <div id="chat-container"
        class="uk-panel-box-secondary uk-margin-left uk-flex-wrap uk-overflow-container">
        <br>
        <div class="chat-content uk-margin-right" id="chat-content">
            <?php echo $this->option->get('default-message') ?>
        </div>
    </div>
    <!-- end Content -->
    <!-- footer -->
    <div class="uk-width-1-1" style="position: fixed;bottom: 0;">
        <div class="uk-form">
            <div class="uk-form-row uk-margin-bottom">
                <input id="message-box" type="text" placeholder=" <?php l('Write Your Question Here') ?> "
                       class="uk-form-large uk-margin uk-margin-left" style="width: 90%">
            </div>
        </div>
    </div>
    <!--  end footer -->
<?php $this->load->view('jarvis/chat_content_js'); ?>