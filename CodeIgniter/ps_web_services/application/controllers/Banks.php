<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        checkAdminlogin();
        $this->load->model('Common_model', 'common_model');
        $this->table = TBL_BANKS;
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
        $query = "select *,b.name as bank_name,c.name as country_name,b.is_active as bank_active from " . $this->table . "  b Left join " . TBL_COUNTRY . " c on c.country_id=b.country_id";
        $config = init_pagination();
        $perpageSuffix = "";
        $filterSuffix = "";

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/banks/index" . $perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/banks/index" . $this->suffix;

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " Where (b.name like '%$keyword%'";
            $query.=" OR ";
            $query.= "c.name like '%$keyword%')";
        }

        $config['base_url'] = base_url() . "index.php/banks/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        $data['banks'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);
//        pr($data['banks'],1);
        $data['title'] = 'Banks | FAZA Admin';
        $data['view'] = 'banks/index';

        $this->load->view('layouts/layout', $data);
    }

    public function sortData() {
        $query = "select *,b.name as bank_name,c.name as country_name,b.is_active as bank_active,b.country_id as bank_country_id from " . $this->table . "  b Left join " . TBL_COUNTRY . " c on c.country_id=b.country_id";
$conj = '';
        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $conj.= " AND (b.name like '%$keyword%'";
            $conj.=" OR ";
            $conj.= "c.name like '%$keyword%')";
        }

        $query.= " Where bank_id >= '" . $this->input->post('startId') . "' AND bank_id <= '" . $this->input->post('endId') . "'".$conj." order by " . $this->input->post('field') . " " . $this->input->post('sorting');
//        echo $query;
        $data['banks'] = $this->common_model->customQuery($query, 2);
//        pr($data['countries']);
        $data['postdata'] = $this->input->post();
        $this->load->view("banks/sortdata", $data);
    }

    public function add() {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $name = ucwords($this->input->post('name'));
            $check = $this->common_model->isUnique('name', $name, $this->table);
            if (!$check) {
                $data = $this->input->post();
                $data1['country_id'] = $data['country_id'];
                $data1['name'] = $name;
               
                $this->common_model->add($this->table, $data1);
                $this->session->set_flashdata('success', 'Bank added successfully');
                redirect('banks');
            } else {
                $this->session->set_flashdata('error', 'Bank name already exist. Please try again');
                redirect('banks/add');
            }
        }
        $data['title'] = 'Add Bank | FAZA Admin';
        $data['view'] = 'banks/add';
        $data['countries'] = $this->common_model->getArray(TBL_COUNTRY);
        $this->load->view('layouts/layout', $data);
    }

    public function edit($id = null) {

        $data['bank'] = $this->common_model->view($id, $this->table, 'bank_id');
//        pr($data,1);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

//                $data = $this->input->post();
            $bankname = ucwords($this->input->post('name'));

//                $data['country_name'] = ucwords('name_en');
            $check = $this->common_model->isUniqueBank('name', $bankname, $this->table, $id);
            if (!$check) {
                $data1['name'] = $bankname;
                $data1['country_id'] = $this->input->post('country_id');
                $this->common_model->edit_table($id, 'bank_id', $data1, $this->table);
                $this->session->set_flashdata('success', 'Bank Updated Successfully');
                redirect('banks');
            } else {
                $this->session->set_flashdata('error', 'Bank name already exist. Please try again');
                redirect('banks/edit/' . $id);
            }
        }
         $data['countries'] = $this->common_model->getArray(TBL_COUNTRY);
        $data['title'] = 'Edit Bank | FAZA Admin';
        $data['view'] = 'banks/add';
        $this->load->view('layouts/layout', $data);
    }
    
    public function changeStatusByAdmin($id = NULL) {
//        $id = $this->input->post('id');
        if ($id != null) {
            $status = $this->common_model->getField($id, 'is_active', $this->table, 'bank_id');
            if ($status->is_active == 0) {
                $st = 1;
            } else {
                $st = 0;
            }
            $data = array(
                'is_active' => $st
            );
            $this->common_model->edit_table($id, 'bank_id', $data, $this->table);
            $this->session->set_flashdata('success', "Bank " . (($status->is_active == 0) ? "Deactivated" : "Activated") . " Successfully.");
            redirect($this->agent->referrer());
        } else {
            $this->load->view('layouts/error404');
        }
    }
    
    public function delete($id = NULL) {
        if ($id != '') {
            $this->common_model->delete($id, $this->table, 'bank_id');
            $this->session->set_flashdata('success', "Bank Deleted Successfully");
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
            $this->session->set_flashdata('success', "Banks Deleted Successfully");
        else
            $this->session->set_flashdata('success', "Bank Deleted Successfully");
        $this->common_model->deleteMultiple($ids, $this->table, 'bank_id');

        exit;
    }

}
