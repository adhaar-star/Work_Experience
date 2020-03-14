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
										<li>Change Password</li>
									</ul>
								</div>
							</div>
						</div>
						<img src="img/find-food-banner.jpg" alt="Find Food Banner" />
					</section>
				</div>
				<section class="section_meal">
					<div class="summary-banner-container">
						<?php include('dashboardinfo.php');?>
						
						
						<div class="dashboard_right">
							<div class="dashboard_right_inner">
								<?php if($response){
								echo'<h4 class="form_required">'.$response.'</h4>';
								}else{
										
									echo'<h4 class="success_result">'.$output.'</h4>';
								}
									 ?>
								<form class="register_form" method="POST">
									<fieldset>
										<legend><h4 style="color:#0083bb;">Change Password:</h4></legend>
										<div class="register_email">
											<label>Old  Password<span>*</span> </label>
											<input type="text" Placeholder="Old  Password" name="oldpassword">
											<span class="text-danger"><?php echo $oldpasswordErr;?></span>
										</div>
										<div class="register_fname">
											<label>New  Password<span>*</span> </label>
											<input type="text" Placeholder="New  Password" name="password">
											<span class="text-danger"><?php echo $passwordErr;?></span>
										</div>
										<div class="register_lname">
											<label>Confirm New  Password<span>*</span> </label>
											<input type="text" Placeholder="Confirm New  Password" name="repassword">
											<span class="text-danger"><?php echo $repasswordErr;?></span>
										</div>
										<input class="form_submit" type="submit" name="submit" value="Update Password">
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