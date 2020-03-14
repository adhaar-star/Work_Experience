<?php


/**
 * Dashboard for admin
 */
require 'config/config.php';

$config['title'] = 'Dashboard | One-Plate-CA';
set_active_nav('dashboard');
set_active_sub_nav('');


if(isset($_GET['id'])){
$mealid=$_GET['id'] ;
$mealdetails=$db->get_meal_details($mealid); 
$mealimages=$db->get_meal_images($mealid); 
	
}

$error = $titleErr = $descrptErr = $catErr = $cityErr = $response = $output ="";
$error = false;

if(isset($_POST['submit'])){
	$err='';
	if (empty($_POST["title"])) {
    $titleErr = "Meal-Title is required";
	  $error=true;
  }  else{
	  $title=$_POST['title'];
	}
	//for description
	if (empty($_POST["description"])){
    $descrptErr = "Description is required";
	  $error=true;
  }  else{
	  $description=$_POST['description'];
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
	
$expiry = $_POST['time'];
$images = $_FILES['images'];
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
	//echo $expiry;die;
	$dt = new DateTime($expiry);
$time=$dt->getTimestamp(); 
	
	//$dt2 = DateTime::createFromFormat('Y-m-d',$now);
$created=$now;
//$hash=hash('sha256',$passwd);
//	$password=hash('whirlpool',$hash);
	$created=$now;
	if($now>$time){
	$status=4;
	}
	else{
	$status=1;
	}
$sql= "UPDATE `leftover_meal_listing` SET `category_id`='$categoryid',`location_id`='$locationid',`title`='$title',`description`='$description',`status`='$status',`expire_after`='$time' WHERE id='$mealid'";
	
$retval = $db->query($sql);
	
if(! $retval )
{
	$err=1;
  die('Could not enter data: ' . mysql_error());
}
	else{
//print_r($images);die;
	if($images['name'][0]!=""){
		
		 $path_image = 'meal_images/';
		  $fileType_array = array('image/jpeg', 'image/png');
		$folderpath=$path_image.$mealid;
		//echo $folderpath;die;
mkdir($folderpath, 0755, true);
    foreach($images['name'] as $key=>$value){
		
		
        if(isset($images['tmp_name'][$key])){

            $type = $images['type'][$key];
				 

            if(in_array($type, $fileType_array)){
				list($width, $height, $type, $attr) =getimagesize($images['tmp_name'][$key]);
			
				
                 $name = $value;
				if($width>500 && $height>300)
				{
				if (!file_exists( $folderpath."/".$name) ){
                 if(move_uploaded_file($images['tmp_name'][$key], $folderpath."/".$name)){
					$query="INSERT INTO `meal_images`".
       "(meal_id,meal_image,meal_image_id) ".
       "VALUES ".
       "('','$name','$mealid')";
	
$retval2 = $db->query($query);
if(! $retval2 )
{
  die('Could not enter data2: ' . mysql_error());
}
		
                 }
                 else
                 {
					 $err=2;
                    die('Error');
                 }
				}
				else{
					$err=3;
				$response = "Image for this meal already exists";
				
				}
			}
				else{
				$err=4;
                $response = 'Image should have minimum width of 500px and minimum height of 300px;';
				}
            }
            else
            {
				$err=5;
                $response = 'File is not an image or format is not accepted';
				die;
            }

        }
  }
		//echo $insertedid;die;


	}
		
	 
			   if($err==""){
		header('Location: '.$_SERVER['PHP_SELF'].'?id='.$mealid);   
			   }
		else{
header('Location: '.$_SERVER['PHP_SELF'].'?id='.$mealid."&&msg=".$err);
		}
	}

	
}
}


$dir    =   __DIR__;

if(isset($_POST['delete'])){
	
	if($_POST['checkbox'][0]!=""){
		$sql = "DELETE FROM meal_images WHERE meal_image_id='$mealid' AND meal_image in ";
$sql.= "('".implode("','",array_values($_POST['checkbox']))."')";
	
$retval2 = $db->query($sql);
if(! $retval2 )
{
  die('Could not enter data2: ' . mysql_error());
}
	
	else{
        foreach($_POST['checkbox'] as $key=>$value) {
               
                        $fName  =   $dir.'/meal_images/'.$mealid."/".$value;
                        
							unlink($fName);
                               
                    
            
	}
        // See if any files remain in folder
       
        // Rename any files in the folder
		header('Location: '.$_SERVER['PHP_SELF'].'?id='.$mealid);
	}
}
	else{
		$err=6;
			header('Location: '.$_SERVER['PHP_SELF'].'?id='.$mealid."&&msg=".$err);

	}
}
include('views/edit-meal.php');
//include('views/footer.php');

/**
 * Close database connection
 */
//include_once 'config/db-conn-close.php';
