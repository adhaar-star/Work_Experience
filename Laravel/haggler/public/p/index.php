<?php

$body = array();
$body['aps'] = array('alert' => 'My push notification message!');
$body['aps']['notifurl'] = 'http://www.hagler.in';
$body['aps']['badge'] = 1;

//Setup stream (connect to Apple Push Server)
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'passphrase', '1234');
stream_context_set_option($ctx, 'ssl', 'local_cert', 'pushcert_dev.pem');
$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
stream_set_blocking ($fp, 0); //This allows fread() to return right away when there are no errors. But it can also miss errors during last seconds of sending, as there is a delay before error is returned. Workaround is to pause briefly AFTER sending last notification, and then do one more fread() to see if anything else is there.

if (!$fp) {
    //ERROR
    echo "Failed to connect (stream_socket_client): $err $errstrn";
} else {
    $apple_expiry = time() + (90 * 24 * 60 * 60); //Keep push alive (waiting for delivery) for 90 days

    //Loop thru tokens from database
    
        $apple_identifier = '';
        $deviceToken = '9308d26dce256aedd99f43db4c68ffaac2b06735a61cc804469d6b9f7d58b29d';
        $payload = json_encode($body);
        //Enhanced Notification
        $msg = pack("C", 1) . pack("N", $apple_identifier) . pack("N", $apple_expiry) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload;
        //SEND PUSH
        fwrite($fp, $msg); 
        //We can check if an error has been returned while we are sending, but we also need to check once more after we are done sending in case there was a delay with error response.
        checkAppleErrorResponse($fp);
    

    //Workaround to check if there were any errors during the last seconds of sending.
    usleep(500000); //Pause for half a second. Note I tested this with up to a 5 minute pause, and the error message was still available to be retrieved

    checkAppleErrorResponse($fp);

}

//FUNCTION to check if there is an error response from Apple
//         Returns TRUE if there was and FALSE if there was not
function checkAppleErrorResponse($fp) {

   //byte1=always 8, byte2=StatusCode, bytes3,4,5,6=identifier(rowID). Should return nothing if OK.
   $apple_error_response = fread($fp, 6);
   //NOTE: Make sure you set stream_set_blocking($fp, 0) or else fread will pause your script and wait forever when there is no response to be sent.

   if ($apple_error_response) {
        //unpack the error response (first byte 'command" should always be 8)
        $error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response);

        if ($error_response['status_code'] == '0') {
            $error_response['status_code'] = '0-No errors encountered';
        } else if ($error_response['status_code'] == '1') {
            $error_response['status_code'] = '1-Processing error';
        } else if ($error_response['status_code'] == '2') {
            $error_response['status_code'] = '2-Missing device token';
        } else if ($error_response['status_code'] == '3') {
            $error_response['status_code'] = '3-Missing topic';
        } else if ($error_response['status_code'] == '4') {
            $error_response['status_code'] = '4-Missing payload';
        } else if ($error_response['status_code'] == '5') {
            $error_response['status_code'] = '5-Invalid token size';
        } else if ($error_response['status_code'] == '6') {
            $error_response['status_code'] = '6-Invalid topic size';
        } else if ($error_response['status_code'] == '7') {
            $error_response['status_code'] = '7-Invalid payload size';
        } else if ($error_response['status_code'] == '8') {
            $error_response['status_code'] = '8-Invalid token';
        } else if ($error_response['status_code'] == '255') {
            $error_response['status_code'] = '255-None (unknown)';
        } else {
            $error_response['status_code'] = $error_response['status_code'] . '-Not listed';
        }

        echo '<br><b>+ + + + + + ERROR</b> Response Command:<b>' . $error_response['command'] . '</b>&nbsp;&nbsp;&nbsp;Identifier:<b>' . $error_response['identifier'] . '</b>&nbsp;&nbsp;&nbsp;Status:<b>' . $error_response['status_code'] . '</b><br>';
        echo 'Identifier is the rowID (index) in the database that caused the problem, and Apple will disconnect you from server. To continue sending Push Notifications, just start at the next rowID after this Identifier.<br>';

        return true;
   }
   return false;
}