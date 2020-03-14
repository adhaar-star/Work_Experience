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

$error = $titleErr = $descrptErr = $catErr = $cityErr = $imageErr = $response = $output ="";
$error = false;

if(isset($_POST['submit'])){
	$err='';
	if (empty($_POST["title"])) {
    $titleErr = "Meal-Title is required";
	  $error=true;
  }  else{
	  $title=$db->real_escape_string($_POST['title']);
	}
	//for description
	if (empty($_POST["description"])){
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
	  $category =$db->real_escape_string( $_POST['category']);
	}
	
	//for city
	if (empty($_POST["city"])) {
    $cityErr = "City is required";
	  $error=true;
  }  else{
	  $city=$db->real_escape_string($_POST['city']);
	}
	
$expiry = $db->real_escape_string($_POST['time']);

  
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
	$dt = DateTime::createFromFormat('Y-m-d',$expiry);
$time=$dt->getTimestamp(); 
	
	//$dt2 = DateTime::createFromFormat('Y-m-d',$now);
$created=$now;
//$hash=hash('sha256',$passwd);
//	$password=hash('whirlpool',$hash);
	
$sql= "UPDATE `leftover_meal_listing` SET `category_id`='$categoryid',`location_id`='$locationid',`title`='$title',`description`='$description',`expire_after`='$time' WHERE id='$mealid'";
	
$retval = $db->query($sql);
	
if(! $retval )
{
	$err=1;
  die('Could not enter data: ' . mysql_error());
}
	else{
//print_r($images);die;
	if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
         if($file_size > 100000){
			$errors[]='File size must be less than 100kb';
        }		
        $query="INSERT INTO `meal_images`".
       "(meal_id,meal_image,meal_image_id) ".
       "VALUES ".
       "('','$file_name','$mealid')";
        $desired_dir="meal_images";
		die($query);
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            }else{									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
		 mysql_query($query);			
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		echo "Success";
	}
}
		  if($err==""){
		header('Location: '.$_SERVER['PHP_SELF'].'?id='.$mealid."&&msg=".$err);   
			   }
		else{
header('Location: '.$_SERVER['PHP_SELF'].'?id='.$mealid."&&msg=".$err);
		}
	
	}
	} 
	
}
        // See if any files remain in folder
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
		$err=5;
			header('Location: '.$_SERVER['PHP_SELF'].'?id='.$mealid."&&msg=".$err);

	}
}
include('views/edit-meal.php');
//include('views/footer.php');

/**
 * Close database connection
 */
//include_once 'config/db-conn-close.php';
