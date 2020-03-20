<?php

namespace App\Models;

use Quill\Database as Database;

class CandidateJobs extends Database {

    protected $tableName = 'candidate_jobs';
    protected $primarykey = 'candidate_job_id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');
         
        if (!empty($user['candidate_job_id'])) {
           // print_r($user);die;
            return $this->table()->where(array('candidate_job_id' => $user['candidate_job_id']))->update($user, true);
        } else {

            $user['created_at'] = date('Y-m-d H:i:s');
            if(is_array($user['company'])){
            $count = count($user['company']);
            $checkcount = $count-1;    
            foreach($user['company'] as $key => $value){
            $newuser = array();
            $newuser['user_id'] = $user['user_id'];
            $newuser['company'] = $value;
            $newuser['job_title'] = $user['job_title'][$key];
            $newuser['start_month'] = $user['start_month'][$key];
            $newuser['start_year'] = $user['start_year'][$key]; 
            if($key==0 && !empty($user['is_currently_working']) && $user['is_currently_working']=="on"){
            $newuser['end_month'] = 'nomonth';
            $newuser['end_year'] = 0;
            $newuser['is_currently_working'] = 1;
            }
            else{
            $newuser['end_month'] = $user['end_month'][$key];
            $newuser['end_year'] = $user['end_year'][$key]; 
            $newuser['is_currently_working'] = 0;
            }
            $newuser['modified_at']   = $user['modified_at']; 
            $newuser['created_at']   = $user['created_at'];     
            $this->table()->insert($newuser, true);
        }
    }
    else{
        if($user['company']!=""){
         $newuser = array();
            $newuser['user_id'] = $user['user_id'];
            $newuser['company'] = $user['company'];
            $newuser['job_title'] = $user['job_title'];
            $newuser['start_month'] = $user['start_month'];
            $newuser['start_year'] = $user['start_year']; 
            if(!empty($user['is_currently_working']) && $user['is_currently_working']=="on"){
            $newuser['end_month'] = "nomonth";
            $newuser['end_year'] = 0; 
        }
        else{
             $newuser['end_month'] = $user['end_month'];
            $newuser['end_year'] = $user['end_year']; 
        }
            $newuser['modified_at']   = $user['modified_at']; 
            $newuser['created_at']   = $user['created_at'];     
            $this->table()->insert($newuser, true);
    }
}
        return true;
        }
    }
    public function getJobDetailById($user_id) {
        return $this->table()->select()->where(array('user_id'=>$user_id))
                        ->all();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

     public function getLatestCandidateJob($user_id) {
        return $this->table()->select()->where(array('user_id'=>$user_id))->orderBy('candidate_job_id','DESC')
                        ->one();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }
    
    public function deleteJobById($job_id) {
        
        return $this->table()->where(array('candidate_job_id'=>$job_id))->delete();
     }
}