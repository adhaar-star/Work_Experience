<?php
/**
 * Flatio Theme Customizer
 *
 * @package flatio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flatio_customize_register( $wp_customize ) {
	
	
	$flatio_transitions = array(
				'pt-page-moveToRight$pt-page-moveFromLeft' 							=> __('Move To Right - Move From Left', 'flatio'),
				'pt-page-moveToBottom$pt-page-moveFromTop' 							=> __('Move To Bottom - Move From Top', 'flatio'),
				'pt-page-rotateFoldRight$pt-page-moveFromLeftFade' 					=> __('Rotate Fold Right - Move From Left', 'flatio'),
				'pt-page-rotateCubeLeftOut pt-page-ontop$pt-page-rotateCubeLeftIn'	=> __('Rotate Cube Left Out - Rotate Cube Left In', 'flatio'),
    );
	
	
    //  =============================================================
    //  = 					 Homepage Options						=
    //  =============================================================
	
	$wp_customize->add_panel( 'flatio_homepage_apps_options', array(
	    'priority' 			=> 1,
	    'capability' 		=> 'edit_theme_options',
	    'theme_supports' 	=> '',
	    'title' 			=> __( 'Homepage Apps Options', 'flatio' ),
	    'description' 		=> __( 'To Have All flatio Theme Features Upgrade to flatio Pro: <a href="http://theme77.com/flatio-demo/" target="_blank" class="get-pro">Flatio Pro Demo</a>', 'flatio' ),
	) );

	
	// ---------------------- App Options 1 -------------------
	
	
    $wp_customize->add_section('flatio_options_1', array(
        'title'    			=> __('App Options 1', 'flatio'),
        'priority' 			=> 120,
		'panel'				=> 'flatio_homepage_apps_options'
    ));

    $wp_customize->add_setting('flatio_enable_1', array(
		'default'			=> 1,
		'sanitize_callback' => 'sanitize_text_field',
        'capability' 		=> 'edit_theme_options',
        'type'       		=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_enable_1', array(
		'label'    			=> __('Enable This App', 'flatio'),
        'settings' 			=> 'flatio_enable_1',
        'section'  			=> 'flatio_options_1',
        'type'     			=> 'checkbox',
    ));

    $wp_customize->add_setting('flatio_name_1', array(
        'default'        	=> __('Portfolio', 'flatio'),
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type' 			 	=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_name_1', array(
        'label'      		=> __('App Name', 'flatio'),
        'section'    		=> 'flatio_options_1',
        'settings'   		=> 'flatio_name_1',
    ));

    $wp_customize->add_setting('flatio_icon_1', array(
        'default'           => get_template_directory_uri().'/images/app/app-portfolio.png',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_icon_1', array(
        'label'    			=> __('App Icon', 'flatio'),
        'section'  			=> 'flatio_options_1',
        'settings' 			=> 'flatio_icon_1',
    )));

    $wp_customize->add_setting('flatio_color_1', array(
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_color_1', array(
        'label'    			=> __('App Color', 'flatio'),
        'section'  			=> 'flatio_options_1',
        'settings' 			=> 'flatio_color_1',
    )));
	
    $wp_customize->add_setting('flatio_css_1', array(
		'sanitize_callback' => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		'default'        	=> 'background: linear-gradient(215deg, rgba(255,0,255,1) , rgba(0,255,255,1));',
        'capability'     	=> 'edit_theme_options',
        'type' 				=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_css_1', array(
        'label'     		=> __('App Custom CSS Style', 'flatio'),
        'section'    		=> 'flatio_options_1',
        'settings'   		=> 'flatio_css_1',
		'type'				=> 'textarea',
    ));

    $wp_customize->add_setting('flatio_page_1', array(
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'theme_mod',
    ));

    $wp_customize->add_control('flatio_page_1', array(
        'label'      		=> __('Select Page', 'flatio'),
        'section'    		=> 'flatio_options_1',
        'type'    			=> 'dropdown-pages',
        'settings'  		=> 'flatio_page_1',
    ));

     $wp_customize->add_setting('flatio_transition_1', array(
        'default'        	=> 'pt-page-rotateCubeLeftOut pt-page-ontop$pt-page-rotateCubeLeftIn',
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));
    $wp_customize->add_control( 'flatio_transition_1', array(
        'settings' 			=> 'flatio_transition_1',
        'label'   			=> __('Select Page Transition', 'flatio'),
		'description' 		=> __('Get 40+ Page Transitions: <a href="http://theme77.com/flatio-demo/" target="_blank" class="get-pro">Flatio Pro</a>', 'flatio'),
        'section'	 		=> 'flatio_options_1',
        'type'    			=> 'select',
        'choices'    		=> $flatio_transitions,
    ));

    $wp_customize->add_setting('flatio_pagebgimage_1', array(
        'default'           => get_template_directory_uri().'/images/background.jpg',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_pagebgimage_1', array(
        'label'    			=> __('Page Background Image', 'flatio'),
        'section'  			=> 'flatio_options_1',
        'settings' 			=> 'flatio_pagebgimage_1',
    )));

    $wp_customize->add_setting('flatio_pagebgcolor_1', array(
        'default'           => '#0FA2CB',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_pagebgcolor_1', array(
        'label'    			=> __('Page Background Color', 'flatio'),
        'section'  			=> 'flatio_options_1',
        'settings' 			=> 'flatio_pagebgcolor_1',
    )));

	// ---------------------- App Options 2 -------------------
	
	
    $wp_customize->add_section('flatio_options_2', array(
        'title'    			=> __('App Options 2', 'flatio'),
        'priority' 			=> 121,
		'panel'				=> 'flatio_homepage_apps_options'
    ));

    $wp_customize->add_setting('flatio_enable_2', array(
		'default'			=> 1,
		'sanitize_callback' => 'sanitize_text_field',
        'capability' 		=> 'edit_theme_options',
        'type'       		=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_enable_2', array(
		'label'    			=> __('Enable This App', 'flatio'),
        'settings' 			=> 'flatio_enable_2',
        'section'  			=> 'flatio_options_2',
        'type'     			=> 'checkbox',
    ));

    $wp_customize->add_setting('flatio_name_2', array(
        'default'        	=> __('About', 'flatio'),
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type' 			 	=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_name_2', array(
        'label'      		=> __('App Name', 'flatio'),
        'section'    		=> 'flatio_options_2',
        'settings'   		=> 'flatio_name_2',
    ));

    $wp_customize->add_setting('flatio_icon_2', array(
        'default'           => get_template_directory_uri().'/images/app/app-about.png',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_icon_2', array(
        'label'    			=> __('App Icon', 'flatio'),
        'section'  			=> 'flatio_options_2',
        'settings' 			=> 'flatio_icon_2',
    )));

    $wp_customize->add_setting('flatio_color_2', array(
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_color_2', array(
        'label'    			=> __('App Color', 'flatio'),
        'section'  			=> 'flatio_options_2',
        'settings' 			=> 'flatio_color_2',
    )));
	
    $wp_customize->add_setting('flatio_css_2', array(
		'sanitize_callback' => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		'default'        	=> 'background: linear-gradient(45deg, rgba(0,59,59,1) , rgba(5,193,255,1) , rgba(0,59,59,1) );',
        'capability'     	=> 'edit_theme_options',
        'type' 				=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_css_2', array(
        'label'     		=> __('App Custom CSS Style', 'flatio'),
        'section'    		=> 'flatio_options_2',
        'settings'   		=> 'flatio_css_2',
		'type'				=> 'textarea',
    ));

    $wp_customize->add_setting('flatio_page_2', array(
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'theme_mod',
    ));

    $wp_customize->add_control('flatio_page_2', array(
        'label'      		=> __('Select Page', 'flatio'),
        'section'    		=> 'flatio_options_2',
        'type'    			=> 'dropdown-pages',
        'settings'  		=> 'flatio_page_2',
    ));

     $wp_customize->add_setting('flatio_transition_2', array(
        'default'        	=> 'pt-page-rotateFoldRight$pt-page-moveFromLeftFade',
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));
    $wp_customize->add_control( 'flatio_transition_2', array(
        'settings' 			=> 'flatio_transition_2',
        'label'   			=> __('Select Page Transition', 'flatio'),
		'description' 		=> __('Get 40+ Page Transitions: <a href="http://theme77.com/flatio-demo/" target="_blank" class="get-pro">Flatio Pro</a>', 'flatio'),
        'section'	 		=> 'flatio_options_2',
        'type'    			=> 'select',
        'choices'    		=> $flatio_transitions,
    ));

    $wp_customize->add_setting('flatio_pagebgimage_2', array(
        'default'           => get_template_directory_uri().'/images/background.jpg',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_pagebgimage_2', array(
        'label'    			=> __('Page Background Image', 'flatio'),
        'section'  			=> 'flatio_options_2',
        'settings' 			=> 'flatio_pagebgimage_2',
    )));

    $wp_customize->add_setting('flatio_pagebgcolor_2', array(
        'default'           => '#0FA2CB',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_pagebgcolor_2', array(
        'label'    			=> __('Page Background Color', 'flatio'),
        'section'  			=> 'flatio_options_2',
        'settings' 			=> 'flatio_pagebgcolor_2',
    )));
	
	
	// ---------------------- App Options 3 -------------------
	
	
    $wp_customize->add_section('flatio_options_3', array(
        'title'    			=> __('App Options 3', 'flatio'),
        'priority' 			=> 122,
		'panel'				=> 'flatio_homepage_apps_options'
    ));

    $wp_customize->add_setting('flatio_enable_3', array(
		'default'			=> 1,
		'sanitize_callback' => 'sanitize_text_field',
        'capability' 		=> 'edit_theme_options',
        'type'       		=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_enable_3', array(
		'label'    			=> __('Enable This App', 'flatio'),
        'settings' 			=> 'flatio_enable_3',
        'section'  			=> 'flatio_options_3',
        'type'     			=> 'checkbox',
    ));

    $wp_customize->add_setting('flatio_name_3', array(
        'default'        	=> __('Team', 'flatio'),
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type' 			 	=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_name_3', array(
        'label'      		=> __('App Name', 'flatio'),
        'section'    		=> 'flatio_options_3',
        'settings'   		=> 'flatio_name_3',
    ));

    $wp_customize->add_setting('flatio_icon_3', array(
        'default'           => get_template_directory_uri().'/images/app/app-team.png',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_icon_3', array(
        'label'    			=> __('App Icon', 'flatio'),
        'section'  			=> 'flatio_options_3',
        'settings' 			=> 'flatio_icon_3',
    )));

    $wp_customize->add_setting('flatio_color_3', array(
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_color_3', array(
        'label'    			=> __('App Color', 'flatio'),
        'section'  			=> 'flatio_options_3',
        'settings' 			=> 'flatio_color_3',
    )));
	
    $wp_customize->add_setting('flatio_css_3', array(
		'sanitize_callback' => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		'default'        	=> 'background: linear-gradient(45deg, rgba(0,255,0,1), rgba(0,255,255,1));',
        'capability'     	=> 'edit_theme_options',
        'type' 				=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_css_3', array(
        'label'     		=> __('App Custom CSS Style', 'flatio'),
        'section'    		=> 'flatio_options_3',
        'settings'   		=> 'flatio_css_3',
		'type'				=> 'textarea',
    ));

    $wp_customize->add_setting('flatio_page_3', array(
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'theme_mod',
    ));

    $wp_customize->add_control('flatio_page_3', array(
        'label'      		=> __('Select Page', 'flatio'),
        'section'    		=> 'flatio_options_3',
        'type'    			=> 'dropdown-pages',
        'settings'  		=> 'flatio_page_3',
    ));

     $wp_customize->add_setting('flatio_transition_3', array(
        'default'        	=> 'pt-page-moveToBottom$pt-page-moveFromTop',
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));
    $wp_customize->add_control( 'flatio_transition_3', array(
        'settings' 			=> 'flatio_transition_3',
        'label'   			=> __('Select Page Transition', 'flatio'),
		'description' 		=> __('Get 40+ Page Transitions: <a href="http://theme77.com/flatio-demo/" target="_blank" class="get-pro">Flatio Pro</a>', 'flatio'),
        'section'	 		=> 'flatio_options_3',
        'type'    			=> 'select',
        'choices'    		=> $flatio_transitions,
    ));

    $wp_customize->add_setting('flatio_pagebgimage_3', array(
        'default'           => get_template_directory_uri().'/images/background.jpg',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_pagebgimage_3', array(
        'label'    			=> __('Page Background Image', 'flatio'),
        'section'  			=> 'flatio_options_3',
        'settings' 			=> 'flatio_pagebgimage_3',
    )));

    $wp_customize->add_setting('flatio_pagebgcolor_3', array(
        'default'           => '#0FA2CB',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_pagebgcolor_3', array(
        'label'    			=> __('Page Background Color', 'flatio'),
        'section'  			=> 'flatio_options_3',
        'settings' 			=> 'flatio_pagebgcolor_3',
    )));
	

	// ---------------------- App Options 4 -------------------
	
	
    $wp_customize->add_section('flatio_options_4', array(
        'title'    			=> __('App Options 4', 'flatio'),
        'priority' 			=> 123,
		'panel'				=> 'flatio_homepage_apps_options'
    ));

    $wp_customize->add_setting('flatio_enable_4', array(
		'default'			=> 1,
		'sanitize_callback' => 'sanitize_text_field',
        'capability' 		=> 'edit_theme_options',
        'type'       		=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_enable_4', array(
		'label'    			=> __('Enable This App', 'flatio'),
        'settings' 			=> 'flatio_enable_4',
        'section'  			=> 'flatio_options_4',
        'type'     			=> 'checkbox',
    ));

    $wp_customize->add_setting('flatio_name_4', array(
        'default'        	=> __('Blog', 'flatio'),
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type' 			 	=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_name_4', array(
        'label'      		=> __('App Name', 'flatio'),
        'section'    		=> 'flatio_options_4',
        'settings'   		=> 'flatio_name_4',
    ));

    $wp_customize->add_setting('flatio_icon_4', array(
        'default'           => get_template_directory_uri().'/images/app/app-blog.png',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_icon_4', array(
        'label'    			=> __('App Icon', 'flatio'),
        'section'  			=> 'flatio_options_4',
        'settings' 			=> 'flatio_icon_4',
    )));

    $wp_customize->add_setting('flatio_color_4', array(
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_color_4', array(
        'label'    			=> __('App Color', 'flatio'),
        'section'  			=> 'flatio_options_4',
        'settings' 			=> 'flatio_color_4',
    )));
	
    $wp_customize->add_setting('flatio_css_4', array(
		'sanitize_callback' => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		'default'        	=> 'background: linear-gradient(215deg, rgba(255,102,102,1) , rgba(0,255,255,1) );',
        'capability'     	=> 'edit_theme_options',
        'type' 				=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_css_4', array(
        'label'     		=> __('App Custom CSS Style', 'flatio'),
        'section'    		=> 'flatio_options_4',
        'settings'   		=> 'flatio_css_4',
		'type'				=> 'textarea',
    ));

    $wp_customize->add_setting('flatio_page_4', array(
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'theme_mod',
    ));

    $wp_customize->add_control('flatio_page_4', array(
        'label'      		=> __('Select Page', 'flatio'),
        'section'    		=> 'flatio_options_4',
        'type'    			=> 'dropdown-pages',
        'settings'  		=> 'flatio_page_4',
    ));

     $wp_customize->add_setting('flatio_transition_4', array(
        'default'        	=> 'pt-page-moveToRight$pt-page-moveFromLeft',
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));
    $wp_customize->add_control( 'flatio_transition_4', array(
        'settings' 			=> 'flatio_transition_4',
        'label'   			=> __('Select Page Transition', 'flatio'),
		'description' 		=> __('Get 40+ Page Transitions: <a href="http://theme77.com/flatio-demo/" target="_blank" class="get-pro">Flatio Pro</a>', 'flatio'),
        'section'	 		=> 'flatio_options_4',
        'type'    			=> 'select',
        'choices'    		=> $flatio_transitions,
    ));

    $wp_customize->add_setting('flatio_pagebgimage_4', array(
        'default'           => get_template_directory_uri().'/images/background.jpg',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_pagebgimage_4', array(
        'label'    			=> __('Page Background Image', 'flatio'),
        'section'  			=> 'flatio_options_4',
        'settings' 			=> 'flatio_pagebgimage_4',
    )));

    $wp_customize->add_setting('flatio_pagebgcolor_4', array(
        'default'           => '#0FA2CB',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_pagebgcolor_4', array(
        'label'    			=> __('Page Background Color', 'flatio'),
        'section'  			=> 'flatio_options_4',
        'settings' 			=> 'flatio_pagebgcolor_4',
    )));
	
	
	// ---------------------- More Apps -------------------
	
	
    $wp_customize->add_section('flatio_more', array(
        'title'    			=> __('More Apps', 'flatio'),
        'priority' 			=> 124,
		'panel'				=> 'flatio_homepage_apps_options'
    ));

    $wp_customize->add_setting('flatio_pro', array(
        'default'           => get_template_directory_uri().'/images/flatio-pro.jpg',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_pro', array(
        'label'    			=> __('Need More Apps', 'flatio'),
		'description'		=> __('Upgrade to flatio Pro: <a href="http://theme77.com/flatio-demo/" target="_blank" class="get-pro">Flatio Pro Demo</a>','flatio'),
        'section'  			=> 'flatio_more',
        'settings' 			=> 'flatio_pro',
    )));
	
	
    //  =============================================================
    //  = 					 	General Options						=
    //  =============================================================
	
    $wp_customize->add_section('flatio_general_options', array(
        'title'    			=> __('General Options', 'flatio'),
        'priority' 			=> 2,
    ));
	
    $wp_customize->add_setting('flatio_app_title_color', array(
        'default'           => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_app_title_color', array(
        'label'    			=> __('Apps Title Color', 'flatio'),
        'section'  			=> 'flatio_general_options',
        'settings' 			=> 'flatio_app_title_color',
    )));
	
    $wp_customize->add_setting('flatio_menu_color', array(
        'default'           => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_menu_color', array(
        'label'    			=> __('Menu Font Color', 'flatio'),
        'section'  			=> 'flatio_general_options',
        'settings' 			=> 'flatio_menu_color',
    )));
	
    $wp_customize->add_setting('flatio_menu_bg_color', array(
        'default'           => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_menu_bg_color', array(
        'label'    			=> __('Menu Background Color', 'flatio'),
        'section'  			=> 'flatio_general_options',
        'settings' 			=> 'flatio_menu_bg_color',
    )));
	
    $wp_customize->add_setting('flatio_logo', array(
        'default'           => get_template_directory_uri().'/images/logo.png',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_logo', array(
        'label'    			=> __('Logo', 'flatio'),
        'section'  			=> 'flatio_general_options',
        'settings' 			=> 'flatio_logo',
    )));
	

    $wp_customize->add_setting('flatio_homebgimage', array(
        'default'           => get_template_directory_uri().'/images/homepage.jpg',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_homebgimage', array(
        'label'    			=> __('Homepage Background Image', 'flatio'),
        'section'  			=> 'flatio_general_options',
        'settings' 			=> 'flatio_homebgimage',
    )));
	

    $wp_customize->add_setting('flatio_homebgcolor', array(
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'flatio_homebgcolor', array(
        'label'    			=> __('Homepage Background Color', 'flatio'),
        'section'  			=> 'flatio_general_options',
        'settings' 			=> 'flatio_homebgcolor',
    )));
	
	
    //  =============================================================
    //  = 					 	Blog Options						=
    //  =============================================================
	
    $wp_customize->add_section('flatio_blog_options', array(
        'title'    			=> __('Blog Options', 'flatio'),
        'priority' 			=> 3,
    ));
	
    $wp_customize->add_setting('flatio_blog_sidebar', array(
        'default'        	=> 'rightsidebar',
		'sanitize_callback' => 'sanitize_text_field',
        'capability'     	=> 'edit_theme_options',
        'type' 			 	=> 'theme_mod', 
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control('flatio_blog_sidebar', array(
        'label'      		=> __('Blog sidebar', 'flatio'),
        'section'    		=> 'flatio_blog_options',
        'settings'   		=> 'flatio_blog_sidebar',
		'type'				=> 'radio',
        'choices'    		=> array(
								'rightsidebar' => __('Right Sidebar', 'flatio'),
								'leftsidebar' => __('Left Sidebar', 'flatio'),
        ),
    ));
	
    $wp_customize->add_setting('flatio_blogbgimage', array(
        'default'           => get_template_directory_uri().'/images/blog.jpg',
		'sanitize_callback' => 'esc_url_raw',
        'capability'        => 'edit_theme_options',
        'type' 			 	=> 'theme_mod',
		'transport'	 		=> 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'flatio_blogbgimage', array(
        'label'    			=> __('Blog Background Image', 'flatio'),
        'section'  			=> 'flatio_blog_options',
        'settings' 			=> 'flatio_blogbgimage',
    )));
	
	
}
add_action( 'customize_register', 'flatio_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flatio_customize_preview_js() {
	wp_enqueue_script( 'flatio_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), NULL, true );
}
add_action( 'customize_preview_init', 'flatio_customize_preview_js' );

