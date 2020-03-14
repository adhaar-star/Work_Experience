<?php
require 'config/config.php';
include 'library/Pagination.php';
$q = (isset($_GET['q'])) ? $_GET['q'] : '';
$action = (isset($_GET["action"])) ? $_GET["action"] : '';
$filter = (isset($_GET["cat"])) ? $_GET["cat"] : '';
if($q == 'search') {

$pagination = new Pagination(BASE_URL.'find-food.php',$db->search_food_count($action), 'All food Pages');

}
	
elseif($q == 'filter'){
	
$pagination = new Pagination(BASE_URL.'find-food.php',$db->search_by_category_count($filter,$action), 'All food Pages');

}
else{
	
$pagination = new Pagination(BASE_URL.'find-food.php', $db->all_food_count(), 'All food pages');
	//var_dump($pagination);

}

include('views/find-food.php');
?>