<?php
/**
 * Created by PhpStorm.
 * User: c73
 * Date: 15/12/15
 * Time: 5:34 PM
 */

$server = "localhost";
$user = "helpyaap_helpya";
$password = "]KdZ)L]7QDto";
$dbName = 'helpyaap_HelpYaApp';
//global $con;
$con = "";
$con = mysql_connect($server, $user, $password);

mysql_set_charset('utf8', $con);

if (!$con) {
    die('Database does not connect: ' . mysql_error());
}
else {
    mysql_select_db($dbName, $con);
   // echo 'connected successfully';
}


/*$server = "192.168.1.201";
$user = "HelpYa";
$password = "6jRkB5v445httID";
$dbname = 'HelpYa';

$con = "";
$con=mysqli_connect($server,$user,$password);

if(!$con)
{
    die('Database does not connect: ' . mysqli_error($con));
}
else
{
    mysqli_select_db($con,$dbname);
   // echo 'connected successfully';
}
*/
?>