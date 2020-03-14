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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	 <script type="text/javascript">
		$(document).ready(function(){
		                  $(".close-alert").click(function(){
			 $(this).parent().css("display", "none");
			});
		});
	</script>
    </head>
    
	<body>
        <div id="page-root" class="js-pageContainer js-container">
							<?php  include('header.php'); ?>

			
			<main role="main" class="content marketing content-newHeader content-newFooter">
				<div class="hero-wrapper">
					<section class="homepage-section hero">
						<div class="flex-container and-smallAlignCenter and-smallColumn and-mediumRow">
							<div class="flex-item flex-small-11 flex-medium-7 flex-large-7 large-offset-1">
								<div class="breadcrumb">
									<ul>
										<li><a href="./">Home</a></li>
										<li></li>
										<li>Login</li>
									</ul>
								</div>
							</div>
						</div>
						<img src="img/find-food-banner.jpg" alt="Find Food Banner" />
					</section>
				</div>
				<section class="homepage-section">
					<div class="summary-banner-container">
						<form class="login_form" method="POST">
							<span class="notifications"><?php display_alerts();?></span>
							 <input type="hidden" name="action" value="login" />
							<fieldset>
								<legend><h4 style="color:#0083bb;">Login:</h4></legend>
								<label>Username:</label>
								<input type="text" name="email" Placeholder="Username">
								<br>
								<label>Password:</label>
								<input type="password" name="password" Placeholder="Password">
								<br><br>
								<div class="login_remember_password">
									<label class="remebmer_password"><input type="checkbox" name="remember_password">Remember Password</label>
								</div>
								<div class="login_forgot_password">
									<a href="forgot-password.html">Forgot Password</a>
								</div>
								<input class="form_submit" type="submit" value="login">
							</fieldset>
						</form>
					</div>
				</section>
				<?php  include('footer.php'); ?>
			
			
			</main>
            
            <script src="js/jquery-1.9.1.min.js"></script>
            <script src="js/uship.js"></script>
        </div>
	</body>
</html>
    



