<?php

namespace App\Controllers\Web;

use Quill\Factories\CoreFactory;
use Quill\Factories\ModelFactory;

class IndexController extends \App\Controllers\Web\PublicBaseController {

    function __construct($app = NULL) {

        parent::__construct($app);

        $this->models = ModelFactory::boot(array('User','MasterExpertise','MasterExperience','MasterDegree','MasterStudyField','MasterCollege','MasterLocations',"MasterSkillLevel","Candidate","CandidateEducation","CandidateJobs","CandidateLocation","CandidateSkill"));
        $this->core = CoreFactory::boot(array('Response', 'Http', 'View'));

    }

    /**
     *
     * Function is used to view home page
     * @author Loveleen 
     * @date 9 Jan, 2018
     * @return view of home page
     */
    public function index() {

        $data['meta'] = array('title' => 'Home', 'page_name' => 'home');

        $this->core->view->make('web/index.php', $data);
    }

    /**
     *
     * Function is used to view login page
     * @author Adhaar 
     * @date 9 Jan, 2018
     * @return view of login page
     */

    public function login() {

        $data['meta'] = array('title' => 'Login', 'page_name' => 'login');
       $this->core->view->make('web/login.php', $data);
    }
    
     /**
     *
     * Function is used to view candidate signup page
     * @author Adhaar 
     * @date 9 Jan, 2018
     * @return view of candidate signup page
     */

    public function signup() {

        $data['meta'] = array('title' => 'Sign Up', 'page_name' => 'sign up');
     // print_r($this->models);die;
        $data['expertises'] = $this->models->masterExpertise->getexpertises(); 
        $data['experiences'] = $this->models->masterExperience->getexperiences();
        $data['degrees'] = $this->models->masterDegree->getdegrees();
        $data['studyfields'] = $this->models->masterStudyField->getdefaultstudyfields();
        $data['colleges'] = $this->models->masterCollege->getdefaultcolleges();
        $data['masterskilllevels'] = $this->models->masterSkillLevel->getmasterskilllevels();
        $locations = $this->models->masterLocations->getdefaultlocations();

          for($i=0;$i<3;$i++){
            array_push($locations,array('location'=>"","location_id"=>"noid"));
          }
                         //  print_r($locations);die;

        $data['locations'] = $locations;
        //print_r($locations);die;
        //print_r($data['expertises']);die;
        $this->core->view->make('web/sign_up_1.php', $data);
    }

   
    /**
     *
     *  Function is used to view forgot page
     * @author Loveleen 
     * @date 9 Jan, 2018
     * @return view of forgot page
     */
    public function forgotPassword() {

        $data['meta'] = array('title' => 'Forgot Password', 'page_name' => 'Forgot Password');

        $this->core->view->make('web/forgotPassword.php', $data);
    }

    /**
     *
     *  Function is Account Activation page
     * @author Loveleen 
     * @date 9 Jan, 2018
     * @return view of account page
     */
    public function accountActivation($token) {
        //echo "dii";die;
        $data = array();

        $token_exist = $this->models->user->checkTokenExist($token);
         // print_r($token_exist);die;
        if (!empty($token_exist)) {

            if ($token_exist['is_verified'] == '1') {
                if ($token_exist['is_deleted'] == '0' && $token_exist['Status'] == 'Inactive') { // deactived and verified
                    $_SESSION["account_exist"] = "Your account has been deactivated by admin, please contact administrator.";
                } else if ($token_exist['is_deleted'] == '1') { // deleted user
                    $_SESSION["account_exist"] = "Your account has been deleted by admin, please contact administrator.";
                } else { // already activated
                                // print_r($token_exist);die;

                    $_SESSION["account_exist"] = "Your account has been already activated.";
                    $data['meta'] = array('title' => 'Account Activation', 'page_name' => 'Account Activation');

                }
                $this->app->slim->redirect($this->app->config('base_url')."candidate/login");
            } else {
                if ($token_exist['is_deleted'] == '1') { // deleted user
                    $_SESSION["account_exist"] = "Your account has been deleted by admin, please contact administrator.";

                    $this->app->slim->redirect($this->app->config('base_url')."candidate/login");
                } else {
 
                    if ($token_exist['Status'] == 'Inactive') { // if account is not activated
                        $user_data = array();
                        $user_data['user_id'] = $token_exist['user_id'];
                        $user_data['Status'] = 'Active';
                        $user_data['is_verified'] = '1';
                        // activate the account
                        $set_status = $this->models->user->save($user_data);
                        if (!empty($set_status)) {
                            $data['message'] = "Your account has been activated successfully.";
                        }

                        $data['meta'] = array('title' => 'Account Activation', 'page_name' => 'Account Activation');

                        $this->core->view->make('web/accountActivation.php', $data);
                    } else { // if account is already activated
                        if ($token_exist['is_verified'] == '0') { // in case account is activated by admin then change he verify status to verified
                            $user_data = array();
                            $user_data['user_id'] = $token_exist['user_id'];
                            $user_data['is_verified'] = '1';
                            // change verify status
                            $set_status = $this->models->user->save($user_data);
                        }
                        echo "dd";die;
                        $_SESSION["account_exist"] = "Your account has been already activated.";

                        $this->app->slim->redirect($this->app->config('base_url').'candidate/login');
                    }
                }
            }
        } else {
            $_SESSION["account_exist"] = "Your account doesn't exist. The link is invalid.";

            $this->app->slim->redirect($this->app->config('base_url')."candidate/login");
        }
    }

    /**
     *
     *  Function is Regenerate password page
     * @author Loveleen 
     * @date 10 Jan, 2018
     * @return view of Regenerate password page
     */
    public function generatePassword($token) {
        $data = array();

        $token_exist = $this->models->user->checkTokenExist($token);

        if (!empty($token_exist)) {

            $current_date_time = strtotime(date('Y-m-d H:i:s'));
            $token_date_time = strtotime($token_exist['token_date_time']);

            $left_time = $current_date_time - $token_date_time;

            if ($left_time < 86400 && $left_time > 0) { // if the time difference is less than 24 hours
                $data['email'] = $token_exist['email'];

                $data['meta'] = array('title' => 'Reset Password', 'page_name' => 'Reset Password');

                $this->core->view->make('web/generatePassword.php', $data);
            } else { // if the time is greater than 24 hours
                $_SESSION["account_exist"] = "The link has been expired.";

                $this->app->slim->redirect($this->app->config('base_url'));
            }
        } else {
            $_SESSION["account_exist"] = "Your account doesn't exist. The link is invalid.";

            $this->app->slim->redirect($this->app->config('base_url'));
        }
    }

   
   
  

    public function saveVideo() {
        $data = array();

        $user = $this->app->user;

        $path = $this->app->config('file_upload_path') . "uploads/profileVideo/";

        $valid_formats = array("jpg", "png","mp4","jpeg", "PNG", "JPG", "JPEG");
        if (isset($_FILES['file1']['name'])) {
            $name = $_FILES['file1']['name'];
            $size = $_FILES['file1']['size'];
            $error_image = $_FILES['file1']['error'];
            $tempFile = sha1_file($_FILES['file1']['tmp_name']);

            if ($error_image) {// if there is an error image
                throw new BaseException('There is an error in "' . $name . '"');
            } else { // image is set
                $exploded = explode('.', $name);

                $ext = end($exploded);

                if (in_array($ext, $valid_formats)) { // image extension as per requirement
                    $size = filesize($_FILES['file1']['tmp_name']);

                    if ($size < (4 * 1024 * 1024)) { // size is 4 mb 
                      

                        $filename = $tempFile . '-' . time() . '.' . $ext;
                       

                        if (move_uploaded_file($_FILES['file1']['tmp_name'], $path . $filename)) {
                            $profile_image = array();
                            $profile_image['user_id'] = $user['user_id'];
                            $profile_image['image_name'] = $filename;
            
                          //  $profile_detail = $this->models->users->save($profile_image,$imageid);
           //   $data['message'] = 'Image uploaded successfully.';
             //  $this->core->response->json($data);
                           // if (!empty($profile_detail)) {
                              
                                $data['image_name'] = $this->app->config('base_url') . 'uploads/profileVideo/' . $filename;
                                $data['message'] = 'Video uploaded successfully.';
                                $this->core->response->json($data);
                           /* } else {
                                throw new BaseException('There is an error while saving image.');
                            }*/
                        } else {
                            throw new BaseException('There is an error in "' . $name . '" uploading.');
                        }
                    } else { // image size is greater

                        throw new BaseException('"' . $name . '" must not be greater than 4MB.');
                    }
                } else { // image extension not of follwing
                    throw new BaseException('"' . $name . '" must be jpg, png, jpeg, PNG, JPG, JPEG of file format.');
                }
            }
        } else {
            throw new BaseException('Invalid request format.');
        }
    }
    
    
    /**
     *
     *  Function is used to view admin login page
     * @author Loveleen 
     * @date 11 Jan, 2018
     * @return view of admin login page
     */
    public function adminLogin() {

        $data['meta'] = array('title' => 'Login', 'page_name' => 'Login');

        $this->core->view->make('admin/login.php', $data);
    }

     public function employerRegister() {

        $data['meta'] = array('title' => 'Employer Register', 'page_name' => 'Employer Register');

        $this->core->view->make('web/employer_registeration_page.php', $data);
    }
}