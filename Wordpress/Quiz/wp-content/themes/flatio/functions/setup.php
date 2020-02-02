<?php

/* ------------------------ initial setup ----------------------- */

function flatio_setup() {

    add_theme_support( 'automatic-feed-links' );

	add_theme_support('post-thumbnails');
	add_image_size('blogpost', 720, 400, false);

    load_theme_textdomain('flatio', get_template_directory() . '/languages');

    register_nav_menus( array(
            'homepage_menu' => __('Homepage Menu', 'flatio'),
            'blog_menu' => __('Blog Menu', 'flatio'),
        )
    );

    add_theme_support( 'title-tag' );

    add_editor_style();

}
add_action('after_setup_theme', 'flatio_setup');

function flatio_widgets_init() {

	register_sidebar(array(
		'name'          => __('Blog Sidebar', 'flatio'),
		'id'            => 'blog_sidebar',
		'before_widget' => '<aside class="col-sm-6 col-md-12 col-lg-12 widget %1$s %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	
}
add_action('widgets_init', 'flatio_widgets_init');

// content width
if ( ! isset( $content_width ) ) {
    $content_width = 870;
}

// rewrite flush
function flatio_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'flatio_rewrite_flush' );

