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
class Widget extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('social_commands_model', 'commands');
    }

    function index()
    {
        $this->load->view('widget/index');
    }

}