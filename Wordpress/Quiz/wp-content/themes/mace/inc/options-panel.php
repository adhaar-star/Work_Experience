<?php
/*
The settings page
*/

function mace_theme_menu() {

    global $mace_settings_page_hook;
    $mace_settings_page_hook = add_theme_page(  
        'Mace Settings',            // The title to be displayed in the browser window for this page.  
        'Mace Settings',            // The text to be displayed for this menu item
        'administrator',            // Which type of users can see this menu item  
        'mace_settings_page',    		// The unique ID - that is, the slug - for this menu item  
        'mace_render_settings_page' // The name of the function to call when rendering this menu's page  
    );  
  
}
add_action( 'admin_menu', 'mace_theme_menu' );

function mace_cp_scripts_styles($hook) {
	global $mace_settings_page_hook;
	if( $mace_settings_page_hook != $hook )
		return;
	
	$file_dir = get_template_directory_uri();
	wp_enqueue_style("options_panel_stylesheet", $file_dir."/css/options-panel.css", false, "1.0", "all");
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	wp_enqueue_script("options_panel_script", $file_dir."/js/options-panel.js", false, "1.0");

	$home_options = get_option('mace_settings');
	if($home_options && isset($home_options['slides']))
		$slide_count = count($home_options['slides']);
	else
		$slide_count = 0;
	wp_localize_script("options_panel_script", "slider_items", array('count' => $slide_count));
}
add_action('admin_enqueue_scripts', 'mace_cp_scripts_styles');

function mace_render_settings_page() {
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"></div>
<h2>Mace Settings</h2>
	<?php settings_errors(); ?>
	<form method="post" action="options.php" class="paddingtop20">
		<?php settings_fields( 'mace_settings_page' ); ?>
		<?php do_meta_boxes('mace_options_panel','advanced', null); ?>
		<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
		<?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
	</form>
</div>
<?php }

function mace_initialize_theme_options() { 

    // First, we register a section. This is necessary since all future options must belong to a   
    add_settings_section(  
        'general_settings_section',
        '',
        '',
        'mace_settings_page' 
    );
	
	add_settings_section(  
        'home_settings_section',
        '',
        '', 
        'mace_settings_page' 
    );
	
	add_settings_section(  
        'social_settings_section',
        '',
        '', 
        'mace_settings_page' 
    );
	
	add_settings_section(  
        'footer_settings_section', 
        '',
        '',
        'mace_settings_page'
    );
  
    add_settings_field(
        'custom_favicon', '', 'mace_render_settings_field', 'mace_settings_page', 'general_settings_section',
		array(
			'title' => 'Custom Favicon',
			'desc' => 'A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image',
			'id' => 'favicon',
			'type' => 'text',
			'group' => 'mace_settings'
		)
    );

    add_settings_field(
        'layout', '', 'mace_render_settings_field', 'mace_settings_page', 'general_settings_section',
		array( 
			'title' => 'Layout',
			'desc' => 'Select the layout for the theme',
			'id' => 'layout',
			'type' => 'select',
			'options' => array("content-sidebar" => "Right Sidebar", "sidebar-content" => "Left Sidebar"),
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'logo_url', '', 'mace_render_settings_field', 'mace_settings_page', 'general_settings_section',
		array( 
			'title' => 'Logo URL',
			'desc' => 'Enter the link to your logo image',
			'id' => 'logo',
			'type' => 'text',
			'group' => 'mace_settings'
		)  
    );
	
	add_settings_field(
        'custom_css', '', 'mace_render_settings_field', 'mace_settings_page', 'general_settings_section', 
		array( 
			'title' => 'Custom CSS',
			'desc' => 'Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}',
			'id' => 'custom_css',
			'type' => 'textarea',
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'disable_slider', '', 'mace_render_settings_field', 'mace_settings_page', 'home_settings_section',
		array( 
			'title' => 'Disable slider?',
			'desc' => 'Check if you want to disable the banner present under the header',
			'id' => 'disable_slider',
			'type' => 'checkbox',
			'group' => 'mace_settings'
		)
    );

    add_settings_field(
        'slides', '', 'mace_render_settings_field', 'mace_settings_page', 'home_settings_section',
		array(
			'title' => 'Slides',
			'desc' => 'Here you can insert images and text for the homepage slider. Press the + button to add a new slide',
			'id' => 'slides',
			'type' => 'slide',
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'show_excerpts', '', 'mace_render_settings_field', 'mace_settings_page', 'home_settings_section',
		array(   
			'title' => 'Show Auto Excerpts',
			'desc' => 'Do you want to show excerpts on homepage, even when the read more tag isn\'t present in the content?',
			'id' => 'show_excerpts',
			'type' => 'checkbox',
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'twitter_url', '', 'mace_render_settings_field', 'mace_settings_page', 'social_settings_section',
		array( 
			'title' => 'Twitter URL',
			'desc' => 'Enter the URL of your Twitter page.',
			'id' => 'twitter_url',
			'type' => 'text',
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'fb_url', '', 'mace_render_settings_field', 'mace_settings_page', 'social_settings_section',
		array( 
			'title' => 'Facebook URL',
			'desc' => 'Enter the URL of your Facebook fan page.',
			'id' => 'fb_url',
			'type' => 'text',
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'google_plus_url', '', 'mace_render_settings_field', 'mace_settings_page', 'social_settings_section',
		array( 
			'title' => 'Google Plus URL',
			'desc' => 'Enter the URL of your Google page.',
			'id' => 'google_plus_url',
			'type' => 'text',
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'feedburner', '', 'mace_render_settings_field', 'mace_settings_page', 'social_settings_section',
		array( 
			'title' => 'Feedburner URL',
			'desc' => 'Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website',
			'id' => 'feedburner',
			'type' => 'text',
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'footer_text', '', 'mace_render_settings_field', 'mace_settings_page', 'footer_settings_section',
		array( 
			'title' => 'Footer Copyright Text',
			'desc' => 'Enter text used in the left side of the footer.',
			'id' => 'footer_text',
			'type' => 'text',
			'group' => 'mace_settings'
		)
    );
	
	add_settings_field(
        'hide_credits', '', 'mace_render_settings_field', 'mace_settings_page', 'footer_settings_section',
		array( 
			'title' => 'Hide credit link?',
			'desc' => 'Do you want to hide the credit link in footer?',
			'id' => 'hide_credits',
			'type' => 'select',
			'options' => array('sitewide' => 'Show on all pages', 'nofollow' => 'Show but add no-follow attribute', 'homepage' => 'Show only on homepage', 'hide' => 'Hide completely'),
			'group' => 'mace_settings'
		)
    );
	
    // Finally, we register the fields with WordPress
	register_setting('mace_settings_page', 'mace_settings', 'mace_validator');
	
}
add_action('admin_init', 'mace_initialize_theme_options');

function mace_validator($input){
	//General settings
	$output['favicon'] 		= esc_url($input['favicon']);
	$output['logo'] 		= esc_url($input['logo']);
	$output['custom_css'] 	= wp_kses($input['custom_css'], array());
	$output['layout'] 		= $input['layout'];

	//Homepage Settings
	$output['disable_slider'] 	= $input['disable_slider'];
	$output['show_excerpts'] 	= $input['show_excerpts'];
	if(isset($input['slides']) && is_array($input['slides'])){
		foreach ($input['slides'] as $index => $slide) {
			if($slide['img']) {
				$output['slides'][$index]['img'] = esc_url($slide['img']);
				$output['slides'][$index]['text'] = esc_attr($slide['text']);
			}
		}
	}

	//Social settings
	$output['twitter_url'] 		= esc_url($input['twitter_url']);
	$output['fb_url'] 			= esc_url($input['fb_url']);
	$output['google_plus_url'] 	= esc_url($input['google_plus_url']);
	$output['feedburner'] 		= esc_url($input['feedburner']);

	//Footer settings
	$output['footer_text'] 	= esc_attr($input['footer_text']);
	$output['hide_credits'] = $input['hide_credits'];
	return $output;
}

function mace_add_meta_boxes(){
	add_meta_box("mace_general_settings_metabox", 'General Settings', "mace_metaboxes_callback", "mace_options_panel", 'advanced', 'default', array('settings_section'=>'general_settings_section'));
	add_meta_box("mace_home_settings_metabox", 'Home Settings', "mace_metaboxes_callback", "mace_options_panel", 'advanced', 'default', array('settings_section'=>'home_settings_section'));
	add_meta_box("mace_social_settings_metabox", 'Social Settings', "mace_metaboxes_callback", "mace_options_panel", 'advanced', 'default', array('settings_section'=>'social_settings_section'));
	add_meta_box("mace_footer_settings_metabox", 'Footer Settings', "mace_metaboxes_callback", "mace_options_panel", 'advanced', 'default', array('settings_section'=>'footer_settings_section'));
}
add_action( 'admin_init', 'mace_add_meta_boxes' );

function mace_metaboxes_callback($post, $args){
	do_settings_fields( "mace_settings_page", $args['args']['settings_section'] );
	submit_button('Save Changes', 'secondary');
}

function mace_render_settings_field($args){
	$option_value = get_option($args['group']);
?>
	<div class="row clearfix">
		<div class="col colone"><?php echo $args['title']; ?></div>
		<div class="col coltwo">
<?php
	if($args['type'] == 'text'){
?>
		<input type="text" id="<?php echo $args['id'] ?>" name="<?php echo $args['group'].'['.$args['id'].']'; ?>" value="<?php echo esc_attr($option_value[$args['id']]); ?>">
<?php
	}
	else if ($args['type'] == 'select')
	{ 
?>
		<select name="<?php echo $args['group'].'['.$args['id'].']'; ?>" id="<?php echo $args['id']; ?>">
			<?php foreach ($args['options'] as $key=>$option) { ?>
				<option <?php selected($option_value[$args['id']], $key); echo 'value="'.$key.'"'; ?>><?php echo $option; ?></option><?php } ?>
		</select>
<?php	
	}
	else if($args['type'] == 'checkbox')
	{
?>		
		<input type="hidden" name="<?php echo $args['group'].'['.$args['id'].']'; ?>" value="0" />
		<input type="checkbox" name="<?php echo $args['group'].'['.$args['id'].']'; ?>" id="<?php echo $args['id']; ?>" value="1" <?php checked($option_value[$args['id']]); ?> />
<?php
	}
	else if($args['type'] == 'textarea')
	{
?>
		<textarea name="<?php echo $args['group'].'['.$args['id'].']'; ?>" type="<?php echo $args['type']; ?>" cols="" rows=""><?php if ( $option_value[$args['id']] != "") { echo stripslashes(esc_textarea($option_value[$args['id']]) ); } ?></textarea>
<?php
	}
	else if($args['type'] == 'datetimepicker')
	{
?>
		<label for="<?php echo $args['id'].'_date'; ?>">Date:</label> <input type="text" style="width:130px;" id="<?php echo $args['id'].'_date'; ?>" name="<?php echo $args['group'].'['.$args['id'].']'.'[date]'; ?>" value="<?php echo esc_attr($option_value[$args['id']]['date']); ?>">
		<label for="<?php echo $args['id'].'_hh'; ?>">HH:</label> <input type="text" style="width:25px;" id="<?php echo $args['id'].'_hh'; ?>" name="<?php echo $args['group'].'['.$args['id'].']'.'[hh]'; ?>" value="<?php echo esc_attr($option_value[$args['id']]['hh']); ?>">
		<label for="<?php echo $args['id'].'_mm'; ?>">MM:</label> <input type="text" style="width:25px;" id="<?php echo $args['id'].'_mm'; ?>" name="<?php echo $args['group'].'['.$args['id'].']'.'[mm]'; ?>" value="<?php echo esc_attr($option_value[$args['id']]['mm']); ?>">
		<label for="<?php echo $args['id'].'_ss'; ?>">SS:</label> <input type="text" style="width:25px;" id="<?php echo $args['id'].'_ss'; ?>" name="<?php echo $args['group'].'['.$args['id'].']'.'[ss]'; ?>" value="<?php echo esc_attr($option_value[$args['id']]['ss']); ?>">
<?php
	}
	else if($args['type'] == 'slide')
	{
?>
	<div id="slide-inputs">
	<?php
		$key = 0;
		if(isset($option_value[$args['id']])):
		foreach ($option_value[$args['id']] as $index => $slide):
	?>
		<div class="slide-inputs-row">
			Img: <input type="text" name="<?php echo $args['group'].'['.$args['id'].']'.'['.$key.']' ; ?>[img]" value="<?php echo esc_attr($option_value[$args['id']][$key]['img']); ?>">
			Text: <input type="text" name="<?php echo $args['group'].'['.$args['id'].']'.'['.$key.']' ; ?>[text]" value="<?php echo esc_attr($option_value[$args['id']][$key]['text']); ?>">
			<button class="button remove-slide-row-btn" type="button">x</button>
		</div>
	<?php $key++; endforeach; endif; ?>
	</div>
	<button class="button" type="button" id="add-more-slides-btn">+</button>
<?php 
	}
?>
		</div>
		<div class="col colthree"><small><?php echo $args['desc'] ?></small></div>
	</div>
<?php
}