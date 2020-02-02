<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Controller {

    public function __construct() {
        parent::__construct();
        checkAdminlogin();
        $this->load->model('Common_model', 'common_model');

        $this->perpageSuffix = "";
        $this->filterSuffix = "";

        if ($this->input->get('perpage'))
            $this->perpageSuffix = "?perpage=" . $this->input->get('perpage');

        if ($this->input->get('keyword')) {
            $this->filterSuffix = "?keyword=" . $this->input->get('keyword');
            if ($this->input->get('perpage'))
                $this->perpageSuffix = "&perpage=" . $this->input->get('perpage');
        }

        $this->suffix = $this->filterSuffix . $this->perpageSuffix;
        $this->table = TBL_ADS;
    }

    public function index() {

        $config = init_pagination();

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/ads/index" . $this->perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/ads/index" . $this->suffix;

        $config['suffix'] = $this->suffix;
        $config['base_url'] = base_url() . "index.php/ads/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = "select * from " . $this->table;

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " Where (image like '%$keyword%')";
        }

        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $data['ads'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);

        $data['title'] = 'ADs | FAZA Admin';
        $data['view'] = 'ads/index';
        $this->load->view('layouts/layout', $data);
    }

    public function add() {
        if ($this->input->post('save')) {

            $flag = 0;
            if ($_FILES['image']['name'] != '') {

                $exts = explode(".", $_FILES['image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];

                $path = realpath('../HelpYa_WS/adsimage');
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '2048';
//                $config['min_width'] = '128';
//                $config['max_width'] = '128';
//                $config['min_height'] = '128';
//                $config['max_height'] = '128';
                $config['file_name'] = $name;
                $this->upload->initialize($config);

//                pr($config);
                if (!$this->upload->do_upload('image')) {
                    $flag = 1;
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    $file_info = $this->upload->data();
                    $userProfile['image'] = $file_info['file_name'];
                }
            }
            if ($flag != 1) {
                $data = array(
                    'url' => $this->input->post('url'),
                    'image' => $userProfile['image'],
                    'is_active' => $this->input->post('is_active')
                );

                $this->common_model->add($this->table, $data);
                $this->session->set_flashdata('success', 'Ads added succesfully.');
                redirect('ads');
            } else {
                redirect('ads/add');
            }
        }
        $data['title'] = 'Add Ad | FAZA Admin';
        $data['view'] = 'ads/add';
        $this->load->view('layouts/layout', $data);
    }

    public function edit($id = NULL) {
        if ($id != '') {
            if ($this->input->post('save')) {

              $flag = 0;
                $image = $this->common_model->getFieldByIdAD($id, 'image', $this->table);
                $userData['image'] = $image->image;
                if ($_FILES['image']['name'] != '') {

                    $exts = explode(".", $_FILES['image']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];

                    $path = realpath('../HelpYa_WS/adsimage');
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['max_size'] = '2048';
//                $config['min_width'] = '128';
//                $config['max_width'] = '128';
//                $config['min_height'] = '128';
//                $config['max_height'] = '128';
                    $config['file_name'] = $name;
                    $this->upload->initialize($config);

               if (!$this->upload->do_upload('image')) {
                        $flag = 1;
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    } else {
                        unlink('./' . AD_IMAGES . '/' . $image->image);

                        $file_info = $this->upload->data();
                        $userData['image'] = $file_info['file_name'];
                    }
                }
                if ($flag != 1) {
                    $data = array(
                        'url' => $this->input->post('url'),
                        'image' => $userData['image'],
                        'is_active' => $this->input->post('is_active')
                    );

                    $this->common_model->edit_ad_image($id, $data, $this->table);
                    $this->session->set_flashdata('success', 'Ads updated succesfully.');
                    redirect('ads');
                } else {
                    redirect('ads/add');
                }
            }
            $data['ad'] = $this->common_model->view_ad($id, $this->table);
            $data['title'] = 'Edit Ad | FAZA Admin';
            $data['view'] = 'ads/add';
            $this->load->view('layouts/layout', $data);
        }
    }
    
     public function delete($id = NULL) {
        if ($id != '') {
            $this->common_model->delete($id, $this->table,'ad_id');
            $this->session->set_flashdata('success', "Ad Deleted Successfully");
//            redirect('users' . $this->suffix);
            redirect($this->agent->referrer());
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function deleteAll() {
        $ids = $this->input->post('ids');
        $idsArr = explode(',', $ids);

        if (count($idsArr) > 1)
            $this->session->set_flashdata('success', "Ad Deleted Successfully");
        else
            $this->session->set_flashdata('success', "Ads Deleted Successfully");
        $this->common_model->deleteMultiple($ids, $this->table,'ad_id');

        exit;
    }
    
    public function view($id){
        if ($id != '') {
            $data['ad'] = $this->common_model->view($id, $this->table,'ad_id');
//            pr($data['skill'],1);
            $data['title'] = 'View Ad | FAZA Admin';
            $data['view'] = 'ads/view';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

}
