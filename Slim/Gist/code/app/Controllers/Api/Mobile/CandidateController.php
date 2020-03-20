<?php

namespace App\Controllers\Api\Mobile;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

use App\Controllers\Api\ApiBaseController as ApiBaseController;
use Quill\Factories\CoreFactory;
use Quill\Factories\ServiceFactory;
use Quill\Factories\ModelFactory;
use Quill\Exceptions\BaseException;
use Quill\Exceptions\ValidationException;
use Minishlink\WebPush\WebPush;

class CandidateController extends ApiBaseController {

    /**
     * Constructor
     * @param object contains app core.
     */
    function __construct($app = NULL) {

        // Call to parent class constructer.
        parent::__construct($app);

        // Instantiate models.
        $this->models = ModelFactory::boot(array('User', 'Admin','Candidate','CandidateEducation','CandidateJobs','CandidateLocation','CandidateSkill','MasterExpertise','MasterExperience','MasterDegree','MasterStudyField','MasterCollege','MasterLocations',"MasterSkillLevel"));

        // Instantiate core classes.
        $this->core = CoreFactory::boot(array('Response', 'Http', 'View'));

        // Instantiate services.
        $this->services = ServiceFactory::boot(array('Jwt'));
    }

    /**
     * @api {post} /api/user/login/ login user.
     * @apiName login
     * @apiGroup api/user
     * @apiDescription Use this api to login.
     * @apiParamExample {json} Request-Example:
     * {
     * "subject": "Some text",
     * "message": "Some text"
     * }
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     * @author Loveleen
     * @date 9 jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "You have logged in successfully.",
     * }
     * }
     */
    public function register() {
     
     $user = $this->app->user;
     $request = $this->jsonRequest;
     //print_r($request);die;
     $base_url = $this->app->config('base_url');
     $candidatelocationvalue = array();
     $candidateskillvalue = array();
     $candidateskillexperience = array();
     $candidateendmonth = array();
     $candidateendyear = array();

     foreach($request as $key=>$value){
     if( strpos( $key,"candidatelocationvalue" ) !== false) {
     array_push($candidatelocationvalue,$value); 
     }
     else if( strpos( $key,"candidateskillvalue" ) !== false) {
     array_push($candidateskillvalue,$value); 
     }
     else if( strpos( $key,"candidateskillexperience" ) !== false) {
     array_push($candidateskillexperience,$value); 
     }
     else if( strpos( $key,"candidateendmonth" ) !== false) {
     array_push($candidateendmonth,$value); 
     }
      else if( strpos( $key,"candidateendyear" ) !== false) {
     array_push($candidateendyear,$value); 
     }
     }
     $locationvaluelength = count($candidatelocationvalue);
     $user = array();
      $random_token = rand(1000000000, 9999999999);

                        // check random number already exist
     $user['verify_token'] = $this->_generateToken($random_token);
     $user['Email'] = $request['candidateemail'];
     $user['Password'] = password_hash($request['candidatepassword'], PASSWORD_DEFAULT);
     $user['Role'] = "Candidate";
     $user['Status'] = "Inactive";
     $user['is_verified'] = '0';
     $user['is_deleted'] = '0';

     $this->models->user->beginTransaction();
     $user_detail = $this->models->user->save($user);
     $candidateid = $user_detail['user_id'];


     $candidate = array();
     $candidate['user_id'] = $candidateid;
     $candidate['Name'] = $request['candidatename'];
     $candidate['experience'] = $request['candidateexperience[]'];
     $candidate['expertise'] = $request['candidateexpertise[]'];
     $candidate['blocked'] = $request['candidateblockedlist'];
     $candidate['url'] = $request['candidateurl'];
     $candidate['experience'] = $request['candidateexperience[]'];
     $candidate['expertise'] = $request['candidateexpertise[]']; 
     $candidate['question'] = $request['question'];
     $candidate['candidate_summary'] = '';
     $candidate['video_url'] = $request['video'];
     
     $check = $this->models->candidate->getUserDetailByName($candidate['Name']);
    if(count($check)>0 && $check!=""){
      $count = count($check);      
      $name = str_replace(" ","-",$candidate['Name']);
      $candidate['profile_link'] = $base_url."user/".$name."-".$count;
    }
    else{
      $name = str_replace(" ","-",$candidate['Name']);
      $candidate['profile_link'] = $base_url."user/".$name;
     }

     $candidate_detail = $this->models->candidate->save($candidate);

     
     $education = array();
     
     $education['user_id'] = $candidateid;

     $education['degree_id'] = $request['candidatedegree[]'];     

     if (array_key_exists("extrafieldofstudy[]", $request))
     {
     $newstudyfield = array();
     $newstudyfield['user_id'] = $candidateid;
     $newstudyfield['study_field'] = $request['extrafieldofstudy[]'];
     $newstudyfieldresult = $this->models->masterStudyField->save($newstudyfield);
     
     $education['study_field_id'] = array_unique($newstudyfieldresult);
   
     if(is_array($request['candidatestudyfields[]']))
   {
   $newarray = $request['candidatestudyfields[]'];
   foreach($newarray  as $key=>$value)
   {
    $check =  $this->models->masterStudyField->checkother($value);
    if($check['study_field']=="Others"){
    unset($newarray[$key]);
    }

   }
    $education['study_field_id'] =  array_merge($newarray,$education['study_field_id']);

   }

     }
     else
     {
      $education['study_field_id'] = $request['candidatestudyfields[]'];
    }

  

   if (array_key_exists("extracollege[]", $request))
     {
     $newcollege = array();
     $newcollege['user_id'] = $candidateid;
     $newcollege['college'] = $request['extracollege[]'];
     $newcollegeresult = $this->models->masterCollege->save($newcollege);
 $education['college_id'] = array_unique($newcollegeresult);
   
   if(is_array($request['candidatecollege[]']))
   {
   $newarray = $request['candidatecollege[]'];
   foreach($newarray  as $key=>$value)
   {
    $check =  $this->models->masterCollege->checkother($value);
    if($check['college']=="Others"){
    unset($newarray[$key]);
    }
   }
    $education['college_id'] =  array_merge($newarray,$education['college_id']);

   }

     }
     else
     {
      $education['college_id'] = $request['candidatecollege[]'];
    }
     
      
     $education['candidategradyear'] = $request['candidategradyear[]'];
    
    if(is_array($education['college_id']) && count($education['college_id']) ==1){
     $education['college_id'] = $education['college_id'][0];
    }

    if(is_array($education['study_field_id']) && count($education['study_field_id']) ==1){
        $education['study_field_id'] = $education['study_field_id'][0];
    }
        
     $education_detail = $this->models->candidateEducation->save($education);
     
     $job = array();
     $job['user_id'] = $candidateid;
     $job['company'] = $request['candidatecompany[]'];
     $job['job_title'] = $request['candidatecompanytitle[]'];
     if(!empty($request['is_currently_working[]']) && $request['is_currently_working[]']=="on"){ 
     $job['is_currently_working']  = $request['is_currently_working[]'];
   }
     $job['start_month'] = $request['candidatestartmonth[]'];
     $job['start_year'] = $request['candidatestartyear[]'];
     $job['end_month'] = $candidateendmonth;
     $job['end_year'] = $candidateendyear;
     $experience_detail = $this->models->candidateJobs->save($job);

     $location = array();
     $newlocations = array();
     $location['user_id'] = $candidateid;
     
      if(is_array($candidatelocationvalue) && $locationvaluelength>0) {
        foreach($candidatelocationvalue as $key=>$value){
            if($value!=""){
      $newlocation = array();
      $newlocation['user_id'] = $candidateid;
      $newlocation['location'] = $value;
      if($value!=""){

      $newlocationresult = $this->models->masterLocations->save($newlocation);
      } 
      array_push($request['candidatelocation[]'],$newlocationresult['location_id']);
     }
      }
      }
      
      foreach($request['candidatelocation[]'] as $key=>$value)
      {
      if($value=="noid"){
      if (($key = array_search($value, $request['candidatelocation[]'])) !== false) {
      unset($request['candidatelocation[]'][$key]);
      }
      }
      }      


     $location['candidatelocation'] = array_unique($request['candidatelocation[]']);
     //$location['candidatelocationvalue'] = $candidatelocationvalue;
     $location_detail = $this->models->candidateLocation->save($location);
     
     
     $skill = array();
     $skill['user_id'] = $candidateid;
     $skill['candidateskills'] = $request['candidateskills[]'];
     $skill['candidateskillvalue'] = $candidateskillvalue;
     $skill['candidateskillexperience'] = $candidateskillexperience;
     $skill_detail = $this->models->candidateSkill->save($skill);
     $this->models->user->commit();

     

                        $app = array(
                            'base_assets_url' => $this->app->config('base_assets_url'),
                            'base_url' => $this->app->config('base_url')
                        );

                        $user_info = array('sender' => 'Gist Admin',
                            'Name' => $candidate['Name'],
                            'link' => $this->app->config('base_url') . 'accountActivation/' . $user['verify_token'] . '/');
                        // send email to user for account activation
                        $this->services->emailNotification = new \App\Services\EmailNotification();
                        $this->services->emailNotification->sendMail(array('email' => $user['Email'], 'name' => $candidate['Name']), 'Gist Account activation', $this->core->view->make('email/account_invitation.php', array('user' => $user_info, 'app' => $app), false));


     
     $data = array();
                        $data['message'] = "Profile successfully created.PLease Login";
                        $this->core->response->json($data);
    }




     public function update() {
     $user = $this->app->user;
     $request = $this->jsonRequest;
   //  print_r($request);die;
     $base_url = $this->app->config('base_url');
     $candidatelocationvalue = array();
     $candidateskillvalue = array();
     $candidateskillexperience = array();
     $candidateendmonth = array();
     $candidateendyear = array();

     foreach($request as $key=>$value){
     if( strpos( $key,"candidatelocationvalue" ) !== false) {
     array_push($candidatelocationvalue,$value); 
     }
     else if( strpos( $key,"candidateskillvalue" ) !== false) {
     array_push($candidateskillvalue,$value); 
     }
     else if( strpos( $key,"candidateskillexperience" ) !== false) {
     array_push($candidateskillexperience,$value); 
     }
     else if( strpos( $key,"candidateendmonth" ) !== false) {
     array_push($candidateendmonth,$value); 
     }
      else if( strpos( $key,"candidateendyear" ) !== false) {
     array_push($candidateendyear,$value); 
     }
     }
     $locationvaluelength = count($candidatelocationvalue);
     
     
    
     $candidateid = $user['user_id'];
     $candidatedetails = $this->models->candidate->getUserDetailById($candidateid);

    
     

     $candidate = array();
     $candidate['user_id'] = $candidateid;
     $candidate['Name'] = $request['candidatename'];
     $candidate['experience'] = $request['candidateexperience[]'];
     $candidate['expertise'] = $request['candidateexpertise[]'];
     $candidate['blocked'] = $request['candidateblockedlist'];
     $candidate['url'] = $request['candidateurl'];
     $candidate['experience'] = $request['candidateexperience[]'];
     $candidate['expertise'] = $request['candidateexpertise[]']; 
     if(!empty($request['question']) && $request['question']!=""){
     $candidate['question'] = $request['question'];
     }
     $candidate['candidate_summary'] = '';
     if(!empty($request['video']) && $request['video']!=""){
     $candidate['video_url'] = $request['video'];
     }
     $candidate['candidate_id'] = $candidateid;
      if($candidatedetails['profile_link']==""){
      $check = $this->models->candidate->getUserDetailByName($candidate['Name']);
     if(count($check)>0 && $check!=""){
      $count = count($check);      
      $name = str_replace(" ","-",$candidate['Name']);
      $candidate['profile_link'] = $base_url."user/".$name."-".$count;
    }
    else{
      $name = str_replace(" ","-",$candidate['Name']);
      $candidate['profile_link'] = $base_url."user/".$name;
     }

     }
      $this->models->candidate->beginTransaction();
     $candidate_detail = $this->models->candidate->save($candidate);

     
     $education = array();
     
     $education['user_id'] = $candidateid;

     $education['degree_id'] = $request['candidatedegree[]'];     

     if (array_key_exists("extrafieldofstudy[]", $request))
     {
     $newstudyfield = array();
     $newstudyfield['user_id'] = $candidateid;
     $newstudyfield['study_field'] = $request['extrafieldofstudy[]'];
     $newstudyfieldresult = $this->models->masterStudyField->save($newstudyfield);
     
     $education['study_field_id'] = array_unique($newstudyfieldresult);
   
     if(is_array($request['candidatestudyfields[]']))
   {
   $newarray = $request['candidatestudyfields[]'];
   foreach($newarray  as $key=>$value)
   {
    $check =  $this->models->masterStudyField->checkother($value);
    if($check['study_field']=="Others"){
    unset($newarray[$key]);
    }

   }
    $education['study_field_id'] =  array_merge($newarray,$education['study_field_id']);

   }

     }
     else
     {
      $education['study_field_id'] = $request['candidatestudyfields[]'];
    }

  

   if (array_key_exists("extracollege[]", $request))
     {
     $newcollege = array();
     $newcollege['user_id'] = $candidateid;
     $newcollege['college'] = $request['extracollege[]'];
     $newcollegeresult = $this->models->masterCollege->save($newcollege);
 $education['college_id'] = array_unique($newcollegeresult);
   
   if(is_array($request['candidatecollege[]']))
   {
   $newarray = $request['candidatecollege[]'];
   foreach($newarray  as $key=>$value)
   {
    $check =  $this->models->masterCollege->checkother($value);
    if($check['college']=="Others"){
    unset($newarray[$key]);
    }
   }
    $education['college_id'] =  array_merge($newarray,$education['college_id']);

   }

     }
     else
     {
      $education['college_id'] = $request['candidatecollege[]'];
    }
     
      
     $education['candidategradyear'] = $request['candidategradyear[]'];
    
    if(is_array($education['college_id']) && count($education['college_id']) ==1){
     $education['college_id'] = $education['college_id'][0];
    }

    if(is_array($education['study_field_id']) && count($education['study_field_id']) ==1){
        $education['study_field_id'] = $education['study_field_id'][0];
    }

    $educationdetails = $this->models->candidateEducation->getEducationDetailById($candidateid);
          $alleducationids = array();
          foreach($educationdetails as $key=>$value){
            array_push($alleducationids,$value['candidate_education_id']);
          }

      if(is_array($request['candidate_education_id[]'])){  
        foreach($request['candidate_education_id[]'] as $key=>$value){
        $neweducation = array();
        $neweducation['candidate_education_id'] = $value;
        $neweducation['user_id'] = $candidateid;
        $neweducation['degree_id'] = $education['degree_id'][$key];
        $neweducation['study_field_id'] = $education['study_field_id'][$key];
        $neweducation['college_id'] = $education['college_id'][$key];
        $neweducation['grad_year'] = $education['candidategradyear'][$key];
        $education_detail = $this->models->candidateEducation->save($neweducation);

        }
                  $check = array_diff($alleducationids,$request['candidate_education_id[]']);
                 // echo count($check);die;
                if(count($check)>0){
                  foreach($check as $key => $value){
                        if($value!=""){
          $education_detail = $this->models->candidateEducation->deleteEducationById($value);        
                  }      
                  }                
                  }
               


     }
     else{
      $neweducation = array();
        $neweducation['candidate_education_id'] = $request['candidate_education_id[]'];
        $neweducation['user_id'] = $candidateid;
        $neweducation['degree_id'] = $education['degree_id'];
        $neweducation['study_field_id'] = $education['study_field_id'];
        $neweducation['college_id'] = $education['college_id'];
        $neweducation['grad_year'] = $education['candidategradyear'];  
        $education_detail = $this->models->candidateEducation->save($neweducation);
      $neweducationids = array($request['candidate_education_id[]']);
        $check = array_diff($alleducationids,$neweducationids);
                 // echo count($check);die;
                  if(count($check)>0){
                  foreach($check as $key => $value){
                        if($value!=""){
          $education_detail = $this->models->candidateEducation->deleteEducationById($value);        
                  }      
                  }                
                  }
               
     }
     
      
     $jobdetails = $this->models->candidateJobs->getJobDetailById($candidateid);
          $alljobids = array();
          foreach($jobdetails as $key=>$value){
            array_push($alljobids,$value['candidate_job_id']);
          }

     if(is_array($request['candidate_job_id[]'])){  
        foreach($request['candidate_job_id[]'] as $key=>$value){

     $job = array();
     $job['candidate_job_id'] =  $value;       
     $job['user_id'] = $candidateid;
     $job['company'] = $request['candidatecompany[]'][$key];
     $job['job_title'] = $request['candidatecompanytitle[]'][$key];
      $job['start_month'] = $request['candidatestartmonth[]'][$key];
     $job['start_year'] = $request['candidatestartyear[]'][$key];
     if($key==0){
     if(!empty($request['is_currently_working[]'] ) && $request['is_currently_working[]'] == 'on')
     {
       $job['end_month'] = 'nomonth';
     $job['end_year'] = 0;
     }
     else{
     $job['end_month'] = $candidateendmonth[$key];
     $job['end_year'] = $candidateendyear[$key];
     }
     }
     else{
     $job['end_month'] = $candidateendmonth[$key];
     $job['end_year'] = $candidateendyear[$key]; 
     }  
          $job_detail = $this->models->candidateJobs->save($job);  
     }

     $check = array_diff($alljobids,$request['candidate_job_id[]']);
                 // echo count($check);die;
                if(count($check)>0){
                  foreach($check as $key => $value){
                        if($value!=""){
          $education_detail = $this->models->candidateJobs->deleteJobById($value);        
                  }      
                  }                
                  }

     }
     else{
       $job = array();
     $job['candidate_job_id'] =  $request['candidate_job_id[]'];       
     $job['user_id'] = $candidateid;
     $job['company'] = $request['candidatecompany[]'];
     $job['job_title'] = $request['candidatecompanytitle[]'];
      $job['start_month'] = $request['candidatestartmonth[]'];
     $job['start_year'] = $request['candidatestartyear[]'];

    
     if(!empty($request['is_currently_working[]'] ) && $request['is_currently_working[]'] == 'on')
     {
       $job['end_month'] = 'nomonth';
     $job['end_year'] = 0;
     }
     else{
     $job['end_month'] = $candidateendmonth;
     $job['end_year'] = $candidateendyear;
     }
   
     
     $job_detail = $this->models->candidateJobs->save($job);    
      $newjobids = array($request['candidate_job_id[]']);
      $check = array_diff($alljobids,$newjobids);
                 // echo count($check);die;
                  if(count($check)>0){
                  foreach($check as $key => $value){
                        if($value!=""){
          $job_detail = $this->models->candidateJobs->deleteJobById($value);        
                  }      
                  }                
                  }

     }
     

     

    

     $location = array();
     $newlocations = array();
     $location['user_id'] = $candidateid;
     
      if(is_array($candidatelocationvalue) && $locationvaluelength>0) {
        foreach($candidatelocationvalue as $key=>$value){
            if($value!=""){
      $newlocation = array();
      $newlocation['user_id'] = $candidateid;
      $newlocation['location'] = $value;
      if($value!=""){

      $newlocationresult = $this->models->masterLocations->save($newlocation);
      } 
      array_push($request['candidatelocation[]'],$newlocationresult['location_id']);
     }
      }
      }
      
      foreach($request['candidatelocation[]'] as $key=>$value)
      {
      if($value=="noid"){
      if (($key = array_search($value, $request['candidatelocation[]'])) !== false) {
      unset($request['candidatelocation[]'][$key]);
      }
      }
      }     

      $location_delete_detail = $this->models->candidateLocation->deleteLocationsById($candidateid);

     $location['candidatelocation'] = array_unique($request['candidatelocation[]']);
     //$location['candidatelocationvalue'] = $candidatelocationvalue;

     $location_detail = $this->models->candidateLocation->save($location);
     
     
      $skill_delete_detail = $this->models->candidateSkill->deleteSkillsById($candidateid); 
     $skill = array();
     $skill['user_id'] = $candidateid;
     $skill['candidateskills'] = $request['candidateskills[]'];
     $skill['candidateskillvalue'] = $candidateskillvalue;
     $skill['candidateskillexperience'] = $candidateskillexperience;
     $skill_detail = $this->models->candidateSkill->save($skill);
     $this->models->user->commit();
     
      $data = array();
                        $data['message'] = "Profile successfully updated.";
                        $this->core->response->json($data);
     
    }

    /**
     * Function to check random number already exist
     * @author Loveleen 
     * @date 6 Feb, 2018
     * @return random number
     */
    private function _generateToken($token) {
        $verify_token = $this->models->user->checkTokenExist($token);

        if (!empty($verify_token)) {
            $new_token = rand(1000000000, 9999999999);
            return $this->_generateToken($new_token);
        } else {
            return $token;
        }
    }


     
      public function AutoApply(){

        //echo "reached";die;
     $app = array(
                        'base_assets_url' => $this->app->config('base_assets_url'),
                        'base_url' => $this->app->config('base_url')
                    );    
    $user = $this->app->user;
    $candidateid = $user['user_id'];
    $candidateDetails = $this->models->candidate->getUserDetailById($candidateid);
    $request = $this->jsonRequest;

    $employerEmail = $request['candidateEmployerEmail'];
        $this->services->emailNotification = new \App\Services\EmailNotification();
                    $this->services->emailNotification->sendMail(array('email' => $employerEmail, 'name' => 'Test'), 'Apply with gist', $this->core->view->make('email/invitation.php', array('user' => $candidateDetails, 'app' => $app), false));

                     $data = array();
                        $data['message'] = "Email successfully sent.";
                        $this->core->response->json($data);
    }


    public function candidateChangeQuestion(){
    $user = $this->app->user;
    $request = $this->jsonRequest;
    $questiondetails =array();
    $candidateid = $request['candidate_id'];
    $questiondetails['candidate_id'] = $candidateid;
    $questiondetails['question'] = $request['question'];
    $questionupdatedetails = $this->models->candidate->save($questiondetails);
    $data = array();
    $data['message'] = "Question successfully updated.";
        $this->core->response->json($data);     
    }
    /**
     *
     *  Function is giving link to user where password is regenerated
     * @author Loveleen 
     * @date 9 Jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "Please check your email for reset password link.",
     * }
     * }
     */

  

    public function regeneratePassword() {

        $request = $this->jsonRequest;

        $rules = [
            'required' => [['email']]];

        $v = new \Quill\Validator($request, array('email'));

        $v->rules($rules);

        if ($v->validate()) {

            $user = $v->sanatized();

            $user_detail = $this->models->user->checkEmail($user['email']);

            if (!empty($user_detail)) {

                if ($user_detail['status'] == '1') { // if user is active
                    $app = array(
                        'base_assets_url' => $this->app->config('base_assets_url'),
                        'base_url' => $this->app->config('base_url')
                    );
                    $user_info = array('sender' => $user_detail['username'],
                        'username' => $user_detail['username'],
                        'link' => $this->app->config('base_url') . 'generatePassword/' . $user_detail['verify_token'] . '/');

                    // send email to user for account activation
                    $this->services->emailNotification = new \App\Services\EmailNotification();
                    $this->services->emailNotification->sendMail(array('email' => $user_detail['email'], 'name' => $user_detail['username']), 'BrainPatient Password Regeneration', $this->core->view->make('email/passwordReset.php', array('user' => $user_info, 'app' => $app), false));

                    $user_data = array();
                    $user_data['user_id'] = $user_detail['user_id'];
                    $user_data['token_date_time'] = date('Y-m-d H:i:s');
                    $user_detail = $this->models->user->save($user_data);

                    if (!empty($user_detail)) {
                        $data = array();
                        $data['message'] = "Please check your email for reset password link.";
                        $this->core->response->json($data);
                    }
                } else {
                    throw new BaseException('You can only reset password once your account has been verified. Please check your email for instructions on how to verify.');
                }
            } else {
                throw new BaseException("Email address doesn't exist.");
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }

    /**
     *
     *  Function is giving link to user where password is regenerated
     * @author Loveleen 
     * @date 9 Jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "Please check your email for reset password link.",
     * }
     * }
     */
    public function resetPassword() {

        $request = $this->jsonRequest;

        $rules = [
            'required' => [['password'], ['confirm_password']]
        ];

        $v = new \Quill\Validator($request, array('password', 'confirm_password', 'email'));

        $v->rules($rules);

        if ($v->validate()) {

            $user = $v->sanatized();

            $user_detail = $this->models->user->getUserDetailsByEmail($user['email']);

            if (!empty($user_detail)) {

                if ($user['password'] == $user['confirm_password']) { // both password matches
                    $user_data = array();
                    $user_data['user_id'] = $user_detail['user_id'];
                    $user_data['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
                    $user_detail = $this->models->user->save($user_data);

                    $data = array();
                    $data['message'] = "Password changed successfully.";

                    $_SESSION["account_exist"] = "Password changed successfully.";

                    $this->core->response->json($data);
                } else {
                    throw new BaseException('Confirmation password is wrong.');
                }
            } else {
                throw new BaseException("Email address doesn't exist.");
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }

    /**
     *
     *  Function for user logout
     * @author Loveleen 
     * @date 9 Jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "User logout successfully.",
     * }
     * }
     */
    public function logout() {
        if (!empty($_COOKIE['token'])) {

            $request = $this->jsonRequest;

            setcookie('token', '', time() - (3600 * 24), $this->app->config('path'), $this->app->config('domain'), false, true);
//            $logged_out_data = array();
//            $logged_out_data['id'] = $request['id'];
//            $logged_out_data['is_loggedin'] = '0';
//            $logged_out_data['last_loggedout_date'] = date("Y-m-d h:i:s");
//            $this->models->user->save($logged_out_data);

            $data = array();
            $data['message'] = 'User logout successfully.';
            $this->core->response->json($data);
        }
    }

    /**
     *
     * Function for changing password
     * @author Loveleen 
     * @date 25 Jan, 2018
     * @return {"meta":{"success":true,"code":200},"data":{"message":"Password changed successfully."}}
     */
    public function changePassword() {

        $request = $this->jsonRequest;

        $user_data = array();

        $user_data = $this->app->user;

        $rules = [
            'required' => [['current_password'], ['new_password'], ['confirm_password']]
        ];

        $v = new \Quill\Validator($request, array('current_password', 'new_password', 'confirm_password'));

        $v->rules($rules);

        if ($v->validate()) {

            $data = array();
            $post_data = $v->sanatized();

            if (!empty($user_data)) { // check user is login
                $check = password_verify($post_data['current_password'], $user_data['password']);

                // password validation
                if (strlen($post_data['current_password']) < 6) { // password matches not matches the length
                    throw new BaseException('Minimum six characters required in current password.');
                }

                if (!empty($check)) { // if current password not matching the entered password
                    if ($post_data['current_password'] == $post_data['new_password']) {
                        throw new BaseException("Current password and old password should not be same.");
                    }
                    if ($post_data['new_password'] == $post_data['confirm_password']) { // both password same
                        // password validation
                        if (strlen($post_data['new_password']) < 6) {
                            throw new BaseException('Minimum six characters required in new password.');
                        }
                        $detail = array();
                        $detail['user_id'] = $user_data['user_id'];
                        $detail['password'] = password_hash($post_data['new_password'], PASSWORD_DEFAULT);
                        $user_detail = $this->models->user->save($detail); // save user detail

                        if (!empty($user_detail)) {
                            $data['message'] = 'Password changed successfully.';
                            $this->core->response->json($data);
                        }
                    } else {
                        throw new BaseException("Confirmation password is incorrect.");
                    }
                } else {
                    throw new BaseException("Current password is incorrect.");
                }
            } else {
                throw new BaseException("User is not login.");
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }
    
    /**
     *
     *  Function for admin login
     * @author Loveleen 
     * @date 11 Jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "You logged in successfully.",
     * }
     * }
     */
    public function adminLogin() {

        $request = $this->jsonRequest;

        $rules = [
            'required' => [['username'], ['password']]];

        $v = new \Quill\Validator($request, array('username', 'password'));

        $v->rules($rules);

        if ($v->validate()) {

            $user = $v->sanatized();

            $user_detail = $this->models->admin->getUserDetailsByUsername($user['username']);

            $check = password_verify($user['password'], $user_detail['password']);

            if (!empty($user_detail) && $check) { // check password is same
                $_SESSION['user_data']['user_id'] = $user_detail['admin_id'];
                $_SESSION['user_data']['user_name'] = $user_detail['username'];
                $_SESSION['user_data']['email'] = $user_detail['email'];

                $data = array();
                $data['user'] = 1;
                $data['message'] = 'You logged in successfully';

                $this->core->response->json($data);
            } else {
                throw new BaseException('Username or password incorrect');
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }
}
