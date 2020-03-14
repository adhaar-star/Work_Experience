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
$pagination = new Pagination(BASE_URL.'my-meal.php',$db->get_category_active_listing_count($cat_id), 'Active listing pages');
}else{
$pagination = new Pagination(BASE_URL.'my-meal.php',$db->get_active_listing_count(), 'Active listing pages');
}
if(!is_loggedin()) {
    redirect('login.php');
}

include('views/my-meal.php');
//include('views/footer.php');

/**
 * Close database connection
 */
//include_once 'config/db-conn-close.php';
