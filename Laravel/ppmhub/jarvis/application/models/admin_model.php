<?php

/**
 *
 * @property CI_DB_active_record $db
 * @property CI_Input $input
 *
 */
class Admin_model extends CI_Model
{
    var $table = "admin";
    var $prefix = "a_";
    //    fields
    var $a_id;
    var $a_username;
    var $a_password;
    var $a_email;
    var $a_last_login;

    function create_new_user()
    {
        $this->db->set("u_username", $this->input->post("name"));
        $this->db->set("u_tel", $this->input->post("tel"));
        $this->db->set("u_addresse", $this->input->post("addresse"));
        $this->db->set("u_city", $this->input->post("city"));
        $this->db->set("u_email", $this->input->post("email"));
        $this->db->set("u_password", $this->input->post("password"));
        $this->db->insert($this->table);
    }

    function update_user_data()
    {
        $this->db->set("u_username", $this->input->post("name"));
        $this->db->set("u_tel", $this->input->post("tel"));
        $this->db->set("u_addresse", $this->input->post("addresse"));
        $this->db->set("u_city", $this->input->post("city"));
        $this->db->where("u_id", $this->session->userdata("userid"));
        $this->db->update($this->table);
    }

    function update_user_password()
    {
        $this->db->set("u_password", $this->input->post("password"));
        $this->db->where("u_id", $this->session->userdata("userid"));
        $this->db->update($this->table);
    }

    function username_exist()
    {
        $data = $this->db->query("SELECT a_username FROM $this->table WHERE a_username = '" . $this->input->post("userName") . "'");
        if ($data->num_rows) {
            return true; // means this email address not available to used cause we found another person used it
        } else {
            return false;
        }
    }

    function valid_password()
    {
        $data = $this->db->query("SELECT a_password,a_username FROM $this->table WHERE a_password = '" . md5($this->input->post("password")) . "' and a_email = '" . $this->input->post("username") . "'");
//        echo $data->num_rows;
        if ($data->num_rows) {
            return true; // means this email address not available to used cause we found another person used it
        } else {
            return false;
        }
    }

    function get_user_id()
    {
        $data = $this->db->query("SELECT a_id,a_email,a_username FROM admin WHERE a_username = '" . $this->input->post("userName") . "'");

        return $data->row();
    }

    function get_user_Information()
    {
        $data = $this->db->query("SELECT * FROM users WHERE u_id = '" . $this->session->userdata("userid") . "'");

        return $data->row();
    }
}

?>
