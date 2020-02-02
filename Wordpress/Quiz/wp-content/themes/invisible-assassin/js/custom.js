jQuery(window).load(function() {
    jQuery('#nivoSlider').nivoSlider({
        prevText: "<i class='fa fa-chevron-circle-left'></i>",
        nextText: "<i class='fa fa-chevron-circle-right'></i>",
        pauseTime: 5000,
        beforeChange: function() {
	        jQuery('.slider-wrapper .nivo-caption').animate({
													opacity: 0, bottom: 0,
													},500,'linear');
	        
        },
        afterChange: function() {
	        jQuery('.slider-wrapper .nivo-caption').animate({
													opacity: 1, bottom: 0,
													},500,'linear');
        },
        animSpeed: 700,
        
    });
});  