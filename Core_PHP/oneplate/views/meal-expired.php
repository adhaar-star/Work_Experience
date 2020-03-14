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
		<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		
		</style>
    </head>
    
	<body>
        <div id="page-root" class="js-pageContainer js-container">
			<?php   include('header.php'); ?>
            <main role="main" class="content marketing content-newHeader content-newFooter">
				<div class="hero-wrapper">
					<section class="homepage-section hero">
						<div class="flex-container and-smallAlignCenter and-smallColumn and-mediumRow">
							<div class="flex-item flex-small-11 flex-medium-7 flex-large-7 large-offset-1">
								<div class="breadcrumb">
									<ul>
										<li><a href="./">Home</a></li>
										<li></li>
										<li>My Meal</li>
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
										<li><a class="active" href="my-meal.html">My Meal</a></li>
										<li><a href="user-edit.html">Edit Profile</a></li>
										<li><a href="change-password.html">Change Password</a></li>
										<li><a href="login.html">Logout</a></li>
									</ul>
									<div class="dashboard_add_new_meal">
										<a href="post-a-meal.php">Post New Meal<br /><span>Create your new meal</span></a>
									</div>
								</div>
							</div>
						</div>-->
						<?php include('dashboardinfo.php');?>
						<div class="dashboard_right">
							<div class="dashboard_right_inner">
								<div class="dashboard_right_header meal-listing-outer">
									<a href="my-meal.php" class="button_active" type="button">Active List</a>
									<h3><a href="meal-expired.php">My Meals</a></h3>
									<div class="meal-listing">
										<div class="dropdown">
										  <button class="dropbtn">By Category</button>
										  <div class="dropdown-content">
											<a href="meal-expired.php?q=1">Breakfast</a>
											<a href="meal-expired.php?q=2">Lunch</a>
											<a href="meal-expired.php?q=3">Dinner</a>
										  </div>
										</div>
									</div>
									<h3 class="post-new-meal"><span><a href="post-a-meal.php">Post a new meal</a></span></h3>
								</div>
								<div class="dashboard_right_listing" style="margin:20px 0 0">
									<div class="my_meals">
										<table>
											<tr>
												<th>Title</th>
												<th>Start Date</th>
												<th>Category</th>
												<th>Edit</th>
												<th>Delete</th>
											</tr>
										<?php
									if(isset($_GET['q'])){
										$cat_id = $_GET['q'];
			$active_listings = $db->get_category_expired_listings($pagination->get_limit(), $pagination->get_start(), $cat_id);
										}	
										else{	
							$active_listings = $db->get_expired_listings($pagination->get_limit(), $pagination->get_start());
										}
								if (!empty($active_listings)) {
							
                            $calc_at = $active_listings['calc_at'];
                            unset($active_listings['calc_at']);
                            foreach ($active_listings as $record) {
								$id=$record['listing_id'];
                                echo '<tr ' . $db->get_listing_warning($record['expire_after']) . '>';
                                echo '<td>' .$record['title'].'</td>';
                                echo '<td>' .date("F j, Y", $record['date_created']).
                                '</td>';
                                echo '<td>' .$record['meal_name'].'</td>';
                                echo '<td><a href="edit-meal.php?id='.$id.'">Edit</a></td>';
								echo '<td><a href="meal-delete.php?id='.$id.'">Delete</a></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr>'
                            . '<td colspan="7" class="bg-warning text-center" style="text-align:center;"><h4>No Record Found</h4></td>'
                            . '</tr>';
                        }

                        ?>
											<!--
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Poutine</a></td>
												<td>September 20, 2016</td>
												<td>Breakfast</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#">Delete</a></td>
											</tr>
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Butter Tart</a></td>
												<td>September 18, 2016</td>
												<td>Lunch</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#">Delete</a></td>
											</tr>
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Smoked Salmon</a></td>
												<td>September 16, 2016</td>
												<td>Dinner</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#">Delete</a></td>
											</tr>
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Potatoes</a></td>
												<td>September 12, 2016</td>
												<td>Breakfast</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#">Delete</a></td>
											</tr>
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Tourtiere</a></td>
												<td>September 11, 2016</td>
												<td>Lunch</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#">Delete</a></td>
											</tr>
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Rye Bread</a></td>
												<td>September 01, 2016</td>
												<td>Lunch</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#">Delete</a></td>
											</tr>
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Timbits</a></td>
												<td>August 31, 2016</td>
												<td>Dinner</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#">Delete</a></td>
											</tr>
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Nanaimo Bar</a></td>
												<td>August 24, 2016</td>
												<td>Breakfast</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#">Delete</a></td>
											</tr>
											<tr>
												<td><a class="listing_title" href="edit-meal.php">Ketchup Chips</a></td>
												<td>August 13, 2016</td>
												<td>Breakfast</td>
												<td><a href="edit-meal.php">Edit</a></td>
												<td><a href="#" onclick="delete">Delete</a></td>
											</tr>-->
										</table>
										
									</div><br>	<?php echo $pagination->generate(); ?>
									
								</div>
							</div>
												

						</div>
					</div>
					
				</section>
				
			
			</main> 
            <script src="js/jquery-1.9.1.min.js"></script>
            <script src="js/uship.js"></script>
        </div>
	</body>
</html>