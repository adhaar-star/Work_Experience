<?php

/*
 * Every http request will go throuh this file.
 */
header('Access-Control-Allow-Origin: *');  

require __DIR__.'/../core/autoload.php'; // Require autoloader files.

$time = load_config_one('time'); // Load time configurations.

date_default_timezone_set($time['default_timezone']); // Set default time zone.

require __DIR__.'/../core/app.php'; // Require application core.
