<?php

/**
 * Dashboard for admin
 */
require 'config/config.php';
include 'library/Pagination.php';

$config['title'] = 'Dashboard | One-Plate-CA';

$locationid=$_GET['id'];


$pagination = new Pagination(BASE_URL.'meal-location-detail-expired.php', $db->get_expired_location_listing_count($locationid), 'Active listing pages');
 

if(!is_loggedin()) {
    redirect('init.php');
}

include('views/header.php');
include('views/meal-location-detail-expired.php');
include('views/footer.php');

/**
 * Close database connection
 */
include_once 'config/db-conn-close.php';
