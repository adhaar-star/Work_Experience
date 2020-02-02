<script type="application/javascript">
    $('#message-box').bind("enterKey", function (e) {
        //do stuff here
        var message = $('#message-box').val();
        $('#message-box').val('');
        if(message.length > <?php echo option_get('Message-Limit') ?>){
            message = 'just allowed to insert <?php echo option_get('Message-Limit') ?> chars per message';
            //return false;
        }
        if (message) {
            $.ajax({
                method: "POST",
                url: "<?php echo site_url('jarvis/sent_messages') ?>",
                data: {
                    message: message,
                    <?php echo $this->security->get_csrf_token_name();
                    echo ": '".$this->security->get_csrf_hash()."'"; ?>
                },
                success: function (data) {
                    $('#chat-content').append(data);
                    $('#chat-container').animate({scrollTop: $('#chat-container').prop("scrollHeight")}, 500);
                }
            });

        }
    });

// sent message when press enter
$('#message-box').keyup(function (e) {
    if (e.keyCode == 13) {
        $(this).trigger("enterKey");
    }
});
</script>