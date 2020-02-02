<style>
    #chat-header {
        position: fixed;
        margin-bottom: 20px;
    }
</style>
<div id="chat-header" class="uk-width-1-1 uk-block-<?php echo option_get('chat-theme') ?>">
    <div class="uk-margin-left
    <?php if (option_get('chat-theme') == 'primary' OR option_get('chat-theme') == 'secondary') {
        echo "uk-text-contrast";
    } ?>" style="cursor: pointer;">
        <br/>
        &nbsp;
        <?php echo option_get('chat-header-title') ?>
        <span class="uk-float-right uk-margin-right ">
            <i id="chat-arrow" class="uk-icon-toggle-on uk-icon-medium"></i>
        </span>
    </div>
    <br/>
</div>
<!-- end header -->
<!-- start main content -->
<div id="main-content">
    <?php
    if ($this->session->userdata('client-email')) {
        $this->load->view('jarvis/chat_content');
    } else {
        $this->load->view('jarvis/start_new_chat');
    }
    ?>
</div>
<!-- end main content -->