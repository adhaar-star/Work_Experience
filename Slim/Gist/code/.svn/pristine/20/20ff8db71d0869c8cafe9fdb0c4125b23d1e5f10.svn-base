<?php

namespace App\Models;

use Quill\Database as Database;

class CandidateExperience extends Database {

    protected $tableName = 'candidate_experience';
    protected $primarykey = 'candidate_experience_id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');
         
        if (!empty($user['candidate_experience_id'])) {
            return $this->table()->where(array('user_id' => $user['user_id']))->update($user, true);
        } else {

            $user['created_at'] = date('Y-m-d H:i:s');
            return $this->table()->insert($user, true);
        }
    }
}