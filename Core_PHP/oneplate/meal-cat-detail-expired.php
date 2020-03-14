<?php

/**
 * Dashboard for admin
 */
require 'config/config.php';
include 'library/Pagination.php';

$config['title'] = 'Dashboard | One-Plate-CA';

$categoryid=$_GET['id'];
if(isset($_GET['search'])){
	$search=$_GET['search'];
$pagination = new Pagination(BASE_URL.'meal-cat-detail-expired.php', $db->get_category_search_expired_listing_count($categoryid,$search), 'Active listing pages');
	
	
}
else{
$pagination = new Pagination(BASE_URL.'meal-cat-detail-expired.php', $db->get_category_expired_listing_count($categoryid), 'Active listing pages');
}

if(!is_loggedin()) {
    redirect('init.php');
}

include('views/header.php');
include('views/meal-cat-detail-expired.php');
include('views/footer.php');

/**
 * Close database connection
 */
include_once 'config/db-conn-close.php';
