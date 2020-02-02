<?php
/*
*
* front-page
*
*/
get_header(); ?>

<section id="homepage" class="section pt-page-current" style="background-image: url(<?php echo esc_url ( get_theme_mod('flatio_homebgimage', get_template_directory_uri().'/images/homepage.jpg') ); ?>);">
    <div id="homepage-wrapper" class="section-wrapper" style="background-color: <?php echo esc_attr ( get_theme_mod('flatio_homebgcolor') ); ?>;background-color: <?php echo esc_attr ( flatio_hex2rgba ( get_theme_mod('flatio_homebgcolor'), 0.6 ) ); ?>;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">

                    <div class="top-panel">
                        <div class="logo-holder">
                            <a class="logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo-img" src="<?php echo esc_url( get_theme_mod('flatio_logo', get_template_directory_uri().'/images/logo.png') ); ?>" alt="logo"></a>
						</div>
                    </div>
					
                    <div class="app-list">

                    <?php if ( get_theme_mod('flatio_enable_1', 1) ): ?>
                        <div class="appicon appicon-1" style="<?php echo esc_attr ( get_theme_mod('flatio_css_1', 'background: linear-gradient(215deg, rgba(255,0,255,1) , rgba(0,255,255,1) );') ); ?>;background:<?php echo esc_attr ( get_theme_mod('flatio_color_1') ); ?>;">
                            <a class="appnav app-link" href="#<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_1', 'portfolio')) ); ?>"><img src="<?php echo esc_url( get_theme_mod('flatio_icon_1', get_template_directory_uri().'/images/app/app-portfolio.png') ) ?>" alt="appicon"><h3 class="h3 apptitle" style="color:<?php echo esc_attr ( get_theme_mod('flatio_app_title_color', '#FFFFFF') ); ?>"><?php echo esc_attr ( get_theme_mod('flatio_name_1','Portfolio') ); ?></h3></a>
                        </div>
                    <?php endif; ?>

                    <?php if ( get_theme_mod('flatio_enable_2', 1) ): ?>
                        <div class="appicon appicon-2" style="<?php echo esc_attr ( get_theme_mod('flatio_css_2', 'background: linear-gradient(45deg, rgba(0,59,59,1) , rgba(5,193,255,1) , rgba(0,59,59,1) );') ); ?>;background:<?php echo esc_attr ( get_theme_mod('flatio_color_2') ); ?>;">
                            <a class="appnav app-link" href="#<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_2', 'about')) ); ?>"><img src="<?php echo esc_url( get_theme_mod('flatio_icon_2', get_template_directory_uri().'/images/app/app-about.png') ) ?>" alt="appicon"><h3 class="h3 apptitle" style="color:<?php echo esc_attr ( get_theme_mod('flatio_app_title_color', '#FFFFFF') ); ?>"><?php echo esc_attr ( get_theme_mod('flatio_name_2','About') ); ?></h3></a>
                        </div>
                    <?php endif; ?>

                    <?php if ( get_theme_mod('flatio_enable_3', 1) ): ?>
                        <div class="appicon appicon-3" style="<?php echo esc_attr ( get_theme_mod('flatio_css_3', 'background: linear-gradient(45deg, rgba(0,255,0,1), rgba(0,255,255,1));') ); ?>;background:<?php echo esc_attr ( get_theme_mod('flatio_color_3') ); ?>;">
                            <a class="appnav app-link" href="#<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_3', 'team')) ); ?>"><img src="<?php echo esc_url( get_theme_mod('flatio_icon_3', get_template_directory_uri().'/images/app/app-team.png') ) ?>" alt="appicon"><h3 class="h3 apptitle" style="color:<?php echo esc_attr ( get_theme_mod('flatio_app_title_color', '#FFFFFF') ); ?>"><?php echo esc_attr ( get_theme_mod('flatio_name_3','Team') ); ?></h3></a>
                        </div>
                    <?php endif; ?>
					
                    <?php if ( get_theme_mod('flatio_enable_4', 1) ): ?>
                        <div class="appicon appicon-4" style="<?php echo esc_attr ( get_theme_mod('flatio_css_4', 'background: linear-gradient(215deg, rgba(255,102,102,1) , rgba(0,255,255,1) );') ); ?>;background:<?php echo esc_attr ( get_theme_mod('flatio_color_4') ); ?>;">
                            <a class="appnav app-link" href="#<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_4', 'blog')) ); ?>"><img src="<?php echo esc_url( get_theme_mod('flatio_icon_4', get_template_directory_uri().'/images/app/app-blog.png') ) ?>" alt="appicon"><h3 class="h3 apptitle" style="color:<?php echo esc_attr ( get_theme_mod('flatio_app_title_color', '#FFFFFF') ); ?>"><?php echo esc_attr ( get_theme_mod('flatio_name_4','Blog') ); ?></h3></a>
                        </div>
                    <?php endif; ?>
					
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php $flatio_default_page_content = '<h1 class="h1 section-title">' . __('Your Content Here', 'flatio') . '</h1><h3 class="h3" style="margin-top:100px;color:#00FF0D;text-align:center;">' . __('Go To Appearance -> Customize and Select a Page To Display Here.', 'flatio') . '</h3>'; ?>

<?php if ( get_theme_mod('flatio_enable_1', 1) ):
	list($flatio_outclass,$flatio_inclass) = explode( '$', get_theme_mod('flatio_transition_1', 'pt-page-rotateCubeLeftOut pt-page-ontop$pt-page-rotateCubeLeftIn') ); ?>
	<section id="<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_1','portfolio')) ) ?>" class="section section-1" data-outclass="<?php echo esc_attr ( $flatio_outclass ); ?>" data-inclass="<?php echo esc_attr ( ( $flatio_inclass ) ); ?>" style="background-image: url(<?php echo esc_url( get_theme_mod('flatio_pagebgimage_1', get_template_directory_uri().'/images/background.jpg') ) ?>);">
		<div id="<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_1','portfolio')) ) ?>-wrapper" class="section-wrapper section-wrapper-1" style="background-color: <?php echo esc_attr ( get_theme_mod('flatio_pagebgcolor_1', '#0FA2CB') ); ?>;background-color: <?php echo esc_attr ( flatio_hex2rgba ( get_theme_mod('flatio_pagebgcolor_1', '#61CAFF') , 0.6 ) ); ?>;">
			<div class="container">
				<?php if ( get_theme_mod('flatio_page_1') > 0 ): ?>
					<h1 class="h1 section-title" style="color:<?php echo esc_attr ( get_theme_mod('flatio_app_title_color', '#FFFFFF') ); ?>"><?php echo esc_attr ( get_the_title( get_theme_mod('flatio_page_1') ) ); ?></h1>
					<?php $flatio_post = get_post( get_theme_mod('flatio_page_1') ); $flatio_content = apply_filters( 'the_content',$flatio_post->post_content); echo $flatio_content; ?>
				<?php else: ?>
					<?php echo $flatio_default_page_content; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( get_theme_mod('flatio_enable_2', 1) ):
	list($flatio_outclass,$flatio_inclass) = explode( '$', get_theme_mod('flatio_transition_2', 'pt-page-rotateFoldRight$pt-page-moveFromLeftFade') ); ?>
	<section id="<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_2','about')) ) ?>" class="section section-2" data-outclass="<?php echo esc_attr ( $flatio_outclass ); ?>" data-inclass="<?php echo esc_attr ( ( $flatio_inclass ) ); ?>" style="background-image: url(<?php echo esc_url( get_theme_mod('flatio_pagebgimage_2', get_template_directory_uri().'/images/background.jpg') ) ?>);">
		<div id="<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_2','about')) ) ?>-wrapper" class="section-wrapper section-wrapper-2" style="background-color: <?php echo esc_attr ( get_theme_mod('flatio_pagebgcolor_2', '#0FA2CB') ); ?>;background-color: <?php echo esc_attr ( flatio_hex2rgba ( get_theme_mod('flatio_pagebgcolor_2', '#61CAFF') , 0.6 ) ); ?>;">
			<div class="container">
				<?php if ( get_theme_mod('flatio_page_2') > 0 ): ?>
					<h1 class="h1 section-title" style="color:<?php echo esc_attr ( get_theme_mod('flatio_app_title_color', '#FFFFFF') ); ?>"><?php echo esc_attr ( get_the_title( get_theme_mod('flatio_page_2') ) ); ?></h1>
					<?php $flatio_post = get_post( get_theme_mod('flatio_page_2') ); $flatio_content = apply_filters( 'the_content',$flatio_post->post_content); echo $flatio_content; ?>
				<?php else: ?>
					<?php echo $flatio_default_page_content; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( get_theme_mod('flatio_enable_3', 1) ):
	list($flatio_outclass,$flatio_inclass) = explode( '$', get_theme_mod('flatio_transition_3', 'pt-page-moveToBottom$pt-page-moveFromTop') ); ?>
	<section id="<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_3','team')) ) ?>" class="section section-3" data-outclass="<?php echo esc_attr ( $flatio_outclass ); ?>" data-inclass="<?php echo esc_attr ( ( $flatio_inclass ) ); ?>" style="background-image: url(<?php echo esc_url( get_theme_mod('flatio_pagebgimage_3', get_template_directory_uri().'/images/background.jpg') ) ?>);">
		<div id="<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_3','team')) ) ?>-wrapper" class="section-wrapper section-wrapper-3" style="background-color: <?php echo esc_attr ( get_theme_mod('flatio_pagebgcolor_3', '#0FA2CB') ); ?>;background-color: <?php echo esc_attr ( flatio_hex2rgba ( get_theme_mod('flatio_pagebgcolor_3', '#61CAFF') , 0.6 ) ); ?>;">
			<div class="container">
				<?php if ( get_theme_mod('flatio_page_3') > 0 ): ?>
					<h1 class="h1 section-title" style="color:<?php echo esc_attr ( get_theme_mod('flatio_app_title_color', '#FFFFFF') ); ?>"><?php echo esc_attr ( get_the_title( get_theme_mod('flatio_page_3') ) ); ?></h1>
					<?php $flatio_post = get_post( get_theme_mod('flatio_page_3') ); $flatio_content = apply_filters( 'the_content',$flatio_post->post_content); echo $flatio_content; ?>
				<?php else: ?>
					<?php echo $flatio_default_page_content; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( get_theme_mod('flatio_enable_4', 1) ):
	list($flatio_outclass,$flatio_inclass) = explode( '$', get_theme_mod('flatio_transition_4', 'pt-page-moveToRight$pt-page-moveFromLeft') ); ?>
	<section id="<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_4','blog')) ) ?>" class="section section-4" data-outclass="<?php echo esc_attr ( $flatio_outclass ); ?>" data-inclass="<?php echo esc_attr ( ( $flatio_inclass ) ); ?>" style="background-image: url(<?php echo esc_url( get_theme_mod('flatio_pagebgimage_4', get_template_directory_uri().'/images/background.jpg') ) ?>);">
		<div id="<?php echo esc_attr ( preg_replace('/\s+/', '', get_theme_mod('flatio_name_4','blog')) ) ?>-wrapper" class="section-wrapper section-wrapper-4" style="background-color: <?php echo esc_attr ( get_theme_mod('flatio_pagebgcolor_4', '#0FA2CB') ); ?>;background-color: <?php echo esc_attr ( flatio_hex2rgba ( get_theme_mod('flatio_pagebgcolor_4', '#61CAFF') , 0.6 ) ); ?>;">
			<div class="container">
				<?php if ( get_theme_mod('flatio_page_4') > 0 ): ?>
					<h1 class="h1 section-title" style="color:<?php echo esc_attr ( get_theme_mod('flatio_app_title_color', '#FFFFFF') ); ?>"><?php echo esc_attr ( get_the_title( get_theme_mod('flatio_page_4') ) ); ?></h1>
					<?php $flatio_post = get_post( get_theme_mod('flatio_page_4') ); $flatio_content = apply_filters( 'the_content',$flatio_post->post_content); echo $flatio_content; ?>
				<?php else: ?>
					<?php echo $flatio_default_page_content; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
