<?php

namespace App\Controllers\Web;

use Quill\Factories\CoreFactory;
use Quill\Factories\ServiceFactory;
use Quill\Factories\ModelFactory;
use Quill\Exceptions\BaseException;
use Quill\Exceptions\ValidationException;

class UserController extends \App\Controllers\Web\AccountBaseController {

    function __construct($app = NULL) {

        // Call to parent class constructer.
        parent::__construct($app);

        // Instantiate models.
         $this->models = ModelFactory::boot(array('User','MasterExpertise','MasterExperience','MasterDegree','MasterStudyField','MasterCollege','MasterLocations',"MasterSkillLevel","Candidate","CandidateEducation","CandidateJobs","CandidateLocation","CandidateSkill","VideoStats"));

        // Instantiate core classes.
        $this->core = CoreFactory::boot(array('Response', 'Http', 'View'));

        // Instantiate services.
        $this->services = ServiceFactory::boot(array('Jwt'));
    }
     public function candidateedit(){
          $user = $this->app->user;
    $data['meta'] = array('title' => 'Candidate Profile', 'page_name' => 'candidate profile');
  //  $userdata = unserialize($_COOKIE['user_detail']);
    $data['studyfields'] = $this->models->masterStudyField->getstudyfields($user['user_id']);
    $data['expertises'] = $this->models->masterExpertise->getexpertises(); 
        $data['experiences'] = $this->models->masterExperience->getexperiences();
        $data['degrees'] = $this->models->masterDegree->getdegrees();
        
        $data['colleges'] = $this->models->masterCollege->getcolleges($user['user_id']);
        $data['masterskilllevels'] = $this->models->masterSkillLevel->getmasterskilllevels();

        $locations = $this->models->masterLocations->getlocations($user['user_id']);

          for($i=0;$i<3;$i++){
            array_push($locations,array('location'=>"","location_id"=>"noid"));
          }
                         //  print_r($locations);die;

        $data['locations'] = $locations;
       
       //print_r($userdata);die;
        $data['candidatedetails'] = $this->models->candidate->getUserDetailById($user['user_id']);
        $data['candidateeducationdetails'] = $this->models->candidateEducation->getEducationDetailById($user['user_id']);
         $data['candidatejobdetails'] = $this->models->candidateJobs->getJobDetailById($user['user_id']);
         $data['candidatelocationdetails'] = $this->models->candidateLocation->getLocationDetailById($user['user_id']);
         $data['candidateskilldetails'] = $this->models->candidateSkill->getSkillDetailById($user['user_id']);
      //  print_r($data['candidatejobdetails']);die;
    $this->core->view->make('web/candidate_edit_profile.php', $data);
    }

   public function candidategistedit(){
    $user = $this->app->user;
         $data['meta'] = array('title' => 'Candidate Gist', 'page_name' => 'candidate gist');
         $candidateid = $user['user_id'];  
         $role = $user['Role'];            
         $data['candidatedetails'] = $this->models->candidate->getUserDetailById($candidateid);
           $data['candidate_id'] = $candidateid;
           $data['user_role'] = $role;
         //print_r($data['candidatedetails']);die;
       $this->core->view->make('web/candidate_edit_gist.php', $data);
    }

     public function candidatedashboard(){
            

    $user = $this->app->user;
         $data['meta'] = array('title' => 'Candidate Dashboard', 'page_name' => 'candidate dashboard');
         $candidateid = $user['user_id'];
         $role = $user['Role'];  
        // echo $role;die;           
         $data['candidatedetails'] = $this->models->candidate->getUserDetailById($candidateid);
           $data['candidate_id'] = $candidateid;



         $candidateAllEducation = $this->models->candidateEducation->getEducationDetailById($candidateid);
       
         $candidateLatestEducation = $this->models->candidateEducation->getLatestCandidateEducation($candidateid);
         
        

         $candidateAllJob =  $this->models->candidateJobs->getJobDetailById($candidateid);
       
         $candidateLatestJob = $this->models->candidateJobs->getLatestCandidateJob($candidateid);
        
          
         $candidateLocationDetails = $this->models->candidateLocation->getLocationDetailById($candidateid);

         $data['candidateSkillDetails'] = $this->models->candidateSkill->getSkillDetailById($candidateid);

         $candidateVideoDetails = $this->models->videoStats->getVideoDetailsById($candidateid);

        $candidateModifiedVideoLatestDetails = $this->models->videoStats->getModifiedVideoLatestDetailsById($candidateid);


         $candidateCreatedVideoLatestDetails = $this->models->videoStats->getCreatedVideoLatestDetailsById($candidateid);
              
         $candidateVideoLatestDetails = array_merge($candidateModifiedVideoLatestDetails,$candidateCreatedVideoLatestDetails);
                                    
        $candidateVideoLatestDetails =array_unique($candidateVideoLatestDetails, SORT_REGULAR);

        $candidateLatestViews = 0;
         $candidateLatestShares = 0;
         $candidateLatestSaves = 0;
        if(count($candidateVideoLatestDetails)>0){

          foreach($candidateVideoLatestDetails as $key=>$value){
           $candidateLatestViews+=$value['is_view'];
             $candidateLatestShares+=$value['is_share'];
             $candidateLatestSaves+=$value['is_save'];
          }
        }

         $candidateTotalViews = 0;
         $candidateTotalShares = 0;
         $candidateTotalSaves = 0;

        if(count($candidateVideoDetails)>0){

          foreach($candidateVideoDetails as $key=>$value){
           $candidateTotalViews+=$value['is_view'];
             $candidateTotalShares+=$value['is_share'];
             $candidateTotalSaves+=$value['is_save'];
          }
        }

        $data['candidateLatestEducationdetails'] = $candidateLatestEducation;
        $data['candidateLatestJobdetails'] = $candidateLatestJob;
        $data['candidateAllEducationdetails'] = $candidateAllEducation;
        $data['candidateAllJobdetails'] = $candidateAllJob;
        $data['candidateLocationDetails'] = $candidateLocationDetails;
         $data['candidateLatestViews'] = $candidateLatestViews;
          $data['candidateLatestShares'] = $candidateLatestShares;
           $data['candidateLatestSaves'] = $candidateLatestSaves;
           $data['candidateTotalViews'] = $candidateTotalViews;
          $data['candidateTotalShares'] = $candidateTotalShares;
           $data['candidateTotalSaves'] = $candidateTotalSaves;

            $data['user_role'] = $role;
         //print_r($data['candidatedetails']);die;
       $this->core->view->make('web/candidate_dashboard.php', $data);
    }
 

    public function profile($user_link){
       // echo "aa";die;
         $base_url = $this->app->config('base_url');
        // echo $user;die;
        //$username = str_replace("-"," ",$user);
              $data = array();  
        $profile_link=$base_url."user/".$user_link;
        $data['candidatedetails'] = $this->models->candidate->getUserDetailByProfileLink($profile_link);
               // print_r($data['candidatedetails']);die;
        //echo $username;die;
         $candidateid = $data['candidatedetails']['candidate_id'];
         $candidateAllEducation = $this->models->candidateEducation->getEducationDetailById($candidateid);
       
         $candidateLatestEducation = $this->models->candidateEducation->getLatestCandidateEducation($candidateid);
         
        

         $candidateAllJob =  $this->models->candidateJobs->getJobDetailById($candidateid);
       
         $candidateLatestJob = $this->models->candidateJobs->getLatestCandidateJob($candidateid);
        
          
          
         $candidateLocationDetails = $this->models->candidateLocation->getLocationDetailById($candidateid);
        
        //print_r($candidateLatestEducation);die;
        $data['candidateSkillDetails'] = $this->models->candidateSkill->getSkillDetailById($candidateid);
        $data['candidateLatestEducationdetails'] = $candidateLatestEducation;
        $data['candidateLatestJobdetails'] = $candidateLatestJob;
        $data['candidateAllEducationdetails'] = $candidateAllEducation;
        $data['candidateAllJobdetails'] = $candidateAllJob;
        $data['candidateLocationDetails'] = $candidateLocationDetails;
        $candidateskills = array();
        foreach($data['candidateSkillDetails'] as $key=>$value){
         array_push($candidateskills,$value['skill']); 
        }
        $skills_string = "";
        $count = count($candidateskills);
        $lastkey = $count-1;
        $secondlastkey = $count - 2;
        foreach ($candidateskills as $key => $value) {
            if($key==$lastkey){
                 $skills_string .= " ";
                $skills_string .= $value; 
            }
            else if($key==$secondlastkey){
               $skills_string .= $value;
               $skills_string .= " and"; 
            }
            else{
                $skills_string .= $value;
                $skills_string .= ",";
            }
        }
      //  $skills_string = implode(",",$candidateskills);
        $data['skills_string'] = $skills_string;
       //print_r($this->app);die;
      // $data['base_assets_url'] = $this->app->config('base_assets_url');
       //$data['base_url'] = $this->app->config('base_url');
       //$data['profile_upload_path'] = $this->app->config('document_root');
       //print_r($data);die;
        $this->core->view->make('web/candidate_view.php', $data);
    }

    public function employerdashboard(){
    $user = $this->app->user;
    $data = array();
         $data['meta'] = array('title' => 'Employer Dashboard', 'page_name' => 'employer dashboard');
         $employerid = $user['user_id'];
         $role = $user['Role'];             
          $data = array();  
        $data['candidatedetails'] = $this->models->candidate->getAllCandidates();
               // print_r($data['candidatedetails']);die;
        //echo $username;die;
         //$candidateid = $data['candidatedetails']['candidate_id'];
        $candidateAllEducation = array();
        foreach ($data['candidatedetails'] as $key => $value) {
            $result = $this->models->candidateEducation->getEducationDetailById($value['user_id']);
     array_push($candidateAllEducation,$result);
       }
        $candidateLatestEducation = array();
        foreach ($data['candidatedetails'] as $key => $value) {
        $result = $this->models->candidateEducation->getLatestCandidateEducation($value['user_id']);
         array_push($candidateLatestEducation,$result);  
         }
        
          $candidateAllJob = array();
        foreach ($data['candidatedetails'] as $key => $value) {
            $result = $this->models->candidateJobs->getJobDetailById($value['user_id']);
         array_push($candidateAllJob,$result);
       }
       
        $candidateLatestJob = array();
        foreach ($data['candidatedetails'] as $key => $value) {
        $result = $this->models->candidateJobs->getLatestCandidateJob($value['user_id']);
         array_push($candidateLatestJob,$result);  
         }
        
          $candidateLocationDetails = array();
        foreach ($data['candidatedetails'] as $key => $value) {
        $result = $this->models->candidateLocation->getLocationDetailById($value['user_id']);
         array_push($candidateLocationDetails,$result);  
         }
          
         $candidateSkillDetails = array();
        foreach ($data['candidatedetails'] as $key => $value) {
        $result = $this->models->candidateSkill->getSkillDetailById($value['user_id']);
         array_push($candidateSkillDetails,$result);  
         }
          
        
        //print_r($candidateLatestEducation);die;
        $data['candidateSkillDetails'] = $candidateSkillDetails;
        $data['candidateLatestEducationdetails'] = $candidateLatestEducation;
        $data['candidateLatestJobdetails'] = $candidateLatestJob;
        $data['candidateAllEducationdetails'] = $candidateAllEducation;
        $data['candidateAllJobdetails'] = $candidateAllJob;
        $data['candidateLocationDetails'] = $candidateLocationDetails;
        $candidateskills = array();

        //print_r($data['candidateSkillDetails']);die;
         $skills_string_array = array();
        
        foreach($data['candidateSkillDetails'] as $key=>$value){
        $skills_string = "";
         $candidateskills = $value; 
        
        
              //  print_r($candidateskills);die;

        $count = count($candidateskills);
        $lastkey = $count-1;
        $secondlastkey = $count - 2;
        foreach ($candidateskills as $key2 => $value2) {
         
           // echo $key2;die;
            if($key2==$lastkey){
                 $skills_string .= " ";
                $skills_string .= $value2['skill']; 
            }
            else if($key2==$secondlastkey){
               $skills_string .= $value2['skill'];
               $skills_string .= " and"; 
            }
            else{
                $skills_string .= $value2['skill'];
                $skills_string .= ",";
            }
        
        }
        array_push($skills_string_array,$skills_string);
        }
      //  $skills_string = implode(",",$candidateskills);
        $data['skills_string'] = $skills_string_array;
        $locations = $this->models->masterLocations->getdefaultlocations();
        $studyfields = $this->models->masterStudyField->getdefaultstudyfields();
        $data['defaultlocations'] = $locations;   
        $data['defaultstudyfields'] = $studyfields;
        $data['defaultcolleges'] = $this->models->masterCollege->getdefaultcolleges();
        $data['defaultdegrees'] = $this->models->masterDegree->getdegrees();
        $data['defaultexperiences'] = $this->models->masterExperience->getexperiences();
        $data['defaultexpertises'] = $this->models->masterExpertise->getexpertises();
        $data['defaultskilllevels'] = $this->models->masterSkillLevel->getmasterskilllevels();
        $data['candidatedetails'] = $this->models->candidate->getAllCandidates();
        $data['user_role'] = $role;        
        $data['candidateLatestEducationdetails'] = $candidateLatestEducation;
        $data['candidateLatestJobdetails'] = $candidateLatestJob;
      //  $data['candidateAllEducationdetails'] = $candidateAllEducation;
       // $data['candidateALLJobdetails'] = $candidateAllJob;

         //print_r($data['candidateJobdetails']);die;
        $this->core->view->make('web/employer_dashboard.php', $data);
       
    }


   
    public function changeVideo(){
      $data = array();

        $user = $this->app->user;
        $candidateid = $user['user_id'];
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
                            $profile_image['candidate_id'] = $candidateid;
                            $profile_image['video_url'] = $filename;
            
         $profile_detail = $this->models->candidate->save($profile_image);
           //   $data['message'] = 'Image uploaded successfully.';
             //  $this->core->response->json($data);
                           if (!empty($profile_detail)) {
                              
                                $data['image_name'] = $this->app->config('base_url') . 'uploads/profileVideo/' . $filename;
                                $data['message'] = 'Video uploaded successfully.';
                                $this->core->response->json($data);
                            } else {
                                throw new BaseException('There is an error while saving image.');
                            }
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

   
    /*
     * Logout user
     */
     
    public function logout() {

        if (!empty($_COOKIE['token'])) { // if user is login

            setcookie('token', '', time() - (3600 * 24), $this->app->config('path'), $this->app->config('domain'), false, true);
        }

        $this->slim->redirect($this->app->config('base_url'));
    }
}
