<?php

/**
 * All meal listings
 */
require 'config/config.php';
include 'library/Pagination.php';

$config['title'] = 'Dashboard | One-Plate-CA';
set_active_nav('lists');
set_active_sub_nav('active-listing');

if(isset($_GET['s'])){
	$search=$_GET['s'];
	$pagination = new Pagination(BASE_URL.'user-list.php', $db->get_search_user_listing_count($search), 'Active listing pages');
	
}
else{
$pagination = new Pagination(BASE_URL.'user-list.php', $db->get_user_listing_count(), 'All User Pages');

}
//print_r($db->get_search_active_listing_count($search));die;
if(!is_loggedin()) {
    redirect('init.php');
}

include('views/header.php');
include('views/user-list.php');
include('views/footer.php');

/**
 * Close database connection
 */
include_once 'config/db-conn-close.php';
