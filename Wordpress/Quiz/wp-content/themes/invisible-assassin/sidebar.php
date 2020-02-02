<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package invisible_assassin
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( invisible_assassin_load_sidebar() ) : ?>
<div id="secondary" class="widget-area <?php do_action('invisible_assassin_secondary-width') ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
