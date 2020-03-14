<?php

set_time_limit(-1);

push_notification();

function push_notification(){

	// Put your device token here (without spaces):
	$deviceToken = $_GET['token'];
	// Put your private key's passphrase here:
	$passphrase = '1234';
	// Put your alert message here:
	$message = 'Push has sent';
	////////////////////////////////////////////////////////////////////////////////

	$development = true;


	$apns_url = NULL;	
	$apns_port = 2195;

	if($development)
	{
		$apns_url = 'gateway.sandbox.push.apple.com';		
	}
	else
	{
		$apns_url = 'gateway.push.apple.com';		
	}

	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', 'pushcert_dev.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

	// Open a connection to the APNS server
	$fp = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

	if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);
	echo 'Connected to APNS' . PHP_EOL;
	// Create the payload body
	$body['aps'] = array(
		'alert' => array(
	        'body' => $message,
			'action-loc-key' => 'Bango App',
	    ),
	    'badge' => 2,
		'sound' => 'oven.caf',
		);
	// Encode the payload as JSON
	$payload = json_encode($body);
	// Build the binary notification
	$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
	// Send it to the server
	$result = fwrite($fp, $msg, strlen($msg));
	if (!$result)
		echo 'Message not delivered' . PHP_EOL;
	else
		echo 'Message successfully delivered' . PHP_EOL;



		var_dump(checkAppleErrorResponse($fp));

	// Close the connection to the server
	fclose($fp);




}





function checkAppleErrorResponse($fp) {

//byte1=always 8, byte2=StatusCode, bytes3,4,5,6=identifier(rowID). 
// Should return nothing if OK.

//NOTE: Make sure you set stream_set_blocking($fp, 0) or else fread will pause your script and wait 
// forever when there is no response to be sent.

$apple_error_response = fread($fp, 6);

if ($apple_error_response) {

// unpack the error response (first byte 'command" should always be 8)
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
$error_response['status_code'] = $error_response['status_code'].'-Not listed';

}

echo '<br><b>+ + + + + + ERROR</b> Response Command:<b>' . $error_response['command'] . '</b>&nbsp;&nbsp;&nbsp;Identifier:<b>' . $error_response['identifier'] . '</b>&nbsp;&nbsp;&nbsp;Status:<b>' . $error_response['status_code'] . '</b><br>';

echo 'Identifier is the rowID (index) in the database that caused the problem, and Apple will disconnect you from server. To continue sending Push Notifications, just start at the next rowID after this Identifier.<br>';

return true;
}
       
return false;
}

?>