<?php

namespace App\Models;

use Quill\Database as Database;

class Candidate extends Database {

    protected $tableName = ' Candidates';
    protected $primarykey = 'candidate_id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');

        if (!empty($user['candidate_id'])) {
            return $this->table()->where(array('user_id' => $user['candidate_id']))->update($user, true);
        } else {

            $user['created_at'] = date('Y-m-d H:i:s');
            return $this->table()->insert($user, true);

        }
    }

    public function getUserDetailById($user_id) {
        return $this->table()->select($this->tableName . '.*, master_experience.*,master_expertise.*,Users.*')
                        ->join('master_experience', 'master_experience.Experience_Id', $this->tableName . '.experience')
                        ->join('master_expertise', 'master_expertise.expertise_id', $this->tableName . '.expertise')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->one();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

    public function getUserDetailByName($user) {
        return $this->table()->select($this->tableName . '.*, master_experience.*,master_expertise.*,Users.*')
                        ->join('master_experience', 'master_experience.Experience_Id', $this->tableName . '.experience')
                        ->join('master_expertise', 'master_expertise.expertise_id', $this->tableName . '.expertise')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                        ->where(array($this->tableName . '.Name' => $user))
                        ->all();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

      public function getUserDetailByProfileLink($user_link) {
        return $this->table()->select($this->tableName . '.*, master_experience.*,master_expertise.*,Users.*')
                        ->join('master_experience', 'master_experience.Experience_Id', $this->tableName . '.experience')
                        ->join('master_expertise', 'master_expertise.expertise_id', $this->tableName . '.expertise')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                        ->where(array($this->tableName . '.profile_link' => $user_link))
                        ->one();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }
    
    public function getAllCandidates() {
        return $this->table()->select($this->tableName . '.*,Users.*,master_experience.*,master_expertise.*')          
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                         ->join('master_experience', 'master_experience.Experience_Id', $this->tableName . '.experience')
                         ->join('master_expertise', 'master_expertise.expertise_id', $this->tableName . '.expertise')
                         ->where(array('Users.Role' => 'Candidate'))
                        ->all();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

     public function getAllSavedCandidates() {
        return $this->table()->select($this->tableName . '.*,Users.Role,video_stats.*')      
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                         ->join('video_stats', 'video_stats.user_id', $this->tableName . '.user_id')
                         ->where(array('video_stats.is_save' => 1))
                        ->all();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

    public function getAllCandidatesEducation() {
        return $this->table()->select($this->tableName . '.*, candidate_education.*,candidate_jobs.*,Users.*')
                        ->join('candidate_education', 'candidate_education.user_id', $this->tableName . '.user_id')     
                        ->all();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

    public function getAllFilteredCandidates($final_user_ids) {

        if($final_user_ids["savedcheck"] == "no"){

        if(count($final_user_ids["user_ids"])==1)
    {
    return $this->table()->select($this->tableName . '.*,Users.Role')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                          ->where(array($this->tableName . '.user_id'=>$final_user_ids["user_ids"][0]))
                         ->where(array('Users.Role' => 'Candidate'))
                        ->all();
}   
else{    return $this->table()->select($this->tableName . '.*,Users.Role')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                          ->whereIn(array($this->tableName . '.user_id'=>$final_user_ids["user_ids"]))
                         ->where(array('Users.Role' => 'Candidate'))
                        ->all();
                    }
       }
       else{
         if(count($final_user_ids["user_ids"])==1)
    {
       // echo $final_user_ids["user_ids"][0];
    return $this->table()->select($this->tableName . '.*,Users.Role,video_stats.*')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                         ->join('video_stats', 'video_stats.user_id', $this->tableName . '.user_id')
                          ->where(array($this->tableName . '.user_id'=>$final_user_ids["user_ids"][0]))
                         ->where(array('Users.Role' => 'Candidate','video_stats.is_save' => 1))
                        ->all();
}   
else{    return $this->table()->select($this->tableName . '.*,Users.Role,video_stats.*')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                           ->join('video_stats', 'video_stats.user_id', $this->tableName . '.user_id')
                          ->whereIn(array($this->tableName . '.user_id'=>$final_user_ids["user_ids"]))
                         ->where(array('Users.Role' => 'Candidate','video_stats.is_save' => 1))
                        ->all();
                    }
       }
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

    public function getAllFilteredCandidatesBySkill($canidateskills){
     
     if(count($canidateskills)==1){
       
       $query = $this->table()->select($this->tableName . '.*,  Candidate_skills.user_id')
                        ->join('Candidate_skills', 'Candidates.user_id', $this->tableName . '.user_id')
                         ->where(array('Candidate_skills.skill' => $canidateskills[0]))
                         ->all();

       }
       else{
        $query = $this->table()->select($this->tableName . '.*,  Candidate_skills.user_id')
                        ->join('Candidate_skills', 'Candidates.user_id', $this->tableName . '.user_id')
                         ->whereIn(array('Candidate_skills.skill' => $canidateskills))
                         ->all();

       }
       return $query;
    }
   

}