<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Mace
 */
?><!DOCTYPE html>
<?php global $themename; $themename = 'mace'; ?>
<?php $header_options = get_option($themename.'_settings'); ?>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if($header_options['favicon']){ ?>
	<link rel="icon" href="<?php echo $header_options['favicon']; ?>">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo $header_options['favicon'];?>">
	<![endif]-->
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if($social_options = get_option($themename.'_settings')): ?>
	<div class="social_wrap">
		<div class="social">
			<ul>
				<?php if($social_options['fb_url']): ?><li class="soc_fb"><a href="<?php echo esc_url($social_options['fb_url']);?>" target="_blank" title="Facebook"><i class="fa fa-facebook-square"></i></a></li><?php endif; ?>
				<?php if($social_options['twitter_url']): ?><li class="soc_tw"><a href="<?php echo esc_url($social_options['twitter_url']);?>" target="_blank" title="Twitter"><i class="fa fa-twitter-square"></i></a></li><?php endif; ?>
				<?php if($social_options['google_plus_url']): ?><li class="soc_plus"><a href="<?php echo esc_url($social_options['google_plus_url']);?>" target="_blank" title="Google Plus"><i class="fa fa-google-plus-square"></i></a></li><?php endif; ?>
				<?php if($social_options['feedburner']): ?><li class="soc_rss"><a href="<?php echo esc_url($social_options['feedburner']);?>" target="_blank" title="RSS"><i class="fa fa-rss-square"></i></a></li><?php endif; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="inner-header">
			<div class="site-branding">
				<?php if($header_options['logo']): ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo $header_options['logo']; ?>" alt="<?php bloginfo('name'); ?>" id="logo" /></a>
				<?php else: ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'mace' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
			<nav id="mobile-navigation" class="mobile-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'items_wrap' => '<select onchange="window.location.replace(this.options[this.selectedIndex].value)" id="drop-nav"><option value="">Select a page...</option>%3$s</select>', 'walker'  => new Walker_Nav_Menu_Dropdown(), 'fallback_cb'     => 'mace_no_menu')); ?>
			</nav>
		</div>
	</header><!-- #masthead -->
	<?php if(is_front_page()) get_template_part( 'content', 'slider' ); ?>
	<div id="content" class="site-content">