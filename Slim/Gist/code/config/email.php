<?php

/*
 * Client Eemail Server Details
 */

$config['host'] = "smtp.gmail.com";
$config['SMTPAuth'] = true;
$config['port'] = 465;
$config['SMTPSecure'] = 'ssl';
$config['username'] = "adhaar@gmail.com";
$config['password'] = "12345;

$config['from_email'] = "adhaar@gmail.com";
$config['default_reply_to_name'] = "12345";
$config['default_reply_to_email'] = "adhaar@gmail.com";
$config['from_name'] = "Find Title";
//$config['bcc'] = array(array(
//        'email' => 'adhaar@gmail.com',
//        'name' => 'Adhaar'
//    ),
//);

return $config;
?>
