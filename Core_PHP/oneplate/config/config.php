<?php

/**
 * This array is available evverywhere 
 */
$config = array();

$config['image_limit'] = 5;
$config['image_min_width'] = 400; //pixels
$config['image_max_width'] = 800; //pixels
$config['image_thumb_width'] = 140; //pixels
$config['image_thumb_height'] = 140; //pixels
$config['image_types'] = array('jpg');
$config['title'] = 'One-Plate-CA';

if ($_SERVER['HTTP_HOST'] == "localhost") {
    /* @var $_SERVER contains domain name */
    define('BASE_URL', "http://" . $_SERVER['HTTP_HOST'] . "/oneplate/");
    define('DB_HOST', "localhost");
    define('DB_USER', "root");
    define('DB_PASS', "");
    define('DB_DATABASE', "one_plate_ca");
    define('DB_CHARSET', "UTF-8");
} else {
    echo '&nbsp;&nbsp;There is some problem with connection to Database';
    die;
}

/**
 * Session start
 */
session_start();

/**
 * Set timezone for the application
 */
date_default_timezone_set('Asia/Kolkata');

/**
 * For production
 */
$debuging = true;

if ($debuging) {
    ini_set('display_errors', 'On');
    ini_set('error_reporting', E_ALL);
} else {
    ini_set('display_errors', 'Off');
    ini_set('error_reporting', -1);
}

require 'config/db-conn-open.php';

$config['settings'] = $db->get_global_settings();

require 'helper/functions.php';
