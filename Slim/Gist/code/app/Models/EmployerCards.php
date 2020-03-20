<?php

namespace App\Models;

use Quill\Database as Database;

class EmployerCards extends Database {

    protected $tableName = ' employer_card_details';
    protected $primarykey = 'employer_card_id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');

        if (!empty($user['employer_card_id'])) {
            return $this->table()->where(array('employer_card_id' => $user['employer_card_id']))->update($user, true);
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

   
}