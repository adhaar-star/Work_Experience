
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
			<?php  include('header.php'); ?>
			
			<main role="main" class="content marketing content-newHeader content-newFooter">
				<div class="hero-wrapper">
					<section class="homepage-section hero">
						<div class="flex-container and-smallAlignCenter and-smallColumn and-mediumRow">
							<div class="flex-item flex-small-11 flex-medium-7 flex-large-7 large-offset-1">
								<div class="breadcrumb">
									<ul>
										<li><a href="./">Home</a></li>
										<li>></li>
										<li>Donate</li>
									</ul>
								</div>
							</div>
						</div>
						<img src="img/find-food-banner.jpg" alt="Find Food Banner" />
					</section>
				</div>
				<section class="homepage-section">
					<div class="summary-banner-container">
						<form class="login_form" method="post" >
							<?php
							  
								echo'<h4 class="form_required">'.$msg.'</h4>';
								
							?>
							<fieldset>
								<legend><h4 style="color:#0083bb;">Donation Form:</h4></legend>
								<input type="hidden" name="cmd" value="_xclick" />
								<input type="hidden" name="no_note" value="1" />
								<input type="hidden" name="location" value="IN" />
								<input type="hidden" name="currency_code" value="USD" />
								<div class="register_email">
								<label>Your First Name<span>*</span></label>
								<input type="text" name="first_name" Placeholder="Your First Name" value="" >
								<span class="text-danger"><?php echo $firstnameErr;?></span>
								</div>
								<br>
								<div class="register_email">
								<label>Your Last Name<span>*</span></label>
								<input type="text" name="last_name" Placeholder="Your Last Name" value="">
								<span class="text-danger"><?php echo $lastErr;?></span>
								</div>
								<br>
								<div class="register_email">
								<label>Your Email<span>*</span></label>
								<input type="email" name="payer_email" Placeholder="Your Email" value="">
								<span class="text-danger"><?php echo $emailErr;?></span>
								</div>
								<br><br>
								<div class="register_email">
								<label>Donation Amount<span>*</span></label>
								<input type="text" name="amount" Placeholder="Donation Amount">
								<span class="text-danger"><?php echo $amtErr;?></span>
								</div>
								<br><br>
								<input class="form_submit" name="submit" type="submit" value="Proceed to PayPal">
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
    



