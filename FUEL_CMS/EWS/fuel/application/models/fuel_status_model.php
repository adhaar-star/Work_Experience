<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



require_once(FUEL_PATH.'models/base_module_model.php');

class Fuel_status_model extends Base_module_model {



 function __construct()
    {
        parent::__construct('fuel_status'); // table name
    }
 



function List_items($limit = null, $offset = null, $col = 'Status_name', $order = 'desc')
{

    $data = parent::list_items($limit, $offset, $col, $order);
    return $data;
}
 function _common_query()
        {
  
            $this->db->join('fuel_jobs', 'fuel_status.id= fuel_jobs.id', 'left');
 
       }
	function Imp1()
{

$examples = $this->fuel_status_model->options_list( 'Status');


return $examples;
}   
	   
}