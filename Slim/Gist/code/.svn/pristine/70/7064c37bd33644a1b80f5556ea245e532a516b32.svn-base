<?php

namespace App\Models;

use Quill\Database as Database;

class Admin extends Database {

    protected $tableName = 'admin';
    protected $primarykey = 'admin_id';

    /*
     *  Check login
     */

    public function checkLogin($data) {

        return $this->table()->select()->where(array('username' => $data['email'], 'password' => $data['password']))->one();
    }
    
    /*
     *  Get user detail by username
     */
    public function getUserDetailsByUsername($username) {
        
        return $this->table()->select()->where(array('username' => $username))->one();
    }
}
