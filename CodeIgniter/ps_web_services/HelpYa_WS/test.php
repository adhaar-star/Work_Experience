<?php
/**
 * Created by PhpStorm.
 * User: c73
 * Date: 16/12/15
 * Time: 11:13 AM
 */



sendPush("1b9a2d11b41fed9cde22d3590ffafd02fccfd1d94de3383fe3dc54ef5ebe2a2a", "Test push", 'iOS');
//sendPush("fc1a59bfadefb8be5613805a42095e223ef4f9f7881976ef2ebd15afe0d256a7","test","iOS");
//sendPush("cag_1bF5SzY:APA91bE4NPx1ItTJi7o1huX0r7EFbGhlzj2nqYWbVKLdozxdCkw2vRPMIz7-_GkFO8c0PScbeiecm84d7yGWnpIqHM6l7aLD38QzlxTYEvWcdJQFKPzBIherhXVj3CUwaRaxOsnd83fK", "Test Push", "Android");
//markAllPassedJobsAsRejected();

function sendPush($deviceToken, $message, $deviceType)
{
    if ($deviceType == 'iOS') {
        $passphrase = 'password';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        else
            echo "\n\n Successfully Connected to server";

        {
            // Create the payload body
            $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default',
                'deviceToken' => $deviceToken
            );

            // Encode the payload as JSON
            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));

            if ($result)
                echo "\n\n Message sent successfully...";
        }

        // Close the connection to the server
        fclose($fp);

    }
    else
    {
        $registration_ids = array();
        array_push($registration_ids, "cag_1bF5SzY:APA91bE4NPx1ItTJi7o1huX0r7EFbGhlzj2nqYWbVKLdozxdCkw2vRPMIz7-_GkFO8c0PScbeiecm84d7yGWnpIqHM6l7aLD38QzlxTYEvWcdJQFKPzBIherhXVj3CUwaRaxOsnd83fK");


        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

//        $message = array("content" => $_POST['message']);
        $message = array("content" => "Push Notification Test");
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );

        $headers = array(
            'Authorization: key=AIzaSyCvZIjpLmOt1e5VRjJ4_AetFLCrV6TUenU',
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        //  echo $result;
    }
}
/*
function markAllPassedJobsAsRejected()
{
    date_default_timezone_set('UTC');

    $errorMsg = "";

    echo date("Y-m-d H:i:s");
    echo "\n".date_default_timezone_get()."\n";

    $date_time = '2016-03-23 06:16:00';
    $my_date = date('Y-m-d H:i:s', strtotime($date_time));
    echo "\n".$my_date."\n";
}*/
?>