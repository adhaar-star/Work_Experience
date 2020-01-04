<?php
include('dbconnection.php');
session_start();
// Establishing Connection with Server by passing server_name, user_id and password as a parameter



// Selecting Database

// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select email,pass from login where email='$user_check'", $c);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['email'];
if(!isset($login_session)){
mysql_close($c); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>
