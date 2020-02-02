<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		
        <?php wp_head(); ?>

    </head>
    <body <?php body_class('body'); ?>>
        <div class="wrapper">
        <?php if ( is_front_page() or is_page_template('page-homepage.php') ): ?>
        <div class="flatiohome">
            <nav class="navbar navbar-fixed-top navbar-default flationav" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand backtohome" href="#"><?php echo __('Home', 'flatio'); ?></a>
                    </div>

                    <?php wp_nav_menu( array(
                        'menu'              => 'homepage_menu',
                        'theme_location'    => 'homepage_menu',
                        'depth'             => -1,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'bs-example-navbar-collapse-1',
                        'menu_class'        => 'nav navbar-nav pull-right',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new flatio_wp_bootstrap_navwalker()
                    )); ?>

                </div>
            </nav>
        <?php else: ?>
        <div class="flatioblog" style="background-image: url(<?php echo esc_url ( get_theme_mod('flatio_blogbgimage', get_template_directory_uri().'/images/blog.jpg') ); ?>);">
            <nav class="navbar navbar-fixed-top navbar-default blognav" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div>

                    <?php wp_nav_menu( array(
                        'menu'              => 'blog_menu',
                        'theme_location'    => 'blog_menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'bs-example-navbar-collapse-1',
                        'menu_class'        => 'nav navbar-nav pull-right',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new flatio_wp_bootstrap_navwalker()
                    )); ?>

                </div>
            </nav>
        <?php endif; ?>
