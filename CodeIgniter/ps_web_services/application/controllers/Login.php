<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model','login_model');
		$this->load->model('Common_model','common_model');
       
        $this->table = TBL_ADMIN;
    }

    /* Display the login page for Admin */

    public function index() {
        /* Check if the Admin is already logged in */
        if ($this->session->userdata('admin_logged_in')) {
            redirect('home');
        }
        $this->load->view('login');
    }

    public function login() {		
        $uname = $this->input->post('email');
        $password = $this->input->post('password');
        $result = $this->login_model->check_user($uname, $password);
       
        if ($result) {
             $settings = $this->common_model->viewAll('settings', "");
             $this->session->set_userdata('settings', $settings);
            $userdata = $this->session->set_userdata('admin_logged_in', $result);
            redirect('home');
            exit;
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password!');
            $this->load->view('login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        redirect('login');
    }

}
