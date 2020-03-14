<?php
$html="";
$q = (isset($_GET['q'])) ? $_GET['q'] : '';
$action = (isset($_GET["action"])) ? $_GET["action"] : '';
$filter = (isset($_GET["cat"])) ? $_GET["cat"] : '';
if($q == 'search') {
	
	$response = $db->search_food($pagination->get_limit(), $pagination->get_start(), $action);
}
elseif($q == 'filter') {
	$response = $db->search_by_category($pagination->get_limit(), $pagination->get_start(), $filter, $action);
}
else{
	$response = $db->all_food($pagination->get_limit(), $pagination->get_start());
	//var_dump($pagination->get_limit());
	//var_dump($pagination->get_start());die;
	
}
if ($response->num_rows > 0) {
	while ($record = $response->fetch_array(MYSQLI_ASSOC)) {
		$images=$db->food_slider_images($record['meal_id']);
		$dt = date_create();
		date_timestamp_set($dt, $record['date_created']);
		$date = date_format($dt, 'T Y-M-d H:i:s'); 
				$html .='<li>
					<div class="listing_inner">
					<div class="listing_img">
						<img src="meal_images/'.$record['meal_id'].'/'.$images.'"alt="Image"  style="width: 500px; height: 250px;" />
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
		
}
else{

$html .=' Meal Not Found !';
}
/*if(isset($_GET['category'])){
	$response = $db->search_by_category();
if ($response->num_rows > 0) {
	while ($record = $response->fetch_array(MYSQLI_ASSOC)) {

		$dt = date_create();

		date_timestamp_set($dt, $record['date_created']);

		$date = date_format($dt, 'T Y-M-d H:i:s'); 
				$html .='<li>
					<div class="listing_inner">
					<div class="listing_img">
						<img src="img/poutine.jpg" alt="Image" />
					</div>
					<div class="listing_txt">
						<h4><a href="edit-meal.html">'.$record['title'].'</a></h4>
						<div class="post_detail">
							<div class="post_by">
								<a href="#"></a>
							</div>
							<div class="post_category">
								<a href="#">'.$record['category_name'].'</a>
							</div>
							<div class="post_date">
								<span>'.$date.'</span>
							</div>
						</div>
						<div class="post_txt">
							<p>'.$record['description'].'</p>
							<a href="food-detail.html" class="post_read_more">Read More</a>
						</div>
					</div>
				</div>
			</li>';
	}
}
}*/
?>


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
						<div class="search_top">
							<form class="search_form">
								<fieldset>
									<input class="search_form_input" name="action" type="text" Placeholder="Eg. Pizza, Burger, Bacon, Butter Tarts etc.">
									<input class="form_submit" type="submit" id="search_submit" name="search_food" value="Search Food">
									<input type="hidden" name="filter" value="all">
									<input type="hidden" name="q" value="search">
								<?php if(isset($action) && $action!=""){?>
									<p class="show">Showing Result For : <span  class="action_show"> <?php echo $action;?></span> </p>
							<?php }?>
									<div id="hide" class="search_sort">
										<p class="sort_by">Sort By:</p>
										<ul>
											<li><a href="find-food.php?q=filter&cat=1&action=<?php echo $action;?>">Breakfast</a></li>
											<li><a href="find-food.php?q=filter&cat=2&action=<?php echo $action;?>">Lunch</a></li>
											<li><a href="find-food.php?q=filter&cat=3&action=<?php echo $action;?>">Dinner</a></li>
										</ul>
									</div>
								</fieldset>
							</form>
						</div>
						<div class="search_listing">
							<div class="pagination_outer">
								<?php echo $pagination->generate(); ?>
								<!--
								<ul class="pagination">
									<li><a href="#">«</a></li>
									<li><a class="active" href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">6</a></li>
									<li><a href="#">7</a></li>
									<li><a href="#">»</a></li>
								</ul>
								-->
							</div>
							<ul>
							<?php 
								echo $html;
								?>
							</ul>
							<div class="row">
						   <?php     

							?>
						</div>
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