<?php
include('dbconnection.php');
$starting_address=$_POST['starting_address'];
$destination_address=$_POST['destination_address'];
$email=$_POST['email'];
$sql = "DELETE FROM routes WHERE starting_address='$starting_address' AND destination_address='$destination_address' AND email='$email'";

$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not delete data: ' . mysql_error());
}
echo "Route Deleted  successfully\n";

mysql_close($conn);
?>
