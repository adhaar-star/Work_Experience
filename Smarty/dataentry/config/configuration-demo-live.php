<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 * 
 * Configuration variables
 */


// Database configuration
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "mightyvending");

// Turn debug information on
define("DEBUG", 1);

// Smarty configuration
define("SMARTY_TEMPLATE_DIR", 'template');
define("SMARTY_COMPILE_DIR", 'smarty/templates_c');
define("SMARTY_CACHE_DIR", 'smarty/cache');
define("SMARTY_CONFIG_DIR", 'smarty/configs');

// File Upload Options
define("FILE_UPLOAD_MAX_SIZE", 10000000);
define("FILE_UPLOAD_FOLDER", "data");

define("ITEMS_PER_PAGE", 10);

define("CURRENCY_SYMBOL", "&#163;");

// Date formats
define("DATE_FORMAT_LONG", "F j, Y h:i:sa");
define("DATE_FORMAT_SHORT", "M. j 'y");
define("DATE_FORMAT_", "");
define("DATE_FORMAT_MYSQL", "Y-m-d");
define("TIME_FORMAT", "h:ia");
define("TIME_FORMAT_MYSQL", "H:i:s");


// Date Bitmasks
define("DATE_YEAR", 0x8000);
define("DATE_MONTH", 0x4000);
define("DATE_DAY", 0x2000);

// Security Options
define("USERS_TABLE", "staff");
?>
