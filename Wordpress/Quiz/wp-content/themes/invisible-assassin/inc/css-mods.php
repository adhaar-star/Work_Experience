<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function invisible_assassin_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	//TItle Tagline hidden.
	if ( get_theme_mod('invisible_assassin_hide_title_tagline') ) :
		echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	//If Title and Desc is set to Show Below the Logo
	if (  get_theme_mod('invisible_assassin_branding_below_logo') ) :	
		echo "#masthead #text-title-desc { display: block; clear: both; } ";
	endif;
	
	
	
	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('invisible_assassin_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: left; }";
	endif;	
	
	
	//Modify Menu bars, if header image has been set
	if ( get_header_image() ) :
		// echo "#site-navigation { background: ".invisible_assassin_fade("#f4f4f4", 0.9)."; }";
	endif;
	
	if ( get_theme_mod('invisible_assassin_himg_darkbg' ) ) :
		echo "#masthead .layer { background: rgba(0,0,0,0.5); }";
	endif;
	
	if ( get_theme_mod('invisible_assassin_title_font') ) :
		echo ".title-font, h1, h2, .section-title, #top-menu ul li a, #static-bar ul li a { font-family: ".get_theme_mod('invisible_assassin_title_font')."; }";
	endif;
	
	if ( get_theme_mod('invisible_assassin_body_font') ) :
		echo "body { font-family: ".get_theme_mod('invisible_assassin_body_font')."; }";
	endif;
	
	if ( get_theme_mod('invisible_assassin_site_titlecolor') ) :
		echo "#masthead h1.site-title a { color: ".get_theme_mod('invisible_assassin_site_titlecolor', '#000000')."; }";
	endif;
	
	
	if ( get_theme_mod('invisible_assassin_header_desccolor','#595959') ) :
		echo "#masthead h2.site-description { color: ".get_theme_mod('invisible_assassin_header_desccolor','#595959')."; }";
	endif;
	
	if ( get_theme_mod('invisible_assassin_custom_css') ) :
		echo  get_theme_mod('invisible_assassin_custom_css');
	endif;
	
	
	if ( get_theme_mod('invisible_assassin_logo_resize') ) :
		$val = get_theme_mod('invisible_assassin_logo_resize')/100;
		echo "#masthead #site-logo img { transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
		endif;

	echo "</style>";
}

add_action('wp_head', 'invisible_assassin_custom_css_mods');