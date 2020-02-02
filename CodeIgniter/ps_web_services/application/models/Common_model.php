<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
    
    
     /**
     * Common Add function
     * @param type $data
     * @param type $table
     * @return type
     */
    
    public function add($table,$data){
        if($this->db->insert($table, $data)){
            return true;
        }else{
            return FALSE;
        }
        
    }
    
     /**
     * Common Edit function
     * @param type $id
     * @param type $data
     * @param type $table
     * @return type
     */
    public function edit($id, $data, $table) {
        $this->db->where('id', $id);
        if ($this->db->update($table, $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function edit_skill($id, $data, $table) {
        $this->db->where('skill_id', $id);
        if ($this->db->update($table, $data)) {
//            echo $this->db->last_query();exit;
            return true;
        } else {
            return false;
        }
    }
    public function edit_ad_image($id, $data, $table) {
        $this->db->where('ad_id', $id);
        if ($this->db->update($table, $data)) {
//            echo $this->db->last_query();exit;
            return true;
        } else {
            return false;
        }
    }
    /**
     * 
     * @param type $id == record id
     * @param type $id_field == unique id if the table 
     * @param type $data
     * @param type $table
     * @return boolean
     */
    public function edit_table($id,$id_field, $data, $table) {
        $this->db->where($id_field, $id);
        if ($this->db->update($table, $data)) {
//            echo $this->db->last_query();exit;
            return true;
        } else {
            return false;
        }
    }
     /**
     * Common Delete function
     * @param type $id
     * @param type $table
     * @return boolean
     */
    public function delete($id, $table,$field) {
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(array($field => $id));
        }
        $this->db->delete($table);
    }
    
    public function delete_skill($id, $table) {
        if (is_array($id)) {
            $this->db->where($id);
        } else {
            $this->db->where(array('skill_id' => $id));
        }
        $this->db->delete($table);
    }
    
    
    /**
     * Common View by Id function
     * @param type $id
     * @param type $table
     * @return type
     */
    public function view($id, $table,$field, $select = '*') {
        $query = "SELECT " . $select . " FROM " . $table . " where $field='" . $id . "'";
        $list = $this->db->query($query);
        return $list->row();
    }
    
    public function view_skill($id, $table, $select = '*') {
        $query = "SELECT " . $select . " FROM " . $table . " where skill_id='" . $id . "'";
        $list = $this->db->query($query);
        return $list->row();
    }
    
    public function view_ad($id, $table, $select = '*') {
        $query = "SELECT " . $select . " FROM " . $table . " where ad_id='" . $id . "'";
        $list = $this->db->query($query);
        return $list->row();
    }
     public function viewAll($table, $limit, $select = '*') {
        $query = "SELECT " . $select . " FROM " . $table . " " . $limit;
        
        $list = $this->db->query($query);
        return $list->result();
    }
    
     /**
     *  Check if the value is unique
     */
    
    
    public function isUnique($field, $value, $table, $id = '', $cnd = "") {
        if ($id != '')
            $condition = " AND skill_id!= $id";
        else
            $condition = $cnd;
        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "'" . $condition;
        
        $result = $this->db->query($query);
        return $result->row();
    }
    
    public function isUniqueCountry($field, $value, $table, $id = '', $cnd = "") {
        if ($id != '')
            $condition = " AND country_id!= $id";
        else
            $condition = $cnd;
        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "'" . $condition;
        
        $result = $this->db->query($query);
        return $result->row();
    }
    
    public function isUnique_skill($field, $value, $table, $id = '', $cnd = "") {
        if ($id != '')
            $condition = " AND skill_id!= $id";
        else
            $condition = $cnd;
        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "'" . $condition;
        
        $result = $this->db->query($query);
        return $result->row();
    }
    
    public function isUniqueBank($field, $value, $table, $id = '', $cnd = "") {
        if ($id != '')
            $condition = " AND bank_id!= $id";
        else
            $condition = $cnd;
        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "'" . $condition;
        
        $result = $this->db->query($query);
        return $result->row();
    }
    public function isUniqueBranch($field, $value, $table, $id = '', $cnd = "") {
        if ($id != '')
            $condition = " AND branch_id!= $id";
        else
            $condition = $cnd;
        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "'" . $condition;
        
        $result = $this->db->query($query);
        return $result->row();
    }
    
    /**
     * Update by Id Field function 
     * @param type $id
     * @param type $fieldname
     * @param type $value
     * @param type $table
     */
    public function updateField($id, $fieldname, $value, $table) {
        $query = "update " . $table . " set " . $fieldname . "='" . $value . "' where id=" . $id;
        if ($this->db->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get field by Id
     */
    public function getFieldById($id, $field, $table) {
        $query = "select " . $field . " from " . $table . " where skill_id=" . $id;
        $result = $this->db->query($query);
        return $result->row();
    }
     /**
      * 
      * @param type $id
      * @param type $field
      * @param type $table
      * @return type
      */
    public function getFieldByIdAD($id, $field, $table) {
        $query = "select " . $field . " from " . $table . " where ad_id=" . $id;
        $result = $this->db->query($query);
        return $result->row();
    }
    
     public function getField($id, $field, $table,$value) {
        $query = "select " . $field . " from " . $table . " where ". $value."=" . $id;
        $result = $this->db->query($query);
        return $result->row();
    }
    public function getArray($table, $select = '*', $option = 1){
        $query = "select " . $select . " from " . $table ;
         $result = $this->db->query($query);
//        pr($result->result(),1);
        if ($option == 1)
            return $result->result();
        else
            return $result->result_array();
    }
    
     public function customQuery($query, $option) {
         
        $result = $this->db->query($query);
        if ($option == 1) {
            return $result->row();
        } else if ($option == 2) {
//            echo $this->db->last_query();
//            pr($result->result(),1);
            return $result->result();
        } else
            return $result->result_array();
    }
    
     /**
     * Common Delete All function
     * @param type $id
     * @param type $table
     * @return boolean
     */
    public function deleteAll($value,$table, $field ) {
        $query = "DELETE FROM " . $table . " WHERE " . $field . "='" . $value . "'";
//        echo $query;exit;
        $this->db->query($query);
        return true;
    }

    /**
     * Multiple Delete Function
     * @param type $ids
     * @param type $table
     * @param type $field
     * @return boolean
     */
    public function deleteMultiple($ids, $table, $field) {
        $query = "DELETE FROM " . $table . " WHERE " . $field . " in (" . $ids . ")";
        $this->db->query($query);
        return true;
    }
    
     public function deleteMultiple_skills($ids, $table, $field = 'skill_id') {
        $query = "DELETE FROM " . $table . " WHERE " . $field . " in (" . $ids . ")";
        $this->db->query($query);
        return true;
    }

   
     /**
     * Common Delete By Condtion function
     * @param type $table
     * @param type $condition
     * @return boolean
     */
    public function deleteByCondition($table, $condition) {
        $query = "DELETE FROM " . $table . " WHERE " . $condition;
        $this->db->query($query);
        return true;
    } 
}

