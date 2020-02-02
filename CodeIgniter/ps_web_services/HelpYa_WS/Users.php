<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
        $this->table = TBL_USERS;
    }

    public function index() {
        $config = init_pagination();

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/users/index" . $this->perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/users/index" . $this->suffix;

        $config['suffix'] = $this->suffix;
        $config['base_url'] = base_url() . "index.php/users/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = "select * from " . $this->table;

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " Where (user_name like '%$keyword%')";
            $query.= " Or (email like '%$keyword%')";
        }

        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $data['users'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);

        $data['title'] = 'Users Details | FAZA Admin';
        $data['view'] = 'users/index';
        $this->load->view('layouts/layout', $data);
    }

    public function sortData() {
        $query = "select * from " . $this->table;
        $conj = '';
        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $conj.= " AND (user_name like '%$keyword%')";
            $conj.= " Or (email like '%$keyword%')";
        }

        $query.= " Where user_id >= '" . $this->input->post('startId') . "' AND user_id <= '" . $this->input->post('endId') . "'" . $conj . "  order by " . $this->input->post('field') . " " . $this->input->post('sorting');
        $data['users'] = $this->common_model->customQuery($query, 2);
        $data['postdata'] = $this->input->post();
        $this->load->view("/users/sortdata", $data);
    }

    public function view($id = NULL) {
        if ($id != '') {
            $query = "select * from " . $this->table . " Where user_id = '$id'";
            $data['user'] = $this->common_model->customQuery($query, 1);
            $data['title'] = 'View Users Details | FAZA Admin';
            $data['view'] = 'users/view';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function verifiedByAdmin($id = NULL) {
        if ($id != null) {
            $status = $this->common_model->getField($id, 'is_verified', $this->table, 'user_id');
            if ($status->is_verified == 0) {
                $st = 1;
            } else {
                $st = 0;
            }
            $data = array(
                'is_verified' => $st
            );
            $this->common_model->edit_table($id, 'user_id', $data, $this->table);
            $this->session->set_flashdata('success', "User is " . (($status->is_active == 0) ? "unverified" : "Verified") . " Successfully.");
            redirect($this->agent->referrer());
        } else {
            $this->load->view('layouts/error404');
        }
    }

}
