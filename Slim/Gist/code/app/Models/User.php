<?php

namespace App\Models;

use Quill\Database as Database;

class User extends Database {

    protected $tableName = 'Users';
    protected $primarykey = 'user_id';

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

    /*
     *  Validate user 
     */

    public function checkTokenExist($token) {

        return $this->table()->select()->where(array('verify_token' => $token))->one();
    }

    /*
     *  check token exist
     */


    public function deleteUser($user) {

        return $this->table()->where(array('user_id' => $user['user_id']))->delete($user, true);
    }
     

    public function check($user) {
       // echo $user;die;
$query = $this->table()->select()->where(array('Email' => $user))->one();
if($query['Email']!=$user){
echo "true";
        exit;
}else{
  echo "false";
        exit;
}
   // return $this->table()->select->where(array('Email' => $user))->all();
    }
    /*
     *  Validate user 
     */

    public function validateCustomer($user_id) {

        return $this->table()->select()->where(array('user_id' => $user_id, 'status' => 'Active'))->one();
    }

    /*
     *  Check login
     */

    public function checkLogin($data) {

        return $this->table()->select()->where(array('email' => $data['email'], 'password' => $data['password']))->one();
    }

    /*
     * Get user detail
     */

    public function getUserDetailById($user_id) {
        return $this->table()->select($this->tableName . '.*, countries.country_name')
                        ->join('countries', 'countries.country_id', $this->tableName . '.phone_code')
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->one();
    }

    /*
     * Get active user detail
     */

    public function getActiveUser() {
        return $this->table()->select()->where(array('status' => '1', 'is_deleted' => '0'))->where(array('user_id !=' => '1'), true)->all();
    }
    
    public function geUserDetailById($user_id) {
        return $this->table()->select($this->tableName . '.*')
                            ->where(array($this->tableName . '.user_id' => $user_id))
                            ->one();
    }

    /*
     * Get inactive user detail
     */

    public function getInactiveUser() {
        return $this->table()->select()->where(array('status' => '0', 'is_deleted' => '0'))->where(array('user_id !=' => '1'), true)->all();
    }

    /*
     * Check email
     */

    public function checkEmail($email) {
        return $this->table()->select()->where(array('Email' => $email))->one();
    }

    /*
     *  Get user detail by username
     */

    public function getUserDetailsByUsername($username) {

        return $this->table()->select()->where(array('Email' => $username))->one();
    }

    /*
     *  Get user detail by email
     */

    public function getUserDetailsByEmail($email) {

        return $this->table()->select()->where(array('email' => $email))->one();
    }

    /*
     *  Get others user detail
     */

    public function getUsers() {

        return $this->table()->select()->all();
    }

    /*
     *  Get avaialble user detail active/deactive both not deleted
     */

    public function getAvaiableUsers() {

        return $this->table()->select()->where(array('is_deleted' => '0'))->where(array('user_id !=' => '1'), true)->all();
    }

    /*
     *  Get user detail by usertype
     */

    public function getUserDetailsByUsertype($usertype) {

        return $this->table()->select()->where(array('user_type' => $usertype))->one();
    }

    /*
     *  Get user detail by usertype
     */

    public function getUserForDb($aColumns, $sLimit, $sOrder, $sWhere) {

        $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM  users left join countries on users.phone_code = countries.country_id ";
        $sQuery .= $sWhere . " GROUP BY (users.user_id) " . $sOrder . " " . $sLimit;

        return $this->rawQuery($sQuery)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /*
     * Data set length after filtering
     */

    public function getFilterCount() {
        $sQuery = "SELECT FOUND_ROWS() as total";

        return $this->rawQuery($sQuery)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /*
     * Total data set length
     */

    public function getDataSetLenght($sIndexColumn) {
        $sQuery = "SELECT COUNT(" . $sIndexColumn . ") as count FROM users left join countries on users.phone_code = countries.country_id where users.is_deleted = '0' AND users.user_id != '1'";

        return $this->rawQuery($sQuery)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /*
     *  Get user list
     */

    public function getUsersList($excluded_users) {

        $excluded_users = implode(',', $excluded_users);

        $sQuery = "SELECT users.*, countries.country_name FROM users left join countries on users.phone_code = countries.country_id where users.status = '1' and users.is_deleted = '0' and users.user_id NOT IN($excluded_users) ORDER BY users.first_name ASC";

        return $this->rawQuery($sQuery)->fetchAll(\PDO::FETCH_ASSOC);

//        return $this->table()->select()->all();
    }

}
