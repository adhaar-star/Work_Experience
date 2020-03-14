<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
	<meta charset="utf-8">
 	<title>
		<?php 
			if (!empty($is_blog)) :
				echo $CI->fuel_blog->page_title($page_title, ' : ', 'right');
			else:
				echo fuel_var('page_title', '');
			endif;
		?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="keywords" content="<?php echo fuel_var('meta_keywords')?>">
	<meta name="description" content="<?php echo fuel_var('meta_description')?>">

	 <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="<?php echo css_path('bootstrap.min.css') ?>" type="text/css" media="screen">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo css_path('font-awesome.min.css') ?>" type="text/css" media="screen">
   <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo css_path('responsive.css') ?>" media="screen">
    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo css_path('animate.css') ?>" media="screen">
    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo css_path('blue.css') ?>" media="screen" />
	
	<script type="text/javascript" src="<?php echo js_path('jquery-2.1.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo js_path('modernizrr.jd') ?>"></script>
    <script type="text/javascript" src="<?php echo js_path('bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo js_path('script.js') ?>"></script>

    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<?php
		echo css('main').css($css);

		if (!empty($is_blog)):
			echo $CI->fuel_blog->header();
		endif;
	?>

</head>
<body>
	    <!-- Full Body Container -->
    <div id="container">
        <!-- Start Header Section --> 
        <div class="hidden-header"></div>
        <header class="clearfix">
            <!-- Start  Logo & Naviagtion  -->
            <div class="navbar navbar-default navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Stat Toggle Nav Link For Mobiles -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- End Toggle Nav Link For Mobiles -->
                        
                    </div>
                    <div class="navbar-collapse collapse">
                        <!-- Stat Search -->
                        <div class="search-side">
                            <a href="javascript:;" class="show-search"><i class="fa fa-search"></i></a>
                            <div class="search-form">
                                <form autocomplete="off" role="search" method="get" class="searchform" action="#">
                                    <input type="text" value="" name="s" id="s" placeholder="Search the site...">
                                </form>
                            </div>
                        </div>
                        <!-- End Search -->
                        <!-- Start Navigation List -->
                       <?php echo $this->fuel->navigation->render(array('render_type' => 'page_title'));?>
<?php echo fuel_nav(array('container_tag_id' => 'topmenu', 'item_id_prefix' => 'topmenu_')); ?>

                        <!-- End Navigation List -->
                    </div>
                </div>
            </div>
            <!-- End Header Logo & Naviagtion -->
			 <div class="container">
            	<div class="logo-cont">
                    <a href="index.html" class="navbar-brand">
                        <img src="<?php echo img_path('ews_logo.png') ?>" alt="" class="img-responsive">
                    </a>
                </div>
                <div class="col-lg-6 pull-right header-services text-right">
                	<h5>24/7 support : 01462675769</h5> 
					<h5>Email :info@essentialwaterservices.co.uk</h5>
                </div>
                <div class="clearfix"></div>
            </div>
        </header> 
        <!-- End Header Section -->
        
	