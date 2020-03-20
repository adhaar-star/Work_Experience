<?php

namespace App\Models;

use Quill\Database as Database;

class CandidateSkill extends Database {

    protected $tableName = 'Candidate_skills';
    protected $primarykey = 'candidate_skill_id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');
         
        if (!empty($user['candidate_location_id'])) {
            return $this->table()->where(array('user_id' => $user['user_id']))->update($user, true);
        } else {

            $user['created_at'] = date('Y-m-d H:i:s');
            foreach($user['candidateskillvalue'] as $key => $value){
             if($user['candidateskillvalue'][$key]!="" && $user['candidateskillexperience'][$key]!="default"){   
            $newuser = array();
            $newuser['user_id'] = $user['user_id'];
            $newuser['skill'] = $user['candidateskillvalue'][$key];
            $newuser['experience_Id'] = $user['candidateskillexperience'][$key];
            $newuser['modified_at']   = $user['modified_at']; 
            $newuser['created_at']   = $user['created_at'];     
            $this->table()->insert($newuser, true);
        }
        }
        return true;
        }
    }

       public function getSkillDetailById($user_id) {
        return $this->table()->select($this->tableName . '.*, master_skill_level.*')
                        ->join('master_skill_level', 'master_skill_level.master_skill_level_id', $this->tableName . '.experience_Id')     
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->all();
       
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

     public function deleteSkillsById($user_id) {
    return $this->table()->where(array('user_id'=>$user_id))->delete();
    }  
}