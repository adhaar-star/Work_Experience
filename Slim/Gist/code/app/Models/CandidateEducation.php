<?php

namespace App\Models;

use Quill\Database as Database;
use Quill\Factories\ModelFactory;

class CandidateEducation extends Database {

 
 
    protected $tableName = 'candidate_education';
    protected $primarykey = 'candidate_education_id';
    
    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');
        if (!empty($user['candidate_education_id'])) {
                     
          return $this->table()->where(array('candidate_education_id' => $user['candidate_education_id']))->update($user, true);   
        } else {
            $user['created_at'] = date('Y-m-d H:i:s');
           if(is_array($user['degree_id'])){
            foreach($user['degree_id'] as $key => $value){
            $newuser = array();
            $newuser['user_id'] = $user['user_id'];
            $newuser['degree_id'] = $value;
            $newuser['study_field_id'] = $user['study_field_id'][$key];
            $newuser['college_id'] = $user['college_id'][$key];
            $newuser['grad_year'] = $user['candidategradyear'][$key]; 
            $newuser['modified_at']   = $user['modified_at']; 
            $newuser['created_at']   = $user['created_at'];     
            $this->table()->insert($newuser, true);
        }
    }
    else{

          $newuser = array();
            $newuser['user_id'] = $user['user_id'];
            $newuser['degree_id'] = $user['degree_id'];
            $newuser['study_field_id'] = $user['study_field_id'];
            $newuser['college_id'] = $user['college_id'];
            $newuser['grad_year'] = $user['candidategradyear']; 
            $newuser['modified_at']   = $user['modified_at']; 
            $newuser['created_at']   = $user['created_at'];     
            $this->table()->insert($newuser, true);
    }
        return true;
        }
    }

     public function getEducationDetailById($user_id) {
        return $this->table()->select($this->tableName . '.*, master_degree.*, master_study_field.*,master_college.*')
                        ->join('master_degree', 'master_degree.degree_Id', $this->tableName . '.degree_id')
                        ->join('master_study_field', 'master_study_field.study_field_id', $this->tableName . '.study_field_id')
                        ->join('master_college', 'master_college.college_id', $this->tableName . '.college_id')
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->all();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

    public function getLatestCandidateEducation($user_id) {
        return $this->table()->select($this->tableName . '.*, master_degree.*, master_study_field.*,master_college.*')
                        ->join('master_degree', 'master_degree.degree_Id', $this->tableName . '.degree_id')
                        ->join('master_study_field', 'master_study_field.study_field_id', $this->tableName . '.study_field_id')
                        ->join('master_college', 'master_college.college_id', $this->tableName . '.college_id')
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->orderBy($this->tableName . '.candidate_education_id', 'DESC')
                        ->one();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

     public function deleteEducationById($education_id) {
        
        return $this->table()->where(array('candidate_education_id'=>$education_id))->delete();
     }
}