<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



require_once(FUEL_PATH.'models/base_module_model.php');

class Fuel_clients_model extends Base_module_model {
public $required = array('Client_Name' );


 function __construct()
    {
        parent::__construct('fuel_clients'); // table name
    }
 



function List_items($col='Client_name')
{

  $this->db->select('id,Client_name,Active');
  
    $data = parent::list_items($col);
	
    return $data;
}
function Random()
{

$examples = $this->fuel_clients_model->options_list( 'Client_name');


return $examples;
}

}