<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Complaints extends CI_Controller {

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
        $this->table = TBL_COMPLAINTS;
    }

    public function index() {
        $config = init_pagination();

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/complaints/index" . $this->perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/complaints/index" . $this->suffix;

        $config['suffix'] = $this->suffix;
        $config['base_url'] = base_url() . "index.php/complaints/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = "select * from " . $this->table . " c Left join " . TBL_USERS . " u on u.user_id = c.user_id"." ORDER BY `created_date` DESC";

        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " Where (c.description like '%$keyword%')";
            $query.= " Or (u.user_name like '%$keyword%')";
        }

        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $data['complaints'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);
//print_r($data['complaints']);die;
        $data['title'] = 'Complaints | FAZA Admin';
        $data['view'] = 'complaints/index';
        $this->load->view('layouts/layout', $data);
    }

    public function sortdata() {
        $query = "select * from " . $this->table . " c Left join " . TBL_USERS . " u on u.user_id = c.user_id";
        $conj = '';
        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $conj.= " AND (c.description like '%$keyword%')";
            $conj.= " Or (u.user_name like '%$keyword%')";
        }

        $query.= " Where complaints_id >= '" . $this->input->post('startId') . "' AND complaints_id <= '" . $this->input->post('endId') . "'".$conj." order by " . $this->input->post('field') . " " . $this->input->post('sorting');
//        echo $query;
        $data['complaints'] = $this->common_model->customQuery($query, 2);
        $data['postdata'] = $this->input->post();
        $this->load->view("/complaints/sortdata", $data);
    }

}
