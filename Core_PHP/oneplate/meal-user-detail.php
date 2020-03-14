<?php

/**
 * Dashboard for admin
 */
require 'config/config.php';
include 'library/Pagination.php';

$config['title'] = 'Dashboard | One-Plate-CA';

$userid=$_GET['id'];
$pagination = new Pagination(BASE_URL.'user-detail.php', $db->get_user_active_listing_count($userid), 'Active listing pages');


if(!is_loggedin()) {
    redirect('init.php');
}

include('views/header.php');
include('views/meal-user-detail.php');
include('views/footer.php');

/**
 * Close database connection
 */
include_once 'config/db-conn-close.php';
