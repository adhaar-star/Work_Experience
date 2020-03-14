<?php

/**
 * Dashboard for admin
 */
require 'config/config.php';
include 'library/Pagination.php';

$config['title'] = 'Dashboard | One-Plate-CA';
set_active_nav('dashboard');
set_active_sub_nav('');
if(isset($_GET['q'])){
$cat_id = $_GET['q'];
$pagination = new Pagination(BASE_URL.'meal-expired.php',$db->get_category_expired_listing_count($cat_id), 'Expired listing pages');
}else{
$pagination = new Pagination(BASE_URL.'meal-expired.php',$db->get_expired_listing_count(), 'Expired listing pages');
}
if(!is_loggedin()) {
    redirect('login.php');
}

include('views/meal-expired.php');
//include('views/footer.php');

/**
 * Close database connection
 */
//include_once 'config/db-conn-close.php';
