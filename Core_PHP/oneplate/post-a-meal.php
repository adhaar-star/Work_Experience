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


$title = $description = $category = $city = $postal = $expiry = "";
$error = $titleErr = $descrptErr = $catErr = $ImageErr = $postalErr = $cityErr = $dateErr = $ImageErr =  $response = $output ="";
$error = false;
if(isset($_POST['post_submit'])){
	//for title
	if (empty($_POST["title"])) {
    $titleErr = "Meal-Title is required";
	  $error=true;
  }  else{
	  $title=$_POST['title'];
	}
	//for description
	if (empty($_POST["description"])) {
    $descrptErr = "Description is required";
	  $error=true;
  }  else{
	  $description=$db->real_escape_string($_POST['description']);
	}
	//for category
	if (empty($_POST["category"])) {
    $catErr = "Category is required";
	  $error=true;
  }  else{
	  $category = $_POST['category'];
	}
	
	//for city
	if (empty($_POST["city"])) {
    $cityErr = "City is required";
	  $error=true;
  }  else{
	  $city=$_POST['city'];
	}
	
	//for zipcode
	if (empty($_POST["postal"])) {
    $postalErr = "Zipcode/Postal is required";
	  $error=true;
  }  else{
	  $postal=$_POST['postal'];
	}
	
	//for date
	if (empty($_POST["time"])) {
    $dateErr = "Date is required";
	  $error=true;
  }  else{
	  $expiry = $_POST['time'];
	}
	
	
	
	if ($_FILES["images"]["name"][0]=="") {
		
    $ImageErr = "No Image is uploaded";
	  $error=true;
  }  else{
  $images=$_FILES["images"];
	}
$username=$_SESSION['user_details']['username'];
if($error){
$response = "All Field Required* !";
}else{
$locationid=$db->get_locationid($city);
$userid=$db->get_userid($username);	
$categoryid=$db->get_categoryid($category);		
   // $passwd = $_POST['password'];
//$repassword=$_POST['repassword'];	
$now = time();
	//echo $expiry; die;
	$date = new DateTime($expiry);
$dt = $date->getTimestamp();
	
	//$dt2 = DateTime::createFromFormat('Y-m-d',$now);
$created=$now;
	if($now>$dt){
	$status=4;
	}
	else{
	$status=1;
	}
//$hash=hash('sha256',$passwd);
//	$password=hash('whirlpool',$hash);
	$sql = "INSERT INTO leftover_meal_listing".
       "(id,user_id,category_id,location_id,title,description,status,date_created,expire_after) ".
       "VALUES ".
       "('','$userid','$categoryid','$locationid','$title','$description','$status','$created','$dt')";

	//print_r($sql);die;
$retval = $db->query($sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
	else{

	if(isset($images)){
		
		$sql2='SELECT * FROM leftover_meal_listing ORDER BY id DESC LIMIT 1';
			$result=$db->query($sql2);
		if(!$result)
{
  die('Could not enter data1: ' . mysql_error());
}
		$insertedid="";
		while($row = mysqli_fetch_assoc($result))
{
			$insertedid .=$row['id'];
		
			
		}
		 $path_image = 'meal_images/';
		  $fileType_array = array('image/jpeg', 'image/png');

	
		$folderpath=$path_image.$insertedid;
		//echo $folderpath;die;
mkdir($folderpath, 0755, true);
		
    foreach($images['name'] as $key=>$value){
	
        if(isset($images['tmp_name'][$key])){

            $type = $images['type'][$key];
            if(in_array($type, $fileType_array)){
                 $name = $value;
				list($width, $height, $type, $attr) =getimagesize($images['tmp_name'][$key]);
							
				if($width>500 && $height>300)
				{

                 if(move_uploaded_file($images['tmp_name'][$key], 	$folderpath."/".$name)){
					$query="INSERT INTO `meal_images`".
       "(meal_id,meal_image,meal_image_id) ".
       "VALUES ".
       "('','$name','$insertedid')";
	
$retval2 = $db->query($query);
if(! $retval2 )
{
  die('Could not enter data2: ' . mysql_error());
}
		
                 }
                 else
                 {
                    echo 'Error';
                 }
			}
				else{
				$response='Selected Images should have minimum width of 500px and minimum height of 300px';
				}
            }
            else
            {
                $response = 'File is not an image or format is not accepted';
            }

        }
  }
		//echo $insertedid;die;
		
	}
		
	
	
$output = "Entered data successfully\n";
	}

	
}
}
include('views/post-a-meal.php');
?>