<?php

namespace App\Models;

use Quill\Database as Database;

class MasterExpertise extends Database {

    protected $tableName = ' master_expertise';
    protected $primarykey = 'expertise_id';

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

    public function getexpertises() {

        $user['modified_at'] = date('Y-m-d H:i:s');

        return $this->table()->select()->all();
    }

    public function getAllFilteredCandidates($expertises){
     
     if(count($expertises['expertises'])==1){
       
       $query = $this->table()->select($this->tableName . '.*, Candidates.user_id')
                        ->join('Candidates', 'Candidates.expertise', $this->tableName . '.expertise_id')
                         ->where(array($this->tableName . '.expertise_id' => $expertises['expertises']))
                         ->all();

       }
       else{
       $query = $this->table()->select($this->tableName . '.*, Candidates.user_id')
                        ->join('Candidates', 'Candidates.expertise', $this->tableName . '.expertise_id')
                         ->whereIn(array($this->tableName . '.expertise_id' => $expertises['expertises']))
                         ->all();

       }
       return $query;
    }

}