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
 * @property messages_model $messages
 */
class Messages extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->demo_mode('admin/setting');
        $this->load->model('messages_model', 'messages');
    }

    function index()
    {
       $this->load->helper('text');
       $this->db->group_by('email');
       $this->db->group_by('date');
       $this->db->order_by('date','DESC');
       $vars['messages'] = $this->messages->get_all();
       $this->admin_view('messages/index', $vars);
    }

    function delete($ip = 0)
    {
       $this->demo_mode('messages'); // cancel the action on demo mode
       $this->db->where('ip',$ip);
       $this->db->delete('messages');
       redirect('messages');
    }

    function details($data='')
    {
        $data = ($data);
        $data = explode('IPDATE',$data);
        $ip = base64_decode($data[0]);
        $date = $data[1];
        $vars['messages'] = $this->messages->get_many_by(array('ip' => $ip,'date' => $date));
        $vars['ip'] = $ip;
        $vars['date'] = $date;
        $this->view('messages/details',$vars);
    }
}