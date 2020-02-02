<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Mace
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function mace_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mace_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mace_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	$header_options = get_option('mace_settings');

	if(isset($header_options['layout']))
		$classes[] = $header_options['layout'].'-layout';

	return $classes;
}
add_filter( 'body_class', 'mace_body_classes' );

function mace_post_classes( $classes ){
	$classes[] = 'clearfix';
	return $classes;
}
add_filter( 'post_class', 'mace_post_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function mace_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'mace' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'mace_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function mace_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'mace_setup_author' );

function mace_credit_links($type){
	if($type == 'nofollow')
		_e('<a href="https://profiles.wordpress.org/thehosts/" rel="nofollow">WordPress Theme</a> by The Hosts', 'mace');
	elseif( ( $type == 'homepage' && (!is_front_page() || is_paged()) ) || $type == 'hide' )
		return;
	else
		_e('<a href="https://profiles.wordpress.org/thehosts/">WordPress Theme</a> by The Hosts', 'mace');
}

function mace_options_styles(){
	$general_options = get_option('mace_settings');
	if($general_options && isset($general_options['custom_css'])):
?>
		<style type="text/css">
			<?php echo $general_options['custom_css']; ?>
		</style>
<?php 
	endif;
}
add_action('wp_head', 'mace_options_styles');

function mace_no_menu(){}