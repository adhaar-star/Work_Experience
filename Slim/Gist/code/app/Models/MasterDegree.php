<?php

namespace App\Models;

use Quill\Database as Database;

class MasterDegree extends Database {

    protected $tableName = ' master_degree';
    protected $primarykey = 'degree_id';

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
     
    public function getdegrees() {

        $user['modified_at'] = date('Y-m-d H:i:s');

        return $this->table()->select()->all();
    }

      public function getAllFilteredCandidates($degrees){
     
     if(count($degrees['degrees'])==1){
      $query = $this->table()->select($this->tableName . '.Degree, candidate_education.user_id')
                        ->join('candidate_education', 'candidate_education.degree_id', $this->tableName . '.degree_id')
                         ->where(array($this->tableName . '.degree_id' => $degrees['degrees']))
                         ->all();
     }
     else{
     $query = $this->table()->select($this->tableName . '.Degree, candidate_education.user_id')
                        ->join('candidate_education', 'candidate_education.degree_id', $this->tableName . '.degree_id')
                         ->whereIn(array($this->tableName . '.degree_id' => $degrees['degrees']))
                         ->all();
     }
       return $query;
    }
}