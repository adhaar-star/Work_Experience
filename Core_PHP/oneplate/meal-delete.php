<?php
require 'config/config.php';
$delid = $_GET['id'];
//echo $music_number;
$qry = "DELETE FROM `leftover_meal_listing` WHERE id ='$delid'";
//die($qry);
$result=$db->query($qry);
if(isset($result)) {
 redirect('my-meal.php');
} else {
   echo "NO";
}
?>