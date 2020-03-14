<?php
require 'config/config.php';
$delid = $_POST['id'];
//echo $music_number;
$qry = "DELETE FROM `leftover_meal_listing` WHERE id ='$delid'";
$result=mysql_query($qry);
if(isset($result)) {
   echo "YES";
} else {
   echo "NO";
}
?>