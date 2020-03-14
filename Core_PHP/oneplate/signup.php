<?php

/**
 * Dashboard for admin
 */
require 'config/config.php';

$config['title'] = 'Dashboard | One-Plate-CA';
set_active_nav('dashboard');
set_active_sub_nav('');


//include('views/footer.php');

/**
 * Close database connection
 */
//include_once 'config/db-conn-close.php';


$error = $firstnameErr = $lastnameErr  = $emailErr = $contactErr = $addressErr = $zipcodeErr = $cityErr = $passwordErr = $repasswordErr = "";
$firstname = $lastname = $email = $contact = $address1 = $address2 = $zipcode = $city = $response = $output = "" ;
$error =false;
if(isset($_POST['submit'])){
	//var_dump($_POST);
	//die;                  
	//for name validation	
	 if (empty($_POST["firstname"])) {
    $firstnameErr = "First Name is required";
		 $error=true;
  }else {
    $firstname = $_POST["firstname"];
    // check if name only contains letters and whitespace
   if (!preg_match("/^[a-zA-Z ]*$/", $_POST["firstname"])) {
      $firstnameErr = "Only letters and white space allowed";
		$error=true;
    }
			
  }
  	 if (empty($_POST["lastname"])) {
    $lastnameErr = "Last Name is required";
		 $error=true;
  } else 
	 {
		 $lastname = $_POST["lastname"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lastname"])) {
      $lastnameErr = "Only letters and white space allowed";
		$error=true;
    }
		   
	}
	//for email
	if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = $_POST["email"];
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "*Invalid email format";
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
	
	// for password
	if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["repassword"])) {
    $passwd=$_POST['password'];
    $repassword = $_POST["repassword"];
    if (strlen($_POST["password"]) <= '6') {
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
$passwordErr =  'Password is required !';
	$error =true;

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
			$provenance = $db->get_provenance($city);
			//var_dump($_POST);
			//echo $provenance;
			//die;   
			
		$output = $db->insert_new_user($firstname, $lastname,$address1, $address2, $contact, $city, $zipcode, $passwd , $email, $provenance);
		}
}
	

//$categoryid=$db->get_categoryid($category);		
   // $passwd = $_POST['password'];
//$repassword=$_POST['repassword'];	

	
	//$dt2 = DateTime::createFromFormat('Y-m-d',$now);


include('views/signup.php');


