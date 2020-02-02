<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 23/09/15
 * Time: 09:16 Õ
 */

class messages_model extends MY_Model
{
    protected $belongs_to = array('users','primary_key' => 'email');
    protected $has_many = array();

    public function __construct ()
    {
        parent::__construct();
        $this->_database = $this->db;
    }


}