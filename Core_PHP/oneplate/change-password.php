<?php

/**
 * Dashboard for admin
 */
require 'config/config.php';

$config['title'] = 'Dashboard | One-Plate-CA';
set_active_nav('dashboard');
set_active_sub_nav('');

if(!is_loggedin()) {
    redirect('login.php');
}


//include('views/footer.php');

/**
 * Close database connection
 */
//include_once 'config/db-conn-close.php';

$passwordErr = $repasswordErr = $oldpasswordErr = $response = $output =  "";
$error =false;
if(isset($_POST['submit'])){
	
if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["repassword"])) {
    $passwd=$_POST['password'];
    $repassword = $_POST["repassword"];
	$oldpassword = $_POST['oldpassword'];
    if (strlen($_POST["password"]) <= '8') {
        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
		$error = true;
    }
    elseif(!preg_match("#[0-9]+#",$passwd)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
		$error = true;
    }
    elseif(!preg_match("#[A-Z]+#",$passwd)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
		$error = true;
    }
    elseif(!preg_match("#[a-z]+#",$passwd)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
		$error = true;
    }
	
}
elseif(!empty($_POST["password"])) {
    $repasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
	$error = true;
}else{
$passwordErr = $repasswordErr = $oldpasswordErr = 'Empty Submit';
	$error =true;

}
if($error){

$response ="Password Wrong OR Empty Submit!";
} 
else{
$username=$_SESSION['user_details']['username'];
	
//$categoryid=$db->get_categoryid($category);		
   // $passwd = $_POST['password'];
//$repassword=$_POST['repassword'];	

	
	//$dt2 = DateTime::createFromFormat('Y-m-d',$now);
	
	$oldhash=hash('sha256',$oldpassword);	
$passwordcheck=hash('whirlpool',$oldhash);

	$sql="Select * from `user` WHERE passwd='$passwordcheck'";
	
	$retval= $db->query($sql);
		if ($retval->num_rows > 0) {
		$hash=hash('sha256',$passwd);	
$password=hash('whirlpool',$hash);
	

	$query = "UPDATE `user` SET `passwd`='$password' WHERE `username`='$username'";

	
	$result = $db->query($query);
if(!$result)
{
  die('Could not enter data2: ' . mysql_error());
}


$output = "Password updated successfully\n";
	
			

	}
	else{
	$response = "Old password entered is not correct";
	}
	
}
}
include('views/change-password.php');
?>