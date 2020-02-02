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
 * @property Admin_model $admin
 */
class Admin extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters('<span class="uk-alert-danger">', '</span>');
        $this->load->library('upload');
        $config['upload_path'] = 'assets/uploads/';
        $config['encrypt_name'] = false;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->upload->initialize($config);
    }

    function index()
    {
        $this->is_logged();
    }

    function setting()
    {
        $this->set_last_url('admin/setting');
        $this->is_logged();
        $this->_admin_check_right_redirect();

        // TODO remove un needed lines from rules
        $this->form_validation->set_rules('website-name', "website name", 'trim|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('title', "title", 'trim|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('description', "description", 'trim|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('keywords', "keywords", 'trim|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('ads-header', "ads-header", 'trim');
        $this->form_validation->set_rules('ads-footer', "ads-footer", 'trim');
        $this->form_validation->set_rules('infront-article-message', "infront-article-message", 'trim|xss_clean');

        if ($this->form_validation->run() == true) {
            $this->demo_mode('admin/setting');
            $post_data = $_POST;
            unset($post_data['submit_input']);
            //dump_exit($post_data);
            foreach($post_data as $key => $value){
                $this->option->update($key, $this->input->post($key));
            }

            $this->session->set_flashdata('success_msg', lang('Data_updated'));
            redirect('admin/setting');
        }



        $this->admin_view('admin/setting');
    }

    function load_visitors(){
        $this->load->view('admin/load_visitors');
    }

    function upgrade()
    {
        $this->load->helper('file_helper');
        $this->set_last_url('admin/setting');
        $this->is_logged();
        $this->_admin_check_right_redirect();
        $this->demo_mode('admin/setting');
        if (array_key_exists('hdphp', $_FILES)) {
            if ($_FILES["hdphp"]['name']) {
                $config['upload_path'] = 'assets/uploads/';
                $config['encrypt_name'] = false;
                $config['allowed_types'] = 'zip';
                $this->upload->initialize($config);
                $new_version = base_url() . 'assets/uploads/' . $this->upload('hdphp');
                $error = $this->upload->display_errors();
                if ($error) {
                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                    redirect('admin/setting#upgrade');
                }
                if ($new_version) {
                    $data = array('upload_data' => $this->upload->data());

                    $zip = new ZipArchive;
                    $file = $data['upload_data']['full_path'];
                    chmod($file, 0777);
                    if ($zip->open($file) === true) {
                        $zip->extractTo('./');
                        $zip->close();
                    }
                    @unlink($file);
                    $this->session->set_flashdata('success_msg', 'Congratulations, your upgrade process succeed');
                    redirect('admin/setting#upgrade');
                }
            } else {
                redirect('admin/setting#upgrade');
            }
        } else {
            $this->session->set_flashdata('error_msg', lang('nothing-selected'));
            redirect('admin/setting#upgrade');
        }
    }

    function custom_style()
    {
        $this->set_last_url('admin/custom_style');
        $this->is_logged();
        $this->_admin_check_right_redirect();
        $this->form_validation->set_rules('css-file', "css-file", 'trim|xss_clean');

        if ($this->form_validation->run() == true) {
            $this->demo_mode('admin/custom_style');
            $this->option->update('css-file', $this->input->post('css-file'));
            // write the new style to style.css file
            $fp = fopen(PUBPATH . 'assets/themes/default/css/style.css', 'w');
            fwrite($fp, $this->input->post('css-file'));
            fclose($fp);

            $this->session->set_flashdata('success_msg', lang('Data_updated'));
            redirect('admin/custom_style');
        }

        $vars['fp'] = file_get_contents(PUBPATH . 'assets/themes/default/css/style.css');
        $this->view('admin/custom_style', $vars);
    }

    function users()
    {
        $this->set_last_url('admin/users');
        $this->is_logged();
        $this->_admin_check_right_redirect();
        $this->db->order_by('user_created_date', 'DESC');
        $vars['users'] = $this->db->get_where('users', array('user_state' => 1))->result();
        $this->view('admin/users', $vars);
    }

    /**
     * @param int $category_id
     */
    function delete_user($user_id = 0)
    {
        $this->set_last_url('admin/users');
        $this->is_logged();
        $this->_admin_check_right_redirect();
        $this->demo_mode('admin/custom_style');
        if ($user_id != 1) {
            $this->session->set_flashdata('error_msg', lang('Data deleted'));
            $this->db->set('user_state', 0);
            $this->db->where('user_id', $user_id);
            $this->db->update('users');
        } else {
            $this->session->set_flashdata('warning_msg', lang('not allowed to delete admin'));
        }

        redirect('admin/users');
    }

}