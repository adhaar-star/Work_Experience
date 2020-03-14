<?php 
		require 'config/config.php';?>
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

			tr:nth-child(even) {
				background-color: #dddddd;
			}
			h1 {
  color: #fff;
  text-align: center;
  font-weight: 300;
}

#slider {
  position: relative;
  overflow: hidden;
  margin: 20px auto 0 auto;
  border-radius: 4px;
}

#slider ul {
  position: relative;
  margin: 0;
  padding: 0;
  height: 200px;
  list-style: none;
}

#slider ul li {
  position: relative;
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  width: 500px;
  height: 300px;
  background: #ccc;
  text-align: center;
  line-height: 300px;
}

a.control_prev, a.control_next {
  position: absolute;
  top: 40%;
  z-index: 999;
  display: block;
  padding: 4% 3%;
  width: auto;
  height: auto;
  background: #2a2a2a;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  font-size: 18px;
  opacity: 0.8;
  cursor: pointer;
}

a.control_prev:hover, a.control_next:hover {
  opacity: 1;
  -webkit-transition: all 0.2s ease;
}

a.control_prev {
  border-radius: 0 2px 2px 0;
}

a.control_next {
  right: 0;
  border-radius: 2px 0 0 2px;
}

.slider_option {
  position: relative;
  margin: 10px auto;
  width: 160px;
  font-size: 18px;
}


		</style>
	
	
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
					<?php
				$html="";
							$detail_id = $_GET['q'];
					$response = $db->food_user_detail($detail_id);
					
//print_r($sliderimages);die;
//print_r($sliderimages);die;
			if ($response->num_rows > 0) {
						while ($record = $response->fetch_array(MYSQLI_ASSOC)) {
							$images = $db->all_fetch_images($detail_id);
						//	print_r($images);die;
							if($images!="null"){
							if(count($images)>0){
						foreach($images as $image){
							
				$html .='<ul class="bxslider">
	  <li><img src="meal_images/'.$detail_id.'/'.$image['meal_image'].'"alt="Image" style="width: 500px; height: 300px;" /></li>
									</ul';

						}
							}
							}
								$dt = date_create();
							date_timestamp_set($dt, $record['date_created']);
							$date = date_format($dt, 'T Y-M-d H:i:s');
							$epr = date_create();
							date_timestamp_set($epr, $record['date_created']);
							$expire = date_format($epr, 'T Y-M-d H:i:s');
							
									echo'<div class="summary-banner-container">
						<div class="search_detail">
							<div class="detail_inner">
								<div class="detail_txt">
									<h3>'.$record['title'].'</h3>
									<div class="post_detail">
										<div class="post_by">
											<a href="user-meal-detail-list.php?q='.$record['meal_user_id'].'"> '.$record['user_name'].'</a>
										</div>
										<div class="post_category">
											<a href="user-meal-detail-list.php?q='.$record['meal_user_id'].'&cat='.$record['category_id'].'">'.$record['category_name'].'</a>
										</div>
										<div class="post_date">
											<span>'.$date.'</span>
										</div>
									</div>
									<div id="slider">
									  <a class="control_next">>></a>
									  <a class="control_prev"><</a>
									  <li>'.$html.'<li>
									  <li><img src=""alt="No Image" /></li>
									  </div>
									<div class="slider_option" style="display:none;">
									  <input type="checkbox" id="checkbox" >
									  <label for="checkbox">Autoplay Slider</label>
									</div> 
									</br>
									<div class="post_txt">
									<p>'.$record['description'].'</p>
									</div>
									<div class="author_detail_info">
										<div class="author_title">
											<h4>Author Information</h4>
										</div>
										<div class="author_detail">
											<table>
												<tr>
													<td><strong>Name</strong></td>
													<td>'.$record['user_name'].'</td>
												</tr>
												<tr>
													<td><strong>Phone Number</strong></td>
													<td>'.$record['phone'].'</td>
												</tr>
												<tr>
													<td><strong>Email</strong></td>
													<td><a href="mailto:abc@xyz.com">'.$record['user_email'].'</a></td>
												</tr>
											  <tr>
												<td><strong>Address</strong></td>
												<td>'.$record['address'].'</td>
											  </tr>
											  <tr>
												<td><strong>Meal Expiry Date</strong></td>
												<td>'.$expire.'</td>
											  </tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>';
					
						}
					}?>
				</section>
				<?php include('footer.php');?>
            </main>
            
            <script src="js/jquery-1.9.1.min.js"></script>
            <script src="js/uship.js"></script>
        </div>
			<script>
		jQuery(document).ready(function ($) {

 
    setInterval(function () {
        moveRight();
    }, 5000);
  
  
	var slideCount = $('#slider ul li').length;
	var slideWidth = $('#slider ul li').width();
	var slideHeight = $('#slider ul li').height();
	var sliderUlWidth = slideCount * slideWidth;
	
	$('#slider').css({ width: slideWidth, height: slideHeight });
	
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});
</script>
   
	</body>
</html>
    



