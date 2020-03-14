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
							</div>
						</div>
						<img src="img/find-food-banner.jpg" alt="Find Food Banner" />
					</section>
				</div>
				<section class="search-section">
					<div class="summary-banner-container">
						<div class="search_listing">
							
							<ul>
								<?php
					require 'config/config.php';
					include 'library/Pagination.php';
					$detail_id = (isset($_GET['q'])) ? $_GET['q'] : '';
					$cat_id = (isset($_GET["cat"])) ? $_GET["cat"] : '';
$pagination = new Pagination(BASE_URL.'user-category-detail-list.php', $db->user_category_count($detail_id, $cat_id), 'Category food pages');								
					$response = $db->user_category_detail_list($pagination->get_limit(), $pagination->get_start(), $detail_id, $cat_id);
					if ($response->num_rows > 0) {
						while ($record = $response->fetch_array(MYSQLI_ASSOC)) {
							$images=$db->food_slider_images($record['meal_id']);
							$dt = date_create();
							date_timestamp_set($dt, $record['date_created']);
							$date = date_format($dt, 'T Y-M-d H:i:s');
										echo'<li>
									<div class="listing_inner">
									<div class="listing_img">
									<img src="meal_images/'.$record['meal_id'].'/'.$images.'"alt="Image"  style="width: 500px; height: 250px;"/>
									</div>
									<div class="listing_txt">
										<h4><a href="food-detail.php?q='.$record['meal_id'].'">'.$record['title'].'</a></h4>
										<div class="post_detail">
											<div class="post_by">
												<a href="user-meal-detail-list.php?q='.$record['user_id'].'">'.$record['user_name'].'</a>
											</div>
											<div class="post_category">
												<a href="user-category-detail-list.php?q='.$record['user_id'].'&cat='.$record['category_id'].'">'.$record['category_name'].'</a>
											</div>
											<div class="post_date">
												<span>'.$date.'</span>
											</div>
										</div>
										<div class="post_txt">
											<p>'.$record['description'].'</p>
											<a href="food-detail.php?q='.$record['meal_id'].'" class="post_read_more">Read More</a>
										</div>
									</div>
								</div>
							</li>';


						}
					}?>
							</ul>
						</div>
						<div class="pagination_outer">
								<?php echo $pagination->generate(); ?>
							</div>
					</div>
				</section>
				<?php include('footer.php');?>
            </main>
            
            <script src="js/jquery-1.9.1.min.js"></script>
            <script src="js/uship.js"></script>
        </div>
	</body>
</html>
    



