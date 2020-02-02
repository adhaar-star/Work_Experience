<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        checkAdminlogin();
        $this->load->model('Common_model', 'common_model');

        $this->perpageSuffix = "";
        $this->filterSuffix = "";

        if ($this->input->get('perpage'))
            $this->perpageSuffix = "?perpage=" . $this->input->get('perpage');

        if ($this->input->get('type') && $this->input->get('keyword')) {
            $this->filterSuffix = "?type=" . $this->input->get('type') . "&keyword=" . $this->input->get('keyword');
            if ($this->input->get('perpage'))
                $this->perpageSuffix = "&perpage=" . $this->input->get('perpage');
        }else if ($this->input->get('type')) {
            $this->filterSuffix = "?type=" . $this->input->get('type');
            if ($this->input->get('perpage'))
                $this->perpageSuffix = "&perpage=" . $this->input->get('perpage');
        }else  if ($this->input->get('keyword')) {
            $this->filterSuffix = "?keyword=" . $this->input->get('keyword');
            if ($this->input->get('perpage'))
                $this->perpageSuffix = "&perpage=" . $this->input->get('perpage');
        }

        $this->suffix = $this->filterSuffix . $this->perpageSuffix;
        $this->table = TBL_PAYMENTS;
    }

    public function index() {
        $config = init_pagination();

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "index.php/payment/index" . $this->perpageSuffix;
        }

        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/payment/index" . $this->suffix;

        if ($this->input->get('type') && $this->input->get('keyword'))
            $config['first_url'] = base_url() . "index.php/payment/index" . $this->suffix;

        if ($this->input->get('type'))
            $config['first_url'] = base_url() . "index.php/payment/index" . $this->suffix;

        $config['suffix'] = $this->suffix;
        $config['base_url'] = base_url() . "index.php/payment/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        if ($this->input->get('type') && $this->input->get('keyword')) {
            $type = $this->input->get('type');
            if ($type == 1) {
                $con = 'Where payment_requested=1';
            } else if ($type == 2) {
                $con = ' Where release_requested=1';
            } else if ($type == 3) {
                $con = ' Where payment_release=1';
            }
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
			
            $con.= " AND (u.user_name like '%$keyword%'";
            $con.= " OR p.amount like '%$keyword%'";
            $con.= " OR p.currency like '%$keyword%')";
        } elseif ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $con = " Where (u.user_name like '%$keyword%')";
            $con.= " OR (p.amount like '%$keyword%')";
            $con.= " OR (p.currency like '%$keyword%')";
        } elseif ($this->input->get('type')) {
            $type = $this->input->get('type');
            if ($type == 1) {
                $con = 'Where payment_requested=1 and release_requested=0 and payment_release=0';
            } else if ($type == 2) {
                $con = ' Where release_requested=1 and payment_release=0';
            } else if ($type == 3) {
                $con = ' Where payment_release=1';
            }
        } else {
            $con = 'Where payment_requested=1 or release_requested=1';
        }
            $query = "select * from " . $this->table . " p Left join " . TBL_USERS . " u on u.user_id = p.freelancer_id " . $con." ORDER BY `payment_date` desc";
		//print_r($query);die;
        $config['total_rows'] = count($this->common_model->customQuery($query, 2));
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $data['payments'] = $this->common_model->customQuery($query . ' Limit ' . $page . ', ' . $config['per_page'], 2);
//                pr($data['payments'],1);
        $data['title'] = 'Payment Details | FAZA Admin';
        $data['view'] = 'payment/index';
        $this->load->view('layouts/layout', $data);
    }

    public function view($id) {
        if ($id != '') {
            $query = "select * from " . TBL_BANK_INFO . " b Left join " . TBL_USERS . " u on u.user_id = b.bank_id Where b.user_id = '$id'";
            $data['bank'] = $this->common_model->customQuery($query, 1);

            $data['title'] = 'Payment Details | FAZA Admin';
            $data['view'] = 'payment/view';
            $this->load->view('layouts/layout', $data);
        } else {
            $this->load->view('layouts/error404');
        }
    }

    public function changeStatus() {
        $freelancer_id = $this->input->post('freelancer_id');
        $payment_id = $this->input->post('payment_id');
        $job_id = $this->input->post('job_id');
        $data = array(
            'payment_release' => 1,
            'payment_release_date' => date('Y-m-d H:i:s')
        );
        $data_job = array(
            'paid' => 1,
        );
        $this->common_model->edit_table($payment_id, 'payment_id', $data, $this->table);
        $this->common_model->edit_table($job_id, 'job_id', $data_job, 'tbljobs');
    }

}
