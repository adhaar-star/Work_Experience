<?php
/**
 * invisible_assassin Theme Customizer
 *
 * @package invisible_assassin
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function invisible_assassin_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'invisible_assassin' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'invisible_assassin_logo' , array(
	    'default'     => '',
	    'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'invisible_assassin_logo',
	        array(
	            'label' => 'Upload Logo',
	            'section' => 'title_tagline',
	            'settings' => 'invisible_assassin_logo',
	            'priority' => 5,
	        )
		)
	);
	
	$wp_customize->add_setting( 'invisible_assassin_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'invisible_assassin_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'invisible_assassin_logo_resize',
	        array(
	            'label' => 'Resize & Adjust Logo',
	            'section' => 'title_tagline',
	            'settings' => 'invisible_assassin_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'invisible_assassin_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function invisible_assassin_logo_enabled($control) {
		$option = $control->manager->get_setting('invisible_assassin_logo');
		return $option->value() == true;
	}
	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override invisible_assassin_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('invisible_assassin_site_titlecolor', array(
	    'default'     => '#000000',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'invisible_assassin_site_titlecolor', array(
			'label' => __('Site Title Color','invisible_assassin'),
			'section' => 'colors',
			'settings' => 'invisible_assassin_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('invisible_assassin_header_desccolor', array(
	    'default'     => '#595959',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'invisible_assassin_header_desccolor', array(
			'label' => __('Site Tagline Color','invisible_assassin'),
			'section' => 'colors',
			'settings' => 'invisible_assassin_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	
	$wp_customize->add_setting( 'invisible_assassin_himg_align' , array(
	    'default'     => true,
	    'sanitize_callback' => 'invisible_assassin_sanitize_himg_align'
	) );
	
	/* Sanitization Function */
	function invisible_assassin_sanitize_himg_align( $input ) {
		if (in_array( $input, array('center','left','right') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
	'invisible_assassin_himg_align', array(
		'label' => __('Header Image Alignment','invisible_assassin'),
		'section' => 'header_image',
		'settings' => 'invisible_assassin_himg_align',
		'type' => 'select',
		'choices' => array(
				'center' => __('Center','invisible_assassin'),
				'left' => __('Left','invisible_assassin'),
				'right' => __('Right','invisible_assassin'),
			)
		
	) );
	
	$wp_customize->add_setting( 'invisible_assassin_himg_darkbg' , array(
	    'default'     => false,
	    'sanitize_callback' => 'invisible_assassin_sanitize_checkbox'
	) );
	
	$wp_customize->add_control(
	'invisible_assassin_himg_darkbg', array(
		'label' => __('Add a Dark Filter to make the text Above the Image More Clear and Easy to Read.','invisible_assassin'),
		'section' => 'header_image',
		'settings' => 'invisible_assassin_himg_darkbg',
		'type' => 'checkbox'
		
	) );
	
 
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'invisible_assassin_hide_title_tagline',
		array( 'sanitize_callback' => 'invisible_assassin_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'invisible_assassin_hide_title_tagline', array(
		    'settings' => 'invisible_assassin_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'invisible_assassin' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	function invisible_assassin_title_visible( $control ) {
		$option = $control->manager->get_setting('invisible_assassin_hide_title_tagline');
	    return $option->value() == false ;
	}
		
	// SLIDER PANEL
	$wp_customize->add_panel( 'invisible_assassin_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Main Slider',
	) );
	
	$wp_customize->add_section(
	    'invisible_assassin_sec_slider_options',
	    array(
	        'title'     => 'Enable/Disable',
	        'priority'  => 0,
	        'panel'     => 'invisible_assassin_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'invisible_assassin_main_slider_enable',
		array( 'sanitize_callback' => 'invisible_assassin_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'invisible_assassin_main_slider_enable', array(
		    'settings' => 'invisible_assassin_main_slider_enable',
		    'label'    => __( 'Enable Slider.', 'invisible_assassin' ),
		    'section'  => 'invisible_assassin_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'invisible_assassin_main_slider_count',
			array(
				'default' => '0',
				'sanitize_callback' => 'invisible_assassin_sanitize_positive_number'
			)
	);
	
	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_control(
			'invisible_assassin_main_slider_count', array(
		    'settings' => 'invisible_assassin_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 10)' ,'invisible_assassin'),
		    'section'  => 'invisible_assassin_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Save the Settings, and Reload this page to Configure the Slides.','invisible_assassin'),
		    
		)
	);
	
		
	
	if ( get_theme_mod('invisible_assassin_main_slider_count') > 0 ) :
		$slides = get_theme_mod('invisible_assassin_main_slider_count');
		
		for ( $i = 1 ; $i <= $slides ; $i++ ) :
			
			//Create the settings Once, and Loop through it.
			
			$wp_customize->add_setting(
				'invisible_assassin_slide_img'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
			    new WP_Customize_Image_Control(
			        $wp_customize,
			        'invisible_assassin_slide_img'.$i,
			        array(
			            'label' => '',
			            'section' => 'invisible_assassin_slide_sec'.$i,
			            'settings' => 'invisible_assassin_slide_img'.$i,			       
			        )
				)
			);
			
			
			$wp_customize->add_section(
			    'invisible_assassin_slide_sec'.$i,
			    array(
			        'title'     => 'Slide '.$i,
			        'priority'  => $i,
			        'panel'     => 'invisible_assassin_slider_panel'
			    )
			);
			
			$wp_customize->add_setting(
				'invisible_assassin_slide_title'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'invisible_assassin_slide_title'.$i, array(
				    'settings' => 'invisible_assassin_slide_title'.$i,
				    'label'    => __( 'Slide Title','invisible_assassin' ),
				    'section'  => 'invisible_assassin_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'invisible_assassin_slide_desc'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'invisible_assassin_slide_desc'.$i, array(
				    'settings' => 'invisible_assassin_slide_desc'.$i,
				    'label'    => __( 'Slide Description','invisible_assassin' ),
				    'section'  => 'invisible_assassin_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			
			$wp_customize->add_setting(
				'invisible_assassin_slide_url'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
					'invisible_assassin_slide_url'.$i, array(
				    'settings' => 'invisible_assassin_slide_url'.$i,
				    'label'    => __( 'Target URL','invisible_assassin' ),
				    'section'  => 'invisible_assassin_slide_sec'.$i,
				    'type'     => 'url',
				)
			);
			
		endfor;
	
	
	endif;
		
	// Layout and Design
	$wp_customize->add_panel( 'invisible_assassin_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','invisible_assassin'),
	) );
	
	$wp_customize->add_section(
	    'invisible_assassin_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','invisible_assassin'),
	        'priority'  => 0,
	        'panel'     => 'invisible_assassin_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'invisible_assassin_disable_sidebar',
		array( 'sanitize_callback' => 'invisible_assassin_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'invisible_assassin_disable_sidebar', array(
		    'settings' => 'invisible_assassin_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','invisible_assassin' ),
		    'section'  => 'invisible_assassin_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'invisible_assassin_disable_sidebar_home',
		array( 'sanitize_callback' => 'invisible_assassin_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'invisible_assassin_disable_sidebar_home', array(
		    'settings' => 'invisible_assassin_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','invisible_assassin' ),
		    'section'  => 'invisible_assassin_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'invisible_assassin_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'invisible_assassin_disable_sidebar_front',
		array( 'sanitize_callback' => 'invisible_assassin_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'invisible_assassin_disable_sidebar_front', array(
		    'settings' => 'invisible_assassin_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','invisible_assassin' ),
		    'section'  => 'invisible_assassin_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'invisible_assassin_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'invisible_assassin_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'invisible_assassin_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'invisible_assassin_sidebar_width', array(
		    'settings' => 'invisible_assassin_sidebar_width',
		    'label'    => __( 'Sidebar Width','invisible_assassin' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','invisible_assassin'),
		    'section'  => 'invisible_assassin_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'invisible_assassin_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function invisible_assassin_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('invisible_assassin_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	class Invisible_Assassin_Custom_CSS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'invisible_assassin_custom_codes',
    array(
    	'title'			=> __('Custom CSS','invisible_assassin'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','invisible_assassin'),
    	'priority'		=> 11,
    	'panel'			=> 'invisible_assassin_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'invisible_assassin_custom_css',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'invisible_assassin_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
	    new Invisible_Assassin_Custom_CSS_Control(
	        $wp_customize,
	        'invisible_assassin_custom_css',
	        array(
	            'section' => 'invisible_assassin_custom_codes',
	            'settings' => 'invisible_assassin_custom_css'
	        )
	    )
	);
	
	function invisible_assassin_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'invisible_assassin_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','invisible_assassin'),
    	'description'	=> __('Enter your Own Copyright Text.','invisible_assassin'),
    	'priority'		=> 11,
    	'panel'			=> 'invisible_assassin_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'invisible_assassin_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'invisible_assassin_footer_text',
	        array(
	            'section' => 'invisible_assassin_custom_footer',
	            'settings' => 'invisible_assassin_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_section(
	    'invisible_assassin_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','invisible_assassin'),
	        'priority'  => 41,
	        'description' => __('Defaults: Source Sans Pro.','invisible_assassin')
	    )
	);
	
	$font_array = array('Source Sans Pro','PT Sans','Roboto Slab','Bitter','Raleway','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','Ubuntu','Lobster','Arimo','Bitter','Noto Sans');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'invisible_assassin_title_font',
		array(
			'default'=> 'Source Sans Pro',
			'sanitize_callback' => 'invisible_assassin_sanitize_gfont' 
			)
	);
	
	function invisible_assassin_sanitize_gfont( $input ) {
		if ( in_array($input, array('Source Sans Pro','Roboto Slab','Bitter','Raleway','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'invisible_assassin_title_font',array(
				'label' => __('Title','invisible_assassin'),
				'settings' => 'invisible_assassin_title_font',
				'section'  => 'invisible_assassin_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'invisible_assassin_body_font',
			array(	'default'=> 'Source Sans Pro',
					'sanitize_callback' => 'invisible_assassin_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'invisible_assassin_body_font',array(
				'label' => __('Body','invisible_assassin'),
				'settings' => 'invisible_assassin_body_font',
				'section'  => 'invisible_assassin_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('invisible_assassin_social_section', array(
			'title' => __('Social Icons','invisible_assassin'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','protpress'),
					'facebook' => __('Facebook','invisible_assassin'),
					'twitter' => __('Twitter','invisible_assassin'),
					'google-plus' => __('Google Plus','invisible_assassin'),
					'instagram' => __('Instagram','invisible_assassin'),
					'rss' => __('RSS Feeds','invisible_assassin'),
					'vimeo-square' => __('Vimeo','invisible_assassin'),
					'youtube' => __('Youtube','invisible_assassin'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'invisible_assassin_social_'.$x, array(
				'sanitize_callback' => 'invisible_assassin_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'invisible_assassin_social_'.$x, array(
					'settings' => 'invisible_assassin_social_'.$x,
					'label' => __('Icon ','invisible_assassin').$x,
					'section' => 'invisible_assassin_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'invisible_assassin_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'invisible_assassin_social_url'.$x, array(
					'settings' => 'invisible_assassin_social_url'.$x,
					'description' => __('Icon ','invisible_assassin').$x.__(' Url','invisible_assassin'),
					'section' => 'invisible_assassin_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function invisible_assassin_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vimeo-square',
					'youtube',
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function invisible_assassin_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function invisible_assassin_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function invisible_assassin_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}		
}

add_action( 'customize_register', 'invisible_assassin_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function invisible_assassin_customize_preview_js() {
	wp_enqueue_script( 'invisible_assassin_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'invisible_assassin_customize_preview_js' );
