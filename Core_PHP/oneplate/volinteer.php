<?php
require 'config/config.php';
$html="";
$error = $firstnameErr = $lastnameErr = $emailErr = $contactErr = $addressErr = $zipcodeErr = $cityErr = "";
$firstname = $lastname = $email = $contact = $address1 = $address2 = $zipcode = $city = $response = $output =  "";
$error =false;
$res = $db->get_all_city();
foreach ($res as $record)	{	
$html .='<option value="'.$record['name'].'">
'.$record['name'].'
</option>';
 }
if(isset($_POST['vol_submit'])){
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
  	 if (empty($_POST["last_name"])) {
    $lastnameErr = "Last Name is required";
		 $error=true;
  } else 
	 {
		 $lastname = $_POST["last_name"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["last_name"])) {
      $lastnameErr = "Only letters and white space allowed";
		$error=true;
    }
		   
	}
  

	//for email validation
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
	 $error==true;
  } else{
   		$email = $_POST["email"];
    // check if e-mail address is well-formed
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
		$error=true;
    }
		 
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
	
if (empty($_POST["city"])) {
$cityErr = "city name is required";
	$error=true;
} else {
$city = $_POST['city'];
}
	
if($error){
	$response ='All field required !';

}
else{	
  
$output = $db->add_new_volinteer($firstname, $lastname, $email, $address1, $address2, $contact, $city, $zipcode);

}
}
include('views/volinteer.php');
?>


  