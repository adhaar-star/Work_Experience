<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 23/09/15
 * Time: 09:16 Õ
 */

class Social_commands_model extends MY_Model
{
    protected $belongs_to = array('');
    protected $has_many = array();
    //protected $_table='social_commands';

    public function __construct ()
    {
        parent::__construct();
        $this->_database = $this->db;
    }


}