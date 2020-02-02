jQuery(document).ready(function(){
	var sliderInputCount = slider_items.count;
	jQuery('#add-more-slides-btn').click(function(){
		jQuery('#slide-inputs').append('<div class="slide-inputs-row">Img: <input type="text" name="mace_settings[slides]['+sliderInputCount+'][img]"> Text: <input type="text" name="mace_settings[slides]['+sliderInputCount+'][text]"></div>');
		sliderInputCount++;
	});
	jQuery('.remove-slide-row-btn').click(function(){
		jQuery(this).parents('.slide-inputs-row').remove();
	});
	postboxes.add_postbox_toggles('mace_options_panel');
	jQuery('.if-js-closed').removeClass('if-js-closed').addClass('closed');
});