<?php

push_notification();

function push_notification(){

	// Put your device token here (without spaces):
	$deviceToken = '9308d26dce256aedd99f43db4c68ffaac2b06735a61cc804469d6b9f7d58b29d';
	// Put your private key's passphrase here:
	$passphrase = '1234';
	// Put your alert message here:
	$message = 'A push notification has been sent!';
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
		'alert' => 'testing 8699987073',
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
	// Close the connection to the server
	fclose($fp);

}

?>