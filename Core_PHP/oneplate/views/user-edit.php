
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
										<li>Edit Profile</li>
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
										<li><a class="active" href="user-edit.html">Edit Profile</a></li>
										<li><a href="change-password.html">Change Password</a></li>
										<li><a href="login.html">Logout</a></li>
									</ul>
									<div class="dashboard_add_new_meal">
										<a href="post-a-meal.html">Post New Meal<br /><span>Create your new meal</span></a>
									</div>
								</div>
							</div>
						</div>-->
					
						<?php include('dashboardinfo.php');?>
						<div class="dashboard_right">
							<div class="dashboard_right_inner">
								<?php 
								if($response){
								echo'<h4 class="form_required">'.$response.'</h4>';
								}else{
										
									echo'<h4 class="success_result">'.$output.'</h4>';
								}
									
								
								?>
								<form class="register_form" method="POST">
						<fieldset>
							<legend><h4 style="color:#0083bb;">Edit Profile:</h4></legend>
							<div class="register_fname">
								<label>First Name<span>*</span> :</label>
								<input type="text" value="<?php echo $_SESSION['user_details']['profile']['first_name'];?>" Placeholder="First Name" name="first_name">
								<span class="text-danger"><?php echo $firstnameErr;?></span>
							</div>
							<div class="register_lname">
								<label>Last Name :</label>
								<input type="text" value="<?php echo $_SESSION['user_details']['profile']['last_name'];?>" Placeholder="Last Name" name="last_name" >
								<span class="text-danger"><?php echo $lastnameErr;?></span>
							</div>
							<br>
							<div class="register_email edit_email">
								<label>Your Email<span>*</span> :</label>
								<input type="email" value="<?php echo $_SESSION['user_details']['username'];?>" Placeholder="Email" name="username" disabled>
							</div>
							<div class="register_phone">
						<label>Your Phone<span>*</span> :</label>
						<input type="phone" name="contact"  value="<?php echo $_SESSION['user_details']['profile']['telephone'];?>" Placeholder="Phone">
						<span class="text-danger"><?php echo $contactErr;?></span>
							</div>
							<br>
							<div class="register_address1">
								<label>Address1<span>*</span> :</label>
								<input type="text" value="<?php echo $_SESSION['user_details']['profile']['address1'];?>" Placeholder="Address1" name="address1">
								<span class="text-danger"><?php echo $addressErr;?></span>
							</div>
							<div class="register_address2">
								<label>Address2 :</label>
								<input type="text" value="<?php echo $_SESSION['user_details']['profile']['address2'];?>" Placeholder="Address2" name="address2">
							</div>
							<br>
							<?php  $cities=$db->get_cities(); ?>

					<div class="register_city volinteer_city">
						<label>City<span>*</span> :</label>
						<select name='City'>
							<?php foreach($cities as $city){?>

							<option <?php if ($city['name'] ==  $_SESSION['user_details']['profile']['city']) echo 'selected' ; ?>><?php echo $city['name'];?></option>

							<?php    }?>
						</select>
						<span class="text-danger"><?php echo $cityErr;?></span>
						<!--<input type="text" name="lastname" Placeholder="City">-->
					</div>


							<div class="register_city volinteer_zip">
								<label>Zip/Postal Code<span>*</span> :</label>
								<input type="text" name="postal" value="<?php echo $_SESSION['user_details']['profile']['zipcode'];?>" Placeholder="Zip/Postal Code">
								<span class="text-danger"><?php echo $zipcodeErr;?></span>
							</div>
							<br>
							<input class="form_submit" type="submit" name="submit" value="Submit">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</section>
			
				
				<?php   include('footer.php');?>
	
			
			</main>
            
            <script src="js/jquery-1.9.1.min.js"></script>
            <script src="js/uship.js"></script>
        </div>
	</body>
</html>
    



