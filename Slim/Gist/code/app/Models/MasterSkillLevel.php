<?php

namespace App\Models;

use Quill\Database as Database;

class MasterSkillLevel extends Database {

    protected $tableName = ' master_skill_level';
    protected $primarykey = 'master_skill_level_id';

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
     
    public function getmasterskilllevels() {

        $user['modified_at'] = date('Y-m-d H:i:s');

        return $this->table()->select()->all();
    }

     
}