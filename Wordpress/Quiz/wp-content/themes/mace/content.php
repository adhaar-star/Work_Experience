<?php
/**
 * @package Mace
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(has_post_thumbnail()): ?>
		<div class="post-thumb">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="post-container">
	<?php endif; ?>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php mace_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php mace_the_cotent(); ?>

	<?php if(has_post_thumbnail()): ?>
		</div>
	<?php endif; ?>
</article><!-- #post-## -->