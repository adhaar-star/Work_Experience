<?php

require 'config/config.php';


echo '<br />Success... ' . $db->host_info . "\n";

/**
 * Close database connection
 */
include_once 'config/db-conn-close.php';