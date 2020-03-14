<?php
$error = $sub_emailErr = "";
$error = false;
if(isset($_POST['sub_submit'])){
	
	//for email validation
  if (empty($_POST["sub_email"])) {
    $sub_emailErr = "Email is required";
	 $error = true;
  } else {
    $sub_email = $_POST["sub_email"];
    // check if e-mail address is well-formed
    if (!filter_var($sub_email, FILTER_VALIDATE_EMAIL)){
      $sub_emailErr = "Invalid email format";
		$error = true;
    }
  }
if($error){
echo $error;
}
else{	
$sub_emailErr = $db->subscribe_email($sub_email);
}
}
?>
<footer>
					<div class="footer">
						<div class="container">
							<div class="footer_sections">
								<div class="footer_inner">
									<h4>About One Plate Canada</h4>
									<a href="./"><img src="img/logo.png" alt="Footer Logo" width="100px" /></a>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br /> <a href="#">Read More</a></p>
								</div>
							</div>
							<div class="footer_sections">
								<div class="footer_inner">
									<h4>Pages</h4>
									<ul>
										<li><a href="#">How It Works</a></li>
										<li><a href="#">Find Food</a></li>
									</ul>
								</div>
							</div>
							<div class="footer_sections">
								<div class="footer_inner">
									<h4>Contact Information</h4>
									<ul>
										<p class="footer_address">
											The Company name<br />
											Lorem Ipsum Dolor,<br />
											Canada
										</p>
										<p class="footer_phone">1234567890</p>
										<p class="footer_email"><a href="mailto:info@oneplatecanada.com">info@oneplatecanada.com</a></p>
									</ul>
									<h5>Follow us at</h5>
									<ul class="footer_social">
										<li><a href="#"><img src="img/facebook.png" alt="Facebook"/></a></li>
										<li><a href="#"><img src="img/twitter.png" alt="Facebook"/></a></li>
										<li><a href="#"><img src="img/linkedin.png" alt="Facebook"/></a></li>
									</ul>
								</div>
							</div>
							<div class="footer_sections">
								<div class="footer_inner">
									<h4>Subscribe Newsletter</h4>
									<ul>
										<p>Subscribe to our maling list to get the update to you email</p>
										<form method="post">
											<input type="email" name="sub_email" value = "" maxlength="100" />
											<button type="submit" name="sub_submit">Subscribe</button>
											<span class="text-danger"><?php echo $sub_emailErr;?></span>
										</form>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</footer>
           