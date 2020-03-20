<?php

/*
 * Client Eemail Server Details
 */

$config['host'] = "smtp.gmail.com";
$config['SMTPAuth'] = true;
$config['port'] = 465;
$config['SMTPSecure'] = 'ssl';
$config['username'] = "prosmtp@prologictechnologies.in";
$config['password'] = "!@#prologictech!@#";

$config['from_email'] = "prosmtp@prologictechnologies.in";
$config['default_reply_to_name'] = "Protasker";
$config['default_reply_to_email'] = "prosmtp@prologictechnologies.in";
$config['from_name'] = "Find Title";
//$config['bcc'] = array(array(
//        'email' => 'rajiv@prologictechnologies.in',
//        'name' => 'Rajiv'
//    ),
//);

return $config;
?>