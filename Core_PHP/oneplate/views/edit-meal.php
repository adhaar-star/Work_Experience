<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
        <title>One Plate Canada</title>			
		<meta content='' name="description" />
		<meta id="" content='' name="keywords" />
		<link href="css/homepage.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  	<link rel="stylesheet" href="/resources/demos/style.css">
		  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		  <script>
		  $( function() {
			$( "#datepicker" ).datepicker();
		  } );
		  </script>
    </head>
    
	<body>
        <div id="page-root" class="js-pageContainer js-container">
			<?php include('header.php');?>
            <main role="main" class="content marketing content-newHeader content-newFooter">
				<div class="hero-wrapper">
					<section class="homepage-section hero">
						<div class="flex-container and-smallAlignCenter and-smallColumn and-mediumRow">
							<div class="flex-item flex-small-11 flex-medium-7 flex-large-7 large-offset-1">
								<div class="breadcrumb">
									<ul>
										<li><a href="./">Home</a></li>
										<li></li>
										<li>Edit Meal</li>
									</ul>
								</div>
							</div>
						</div>
						<img src="img/find-food-banner.jpg" alt="Find Food Banner" />
					</section>
				</div>
				<section class="section_meal">
					<div class="summary-banner-container">
						<div class="dashboard_left">
							<div class="dashboard_left_inner">
								<div class="dashboard_auther">
									<a class="info_thumb">
										<img width="60" height="60" alt="" src="img/author.jpg">
									</a>
									<div class="text">
										<h6>admin</h6>
										<span>administrator</span>
									</div>
								</div>
								<div class="dashboard_info">
									<ul>
										<li><a href="my-meal.php">My Meal</a></li>
										<li><a href="user-edit.php">Edit Profile</a></li>
										<li><a href="change-password.php">Change Password</a></li>
										<li><a href="login.php">Logout</a></li>
									</ul>
									<div class="dashboard_add_new_meal">
										<a href="post-a-meal.php">Post New Meal<br /><span>Create your new meal</span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="dashboard_right">
							<div class="dashboard_right_inner">
								<div class="dashboard_right_header">
									<h3>Edit Poutine</h3>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
								</div>
								<?php
if(isset($_GET['msg'])){
$errorid=$_GET['msg'];
	if($errorid==4){
	echo'<h4 class="form_required">File is not an image or format is not accepted</h4>';
	}
	else if($errorid==3){
	echo'<h4 class="form_required">Selected Images for this meal already exists</h4>';
	}
	else if($errorid==1){
		echo'<h4 class="form_required">Couldnot update data.Try again</h4>';

	}
		else if($errorid==5){
		echo'<h4 class="form_required">No Image selected for deletion</h4>';

	}
	
		else if($errorid==6){
		echo'<h4 class="success_result">Entered data successfully</h4>';

	}
	else if($errorid==7){
		echo'<h4 class="success_result">Delete image successfully</h4>';

	}
	else if($errorid==8){
		echo'<h4 class="success_result">Entered data successfully</h4>';

	}
}

	
								if($response){
								echo'<h4 class="form_required">'.$response.'</h4>';
								}else{
									echo'<h4 class="success_result"></h4>';
								
								}
									?>
								<br>
								<div class="dashboard_right_main">
									<?php if(isset($mealdetails)){?>
									
									<form method="POST"  enctype='multipart/form-data'>
										<input type="hidden" name="mealid" value="<?php   echo $mealdetails[0]['id'];?>"/>
										<div class="meal_title">
											<label>Title<span>*</span></label>
											<input type="text" value="<?php   echo $mealdetails[0]['title'];?>" placeholder="Title" name="title"/>
											<span class="text-danger"><?php echo $titleErr;?></span>
										</div>
										<div class="meal_description">
											<label>Description<span>*</span></label>
											<textarea style="height:120px;" placeholder="Description" name="description"><?php   echo $mealdetails[0]['description'];?></textarea>
											<span class="text-danger"><?php echo $descrptErr;?></span>
										</div>
										<div class="meal_category">
											<label>Select Category<span>*</span></label>
											<select name="category">
												<option>--Select--</option>
												<option <?php if ($mealdetails[0]['category_id']==1) echo 'selected' ; ?>>Breakfast</option>
												<option <?php if ($mealdetails[0]['category_id']==2) echo 'selected' ; ?>>Lunch</option>
												<option  <?php if ($mealdetails[0]['category_id']==3) echo 'selected' ; ?>>Dinner</option>
											</select>
											<span class="text-danger"><?php echo $catErr;?></span>
										</div>
										<?php  $cities=$db->get_cities(); ?>
										<div class="meal_city">
											<label>City<span>*</span></label>
											<select name='city'>
										<?php foreach($cities as $city){?>
										
										<option <?php if ($mealdetails[0]['location_id']==$city['id']) echo 'selected' ; ?>><?php echo $city['name'];?></option>
										
										<?php    }?>
									<!--	<div class="meal_province">
											<label>Province</label>
											<select>
												<option>Alberta</option>
												<option>British Columbia</option>
												<option>Manitoba</option>
												<option>New Brunswick</option>
												<option>Newfoundland and Labrador</option>
												<option>Nova Scotia</option>
												<option>Ontario</option>
												<option>Prince Edward Island</option>
												<option>Quebec</option>
												<option>Saskatchewan</option>
											</select>
										</div>
									--></select>
											<span class="text-danger"><?php echo $cityErr;?></span>
										</div>
									
										<div class="meal_zip">
											<label>Status</label>
											<?php if($mealdetails[0]['status']==1){
$status="Available";
}else if($mealdetails[0]['status']==2){$status="Delievered";}else if($mealdetails[0]['status']==3){$status="Not Delievered";}else{$status="Not Delivered and archieved by system";}?>
											<input type="text" value="<?php echo $status;?>" placeholder="Status" disabled/>
										</div>
										<?php  
															
									
										$timestamp=$mealdetails[0]['expire_after'];
						  

										?>
										<div class="meal_expire">
											<label>Meal Expiry Date<span>*</span></label>
											<input type="text" value="<?php echo gmdate("Y-m-d", $timestamp);?>" id="datepicker" name="time"/>
										</div>
				
										<div class="uploaded_images" style="">
							<?php

								foreach($mealimages as $key=>$value){
								?>

								<div class='imagegroup' style="display: table-cell;">
									<div class='imagegroup-inner'>
										<img src='meal_images/<?php echo $mealdetails[0]['id']."/".$value;?>' style="width:134px;height:189px;"/>
										<input name="checkbox[]" value="<?php echo $value;?>" type="checkbox"/>
									</div>
								</div>
								<?php }
											
											
											
											?>
											
										
											<div class="delete_images">
											<input type="submit" name="delete" value="Delete Images">
											</div>
											</div>
										
										<div class="meal_upload">
											<label>Upload Gallery</label>
											<input type="file" name="images[]" multiple="true"/>
											<span class="text-danger"><?php echo $imageErr;?></span>
										</div>
										<div class="meal_Submit">
											<button type="submit" name="submit">Update</button>
										</div>
									</form>
								
									<?php }else{?>
									
									<form>
										<div class="meal_title">
											<label>Title</label>
											<input type="text" value="Poutine" placeholder="Title" />
										</div>
										<div class="meal_description">
											<label>Description</label>
											<textarea style="height:120px;" placeholder="Description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</textarea>
										</div>
										<div class="meal_category">
											<label>Select Category</label>
											<select>
												<option>--Select--</option>
												<option selected>Breakfast</option>
												<option>Lunch</option>
												<option>Dinner</option>
											</select>
										</div>
										<div class="meal_city">
											<label>City</label>
											<input type="text" value="Vancouver" placeholder="City" />
										</div>
									
										<div class="meal_zip">
											<label>Zip/Postal Code</label>
											<input type="text" value="V5K 0A1" placeholder="Zip/Postal Code" />
										</div>
										<div class="meal_expire">
											<label>Meal Expiry Date</label>
											<input type="date" value="24/11/2016" />
										</div>
										<div class="meal_upload">
											<label>Upload Gallery</label>
											<input type="file" />
										</div>
										<div class="meal_Submit">
											<button type="submit">Update</button>
										</div>
									</form>
								
									
									
									<?php }?>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?php include('footer.php');?>
            </main> 
           
        </div>
	</body>
</html>