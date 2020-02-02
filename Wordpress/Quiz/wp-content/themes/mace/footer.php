<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Mace
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info clearfix">
			<?php do_action( 'mace_credits' ); ?>
			<?php $footer_options = get_option('mace_settings'); ?>
			<p class="copyright-text"><?php echo isset($footer_options['footer_text'])?$footer_options['footer_text']:''; ?></p>
			<p class="credits"><?php mace_credit_links($footer_options['hide_credits']); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>