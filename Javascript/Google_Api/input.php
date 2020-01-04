<?php

include('dbconnection.php');
if(($_POST['starting_address'] && $_POST['destination_address'])!="")
{

$sql = "INSERT INTO routes".
       "(starting_address,destination_address,waypoints,email,password,time,Chicago)".
       "VALUES ( '$_POST[starting_address]','$_POST[destination_address]','','$_POST[email]','','','')";


$retval = mysql_query( $sql, $c );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else{
echo "Route successfully saved\n";
}
}
else{
	echo "Please enter Starting address and destination address";
}
mysql_close($conn);
?>
