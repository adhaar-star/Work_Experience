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


$error = $firstnameErr = $lastnameErr  = $contactErr = $addressErr = $zipcodeErr = $cityErr = "";
$firstname = $lastname = $email = $contact = $address1 = $address2 = $zipcode = $city = $response = $output = "";
$error =false;
if(isset($_POST['submit'])){
	//var_dump($_POST);
	//die;                  
	//for name validation	
	 if (empty($_POST["first_name"])) {
    $firstnameErr = "First Name is required";
		 $error=true;
  }else {
    $firstname = $_POST["first_name"];
    // check if name only contains letters and whitespace
   if (!preg_match("/^[a-zA-Z ]*$/", $_POST["first_name"])) {
      $firstnameErr = "Only letters and white space allowed";
		$error=true;
    }
			
  }
  
		 $lastname = $_POST["last_name"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["last_name"])) {
      $lastnameErr = "Only letters and white space allowed";
		$error=true;
    }
		   
	
  
	//for contact validation
  if (empty($_POST["contact"])) {
    $contactErr = "Contact No. is required";
	  $error=true;
  }  else{
	  $contact = $_POST["contact"];
	//check contact no 
  if(!preg_match('/^[0-9]{10}$/',$_POST["contact"]))
    {
      $contactErr = 'Invalid Number!';
		$error=true ;
    }
	
	  
	  }
	 
  	
  
		//for address	
		if (empty($_POST["address1"])) {
		$addressErr = "Address is required";
			$error=true;
		} else {
		$address1 = $_POST['address1'];
		}

		$address2 = $_POST['address2'];

			//for zipcode
		if (empty($_POST["postal"])) {
		$zipcodeErr = "zipcode is required";
			$error=true;
		} else {
		$zipcode = $_POST['postal'];

		}

		if (empty($_POST["City"])) {
		$cityErr = "city name is required";
			$error=true;
		} else {
		$city = $_POST['City'];
		}

		if($error){
			$response = 'All field required !';

		}
		else{
			//echo $username;die;
		$provenance = $db->get_provenance($city);
		$userid = $_SESSION['id'];	
			//echo $userid; die;
		$output = $db->update_user_profile($firstname, $lastname,$address1, $address2, $contact, $city, $zipcode, $userid, $provenance);
			 $_SESSION['user_details']['profile'] = $db->get_user_profile();
		}
}
	

//$categoryid=$db->get_categoryid($category);		
   // $passwd = $_POST['password'];
//$repassword=$_POST['repassword'];	

	
	//$dt2 = DateTime::createFromFormat('Y-m-d',$now);


include('views/user-edit.php');


