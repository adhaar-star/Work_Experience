
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
			<?php include('header.php');?>
            <main role="main" class="content marketing content-newHeader content-newFooter">
				<div class="hero-wrapper">
					<section class="homepage-section hero">
						<div class="flex-container and-smallAlignCenter and-smallColumn and-mediumRow">
							<div class="flex-item flex-small-11 flex-medium-7 flex-large-7 large-offset-1">
								<div class="breadcrumb">
									<ul>
										<li><a href="./">Home</a></li>
										<li>></li>
										<li>Volinteer</li>
									</ul>
								</div>
							</div>
						</div>
						<img src="img/find-food-banner.jpg" alt="Find Food Banner" />
					</section>
				</div>
				<section class="homepage-section">
					<div class="summary-banner-container">
						<form class="register_form" method="post">
							<?php
								if($response){
								echo'<h4 class="form_required">'.$response.'</h4>';
								}else{
										
									echo'<h4 class="success_result">'.$output.'</h4>';
								}
									?>
							<fieldset>
								<legend><h4 style="color:#0083bb;">Become a Volinteer:</h4></legend>
								<div class="register_fname">
									<label>First Name<span>*</span> :</label>
									<input type="text" name="first_name" Placeholder="First Name">
									<span class="text-danger"><?php echo $firstnameErr;?></span>
								</div>
								<div class="register_lname">
									<label>Last Name :</label>
									<input type="text" name="last_name" Placeholder="Last Name">
									<span class="text-danger"><?php echo $lastnameErr;?></span>
								</div>
								<br>
								<div class="register_email edit_email">
									<label>Your Email<span>*</span> :</label>
									<input type="email" name="email" Placeholder="Email">
									<span class="text-danger"><?php echo $emailErr;?></span>
								</div>
								<div class="register_phone volinteer_phone">
									<label>Your Phone<span>*</span> :</label>
									<input type="phone" name="contact"  Placeholder="Phone">
									<span class="text-danger"><?php echo $contactErr;?></span>
								</div>
								<br>
								<div class="register_address1">
									<label>Address1<span>*</span> :</label>
									<input type="text" name="address1"  Placeholder="Address1">
									<span class="text-danger"><?php echo $addressErr;?></span>
								</div>
								<div class="register_address2">
									<label>Address2 :</label>
									<input type="text" name="address2"  Placeholder="Address2">
								</div>
								<br>
								<div class="register_city volinteer_city">
									<label>City<span>*</span> :</label>
									<select name="city">
									<option value="0">-- Please Select --</option>
										<?php
										echo $html;
										?>	
									</select>
									<span class="text-danger"><?php echo $cityErr;?></span>
								</div>
								<div class="register_city volinteer_zip">
									<label>Zip/Postal Code<span>*</span> :</label>
									<input type="text" name="postal" Placeholder="Zip/Postal Code">
									<span class="text-danger"><?php echo $zipcodeErr;?></span>
								</div>
								<br>
								<br>
								<input class="form_submit" type="submit" name="vol_submit" value="Register">
							</fieldset>
						</form>
					</div>
				</section>
				<?php include('footer.php');?>
            </main>
            
            <script src="js/jquery-1.9.1.min.js"></script>
            <script src="js/uship.js"></script>
        </div>
	</body>	
</html>