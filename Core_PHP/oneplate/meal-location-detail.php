<?php

/**
 * Dashboard for admin
 */
require 'config/config.php';
include 'library/Pagination.php';

$config['title'] = 'Dashboard | One-Plate-CA';

$locationid=$_GET['id'];


$pagination = new Pagination(BASE_URL.'location-detail.php', $db->get_location_active_listing_count($locationid), 'Active listing pages');
 

if(!is_loggedin()) {
    redirect('init.php');
}

include('views/header.php');
include('views/meal-location-detail.php');
include('views/footer.php');

/**
 * Close database connection
 */
include_once 'config/db-conn-close.php';
