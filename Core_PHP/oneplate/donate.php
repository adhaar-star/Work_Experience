<?php
// PayPal settings
$error=false;
$msg = $amtErr = $emailErr  = $firstnameErr = $lastErr ="";
if(isset($_POST['submit'])){
	
if(empty($_POST['amount'])){
	$amtErr="Amount is Required";
	$error=true;
}
if(empty($_POST['payer_email'])){
 $emailErr="Email is Required";
$error=true;
}
if(empty($_POST['first_name'])){
 $firstnameErr="First Name is Required";
$error=true;
}
if(empty($_POST['last_name'])){
 $lastErr="Last Name is Required";
$error=true;
}
// Include Functions
//include("helper/functions.php");
if($error){
	$msg = "All Field Required !";

}
else{
$paypal_email = $_POST['payer_email'];
$return_url = 'http://localhost/oneplate/payment-successful.php';
$cancel_url = 'http://localhost/oneplate/payment-cancelled.php';
$notify_url = 'http://localhost/oneplate/payments.php';
$item_name = "DONATE";
$item_amount = $_POST['amount'];
// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
	
	$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency ($) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;
	
	// Redirect to paypal IPN
	header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	exit();
} 
}
}
include('views/donate.php');
?>
