<?php

/***** Theme Info Page *****/



if (!function_exists('flatio_add_theme_info_page')) {
    function flatio_add_theme_info_page() {
        add_theme_page(__('Welcome to flatio', 'flatio'), __('Theme support', 'flatio'), 'edit_theme_options', 'theme77support', 'flatio_display_theme_info_page');
    }
}
add_action('admin_menu', 'flatio_add_theme_info_page');

if (!function_exists('flatio_display_theme_info_page')) {
    function flatio_display_theme_info_page() {
		$flatio_pro_link = "http://theme77.com/flatio-demo/";
        $theme_data = wp_get_theme(); ?>
        <div class="theme-info-wrap">
            <h1><?php printf(__('Welcome to %1s %2s', 'flatio'), esc_attr ( $theme_data->Name ), esc_attr ( $theme_data->Version ) ); ?></h1>
            <div class="theme-description"><?php echo esc_attr ( $theme_data->Description ); ?></div>
            <hr>
			<div class="theme-links clearfix">
				<p>
					<a href="<?php echo get_template_directory_uri(); ?>/documentation/index.html" target="_blank" class="button button-primary"><?php _e('Documentation', 'flatio'); ?></a>
					<a href="<?php echo admin_url('customize.php?return=themes.php?page=theme77support'); ?>" class="button button-primary"><?php _e('Theme Customizer', 'flatio'); ?></a>
					<a href="https://wordpress.org/support/view/theme-reviews/flatio?filter=5" target="_blank" class="button button-primary"><?php _e('Rate this theme', 'flatio'); ?></a>
				</p>
			</div>
			<hr>
            <div id="getting-started">
                <div class="row clearfix">
                    <div class="col col-1">
                        <div class="section">
						<h3><?php echo _e('Upgrade to Flatio Pro', 'flatio'); ?></h3>
                            <p class="about"><?php _e('Need more features and options? Check out the Premium Version of this theme which comes with additional features and advanced Customize Options for your website.', 'flatio'); ?></p>
                            <p>
                                <a href="<?php echo $flatio_pro_link ?>" target="_blank" class="button button-primary"><?php _e('Flatio Pro Demo', 'flatio'); ?></a>
                            </p>
							<a href="<?php echo $flatio_pro_link ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/flatio-pro.jpg"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <?php
    }
}

?>
