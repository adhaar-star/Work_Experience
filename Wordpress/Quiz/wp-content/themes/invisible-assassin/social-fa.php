<?php
/*
** Template to Render Social Icons on Top Bar
*/

for ($i = 1; $i < 8; $i++) : 
	$social = get_theme_mod('invisible_assassin_social_'.$i);
	if ( ($social != 'none') && ($social != '') ) : ?>
	<a class="hvr-rectangle-out" href="<?php echo get_theme_mod('invisible_assassin_social_url'.$i); ?>"><i class="fa fa-<?php echo $social; ?>"></i></a>
	<?php endif;

endfor; ?>