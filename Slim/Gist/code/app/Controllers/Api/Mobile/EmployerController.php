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

class EmployerController extends ApiBaseController {

    /**
     * Constructor
     * @param object contains app core.
     */
    function __construct($app = NULL) {

        // Call to parent class constructer.
        parent::__construct($app);

        // Instantiate models.
        $this->models = ModelFactory::boot(array('User', 'Admin','Candidate','MasterExpertise','MasterExperience','MasterDegree','MasterStudyField','MasterCollege','MasterLocations',"MasterSkillLevel",'Employer','EmployerCards','MasterLocations','VideoStats',"CandidateEducation","CandidateJobs","CandidateLocation","CandidateSkill"));

        // Instantiate core classes.
        $this->core = CoreFactory::boot(array('Response', 'Http', 'View'));

        // Instantiate services.
        $this->services = ServiceFactory::boot(array('Jwt'));
     }
  
     public function register($app = NULL){
     $request = $this->jsonRequest;
     // print_r($request);
     $user = array();
     $user['Email'] = $request['email'];
     $user['Password'] = password_hash($request['employer_password'], PASSWORD_DEFAULT);
     $user['Role'] = 'Employer';
     $user['Status'] = 'Active';
     $this->models->user->beginTransaction();
     $user_details = $this->models->user->save($user); 
     $employer_id = $user_details['user_id'];

     $employer = array();
     $employer['user_id'] = $employer_id;
     $employer['Name'] = $request['name'];
     $employer['Phone'] = $request['phone'];
     $employer['Job_Title'] = $request['job_title'];
     $employer['company_name'] = $request['company_name'];
     $employer['company_industry'] = $request['company_industry'];
     $employer['customer_id'] = '';
     $employer_register_details = $this->models->employer->save($employer); 


    
     $employercard = array();
     $employercard['user_id'] = $employer_id;
     $employercard['card_number'] = $request['credit_card'];
     $employercard['card_holder_name'] = $request['name'];
     $employercard['expiration_date'] = $request['expiration_date'];
     $employercard['zipcode'] = $request['billing_zip'];    
     $employer_card_details  = $this->models->employerCards->save($employercard);
     $this->models->user->commit();

     $data = array();
     $data['message'] = "Profile successfully updated.";
     $this->core->response->json($data);
     }
     
     public function createResumePdf($app = NULL){
     $user = $this->app->user;
     $request = $this->jsonRequest;  
     $employerid = $user['user_id'];
     $candidateid = $request['candidate_id'];
     $role = $user['Role'];  
              $data = array();  

         $data['candidatedetails'] = $this->models->candidate->getUserDetailById($candidateid);
  
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
     $skills_string = implode(",",$candidateskills);
      $data['skills_string'] = $skills_string;
        $base_url =$this->app->config('document_root'); 

        require_once $base_url.'/vendor/autoload.php';
               $filename = $data['candidatedetails']['Name'] . '-' . time() . '.pdf';
$mpdf = new \Mpdf\Mpdf();
           $mpdf->WriteHTML($this->core->view->make('web/resume.php', $data, false));
           $mpdf->Output($this->app->config('document_root') . '/uploads/pdf/' . $filename, 'F');
     // $this->core->view->make('web/resume.php', $data);

           $response = array();
            $response['return_url'] = $this->app->config('base_url') . 'uploads/pdf/' . $filename;
         $response['message'] = "Success";
         $this->core->response->json($response);
       
      }
      

      public function filterCandidates($app = NULL){
      $request = $this->jsonRequest;
      $candidate_details = array();
      $candidate_education_details = array();
      $candidate_location_details = array();
      $other_locations = $this->models->masterLocations->getOthers();
      $other_colleges = $this->models->masterCollege->getOthers();
      $other_study_fields = $this->models->masterStudyField->getOthers();
      $all_location_ids = array();
      
      if(in_array($other_locations['location_id'],$request['locations'])) {
       $candidate_location_details['other_location'] = "yes"; 
      }
      else{
       $candidate_location_details['other_location'] = "no"; 
      }

      if(in_array($other_study_fields['study_field_id'],$request['study_fields'])) {
       $candidate_education_details['other_study_field'] = "yes"; 
      }
      else{
       $candidate_education_details['other_study_field'] = "no"; 
      }

      if(in_array($other_colleges['college_id'],$request['colleges'])) {
       $candidate_education_details['other_college'] = "yes"; 
      }
      else{
       $candidate_education_details['other_college'] = "no"; 
      }

      $candidate_location_details['locations'] = $request['locations'];
      $candidate_details['expertises'] = $request['expertises'];
      $candidate_details['experiences'] = $request['experiences'];
      $candidate_education_details['study_fields'] = $request['study_fields'];
      $candidate_education_details['colleges'] = $request['colleges'];
      $candidate_education_details['degrees'] = $request['degrees'];
       
       $user_ids = array();
      
      if(count($request['locations'])>0){
      $filtered_locations_candidates = $this->models->masterLocations->getAllFilteredCandidates($candidate_location_details);
      foreach($filtered_locations_candidates as $key => $value){
        array_push($user_ids,$value['user_id']);
      }
           // print_r($filtered_locations_candidates);die;

      }

      if(count($request['expertises'])>0){
      $filtered_expertises_candidates = $this->models->masterExpertise->getAllFilteredCandidates($candidate_details);
      foreach($filtered_expertises_candidates as $key => $value){
        array_push($user_ids,$value['user_id']);
      }
          }

    if(count($request['experiences'])>0){
     $filtered_experiences_candidates = $this->models->masterExperience->getAllFilteredCandidates($candidate_details);
     foreach($filtered_experiences_candidates as $key => $value){
        array_push($user_ids,$value['user_id']);
      }
     }

     if(count($request['colleges'])>0){
      $filtered_colleges_candidates = $this->models->masterCollege->getAllFilteredCandidates($candidate_education_details);
      foreach($filtered_colleges_candidates as $key => $value){
        array_push($user_ids,$value['user_id']);
      }
                        
      }

      if(count($request['study_fields'])>0){
      $filtered_study_fields_candidates = $this->models->masterStudyField->getAllFilteredCandidates($candidate_education_details);
      foreach($filtered_study_fields_candidates as $key => $value){
        array_push($user_ids,$value['user_id']);
      }

        }

        if(count($request['degrees'])>0){
      $filtered_degrees_candidates = $this->models->masterDegree->getAllFilteredCandidates($candidate_education_details);
      foreach($filtered_degrees_candidates as $key => $value){
        array_push($user_ids,$value['user_id']);
      }
        
   
      }
      

      if($request['skills']!=""){
          $canidateskills = explode(",",$request['skills']);
           $filtered_skills_candidates = $this->models->candidate->getAllFilteredCandidatesBySkill($canidateskills);
      
        foreach($filtered_skills_candidates as $key => $value){
        array_push($user_ids,$value['user_id']);
      }
      }
      $final_candidates = array();

      if($request['savedcheck']!="" && $request['savedcheck'] == "on"){
       $final_candidates["savedcheck"] = "yes";     
      }
      else{
      $final_candidates["savedcheck"] = "no"; 
      }
      if(count($user_ids)>0){
      $final_user_ids = array_unique($user_ids);
        $final_candidates["user_ids"] = $final_user_ids; 
      $filtered_final_candidates = $this->models->candidate->getAllFilteredCandidates($final_candidates);
  }
  else{
    if($request['savedcheck']!="" && $request['savedcheck'] == "on"){
        
    $filtered_final_candidates = $this->models->candidate->getAllSavedCandidates();
    }
    else{
    $filtered_final_candidates = $this->models->candidate->getAllCandidates();
    }
  }

      $data['candidatedetails'] = $filtered_final_candidates;

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
      $data['skills_string'] = $skills_string_array;
      $data['message'] = "Candidates successfully filtered.";
      $this->core->response->json($data);
      }

       public function updateViews(){
     $user = $this->app->user;       
     $request = $this->jsonRequest;

     $employer_id = $user['user_id'];
     $video_data = array();
     $video_data['user_id'] = $request['candidate_id'];
     $video_data['employer_id'] = $employer_id;
     $video_data['is_view'] = 1;
     $video_stats = $this->models->videoStats->save($video_data);

     $data = array();
     $data['message'] = "Views successfully updated.";
     $this->core->response->json($data);
     }
     
     public function updateSaves(){
     $user = $this->app->user;       
     $request = $this->jsonRequest;

     $employer_id = $user['user_id'];
     $video_data = array();
     $video_data['user_id'] = $request['candidate_id'];
     $video_data['employer_id'] = $employer_id;
     $video_data['is_save'] = 1;
     if($request['is_saved']==1){
     $video_data['is_save'] = "0";
     }else {
      $video_data['is_save'] = "1";  
     }
     $video_stats = $this->models->videoStats->save($video_data);
       
     $data = array();
     $data['message'] = "Saves successfully updated.";
     $this->core->response->json($data);
     }
     
     public function updateShares(){
     $user = $this->app->user;  
     $request = $this->jsonRequest;

     $employer_id = $user['user_id'];
     $video_data = array();
     $video_data['user_id'] = $request['candidate_id'];
     $video_data['employer_id'] = $employer_id;
     $video_data['is_share'] = 1;
     $video_stats = $this->models->videoStats->save($video_data);

     $data = array();
     $data['message'] = "Share successfully updated.";
     $this->core->response->json($data);
     }
 }