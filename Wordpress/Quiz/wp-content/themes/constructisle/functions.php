<?php
// add any new or customised functions here
add_action( 'wp_enqueue_scripts', 'constructisle_enqueue_styles' );
function constructisle_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	// Loads our main stylesheet.
	wp_enqueue_style( 'constructisle-child-style', get_stylesheet_uri() );
}

/**
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function constructisle_theme_setup() {
    load_child_theme_textdomain( 'constructisle', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'constructisle_theme_setup' );