<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



require_once(FUEL_PATH.'models/base_module_model.php');

class Fuel_Contractors_model extends Base_module_model {
public $required = array('Name','Email' ,'Username');
public $filters =  array('Name','Email');

 function __construct()
    {
        parent::__construct('fuel_contractors'); // table name
    }
 



function List_items($limit = null, $offset = null, $col = 'Name', $order = 'desc')
{
    $this->db->select('id,Name,Email,Image');
    $data = parent::list_items($limit, $offset, $col, $order);
	foreach($data as $key => $value)
	{
		$data[$key]['Image'] = '<img src="'.img_path($value['Image']).'" alt="" height="42" width="42" />';
	}
	return $data;
    
}
public function Form_fields($values = array(), $related = array())
	{
		$CI =& get_instance();
		$CI->load->helper('directory');
		
		$fields = parent::form_fields($values, $related);
		
		
		$fields['Image'] = array('type' => 'asset','order'=>8 );

		
		
		// save reference it so we can reorder
	$fields['password'] = array('type'=>'hidden');	
		
		$user_id = NULL;
		if (!empty($values['id']))
		{
			$user_id = $values['id'];
		}

		

		if (!empty($user_id))
		{
			$fields['password'] = array('label' => lang('form_label_new_password'), 'type' => 'password', 'size' => 20, 'order' => 5);
		}
		else
		{
			
			//$fields['password']= $pwd_field;
			$fields['new_password'] = array('label' => lang('form_label_password'), 'type' => 'password', 'size' => 20, 'order' => 5, 'required' => TRUE);
			$fields['password']['required'] = TRUE;
		}
		
		$lang_dirs = list_directories(FUEL_PATH.'language/', array(), FALSE);
		$lang_options = array_combine($lang_dirs, $lang_dirs);
		
		
 $fields['device_id']=array('type'=>'hidden');
        
     $fields['device_token']=array('type'=>'hidden');

		


	
		return $fields;
	}


function Imp()
{

$examples = $this->fuel_contractors_model->options_list( 'Name');


return $examples;
}

   

}

