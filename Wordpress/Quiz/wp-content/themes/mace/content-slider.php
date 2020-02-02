<?php
	$home_options = get_option('mace_settings');
	$disable_slider = isset($home_options['disable_slider'])?$home_options['disable_slider']:true;
?>
<?php if($home_options && !$disable_slider && isset($home_options['slides'])): ?>
<script>
	  jQuery(function() {
	    	jQuery(".rslides").responsiveSlides();
	  });
</script>
<ul class="rslides">
	<?php if(is_array($home_options['slides'])): foreach($home_options['slides'] as $slide): ?>
  	<li>
  		<img src="<?php echo $slide['img']; ?>" alt="">
  		<?php if($slide['text']): ?><p class="caption"><?php echo $slide['text']; ?></p><?php endif; ?>
  	</li>
  	<?php endforeach; endif; ?>
</ul>
<?php endif; ?>