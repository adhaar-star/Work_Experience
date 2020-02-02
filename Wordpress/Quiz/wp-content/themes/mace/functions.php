<?php
/**
 * Mace functions and definitions
 *
 * @package Mace
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960; /* pixels */
}

if ( ! function_exists( 'mace_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mace_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Mace, use a find and replace
	 * to change 'mace' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mace', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, null, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mace' ),
		'mobile' 	=> __( 'Mobile Menu', 'mace' )
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mace_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // mace_setup
add_action( 'after_setup_theme', 'mace_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function mace_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mace' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'mace_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mace_scripts() {
	wp_enqueue_style( 'mace-style', get_stylesheet_uri() );
	wp_enqueue_style( 'mace-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Lobster');
	wp_enqueue_style( 'mace-font-awesome', get_template_directory_uri().'/css/font-awesome.css' );
	wp_enqueue_style( 'mace-ie-only', get_template_directory_uri().'/css/ie.css' );
	global $wp_styles;
	$wp_styles->add_data( 'mace-ie-only', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'mace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	global $is_IE;
	if($is_IE)
		wp_enqueue_script( 'mace-ie-js', get_template_directory_uri().'/js/html5.js', array(), '1.0', true);

	if(is_front_page()){
		wp_enqueue_script( 'responsive-slides', get_template_directory_uri() . '/js/responsiveslides.min.js', array('jquery'), '1.0', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mace_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Options Panel
 */
require get_template_directory() . '/inc/options-panel.php';

/**
 * Load custom walker class for mobile navigation menu
 */
require get_template_directory() . '/inc/custom-walker-class.php';