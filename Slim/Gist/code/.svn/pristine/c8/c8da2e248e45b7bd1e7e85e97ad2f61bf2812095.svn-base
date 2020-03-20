<?php

namespace App\Models;

use Quill\Database as Database;

class MasterExperience extends Database {

    protected $tableName = ' master_experience';
    protected $primarykey = 'Experience_Id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');

        if (!empty($user['user_id'])) {
            return $this->table()->where(array('user_id' => $user['user_id']))->update($user, true);
        } else {

            $user['created_at'] = date('Y-m-d H:i:s');
            return $this->table()->insert($user, true);
        }
    }
     
      public function getexperiences() {

        $user['modified_at'] = date('Y-m-d H:i:s');

        return $this->table()->select()->all();
    }

     public function getAllFilteredCandidates($experiences){
     
             if(count($experiences['experiences'])==1){
         
          $query = $this->table()->select($this->tableName . '.*, Candidates.user_id')
                        ->join('Candidates', 'Candidates.experience', $this->tableName . '.Experience_Id')
                         ->where(array($this->tableName . '.Experience_Id' => $experiences['experiences']))
                         ->all();
             }
       else{
     $query = $this->table()->select($this->tableName . '.*, Candidates.user_id')
                        ->join('Candidates', 'Candidates.experience', $this->tableName . '.Experience_Id')
                         ->whereIn(array($this->tableName . '.Experience_Id' => $experiences['experiences']))
                         ->all();
       }

       return $query;
    }
}