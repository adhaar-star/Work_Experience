<!DOCTYPE html>
<?php

require 'config/config.php';
//include 'library/MysqliWrapper.php';
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $config['title']; ?></title>
        <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" media="all" />
        <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap-theme.min.css" media="all" />
        <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" media="all" />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
		<script>
jQuery(document).ready(function(){
  jQuery('.dropdown-submenu a.test').on("click", function(e){
    jQuery(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
	
<style>
	
	.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
	</style>
    <body>
        <?php if (is_loggedin()) : ?>
		<?php $url=$_SERVER['REQUEST_URI'];$query = parse_url($url, PHP_URL_QUERY);
parse_str($query, $params);
if(isset($params['p'])){
$p = $params['p'];
}
if(isset($params['l'])){
$l = $params['l'];
	
}
		
		?>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">One-Plate-CA</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li <?php echo get_active_nav('dashboard'); ?>>
                                <?php anchor(['href' => 'dashboard.php', 'text' => '<span class="glyphicon glyphicon-dashboard"></span> Dashboard <span class="label label-info" title="Total active listings">' . $db->get_active_listing_count() . '</span>' . active_nav_sr_only('dashboard'), 'attr' => ['accesskey' => 'D', 'title' => 'It\'s shortcut is - D']]); ?>
                            </li>
                            <li <?php echo get_active_nav('lists', 'dropdown'); ?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Lists <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li <?php echo get_active_sub_nav('active-listing') . '>' . anchor(['href' => 'active-listings.php', 'text' => 'All Active Listings' . active_nav_sr_only('active-listing')], TRUE); ?></li>
									 <li role="separator" class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">By Meal Category<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a tabindex="-1" href="<?php echo BASE_URL; ?>meal-cat-detail.php?id=3">Dinner By</a></li>
          <li><a tabindex="-1" href="<?php echo BASE_URL; ?>meal-cat-detail.php?id=2">Lunch By</a></li>
		<li><a tabindex="-1" href="<?php echo BASE_URL; ?>meal-cat-detail.php?id=1">Breakfast By</a></li>
         <!-- <li class="dropdown-submenu">
            <a class="test" href="#">Another dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">3rd level dropdown</a></li>
              <li><a href="#">3rd level dropdown</a></li>
            </ul>
          </li>-->
        </ul>
      </li>
									
								
									
									<li role="separator" class="divider"></li>
                                    <li><a href="<?php echo BASE_URL; ?>location-list.php">By Location</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo BASE_URL; ?>user-list.php">By User List</a></li>
                                </ul>
                            </li>
                        </ul>
						<?php if(isset($p) && isset($l)){ ?>
                        <form class="navbar-form navbar-left" action="<?php echo $url; ?>">
                            <div class="form-group">
                               
							 <!--	 <input type="hidden" name="p" value="<?php echo $p; ?>" />
 <input type="hidden" name="l" value="<?php echo $l; ?>" />-->
								 <input type="text" name="q" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
						<?php }else{?>
						
						  <form class="navbar-form navbar-left" action="<?php echo $url; ?>">
                            <div class="form-group">
                               <?php if(isset($_GET['id'])){?>
								  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
								<?php }?>
  <!--<input type="hidden" name="l" value="" />-->
								 <input type="text" name="q" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
						
						<?   }?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user_details']['username'] ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">All Shortcuts</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?php anchor(['href' => 'logout.php', 'text' => '<span class="glyphicon glyphicon-log-out"></span> Logout', 'attr' => ['accesskey' => 'L', 'title' => 'It\'s shortcut is - L']]); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        <?php endif; ?>
        <div class="container"><!-- This ends in footer.php -->