<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_bank_details extends CI_Controller {

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
        $this->table = TBL_BANK_INFO;
    }

    public function index() {
        $config = init_pagination();

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/users_bank_details/index" . $this->perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/users_bank_details/index" . $this->suffix;

        $config['suffix'] = $this->suffix;
        $config['base_url'] = base_url() . "index.php/users_bank_details/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = "select * from " . $this->table . " b Left join " . TBL_USERS . " u on u.user_id = b.bank_id";

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " Where (b.name like '%$keyword%')";
            $query.= " Or (u.user_name like '%$keyword%')";
        }

        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $data['users'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);
        
        $data['title'] = 'Users bank Account Details | FAZA Admin';
        $data['view'] = 'users_bank_details/index';
        $this->load->view('layouts/layout', $data);
    }

    public function sortData() {
        $query = "select * from " . $this->table . " b Left join " . TBL_USERS . " u on u.user_id = b.bank_id";

         $conj = '';
        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $conj.= " And (b.name like '%$keyword%')";
            $conj.= " Or (u.user_name like '%$keyword%')";
        }

        $query.= " Where bank_id >= '" . $this->input->post('startId') . "' AND bank_id <= '" . $this->input->post('endId') . "'".$conj." order by " . $this->input->post('field') . " " . $this->input->post('sorting');
        $data['users'] = $this->common_model->customQuery($query, 2);
        $data['postdata'] = $this->input->post();
        $this->load->view("/users_bank_details/sortdata", $data);
    }

    public function view($id = NULL) {
        if ($id != '') {

            $query = "select * from " . $this->table . " b Left join " . TBL_USERS . " u on u.user_id = b.bank_id Where b.bank_id = '$id'";
            $data['user'] = $this->common_model->customQuery($query, 1);
            $data['title'] = 'View Users bank Account Details | FAZA Admin';
            $data['view'] = 'users_bank_details/view';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

}
