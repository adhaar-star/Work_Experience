<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Function to check if admin is logged in or not
 * @author Reema Patel (rep)
 */


function mail_config() {
    $configs = array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_port' => 465,
        'smtp_user' => 'demo.narola@gmail.com',
        'smtp_pass' => 'Ke6g7sE70Orq3Rqaqa',
        'transport' => 'Smtp',
        'charset' => 'utf-8',
        'newline' => "\r\n",
        'headerCharset' => 'iso-8859-1',
        'mailtype' => 'html'
    );
    return $configs;
}
function check_isvalidated() {
    $ci = & get_instance();
    if (!$ci->session->userdata('admin_logged_in')) {
        $ci->session->set_flashdata('error', "You are not authorized to access this page. Please login first!");
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_to = str_replace(base_url(), '', $_SERVER['HTTP_REFERER']);
        } else {
            $redirect_to = $ci->uri->uri_string();
        }
        redirect('login?redirect=' . base64_encode($redirect_to));
    }
}

/*
 * Function to check if Admin (As per role either admin or business) is logged in or not 
 * @author Reema Patel (rep)
 */

function checkAdminlogin($role = 'admin') {
    $ci = & get_instance();
//    $roles = userRoles();
    if ($ci->session->userdata('admin_logged_in')) {
            return TRUE;
    } else {
        $ci->session->set_flashdata('error', "You are not authorized to access this page. Please login first!");
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_to = str_replace(base_url(), '', $_SERVER['HTTP_REFERER']);
        } else {
            $redirect_to = $ci->uri->uri_string();
        }
        redirect('login?redirect=' . base64_encode($redirect_to));
    }
}

function pr($data, $status = 0) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if ($status == 1) {
        exit;
    }
}

function slug($text) {
//    $a = str_replace(' ', '-', $str);
//    return urlencode(strtolower($a));
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}


function init_pagination() {
    $config = array();
    $CI = & get_instance();
    $settings = $CI->session->userdata('settings');
    $per_page = "";
    foreach ($settings as $row) {
        if ($row->key == 'records-per-page') {
            $per_page = $row->value;
            break;
        }
    }
    $config['per_page'] = $per_page;
    $config['uri_segment'] = 3;
    //config for bootstrap pagination class integration
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

//    $config['cur_tag_open'] = '<li class="active"><a href="#">';
//    $config['cur_tag_close'] = '</a></li>';

    $config['cur_tag_open'] = '<li class="active"><a style="background-color:#00acec;color:#ffffff;">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['enable_query_strings'] = TRUE;

    return $config;
}

function init_pagination1() {
    $config = array();
    $CI = & get_instance();
    $settings = $CI->session->userdata('settings');
    $per_page = "";
    foreach ($settings as $row) {
        if ($row->key == 'records-per-page') {
            $per_page = $row->value;
            break;
        }
    }
    $config['per_page'] = $per_page;
    $config['uri_segment'] = 4;
    //config for bootstrap pagination class integration
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

//    $config['cur_tag_open'] = '<li class="active"><a href="#">';
//    $config['cur_tag_close'] = '</a></li>';

    $config['cur_tag_open'] = '<li class="active"><a style="background-color:#00acec;color:#ffffff;">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['enable_query_strings'] = TRUE;

    return $config;
}

function input_type_array() {
    $input_type = array('1' => 'Yes/No', '2' => 'Dropdown');
    return $input_type;
}

function perpage_array() {
    $perpage = array('5' => '5', '10' => '10', '20' => '20', '50' => '50', '100' => '100');
    return $perpage;
}

/**
 *  Returns randomly generated String
 *  Generate Random String
 *  @author 
 *  @param integer $length Length of the string to be returned
 */
function generateString($length) {
    return substr(md5(rand()), 0, $length);
}


/**
 * This function simply return output of sql_select function of common_model.  
 * This is just to simplify function call.
 * @author */
function select($table, $select = null, $where = null, $options = null) {
    $CI = & get_instance();
    return $CI->common_model->sql_select($table, $select, $where, $options);
}


/**
 * This function simply print last executed query
 * @bool = boolean execution stopped if true 
 * @author Reema Patel (rep)
 */
function qry($bool = false) {
    $CI = & get_instance();
    echo $CI->db->last_query();
    if ($bool)
        die;
}
?>
