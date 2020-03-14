<?php
error_reporting(E_ALL);
//error_reporting(0);
libxml_use_internal_errors(true);
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 * 
 * index.php
 * 
 * The page that all requests are made to.  This is the facade to the user, this page actually
 * calls other classes to make actual decisions on what to do.
 */

/**
 * Run Initialize.php which performs any work neccessary to setup db connections, set session
 * variables, etc.
 * @see Initialize.php
 */
require("base/Initialize.php");


/**
 * Create a RequestManager -- The real brains behind what page to load
 * this decides what to do and displays the page
 */
$manager = new RequestManager();

?>
