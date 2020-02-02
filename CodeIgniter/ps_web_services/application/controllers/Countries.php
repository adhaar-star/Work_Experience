<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends CI_Controller {

    public function __construct() {
        parent::__construct();
        checkAdminlogin();
        $this->load->model('Common_model', 'common_model');
        $this->table = TBL_COUNTRY;
        $this->perpageSuffix = "";
        $this->filterSuffix = "";

        if ($this->input->get('perpage'))
            $this->perpageSuffix = "?perpage=" . $this->input->get('perpage');

        if ($this->input->get('lang')) {
            $this->filterSuffix = "?lang=" . $this->input->get('lang') . "&keyword=" . $this->input->get('keyword');
            if ($this->input->get('perpage'))
                $this->perpageSuffix = "&perpage=" . $this->input->get('perpage');
        }
        $this->suffix = $this->filterSuffix . $this->perpageSuffix;
    }

    public function index() {
        $query = "select * from " . $this->table;
        $config = init_pagination();
        $perpageSuffix = "";
        $filterSuffix = "";

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/countries/index" . $perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/countries/index" . $this->suffix;

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " Where (name like '%$keyword%')";
        }

        $config['base_url'] = base_url() . "index.php/countries/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        $data['countries'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);
        
        $data['title'] = 'Countries | FAZA Admin';
        $data['view'] = 'countries/index';

        $this->load->view('layouts/layout', $data);
    }

    public function sortData() {
        $query = "select * from " . $this->table;

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " Where (name like '%$keyword%')";
        }

        $query.= " Where country_id >= '" . $this->input->post('startId') . "' AND country_id <= '" . $this->input->post('endId') . "' order by " . $this->input->post('field') . " " . $this->input->post('sorting');
//        echo $query;
        $data['countries'] = $this->common_model->customQuery($query, 2);
//        pr($data['countries']);
        $data['postdata'] = $this->input->post();
        $this->load->view("countries/sortdata", $data);
    }
    
    public function add() {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $name = ucwords($this->input->post('name'));
            $check = $this->common_model->isUnique('name', $name, $this->table);
            if (!$check) {
                $data = $this->input->post();
                $data['name'] = $name;
                $this->common_model->add($this->table, $data);
                $this->session->set_flashdata('success', 'Country added successfully');
                redirect('countries');
            } else {
                $this->session->set_flashdata('error', 'Country name already exist. Please try again');
                redirect('countries/add');
            }
        }
        $data['title'] = 'Add Country | FAZA Admin';
        $data['view'] = 'countries/add';
        $this->load->view('layouts/layout', $data);
    }

    public function edit($id = null) {

        $data['country'] = $this->common_model->view($id, $this->table, 'country_id');
//        pr($data,1);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

//                $data = $this->input->post();
            $countryname = ucwords($this->input->post('name'));

//                $data['country_name'] = ucwords('name_en');
            $check = $this->common_model->isUniqueCountry('name', $countryname, $this->table, $id);
            if (!$check) {
                $data1['name'] = $countryname;
                $this->common_model->edit_tbale($id, 'country_id', $data1, $this->table);
                $this->session->set_flashdata('success', 'Country Updated Successfully');
                redirect('countries');
            } else {
                $this->session->set_flashdata('error', 'Country name already exist. Please try again');
                redirect('countries/edit/' . $id);
            }
        }
        $data['title'] = 'Edit Country | FAZA Admin';
        $data['view'] = 'countries/add';
        $this->load->view('layouts/layout', $data);
    }

    public function delete($id = NULL) {
        if ($id != '') {
            $this->common_model->delete($id, $this->table, 'country_id');
            $this->session->set_flashdata('success', "Country Deleted Successfully");
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
            $this->session->set_flashdata('success', "Country Deleted Successfully");
        else
            $this->session->set_flashdata('success', "Country Deleted Successfully");
        $this->common_model->deleteMultiple($ids, $this->table, 'country_id');

        exit;
    }
    public function changeStatusByAdmin($id = NULL) {
//        $id = $this->input->post('id');
        if ($id != null) {
            $status = $this->common_model->getField($id, 'is_active', $this->table,'country_id');
            if($status->is_active == 0){
                $st =1;
            }
            else{ 
                $st = 0;
            }
            $data = array(
                'is_active'=> $st
            );
            $this->common_model->edit_table($id,'country_id', $data, $this->table);
            $this->session->set_flashdata('success', "Country " . (($status->is_active == 0) ? "Deactivated" : "Activated") . " Successfully.");
            redirect($this->agent->referrer());
        } else {
            $this->load->view('layouts/error404');
        }
    }
}
