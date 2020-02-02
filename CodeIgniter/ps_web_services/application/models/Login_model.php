<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class  Login_model extends CI_Model {

    public function check_user($uname, $password) {

        $this->db->where("email", $uname);
//        $this->db->where("password", $password);
        $this->db->where("password", md5($password));
        
        $query = $this->db->get(TBL_ADMIN);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }
    
    public function getAdminById($id){
        
        $this->db->select('*');
        $this->db->where('id', $id);
        $q = $this->db->get(TBL_ADMIN);
        return $q->row_array();
    }
     public function changePassword($password, $id) {
        $this->db->set('password', md5($password));
        $this->db->update(TBL_ADMIN);
        return true;
    }
    
     /* To check email already exist or ont in database */

    public function checkEmailExist($email, $id = '') {
         $this->db->select('name,email');
        if ($id != '')
            $this->db->where('id !=', $id);
        $this->db->where('email', $email);
        $q = $this->db->get(TBL_ADMIN);
        return $q->row_array();
    }

    /* Update admin data (In Update Profile) */

    public function updateAdminData($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update(TBL_ADMIN, $data))
            return TRUE;
        else
            return FALSE;
    }
}