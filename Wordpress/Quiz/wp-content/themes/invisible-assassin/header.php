<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package invisible_assassin
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'invisible_assassin' ); ?></a>
	
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	<header id="masthead" class="site-header" role="banner">
		<div class="layer">
			<div id="top-bar">
				<div class="container top-bar-container">	
					
					<div class="social-icons col-md-6">
						<?php get_template_part('social', 'fa'); ?>	
					</div>
	
					
				</div>	<!--container-->
			</div>
			
			<div class="site-branding col-md-12">
				<?php if ( get_theme_mod('invisible_assassin_logo') != "" ) : ?>
				<div id="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_theme_mod('invisible_assassin_logo'); ?>"></a>
				</div>
				<?php endif; ?>
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description title-font"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>
				
			<nav id="top-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav>
		
			
		</div>	
	</header><!-- #masthead -->
	
	
	<?php get_template_part('slider', 'nivo'); ?>
	
	<div class="mega-container" >
			
		<div id="content" class="site-content container">