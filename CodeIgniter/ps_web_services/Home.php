<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_isvalidated();
        $this->load->model('login_model');
        $this->load->model('Common_model','common_model');
    }

    public function index() {

        $data['title'] = 'Dashboard | FAZA Admin';
        $data['view'] = 'dashboard';

        $this->load->view('layouts/layout', $data);
    }

    public function changePassword() {
        $data['title'] = 'Change Password | FAZA Admin';
        $data['view'] = 'changepassword';

        if ($this->input->post('save')) {
            $adminId = $this->session->userdata('admin_logged_in')['id'];
            $adminData = $this->login_model->getAdminByID($adminId);
            
            $oldpwd = md5($this->input->post('oldpassword'));
            
            if ($oldpwd != $adminData['password']) {
                $this->session->set_flashdata('error', 'Fail to change the Password.Old password does not match!');
            } else {
                $this->login_model->changePassword($this->input->post('password'), $adminId);
                $this->session->set_flashdata('success', 'Password has been changed successfully');
                redirect($this->agent->referrer());
            }
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/layout', $data);
        }
    }

   /* Change Admin Profile */

    public function changeProfile() {

        $adminId = $this->session->userdata('admin_logged_in')['id'];

        if ($this->input->post('save')) {

            if ($this->login_model->checkEmailExist(trim($this->input->post('email')), $adminId) > 0) {
                $this->session->set_flashdata('error', 'Email Id already exists');
                redirect('home/changeProfile');
            }
            $adminOldImage = $this->common_model->view($adminId, TBL_ADMIN, 'profile_image');
            $flag = 0;
            $adminData = $this->input->post();
            unset($adminData['save']);

            if ($_FILES['profile_image']['name'] != '') {
                
                $exts = explode(".", $_FILES['profile_image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];
                
                $config['upload_path'] = './' . PROFILE_IMAGES . '/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '2048';
                //$config['max_width'] = '1024';
                //$config['max_height'] = '768';
                $config['file_name'] = $name;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('profile_image')) {
                    $flag = 1;
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    @unlink('./' . PROFILE_IMAGES . '/' . $adminOldImage->profile_image);
                    $file_info = $this->upload->data();
                    $adminData['profile_image'] = $file_info['file_name'];
                }
            }
            if ($flag != 1) {
                if ($this->login_model->updateAdminData($adminData, $adminId)) {
                    $this->session->set_flashdata('success', 'Profile has been edited successfully');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('error', 'Fali to edit profile.Please try again');
                    redirect($this->agent->referrer());
                }
            }
        }

        $data = $this->login_model->getAdminByID($adminId);
        $data['title'] = 'Edit Profile | FAZA Admin';
        $data['view'] = 'profile';
        $this->load->view('layouts/layout', $data);
    }

}
