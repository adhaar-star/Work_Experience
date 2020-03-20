<?php

namespace App\Models;

use Quill\Database as Database;

class CandidateLocation extends Database {

    protected $tableName = 'candidate_location';
    protected $primarykey = 'candidate_location_id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');
         
        if (!empty($user['candidate_location_id'])) {
            return $this->table()->where(array('user_id' => $user['user_id']))->update($user, true);
        } else {

            $user['created_at'] = date('Y-m-d H:i:s');
            foreach($user['candidatelocation'] as $key => $value){
            $newuser = array();
            $newuser['user_id'] = $user['user_id'];
            $newuser['location_id'] = $value;        
            $newuser['modified_at']   = $user['modified_at']; 
            $newuser['created_at']   = $user['created_at'];     
            $this->table()->insert($newuser, true);
        }
        return true;
        }
    }

     public function getLocationDetailById($user_id) {
        $locations = array();
        $query = $this->table()->select($this->tableName . '.*, master_locations.*')
                        ->join('master_locations', 'master_locations.location_id', $this->tableName . '.location_id')
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->all();
          foreach($query as $key=>$value){
            array_push($locations,$value['location']);
          }
          return $locations;
   // return $this->table()->select()->where(array('user_id' => $user_id))->all();
    }

    

    public function deleteLocationsById($user_id) {
    return $this->table()->where(array('user_id'=>$user_id))->delete();
    }  
}