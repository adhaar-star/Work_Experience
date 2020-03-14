<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
 require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');
class Login extends Fuel_base_controller{
    
    function __construct(){
        parent::__construct();
    }

    public function index(){
        // Load our view to be displayed
        // to the user
        $this->load->view('login_view');
    }
	public function process(){
        // Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
          echo "hi";
        }else{
            // If user did validate, 
            // Send them to members area
            redirect('dashboard');
        }        
    }
}
?>