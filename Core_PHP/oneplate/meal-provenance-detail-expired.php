<?php

/**
 * Dashboard for admin
 */
require 'config/config.php';
include 'library/Pagination.php';

$config['title'] = 'Dashboard | One-Plate-CA';

$locationid=$_GET['id'];



 $provenance=$db->get_meal_provenance_expired_listing_provenance($locationid);

$locationids=$db->get_meal_provenance_expired_listing_locations($provenance);

$pagination = new Pagination(BASE_URL.'meal-provenance-detail-expired.php', count($locationids), 'Active listing pages');

if(!is_loggedin()) {
    redirect('init.php');
}

include('views/header.php');
include('views/meal-provenance-detail-expired.php');
include('views/footer.php');

/**
 * Close database connection
 */
include_once 'config/db-conn-close.php';
