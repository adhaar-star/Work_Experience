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
			
			<?php   include('header.php');?>
			<main role="main" class="content marketing content-newHeader content-newFooter">
				<div class="hero-wrapper">
					<section class="homepage-section hero">
						<div class="flex-container and-smallAlignCenter and-smallColumn and-mediumRow">
							<div class="flex-item flex-small-11 flex-medium-7 flex-large-7 large-offset-1">
								<div class="breadcrumb">
									<ul>
										<li><a href="./">Home</a></li>
										<li>></li>
										<li>Post a Meal</li>
									</ul>
								</div>
							</div>
						</div>
						<img src="img/find-food-banner.jpg" alt="Find Food Banner" />
					</section>
				</div>
				<section class="section_meal">
					<div class="summary-banner-container">
						<!--<div class="dashboard_left">
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
										<li><a href="my-meal.html">My Meal</a></li>
										<li><a href="user-edit.html">Edit Profile</a></li>
										<li><a href="change-password.html">Change Password</a></li>
										<li><a href="login.html">Logout</a></li>
									</ul>
									<div class="dashboard_add_new_meal">
										<a href="post-a-meal.html">Post New Meal<br /><span>Create your new meal</span></a>
									</div>
								</div>
							</div>
						</div>-->
					
						<?php  include('dashboardinfo.php'); ?>
						
						<div class="dashboard_right">
							<div class="dashboard_right_inner">
								
								<div class="dashboard_right_header">
									<h3>Add New Meal</h3>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
								</div>
								<?php
								if($response){
								echo'<h4 class="form_required">'.$response.'</h4>';
								}else{
										if(isset($_GET['msg'])){
									echo'<h4 class="success_result">Entered Data Successfully </h4>';
								}
								}?>
								<br>
								<div class="dashboard_right_main">
									<form method='POST' enctype='multipart/form-data'>
										<div class="meal_title">
											<label>Title<span>*</span></label>
											<input type="text" placeholder="Title" name="title" value ="<?php echo $title;?>"/>
											<span class="text-danger"><?php echo $titleErr;?></span>
										</div>
										<div class="meal_description">
											<label>Description<span>*</span></label>
											<textarea placeholder="Description" name='description' value ="<?php echo $description;?>"></textarea>
											<span class="text-danger"><?php echo $descrptErr;?></span>
										</div>
										<div class="meal_category">
											<label>Select Category<span>*</span></label>
											<select name='category'>
												<option value="0">-- Please Select --</option>
												<option value= "Breakfast">Breakfast</option>
												<option value= "Lunch">Lunch</option>
												<option value= "Dinner">Dinner</option>
											</select>
											<span class="text-danger"><?php echo $catErr;?></span>
										</div>
								<div class="meal_city">
									<label>City<span>*</span> </label>
									<select name='city' >
										<option value="0">-- Please Select --</option>
										<?php 
											$cities = $db->get_cities();
												foreach($cities as $city){
										 echo '<option>'.$city['name'].'</option>';}?>
									</select>
									<span class="text-danger"><?php echo $cityErr;?></span>
								</div>
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
									-->
										
										<div class="meal_zip">
											<label>Zip/Postal Code<span>*</span></label>
											<input type="text" placeholder="Zip/Postal Code" name="postal" value ="<?php echo $postal;?>"/>
											<span class="text-danger"><?php echo $postalErr;?></span>
										</div>
										<br>
										
										<div class="meal_expire">
											<label>Meal Expire Date<span>*</span></label>
											<input type="text" id="datepicker" name="time" value ="<?php echo $expiry;?>">
											<span class="text-danger"><?php echo $dateErr;?></span>
										</div>
										<div class="meal_upload">
											<label>Upload Gallery<span>*</span></label>
											<input type="file" name="images[]" multiple="true"/>
											<span class="text-danger"><?php echo $ImageErr;?></span>
										</div>
										<div class="meal_Submit">
											<button type="submit" name="post_submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
				
			<?php   include('footer.php');?>
			
			
			</main> 
           
        </div>
	</body>
</html>
 