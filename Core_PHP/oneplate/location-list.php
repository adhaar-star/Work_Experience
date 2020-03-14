<?php

/**
 * All meal listings
 */
require 'config/config.php';
include 'library/Pagination.php';

$config['title'] = 'Dashboard | One-Plate-CA';
set_active_nav('lists');
set_active_sub_nav('active-listing');

if(isset($_GET['q'])){
	$search=$_GET['q'];
	$pagination = new Pagination(BASE_URL.'location-list.php', $db->get_search_location_listing_count($search), 'Active listing pages');
	//print_r($db->get_search_location_listing_count($search));die;
}
else{
$pagination = new Pagination(BASE_URL.'location-list.php', $db->get_location_listing_count(), 'All Location Pages');

}

if(!is_loggedin()) {
    redirect('init.php');
}

include('views/header.php');
include('views/location-list.php');
include('views/footer.php');

/**
 * Close database connection
 */
//include_once 'config/db-conn-close.php';
