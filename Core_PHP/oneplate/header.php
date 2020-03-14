<header role="banner" id="uship-header">
				<div class="siteNav-container">
					<nav role="navigation" class="siteNav">
						<a class="siteNav-logoBox js-siteNav-logoBox" href="./">
							<span class="sel_uship_logo siteNav-logoBox-container">
								<img src="img/logo.png" alt="One Plate Canada" style="max-width:85px;margin:4px 0 0;" />
							</span>
						</a>
						<div class="siteNav-content is-hidden js-siteNav-content">
							<div class="siteNav-linksContainer is-open">
								<div class="siteNav-links">
									<a id="howitworks-header-link" class="siteNav-link sel-navLink-HowItWorks" href="how-it-works.php">
										<span class="siteNav-linkText">How It Works</span>
									</a>
									<a id="findshipments-header-link" class="siteNav-link sel-navLink-FindShipments" href="find-food.php">
										<span class="siteNav-linkText">Find Food</span>
									</a>
								</div>
								<div class="siteNav-splitLinks hideMobile">
									<a class="siteNav-link sel-navLink-donate" href="donate.php">
										<span class="siteNav-linkText">Donate</span>
									</a>
									<a class="siteNav-link sel-navLink-donate" href="volinteer.php">
										<span class="siteNav-linkText">Volinteer</span>
									</a>
										<?php if(isset($_SESSION['user_details']['username'])){?>
									<a class="siteNav-link sel-navLink-SignIn" href="login.php">
									
										<span class="siteNav-linkText">Dashboard</span>
										
									
										
									</a>
								<?php  }else{?>

									<a class="siteNav-link sel-navLink-SignIn" href="login.php">
										
										
										
										<span class="siteNav-linkText">Sign In</span>
										
									</a>
									<?php }?>
									<a class="siteNav-link sel-navLink-Join" href="signup.php">
										<span class="siteNav-linkText">Join</span>
									</a>
								</div>
								<div class="siteNav-helpLinks">
									<a class="siteNav-link" target="_blank" id="help-header-link" href="help.php">
										<span class="subNav-linkText">Help</span>
									</a>
								</div>
							</div>
						</div>
					</nav>
				</div>
			</header>   