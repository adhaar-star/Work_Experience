<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class View extends Fuel_base_controller {
	
	public $module_obj; // the module object
	public $module = 'jobs'; // the name of the module
	public $uploaded_data = array(); // reference to the uploaded data

	protected $_orig_post = array(); // used for reference
	
	function __construct($validate = TRUE)
	{
		parent::__construct($validate);

		$this->load->module_model(FUEL_FOLDER, 'fuel_archives_model');

		if (empty($this->module))
		{
			$this->module = fuel_uri_segment(1);
		}

		if (empty($this->module))
		{
			show_error(lang('cannot_determine_module'));
		}
		
		$params = array();

		if ($this->fuel->modules->exists($this->module, FALSE))
		{
			$this->module_obj = $this->fuel->modules->get($this->module, FALSE);
			$params = $this->module_obj->info();
		}
		else if ($this->fuel->modules->exists($this->module.'_'.fuel_uri_segment(2), FALSE))
		{
			// if it is a module with multiple controllers, then we'll check first and second FUEL segment with an underscore'
			$this->module = $this->module.'_'.fuel_uri_segment(2);

			if ($this->fuel->modules->exists($this->module, FALSE))
			{
				$this->module_obj = $this->fuel->modules->get($this->module, FALSE);
				$params = $this->module_obj->info();
			}
		}
		else if ($this->fuel->modules->exists(fuel_uri_segment(2), FALSE))
		{
			$this->module = fuel_uri_segment(2);
			$this->module_obj = $this->fuel->modules->get($this->module, FALSE);

			if ($this->module_obj)
			{
				$mod_name = $this->module_obj->name();	
			}
			
			if (empty($mod_name))
			{
				show_error(lang('error_missing_module', fuel_uri_segment(1)));
			}

			unset($mod_name);
			$params = $this->module_obj->info();
		}

		// stop here if the module is disabled
		if ($params['disabled'] === TRUE)
		{
			show_404();
		}
		foreach($params as $key => $val)
		{
			$this->$key = $val;
		}
		
		// load any configuration
		if ( ! empty($this->configuration))
		{
			if (is_array($this->configuration))
			{
				$config_module = key($this->configuration);
				$config_file = current($this->configuration);

				$this->config->module_load($config_module, $config_file);
			}
			else
			{
				$this->config->load($this->configuration);
			}
		}
		
		// load any language
		if ( ! empty($this->language))
		{
			if (is_array($this->language))
			{
				$lang_module = key($this->language);
				$lang_file = current($this->language);

				// now check to see if we need to load the language file or not... 
				// we load the main language file automatically with the Fuel_base_controller.php
				$this->load->module_language($lang_module, $lang_file, $this->fuel->auth->user_lang());
			}
			else
			{
				$this->load->language($this->language);
			}
		}
		
		// load the model
		if ( ! empty($this->model_location))
		{
			$this->load->module_model($this->model_location, $this->model_name);
		}
		else
		{
			$this->load->model($this->model_name);
		}
		
		// get the model name
		$model_parts = explode('/', $this->model_name);
		$model = end($model_parts);
		
		// set the module_uri
		if (empty($this->module_uri)) $this->module_uri = $this->module;
		
		$this->js_controller_params['module'] = $this->module_uri;

		if ( ! empty($model))
		{
			$this->model =& $this->$model;
		}
		else
		{
			show_error(lang('incorrect_route_to_module'));
		}
		
		// global variables
		$vars = array();

		if ( ! empty($params['js']))
		{
			if (is_string($params['js']))
			{
				$params['js'] = preg_split("/,\s*/", $params['js']);
			}

			$vars['js'] = $params['js'];
		}
		
		if ( ! empty($this->nav_selected)) $vars['nav_selected'] = $this->nav_selected;

		$this->load->vars($vars);

		$this->fuel->admin->load_js_localized($params['js_localized']);

		if ( ! empty($this->permission) AND $validate)
		{
			$this->_validate_user($this->permission);
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Displays the list (table) view
	 *
	 * @access	public
	 * @return	void
	 */
	function index($id = NULL, $field = NULL, $redirect = TRUE)
	{
	if ( ! $this->fuel->auth->module_has_action('save') AND  $this->displayonly === FALSE)
		{
			show_404();
		}

		// check permissions
		if ( ! $this->fuel->auth->has_permission($this->module_obj->permission, 'edit') AND ! $this->fuel->auth->has_permission($this->module_obj->permission, 'create'))
		{
			show_error(lang('error_no_permissions'));
		}

		$inline = $this->fuel->admin->is_inline();

		if ($this->input->post($this->model->key_field()))
		{
			if ($this->_process_edit($id) AND !has_errors())
			{
				if ($inline === TRUE)
				{
					$url = fuel_uri.($this->module_uri.'/inline_edit/'.$id.'/'.$field);
				}
				else
				{
					$url = fuel_uri.($this->module_uri.'/edit/'.$id.'/'.$field);
				}

				if ($redirect)
				{
					if ( ! $this->fuel->admin->has_notification(Fuel_admin::NOTIFICATION_SUCCESS))
					{
						$this->fuel->admin->set_notification(lang('data_saved'), Fuel_admin::NOTIFICATION_SUCCESS);
					}

					redirect($url);
				}
			}
		}

		//$vars = $this->_form($id);
		$data = $this->_saved_data($id);
		
		$action = ( ! empty($data[$this->model->key_field()])) ? 'edit' : 'create';
	
		// check model first for preview path method
		if (method_exists($this->model, 'preview_path'))
		{
			$this->preview_path = $this->model->preview_path($data, $this->preview_path);
		}
		else
		{
			// otherwise, substitute data values into preview path
			$this->preview_path = $this->module_obj->url($data);	
		}

		$shell_vars = $this->_shell_vars($id, $action);
		$form_vars = $this->_form_vars($id, $data, $field, $inline);

		$vars = array_merge($shell_vars, $form_vars);
		$vars['data'] = $data;
		$vars['action'] = $action;
		$vars['related_items'] = $this->model->related_items($data);

		// active or publish fields
		if (isset($data['published']))
		{
			$vars['publish'] = ( ! empty($data['published']) AND is_true_val($data['published'])) ? 'unpublish' : 'publish';
		}
		
		if (isset($data['active']))
		{
			$vars['activate'] = ( ! empty($data['active']) AND is_true_val($data['active'])) ? 'deactivate' : 'activate';
		}

		if ( ! empty($field))
		{
			$this->fuel->admin->set_display_mode(Fuel_admin::DISPLAY_COMPACT_NO_ACTION);
		}
		else if ($inline === TRUE)
		{
			$this->fuel->admin->set_display_mode(Fuel_admin::DISPLAY_COMPACT);
		}
     

		$crumbs = array($this->module_uri => $this->module_name);

		if ( ! empty($data[$this->display_field]))
		{
			$crumbs[''] = character_limiter(strip_tags($data[$this->display_field]), 50);
		}

		$this->fuel->admin->set_titlebar($crumbs);

		$vars['actions'] = $this->load->module_view(FUEL_FOLDER, '_blocks/module_view_action', $vars, TRUE);
	$this->fuel->admin->render('modules/module_view', $vars, '', FUEL_FOLDER);
        
	
		// do this after rendering so it doesn't render current page'
		if ( ! empty($data[$this->display_field]) AND $inline !== TRUE)
		{
			$this->fuel->admin->add_recent_page($this->uri->uri_string(), $this->module_name.': '.$data[$this->display_field], $this->module);
		}
		
	}
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Displays the list (table) view
	 *
	 * @access	public
	 * @return	void
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Displays the list (table) view but inline without the left menu
	 *
	 * @access	public
	 * @return	void
	 */	
	function inline_items()
	{
		$this->items(TRUE);
	}

	// --------------------------------------------------------------------
	
	/**
	 * Processes the list view filters and returns an array of parameters
	 *
	 * @access	protected
	 * @return	array
	 */	
	
	// --------------------------------------------------------------------
	
	/**
	 * Adds filters to the model
	 *
	 * @access	protected
	 * @return	void
	 */	
	function _filter_list($params)
	{
		// create search filter
		$filters[$this->display_field] = trim($params['search_term']);
		
		// sort of hacky here... to make it easy for the model to just filter on the search term (like the users model)
		$this->model->filter_value = trim($params['search_term']);

		foreach($this->filters as $key => $val)
		{
			$filters[$key] = $params[$key];

			if ( ! empty($val['filter_join']))
			{
				if ( ! is_array($this->model->filter_join[$key]))
				{
					settype($this->model->filter_join, 'array');
				}

				$this->model->filter_join[$key] = $val['filter_join'];
			}
		}

		// set model filters before pagination and setting table data
		if (method_exists($this->model, 'add_filters'))
		{
			$this->model->add_filters($filters);
		}
	}
	
	
		protected function _process_edit($id)
	{
		$this->model->on_before_post($this->input->post());

		$posted = $this->_process();

		// run before_edit hook
		$this->_run_hook('before_edit', $posted);

		// run before_save hook
		$this->_run_hook('before_save', $posted);

		if ($this->_model->save($posted))
		{
			// process $_FILES...
			if ( ! $this->_process_uploads($posted))
			{
				return FALSE;
			}

			$this->_model->on_after_post($posted);

			if ( ! $this->s_model->is_valid())
			{
				add_errors($this->_model->get_errors());
			}
			else
			{
				// archive data
				$archive_data = $this->_model->cleaned_data();
				if ($this->archivable) $this->_model->archive($id, $archive_data);
				$data = $this->model->find_one_array(array($this->model->table_name().'.'.$this->model->key_field() => $id));

				// run after_edit hook
				$this->_run_hook('after_edit', $data);

				// run after_save hook
				$this->_run_hook('after_save', $data);

				$msg = lang('module_edited', $this->module_name, $data[$this->display_field]);
				$this->fuel->logs->write($msg);
				$this->_clear_cache();

				return TRUE;
			}
		}

		return FALSE;
	}
	
	protected function _shell_vars($id = NULL, $action = 'create')
	{
		$model = $this->model;
		$this->js_controller_params['method'] = 'add_edit';
		$this->js_controller_params['linked_fields'] = $this->model->linked_fields;
		
		// other variables
		$vars['id'] = $id;
		$vars['versions'] = ($this->displayonly === FALSE AND $this->archivable) ? $this->fuel_archives_model->options_list($id, $this->model->table_name()) : array();
		$vars['others'] = $this->model->get_others($this->display_field, $id);
		$vars['action'] = $action;
		
		$vars['module'] = $this->module;
		$vars['notifications'] = $this->load->module_view(FUEL_FOLDER, '_blocks/notifications', $vars, TRUE);
		
		return $vars;
	}
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Returns an array of saved data based on the id value passed
	 *
	 * @access	protected
	 * @param	int		The ID value of the record to edit
	 * @return	array
	 */	
	protected function _saved_data($id)
	{
	
		if (empty($id)) return array();

		$view_method = $this->view_method;

		if ($view_method != 'find_one_array')
		{
			$saved = $this->fuel_jobs_model->$view_method($id);
		}
		else
		{
			$saved = $this->fuel_jobs_model->$view_method(array($this->fuel_jobs_model->table_name().'.'.$this->fuel_jobs_model->key_field() => $id));
		}

		return $saved;
	}
	
	
	// seperated to make it easier in subclasses to use the form without rendering the page
	protected function _form_vars($id = NULL, $values = array(), $field = NULL, $inline = FALSE)
	{
		$this->load->library('form_builder');

		// load custom fields
		$this->form_builder->load_custom_fields(APPPATH.'config/custom_fields.php');

		$model = $this->model;
		$this->js_controller_params['method'] = 'add_edit';
		$action = (!empty($values[$this->model->key_field()])) ? 'edit' : 'create';

		// create fields... start with the table info and go from there
		$fields = (!empty($values)) ? $this->model->form_fields($values) : $this->model->form_fields($_POST);

		// if field parameter is set, then we just display a single field
		if ( ! empty($field))
		{
			// added per pierlo in Forum (http://www.getfuelcms.com/forums/discussion/673/fuel_helper-fuel_edit-markers)
			$columns = explode(':', $field);

			// special case if you use the word required
			if (in_array('required', $columns))
			{
				$columns = array_merge($columns, $this->model->required);
			}

			// set them to hidden... just in case model hooks require the values to be passed on save
			foreach($fields as $k => $f)
			{
				if ( ! in_array($k, $columns))
				{
					$fields[$k]['type'] = 'hidden';
				}

				if (count($columns) <= 1)
				{
					$fields[$k]['display_label'] = FALSE;
					$fields[$k]['required'] = FALSE;
				}
			}
		}

		// set published/active to hidden since setting this is an buttton/action instead of a form field
		$form = '';

		if (is_array($fields))
		{
			$field_values = ( ! empty($_POST)) ? $_POST : $values;

			$published_active = array(
				'publish' => 'published',
				'active' => 'activate'
			);

			foreach($published_active as $k => $v)
			{
				if ( ! $this->fuel->auth->has_permission($this->permission, $k))
				{
					unset($fields[$v]);
				}

				if (isset($fields[$v]) AND !empty($values[$v]))
				{
					$fields['published']['value'] = $values[$v];
				}
			}

			$this->form_builder->set_validator($this->model->get_validation());

			// add hidden field with the module name for convenience
			$common_fields = $this->_common_fields($field_values);
			$fields = array_merge($fields, $common_fields);

			$fields['__fuel_inline_action__'] = array('type' => 'hidden');
			$fields['__fuel_inline_action__']['class'] = '__fuel_inline_action__';
			$fields['__fuel_inline_action__']['value'] = (empty($id)) ? 'create' : 'edit';

			$fields['__fuel_inline__'] = array('type' => 'hidden');
			$fields['__fuel_inline__']['value'] = ($inline) ? 1 : 0;

			$this->form_builder->submit_value = lang('btn_save');
			$this->form_builder->question_keys = array();
			$this->form_builder->use_form_tag = FALSE;

			if ($this->model->has_auto_increment())
			{
				$this->form_builder->hidden = (array) $this->model->key_field();
			}

			$this->form_builder->set_fields($fields);
			$this->form_builder->display_errors = FALSE;
			$this->form_builder->set_field_values($field_values);

			if ($this->config->item('date_format'))
			{
				$this->form_builder->date_format = $this->config->item('date_format');
			}

			if ($inline)
			{
				$this->form_builder->cancel_value = lang('viewpage_close');
			}
			else
			{
				$this->form_builder->cancel_value = lang('btn_cancel');
			}

			// we will set this in the BaseFuelController.js file so that the jqx page variable is available upon execution of any form field js
			//$this->form_builder->auto_execute_js = FALSE;
			if (!isset($fields['__FORM_BUILDER__'], $fields['__FORM_BUILDER__']['displayonly']))
			{
				$this->form_builder->displayonly = $this->displayonly;
			}

			$form = $this->form_builder->render();
		}

		$action_uri = $action.'/'.$id.'/'.$field;
		$vars['form_action'] = ($inline) ? $this->module_uri.'/inline_'.$action_uri : $this->module_uri.'/'.$action_uri;
		$vars['form'] = $form;
		$vars['data'] = $values;
		$vars['error'] = $this->model->get_errors();
		$vars['notifications'] = $this->load->module_view(FUEL_FOLDER, '_blocks/notifications', $vars, TRUE);
		$vars['instructions'] = (empty($field)) ? $this->instructions : '';
		$vars['field'] = (!empty($field));

		return $vars;
	}

	
	
	function form($id = NULL, $field = NULL)
	{
		$saved = $this->_saved_data($id);
		$vars = $this->_form_vars($id, $saved, $field);
		$this->load->module_view(FUEL_FOLDER, '_layouts/module_form', $vars);
	}
	// reduce code by creating this shortcut function for the unpublish/publish

	
	
	protected function _common_fields($values)
	{
		$fields['__fuel_module__'] = array('type' => 'hidden');
		$fields['__fuel_module__']['value'] = $this->module;
		$fields['__fuel_module__']['class'] = '__fuel_module__';

		$fields['__fuel_module_uri__'] = array('type' => 'hidden');
		$fields['__fuel_module_uri__']['value'] = $this->module_uri;
		$fields['__fuel_module_uri__']['class'] = '__fuel_module_uri__';

		$fields['__fuel_id__'] = array('type' => 'hidden');
		$fields['__fuel_id__']['value'] = (!empty($values[$this->model->key_field()])) ? $values[$this->model->key_field()] : '';
		$fields['__fuel_id__']['class'] = '__fuel_id__';

		return $fields;
	}

}