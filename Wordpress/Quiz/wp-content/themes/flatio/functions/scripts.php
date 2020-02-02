<?php
/* ------------------------------- enqueue scripts ---------------------------- */

function flatio_scripts() {

    wp_enqueue_style('flatio-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, null);
    wp_enqueue_style('flatio-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, null);
  
	if ( is_front_page() or is_page_template('page-homepage.php') ) {
		wp_enqueue_style('flatio-transition', get_template_directory_uri() . '/css/transition.min.css', false, null);
	}

	wp_enqueue_style('flatio-style', get_template_directory_uri() . '/style.css', false, null);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
	
    wp_enqueue_script('flatio-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true);
    wp_enqueue_script('flatio-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), null, true);

}
add_action('wp_enqueue_scripts', 'flatio_scripts', 100);

function flatio_admin_scripts() {

    wp_enqueue_style( 'flatio-admin', get_template_directory_uri() . '/css/admin.css', false, null );

}
add_action( 'admin_enqueue_scripts', 'flatio_admin_scripts' );


function flatio_custom_style() {
	
	$output = '';
	$output .= '<style>';
	$output .= '.navbar-default .navbar-nav li a, .navbar-default .navbar-brand { color: ' . get_theme_mod('flatio_menu_color', '#FFFFFF') . ' }';
	$output .= '.navbar { background: ' . flatio_hex2rgba ( get_theme_mod('flatio_menu_bg_color', '#FFFFFF'), 0.4 ) . ' }';
	$output .= '</style>';
	echo $output;
	
}
add_action( 'wp_head', 'flatio_custom_style' );