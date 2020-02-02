<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property authority $authority
 * @property CI_Email $email
 * @property CI_Session $session
 * @property CI_DB_active_record $db
 * @property Social_commands_model $commands
 */
class Commands extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('social_commands_model', 'commands');
    }

    function index()
    {
        $vars['commands'] = $this->commands->get_all();
        $this->admin_view('commands/index', $vars);
    }

    function edit($id = '')
    {
        $this->load->library('form_validation');

        $this->set_last_url('commands/edit/' . $id);
        $this->is_logged();
        $this->_admin_check_right_redirect();
        $this->form_validation->set_rules('command', 'Command', 'trim|required|xss_clean');
        $this->form_validation->set_rules('response', 'Response', 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {
            $this->demo_mode('commands'); // cancel the action on demo mode
            $stdClass = new stdClass();
            $stdClass->command = $this->input->post('command');
            $stdClass->response = $this->input->post('response');
            $this->commands->update($id, $stdClass);
            $this->session->set_flashdata('success_msg', 'Data Updated');
            redirect('commands/index#' . $id);
        }

        $vars['command'] = $this->commands->get($id);
        $vars['form_title'] = 'Edit Command';
        $vars['form_action'] = 'commands/edit/' . $id;
        $vars['form_submit'] = 'Update';
        $vars['form_icon'] = 'uk-icon-pencil';
        $this->admin_view('commands/add-edit', $vars);
    }

    function add()
    {
        $this->load->library('form_validation');

        $this->set_last_url('commands/add');
        $this->is_logged();
        $this->_admin_check_right_redirect();
        $this->form_validation->set_rules('command', 'Command', 'trim|required|xss_clean|max_length[50]');
        $this->form_validation->set_rules('response', 'Response', 'trim|required|xss_clean|max_length[50]');

        if ($this->form_validation->run() == true) {
            $stdClass = new stdClass();
            $stdClass->command = $this->input->post('command');
            $stdClass->response = $this->input->post('response');
            $stdClass->created_date = date('Y-m-d');
            $this->commands->insert($stdClass);
            $this->session->set_flashdata('success_msg', 'Data Inserted');
            redirect('commands');
        }

        $vars['form_title'] = 'Add Command';
        $vars['form_action'] = 'commands/add';
        $vars['form_submit'] = 'Add';
        $vars['form_icon'] = 'uk-icon-plus';
        $this->admin_view('commands/add-edit', $vars);
    }

    function delete($id = 0)
    {
        $this->demo_mode('commands'); // cancel the action on demo mode
        $this->commands->delete($id);
        redirect('commands');
    }

}