<?php

/**
 *
 * this library for manage users authuntication / authorization systems
 *
 * @author Mohamed Mahdy
 *
 */
class Authority
{

    public $CI;
    private $user_id;
    private $group_id;
    private $rights;
    public $user;

    function __construct()
    {
        $this->CI = &get_instance();
        $this->user = $this->get_user_data();
        //$this->CI->load->config('authorization/authority');
    }

    function get_username()
    {
        if (is_object($this->user)) {
            return $this->user->user_username;
        }
    }

    /**
     * get user full name by user_id
     * @param type $user_id
     * @return string user full name
     */
    function get_username_by_id($user_id)
    {
        $this->CI->db->select('user_id,user_full_name');
        $this->CI->db->where('user_id', $user_id);

        $user = $this->CI->db->get('users')->row();
        if (is_object($user)) {
            return $user->user_full_name;
        } else {
            return "cannot find user id";
        }
    }

    function get_group_name()
    {
        $group = $this->get_group($this->user->user_group_id);

        return $group->gr_name;
    }

    function get_group_id()
    {
        return $this->user->user_group_id;
    }

    function get_user_id()
    {
        return $this->user->user_id;
    }

    /**
     * @param integer $group_id
     */
    public function get_group($group_id)
    {
        $this->CI->db->where('gr_id', $group_id);

        return $this->CI->db->get('groups')->row();
    }

    public function is_logged()
    {
        if (is_object($this->CI->session->userdata('user_data'))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * destroy session
     */
    function log_out()
    {
        $this->CI->session->sess_destroy();
    }

    /**
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function check_user($username, $password)
    {
        $this->CI->db->where('user_email', $username);
        $this->CI->db->where('user_password', $password);
        $result = $this->CI->db->get('users');
        if ($result->num_rows() > 0) {
            $this->set_user_data($result->row());

            return true;
        } else {
            return false;
        }
    }

    /**
     * set user data
     * @param object $user
     */
    function set_user_data($user)
    {
        if (is_object($user)) {
            $this->CI->session->set_userdata('user_data', $user);
        }
    }

    /**
     * get user data
     * @param object $user
     */
    function get_user_data()
    {
        if (is_object($this->CI->session->userdata('user_data'))) {
            return $this->CI->session->userdata('user_data');
        } else {
            @error_log('problem with user_data session at authority lib', 2);
        }
    }

    function get_right_id($right)
    {
        $this->CI->db->where('right_name', $right);
        $result = $this->CI->db->get('rights')->row();

        return $result->right_id;
    }

    /**
     *
     * @param string $right
     * @param string $destination
     * @return boolean
     */
    function check_right($right, $destination = '')
    {
        $rights = $this->get_group_rights();
        $rights_array = array();

        // get all rights ids
        foreach ($rights as $row) {
            $rights_array[] = $row['gr_right_id'];
        }
        // get right id
        $right_id = $this->get_right_id($right);

        if (!in_array($right_id, $rights_array)) {
            return false;
        } else {
            return true;
        }
    }

    function get_group_rights()
    {
        $this->CI->db->where('gr_group_id', $this->get_group_id());

        return $this->CI->db->get('group_rights_bridge')->result_array();
    }

}