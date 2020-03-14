<?php

require 'library/MysqliWrapper.php';

$db = new MysqliWrapper(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
/**
 * Check if connection is working or not
 */
if ($db->connect_error) {
    if($debuging) {
    	die('Connect Error (' . $db->connect_errno . ') '. $db->connect_error);
	} else {
    	die('&nbsp;&nbsp;There is some problem with connetion to Database');
	}
}

/**
 * change character set to 'utf8'
 * check what is current character set : $db->character_set_name()
 */
if (!$db->set_charset("utf8")) {
    if($debuging) {
    	printf("Error loading character set utf8: %s<br />", $db->error);
    } else {
    	printf("&nbsp;&nbsp;There is some problem with connetion to Database");
    	die;
    }
}