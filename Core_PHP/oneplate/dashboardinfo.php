<div class="dashboard_left">
							<div class="dashboard_left_inner">
								<div class="dashboard_auther">
									<a class="info_thumb">
										<img width="60" height="60" alt="" src="img/author.jpg">
									</a>
									<div class="text">
										<h6><?php echo $_SESSION['user_details']['profile']['first_name']."  ".$_SESSION['user_details']['profile']['last_name'];?></h6>
										<span><?php echo $_SESSION['user_details']['username']; ?></span>
									</div>
								</div>
								<div class="dashboard_info">
									<ul>
										<li><a href="my-meal.php">My Meal</a></li>
										<li><a href="user-edit.php">Edit Profile</a></li>
										<li><a href="change-password.php">Change Password</a></li>
										    

										<li><a href="logout.php">Logout</a></li>
									</ul>
									<div class="dashboard_add_new_meal">
										<a href="post-a-meal.php">Post New Meal<br /><span>Create your new meal</span></a>
									</div>
								</div>
							</div>
						</div>
						