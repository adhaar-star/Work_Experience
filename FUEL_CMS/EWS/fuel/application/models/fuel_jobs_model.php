<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



require_once(FUEL_PATH.'models/base_module_model.php');
date_default_timezone_set('Asia/Kolkata');	
class Fuel_Jobs_model extends Base_module_model {
public $required = array('Details','Status' );

 public $parsed_fields = array('comment');
 
 
 function __construct()
    {
        parent::__construct('fuel_jobs'); // table name
    }
 

function List_items($limit = null, $offset = null, $col = 'Client_name', $order = 'desc')
{

  
    $this->db->select("id,EWS_Job_Number,Details,Status,Location");
    $data = parent::list_items($limit, $offset, $col, $order);
	 
    return $data;
	
}
  


public function Form_fields($values = array(), $related = array())
	{
	  $form_builder =& $params['instance'];
		$CI =& get_instance();
		$CI->load->helper('directory');
		
		$fields = parent::form_fields($values, $related);
		
		
		// save reference it so we can reorder
		
$options = array('a' => 'assigned','' => 'in progress','a' => 'assigned');
	$fields['Status']=array('type' => 'select','id'=>'field3','order'=>'3','style'=>'margin-top:0px;','options' => $options, 'model' => array('Status'=>array('fuel_status'=>'imp1')),'first_option' => 'Select one'); 

$fields['Location'] =array('id'=>'pac-input','order'=>'4',);
$fields['my_point']	=array('type' => 'point','label'=>' ','order'=>'5');
$fields['street_name']	=array('order'=>'6');
 

	



 
 

 $options = array('Client_Name' => 'option A');
$fields['Client_Name'] = array('type' => 'select','label'=>'Client Name ', 'options' => $options, 'model' => array('clients'=>array('fuel_clients'=>'random') ), 'first_option' => 'Select one...');
 
 $fields['my_button'] = array('type' => 'button' ,'value' => 'Add Team','order'=>'8','method'=>'get','label'=>' ',' margin-left:130px;','id'=>'button1');
 $this->load->library('form_builder');
 $options1 = array('a' => 'option A');
	$fields['']=array('label'=>'','type' => 'select','id'=>'field5','order'=>'8','style'=>'margin-top:-180px;', 'options' => $options1,'first_option' => 'Select one...','model' => array('contractors'=>array('fuel_contractors'=>'imp'))); 
	$fields['Contractors_assigned'] = array('type' => 'text','order'=>'7','label'=>'Teams','id'=>'field8','style'=>'margin-left:130px;');

	 

 
 $fields['Comments'] = array('type'=>'textarea','label'=>'Comments','order'=>'9');

 $fields['EWS_Job_Number'] = array('type'=>'hidden');
	 
 $fields['Contractor_id'] = array('type'=>'hidden');
	
$fields['lattitude'] = array('type'=>'hidden','id'=>'field9');

$fields['longitude'] = array('type'=>'hidden');
	
$fields['Old_Status'] = array('type'=>'hidden','id'=>'field7','js'=>'<script>document.getElementById("field7").value=document.getElementById("field3").value</script>');

$fields['Status_time'] = array('type'=>'hidden');

$fields['test'] = array('type'=>'hidden');



    




		return $fields;
	}
	
		
		
		 
			
          
// prep the bundle

			
		
		
		
		
		
		
		
		
		
		
		
	
		function on_after_post($values)
        {
		
		
            $CI =& get_instance();
		


	

	
            $CI->load->model('fuel_contractors_model');
			
 $values['EWS_Job_Number']=$values['id'];         
$where['select'] = 'id';

$str=$values['Contractors_assigned'];
$result2=explode(",",$str);
$id=$result2;
$where['where_in'] = array('Name' => $id);

 
$query = $this->fuel_contractors_model->query($where);

$results = $query->result();

$result1=array();

 foreach($results as $row)

			{
	$result1[]=$row['id'];
	
			}
			$values['Contractor_id']=implode(",",$result1);
			                           $str5=implode(",",$result1);
									   
									               $CI->load->model('fuel_contractors_model');
												   $where['select'] = 'device_token';
$where['where_in'] = array('Name' => $id);
									   $query2 = $this->fuel_contractors_model->query($where);

$results2 = $query2->result();
$result2=array();

		foreach($results2 as $row)

			{
	$result2[]=$row['device_token'];
	
			}




define( 'AIzaSyDxI3s9LVf2-TtuofkykFPG5-HcrE9b6UQ' );


$registrationIds = $result2;

// prep the bundle
$msg = array
(
	'message' 	=> 'New job assigned',
	'Job id'		=> $values['id'],
	'subtitle'	=> 'This is a subtitle. subtitle',
	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
);

$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . 'AIzaSyDxI3s9LVf2-TtuofkykFPG5-HcrE9b6UQ',
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );

echo $result;
// prep the bundle

			
		
		
	$this->load->helper('google_helper');
			
			
			$str=implode(",",google_geolocate($values['Location'],'location'));
			$str1 = explode(",",$str );
		
		$values['lattitude']=$str1[0];
		$values['longitude']=$str1[1];	
        $this->load->helper('My_date_helper');		
         $values['Status_time']=date("Y-m-d H:i:s");
$data1 =array( 
'job_id'=>$values['id'],
'Old_status'=>$values['Old_Status'],
'New_status'=>$values['Status'],
'Updated'=>$values['Status_time']
);
	$query2=$this->db->insert('fuel_status_history',$data1);	
$this->fuel_jobs_model->save($values);  


	}
		
		
			 	
			 
			
			
		   
			
		
    

			
			
			
		
		
			
		
		
 
	
function Filters($filters=array()){

 $CI =& get_instance();
 
   $filters['id'] = array('type' => 'textbox','size'=>10,'placeholder'=>'Search');
   
     $filters['EWS_Job_Number'] = array('type' => 'textbox','size'=>10,'placeholder'=>'Search');
	 $this->filter_join = array('EWS_Job_Number'=>'and');
   $filters['Client_name'] = array('type' => 'textbox','size'=>10,'placeholder'=>'Search');
$this->filter_join = array('Client_name'=>'and');
  $filters['Contractors_assigned']   = array('type'=>'textbox','size'=>10,'placeholder'=>'Search');
$this->filter_join = array('Contractors_assigned'=>'and');
   $filters['Status'] = array('type' => 'textbox','size'=>10,'placeholder'=>'Search');
   $this->filter_join = array('Status'=>'and');
  
   return $filters;
   
}

	}
	class Jobs_item_model extends Base_module_record {
 
  
     
    function Get_url()
    {
        if (!empty($this->link)) return $this->link;
        return site_url('jobs/'.$this->id);
    }
     
    function Get_excerpt_formatted($char_limit = NULL, $readmore = '')
    {
        $this->_CI->load->helper('typography');
        $this->_CI->load->helper('text');
        $excerpt = $this->content;
 
        if (!empty($char_limit))
        {
            // must strip tags to get accruate character count
            $excerpt = strip_tags($excerpt);
            $excerpt = character_limiter($excerpt, $char_limit);
        }
        $excerpt = auto_typography($excerpt);
        $excerpt = $this->_parse($excerpt);
        if (!empty($readmore))
        {
            $excerpt .= ' '.anchor($this->get_url(), $readmore, 'class="readmore"');
        }
        return $excerpt;
    }
     
}
     

	