<?php
/*  *
 * WP Feedback, Surver & Quiz Manager - Pro Form Elements Class
 * Admin area
 *
 * Populates the form builder
 * Works along with IPT_Plugin_UIF_Admin
 *
 * @package WP Feedback, Surver & Quiz Manager - Pro
 * @subpackage Form Elements
 * @author Swashata Ghosh <swashata@intechgrity.com>
 */
class IPT_FSQM_Form_Elements_Admin extends IPT_FSQM_Form_Elements_Base {
	/*  *
	 * The UI variable to populate all the necessary HTML
	 *
	 * @var IPT_Plugin_UIF_Admin
	 */
	public $ui;

	public $save_process = array();

	/*  ==========================================================================
	 * CONSTRUCTOR
	 *========================================================================*/
	public function __construct( $form_id = null ) {
		$this->ui = IPT_Plugin_UIF_Admin::instance( 'ipt_fsqm' );
		parent::__construct( $form_id );
	}

	/*  ==========================================================================
	 * Help Section
	 *========================================================================*/
	public function add_help() {
		get_current_screen()->add_help_tab( array(
				'id' => 'overview',
				'title' => __( 'Overview', 'ipt_fsqm' ),
				'content' =>
				'<p>' . __( 'This page provides you all the tool you can use to create and customize a form. A form can have any number of containers. Simple click on the Add Containers button and it will add a new container where you can drag and drop new form elements.', 'ipt_fsqm' ) . '</p>' .
				'<p>' . __( 'A form can have a total of 48 elements as of now (without any extensions) which are catrgorized into 4 type.', 'ipt_fsqm' ) . '</p>' .
				'<ul>' .
				'<li>' . __( '<strong>Design & Security:</strong> Use the elements to add eye candy or security elements to your form. Check the Design Elements section for more.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Multiple Choice Questions:</strong> Add MCQs to your form which can be used to generate quiz and/or collect surveys. Elements have scoring option whenever applicable and all of them will appear on the Report & Analysis. Check Multiple Choice Question Elements for more information.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Feedback Questions:</strong> These are basically freetype questions, where users have to put their own answers. All of the answers can be set to go to one or more specific emails. This becomes handy if you are collecting feedbacks on different topics and have to email different people the answers of different topics.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Other Form Elements:</strong> Here we have 4 predefined text fields (First Name, Last Name, Email, Phone Number) which you can add to the form. Apart from that, another 14 types of form elements can be added. Check Other Form Elements for more information.', 'ipt_fsqm' ) . '</li>' .
				'</ul>' .
				'<p>' . __( 'You can get more help by clicking the [?] icon beside every options. Or you can check the corresponding tabs inside this help screen...', 'ipt_fsqm' ) . '</p>'
			) );

		get_current_screen()->add_help_tab( array(
				'id' => 'form-customization',
				'title' => __( 'Form Customization', 'ipt_fsqm' ),
				'content' =>
				'<p>' . __( 'Right above the form builder, you will see 4 tabs from where you can customize many aspects of the form.', 'ipt_fsqm' ) . '</p>' .
				'<ul>' .
				'<li>' . __( '<strong>Form Name:</strong> As the title suggests, enter the name of the form.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Form Type:</strong> Select the type of the form. Currently we support 3 kinds of appearances. Each appearance has it\'s own different sets of options. Please check the help icon associated with the option to get more information.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Form Settings:</strong> Various form related settings. Please read below:', 'ipt_fsqm' ) .
				'<ul>' .
				'<li>' . __( '<strong>General Settings:</strong> Have a Terms & Conditions Page, which shows a single checkbox with a link to your page just before submitting the form, an Administrator Remarks Title and Default Administrator Remarks.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Submission Limitation:</strong> Limit submission of this form per email address and/or per IP address.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Progress Buttons:</strong> Change the labels of the Next, Previous and Submit buttons. They will show up, whenever applicable.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Form Submission:</strong> Enter your own processing and success title along with a success message.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>User Notification:</strong> Customize how users (the one submitting the form) are notified.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Admin Notification:</strong> Customize how admins are notified.', 'ipt_fsqm' ) . '</li>' .
				'<li>' . __( '<strong>Redirection:</strong> Set customized redirection to a page when user submits. They can be redirected to a particular page or specific pages depending on their score.', 'ipt_fsqm' ) . '</li>' .
				'</ul>' .
				'</li>' .
				'<li>' . __( '<strong>Form Theme:</strong> Various jQuery UI Themes are available for you to use directly. We have also added font customization options.', 'ipt_fsqm' ) . '</li>' .
				'</ul>' .
				'<p>' . __( 'You can get more help by clicking the [?] icon beside every options.', 'ipt_fsqm' ) . '</p>'
			) );

		foreach ( $this->elements as $element_type => $elements ) {
			if ( $element_type == 'layout' ) {
				continue;
			}
			$content = '<p>' . $elements['description'] . '</p>';
			if ( isset( $elements['elements'] ) && is_array( $elements['elements'] ) && !empty( $elements['elements'] ) ) {
				$content .= '<ul>';
				foreach ( $elements['elements'] as $element ) {
					$content .= '<li><strong>' . $element['title'] . ':</strong> ' . $element['description'] . '</li>';
				}
				$content .= '</ul>';
			}
			get_current_screen()->add_help_tab( array(
					'id' => 'form-elements-' . $element_type,
					'title' => $elements['title'],
					'content' => $content,
				) );
		}
	}

	/*  ==========================================================================
	 * PRIMARY APIs
	 *========================================================================*/
	public function show_form() {
		$toolbar_buttons = array(
			0 => array( __( 'Save', 'ipt_fsqm' ), 'ipt_fsqm_save', 'large', '2' ),
			1 => array( __( 'Preview', 'ipt_fsqm' ), 'ipt_fsqm_preview', 'large', '2' ),
		);
		$tab_settings = array();

		$tab_settings[] = array(
			'id' => 'ipt_fsqm_form_name',
			'label' => __( 'Form Name', 'ipt_fsqm' ),
			'callback' => array( $this, 'form_name' ),
		);
		$tab_settings[] = array(
			'id' => 'ipt_fsqm_form_type',
			'label' => __( 'Form Type', 'ipt_fsqm' ),
			'callback' => array( $this, 'form_type' ),
		);
		$tab_settings[] = array(
			'id' => 'ipt_fsqm_form_settings',
			'label' => __( 'Form Settings', 'ipt_fsqm' ),
			'callback' => array( $this, 'form_settings' ),
			'has_inner_tab' => true,
		);
		$tab_settings[] = array(
			'id' => 'ipt_fsqm_form_quiz_settings',
			'label' => __( 'Quiz Settings', 'ipt_fsqm' ),
			'callback' => array( $this, 'quiz_settings' ),
			'has_inner_tab' => true,
		);
		$tab_settings[] = array(
			'id' => 'ipt_fsqm_form_rmail',
			'label' => __( 'Result & email', 'ipt_fsqm' ),
			'callback' => array( $this, 'result_email' ),
			'has_inner_tab' => true,
		);
		$tab_settings[] = array(
			'id' => 'ipt_fsqm_form_integration',
			'label' => __( 'Integration', 'ipt_fsqm' ),
			'callback' => array( $this, 'integration' ),
			'has_inner_tab' => true,
		);
		$tab_settings[] = array(
			'id' => 'ipt_fsqm_form_theme',
			'label' => __( 'Form Theme', 'ipt_fsqm' ),
			'callback' => array( $this, 'theme' ),
		);
		$builder_labels = array(
			'design' => __( 'D', 'ipt_fsqm' ),
			'mcq' => __( 'M', 'ipt_fsqm' ),
			'freetype' => __( 'F', 'ipt_fsqm' ),
			'pinfo' => __( 'O', 'ipt_fsqm' ),
		);

		$tab_settings = apply_filters( 'ipt_fsqm_admin_tab_settings', $tab_settings, $this );
?>
<?php wp_nonce_field( 'ipt_fsqm_form_save_ajax', 'ipt_fsqm_form_save_ajax' ); ?>
<?php $this->ui->ajax_loader( false, 'ipt_fsqm_fb_p_al', array(), true, __( 'Loading', 'ipt_fsqm' ) ); ?>
<div id="ipt_fsqm_form" class="ipt_uif_container ipt_fsqm_fb_hidden_init">
	<?php if ( $this->form_id != null ) : ?>
	<input type="hidden" name="form_id" id="form_id" value="<?php echo $this->form_id; ?>" />
	<?php endif; ?>
	<!-- Form Settings -> Tabs -->
	<div id="ipt_fsqm_form_customization">
		<?php $this->ui->tabs( $tab_settings, true ); ?>
	</div>
	<!-- End Form Settings -->

	<!-- Buttons Toolbar area -->
	<div id="ipt_fsqm_form_toolbar">
		<?php $this->ui->buttons( $toolbar_buttons, '', 'ipt_uif_toolbar' ); ?>
		<?php $this->ui->ajax_loader( true, 'ipt_fsqm_auto_save', array(), true, __( 'Saving Changes', 'ipt_fsqm' ) ); ?>
	</div>
	<!-- End Buttons Toolbar area -->

	<!-- Builder Layout -->
	<?php $this->ui->builder_init( 'ipt_fsqm_form_builder', array( $this, 'builder' ), $builder_labels ); ?>
	<!-- End Builder Layout -->
	<div class="clear"></div>
</div>
<?php $this->ui->ajax_loader( true, 'ipt_fsqm_ajax_loader', array(
				'save' => __( 'Saving', 'ipt_fsqm' ),
				'preview' => __( 'Generating Preview', 'ipt_fsqm' ),
				'success' => __( 'Success', 'ipt_fsqm' ),
			) ); ?>
		<?php
	}

	public function ajax_save() {
		if ( !wp_verify_nonce( $this->post['ipt_fsqm_form_save_ajax'], 'ipt_fsqm_form_save_ajax' ) || ! current_user_can( 'manage_feedback' ) ) {
			echo 'cheating';
			die();
		}

		$id = $this->process_save();
		echo $id;
		die();
	}

	/*  *
	 * Process the save
	 *
	 * @global array $ipt_fsqm_info
	 * @global wpdb $wpdb
	 */
	public function process_save() {
		global $ipt_fsqm_info, $wpdb;
		// Reinit to the current form
		if ( isset( $this->post['form_id'] ) ) {
			$this->init( $this->post['form_id'] );
		}

		//Set all the variables
		$layout = array();
		$this->save_process = array(
			'design' => array(),
			'mcq' => array(),
			'freetype' => array(),
			'pinfo' => array(),
		);

		// Get the settings
		$settings = $this->merge_elements( $this->post['settings'], $this->get_default_settings() );
		if ( '' != $settings['user']['smtp_config']['password'] ) {
			$settings['user']['smtp_config']['password'] = $this->encrypt( $settings['user']['smtp_config']['password'] );
		}
		// Manage Aweber
		// Is the settings enabled?
		if ( $settings['integration']['aweber']['enabled'] == true ) {
			// Can be a new authorization code
			if ( $this->settings['integration']['aweber']['prevac'] != $settings['integration']['aweber']['authorization_code'] ) {
				// Update the tokens
				if ( ! class_exists( 'AWeberAPI' ) ) {
					require_once IPT_FSQM_Loader::$abs_path . '/integrations/aweber/aweber_api.php';
				}
				try {
					$aw_credentials = AWeberAPI::getDataFromAweberID( $settings['integration']['aweber']['authorization_code'] );
					foreach ( array( 'consumerKey', 'consumerSecret', 'accessKey', 'accessSecret' ) as $aweber_key => $aweber_val ) {
						$settings['integration']['aweber'][$aweber_val] = $aw_credentials[$aweber_key];
					}
					$settings['integration']['aweber']['prevac'] = $settings['integration']['aweber']['authorization_code'];
				} catch ( Exception $e ) {
					foreach ( array( 'consumerKey', 'consumerSecret', 'accessKey', 'accessSecret' ) as $aweber_key ) {
						$settings['integration']['aweber'][$aweber_key] = '';
					}
					$settings['integration']['aweber']['authorization_code'] = __( 'Invalid Code provided', 'ipt_fsqm' );
					$settings['integration']['aweber']['prevac'] = '';
				}
			// It is the same one
			} else {
				// Use the same tokens
				foreach ( array( 'consumerKey', 'consumerSecret', 'accessKey', 'accessSecret' ) as $aweber_key ) {
					$settings['integration']['aweber'][$aweber_key] = $this->settings['integration']['aweber'][$aweber_key];
				}
				$settings['integration']['aweber']['prevac'] = $settings['integration']['aweber']['authorization_code'];
			}

		// Reset aweber, if anything was even present
		} else {
			$settings['integration']['aweber']['authorization_code'] = '';
			$settings['integration']['aweber']['prevac'] = '';
			foreach ( array( 'consumerKey', 'consumerSecret', 'accessKey', 'accessSecret' ) as $aweber_key ) {
				$settings['integration']['aweber'][$aweber_key] = '';
			}
		}



		//Get the name
		$form_name = trim( strip_tags( $this->post['name'] ) );
		if ( $form_name == '' ) {
			$form_name = __( 'Untitled', 'ipt_fsqm' );
		}
		//Get the type

		$form_type = (int) $this->post['type'];

		$form_category = (int) $this->post['category'];

		//Process the layout and recursively process all the inner elements as well ;-)
		if ( isset( $this->post['containers'] ) ) {
			foreach ( (array) $this->post['containers'] as $container_key ) {
				//Get default structure
				$layout_new = $this->get_element_structure( 'tab' );

				//Merge with the date sent by user
				$layout_new = $this->merge_elements( $this->post['layout'][$container_key], $layout_new );

				//Reset the elements
				$layout_new['elements'] = array();

				//If no elements, then no need to continue
				if ( !isset( $this->post['layout'][$container_key]['elements']['m_type'] ) ) {
					continue;
				}

				//For all elements, check it and then add it
				foreach ( (array) $this->post['layout'][$container_key]['elements']['m_type'] as $e_key => $m_type ) {
					if ( !isset( $this->save_process[$m_type] ) ) {
						continue;
					}
					$type = $this->post['layout'][$container_key]['elements']['type'][$e_key];
					$key = $this->post['layout'][$container_key]['elements']['key'][$e_key];

					$element = $this->process_element( $m_type, $type, $key );

					if ( false !== $element ) {
						$layout_new['elements'][] = array(
							'm_type' => $m_type,
							'type' => $type,
							'key' => $key,
						);
					}
				}

				if ( !empty( $layout_new['elements'] ) ) {
					$layout[] = $layout_new;
				}
			}
		}

		$return_id = isset( $this->post['form_id'] ) ? $this->post['form_id'] : null;

		if ( $return_id !== null ) {
			$wpdb->update( $ipt_fsqm_info['form_table'], array(
					'name' => $form_name,
					'settings' => maybe_serialize( $settings ),
					'layout' => maybe_serialize( $layout ),
					'design' => maybe_serialize( $this->save_process['design'] ),
					'mcq' => maybe_serialize( $this->save_process['mcq'] ),
					'freetype' => maybe_serialize( $this->save_process['freetype'] ),
					'pinfo' => maybe_serialize( $this->save_process['pinfo'] ),
					'type' => $form_type,
					'category' => $form_category,
				), array( 'id' => $return_id ), '%s', '%d' );
			do_action( 'ipt_fsqm_form_updated', $return_id, $this );
		} else {
			$wpdb->insert( $ipt_fsqm_info['form_table'], array(
					'name' => $form_name,
					'settings' => maybe_serialize( $settings ),
					'layout' => maybe_serialize( $layout ),
					'design' => maybe_serialize( $this->save_process['design'] ),
					'mcq' => maybe_serialize( $this->save_process['mcq'] ),
					'freetype' => maybe_serialize( $this->save_process['freetype'] ),
					'pinfo' => maybe_serialize( $this->save_process['pinfo'] ),
					'type' => $form_type,
					'category' => $form_category,
				) );
			$return_id = $wpdb->insert_id;
			do_action( 'ipt_fsqm_form_created', $return_id, $this );
		}

		return $return_id;
	}

	/*  ==========================================================================
	 * Save Processors
	 *========================================================================*/
	protected function process_element( $m_type, $type, $key ) {
		$element_definition = $this->get_element_definition( array( 'm_type' => $m_type, 'type' => $type ) );
		$element_structure = $this->get_element_structure( $type );

		if ( false === $element_structure ) {
			return false;
		}

		//Infinite recursion check - Who knows what the devil may do
		if ( isset( $this->save_process[$m_type][$key] ) ) {
			return false;
		}

		$element_from_post = isset( $this->post[$m_type][$key] ) ? $this->post[$m_type][$key] : array();

		$element = $this->merge_elements( $element_from_post, $element_structure );

		if ( isset( $element_definition['droppable'] ) && $element_definition['droppable'] == true ) {
			$element['elements'] = array();

			if ( isset( $this->post[$m_type][$key]['elements']['m_type'] ) ) {
				foreach ( (array) $this->post[$m_type][$key]['elements']['m_type'] as $e_key => $child_m_type ) {
					$child_type = $this->post[$m_type][$key]['elements']['type'][$e_key];
					$child_key = $this->post[$m_type][$key]['elements']['key'][$e_key];

					$child_element = $this->process_element( $child_m_type, $child_type, $child_key );

					if ( false !== $child_element ) {
						$element['elements'][] = array(
							'm_type' => $child_m_type,
							'type' => $child_type,
							'key' => $child_key,
						);
					}
				}
			}
		}

		$this->save_process[$m_type][$key] = $element;
		return true;
	}

	/*  ==========================================================================
	 * BUILDER LAYOUT CALLBACKS
	 *========================================================================*/
	public function builder() {
		$msgs = array(
			'layout_helper_msg' => __( 'You can customize this layout by simply dragging a form element and dropping over the area. You can also have nested elements inside any droppable element. You can and should further set the title and subtitle of this container so that the tabular layout can be properly populated.' ),
			'layout_helper_title' => __( 'Customizable Layout', 'ipt_fsqm' ),
			'deleter_title' => __( 'Confirm Deletion', 'ipt_fsqm' ),
			'deleter_msg' => __( 'Are you sure you want to remove this container? The action can not be undone.', 'ipt_fsqm' ),
		);
		$keys = array(
			'layout' => 0,
			'design' => 0,
			'mcq' => 0,
			'freetype' => 0,
			'pinfo' => 0,
		);
		foreach ( $keys as $type => $key ) {
			if ( !empty( $this->{$type} ) ) {
				$keys[$type] = max( array_keys( $this->{$type} ) ) + 1;
			}
		}
		foreach ( $this->layout as $l_key => $layout ) {
			$this->layout[$l_key]['grayed_out'] = false;
			if ( isset($layout['conditional']) && $layout['conditional']['active'] == true && $layout['conditional']['status'] == false ) {
				$this->layout[$l_key]['grayed_out'] = true;
			}
		}
?>
	<!-- Left Column -->
	<div class="ipt_uif_column_medium ipt_uif_float_left">
		<!-- Settings Box -->
		<?php $this->ui->builder_settings_box( 'ipt_fsqm_settings', __( 'Save Settings', 'ipt_fsqm' ) ); ?>
		<!-- End Settings Box -->

		<!-- WP Editor -->
		<?php $this->ui->builder_wp_editor( 'ipt_fsqm_form_richtext', __( 'Save Settings', 'ipt_fsqm' ), __( 'Description', 'ipt_fsqm' ) ); ?>
		<!-- End WP Editor -->

		<!-- Droppable Elements -->
		<?php $this->builder_droppables(); ?>
		<!-- End Droppable Elements -->

		<!-- Add Tab/Pagination -->
		<?php $this->ui->builder_adder( __( 'Add Containers', 'ipt_fsqm' ), 'ipt_fsqm_add_layout', '__LKEY__', array( $this, 'builder_layout_settings' ), array( '__LKEY__', array() ), 'layout' ); ?>
		<!-- End Add Tab/Pagination -->
		<div class="clear"></div>
	</div>
	<!-- End Left Column -->

	<!-- Right Column -->
	<div class="ipt_uif_column_large ipt_uif_float_right">
		<!-- Layout area -->
		<?php $this->ui->builder_sortables( 'ipt_fsqm_form_builder_layout', $this->type, $this->layout, array( $this, 'builder_sortable' ), array( $this, 'builder_layout_settings' ), $msgs, 'layout', $keys ); ?>
		<!-- End Layout Area -->
		<div class="clear"></div>
	</div>
	<!-- End Right Column -->
		<?php
	}

	public function builder_sortable( $layout_element, $layout_key ) {
		$e_key = $layout_element['key'];
		$element = $this->get_element_from_layout( $layout_element );
		$callback = array( $this, 'build_element_html' );
		$parameters = array( $element['type'], $e_key, $element, null, '' );
		$element_definition = $this->get_element_definition( $element );
		$data_attr = $this->ui->builder_data_attr( $element_definition );
		$element_definition['sub_title'] = strip_tags( $element['title'] );
		$element_grayed_out = false;
		if ( isset($element['conditional']) && $element['conditional']['active'] == true && $element['conditional']['status'] == false ) {
			$element_grayed_out = true;
		}

		$element_definition['grayed_out'] = $element_grayed_out;
		return array( $element_definition, $e_key, $layout_key, $element['type'], $callback, $parameters, $data_attr, $element, array( $this, 'builder_sortable' ) );
	}

	public function builder_layout_settings( $layout_key, $layout = array() ) {
		$structure = wp_parse_args( $layout, $this->get_element_structure( 'tab' ) );
?>
	<table class="form-table">
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( 'layout[' . $layout_key . '][title]', $structure['title'], __( 'Title of the Container', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( 'layout[' . $layout_key . '][subtitle]', $structure['subtitle'], __( 'Secondary title of the Container', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php _e( 'You can also have any rich text which will be shown on the top of the container.', 'ipt_fsqm' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label('layout[' . $layout_key . '][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( 'layout[' . $layout_key . '][icon]', $structure['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the heading. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr class="ipt_fsqm_page_specific_time">
				<th><?php $this->ui->generate_label( 'layout[' . $layout_key . '][timer]', __( 'Container Time Limit (Seconds)', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( 'layout[' . $layout_key . '][timer]', $structure['timer'], __( 'Seconds', 'ipt_fsqm' ), '0' ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Set the time in seconds after which this container will automatically progress.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional('layout[' . $layout_key . ']', $structure['conditional'] );
		$this->ui->textarea_linked_wp_editor( 'layout[' . $layout_key . '][description]', $structure['description'], 'Enter' );
		return;

	}


	public function builder_droppables() {
		$id = 'ipt_fsqm_builder_droppable';
		$key = '__EKEY__';
		$layout_key = '__LKEY__';
		$items = $this->elements;
		unset( $items['layout'] );
		foreach ( $items as $i_key => $item ) {
			foreach ( $item['elements'] as $elem_key => $element ) {
				$items[$i_key]['elements'][$elem_key]['callback'] = array( $this, 'build_element_html' );
				$items[$i_key]['elements'][$elem_key]['parameters'] = array( $elem_key, $key, null, null, '' );
				$items[$i_key]['elements'][$elem_key]['sub_title'] = '';
			}
		}
		$this->ui->builder_droppables( $id, $items, $key, $layout_key, __( 'Go Back', 'ipt_fsqm' ) );
	}

	private function icon_tester() {
		$icons = $this->ui->get_valid_icons();
		$i_check = array();
		?>
<table class="widefat">
	<thead>
		<tr>
			<th>Name</th>
			<th>Data</th>
			<th>Icon</th>
			<th>Image</th>
			<th>Duplicate</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $icons as $i_gr ) : ?>
		<?php foreach ( $i_gr['elements'] as $i_key => $ic ) : ?>
			<?php $duplicate = isset( $i_check[$i_key] ) ? true : false; ?>
			<?php $i_check[$i_key] = true; ?>
		<tr>
			<th><?php echo $ic; ?></th>
			<td><?php echo $i_key . ' / ' . dechex( $i_key ); ?></td>
			<td><span data-ipt-icomoon="&#x<?php echo dechex( $i_key ); ?>;" style="font-size: 32px; margin: 5px 0; display: inline-block; color: #333;"></span></td>
			<td><?php echo '<img src="' . plugins_url( '/lib/images/iconmoon/' . $this->ui->get_icon_image_name( $i_key ), IPT_FSQM_Loader::$abs_file ) . '" />'; ?></td>
			<td><?php echo ($duplicate ? 'Yes' : 'No'); ?></td>
		</tr>
		<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>
		<?php
	}

	/*  ==========================================================================
	 * TABBED AND OTHER FORM SETTINGS
	 *========================================================================*/
	public function form_name() {
		$this->ui->text( 'name', $this->name, __( 'Enter the Name of the Form', 'ipt_fsqm' ), 'large' );
	}

	public function form_type() {
		$items = array();
		$items[] = array(
			'value' => '0',
			'label' => __( 'Normal Single Paged', 'ipt_fsqm' ),
			'data' => array(
				'condID' => 'ipt_fsqm_type_zero',
			),
		);
		$items[] = array(
			'value' => '1',
			'label' => __( 'Tabular Appearance', 'ipt_fsqm' ),
			'data' => array(
				'condID' => 'ipt_fsqm_type_one',
			),
		);
		$items[] = array(
			'value' => '2',
			'label' => __( 'Paginated Appearance', 'ipt_fsqm' ),
			'data' => array(
				'condID' => 'ipt_fsqm_type_one,ipt_fsqm_type_two',
			),
		);
?>
<div class="ipt_uif_msg ipt_uif_float_right">
	<a href="javascript:;" class="ipt_uif_msg_icon" title="<?php _e( 'Form Appearance Type', 'ipt_fsqm' ); ?>"></a>
	<div class="ipt_uif_msg_body">
		<p><?php _e( 'Currently we support 3 kinds of appearances. Each appearance has it\'s own different sets of options.', 'ipt_fsqm' ); ?></p>
		<h3><?php _e( 'Normal Single Paged', 'ipt_fsqm' ); ?></h3>
		<ul class="ul-square">
			<li>
				<?php _e( 'Form will appear with a general single paged layout.', 'ipt_fsqm' ) ?>
			</li>
			<li>
				<?php _e( 'Ideal for small bussiness or contact forms.', 'ipt_fsqm' ); ?>
			</li>
		</ul>
		<h3><?php _e( 'Tabular Appearance', 'ipt_fsqm' ); ?></h3>
		<ul class="ul-square">
			<li>
				<?php _e( 'Form elements can be grouped into tabs.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'A user will need to navigate through all the tabs and fill them up before submitting.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'You can create as many tabs as you want. Simply click on the <strong>Add Tab/Pagination button</strong>.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'You can also select if the user is able to navigate to a previously viewed tab without validating or completely filling the form elements inside the current tab.', 'ipt_fsqm' ); ?>
			</li>
		</ul>
		<h3><?php _e( 'Paginated Appearance', 'ipt_fsqm' ); ?></h3>
		<ul class="ul-square">
			<li>
				<?php _e( 'Form elements can be grouped into pages.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'A user will need to navigate through all the pages and fill them up before submitting.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'You can create as many pages as you want. Simply click on the <strong>Add Tab/Pagination button</strong>.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'You can select to show a progress bar which will show the percentage of completion.', 'ipt_fsqm' ); ?>
			</li>
		</ul>
	</div>
</div>
		<?php
		$this->ui->radios( 'type', $items, $this->type, false, true );

		$this->ui->shadowbox( array( 'lifted_corner', 'cyan' ), array( $this, 'type_normal' ), 0, 'ipt_fsqm_type_zero' );
		$this->ui->shadowbox( array( 'lifted_corner', 'cyan' ), array( $this, 'type_tab' ), 0, 'ipt_fsqm_type_one' );
		$this->ui->shadowbox( array( 'lifted_corner', 'cyan' ), array( $this, 'type_pagination' ), 0, 'ipt_fsqm_type_two' );
	}

	public function type_normal() {
?>
	<table class="form-table">
		<tbody>
			<tr>
				<th><?php $this->ui->generate_label( 'settings[type_specific][normal][wrapper]', __( 'Wrap Inside', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( 'settings[type_specific][normal][wrapper]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $this->settings['type_specific']['normal']['wrapper'] ); ?>
				</td>
				<td style="width: 40px;">
					<?php $this->ui->help( __( 'If yes then the form will be populated inside a wrapper matching the theme. Otherwise, it will simply try to inherit the default style of your theme. If your form looks bad, then turning this on, might tune things up.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
		</tbody>
	</table>
		<?php
	}

	public function type_pagination() {
?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[type_specific][pagination][show_progress_bar]', __( 'Show Progress Bar', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[type_specific][pagination][show_progress_bar]', __( 'Show', 'ipt_fsqm' ), __( 'Don\'t Show', 'ipt_fsqm' ), $this->settings['type_specific']['pagination']['show_progress_bar'] ); ?>
			</td>
			<td style="width: 40px;">
				<?php $this->ui->help( __( 'You can select to show a progress bar which will show the percentage of completion.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th style="width: 50%"><?php $this->ui->generate_label( 'settings[type_specific][pagination][decimal_point]', __( 'Percentage Decimal Points', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->spinner( 'settings[type_specific][pagination][decimal_point]', $this->settings['type_specific']['pagination']['decimal_point'], __( 'Digits', 'ipt_fsqm' ) ); ?>
			</td>
			<td style="width: 40px;">
				<?php $this->ui->help( __( 'Mention the number of digits that will be shown after decimal point in the progress bar.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function type_tab() {
?>
<table class="form-table">
	<tbody>
		<tr>
			<th style="width: 50%"><?php $this->ui->generate_label( 'settings[type_specific][tab][block_previous]', __( 'Block Navigation to Previous Tab/Page', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[type_specific][tab][block_previous]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $this->settings['type_specific']['tab']['block_previous'] ); ?>
			</td>
			<td style="width: 40px;">
				<?php $this->ui->help( __( 'If enabled, then this will prevent users from navigating back to the previous tab once they click on the next button.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th style="width: 50%"><?php $this->ui->generate_label( 'settings[type_specific][tab][can_previous]', __( 'Can navigate to previous Tab without validation?', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[type_specific][tab][can_previous]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $this->settings['type_specific']['tab']['can_previous'] ); ?>
			</td>
			<td style="width: 40px;">
				<?php $this->ui->help( __( 'You can also select if the user is able to navigate to a previously viewed tab without validating or completely filling the form elements inside the current tab.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th style="width: 50%"><?php $this->ui->generate_label( 'settings[type_specific][tab][scroll]', __( 'Scroll to the page top', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[type_specific][tab][scroll]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $this->settings['type_specific']['tab']['scroll'] ); ?>
			</td>
			<td style="width: 40px;">
				<?php $this->ui->help( __( 'If enabled then the page will automatically scroll to the page top when next/previous button is pressed.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th style="width: 50%"><?php $this->ui->generate_label( 'settings[type_specific][tab][scroll_offset]', __( 'Scroll Offset', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->spinner( 'settings[type_specific][tab][scroll_offset]', $this->settings['type_specific']['tab']['scroll_offset'], __( 'Pixels', 'ipt_fsqm' ) ); ?>
			</td>
			<td style="width: 40px;">
				<?php $this->ui->help( __( 'Adjust the scroll offset value. This is useful if your theme has fixed header or similar. The plugin will try to determine the offset automatically, but sometimes it would not be enough (due to varity in HTML and CSS) and you would need to set it manually here.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function form_settings() {
		$hor_tabs = array();

		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_general',
			'label' => __( 'General Settings', 'ipt_fsqm' ),
			'callback' => array( $this, 'general' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_limitation',
			'label' => __( 'Submission Limitation', 'ipt_fsqm' ),
			'callback' => array( $this, 'limitation' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_buttons',
			'label' => __( 'Progress Buttons', 'ipt_fsqm' ),
			'callback' => array( $this, 'buttons' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_save_progress',
			'label' => __( 'Save Progress', 'ipt_fsqm' ),
			'callback' => array( $this, 'save_progress' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_submission',
			'label' => __( 'Form Submission', 'ipt_fsqm' ),
			'callback' => array( $this, 'submission' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_redirect',
			'label' => __( 'Redirection', 'ipt_fsqm' ),
			'callback' => array( $this, 'redirect' ),
		);

		$this->ui->tabs( $hor_tabs, false, true );
	}

	public function quiz_settings() {
		$hor_tabs = array();
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_ranking',
			'label' => __( 'Ranking System', 'ipt_fsqm' ),
			'callback' => array( $this, 'ranking' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_timer',
			'label' => __( 'Quiz Timer', 'ipt_fsqm' ),
			'callback' => array( $this, 'timer' ),
		);
		$this->ui->tabs( $hor_tabs, false, true );
	}

	public function result_email() {
		$hor_tabs = array();

		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_social',
			'label' => __( 'Social Sharing', 'ipt_fsqm' ),
			'callback' => array( $this, 'social' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_user',
			'label' => __( 'User Notification', 'ipt_fsqm' ),
			'callback' => array( $this, 'user' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_email_template',
			'label' => __( 'Email Design', 'ipt_fsqm' ),
			'callback' => array( $this, 'email_template' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_summary',
			'label' => __( 'Summary Tables', 'ipt_fsqm' ),
			'callback' => array( $this, 'summary' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_trackback',
			'label' => __( 'Trackback Page', 'ipt_fsqm' ),
			'callback' => array( $this, 'trackback' ),
		);
		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_admin',
			'label' => __( 'Admin Notification', 'ipt_fsqm' ),
			'callback' => array( $this, 'admin' ),
		);

		$this->ui->tabs( $hor_tabs, false, true );
	}

	public function integration() {
		$hor_tabs = array();

		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_mailchimp',
			'label' => __( 'MailChimp', 'ipt_fsqm' ),
			'callback' => array( $this, 'mailchimp' ),
		);

		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_aweber',
			'label' => __( 'Aweber', 'ipt_fsqm' ),
			'callback' => array( $this, 'aweber' ),
		);

		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_get_response',
			'label' => __( 'Get Response', 'ipt_fsqm' ),
			'callback' => array( $this, 'get_response' ),
		);

		$hor_tabs[] = array(
			'id' => 'ipt_fsqm_settings_campaign_monitor',
			'label' => __( 'Campaign Monitor', 'ipt_fsqm' ),
			'callback' => array( $this, 'campaign_monitor' ),
		);

		$this->ui->tabs( $hor_tabs, false, true );
	}

	public function general() {
		$form_categories = array(
			array(
				'value' => '0',
				'label' => __( 'None', 'ipt_fsqm' ),
			),
		);
		$db_categories = IPT_FSQM_Form_Elements_Static::get_all_categories();
		if ( null != $db_categories ) {
			foreach ( $db_categories as $dbc ) {
				$form_categories[] = array(
					'value' => $dbc->id,
					'label' => $dbc->name,
				);
			}
		}
?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'category', __( 'Form Category', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->select( 'category', $form_categories, $this->category ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Set the category of the form for quick filtering.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[general][terms_page]', __( 'Terms & Condition Page', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->dropdown_pages( array(
				'selected' => $this->settings['general']['terms_page'],
				'name' => 'settings[general][terms_page]',
				'show_option_none' => __( 'None -- Do not show', 'ipt_fsqm' ),
				'option_none_value' => '0'
			) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If any page ID is given here, then user will be presented with a checkbox which he/she has to check before submitting. This will lead to the specified page on click (depending on the terms phrase).', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[general][terms_phrase]', __( 'Terms Phrase', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[general][terms_phrase]', $this->settings['general']['terms_phrase'], __( 'Disabled', 'ipt_fsqm' ), 'large' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the phrase of the terms and condition. <code>%1$s</code> will be replaced by the link to the page and <code>%2$s</code> will be replaced by the IP Address of the user.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[general][comment_title]', __( 'Administrator Remarks Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[general][comment_title]', $this->settings['general']['comment_title'], __( 'Disabled', 'ipt_fsqm' ), 'large' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the Remarks title that will be shown on the print section and the track page. Leave it empty to disable this feature.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[general][default_comment]', __( 'Default Administrator Remarks', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[general][default_comment]', $this->settings['general']['default_comment'], __( 'Enter default administrator remarks', 'ipt_fsqm' ), 'large' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the default Remarks that will automatically added to the database while submitting the form.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[general][can_edit]', __( 'Users Can Edit Submission', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[general][can_edit]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $this->settings['general']['can_edit'], '1', false, true, array(
					'condid' => 'ipt_fsqm_general_edit_time_wrap',
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If enabled, then registered users can edit their submissions through the User Portal page.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_general_edit_time_wrap">
			<th><?php $this->ui->generate_label( 'settings[general][edit_time]', __( 'Edit Time Limit (in hours)', 'ipt_fsqm' ) ); ?></th>
			<td><?php $this->ui->spinner( 'settings[general][edit_time]', $this->settings['general']['edit_time'], __( 'Always', 'ipt_fsqm' ) ); ?></td>
			<td><?php $this->ui->help( __( 'Limit the edit time in hours. Can be fraction. Also a zero value or an empty or a negative value means unlimited.', 'ipt_fsqm' ) ); ?></td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function user() {
		$op = $this->settings['user'];
?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][notification_email]', __( 'Sender\'s Email', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[user][notification_email]', $op['notification_email'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the email which the user will see as the Sender\'s Email on the email he/she receives. It is recommended to use an email from the same domain. Otherwise it might end up into spams. Entering an empty email will stop the user notification service. So leave it empty to disable sending emails to users.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][notification_from]', __( 'Sender\'s Name', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[user][notification_from]', $op['notification_from'], __( 'Enter sender\'s name', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the name which the user will see as the Sender\'s Name on the email he/she receives.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][notification_sub]', __( 'Notification Subject', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[user][notification_sub]', $op['notification_sub'], __( 'Enter the subject', 'ipt_fsqm' ), 'large' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the subject of the notification email of the user/surveyee.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][notification_msg]', __( 'Notification Message', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[user][notification_msg]', $op['notification_msg'], __( 'Enter the message', 'ipt_fsqm' ), 'large' ); ?>
			</td>
			<td>
				<div class="ipt_uif_msg">
					<a href="javascript:;" class="ipt_uif_msg_icon"></a>
					<div class="ipt_uif_msg_body">
						<?php _e( 'Enter the message that you want to send to the user/surveyee on form submission. Paragraphs and line breaks will be added automatically. In addition you can also put custom HTML code. You can use a few format strings which will be replaced by their corresponding values.', 'ipt_fsqm' ) ?>
						<ul class="ul-square">
							<li><strong>%NAME%</strong> : <?php _e( 'Will be replaced by the full name of the user.', 'ipt_fsqm' ); ?></li>
							<li><strong>%TRACK_LINK%</strong> : <?php _e( 'Will be replaced by the raw link from where the user can see the status of his submission.', 'ipt_fsqm' ); ?></li>
							<li><strong>%TRACK%</strong> : <?php _e( 'Will be replaced by a "Click Here" button linked to the track page.', 'ipt_fsqm' ); ?></li>
							<li><strong>%SCORE%</strong> : <?php _e( 'Will be replaced by the score obtained/total score.', 'ipt_fsqm' ); ?></li>
							<li><strong>%SCOREPERCENT%</strong> : <?php _e( 'Will be replaced by the percentage score obtained.', 'ipt_fsqm' ); ?></li>
							<li><strong>%DESIGNATION%</strong> : <?php _e( 'If the score falls under a valid ranking range, then this will be replaced by the given designation title.', 'ipt_fsqm' ); ?></li>
							<li><strong>%DESIGNATIONMSG%</strong> : <?php _e( 'If the score falls under a valid ranking range, then this will be replaced by the given designation message.', 'ipt_fsqm' ); ?></li>
							<li><strong>%TRACK_ID%</strong> : <?php _e( 'Will be replaced by the Tracking ID of the submission which the user can enter in the track page.', 'ipt_fsqm' ); ?></li>
							<li><strong>%SUBMISSION%</strong> : <?php _e( 'Will be replaced by a printable format of the submission.', 'ipt_fsqm' ); ?></li>
							<li><strong>%PORTAL%</strong> : <?php _e( 'Will be replaced by the raw link of the user portal page from where registered users can see all their submissions.', 'ipt_fsqm' ); ?></li>
						</ul>
						<?php _e( 'If you are using the %TRACK_LINK% make sure you have placed <code>[ipt_fsqm_track]</code> on some page/post and have entered it\'s ID in the settings section.', 'ipt_fsqm' ); ?>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][email_logo]', __( 'Email Logo', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->upload( 'settings[user][email_logo]', $op['email_logo'], '', __( 'Set Logo', 'ipt_fsqm' ), __( 'Choose Image', 'ipt_fsqm' ), __( 'Use Image', 'ipt_fsqm' ), '90%', '150px', 'auto' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Set the logo image that will be used in the email sent to the user. Image size should be 150X28px and with transparent background.', 'ipt_fsqm' ) ) ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][top_line]', __( 'Show the header line', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[user][top_line]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['top_line']); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If enabled then this will show a header line with link to the trackback page. Keep this enabled to allow users to view the submission through browser.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][show_submission]', __( 'Attach Submission to user email', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[user][show_submission]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['show_submission']); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If you want to attach the complete submission to the user email, then enable it here.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][view_online]', __( 'View Online Button', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[user][view_online]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['view_online']); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Show a button with view online text. It will be linked to the trackback page.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][view_online_text]', __( 'Button Text', 'ipt_fsqm' ) ); ?></th>
			<td><?php $this->ui->text( 'settings[user][view_online_text]', $op['view_online_text'], '', 'large' ); ?></td>
			<td><?php $this->ui->help( __( 'The text of the button.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][footer_msg]', __( 'Email Footer Message', 'ipt_fsqm' ) ); ?></th>
			<td><?php $this->ui->text( 'settings[user][footer_msg]', $op['footer_msg'], '', 'large' ); ?></td>
			<td><?php $this->ui->help( __( 'The footer message of the email. This is usually unscription link or instruction.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[user][smtp]', __( 'Use SMTP Emailing', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[user][smtp]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['smtp'], '1', false, true, array(
					'condid' => 'ipt_fsqm_form_settings_smtp_enc_type_wrap,ipt_fsqm_form_settings_smtp_host_wrap,ipt_fsqm_form_settings_smtp_port_wrap,ipt_fsqm_form_settings_smtp_username_wrap,ipt_fsqm_form_settings_smtp_password_wrap'
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If you want to send email using SMTP method then enable it here and enter the settings.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_form_settings_smtp_enc_type_wrap">
			<th><?php $this->ui->generate_label( 'settings[user][smtp_config][enc_type]', __( 'Encryption Type', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->select( 'settings[user][smtp_config][enc_type]', array(
					array(
						'value' => '',
						'label' => __( 'None', 'ipt_fsqm' ),
					),
					array(
						'value' => 'ssl',
						'label' => __( 'SSL', 'ipt_fsqm' ),
					),
					array(
						'value' => 'tls',
						'label' => __( 'TLS', 'ipt_fsqm' ),
					),
				), $op['smtp_config']['enc_type'] ); ?>
			</td>
			<td><?php $this->ui->help( __( 'For most servers SSL is the recommended option.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr id="ipt_fsqm_form_settings_smtp_host_wrap">
			<th><?php $this->ui->generate_label( 'settings[user][smtp_config][host]', __( 'SMTP Host', 'ipt_fsqm' ) ); ?></th>
			<td><?php $this->ui->text( 'settings[user][smtp_config][host]', $op['smtp_config']['host'], __( 'eg: smtp.gmail.com', 'ipt_fsqm' ), 'large' ); ?></td>
			<td><?php $this->ui->help( __( 'Enter the host of your SMTP server.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr id="ipt_fsqm_form_settings_smtp_port_wrap">
			<th><?php $this->ui->generate_label( 'settings[user][smtp_config][port]', __( 'SMTP port', 'ipt_fsqm' ) ); ?></th>
			<td><?php $this->ui->spinner( 'settings[user][smtp_config][port]', $op['smtp_config']['port'], __( 'Port', 'ipt_fsqm' ) ); ?></td>
			<td><?php $this->ui->help( __( 'Enter the port of your SMTP server.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr id="ipt_fsqm_form_settings_smtp_username_wrap">
			<th><?php $this->ui->generate_label( 'settings[user][smtp_config][username]', __( 'SMTP Username', 'ipt_fsqm' ) ); ?></th>
			<td><?php $this->ui->text( 'settings[user][smtp_config][username]', $op['smtp_config']['username'], __( 'eg: smtp.gmail.com', 'ipt_fsqm' ), 'large' ); ?></td>
			<td><?php $this->ui->help( __( 'Enter the username you use to login.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<?php $password = $op['smtp_config']['password']; ?>
		<?php if ( $password != '' ) $password = $this->decrypt( $password ); ?>
		<tr id="ipt_fsqm_form_settings_smtp_password_wrap">
			<th><?php $this->ui->generate_label( 'settings[user][smtp_config][password]', __( 'SMTP password', 'ipt_fsqm' ) ); ?></th>
			<td><?php $this->ui->password( 'settings[user][smtp_config][password]', $password, 'large' ); ?></td>
			<td><?php $this->ui->help( __( 'Enter the password you use to login. Please note that it is always encrypted before storing in database.', 'ipt_fsqm' ) ); ?></td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function admin() {
		$op = $this->settings['admin'];
?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][email]', __( 'Admin Notification Email', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[admin][email]', $op['email'], __( 'Enter admin email', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the email address where the notification email will be sent. Make sure you have set anti-spam filter for wordpress@yourdomain.tld otherwise automated emails might go into spam folder.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][email_logo]', __( 'Email Logo', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->upload( 'settings[admin][email_logo]', $op['email_logo'], '', __( 'Set Logo', 'ipt_fsqm' ), __( 'Choose Image', 'ipt_fsqm' ), __( 'Use Image', 'ipt_fsqm' ), '90%', '150px', 'auto' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Set the logo image that will be used in the email sent to the admin. Image size should be 150X28px and with transparent background.', 'ipt_fsqm' ) ) ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][sub]', __( 'New Submission Notification Subject', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[admin][sub]', $op['sub'], __( 'Enter Subject Line', 'ipt_fsqm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter a descriptive and short subject line. The following format strings are available.<ul><li><code>%FORMNAME%</code> Will be replaced by the name of the form.</li><li><code>%SITENAME%</code> Will be replaced by the name of the site.</li></ul>', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][usub]', __( 'Update Notification Subject', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[admin][usub]', $op['usub'], __( 'Enter Subject Line', 'ipt_fsqm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter a descriptive and short subject line. The following format strings are available.<ul><li><code>%FORMNAME%</code> Will be replaced by the name of the form.</li><li><code>%SITENAME%</code> Will be replaced by the name of the site.</li></ul>', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][fsub]', __( 'Feedback Notification Subject', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[admin][fsub]', $op['fsub'], __( 'Enter Subject Line', 'ipt_fsqm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter a descriptive and short subject line. The following format strings are available.<ul><li><code>%FORMNAME%</code> Will be replaced by the name of the form.</li><li><code>%ENAME%</code> Will be replaced by the title of the element.</li><li><code>%SITENAME%</code> Will be replaced by the name of the site.</li></ul>', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][top_line]', __( 'Show the header line', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[admin][top_line]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['top_line']); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If enabled then this will show a header line with link to the admin management page.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][summary_header]', __( 'Show form information on general admin email', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[admin][summary_header]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['summary_header']); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If enabled then this will show basic form information.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][f_summary_header]', __( 'Show form information on feedback email', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[admin][f_summary_header]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['f_summary_header']); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If enabled then this will show basic form information.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][user_info]', __( 'Show user information on general admin email', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[admin][user_info]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['user_info']); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If enabled then this will show basic user information.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][f_user_info]', __( 'Show user information on feedback email', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[admin][f_user_info]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['f_user_info']); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If enabled then this will show basic user information.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][body]', __( 'New Submission Notification Message', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[admin][body]', $op['body'], __( 'Enter message', 'ipt_fsqm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter a descriptive admin notification message here. <code>%ADMINLINK%</code> will be replaced by administrative link for the submission.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][ubody]', __( 'Submission Update Notification Message', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[admin][ubody]', $op['ubody'], __( 'Enter message', 'ipt_fsqm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter a descriptive admin notification message here. <code>%ADMINLINK%</code> will be replaced by administrative link for the submission.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][mail_submission]', __( 'Email Submission to Admin', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[admin][mail_submission]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['mail_submission'] ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Tick this, if you wish to send the full submission detail to the admin email', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][send_from_user]', __( 'Email on behalf of User', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[admin][send_from_user]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['send_from_user'] ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Tick this, if you wish to receive the email on behalf of the user. Otherwise email is sent from the WordPress email.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[admin][footer]', __( 'Admin Notification Footer Message', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[admin][footer]', $op['footer'], __( 'Enter admin footer message', 'ipt_fsqm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter a descriptive admin notification footer message here.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function limitation() {
		$op = $this->settings['limitation'];
		$login_select = array(
			0 => array(
				'label' => __( 'Show Login Form', 'ipt_fsqm' ),
				'value' => 'show_login',
			),
			1 => array(
				'label' => __( 'Redirect to the mentioned page', 'ipt_fsqm' ),
				'value' => 'redirect',
			),
		);
?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[limitation][email_limit]', __( 'Submission Limit Per Email', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->spinner( 'settings[limitation][email_limit]', $op['email_limit'], __( '0 to disable', 'ipt_fsqm' ), '0' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Select the maximum number of submissions per email address. Leave 0 to disable this check.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[limitation][ip_limit]', __( 'Submission Limit Per IP Address', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->spinner( 'settings[limitation][ip_limit]', $op['ip_limit'], __( '0 to disable', 'ipt_fsqm' ), '0' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Select the maximum number of submissions per IP address. Leave 0 to disable this check.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[limitation][user_limit]', __( 'Submission Limit Per Registered User', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->spinner( 'settings[limitation][user_limit]', $op['user_limit'], __( '0 to disable', 'ipt_fsqm' ), '0' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Select the maximum number of submissions per registered user. Leave 0 to disable this check.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[limitation][user_limit_msg]', __( 'Message Shown to Registered Users', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[limitation][user_limit_msg]', $op['user_limit_msg'], __( 'Please enter a message', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter a message you want to show to registered users who has exceeded their limit. Use placeholder <code>%PORTAL_LINK%</code> to replace it by User Portal Page permalink.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[limitation][total_limit]', __( 'Total Submission Limit', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->spinner( 'settings[limitation][total_limit]', $op['total_limit'], __( '0 to disable', 'ipt_fsqm' ), '0' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Select the maximum number of overall submissions for the form. Leave 0 to disable this check.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[limitation][total_limit_msg]', __( 'Message Shown to Exceeded Total Limit', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[limitation][total_limit_msg]', $op['total_limit_msg'], __( 'Please enter a message', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter a message you want to show to users when the limit has exceeded.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[limitation][logged_in]', __( 'Only Logged In user can submit', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[limitation][logged_in]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['logged_in'], '1', false, true, array(
					'condID' => 'ipt_fsqm_settings_limitation_logged_in_fb_wrap,ipt_fsqm_settings_limitation_nlr_wrap',
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If enabled, then only logged in users can access the form. If the user is not logged in, then the fallback action is performed.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_settings_limitation_logged_in_fb_wrap">
			<th><?php $this->ui->generate_label( 'settings[limitation][logged_in_fallback]', __( 'What to do when user not logged in', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->select( 'settings[limitation][logged_in_fallback]', $login_select, $op['logged_in_fallback'] ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Please select what to do when the user is not logged in. Choosing Show Form will print a FSQM Styled (with the same theme as this form) login form. If you use some other login system, then you can redirect to that system page using the redirect option.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_settings_limitation_nlr_wrap">
			<th><?php $this->ui->generate_label( 'settings[limitation][non_logged_redirect]', __( 'Redirection URL', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[limitation][non_logged_redirect]', $op['non_logged_redirect'], __( 'Enter URL', 'ipt_fsqm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the redirection URL. You can have the placeholder <code>_self_</code> which will be replaced by the current URL.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function buttons() {
		$op = $this->settings['buttons'];
?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[buttons][next]', __( 'Next Button Label', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[buttons][next]', $op['next'], __( 'Enter the label', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the label of the next button', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[buttons][prev]', __( 'Previous Button Label', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[buttons][prev]', $op['prev'], __( 'Enter the label', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the label of the previous button', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[buttons][submit]', __( 'Submit Button Label', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[buttons][submit]', $op['submit'], __( 'Enter the label', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the label of the submit button', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[buttons][reset]', __( 'Reset Button Label', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[buttons][reset]', $op['reset'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enter the label of the reset button. It will be shown using an icon, with the label as title.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
		$this->build_conditional( 'settings[buttons]', $op['conditional'], __( 'Conditional Logic for Submit Button', 'ipt_fsqm' ) );
	}

	public function save_progress() {
		$op = $this->settings['save_progress'];
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[save_progress][auto_save]', __( 'Auto Save Form Progress', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[save_progress][auto_save]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['auto_save'] ); ?>
			</td>
			<td><?php $this->ui->help( __( 'Enabling this will automatically save user inputs on the client (user\'s) machine. So, even if they close and want to resume later, it would be possible. Do note that auto saving of file uploads is not possible right now.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[save_progress][show_restore]', __( 'Show Restore Message', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[save_progress][show_restore]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['show_restore'] ); ?>
			</td>
			<td><?php $this->ui->help( __( 'Enabling this would show a restore message to user. And it will also place a button with which user can reset the form.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[save_progress][restore_head]', __( 'Restore Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[save_progress][restore_head]', $op['restore_head'], __( 'Enter title', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'This title will be shown above the restore message.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[save_progress][restore_msg]', __( 'Restore Message', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[save_progress][restore_msg]', $op['restore_msg'], __( 'Enter message', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'The auto restore message that is shown to the user.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[save_progress][restore_reset]', __( 'Restore Reset Button', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[save_progress][restore_reset]', $op['restore_reset'], __( 'Button Text', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Clicking on this button would reset the form.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function submission() {
		$op = $this->settings['submission'];
?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[submission][no_auto_complete]', __( 'Prevent Form Auto Complete', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[submission][no_auto_complete]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['no_auto_complete'] ); ?>
			</td>
			<td><?php $this->ui->help( __( 'Enabling this will prevent form field auto complete from previous entries and page refresh. This will impact all form elements globally and enabling it is not recommended.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[submission][url_track]', __( 'Track Submission from URL data', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[submission][url_track]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['url_track'] ); ?>
			</td>
			<td><?php $this->ui->help( __( 'Enabling this will give you an option to share the form URL with optional query parameter like <code>http://path.to/form/?url_track_key=value</code>, where <code>value</code> will be stored as the URL track code. You can later filter submissions from the admin side.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[submission][url_track_key]', __( 'Key Parameter of URL Tracking', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[submission][url_track_key]', $op['url_track_key'], __( 'URL Query Key Parameter', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Set the key of the URL tracking. Depending on this, you will need to work out the URL.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[submission][process_title]', __( 'Processing Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[submission][process_title]', $op['process_title'], __( 'Shown when ajax submission in progress', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'This title will be shown above the ajax bar during form submission.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[submission][success_title]', __( 'Success Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[submission][success_title]', $op['success_title'], __( 'Shown when successfully submitted', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'This title will be shown above the success message.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[submission][success_message]', __( 'Success Message', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[submission][success_message]', $op['success_message'], __( 'Fullbody message', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help_head(); ?>
				<p><?php _e( 'This message will be shown to the users when they submit the form.', 'ipt_fsqm' ); ?></p>
				<p><?php _e( 'While entering the Message, you have the following format strings available.', 'ipt_fsqm' ); ?></p>
				<ul class="ul-square">
					<li><strong>%NAME%</strong> : <?php _e( 'Will be replaced by the full name of the user.', 'ipt_fsqm' ); ?></li>
					<li><strong>%TRACK_LINK%</strong> : <?php _e( 'Will be replaced by the raw link from where the user can see the status of his submission.', 'ipt_fsqm' ); ?></li>
					<li><strong>%TRACK%</strong> : <?php _e( 'Will be replaced by a "Click Here" button linked to the track page.', 'ipt_fsqm' ); ?></li>
					<li><strong>%SCORE%</strong> : <?php _e( 'Will be replaced by the score obtained/total score.', 'ipt_fsqm' ); ?></li>
					<li><strong>%SCOREPERCENT%</strong> : <?php _e( 'Will be replaced by the percentage score obtained.', 'ipt_fsqm' ); ?></li>
					<li><strong>%DESIGNATION%</strong> : <?php _e( 'If the score falls under a valid ranking range, then this will be replaced by the given designation title.', 'ipt_fsqm' ); ?></li>
					<li><strong>%DESIGNATIONMSG%</strong> : <?php _e( 'If the score falls under a valid ranking range, then this will be replaced by the given designation message.', 'ipt_fsqm' ); ?></li>
					<li><strong>%TRACK_ID%</strong> : <?php _e( 'Will be replaced by the Tracking ID of the submission which the user can enter in the track page.', 'ipt_fsqm' ); ?></li>
					<li><strong>%PORTAL%</strong> : <?php _e( 'Will be replaced by the raw link of the user portal page from where registered users can see all their submissions.', 'ipt_fsqm' ); ?></li>
				</ul>
				<p><?php _e( 'Please note that the designation related format string might only work if you have ranking system enabled and the user score falls under a valid ranking range. Head to Ranking System to use this feature.', 'ipt_fsqm' ); ?></p>
				<?php $this->ui->help_tail(); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[submission][log_ip]', __( 'Log IP Address', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[submission][log_ip]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['log_ip'] ); ?>
			</td>
			<td><?php $this->ui->help( __( 'Enable to log user\'s IP Address.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[submission][log_registered_user]', __( 'Log Registered Users', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[submission][log_registered_user]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['log_registered_user'] ); ?>
			</td>
			<td><?php $this->ui->help( __( 'Enable to log registered user accounts during submission.', 'ipt_fsqm' ) ); ?></td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function redirect() {
		$items = array();
		$items[] = array(
			'value' => 'none',
			'label' => __( 'No Redirection', 'ipt_fsqm' ),
			'data' => array(
				'condid' => 'redirect_none',
			),
		);
		$items[] = array(
			'value' => 'flat',
			'label' => __( 'Flat Redirection', 'ipt_fsqm' ),
			'data' => array(
				'condid' => 'redirect_url,redirect_delay',
			),
		);
		$items[] = array(
			'value' => 'score',
			'label' => __( 'Score Based Redirection', 'ipt_fsqm' ),
			'data' => array(
				'condid' => 'redirect_url,redirect_delay,redirect_score',
			),
		);
?>
<div class="ipt_uif_msg ipt_uif_float_right">
	<a href="javascript:;" class="ipt_uif_msg_icon" title="<?php _e( 'Redirection', 'ipt_fsqm' ); ?>"></a>
	<div class="ipt_uif_msg_body">
		<p><?php _e( 'Please select the type of the redirection. Each redirection has it\'s own different sets of options.', 'ipt_fsqm' ); ?></p>
		<h3><?php _e( 'Redirection URL', 'ipt_fsqm' ); ?></h3>
		<ul class="ul-square">
			<li>
				<?php _e( 'The page will be redirected to the mentioned URL for flat redirection.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'The Redirection URL for Score based redirection will be used if the score does not satisfy any of the conditions.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'You can use the format string <code>%TRACKBACK%</code> to redirect the user to the results page. You need to have a valid trackback page set on the settings for this to work.', 'ipt_fsqm' ); ?>
			</li>
		</ul>
		<h3><?php _e( 'Score Range', 'ipt_fsqm' ); ?></h3>
		<ul class="ul-square">
			<li>
				<?php _e( 'Select the range of the score (in terms of percentage, which will be calculated automatically) and mentioned the redirection URL.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'All the ranges are inclusive.', 'ipt_fsqm' ); ?>
			</li>
			<li>
				<?php _e( 'If more than one range overlaps for a score, then the first range found in the list will be used.', 'ipt_fsqm' ); ?>
			</li>
		</ul>
	</div>
</div>
		<?php
		$this->ui->radios( 'settings[redirection][type]', $items, $this->settings['redirection']['type'], false, true );

		$this->ui->div( 'clear', array( $this->ui, 'clear' ), 0, 'redirect_none' );
		$this->ui->shadowbox( array( 'glowy', 'cyan' ), array( $this, 'redirect_url' ), 0, 'redirect_url' );
		$this->ui->shadowbox( array( 'glowy', 'cyan' ), array( $this, 'redirect_delay' ), 0, 'redirect_delay' );
		$this->ui->div( '', array( $this, 'redirect_score' ), 0, 'redirect_score' );
	}

	public function redirect_delay() {
?>
	<table class="form-table">
		<tbody>
			<tr>
				<th><?php $this->generate_label( 'settings[redirection][delay]', __( 'Redirection Delay', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->slider( 'settings[redirection][delay]', $this->settings['redirection']['delay'], 0, 10000, 100 ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Select the delay to the redirection in milliseconds. A value somewhere between 1000 and 5000 is recommended.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->generate_label( 'settings[redirection][message]', __( 'Custom Message', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->textarea( 'settings[redirection][message]', $this->settings['redirection']['message'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Set a custom message that will be shown below any notification. <code>%LINK%</code> will be replaced by the redirection link and <code>%TIME%</code> will be replaced by time (in seconds). Leave empty to disable this feature.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( 'settings[redirection][top]', __( 'Redirect Parent from iFrame', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( 'settings[redirection][top]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $this->settings['redirection']['top'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If you are planning to load this form inside iFrame, then enabling this option will redirect the parent page, not just the iFrame. Useful to put sidebar widgets as iframe.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
		<?php
	}

	public function redirect_url() {
		$this->ui->text( 'settings[redirection][url]', $this->settings['redirection']['url'], __( 'Enter the Redirection URL', 'ipt_fsqm' ), 'large' );
	}

	public function redirect_score() {
		$settings = array(
			'columns' => array(
				0 => array(
					'label' => __( 'Score Range', 'ipt_fsqm' ),
					'size' => '60',
					'type' => 'slider_range',
				),
				1 => array(
					'label' => __( 'Redirect URL', 'ipt_fsqm' ),
					'size' => '30',
					'type' => 'text',
				),
			),
			'labels' => array(
				'add' => __( 'Add New Range', 'ipt_fsqm' ),
			),
		);
		$items = array();
		$max_key = null;
		foreach ( $this->settings['redirection']['score'] as $s_key => $score ) {
			$max_key = max( array( $max_key, $s_key ) );
			$items[] = array(
				0 => array( 'settings[redirection][score][' . $s_key . ']', array( $score['min'], $score['max'] ), 0, 100.001, 0.01, '%' ),
				1 => array( 'settings[redirection][score][' . $s_key . '][url]', $score['url'], __( 'Enter the Redirect URL', 'ipt_fsqm' ), 'large' ),
			);
		}
		$data = array(
			0 => array( 'settings[redirection][score][__SDAKEY__]', array( 10, 80 ), 0, 100.001, 0.01, '%' ),
			1 => array( 'settings[redirection][score][__SDAKEY__][url]', '', __( 'Enter the Redirect URL', 'ipt_fsqm' ), 'large' ),
		);
		$this->ui->sda_list( $settings, $items, $data, $max_key );
	}

	public function theme() {
		$op = $this->settings['theme'];
		$web_fonts = $this->get_available_webfonts();
		$themes = $this->get_available_themes();
?>
<table class="form-table">
	<tbody>
		<tr>
			<th style="width: 150px;"><?php $this->ui->generate_label( 'settings[theme][template]', __( 'Select Theme', 'ipt_fsqm' ) ); ?></th>
			<td>
				<select name="settings[theme][template]" id="<?php echo $this->generate_id_from_name( 'settings[theme][template]' ); ?>" class="ipt_uif_select ipt_uif_theme_selector">
					<?php foreach ( $themes as $theme_grp ) : ?>
					<optgroup label="<?php echo $theme_grp['label']; ?>">
						<?php foreach ( $theme_grp['themes'] as $theme_key => $theme ) : ?>
						<option data-colors="<?php echo esc_attr( isset( $theme['colors'] ) ? json_encode( $theme['colors'] ) : json_encode( array() ) ); ?>" value="<?php echo $theme_key; ?>"<?php if ( $op['template'] == $theme_key ) echo ' selected="selected"'; ?>><?php echo $theme['label']; ?></option>
						<?php endforeach; ?>
					</optgroup>
					<?php endforeach; ?>
				</select>
				<div class="ipt_uif_theme_preview"></div>
			</td>
			<td style="width: 50px;">
				<?php $this->ui->help( __( 'Select a theme for this form.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th style="width: 150px"><?php $this->ui->generate_label( 'settings[theme][logo]', __( 'Add a header image/logo', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->upload( 'settings[theme][logo]', $op['logo'], '', __( 'Set Header', 'ipt_fsqm' ), __( 'Choose Image', 'ipt_fsqm' ), __( 'Use Image', 'ipt_fsqm' ), '90%', '150px', 'auto' ); ?>
			</td>
			<td style="width: 50px">
				<?php $this->ui->help( __( 'You can put a logo or header image right before the form if you want. This will shown on the form page, trackback page, emails and also on standalone pages.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th style="width: 150px;"><?php $this->ui->generate_label( 'settings[theme][waypoint]', __( 'Animated Form Elements', 'ipt_fsqm' ) ); ?></th>
			<td>
			<?php $this->ui->toggle( 'settings[theme][waypoint]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['waypoint'], '1' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Select Yes to create an animating form with CSS3 animation. The form elements will fade and slide once they enter the viewport. Great way to attract user attention.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th style="width: 150px;"><?php $this->ui->generate_label( 'settings[theme][custom_style]', __( 'Customize Styles and Fonts', 'ipt_fsqm' ) ); ?></th>
			<td>
			<?php $this->ui->toggle( 'settings[theme][custom_style]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['custom_style'], '1', false, true, array(
				'condid' => 'ipt_fsqm_form_settings_theme_style_head_font_wrap,ipt_fsqm_form_settings_theme_style_body_font_wrap,ipt_fsqm_form_settings_theme_style_font_size_wrap,ipt_fsqm_form_settings_theme_style_font_typo_wrap,ipt_fsqm_form_settings_theme_style_custom_wrap'
			) ); ?>
			</td>
			<td style="width: 50px;">
				<?php $this->ui->help( __( 'If you wish then you can change fonts and also put your own css code.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_form_settings_theme_style_head_font_wrap">
			<th style="width: 150px;"><?php $this->ui->generate_label( 'settings[theme][style][head_font]', __( 'Heading Font', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->webfonts( 'settings[theme][style][head_font]', $op['style']['head_font'], $web_fonts ); ?>
			</td>
			<td style="width: 50px;">
				<?php $this->ui->help( __( 'Select the font.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_form_settings_theme_style_body_font_wrap">
			<th style="width: 150px;"><?php $this->ui->generate_label( 'settings[theme][style][body_font]', __( 'Body Font', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->webfonts( 'settings[theme][style][body_font]', $op['style']['body_font'], $web_fonts ); ?>
			</td>
			<td style="width: 50px;">
				<?php $this->ui->help( __( 'Select the font.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_form_settings_theme_style_font_size_wrap">
			<th><?php $this->ui->generate_label( 'settings[theme][style][base_font_size]', __( 'Base Font Size', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->slider( 'settings[theme][style][base_font_size]', $op['style']['base_font_size'], 10, 20 ); ?>
			</td>
			<td style="width: 50px;">
				<?php $this->ui->help( __( 'Select the base font size. Rest of the sizes will be calculated automatically.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_form_settings_theme_style_font_typo_wrap">
			<th><?php $this->ui->generate_label( '', __( 'Heading Font Customization', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->checkbox( 'settings[theme][style][head_font_typo][bold]', array(
					'label' => __( 'Bold', 'ipt_fsqm' ),
					'value' => '1',
				), $op['style']['head_font_typo']['bold'] ); ?>
				<div class="clear"></div>
				<?php $this->ui->checkbox( 'settings[theme][style][head_font_typo][italic]', array(
					'label' => __( 'Italic', 'ipt_fsqm' ),
					'value' => '1',
				), $op['style']['head_font_typo']['italic'] ); ?>
			</td>
			<td><?php $this->ui->help( __( 'Make the heading fonts bold or italic.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr id="ipt_fsqm_form_settings_theme_style_custom_wrap">
			<th><?php $this->ui->generate_label( 'settings[theme][style][custom]', __( 'Custom CSS', 'ipt_fsqm' ) ); ?></th>
			<td><?php $this->ui->textarea( 'settings[theme][style][custom]', $op['style']['custom'], __( 'CSS Code', 'ipt_fsqm' ), 'widefat', array( 'code' ) ); ?></td>
			<td><?php $this->ui->help( __( 'If you are an advanced user and would like to put your own CSS, then this is where you can do so. Please consider having a CSS scope of <code>body #ipt_fsqm_form_wrap_{form_id}</code> to modify only this form.', 'ipt_fsqm' ) ); ?></td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function ranking() {
		$op = $this->settings['ranking'];
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[ranking][precision]', __( 'Percentage Decimal Precision', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->spinner( 'settings[ranking][precision]', $op['precision'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
			</td>
			<td><?php $this->ui->help( __( 'Enter Image Width, in pixels.', 'ipt_fsqm' ) ); ?></td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[ranking][enabled]', __( 'Enable Ranking System based on Score', 'ipt_fsqm' ) ); ?></th>
			<td>
			<?php $this->ui->toggle( 'settings[ranking][enabled]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['enabled'], '1', false, true, array(
				'condid' => 'ipt_fsqm_ranking_title_wrap,ipt_fsqm_ranking_ranks_wrap'
			) ); ?>
			</td>
			<td style="width: 50px;">
				<?php $this->ui->help_head(); ?>
				<p><?php _e( 'If you wish to designate some rank to your users based on score, then enable this system. You will have option to put titles and custom messages for each of the designations.', 'ipt_fsqm' ); ?></p>
				<p><?php _e( 'While entering the Message, you have the following format strings available.', 'ipt_fsqm' ); ?></p>
				<ul class="ul-square">
					<li><strong>%NAME%</strong> : <?php _e( 'Will be replaced by the full name of the user.', 'ipt_fsqm' ); ?></li>
					<li><strong>%TRACK_LINK%</strong> : <?php _e( 'Will be replaced by the raw link from where the user can see the status of his submission.', 'ipt_fsqm' ); ?></li>
					<li><strong>%TRACK%</strong> : <?php _e( 'Will be replaced by a "Click Here" button linked to the track page.', 'ipt_fsqm' ); ?></li>
					<li><strong>%SCORE%</strong> : <?php _e( 'Will be replaced by the score obtained/total score.', 'ipt_fsqm' ); ?></li>
					<li><strong>%SCOREPERCENT%</strong> : <?php _e( 'Will be replaced by the percentage score obtained.', 'ipt_fsqm' ); ?></li>
					<li><strong>%DESIGNATION%</strong> : <?php _e( 'If the score falls under a valid ranking range, then this will be replaced by the given designation title.', 'ipt_fsqm' ); ?></li>
					<li><strong>%TRACK_ID%</strong> : <?php _e( 'Will be replaced by the Tracking ID of the submission which the user can enter in the track page.', 'ipt_fsqm' ); ?></li>
				</ul>
				<?php $this->ui->help_tail(); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_ranking_title_wrap">
			<th><?php $this->ui->generate_label( 'settings[ranking][title]', __( 'Ranking Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[ranking][title]', $op['title'], __( 'Shown on Rank Column on trackback page', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'The title of the ranking system. For eg, Designation.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_ranking_ranks_wrap">
			<td colspan="3">
				<?php $this->ranking_ranks(); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function ranking_ranks() {
		$op = $this->settings['ranking']['ranks'];
		$settings = array(
			'columns' => array(
				0 => array(
					'label' => __( 'Score Rangea', 'ipt_fsqm' ),
					'size' => '35',
					'type' => 'slider_range',
				),
				1 => array(
					'label' => __( 'Designation', 'ipt_fsqm' ),
					'size' => '20',
					'type' => 'text',
				),
				2 => array(
					'label' => __( 'Message', 'ipt_fsqm' ),
					'size' => '35',
					'type' => 'textarea',
				),
			),
			'labels' => array(
				'add' => __( 'Add New Rank', 'ipt_fsqm' ),
			),
		);
		$items = array();
		$max_key = null;
		foreach ( $op as $r_key => $rank ) {
			$max_key = max( array( $max_key, $r_key ) );
			$items[] = array(
				0 => array( 'settings[ranking][ranks][' . $r_key . ']', array( $rank['min'], $rank['max'] ), 0, 100.001, 0.01, '%' ),
				1 => array( 'settings[ranking][ranks][' . $r_key . '][title]', $rank['title'], __( 'Rank Designation', 'ipt_fsqm' ), 'fit' ),
				2 => array( 'settings[ranking][ranks][' . $r_key . '][msg]', $rank['msg'], __( 'Message Shown', 'ipt_fsqm' ), 'fit' ),
			);
		}
		$data = array(
			0 => array( 'settings[ranking][ranks][__SDAKEY__]', array( 10, 80 ), 0, 100.001, 0.01, '%' ),
			1 => array( 'settings[ranking][ranks][__SDAKEY__][title]', '', __( 'Rank Designation', 'ipt_fsqm' ), 'fit' ),
			2 => array( 'settings[ranking][ranks][__SDAKEY__][msg]', '', __( 'Message Shown', 'ipt_fsqm' ), 'fit' ),
		);
		$this->ui->sda_list( $settings, $items, $data, $max_key );
	}

	public function timer() {
		$op = $this->settings['timer'];
		$select_types = array(
			0 => array(
				'value' => 'none',
				'label' => __( 'Disabled', 'ipt_fsqm' ),
			),
			1 => array(
				'value' => 'overall',
				'label' => __( 'Overall Time Limit', 'ipt_fsqm' ),
				'data' => array( 'condid' => 'ipt_fsqm_timer_overall_limit_wrap' ),
			),
			2 => array(
				'value' => 'page_specific',
				'label' => __( 'Page Specific Time Limit', 'ipt_fsqm' ),
			),
		);
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[timer][time_limit_type]', __( 'Auto Submit Timer', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->select( 'settings[timer][time_limit_type]', $select_types, $op['time_limit_type'], false, true ); ?>
			</td>
			<td>
				<?php $this->ui->help_head(); ?>
				<p><?php _e( 'If you want the form to auto submit after a specified time, then enable it from here.', 'ipt_fsqm' ); ?></p>
				<p><?php _e('The auto submission can be of two type:', 'ipt_fsqm'); ?></p>
				<ol>
					<li><strong><?php _e('Overall Time Limit', 'ipt_fsqm'); ?></strong>: <?php _e('The whole of the form is submitted after the specified time (in seconds).', 'ipt_fsqm'); ?></li>
					<li><strong><?php _e('Page Specific Time Limit', 'ipt_fsqm'); ?></strong>: <?php _e('Each of the pages/tabs/containers are automatically progressed after the specified time (in seconds). If this is selected, then it would automatically disable pagination to left.', 'ipt_fsqm'); ?></li>
				</ol>
				<?php $this->ui->help_tail(); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_timer_overall_limit_wrap">
			<th><?php $this->ui->generate_label( 'settings[timer][overall_limit]', __( 'Overall Time Limit (seconds)', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->spinner( 'settings[timer][overall_limit]', $op['overall_limit'], __( 'Seconds', 'ipt_fsqm' ), '0' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Set the total time in seconds after which the form will auto submit.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function summary() {
		$op = $this->settings['summary'];
		$booleans = array(
			'f_name' => __( 'Show First Name', 'ipt_fsqm' ),
			'l_name' => __( 'Show Last Name', 'ipt_fsqm' ),
			'email' => __( 'Show Email', 'ipt_fsqm' ),
			'phone' => __( 'Show Phone', 'ipt_fsqm' ),
			'ip' => __( 'Show IP Address', 'ipt_fsqm' ),
			'total_score' => __( 'Show Total Score', 'ipt_fsqm' ),
			'designation' => __( 'Show Designation', 'ipt_fsqm' ),
			'user_account' => __( 'Show User Account', 'ipt_fsqm' ),
			'link' => __( 'Show Trackback Link', 'ipt_fsqm' ),
			'individual_score' => __( 'Show Individual Scores for elements', 'ipt_fsqm' ),
			'hide_options' => __( 'Hide Unselected Options', 'ipt_fsqm' ),
			'highlight_correct' => __( 'Highlight Correct Option (with max score)', 'ipt_fsqm' ),
		);
		?>
<table class="form-table">
	<tbody>
		<?php foreach ( $booleans as $key => $val ) : ?>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[summary][' . $key . ']', $val ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[summary][' . $key . ']', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op[$key] ); ?>
			</td>
			<td></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[summary][score_title]', __( 'Individual Score Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[summary][score_title]', $op['score_title'], __( 'Write Here', 'ipt_fsqm' ), 'widefat', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'The title of the individual score cells.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[summary][tscore_title]', __( 'Total Score Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[summary][tscore_title]', $op['tscore_title'], __( 'Write Here', 'ipt_fsqm' ), 'widefat', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'The title of the total score cell.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[summary][before]', __( 'Before Summary (HTML)', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[summary][before]', $op['before'], __( 'Write Here', 'ipt_fsqm' ), 'widefat', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If you want anything to appear before the summary tables, then put it here.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[summary][after]', __( 'After Summary (HTML)', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[summary][after]', $op['after'], __( 'Write Here', 'ipt_fsqm' ), 'widefat', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If you want anything to appear after the summary tables, then put it here.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function trackback() {
		$op = $this->settings['trackback'];
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[trackback][show_full]', __( 'Show Full Submission', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[trackback][show_full]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['show_full'] ) ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enable if you want to show the full submission form with it\'s unchanged appearance. Do note that tabbed and paginated forms will be shown in a single page.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[trackback][full_title]', __( 'Full Submission Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[trackback][full_title]', $op['full_title'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( 'The title that is shown above the full submission. Leave empty to disable.', 'ipt_fsqm' ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[trackback][show_print]', __( 'Show Print Submission', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[trackback][show_print]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['show_print'] ) ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enable if you want to show the print submission summary. This is same as sent in the email and what ever settings you set in the summary area will reflect here.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[trackback][print_title]', __( 'Print Submission Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[trackback][print_title]', $op['print_title'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( 'The title that is shown above the print summary. Leave empty to disable.', 'ipt_fsqm' ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[trackback][show_trends]', __( 'Show Trends', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[trackback][show_trends]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['show_trends'] ) ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Whether to show a trends of the same form on the same page. This is to give the user a quick comparison look on his/her submission.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[trackback][trends_title]', __( 'Trends Title', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[trackback][trends_title]', $op['trends_title'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
			</td>
			<td>
				<?php $this->ui->help( 'The title shown before the trends/report.', 'ipt_fsqm' ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function email_template() {
		$op = $this->settings['email_template'];
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[email_template][accent_bg]', __( 'Accent Background Color', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->colorpicker( 'settings[email_template][accent_bg]', $op['accent_bg'] ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Choose accent background color. This is usually the background color of table headings.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[email_template][accent_color]', __( 'Accent Color', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->colorpicker( 'settings[email_template][accent_color]', $op['accent_color'] ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Choose accent color. This is usually the text color of table headings.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function social() {
		$op = $this->settings['social'];
		$texts = array(
			'facebook_app' => array( __( 'Facebook APP ID', 'ipt_fsqm' ), sprintf( __( 'Set the facebook app ID. This is required as only dialog feeds now support custom message and images. To learn about getting app id, <a target="_blank" href="%1$s">click here</a>.', 'ipt_fsqm' ), 'http://ipanelthemes.com/kb/misc/social-apps/creating-a-facebook-app-and-enabling-login/' ) ),
			'url' => array( __( 'URL of the Form', 'ipt_fsqm' ), __( 'Set the URL where the form is shown. If you use <code>%SELF%</code> then it will be replaced by the standalone link.', 'ipt_fsqm' ) ),
			'fb_url' => array( __( 'Facebook Redirect URL', 'ipt_fsqm' ), __( 'Set the URL where the user would be redirected after a successful share. Make sure the domain is in apps list.', 'ipt_fsqm' ) ),
			'title' => array( __( 'Share Title', 'ipt_fsqm' ), __( 'Set the share title. Using <code>%NAME%</code> will make use of the form name.', 'ipt_fsqm' ) ),
			'description' => array( __( 'Share Description', 'ipt_fsqm' ), __( 'Set the description that is used by facebook. It has the same set of format string available in notification emails.', 'ipt_fsqm' ) ),
			'twitter_via' => array( __( 'Twitter Via', 'ipt_fsqm' ), __( 'Set the name of the twitter profile via which the share is sent.', 'ipt_fsqm' ) ),
			'twitter_hash' => array( __( 'Twitter Hashtags', 'ipt_fsqm' ), __( 'Enter comma separated hashtags to be used in twitter share.', 'ipt_fsqm' ) ),
		);
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[social][show]', __( 'Show Social Share Buttons', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[social][show]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['show'], '1', false, true, array(
					'condid' => 'ipt_fsqm_social_image_wrap,ipt_fsqm_social_facebook_app_wrap,ipt_fsqm_social_url_wrap,ipt_fsqm_social_fb_url_wrap,ipt_fsqm_social_title_wrap,ipt_fsqm_social_description_wrap,ipt_fsqm_social_twitter_via_wrap,ipt_fsqm_social_twitter_hash_wrap'
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Enabling this setting will have effect on trackback pages, emails, success message and downloads (if using the exporter addon).', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_social_image_wrap">
			<th><?php $this->ui->generate_label( 'settings[social][image]', __( 'Share Image', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->upload( 'settings[social][image]', $op['image'], '', __( 'Set Image', 'ipt_fsqm' ), __( 'Choose Image', 'ipt_fsqm' ), __( 'Use Image', 'ipt_fsqm' ), '90%', '300px', 'auto' ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'The share image used mainly by facebook. If given, this will also render the pinterest link.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<?php foreach ( $texts as $key => $val ) : ?>
		<tr id="ipt_fsqm_social_<?php echo $key; ?>_wrap">
			<th><?php $this->ui->generate_label( 'settings[social][' . $key . ']', $val[0] ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[social][' . $key . ']', $op[$key], '', 'fit', 'normal', array('code') ); ?>
			</td>
			<td>
				<?php $this->ui->help( $val[1] ); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
		<?php
	}

	public function mailchimp() {
		$op = $this->settings['integration']['mailchimp'];
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[integration][mailchimp][enabled]', __( 'Enable MailChimp Integration', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[integration][mailchimp][enabled]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['enabled'], '1', false, true, array(
					'condid' => 'ipt_fsqm_intg_mc_api_wrap,ipt_fsqm_intg_mc_list_id_wrap,ipt_fsqm_intg_mc_double_optin_wrap,ipt_fsqm_intg_mc_send_welcome_wrap'
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If you want the submitter to get subscribed to a mailchimp list, please enable it here. After this, make sure you add the Email(DB) field to the form.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_mc_api_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][mailchimp][api]', __( 'MailChimp API Key', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[integration][mailchimp][api]', $op['api'], __( 'API Key', 'ipt_fsqm' ) ); ?>
				<br />
				<span class="description"><?php printf( __( 'Get it from <a href="%s" target="_blank">here</a>.', 'ipt_fsqm' ), 'http://kb.mailchimp.com/accounts/management/about-api-keys#Find-or-Generate-Your-API-Key' ); ?></span>
			</td>
			<td>
				<?php $this->ui->help( sprintf( __( 'Set MailChimp API Key. If you need to find your API key, please read <a target="_blank" href="%1$s">this article.</a>', 'ipt_fsqm' ), 'http://kb.mailchimp.com/accounts/management/about-api-keys#Find-or-Generate-Your-API-Key' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_mc_list_id_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][mailchimp][list_id]', __( 'MailChimp List ID', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[integration][mailchimp][list_id]', $op['list_id'], __( 'List ID', 'ipt_fsqm' ) ); ?>
				<br />
				<span class="description"><?php printf( __( 'Get it from <a href="%s" target="_blank">here</a>.', 'ipt_fsqm' ), 'http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id' ); ?></span>
			</td>
			<td>
				<?php $this->ui->help( sprintf( __( 'Set MailChimp List ID. If you need to find your List ID, please read <a href="%1$s">this article.</a>', 'ipt_fsqm' ), 'http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_mc_double_optin_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][mailchimp][double_optin]', __( 'Double Optin', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[integration][mailchimp][double_optin]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['double_optin'] ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Whether a double opt-in confirmation message is sent. <em>Abusing this may cause your account to be suspended.</em>', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_mc_send_welcome_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][mailchimp][send_welcome]', __( 'Send Welcome Message', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[integration][mailchimp][send_welcome]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['send_welcome'] ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Optional if Double Optin is false and if this is true, mailchimp will send your lists Welcome Email if this subscribe succeeds. If Double Optin is true, this has no effect.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function aweber() {
		$op = $this->settings['integration']['aweber'];
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[integration][aweber][enabled]', __( 'Enable Aweber Integration', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[integration][aweber][enabled]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['enabled'], '1', false, true, array(
					'condid' => 'ipt_fsqm_intg_aw_ac_wrap,ipt_fsqm_intg_aw_li_wrap,ipt_fsqm_intg_aw_info_wrap'
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If you want the submitter to get subscribed to a aweber list, please enable it here. After this, make sure you add the Email(DB) field to the form.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_aw_ac_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][aweber][authorization_code]', __( 'Aweber Authorization Code', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->textarea( 'settings[integration][aweber][authorization_code]', $op['authorization_code'], __( 'Authorization Code', 'ipt_fsqm' ) ); ?>
				<br />
				<span class="description">
					<?php printf( __( 'You can get it from <a target="_blank" href="%s">here.</a>', 'ipt_fsqm' ), 'https://auth.aweber.com/1.0/oauth/authorize_app/9d9d3517' ); ?>
				</span>
			</td>
			<td>
				<?php $this->ui->help( __( 'Set the authorization code you get after filling out the form from the link.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_aw_li_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][aweber][list_id]', __( 'List ID', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[integration][aweber][list_id]', $op['list_id'], __( 'List ID', 'ipt_fsqm' ) ); ?>
				<br />
				<span class="description"><?php printf( __( 'Get it from <a href="%s" target="_blank">here</a>.', 'ipt_fsqm' ), 'https://help.aweber.com/hc/en-us/articles/204028426-What-Is-The-Unique-List-ID-' ); ?></span>
			</td>
			<td>
				<?php $this->ui->help( __( 'Put Aweber List ID.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_aw_info_wrap">
			<td colspan="3">
				<?php if ( $op['accessKey'] != '' ) : ?>
				<span class="description"><?php _e( 'Aweber Connected Properly.', 'ipt_fsqm' ); ?></span>
				<?php else : ?>
				<span class="description">
					<?php _e( 'Either you have not entered a valid authorization code, or you have not setup aweber integration. Please give a valid authorization code, save the form and reload this page to see the status.', 'ipt_fsqm' ); ?>
				</span>
				<?php endif; ?>
			</td>
			<?php foreach ( array( 'consumerKey', 'consumerSecret', 'accessKey', 'accessSecret', 'prevac' ) as $aweber_key ) : ?>
				<input type="hidden" name="settings[integration][aweber][<?php echo esc_attr( $aweber_key ); ?>]" value="<?php echo esc_attr( $op[$aweber_key] ); ?>" />
			<?php endforeach; ?>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function get_response() {
		$op = $this->settings['integration']['get_response'];
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[integration][get_response][enabled]', __( 'Enable Get Response Integration', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[integration][get_response][enabled]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['enabled'], '1', false, true, array(
					'condid' => 'ipt_fsqm_intg_gr_api_wrap,ipt_fsqm_intg_gr_campaign_id_wrap'
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If you want the submitter to get subscribed to a Get Response list, please enable it here. After this, make sure you add the Email(DB) field to the form.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_gr_api_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][get_response][api]', __( 'Get Response API Key', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[integration][get_response][api]', $op['api'], __( 'API Key', 'ipt_fsqm' ) ); ?>
				<br />
				<span class="description"><?php printf( __( 'Get it from <a href="%s" target="_blank">here</a>.', 'ipt_fsqm' ), 'http://support.getresponse.com/faq/where-i-find-api-key' ); ?></span>
			</td>
			<td>
				<?php $this->ui->help( sprintf( __( 'Set Get Response API Key. If you need to find your API key, please read <a target="_blank" href="%1$s">this article.</a>', 'ipt_fsqm' ), 'http://support.getresponse.com/faq/where-i-find-api-key' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_gr_campaign_id_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][get_response][campaign_id]', __( 'Campaign Name', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[integration][get_response][campaign_id]', $op['campaign_id'], __( 'Campaign ID', 'ipt_fsqm' ) ); ?>
				<br />
				<span class="description"><?php printf( __( 'Get it from <a href="%s" target="_blank">here</a>.', 'ipt_fsqm' ), 'http://support.getresponse.com/faq/how-do-i-create-a-new-campaign' ); ?></span>
			</td>
			<td>
				<?php $this->ui->help( sprintf( __( 'Set Campaign ID. This is basically the name of the campaign. If you need to find your List ID, please read <a href="%1$s">this article.</a>', 'ipt_fsqm' ), 'http://support.getresponse.com/faq/how-do-i-create-a-new-campaign' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function campaign_monitor() {
		$op = $this->settings['integration']['campaign_monitor'];
		?>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php $this->ui->generate_label( 'settings[integration][campaign_monitor][enabled]', __( 'Enable Campaign Monitor Integration', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->toggle( 'settings[integration][campaign_monitor][enabled]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $op['enabled'], '1', false, true, array(
					'condid' => 'ipt_fsqm_intg_cm_api_wrap,ipt_fsqm_intg_cm_list_id_wrap'
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'If you want the submitter to get subscribed to a campaign monitor list, please enable it here. After this, make sure you add the Email(DB) field to the form.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_cm_api_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][campaign_monitor][api]', __( 'Campaign Monitor API Key', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[integration][campaign_monitor][api]', $op['api'], __( 'API Key', 'ipt_fsqm' ) ); ?>
				<br />
				<span class="description"><?php printf( __( 'Get it from <a href="%s" target="_blank">here</a>.', 'ipt_fsqm' ), 'http://help.campaignmonitor.com/topic.aspx?t=206' ); ?></span>
			</td>
			<td>
				<?php $this->ui->help( sprintf( __( 'Set campaign monitor API Key. If you need to find your API key, please read <a target="_blank" href="%1$s">this article.</a>', 'ipt_fsqm' ), 'http://help.campaignmonitor.com/topic.aspx?t=206' ) ); ?>
			</td>
		</tr>
		<tr id="ipt_fsqm_intg_cm_list_id_wrap">
			<th><?php $this->ui->generate_label( 'settings[integration][campaign_monitor][list_id]', __( 'Campaign Monitor List ID', 'ipt_fsqm' ) ); ?></th>
			<td>
				<?php $this->ui->text( 'settings[integration][campaign_monitor][list_id]', $op['list_id'], __( 'List ID', 'ipt_fsqm' ) ); ?>
				<br />
				<span class="description"><?php printf( __( 'Get it from <a href="%s" target="_blank">here</a>.', 'ipt_fsqm' ), 'https://www.campaignmonitor.com/api/getting-started/#listid' ); ?></span>
			</td>
			<td>
				<?php $this->ui->help( sprintf( __( 'Set Campaign Monitor List ID. If you need to find your List ID, please read <a href="%1$s">this article.</a>', 'ipt_fsqm' ), 'https://www.campaignmonitor.com/api/getting-started/#listid' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	/*  ==========================================================================
	 * DROPPABLE UI HTML
	 * Overrides the parent
	 *========================================================================*/
	/*   DESIGN */
	public function build_heading( $element, $key, $data, $default_data, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter heading', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][type]', __( 'Heading Type', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->heading_type( $name_prefix . '[settings][type]', $data['settings']['type'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the html heading type.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][align]', __( 'Heading Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->alignment_radio( $name_prefix . '[settings][align]', $data['settings']['align'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the alignment of the heading.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the heading. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_top]', __( 'Show Scroll to Top', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_top]', __( 'Show', 'ipt_fsqm' ), __( 'Don\'t Show', 'ipt_fsqm' ), $data['settings']['show_top'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn the feature on to show a scroll to top anchor beside the heading.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_richtext( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Content heading', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the heading. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_embed( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->textarea( $name_prefix . '[description]', $data['description'], __( 'Embed Code', 'ipt_fsqm' ), 'large', 'normal', array( 'code' ) ); ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_collapsible( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Title', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the title. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][expanded]', __( 'Show Expanded', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][expanded]', __( 'Expanded', 'ipt_fsqm' ), __( 'Collapsed', 'ipt_fsqm' ), $data['settings']['expanded'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If you wish to make the collapsible appear as expanded by default, then enable this feature.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_container( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Title', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the title. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_blank_container( $element, $key, $data, $element_structure, $name_prefix ) {
	?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_iconbox( $element, $key, $data, $element_structure, $name_prefix ) {
		$columns = array(
			array(
				'label' => __( 'Icon', 'ipt_fsqm' ),
				'size' => '45',
				'type' => 'icon_selector',
			),
			array(
				'label' => __( 'Text', 'ipt_fsqm' ),
				'size' => '21',
				'type' => 'text',
			),
			array(
				'label' => __( 'Link', 'ipt_fsqm' ),
				'size' => '21',
				'type' => 'text',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Icon', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$new_name_prefix = $name_prefix . '[settings][elements][__SDAKEY__]';
		$data_list = array(
			array( $new_name_prefix . '[icon]', (string) hexdec( '0xe0d7' ) ),
			array( $new_name_prefix . '[text]', '', __( 'Optional text', 'ipt_fsqm' ), 'fit' ),
			array( $new_name_prefix . '[url]', '', __( 'Optional link', 'ipt_fsqm' ), 'fit' ),
		);
		$items = array();
		$max_key = null;
		foreach ( (array) $data['settings']['elements'] as $e_key => $elem ) {
			$max_key = max( array( $max_key, $e_key ) );
			$new_name_prefix = $name_prefix . '[settings][elements][' . $e_key . ']';
			if ( ! isset( $elem['icon'] ) ) {
				$elem['icon'] = 'none';
			}
			$items[] = array(
				array( $new_name_prefix . '[icon]', $elem['icon'] ),
				array( $new_name_prefix . '[text]', $elem['text'], __( 'Optional text', 'ipt_fsqm' ), 'fit' ),
				array( $new_name_prefix . '[url]', $elem['url'], __( 'Optional link', 'ipt_fsqm' ), 'fit' ),
			);
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][align]', __( 'Icon Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->alignment_radio( $name_prefix . '[settings][align]', $data['settings']['align'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the alignment of the icons.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Choose your icons. You can enter optional text and urls to link. The icons will appear side by side.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'Choose Icons', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $columns,
				'labels' => $labels,
			), $items, $data_list, $max_key ); ?>
				</td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_col_half( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_col( $name_prefix, $data );
	}

	public function build_col_third( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_col( $name_prefix, $data );
	}

	public function build_col_two_third( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_col( $name_prefix, $data );
	}

	public function build_col_forth( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_col( $name_prefix, $data );
	}

	public function build_col_three_forth( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_col( $name_prefix, $data );
	}

	public function build_clear( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->ui->msg_okay( __( 'This element clears the floating content to avoid unexpected appearance.', 'ipt_fsqm' ) );
	}

	public function build_horizontal_line( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_top]', __( 'Show Scroll to Top', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_top]', __( 'Show', 'ipt_fsqm' ), __( 'Don\'t Show', 'ipt_fsqm' ), $data['settings']['show_top'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn the feature on to show a scroll to top anchor below the content.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_divider( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Divider heading', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][align]', __( 'Text Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->alignment_radio( $name_prefix . '[settings][align]', $data['settings']['align'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the alignment of the text.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the heading. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_top]', __( 'Show Scroll to Top', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_top]', __( 'Show', 'ipt_fsqm' ), __( 'Don\'t Show', 'ipt_fsqm' ), $data['settings']['show_top'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn the feature on to show a scroll to top anchor beside the divider.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_button( $element, $key, $data, $element_structure, $name_prefix ) {
		$sizes = array(
			0 => array(
				'label' => __( 'Small', 'ipt_fsqm' ),
				'value' => 'small',
			),
			1 => array(
				'label' => __( 'Medium', 'ipt_fsqm' ),
				'value' => 'medium',
			),
			2 => array(
				'label' => __( 'Large', 'ipt_fsqm' ),
				'value' => 'large'
			),
		);
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter button text', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->text( $name_prefix . '[settings][url]', $data['settings']['url'], __( 'Enter URL http://', 'ipt_fsqm' ), 'large' ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][new_tab]', __( 'Open in New Tab', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][new_tab]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['new_tab'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn the feature on to open the link on a new window.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][size]', __( 'Button Size', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][size]', $sizes, $data['settings']['size'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the size of the button.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the title. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_imageslider( $element, $key, $data, $element_structure, $name_prefix ) {
		$name_prefix = $name_prefix . '[settings]';
		$animations = array( "sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "fold", "fade", "random", "slideInRight", "slideInLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow", "boxRainGrowReverse" );

		$sda_column = array(
			0 => array(
				'label' => __( 'Image', 'ipt_fsqm' ),
				'size' => '30',
				'type' => 'upload'
			),
			1 => array(
				'label' => __( 'Title', 'ipt_fsqm' ),
				'size' => '25',
				'type' => 'text',
			),
			2 => array(
				'label' => __( 'Link', 'ipt_fsqm' ),
				'size' => '25',
				'type' => 'text',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Image', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$data_sda = array(
			0 => array( $name_prefix . '[images][__SDAKEY__][src]', '', $name_prefix . '[images][__SDAKEY__][title]' ),
			1 => array( $name_prefix . '[images][__SDAKEY__][title]', '', __( 'Optional', 'ipt_fsqm' ), 'fit' ),
			2 => array( $name_prefix . '[images][__SDAKEY__][url]', '', __( 'Optional', 'ipt_fsqm' ), 'fit' ),
		);
		$items = array();
		$max_key = null;
		foreach ( $data['settings']['images'] as $i_key => $image ) {
			$max_key = max( array( $max_key, $i_key ) );
			$items[] = array(
				0 => array( $name_prefix . '[images][' . $i_key . '][src]', $image['src'], $name_prefix . '[images][' . $i_key . '][title]' ),
				1 => array( $name_prefix . '[images][' . $i_key . '][title]', $image['title'], __( 'Optional', 'ipt_fsqm' ), 'fit' ),
				2 => array( $name_prefix . '[images][' . $i_key . '][url]', $image['url'], __( 'Optional', 'ipt_fsqm' ), 'fit' ),
			);
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
			<tr>
				<td colspan="3"><p><span class="description"><?php _e( 'Please use images of same dimension. Although the slider is responsive, but it may look weird if the images are of different dimension.', 'ipt_fsqm' ); ?></span></p></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[autoslide]', __( 'Automatic Slide', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[autoslide]', __( 'Enabled', 'ipt_fsqm' ), __( 'Disabled', 'ipt_fsqm' ), $data['settings']['autoslide'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enable or disable the autoslide feature.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[duration]', __( 'Slide Duration', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->slider( $name_prefix . '[duration]', $data['settings']['duration'], 2, 100 ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the time duration between two slides (in seconds).', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[transition]', __( 'Transition Time', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->slider( $name_prefix . '[transition]', $data['settings']['transition'], 0.2, 100, 0.1 ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the transition time between two slides (in seconds).', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[animation]', __( 'Transition Animation', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[animation]', $animations, $data['settings']['animation'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the type of transition animation.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Upload the images which you would like to use inside the slider. It your sole responsibility to select image files only. Otherwise, the slider may not work.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'Upload Images', 'ipt_fsqm' ); ?>
					<div class="clear"></div>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_column,
				'labels' => $labels,
			), $items, $data_sda, $max_key ); ?>
				</td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_captcha( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->ui->msg_okay( __( 'This will give the surveyee a maths challenge.', 'ipt_fsqm' ) );
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	/*   MCQ */
	public function build_radio( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_mcq_option_questions( $element, $key, $data, $element_structure, $name_prefix );
	}

	public function build_checkbox( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_mcq_option_questions( $element, $key, $data, $element_structure, $name_prefix );
	}

	public function build_select( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_mcq_option_questions( $element, $key, $data, $element_structure, $name_prefix, true );
	}

	public function build_thumbselect( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Image', 'ipt_fsqm' ),
				'type' => 'upload',
				'size' => '25',
			),
			1 => array(
				'label' => __( 'Option', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '20',
			),
			2 => array(
				'label' => __( 'Score', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '20',
			),
			3 => array(
				'label' => __( 'Numeric', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '20',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Option', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data = array(
			0 => array( $name_prefix . '[settings][options][__SDAKEY__][image]', '', __( 'Option Image', 'ipt_fsqm' ) ),
			1 => array( $name_prefix . '[settings][options][__SDAKEY__][label]', '', __( 'Enter Option Label', 'ipt_fsqm' ), 'fit' ),
			2 => array( $name_prefix . '[settings][options][__SDAKEY__][score]', '', __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' ),
			3 => array( $name_prefix . '[settings][options][__SDAKEY__][num]', '', __( 'Numeric Value', 'ipt_fsqm' ), 'fit' ),
		);

		$sda_items = array();
		$max_key = null;
		foreach ( (array) $data['settings']['options'] as $o_key => $option ) {
			$max_key = max( array( $max_key, $o_key ) );
			$sda_items[] = array(
				0 => array( $name_prefix . '[settings][options][' . $o_key . '][image]', $option['image'], __( 'Option Image', 'ipt_fsqm' ) ),
				1 => array( $name_prefix . '[settings][options][' . $o_key . '][label]', $option['label'], __( 'Enter Option Label', 'ipt_fsqm' ), 'fit' ),
				2 => array( $name_prefix . '[settings][options][' . $o_key . '][score]', $option['score'], __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' ),
				3 => array( $name_prefix . '[settings][options][' . $o_key . '][num]', $option['num'], __( 'Numeric Value', 'ipt_fsqm' ), 'fit' ),
			);
		}

		?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear inside the selected radio/checkbox.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][multiple]', __( 'Multi Select', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][multiple]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['multiple'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Whether or not, multiple options can be selected.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_label]', __( 'Show Image Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_label]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['show_label'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Whether or not, labels will be shown along with the image. Will render a captioned image look.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][width]', __( 'Image Width', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][width]', $data['settings']['width'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter Image Width, in pixels.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][height]', __( 'Image Height', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][height]', $data['settings']['height'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter Image Height, in pixels.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the options', 'ipt_fsqm' ) . __( 'You can also have score associated to the options. The value of the score should be numeric positive or negative number.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Options', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items, $sda_data, $max_key ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_slider( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][min]', __( 'Minimum Slider Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][min]', $data['settings']['min'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the minimum value of the slider.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][max]', __( 'Maximum Slider Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][max]', $data['settings']['max'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the maximum value of the slider.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][step]', __( 'Slider Step Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][step]', $data['settings']['step'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the step value of the slider.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_count]', __( 'Show Count', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_count]', __( 'Show', 'ipt_fsqm' ), __( 'Don\'t Show', 'ipt_fsqm' ), $data['settings']['show_count'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If turned on, then it will show the slider value count to the user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][prefix]', __( 'Count Prefix', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][prefix]', $data['settings']['prefix'], __( 'Prefix', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter a string that is displayed before the count. Space is not included, so make sure you provide a space if you want to separate the prefix from the count.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][suffix]', __( 'Count Suffix', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][suffix]', $data['settings']['suffix'], __( 'Suffix', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter a string that is displayed after the count. Space is not included, so make sure you provide a space if you want to separate the prefix from the count.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score]', __( 'Assign Score', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][score]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['score'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want this slider contribute to the score obtained, then please enable it here.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score_multiplier]', __( 'Score Multiplier', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][score_multiplier]', $data['settings']['score_multiplier'], '1' ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want to adjust the score by multiplying the selected value with something, then please mention it here. By default it is 1.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_range( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][min]', __( 'Minimum Range Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][min]', $data['settings']['min'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the minimum value of the range.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][max]', __( 'Maximum Range Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][max]', $data['settings']['max'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the maximum value of the range.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][step]', __( 'Range Step Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][step]', $data['settings']['step'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the step value of the range.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_count]', __( 'Show Count', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_count]', __( 'Show', 'ipt_fsqm' ), __( 'Don\'t Show', 'ipt_fsqm' ), $data['settings']['show_count'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If turned on, then it will show the range value count to the user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][prefix]', __( 'Count Prefix', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][prefix]', $data['settings']['prefix'], __( 'Prefix', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter a string that is displayed before the count. Space is not included, so make sure you provide a space if you want to separate the prefix from the count.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][suffix]', __( 'Count Suffix', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][suffix]', $data['settings']['suffix'], __( 'Suffix', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter a string that is displayed after the count. Space is not included, so make sure you provide a space if you want to separate the prefix from the count.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score]', __( 'Assign Score', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][score]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['score'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want this slider contribute to the score obtained, then please enable it here.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score_multiplier]', __( 'Score Multiplier', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][score_multiplier]', $data['settings']['score_multiplier'], '1' ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want to adjust the score by multiplying the selected value with something, then please mention it here. By default it is 1.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php
			$score_formula = array(
				array(
					'label' => __( 'Average of two', 'ipt_fsqm' ),
					'value' => 'avg',
				),
				array(
					'label' => __( 'Addition of two', 'ipt_fsqm' ),
					'value' => 'add',
				),
				array(
					'label' => __( 'Difference of two', 'ipt_fsqm' ),
					'value' => 'diff',
				),
				array(
					'label' => __( 'Minimum of two', 'ipt_fsqm' ),
					'value' => 'min',
				),
				array(
					'label' => __( 'Maximum of two', 'ipt_fsqm' ),
					'value' => 'max',
				),
			);
			?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][formula]', __( 'Score Calculation Formula', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][formula]', $score_formula, $data['settings']['formula'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Since the value is actually a range please specify how the resulting score will be calculated.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_spinners( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Option', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '50',
			),
			1 => array(
				'label' => __( 'Min', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '12',
			),
			2 => array(
				'label' => __( 'Max', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '12',
			),
			3 => array(
				'label' => __( 'Step', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '12',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Option', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data = array(
			0 => array( $name_prefix . '[settings][options][__SDAKEY__][label]', '', __( 'Enter label', 'ipt_fsqm' ) ),
			1 => array( $name_prefix . '[settings][options][__SDAKEY__][min]', '', __( 'Minimum', 'ipt_fsqm' ) ),
			2 => array( $name_prefix . '[settings][options][__SDAKEY__][max]', '', __( 'Maximum', 'ipt_fsqm' ) ),
			3 => array( $name_prefix . '[settings][options][__SDAKEY__][step]', '', __( 'Step', 'ipt_fsqm' ) ),
		);
		$sda_items = array();
		$max_key = null;
		foreach ( (array)$data['settings']['options'] as $o_key => $option ) {
			if ( ! is_array( $option ) ) {
				// backward compatibility -2.5.0
				$option = array(
					'label' => $option,
				);
			}
			// Add overrideable min, max and step
			// With backward compatibility with -2.5.0
			foreach ( array( 'min', 'max', 'step' ) as $ovkey ) {
				if ( ! isset( $option[$ovkey] ) ) {
					$option[$ovkey] = '';
				}
			}
			$max_key = max( array( $max_key, $o_key ) );
			$sda_items[] = array(
				0 => array( $name_prefix . '[settings][options][' . $o_key . '][label]', $option['label'], __( 'Enter label', 'ipt_fsqm' ) ),
				1 => array( $name_prefix . '[settings][options][' . $o_key . '][min]', $option['min'], __( 'Minimum', 'ipt_fsqm' ) ),
				2 => array( $name_prefix . '[settings][options][' . $o_key . '][max]', $option['max'], __( 'Maximum', 'ipt_fsqm' ) ),
				3 => array( $name_prefix . '[settings][options][' . $o_key . '][step]', $option['step'], __( 'Step', 'ipt_fsqm' ) ),
			);
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][min]', __( 'Minimum Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][min]', $data['settings']['min'], __( 'No bound', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the minimum value of the spinner.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][max]', __( 'Maximum Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][max]', $data['settings']['max'], __( 'No bound', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the maximum value of the spinner.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][step]', __( 'Step Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][step]', $data['settings']['step'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the step value of the spinner.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the options. Any minimum, maximum and/or step value you set here, will override the global one.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Options', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items, $sda_data, $max_key ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_grading( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Option', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '28',
			),
			1 => array(
				'label' => __( 'Prefix', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '12',
			),
			2 => array(
				'label' => __( 'Suffix', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '12',
			),
			3 => array(
				'label' => __( 'Min', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '12',
			),
			4 => array(
				'label' => __( 'Max', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '12',
			),
			5 => array(
				'label' => __( 'Step', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '12',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Option', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data = array(
			0 => array( $name_prefix . '[settings][options][__SDAKEY__][label]', '', __( 'Enter label', 'ipt_fsqm' ) ),
			1 => array( $name_prefix . '[settings][options][__SDAKEY__][prefix]', '', __( 'Prefix', 'ipt_fsqm' ) ),
			2 => array( $name_prefix . '[settings][options][__SDAKEY__][suffix]', '', __( 'Suffix', 'ipt_fsqm' ) ),
			3 => array( $name_prefix . '[settings][options][__SDAKEY__][min]', '', __( 'Minimum', 'ipt_fsqm' ) ),
			4 => array( $name_prefix . '[settings][options][__SDAKEY__][max]', '', __( 'Maximum', 'ipt_fsqm' ) ),
			5 => array( $name_prefix . '[settings][options][__SDAKEY__][step]', '', __( 'Step', 'ipt_fsqm' ) ),
		);
		$sda_items = array();
		$max_key = null;
		foreach ( (array)$data['settings']['options'] as $o_key => $option ) {
			if ( ! is_array( $option ) ) {
				// backward compatibility -2.4.0
				$option = array(
					'label' => $option,
					'prefix' => '',
					'suffix' => '',
				);
			}
			// Add overrideable min, max and step
			// With backward compatibility with -2.5.0
			foreach ( array( 'min', 'max', 'step' ) as $ovkey ) {
				if ( ! isset( $option[$ovkey] ) ) {
					$option[$ovkey] = '';
				}
			}

			$max_key = max( array( $max_key, $o_key ) );
			$sda_items[] = array(
				0 => array( $name_prefix . '[settings][options][' . $o_key . '][label]', $option['label'], __( 'Enter label', 'ipt_fsqm' ) ),
				1 => array( $name_prefix . '[settings][options][' . $o_key . '][prefix]', $option['prefix'], __( 'Prefix', 'ipt_fsqm' ) ),
				2 => array( $name_prefix . '[settings][options][' . $o_key . '][suffix]', $option['suffix'], __( 'Suffix', 'ipt_fsqm' ) ),
				3 => array( $name_prefix . '[settings][options][' . $o_key . '][min]', $option['min'], __( 'Minimum', 'ipt_fsqm' ) ),
				4 => array( $name_prefix . '[settings][options][' . $o_key . '][max]', $option['max'], __( 'Maximum', 'ipt_fsqm' ) ),
				5 => array( $name_prefix . '[settings][options][' . $o_key . '][step]', $option['step'], __( 'Step', 'ipt_fsqm' ) ),
			);
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][range]', __( 'Use Range', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][range]', __( 'Ranged Input', 'ipt_fsqm' ), __( 'Single Input', 'ipt_fsqm' ), $data['settings']['range'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If turned on, then it will prompt the user to select a range of values instead of a single value.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][min]', __( 'Minimum Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][min]', $data['settings']['min'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the minimum value of the slider.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][max]', __( 'Maximum Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][max]', $data['settings']['max'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the maximum value of the slider.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][step]', __( 'Step Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][step]', $data['settings']['step'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the step value of the slider.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_count]', __( 'Show Count', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_count]', __( 'Show', 'ipt_fsqm' ), __( 'Don\'t Show', 'ipt_fsqm' ), $data['settings']['show_count'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If turned on, then it will show the slider value count to the user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score]', __( 'Assign Score', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][score]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['score'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want this slider contribute to the score obtained, then please enable it here.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score_multiplier]', __( 'Score Multiplier', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][score_multiplier]', $data['settings']['score_multiplier'], '1' ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want to adjust the score by multiplying the selected value with something, then please mention it here. By default it is 1.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php
			$score_formula = array(
				array(
					'label' => __( 'Average of two', 'ipt_fsqm' ),
					'value' => 'avg',
				),
				array(
					'label' => __( 'Addition of two', 'ipt_fsqm' ),
					'value' => 'add',
				),
				array(
					'label' => __( 'Difference of two', 'ipt_fsqm' ),
					'value' => 'diff',
				),
				array(
					'label' => __( 'Minimum of two', 'ipt_fsqm' ),
					'value' => 'min',
				),
				array(
					'label' => __( 'Maximum of two', 'ipt_fsqm' ),
					'value' => 'max',
				),
			);
			?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][formula]', __( 'Score Calculation Formula', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][formula]', $score_formula, $data['settings']['formula'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Since the value is actually a range please specify how the resulting score will be calculated.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the options. Any minimum, maximum and/or step value you set here, will override the global one.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Options', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items, $sda_data, $max_key ); ?>
				</td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_smileyrating( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => '<i class="ipt-icomoon-checkbox-checked"></i>',
				'type' => 'checkbox',
				'size' => '10',
			),
			1 => array(
				'label' => __( 'Smiley', 'ipt_fsqm' ),
				'type' => 'print_icon',
				'size' => '10',
			),
			2 => array(
				'label' => __( 'Feedback Label', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '30',
			),
			3 => array(
				'label' => __( 'Score', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '20',
			),
			4 => array(
				'label' => __( 'Numeric', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '20',
			),
		);
		$sda_items = array();
		$sda_data = array(
			0 => array( $name_prefix . '[settings][enabled][__SDAKEY__]', array( 'value' => '1', 'label' => '' ), '' ),
			1 => array( 'none', 24 ),
			2 => array( $name_prefix . '[settings][labels][__SDAKEY__]', '', '' ),
			3 => array( $name_prefix . '[settings][scores][__SDAKEY__]', '', __( 'Optional', 'ipt_fsqm' ) ),
			4 => array( $name_prefix . '[settings][num][__SDAKEY__]', '', __( 'Optional', 'ipt_fsqm' ) ),
		);
		$setting_to_icon_map = array(
			'frown' => 'angry',
			'sad' => 'sad',
			'neutral' => 'neutral',
			'happy' => 'smiley',
			'excited' => 'happy',
		);
		foreach ( array( 'frown', 'sad', 'neutral', 'happy', 'excited' ) as $srkey ) {
			$sda_items[] = array(
				0 => array( $name_prefix . '[settings][enabled][' . $srkey . ']', array( 'value' => '1', 'label' => '' ), $data['settings']['enabled'][$srkey] ),
				1 => array( $setting_to_icon_map[$srkey], 24 ),
				2 => array( $name_prefix . '[settings][labels][' . $srkey . ']', $data['settings']['labels'][$srkey], '' ),
				3 => array( $name_prefix . '[settings][scores][' . $srkey . ']', $data['settings']['scores'][$srkey], __( 'Optional', 'ipt_fsqm' ) ),
				4 => array( $name_prefix . '[settings][num][' . $srkey . ']', $data['settings']['num'][$srkey], __( 'Optional', 'ipt_fsqm' ) ),
			);
		}
		$max_key = 4;
		?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_feedback]', __( 'Optional Feedback', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_feedback]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['show_feedback'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want to ask for feedback, then enable it here and a textbox will appear upon selecting a smiley.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][feedback_label]', __( 'Feedback Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][feedback_label]', $data['settings']['feedback_label'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the label that will shown on an empty feedback textarea.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->sda_list(
						array(
							'columns' => $sda_columns,
							'features' => array(
								'draggable' => false,
								'addable' => false,
							),
						), $sda_items, $sda_data, $max_key
					); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
	<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_starrating( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Option', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '85',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Option', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data = array(
			0 => array( $name_prefix . '[settings][options][__SDAKEY__]', '', __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
		);
		$sda_items = array();
		$max_key = null;
		foreach ( (array)$data['settings']['options'] as $o_key => $option ) {
			$max_key = max( array( $max_key, $o_key ) );
			$sda_items[] = array(
				0 => array( $name_prefix . '[settings][options][' . $o_key . ']', $option, __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
			);
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][max]', __( 'Maximum Rating Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][max]', $data['settings']['max'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the maximum value of the rating.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score]', __( 'Assign Score', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][score]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['score'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want this slider contribute to the score obtained, then please enable it here.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score_multiplier]', __( 'Score Multiplier', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][score_multiplier]', $data['settings']['score_multiplier'], '1' ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want to adjust the score by multiplying the selected value with something, then please mention it here. By default it is 1.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the options', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Options', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items, $sda_data, $max_key ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_scalerating( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Option', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '85',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Option', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data = array(
			0 => array( $name_prefix . '[settings][options][__SDAKEY__]', '', __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
		);
		$sda_items = array();
		$max_key = null;
		foreach ( (array)$data['settings']['options'] as $o_key => $option ) {
			$max_key = max( array( $max_key, $o_key ) );
			$sda_items[] = array(
				0 => array( $name_prefix . '[settings][options][' . $o_key . ']', $option, __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
			);
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][max]', __( 'Maximum Rating Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][max]', $data['settings']['max'], __( 'Enter Number', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the maximum value of the rating.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score]', __( 'Assign Score', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][score]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['score'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want this slider contribute to the score obtained, then please enable it here.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score_multiplier]', __( 'Score Multiplier', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][score_multiplier]', $data['settings']['score_multiplier'], '1' ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want to adjust the score by multiplying the selected value with something, then please mention it here. By default it is 1.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the options', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Options', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items, $sda_data, $max_key ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_matrix( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Label', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '85',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Item', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data_row = array(
			0 => array( $name_prefix . '[settings][rows][__SDAKEY__]', '', __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
		);
		$sda_items_rows = array();
		$max_key_row = null;
		foreach ( (array)$data['settings']['rows'] as $o_key => $option ) {
			$max_key_row = max( array( $max_key_row, $o_key ) );
			$sda_items_rows[] = array(
				0 => array( $name_prefix . '[settings][rows][' . $o_key . ']', $option, __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
			);
		}

		$sda_col_columns = array(
			0 => array(
				'label' => __( 'Label', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '55',
			),
			1 => array(
				'label' => __( 'Score', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '30',
			),
		);
		$sda_data_column = array(
			0 => array( $name_prefix . '[settings][columns][__SDAKEY__]', '', __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
			1 => array( $name_prefix . '[settings][scores][__SDAKEY__]', '', __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' ),
		);
		$sda_items_columns = array();
		$max_key_column = null;
		foreach ( (array)$data['settings']['columns'] as $o_key => $option ) {
			$max_key_column = max( array( $max_key_column, $o_key ) );
			$sda_items_columns[] = array(
				0 => array( $name_prefix . '[settings][columns][' . $o_key . ']', $option, __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
				1 => array( $name_prefix . '[settings][scores][' . $o_key . ']', isset( $data['settings']['scores'][$o_key] ) ? $data['settings']['scores'][$o_key] : '', __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' ),
			);
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][multiple]', __( 'Multiple Values', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][multiple]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['multiple'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If turned on, then the user will be able to select multiple values across the row.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear inside the selected radio/checkbox.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the Rows. These are basically the primary ratings.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Rows', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items_rows, $sda_data_row, $max_key_row ); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the Columns. These are basically the selection options.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Columns', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_col_columns,
				'labels' => $labels,
			), $sda_items_columns, $sda_data_column, $max_key_column ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_matrix_dropdown( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Label', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '85',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Item', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data_row = array(
			0 => array( $name_prefix . '[settings][rows][__SDAKEY__]', '', __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
		);
		$sda_items_rows = array();
		$max_key_row = null;
		foreach ( (array)$data['settings']['rows'] as $o_key => $option ) {
			$max_key_row = max( array( $max_key_row, $o_key ) );
			$sda_items_rows[] = array(
				0 => array( $name_prefix . '[settings][rows][' . $o_key . ']', $option, __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
			);
		}

		$sda_col_columns = array(
			0 => array(
				'label' => __( 'Label', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '55',
			),
			1 => array(
				'label' => __( 'Score Multiplier', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '30',
			),
		);
		$sda_data_column = array(
			0 => array( $name_prefix . '[settings][columns][__SDAKEY__]', '', __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
			1 => array( $name_prefix . '[settings][scores][__SDAKEY__]', '', __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' ),
		);
		$sda_items_columns = array();
		$max_key_column = null;
		foreach ( (array)$data['settings']['columns'] as $o_key => $option ) {
			$max_key_column = max( array( $max_key_column, $o_key ) );
			$sda_items_columns[] = array(
				0 => array( $name_prefix . '[settings][columns][' . $o_key . ']', $option, __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
				1 => array( $name_prefix . '[settings][scores][' . $o_key . ']', isset( $data['settings']['scores'][$o_key] ) ? $data['settings']['scores'][$o_key] : '', __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' ),
			);
		}

		$sda_opt_columns = array(
			0 => array(
				'label' => __( 'Option', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '45',
			),
			1 => array(
				'label' => __( 'Score', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '20',
			),
			2 => array(
				'label' => __( 'Numeric', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '20',
			),
		);
		$sda_opt_data = array(
			0 => array( $name_prefix . '[settings][options][__SDAKEY__][label]', '', __( 'Enter Option Label', 'ipt_fsqm' ), 'fit' ),
			1 => array( $name_prefix . '[settings][options][__SDAKEY__][score]', '', __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' ),
			2 => array( $name_prefix . '[settings][options][__SDAKEY__][num]', '', __( 'Numeric Value', 'ipt_fsqm' ), 'fit' ),
		);

		$sda_opt_items = array();
		$max_opt_key = null;
		foreach ( $data['settings']['options'] as $o_key => $option ) {
			$max_opt_key = max( array( $max_opt_key, $o_key ) );
			$new_data = array(
				0 => array( $name_prefix . '[settings][options][' . $o_key . '][label]', $option['label'], __( 'Enter Option Label', 'ipt_fsqm' ), 'fit' ),
				1 => array( $name_prefix . '[settings][options][' . $o_key . '][score]', $option['score'], __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' ),
				2 => array( $name_prefix . '[settings][options][' . $o_key . '][num]', $option['num'], __( 'Numeric Value', 'ipt_fsqm' ), 'fit' ),
			);

			$sda_opt_items[] = $new_data;
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][empty]', __( 'Empty Option Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][empty]', $data['settings']['empty'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the first empty option that is shown to the user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the Options. These will appear inside every column.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'Dropdown Options', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
						'columns' => $sda_opt_columns,
						'labels' => $labels,
					), $sda_opt_items, $sda_opt_data, $max_opt_key ); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the Rows. These are basically the primary ratings.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Rows', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
						'columns' => $sda_columns,
						'labels' => $labels,
					), $sda_items_rows, $sda_data_row, $max_key_row ); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the Columns. These are basically the selection options.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Columns', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
						'columns' => $sda_col_columns,
						'labels' => $labels,
					), $sda_items_columns, $sda_data_column, $max_key_column ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_likedislike( $element, $key, $data, $element_structure, $name_prefix ) {
	?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][liked]', __( 'liked by Default', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][liked]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['liked'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn this feature on to make it liked by default.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][like]', __( 'Liked State Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][like]', $data['settings']['like'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the liked state label that will be shown to the user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][dislike]', __( 'Disliked State Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][dislike]', $data['settings']['dislike'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the disliked state label that will be shown to the user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_feedback]', __( 'Optional Feedback', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_feedback]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['show_feedback'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If you want to ask for feedback, then enable it here and a textbox will appear upon selecting a smiley.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][feedback_label]', __( 'Feedback Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][feedback_label]', $data['settings']['feedback_label'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the label that will shown on an empty feedback textarea.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_toggle( $element, $key, $data, $element_structure, $name_prefix ) {
	?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][checked]', __( 'Checked by Default', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][checked]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['checked'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn this feature on to make the checkbox checked by default.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][on]', __( 'Checked State Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][on]', $data['settings']['on'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the checked state label that will be shown to the user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][off]', __( 'Unchecked State Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][off]', $data['settings']['off'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the unchecked state label that will be shown to the user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_sorting( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_user_sortable( $element, $key, $data, $element_structure, $name_prefix, true );
	}

	public function build_feedback_large( $element, $key, $data, $element_structure, $name_prefix ) {
		$types = array(
			array(
				'label' => 'Standard Qwerty Keyboard',
				'value' => 'qwerty',
			),
			array(
				'label' => 'International Qwerty Keyboard',
				'value' => 'qwerty',
			),
			array(
				'label' => 'Numerical Keyboard (ten-key)',
				'value' => 'num',
			),
			array(
				'label' => 'Alphabetical Keyboard',
				'value' => 'alpha',
			),
			array(
				'label' => 'Dvorak Simplified Keyboard',
				'value' => 'dvorak',
			),
		);
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][keypad]', __( 'Show Keyboard', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][keypad]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['keypad'], '1', false, true, array(
						'condid' => 'ipt_fsqm_builder_fl_' . $key . '_wrap',
					) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Whether or not to show a keyboard on this element.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr id="<?php echo 'ipt_fsqm_builder_fl_' . $key . '_wrap'; ?>">
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][type]', __( 'Keyboard Type', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][type]', $types, $data['settings']['type'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the keyboard type.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][email]', __( 'Send to Address', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][email]', $data['settings']['email'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The email address to which this submission will be sent. Leave empty to disable.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score]', __( 'Score', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][score]', $data['settings']['score'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The score admin can assign for this question. Leave empty to disable.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_feedback_small( $element, $key, $data, $element_structure, $name_prefix ) {
		$types = array(
			array(
				'label' => 'Standard Qwerty Keyboard',
				'value' => 'qwerty',
			),
			array(
				'label' => 'International Qwerty Keyboard',
				'value' => 'qwerty',
			),
			array(
				'label' => 'Numerical Keyboard (ten-key)',
				'value' => 'num',
			),
			array(
				'label' => 'Alphabetical Keyboard',
				'value' => 'alpha',
			),
			array(
				'label' => 'Dvorak Simplified Keyboard',
				'value' => 'dvorak',
			),
		);
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][keypad]', __( 'Show Keyboard', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][keypad]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['keypad'], '1', false, true, array(
						'condid' => 'ipt_fsqm_builder_fs_' . $key . '_wrap',
					) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Whether or not to show a keyboard on this element.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr id="<?php echo 'ipt_fsqm_builder_fs_' . $key . '_wrap'; ?>">
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][type]', __( 'Keyboard Type', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][type]', $types, $data['settings']['type'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the keyboard type.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][email]', __( 'Send to Address', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][email]', $data['settings']['email'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The email address to which this submission will be sent. Leave empty to disable.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score]', __( 'Score', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][score]', $data['settings']['score'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The score admin can assign for this question. Leave empty to disable.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the text. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_upload( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the title. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][accept_file_types]', __( 'Accepted File Types', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][accept_file_types]', $data['settings']['accept_file_types'], __( 'Accept everything (can be dangerous)', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter a comma separated list of extensions of files that you would allow the user to upload. Leaving it empty will cause unrestricted file upload. But for security purpose we are still going to disable uploading of .php files and other executable files.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][max_number_of_files]', __( 'Maximum Number of Files', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][max_number_of_files]', $data['settings']['max_number_of_files'], __( 'No limit', 'ipt_fsqm' ), 1, 100, 1 ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter maximum number of files. Leave blank for unlimited files. Please note that PHP file limit may still be restricting the overall size.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][min_number_of_files]', __( 'Minimum Number of Files', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][min_number_of_files]', $data['settings']['min_number_of_files'], __( 'Validation Dependent', 'ipt_fsqm' ), 1, 100, 1 ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter minimum number of files. Leave blank for fallback to validation.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][max_file_size]', __( 'Max File Size (bytes)', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][max_file_size]', $data['settings']['max_file_size'], __( 'No limit', 'ipt_fsqm' ), 1, 100000000, 1000 ); ?>
					<br /><br /><?php printf( __( '<strong>PHP Upload Limit:</strong> <code>%s</code> bytes', 'ipt_fsqm' ), $this->get_maximum_file_upload_size() ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter maximum file size in bytes. Leave blank for unlimited file size. Please note that PHP file limit may still be restricting the actual size.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][min_file_size]', __( 'Min File Size (bytes)', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][min_file_size]', $data['settings']['min_file_size'], __( 'No limit', 'ipt_fsqm' ), 1, 100000000, 1000 ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter minimum file size in bytes. Minimum will always be 1.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][wp_media_integration]', __( 'Integrate to WP Media', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][wp_media_integration]', __( 'Enabled', 'ipt_fsqm' ), __( 'Disabled', 'ipt_fsqm' ), $data['settings']['wp_media_integration'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enable to automatically add the uploads to WordPress Media List. You can then easily put them inside posts or use any media functions on them.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][auto_upload]', __( 'Immediate Upload', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][auto_upload]', __( 'Enabled', 'ipt_fsqm' ), __( 'Disabled', 'ipt_fsqm' ), $data['settings']['auto_upload'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enable to start upload the files immediately after added. Otherwise user would need to click on the Start Upload button to actually upload the files.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][single_upload]', __( 'Select one file at a time', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][single_upload]', __( 'Enabled', 'ipt_fsqm' ), __( 'Disabled', 'ipt_fsqm' ), $data['settings']['single_upload'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enabling this will make the user to select only one file at a time when browsing. This is recommended only if you want to have access to Upload from camera feature on iOS devices.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][drag_n_drop]', __( 'Drag and Drop Interface', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][drag_n_drop]', __( 'Enabled', 'ipt_fsqm' ), __( 'Disabled', 'ipt_fsqm' ), $data['settings']['drag_n_drop'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If enabled, the upload container will have a nice drag and drop zone where users can simply put their files for upload.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][progress_bar]', __( 'Show Progress Bar', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][progress_bar]', __( 'Enabled', 'ipt_fsqm' ), __( 'Disabled', 'ipt_fsqm' ), $data['settings']['progress_bar'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If enabled, users will be shown a progress bar to track upload progress.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][preview_media]', __( 'Preview Media', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][preview_media]', __( 'Enabled', 'ipt_fsqm' ), __( 'Disabled', 'ipt_fsqm' ), $data['settings']['preview_media'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If enabled, users will have options to preview uploaded media - images, audio and video files.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][can_delete]', __( 'Delete Capability', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][can_delete]', __( 'Enabled', 'ipt_fsqm' ), __( 'Disabled', 'ipt_fsqm' ), $data['settings']['can_delete'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'If enabled, users can delete their uploaded files before making the final submission.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_mathematical( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
		?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the title. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][editable]', __( 'Value Editable By User', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][editable]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['editable'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Whether or not the calculated value would be editable by user.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][formula]', __( 'Formula Input', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][formula]', $data['settings']['formula'], __( 'Valid Mathematical String', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter mathematical formula here. <code>(M1+M2)/(M3+F1)</code>.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th>
					<?php $this->ui->generate_label( $name_prefix . '[settings][precision]', __( 'Decimal Precision', 'ipt_fsqm' ) ); ?>
				</th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][precision]', $data['settings']['precision'], __( 'Default 0', 'ipt_fsqm' ), 1, 10, 1 ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter the number of digits that should be rounded off after decimal point.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][prefix]', __( 'Prefix', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->textarea( $name_prefix . '[settings][prefix]', $data['settings']['prefix'], __( 'HTML allowed', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the prefix text here.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][suffix]', __( 'Suffix', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->textarea( $name_prefix . '[settings][suffix]', $data['settings']['suffix'], __( 'HTML allowed', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the suffix text here.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_feedback_matrix( $element, $key, $data, $element_structure, $name_prefix ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Label', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '85',
			),
		);
		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Item', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data_row = array(
			0 => array( $name_prefix . '[settings][rows][__SDAKEY__]', '', __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
		);
		$sda_items_rows = array();
		$max_key_row = null;
		foreach ( (array)$data['settings']['rows'] as $o_key => $option ) {
			$max_key_row = max( array( $max_key_row, $o_key ) );
			$sda_items_rows[] = array(
				0 => array( $name_prefix . '[settings][rows][' . $o_key . ']', $option, __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
			);
		}

		$sda_col_columns = array(
			0 => array(
				'label' => __( 'Label', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '85',
			),
		);
		$sda_data_column = array(
			0 => array( $name_prefix . '[settings][columns][__SDAKEY__]', '', __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
		);
		$sda_items_columns = array();
		$max_key_column = null;
		foreach ( (array)$data['settings']['columns'] as $o_key => $option ) {
			$max_key_column = max( array( $max_key_column, $o_key ) );
			$sda_items_columns[] = array(
				0 => array( $name_prefix . '[settings][columns][' . $o_key . ']', $option, __( 'Enter label', 'ipt_fsqm' ), 'fit' ),
			);
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][multiline]', __( 'Multiline Values', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][multiline]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['multiline'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If turned on, then the user will be given textareas instead of text inputs across the row.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear inside the selected radio/checkbox.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the Rows. These are basically the primary ratings.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Rows', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items_rows, $sda_data_row, $max_key_row ); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the Columns. These are basically the selection options.', 'ipt_fsqm' ) ); ?>
					<?php _e( 'List of Columns', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_col_columns,
				'labels' => $labels,
			), $sda_items_columns, $sda_data_column, $max_key_column ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_gps( $element, $key, $data, $element_structure, $name_prefix ) {
	?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the title. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][radius]', __( 'Accuracy Radius', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][radius]', $data['settings']['radius'], __( 'None', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter the accuracy circle radius.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][zoom]', __( 'Map Zoom', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][zoom]', $data['settings']['zoom'], __( 'None', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter the zoom in value for map.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][scrollwheel]', __( 'Make Scroll using Mouse Wheel', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][scrollwheel]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['scrollwheel'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If enabled, then user will be able to zoom in or out using scroll wheel.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][manualcontrol]', __( 'Manual Control', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][manualcontrol]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['manualcontrol'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'If enabled, then user will be able to manually set address.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][lat_label]', __( 'Latitude Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][lat_label]', $data['settings']['lat_label'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the label that will shown on an empty Latitude text.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][long_label]', __( 'Longitude Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][long_label]', $data['settings']['long_label'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the label that will shown on an empty Longitude text.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][location_name_label]', __( 'Location Name Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][location_name_label]', $data['settings']['location_name_label'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the label that will shown on an empty Location Name text. This field will be populated by google places API.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][update_label]', __( 'Update Button Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][update_label]', $data['settings']['update_label'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the label that will shown on the manual update button.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][nolocation_label]', __( 'No Location Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][nolocation_label]', $data['settings']['nolocation_label'], __( 'Enter label', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Enter the label that will shown when no location is given.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
	<?php
	$this->build_conditional( $name_prefix, $data['conditional'] );
	$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_f_name( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_l_name( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_email( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_phone( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_p_name( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_p_email( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_p_phone( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_textinput( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear before the text. Select none to disable.', 'ipt_fsqm' ) ) ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_textarea( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_password( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][confirm_duplicate]', __( 'Enter Password Twice', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][confirm_duplicate]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['confirm_duplicate'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn this feature on to make the user enter the password twice for validation.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_p_radio( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_mcq_option_questions( $element, $key, $data, $element_structure, $name_prefix, false, false );
	}

	public function build_p_checkbox( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_mcq_option_questions( $element, $key, $data, $element_structure, $name_prefix, false, false );
	}

	public function build_p_select( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_mcq_option_questions( $element, $key, $data, $element_structure, $name_prefix, true, false );
	}

	public function build_s_checkbox( $element, $key, $data, $element_structure, $name_prefix ) {
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][checked]', __( 'Checked by Default', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][checked]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['checked'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn this feature on to make the checkbox checked by default.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear inside the selected radio/checkbox.', 'ipt_fsqm' ) ) ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	public function build_address( $element, $key, $data, $element_structure, $name_prefix ) {
		$placeholders = array(
			'recipient' => __( 'Recipient', 'ipt_fsqm' ),
			'line_one' => __( 'Address line one', 'ipt_fsqm' ),
			'line_two' => __( 'Address line two', 'ipt_fsqm' ),
			'line_three' => __( 'Address line three', 'ipt_fsqm' ),
			'country' => __( 'Country', 'ipt_fsqm' ),
		);
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><h5><?php _e( 'Placeholders', 'ipt_fsqm' ); ?></h5></td>
			</tr>
			<?php foreach ( $placeholders as $p_key => $ph ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][' . $p_key . ']', $ph ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][' . $p_key . ']', $data['settings'][$p_key], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_keypad( $element, $key, $data, $element_structure, $name_prefix ) {
		$types = array(
			array(
				'label' => 'Standard Qwerty Keyboard',
				'value' => 'qwerty',
			),
			array(
				'label' => 'International Qwerty Keyboard',
				'value' => 'qwerty',
			),
			array(
				'label' => 'Numerical Keyboard (ten-key)',
				'value' => 'num',
			),
			array(
				'label' => 'Alphabetical Keyboard',
				'value' => 'alpha',
			),
			array(
				'label' => 'Dvorak Simplified Keyboard',
				'value' => 'dvorak',
			),
		);
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][mask]', __( 'Mask Input', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][mask]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['mask'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn this feature on to take masked inputs (just like passwords).', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][multiline]', __( 'Accept Multiline', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][multiline]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['multiline'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn this feature on to take multiline inputs.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][type]', __( 'Keyboard Type', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][type]', $types, $data['settings']['type'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the keyboard type.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_datetime( $element, $key, $data, $element_structure, $name_prefix ) {
		$types = array(
			array(
				'label' => __( 'Date Only', 'ipt_fsqm' ),
				'value' => 'date',
				'data' => array(
					'condid' => 'ipt_fsqm_form_builder_datetime_' . $key . '_date_wrap',
				),
			),
			array(
				'label' => __( 'Time Only', 'ipt_fsqm' ),
				'value' => 'time',
				'data' => array(
					'condid' => 'ipt_fsqm_form_builder_datetime_' . $key . '_time_wrap',
				),
			),
			array(
				'label' => __( 'Date & Time', 'ipt_fsqm' ),
				'value' => 'datetime',
				'data' => array(
					'condid' => 'ipt_fsqm_form_builder_datetime_' . $key . '_time_wrap,ipt_fsqm_form_builder_datetime_' . $key . '_date_wrap',
				),
			),
		);
		$date_formats = array(
			'yy-mm-dd' => date_i18n( 'Y-m-d', current_time( 'timestamp' ) ),
			'mm/dd/yy' => date_i18n( 'm/d/Y', current_time( 'timestamp' ) ),
			'dd.mm.yy' => date_i18n( 'd.m.Y', current_time( 'timestamp' ) ),
			'dd-mm-yy' => date_i18n( 'd-m-Y', current_time( 'timestamp' ) ),
		);
		$time_formats = array(
			'HH:mm:ss' => date_i18n( 'H:i:s', current_time( 'timestamp' ) ),
			'hh:mm:ss TT' => date_i18n( 'h:i:s A', current_time( 'timestamp' ) ),
		);
		?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][placeholder]', __( 'Placeholder Text', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][placeholder]', $data['settings']['placeholder'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Text that is shown by default when the field is empty.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][show_current]', __( 'Show Current Time', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][show_current]', __( 'Show', 'ipt_fsqm' ), __( 'Don\'t Show', 'ipt_fsqm' ), $data['settings']['show_current'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The current time will be calculated on the browser.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][type]', __( 'Picker Type', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][type]', $types, $data['settings']['type'], false, true ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the date and/or time picker type.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr id="ipt_fsqm_form_builder_datetime_<?php echo $key; ?>_date_wrap">
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][date_format]', __( 'Picker Date Format', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][date_format]', $date_formats, $data['settings']['date_format'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the date and/or time picker date format. It will be translated automatically and will change the older date times if you happen to change the format in future.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr id="ipt_fsqm_form_builder_datetime_<?php echo $key; ?>_time_wrap">
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][time_format]', __( 'Picker Time Format', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][time_format]', $time_formats, $data['settings']['time_format'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the date and/or time picker time format. It will be translated automatically and will change the older date times if you happen to change the format in future.', 'ipt_fsqm' ) ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_p_sorting( $element, $key, $data, $element_structure, $name_prefix ) {
		$this->build_user_sortable( $element, $key, $data, $element_structure, $name_prefix );
	}

	/*  ==========================================================================
	 * SOME INTERNAL FUNCTIONS
	 *========================================================================*/
	protected function build_col($name_prefix, $data) {
		$this->ui->msg_okay( __( 'Please expand the column by clicking the <span class="ipt-icomoon-arrow-down"></span> Expand Icon and drop more elements inside.', 'ipt_fsqm' ) );
		$this->build_conditional( $name_prefix, $data['conditional'] );
	}

	protected function build_user_sortable( $element, $key, $data, $element_structure, $name_prefix, $score = false ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Option', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '85'
			),
		);
		if ( $score ) {
			$sda_columns[0]['size'] = '55';
			$sda_columns[1] = array(
				'label' => __( 'Score', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '30',
			);
		}

		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Option', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data = array(
			0 => array( $name_prefix . '[settings][options][__SDAKEY__][label]', '', __( 'Option Label', 'ipt_fsqm' ), 'fit' ),
		);
		if ( $score ) {
			$sda_data[1] = array( $name_prefix . '[settings][options][__SDAKEY__][score]', '', __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' );
		}

		$sda_items = array();
		$max_key = null;
		foreach ( $data['settings']['options'] as $o_key => $option ) {
			$max_key = max( array( $max_key, $o_key ) );
			$new_data = array(
				0 => array( $name_prefix . '[settings][options][' . $o_key . '][label]', $option['label'], __( 'Enter Option Label', 'ipt_fsqm' ), 'fit' ),
			);
			if ( $score ) {
				$new_data[1] = array( $name_prefix . '[settings][options][' . $o_key . '][score]', $option['score'], __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' );
			}
			$sda_items[] = $new_data;
		}
		$types = array(
			array(
				'label' => 'Individual Positioning',
				'value' => 'individual',
			),
			array(
				'label' => 'Combined Positioning',
				'value' => 'combined',
			),
		);
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3">
					<p>
						<span class="description">
							<?php if ( $score ) : ?>
							<?php _e( 'The correct sorting order is the order you give. The output will be randomized and the surveyee will need to put it into the correct order to get the maximum score.', 'ipt_fsqm' ); ?>
							<?php else : ?>
							<?php _e( 'The output of the sortable list will be the order you give. The surveyee can order the items the way he or she wishes.', 'ipt_fsqm' ); ?>
							<?php endif; ?>
						</span>
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<?php if ( isset( $data['settings']['no_shuffle'] ) ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][no_shuffle]', __( 'Shuffling', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][no_shuffle]', __( 'No shuffle', 'ipt_fsqm' ), __( 'Shuffle', 'ipt_fsqm' ), $data['settings']['no_shuffle'] ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'By default the output of the list will be shuffled. If you wish to prevent it, then customize the toggle button.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( $score ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][base_score]', __( 'Base Score', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[settings][base_score]', $data['settings']['base_score'], __( 'None', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter the base score for a perfect sort. Consult to the help of Score Calculation Type to get more information.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][score_type]', __( 'Score Calculation Type', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->select( $name_prefix . '[settings][score_type]', $types, $data['settings']['score_type'] ); ?>
				</td>
				<td>
					<?php $this->ui->help_head(); ?>
					<?php _e( 'First all the items will be scrambled randomly. Then the user will need to sort them in the provided order to get score. Scoring can be of two types.', 'ipt_fsqm' ); ?>
					<ul class="ul-disc">
						<li>
							<strong><?php _e( 'Individual Positioning:', 'ipt_fsqm' ) ?></strong> <?php _e( 'Individual scores will be added to all items positioned at the right place. If all are in right places, then the Base Score will also be added.', 'ipt_fsqm' ); ?>
						</li>
						<li>
							<strong><?php _e( 'Combined Positioning:', 'ipt_fsqm' ) ?></strong> <?php _e( 'If all are in right places, then the Base Score will be added. Otherwise no score will be given.', 'ipt_fsqm' ); ?>
						</li>
					</ul>
					<?php $this->ui->help_tail(); ?>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the options', 'ipt_fsqm' ) . ( $score ? __( 'You can also have score associated to the options. The value of the score should be numeric positive or negative number.', 'ipt_fsqm' ) : '' ) ); ?>
					<?php _e( 'List of Options', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items, $sda_data, $max_key ); ?>
				</td>
			</tr>
		</tbody>
	</table>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	/*  *
	 *
	 *
	 * @param type    $element
	 * @param type    $key
	 * @param type    $data
	 * @param type    $element_structure
	 * @param type    $name_prefix
	 * @param type    $for_select
	 * @param type    $score
	 */
	protected function build_mcq_option_questions( $element, $key, $data, $element_structure, $name_prefix, $for_select = false, $score = true ) {
		$sda_columns = array(
			0 => array(
				'label' => __( 'Option', 'ipt_fsqm' ),
				'type' => 'text',
				'size' => '65',
			),
		);
		if ( $score ) {
			$sda_columns[0]['size'] = '45';
			$sda_columns[1] = array(
				'label' => __( 'Score', 'ipt_fsqm' ),
				'type' => 'spinner',
				'size' => '20',
			);
		}
		$sda_columns[] = array(
			'label' => __( 'Numeric', 'ipt_fsqm' ),
			'type' => 'spinner',
			'size' => '20',
		);

		$labels = array(
			'confirm' => __( 'Confirm delete. This action can not be undone.', 'ipt_fsqm' ),
			'add' => __( 'Add New Option', 'ipt_fsqm' ),
			'del' => __( 'Click to delete', 'ipt_fsqm' ),
			'drag' => __( 'Drag this to rearrange', 'ipt_fsqm' ),
		);
		$sda_data = array(
			0 => array( $name_prefix . '[settings][options][__SDAKEY__][label]', '', __( 'Enter Option Label', 'ipt_fsqm' ), 'fit' ),
		);
		if ( $score ) {
			$sda_data[1] = array( $name_prefix . '[settings][options][__SDAKEY__][score]', '', __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' );
		}
		$sda_data[] = array( $name_prefix . '[settings][options][__SDAKEY__][num]', '', __( 'Numeric Value', 'ipt_fsqm' ), 'fit' );

		$sda_items = array();
		$max_key = null;
		foreach ( $data['settings']['options'] as $o_key => $option ) {
			$max_key = max( array( $max_key, $o_key ) );
			$new_data = array(
				0 => array( $name_prefix . '[settings][options][' . $o_key . '][label]', $option['label'], __( 'Enter Option Label', 'ipt_fsqm' ), 'fit' ),
			);
			if ( $score ) {
				$new_data[1] = array( $name_prefix . '[settings][options][' . $o_key . '][score]', $option['score'], __( 'Score (Optional)', 'ipt_fsqm' ), 'fit' );
			}

			if ( ! isset( $option['num'] ) ) {
				$option['num'] = '';
			}
			$new_data[] = array( $name_prefix . '[settings][options][' . $o_key . '][num]', $option['num'], __( 'Numeric Value', 'ipt_fsqm' ), 'fit' );

			$sda_items[] = $new_data;
		}
?>
	<table class="form-table">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;"><h3><?php echo $element['title']; ?></h3></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;" ><span class="description"><?php echo $element['description']; ?></span></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[title]', $data['title'], __( 'Enter Primary Label', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php $this->ui->text( $name_prefix . '[subtitle]', $data['subtitle'], __( 'Description Text (Optional)', 'ipt_fsqm' ), 'large' ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][vertical]', __( 'Label Alignment', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][vertical]', __( 'Vertical', 'ipt_fsqm' ), __( 'Horizontal', 'ipt_fsqm' ), $data['settings']['vertical'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'The alignment of the label(question) and options. Making Horizontal will show the label on left, whereas making vertical will show it on top.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][shuffle]', __( 'Shuffle Options', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][shuffle]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['shuffle'], '1' ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Shuffle the options.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<?php if ( isset( $data['settings']['icon'] ) ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][icon]', __( 'Select Icon', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->icon_selector( $name_prefix . '[settings][icon]', $data['settings']['icon'], __( 'Do not use any icon', 'ipt_fsqm' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the icon you want to appear inside the selected radio/checkbox.', 'ipt_fsqm' ) ) ?></td>
			</tr>
			<?php endif; ?>
			<tr>
				<td colspan="3">
					<?php $this->ui->help( __( 'Enter the options', 'ipt_fsqm' ) . ( $score ? __( 'You can also have score associated to the options. The value of the score should be numeric positive or negative number.', 'ipt_fsqm' ) : '' ) ); ?>
					<?php _e( 'List of Options', 'ipt_fsqm' ); ?>
					<?php $this->ui->clear(); ?>
					<?php $this->ui->sda_list( array(
				'columns' => $sda_columns,
				'labels' => $labels,
			), $sda_items, $sda_data, $max_key ); ?>
				</td>
			</tr>
			<?php if ( !$for_select ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][columns]', __( 'Options Columns', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->layout_select( $name_prefix . '[settings][columns]', $data['settings']['columns'] ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Select the number of columns in which you want the options to appear. Ideally it should be left to 2.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<?php endif; ?>
			<?php if ( $for_select ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][e_label]', __( 'Empty Option Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][e_label]', $data['settings']['e_label'], __( 'Enter the label', 'ipt_fsqm' ), 'large' ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter the label of the first option which will correspond to an empty answer. Leaving it blank will disable this feature.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][others]', __( 'Show Others Option', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->toggle( $name_prefix . '[settings][others]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['settings']['others'], '1', false, true, array( 'condid' => $this->ui->generate_id_from_name( $name_prefix . '[settings][o_label]' )  . '_wrap' ) ); ?>
				</td>
				<td><?php $this->ui->help( __( 'Turn the feature on to show user enterable option.', 'ipt_fsqm' ) ); ?></td>
			</tr>
			<tr id="<?php echo $this->ui->generate_id_from_name( $name_prefix . '[settings][o_label]' )  . '_wrap'; ?>">
				<th><?php $this->ui->generate_label( $name_prefix . '[settings][o_label]', __( 'Others Label', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->text( $name_prefix . '[settings][o_label]', $data['settings']['o_label'], __( 'Enter the label', 'ipt_fsqm' ), 'large' ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Enter the label of the "Other" option.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $this->build_validation( $name_prefix, $element_structure['validation'], $data['validation'] ); ?>
		<?php
		$this->build_conditional( $name_prefix, $data['conditional'] );
		$this->ui->textarea_linked_wp_editor( $name_prefix . '[description]', $data['description'], '' );
	}

	public function build_conditional( $name_prefix, $data, $header_title = '' ) {
		$name_prefix = $name_prefix . '[conditional]';
		$cond_id = $this->generate_id_from_name( $name_prefix ) . '_conditional_type_wrap';
		if ( '' == $header_title ) {
			$header_title = __( 'Conditional Logic', 'ipt_fsqm' );
		}
		$sda_columns = array(
			0 => array(
				'label' => __( '(X)', 'ipt_fsqm' ),
				'size' => '12',
				'type' => 'select',
			),
			1 => array(
				'label' => __( '{KEY}', 'ipt_fsqm' ),
				'size' => '12',
				'type' => 'spinner',
			),
			2 => array(
				'label' => __( 'has', 'ipt_fsqm' ),
				'size' => '15',
				'type' => 'select',
			),
			3 => array(
				'label' => __( 'which', 'ipt_fsqm' ),
				'size' => '15',
				'type' => 'select',
			),
			4 => array(
				'label' => __( 'this value', 'ipt_fsqm' ),
				'size' => '17',
				'type' => 'text',
			),
			5 => array(
				'label' => __( 'rel', 'ipt_fsqm' ),
				'size' => '13',
				'type' => 'select',
			),
		);
		$sda_labels = array(
			'add' => __( 'Add New Logic', 'ipt_fsqm' ),
		);
		$m_type_select = array(
			0 => array(
				'value' => 'mcq',
				'label' => __( '(M) MCQ', 'ipt_fsqm' ),
			),
			1 => array(
				'value' => 'freetype',
				'label' => __( '(F) Feedback & Upload', 'ipt_fsqm' ),
			),
			2 => array(
				'value' => 'pinfo',
				'label' => __( '(O) Others', 'ipt_fsqm' ),
			),
		);
		$has_select = array( // check logic
			0 => array(
				'value' => 'val',
				'label' => __( 'value', 'ipt_fsqm' ),
			),
			1 => array(
				'value' => 'len',
				'label' => __( 'length', 'ipt_fsqm' ),
			),
		);
		$which_is_select = array( // operator logic
			0 => array(
				'value' => 'eq',
				'label' => __( 'equals to', 'ipt_fsqm' ),
			),
			1 => array(
				'value' => 'neq',
				'label' => __( 'not equals to', 'ipt_fsqm' ),
			),
			2 => array(
				'value' => 'gt',
				'label' => __( 'greater than', 'ipt_fsqm' ),
			),
			3 => array(
				'value' => 'lt',
				'label' => __( 'less than', 'ipt_fsqm' ),
			),
			4 => array(
				'value' => 'ct',
				'label' => __( 'contains', 'ipt_fsqm' ),
			),
			5 => array(
				'value' => 'dct',
				'label' => __( 'does not contain', 'ipt_fsqm' ),
			),
			6 => array(
				'value' => 'sw',
				'label' => __( 'starts with', 'ipt_fsqm' ),
			),
			7 => array(
				'value' => 'ew',
				'label' => __( 'ends with', 'ipt_fsqm' ),
			),
		);
		$rel_select = array(
			0 => array(
				'value' => 'and',
				'label' => __( 'AND', 'ipt_fsqm' ),
			),
			1 => array(
				'value' => 'or',
				'label' => __( 'OR', 'ipt_fsqm' ),
			),
		);
		$sda_data_name_prefix = $name_prefix . '[logic][__SDAKEY__]';
		$sda_data = array(
			0 => array( $sda_data_name_prefix . '[m_type]', $m_type_select, 'mcq', false, false, false, true, array( 'fit-text' ) ),
			1 => array( $sda_data_name_prefix . '[key]', '0', __( '{key}', 'ipt_fsqm' ), 0, 500 ),
			2 => array( $sda_data_name_prefix . '[check]', $has_select, 'val', false, false, false, true, array( 'fit-text' ) ),
			3 => array( $sda_data_name_prefix . '[operator]', $which_is_select, 'eq', false, false, false, true, array( 'fit-text' ) ),
			4 => array( $sda_data_name_prefix . '[value]', '', '' ),
			5 => array( $sda_data_name_prefix . '[rel]', $rel_select, 'and', false, false, false, true, array( 'fit-text' ) ),
		);

		$sda_items = array();
		$sda_max_key = null;
		$sda_items_name_prefix = $name_prefix . '[logic][%d]';
		foreach ( (array) $data['logic'] as $s_key => $logic ) {
			$sda_max_key = max( array( $sda_max_key, $s_key ) );
			$sda_items[] = array(
				0 => array( sprintf( $sda_items_name_prefix . '[m_type]', $s_key ), $m_type_select, $logic['m_type'], false, false, false, true, array( 'fit-text' ) ),
				1 => array( sprintf( $sda_items_name_prefix . '[key]', $s_key ), $logic['key'], __( '{key}', 'ipt_fsqm' ), 0, 500 ),
				2 => array( sprintf( $sda_items_name_prefix . '[check]', $s_key ), $has_select, $logic['check'], false, false, false, true, array( 'fit-text' ) ),
				3 => array( sprintf( $sda_items_name_prefix . '[operator]', $s_key ), $which_is_select, $logic['operator'], false, false, false, true, array( 'fit-text' ) ),
				4 => array( sprintf( $sda_items_name_prefix . '[value]', $s_key ), $logic['value'], '' ),
				5 => array( sprintf( $sda_items_name_prefix . '[rel]', $s_key ), $rel_select, $logic['rel'], false, false, false, true, array( 'fit-text' ) ),
			);
		}
		?>
<h3><?php echo $header_title; ?></h3>
<table class="form-table">
	<thead>
		<tr>
			<th colspan="2">
				<?php $this->ui->generate_label( $name_prefix . '[active]', __( 'Use conditional logic on this element', 'ipt_fsqm' ) ); ?>
			</th>
			<td colspan="2">
				<?php $this->ui->toggle( $name_prefix . '[active]', __( 'YES', 'ipt_fsqm' ), __( 'NO', 'ipt_fsqm' ), $data['active'], '1', false, true, array(
					'condid' => $cond_id,
				) ); ?>
			</td>
			<td>
				<?php $this->ui->help( sprintf( __( 'Enable or disable conditional logic for this element. More information can be found <a href="%1$s" target="_blank">at this link</a>.', 'ipt_fsqm' ), 'http://ipanelthemes.com/kb/fsqm/conditional-logic/' ) ); ?>
			</td>
		</tr>
	</thead>
	<tbody id="<?php echo $cond_id ?>">
		<tr>
			<th colspan="2">
				<?php $this->ui->generate_label( $name_prefix . '[status]', __( 'Initial Status', 'ipt_fsqm' ) ); ?>
			</th>
			<td colspan="2">
				<?php $this->ui->toggle( $name_prefix . '[status]', __( 'Shown', 'ipt_fsqm' ), __( 'Hidden', 'ipt_fsqm' ), $data['status'] ); ?>
			</td>
			<td>
				<?php $this->ui->help( __( 'Initial visual status of this element. You can hide it initially and conditionally show it.', 'ipt_fsqm' ) ); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php $this->ui->toggle( $name_prefix . '[change]', __( 'Show', 'ipt_fsqm' ), __( 'Hide', 'ipt_fsqm' ), $data['change'] ); ?>
			</td>
			<th colspan="3">
				<?php $this->ui->generate_label( $name_prefix . '[change]', __( 'this element, if following conditions are true', 'ipt_fsqm' ) ); ?>
			</th>
			<td>
				<?php $this->ui->help_head( __( 'Conditional Logic', 'ipt_fsqm' ) ); ?>
				<p>
					<?php printf( __( 'Here you can build the conditional logic based on existing elements and comparing their value and/or length. When conditional logic is active, the validation logic will have implicit effect, i.e, the validation logic will only be considered, when according to the conditional logic the field is shown. So, you can make an element required, but hidden at first which would only be shown for certain cases. When the case criteria is matched, it would become mandatory for the users to fill this element. More information can be found <a href="%1$s" target="_blank">at this link</a>.', 'ipt_fsqm' ), 'http://ipanelthemes.com/kb/fsqm/conditional-logic/' ); ?>
				</p>
				<p>
					<?php _e( 'Conditional logics are also grouped automatically against the OR operator.', 'ipt_fsqm' ); ?>
				</p>
				<p>
					<?php _e( 'So for instance if you have a logic defined as:<code>C1 AND C2 OR C2 AND C3 AND C4 OR C5 AND C6</code> it will be interpreted as <code>(C1 AND C2) OR (C2 AND C3 AND C4) OR (C5 AND C6)</code>.', 'ipt_fsqm' ); ?>
				</p>
				<p>
					<?php _e( 'If any of the conditions separated by OR is true, the logic is regared as true.', 'ipt_fsqm' ); ?>
				</p>
				<?php $this->ui->help_tail(); ?>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<?php $this->ui->sda_list( array(
					'columns' => $sda_columns,
					'labels' => $sda_labels,
				), $sda_items, $sda_data, $sda_max_key ); ?>
			</td>
		</tr>
	</tbody>
</table>
		<?php
	}

	public function build_validation( $name_prefix, $validation, $data ) {
		$name_prefix = $name_prefix . '[validation]';
		$cond_id = $this->generate_id_from_name( $name_prefix ) . '_validation_type_wrap_';
		$valid_types = array( //phone, url, email, date, number, integer, ipv4, onlyNumberSp, onlyLetterSp, onlyLetterNumber
			array(
				'value' => 'all',
				'label' => __( 'Everything', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'minsize,' . $cond_id . 'maxsize' ),
			),
			array(
				'value' => 'phone',
				'label' => __( 'Phone Number', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'minsize,' . $cond_id . 'maxsize' ),
			),
			array(
				'value' => 'url',
				'label' => __( 'Anchor Links (URL)', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'none' ),
			),
			array(
				'value' => 'email',
				'label' => __( 'Email Address', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'none' ),
			),
			array(
				'value' => 'ipv4',
				'label' => __( 'IP V4 Address Format', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'none' ),
			),
			array(
				'value' => 'number',
				'label' => __( 'Only Numbers (Float or Integers)', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'min,' . $cond_id . 'max' ),
			),
			array(
				'value' => 'integer',
				'label' => __( 'Only Integers', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'min,' . $cond_id . 'max' ),
			),
			array(
				'value' => 'onlyNumberSp',
				'label' => __( 'Only Numbers and Spaces', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'minsize,' . $cond_id . 'maxsize' ),
			),
			array(
				'value' => 'onlyLetterSp',
				'label' => __( 'Only Letters and Spaces', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'minsize,' . $cond_id . 'maxsize' ),
			),
			array(
				'value' => 'onlyLetterNumber',
				'label' => __( 'Only Letters and Numbers', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'minsize,' . $cond_id . 'maxsize' ),
			),
			array(
				'value' => 'onlyLetterNumberSp',
				'label' => __( 'Only Letters, Numbers and Spaces', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'minsize,' . $cond_id . 'maxsize' ),
			),
			array(
				'value' => 'noSpecialCharacter',
				'label' => __( 'No Special Characters', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'minsize,' . $cond_id . 'maxsize' ),
			),
			array(
				'value' => 'personName',
				'label' => __( 'Person\'s Name - eg, Mr. John Doe', 'ipt_fsqm' ),
				'data' => array( 'condid' => $cond_id . 'none' ),
			),
		);

?>
	<h3><?php _e( 'Customize Validation', 'ipt_fsqm' ); ?></h3>
	<table class="form-table">
		<tbody>
			<?php if ( isset( $validation['required'] ) ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[required]', __( 'Compulsory', 'ipt_fsqm' ) ); ?></th>
				<td colspan="2">
					<?php $this->ui->toggle( $name_prefix . '[required]', __( 'Yes', 'ipt_fsqm' ), __( 'No', 'ipt_fsqm' ), $data['required'] ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters'] ) ) : ?>

			<?php if ( isset( $validation['filters']['type'] ) ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][type]', __( 'Input Filter', 'ipt_fsqm' ) ); ?></th>
				<td colspan="2">
					<?php $this->ui->select( $name_prefix . '[filters][type]', $valid_types, $data['filters']['type'], false, true ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters']['min'] ) ) : ?>
			<tr id="<?php echo $cond_id . 'min'; ?>">
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][min]', __( 'Minimum Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[filters][min]', $data['filters']['min'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Validates when the field\'s value is less than, or equal to, the given parameter. Can contain floating number.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters']['max'] ) ) : ?>
			<tr id="<?php echo $cond_id . 'max'; ?>">
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][max]', __( 'Maximum Value', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[filters][max]', $data['filters']['max'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Validates when the field\'s value is more than, or equal to, the given parameter. Can contain floating number.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters']['minSize'] ) ) : ?>
			<tr id="<?php echo $cond_id . 'minsize'; ?>">
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][minSize]', __( 'Minumum Size', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[filters][minSize]', $data['filters']['minSize'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Validates if the element content size (in characters) is more than, or equal to, the given integer.<br /><code>integer <= input.value.length</code>', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters']['maxSize'] ) ) : ?>
			<tr id="<?php echo $cond_id . 'maxsize'; ?>">
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][maxSize]', __( 'Maximum Size', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[filters][maxSize]', $data['filters']['maxSize'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Validates if the element content size (in characters) is less than, or equal to, the given integer.<br /><code>input.value.length <= integer</code>', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters']['past'] ) ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][past]', __( 'Past', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->datepicker( $name_prefix . '[filters][past]', $data['filters']['past'], __( 'Disabled', 'ipt_fsqm' ), true ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Checks if the element\'s value (which is implicitly a date) is earlier than the given date. When "NOW" is used as a parameter, the date will be calculate in the browser.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters']['future'] ) ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][future]', __( 'Future', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->datepicker( $name_prefix . '[filters][future]', $data['filters']['future'], __( 'Disabled', 'ipt_fsqm' ), true ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Checks if the element\'s value (which is implicitly a date) is greater than the given date. When "NOW" is used as a parameter, the date will be calculate in the browser.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters']['minCheckbox'] ) ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][minCheckbox]', __( 'Minimum Selected Checkboxes', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[filters][minCheckbox]', $data['filters']['minCheckbox'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Validates when a minimum of integer checkboxes are selected.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ( isset( $validation['filters']['maxCheckbox'] ) ) : ?>
			<tr>
				<th><?php $this->ui->generate_label( $name_prefix . '[filters][maxCheckbox]', __( 'Maximum Selected Checkboxes', 'ipt_fsqm' ) ); ?></th>
				<td>
					<?php $this->ui->spinner( $name_prefix . '[filters][maxCheckbox]', $data['filters']['maxCheckbox'], __( 'Disabled', 'ipt_fsqm' ) ); ?>
				</td>
				<td>
					<?php $this->ui->help( __( 'Limits the maximum number of selected check boxes.', 'ipt_fsqm' ) ); ?>
				</td>
			</tr>
			<?php endif; ?>

			<?php endif; ?>
		</tbody>
	</table>
		<?php
	}
}
