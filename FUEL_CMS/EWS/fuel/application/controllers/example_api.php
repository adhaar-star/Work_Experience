<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions

require APPPATH.'/libraries/REST_Controller.php';

class Example_api extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
      
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
    
    }
	function login_get()
    {
	 $CI =& get_instance();
	
	
			
        if(!$this->get('id'))
        {
		
        	$this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
    	 $CI->load->model('fuel_contractors_model');
		
 $id=$this->get('id');
$password=$this->get('password');
$device_id=$this->get('device_id');
$device_token=$this->get('device_token');

	$where['select']='id,password';
$where['where']=array('id'=>$id,'password'=>$password);
 $query1 = $this->fuel_contractors_model->query($where);
$results=$query1->result();
if($results)
{
foreach($results as $row)
{
if($row['password']==$password)
{
$this->fuel_contractors_model->update( array('device_id' => $device_id,'device_token' => $device_token),
             array( 'id'=> $id
        ));		
$msg=array("msg"=>'User successfully logged in') ;
  $this->response($msg); 
}
else{
$msg1=array("msg"=>'Wrong password') ;
  $this->response($msg1); 
}
	
}
}
else
{
 if (!filter_var($id, FILTER_VALIDATE_EMAIL)){
$msg2=array("msg"=>'Authentification failed') ;
  $this->response($msg2);


    }
else{
$msg2=array("msg"=>'Authentification failed') ;
  $this->response($msg2);

}
}
}
    function user_get()
    {
	 $CI =& get_instance();
	
	
			
        if(!$this->get('id'))
        {
		
        	$this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
    	 $CI->load->model('fuel_jobs_model');
		
    $id=$this->get( 'id');
			
    	  $where['select'] = 'id,Job_title,Details,Status,Location,Client_Name,Comments,lattitude,longitude';



$where['where_in'] = array( 'Contractor_id'=> $id);


$this->db->select('id,Job_title,Details,Status,Location,Client_Name,Comments,lattitude,longitude');
$this->db->where("FIND_IN_SET('$id',Contractor_id) !=", 0);
 $query = $this->db->get('fuel_jobs');
  
if($query)
        {
$results = $query->result();

$CI->load->model('fuel_contractors_model');
$where['select']='Name,Image';
$where['where_in']=array('id'=>$id);
 
$query1 = $this->fuel_contractors_model->query($where);
$results2=array();
 $query2 = $query1->result();

foreach($query2 as $row)
{
$results2[]=array("Name"=>$row['Name'],"Image"=>"ews.assertive-media.co.uk/assets/images/".$row['Image']);

 }

$result3=array('msg1'=>$results,'msg2'=>$results2);
            $this->response($result3); // 200 being the HTTP response code
            // 200 being the HTTP response code
        }

        else
        {
		
            $this->response(array('error' => 'User could not be found'), 404);
        }
    
    }
    function contractorimage_post()
    {
	
	 $CI =& get_instance();
	 $CI->load->model('fuel_contractors_model');
	 $imagename=$this->post('ImageName');
 $bg = base64_decode($this->post('Image'));
 $file = fopen("/var/www/vhosts/ews.assertive-media.co.uk/httpdocs/assets/images/".$imagename, 'w');
 fwrite($file, $bg);
 if(fclose($file)){
 echo "Image uploaded";
}else{
 echo "Error uploading image";
}


	$this->fuel_contractors_model->update( array('Image' => $imagename)
             ,array( 'id'=> $this->post('id')
        ));		
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
	function contractorname_post()
    {
	
	 $CI =& get_instance();
	 $CI->load->model('fuel_contractors_model');
	 


	$this->fuel_contractors_model->update( array('Name' => $this->post('Name')),
             array( 'id'=> $this->post('id')
        ));		
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
     function job_get()
    {
	$CI =& get_instance();
	
	
			
        if(!$this->get('id'))
        {
		
        	$this->response(NULL, 400);
        }
			 $CI->load->model('fuel_jobs_model');
		
    $id=$this->get( 'id');
			
$this->db->select('id,Job_title,Details,Status,Location,Client_Name,Comments,lattitude,longitude');
$this->db->where('id',$id);
	$query = $this->db->get('fuel_jobs');

if($query)
        {
$results = $query->result();
$result2=array("msg"=>$results);
  $this->response($result2);
    }
	
	}
	function jobstatus_post()
    {
	
	 $CI =& get_instance();
	 $CI->load->model('fuel_jobs_model');
	 


	$this->fuel_jobs_model->update( array('Status' => $this->post('Status')),
             array( 'id'=> $this->post('id')
        ));		
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
	function password_post()
	{
	$CI =& get_instance();
	 $CI->load->model('fuel_contractors_model');
	 
	$this->load->library('email');
	$id=$this->post( 'id');

	$where['select']= 'password,Email';
	$where['where'] = array('id'=> $id);

	$query1 = $this->fuel_contractors_model->query($where);
$results=$query1->result();
$this->load->library('email');
if($results)
{
foreach($results as $row)
{

 

$mail_to = $this->post( 'email'); 

$subject = 'Message from Admin'.'unoiaofficial@gmail.com'; 

$body_message1 = 'Your Email: '.$mail_to."\n" . 'Your Password: '.$row['password']."\n" ;



$mail_status = mail($mail_to, $subject,  $body_message1); 

if ($mail_status == true) { 
    $msg=array('msg'=>'Email sent successfully');
	$this->response($msg);

} 
else { 
   $msg1=array('msg'=>'Error Sending mail');
	$this->response($msg1);


}



	

	}
	
	}
	else{
	echo "Error retreiving results";
	}
	}
	function imageupload_post()
	{
	
	$CI =& get_instance();
	 $CI->load->model('fuel_contractors_model');
	$id=$this->post('Job_Id');
	 
	 $dirPath = "D:\adhaar\htdocs\EWS\assets\images/"."Job".$id;
$result = mkdir($dirPath, 0755);
if ($result == 1) {
    echo $dirPath . " has been created";
} else {
    echo $dirPath . " has NOT been created";
}
header('Content-type: image/jpeg');

	 $imagename=$this->post('ImageName');
	 $homepage = file_get_contents($imagename);


 
 $file = fopen("D:\adhaar\htdocs\EWS\assets\images/"."Job".$id."/".$imagename.".jpg", 'w');
 fwrite($file,$homepage);
 
$data =array( 
'Job_id'=>$id,
'Phone_Date'=>$this->post('Phone_Date'),
'GPS_date'=>$this->post('GPS_date'),
'Uploaded'=>$this->post('Uploaded'),
'Crew'=>$this->post('Crew'),
'Status'=>$this->post('Status'),
'latitude'=>$this->post('latitude'),
'longitude'=>$this->post('longitude'),
'thumb_img'=>$this->post('thumb_img'),
'Image'=>$imagename,

);

	$query=$this->db->insert('fuel_images',$data);	
	if($query)
	{
	$msg2=array('msg'=>'Image uploaded successfully');
	 $this->response($msg2);
	}
	else
	{
	$msg3=array('msg'=>'Error uploading image');
	$this->response($msg3);
	}
	
	}
	function imagedelete_post()
	{
		$CI =& get_instance();
	 $CI->load->model('fuel_contractors_model');
	$id=$this->post('Job_Id');
	$jsondata=$this->post('jsonImage');
	
	$var= stripslashes($jsondata);


$coords = trim($var, '[]');
$result2=explode(",",$coords );

  foreach($result2 as $key=>$value)
  {
   $val=trim($value, '"');
$imagename=$val;
   echo $imagename;
  

$data="D:\adhaar\htdocs\EWS\assets\images/"."Job".$id."/".$imagename;
    $dir = "D:\adhaar\htdocs\EWS\assets\images\Job".$id;
   
                                         
                                                    unlink($dir.'/'.$imagename);
			 
$this->db->where(array('Job_id'=>$id));
 $query=$this->db->delete('fuel_images');		
	
if($query)
	{
	$msg2=array('msg'=>'Image deleted successfully');
	 $this->response($msg2);
	}
	else
	{
	$msg3=array('msg'=>'Error deleting image');
	$this->response($msg3);
	}
	}
	}
    function user_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
		
    }
    
    function users_get()
    {
	header('Content-type: application/JSON');
        //$users = $this->some_model->getSomething( $this->get('limit') );
	
    	 
			print_r($users);
        if($users)
        {

            $this->response($users,200); // 200 being the HTTP response code
		
        }

        else
        {
		
            $this->response(array('error' => 'User could not be found'));
        }
    }


	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
}