<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Branches extends CI_Controller {

    public function __construct() {
        parent::__construct();
        checkAdminlogin();
        $this->load->model('Common_model', 'common_model');
        $this->table = TBL_BRANCHES;
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
        $query = "select *,br.name as branch_name,b.name as bank_name,br.is_active as branch_active from " . $this->table . "  br Left join " . TBL_BANKS . " b on b.bank_id=br.bank_id";
        $config = init_pagination();
        $perpageSuffix = "";
        $filterSuffix = "";

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/branches/index" . $perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/branches/index" . $this->suffix;

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " Where (br.name like '%$keyword%'";
            $query.=" OR ";
            $query.= "b.name like '%$keyword%')";
        }

        $config['base_url'] = base_url() . "index.php/branches/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        $data['branches'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);
//        pr($data['banks'],1);
        $data['title'] = 'Branches | FAZA Admin';
        $data['view'] = 'branches/index';

        $this->load->view('layouts/layout', $data);
    }
    
    public function sortData() {
        $query = "select *,br.name as branch_name,b.name as bank_name,br.is_active as branch_active from " . $this->table . "  br Left join " . TBL_BANKS . " b on b.bank_id=br.bank_id";
        $conj='';
        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
             $conj.= " AND (br.name like '%$keyword%'";
            $conj.=" OR ";
            $conj.= "b.name like '%$keyword%')";
        }

        $query.= " Where branch_id >= '" . $this->input->post('startId') . "' AND branch_id <= '" . $this->input->post('endId') . "'".$conj." order by " . $this->input->post('field') . " " . $this->input->post('sorting');
//        echo $query;
        $data['branches'] = $this->common_model->customQuery($query, 2);
//        pr($data['countries']);
        $data['postdata'] = $this->input->post();
        $this->load->view("branches/sortdata", $data);
    }

    public function add() {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $name = ucwords($this->input->post('name'));
			            $frenchname = ucwords($this->input->post('frenchname'));

            $check = $this->common_model->isUnique('name', $name, $this->table);
            if (!$check) {
                $data = $this->input->post();
                $data1['bank_id'] = $data['bank_id'];
                $data1['name'] = $name;
                   $data1['french_name'] = $frenchname;
				//print_r($data1);die;
                $this->common_model->add($this->table, $data1);
                $this->session->set_flashdata('success', 'Branch added successfully');
                redirect('branches');
            } else {
                $this->session->set_flashdata('error', 'Branch name already exist. Please try again');
                redirect('branches/add');
            }
        }
        $data['title'] = 'Add Branch | FAZA Admin';
        $data['view'] = 'branches/add';
        $data['banks'] = $this->common_model->getArray(TBL_BANKS);
        $this->load->view('layouts/layout', $data);
    }
    
     public function edit($id = null) {

        $data['branch'] = $this->common_model->view($id, $this->table, 'branch_id');
//        pr($data,1);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $branchname = ucwords($this->input->post('name'));

            $check = $this->common_model->isUniqueBranch('name', $branchname, $this->table, $id);
            if (!$check) {
                $data1['name'] = $branchname;
                $data1['bank_id'] = $this->input->post('bank_id');
                $this->common_model->edit_table($id, 'branch_id', $data1, $this->table);
                $this->session->set_flashdata('success', 'Branch Updated Successfully');
                redirect('branches');
            } else {
                $this->session->set_flashdata('error', 'Branch name already exist. Please try again');
                redirect('branches/edit/' . $id);
            }
        }
         $data['banks'] = $this->common_model->getArray(TBL_BANKS);
        $data['title'] = 'Edit Branch | FAZA Admin';
        $data['view'] = 'branches/add';
        $this->load->view('layouts/layout', $data);
    }
    
    public function changeStatusByAdmin($id = NULL) {
//        $id = $this->input->post('id');
        if ($id != null) {
            $status = $this->common_model->getField($id, 'is_active', $this->table, 'branch_id');
            if ($status->is_active == 0) {
                $st = 1;
            } else {
                $st = 0;
            }
            $data = array(
                'is_active' => $st
            );
            $this->common_model->edit_table($id, 'branch_id', $data, $this->table);
            $this->session->set_flashdata('success', "Branch " . (($status->is_active == 0) ? "Deactivated" : "Activated") . " Successfully.");
            redirect($this->agent->referrer());
        } else {
            $this->load->view('layouts/error404');
        }
    }
    
    public function delete($id = NULL) {
        if ($id != '') {
            $this->common_model->delete($id, $this->table, 'branch_id');
            $this->session->set_flashdata('success', "Branch Deleted Successfully");
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
            $this->session->set_flashdata('success', "Branches Deleted Successfully");
        else
            $this->session->set_flashdata('success', "Branch Deleted Successfully");
        $this->common_model->deleteMultiple($ids, $this->table, 'branch_id');

        exit;
    }
}