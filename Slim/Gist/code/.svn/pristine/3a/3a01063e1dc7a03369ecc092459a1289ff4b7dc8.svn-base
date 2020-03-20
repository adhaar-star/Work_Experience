<?php

namespace App\Models;

use Quill\Database as Database;

class MasterLocations extends Database {

    protected $tableName = ' master_locations';
    protected $primarykey = 'location_id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');

        if (!empty($user['location_id'])) {
            return $this->table()->where(array('user_id' => $user['user_id']))->update($user, true);
        } else {

            $user['created_at'] = date('Y-m-d H:i:s');
            return $this->table()->insert($user, true);
        }
    }
    public function getlocations($user_id = '') {

        $user['modified_at'] = date('Y-m-d H:i:s');

        
       return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin'))
                        ->orWhere(array('Users.Role' => 'candidate','master_locations.user_id'=>$user_id))
                        ->all();
    }
     public function getdefaultlocations($user_id = '') {

        $user['modified_at'] = date('Y-m-d H:i:s');

        
       return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin'))               
                        ->all();
    }

    public function getOthers() {


        
       return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin',$this->tableName . '.location' => 'Others'))               
                        ->one();
    }

    public function getAllFilteredCandidates($locations){
     if($locations['other_location']=="yes"){

      if(count($locations['locations'])==1){
       $query = $this->table()->select($this->tableName . '.location, candidate_location.user_id, Users.Role')
                        ->join('candidate_location', 'candidate_location.location_id', $this->tableName . '.location_id')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'Candidate'))                      
                         ->all();



      }
      else{
     $query = $this->table()->select($this->tableName . '.location, candidate_location.user_id, Users.Role')
                        ->join('candidate_location', 'candidate_location.location_id', $this->tableName . '.location_id') 
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                         ->whereIn(array($this->tableName . '.location_id' => $locations['locations']))
                        ->orWhere(array('Users.Role' => 'Candidate'))                      
                         ->all();
     }
     }
     else{
     //   print_r($locations['locations']);die;
        if(count($locations['locations'])==1){
          $query = $this->table()->select($this->tableName . '.location, candidate_location.user_id,Users.Role')
                        ->join('candidate_location', 'candidate_location.location_id', $this->tableName . '.location_id')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                         ->where(array($this->tableName . '.location_id' => $locations['locations']))
                         ->where(array('Users.Role' => 'Admin'))
                         ->all();

        }
        else{
     $query = $this->table()->select($this->tableName . '.location, candidate_location.user_id,Users.Role')
                        ->join('candidate_location', 'candidate_location.location_id', $this->tableName . '.location_id')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')
                         ->whereIn(array($this->tableName . '.location_id' => $locations['locations']))
                         ->where(array('Users.Role' => 'Admin'))
                         ->all();
      }
      }
       return $query;
    }
}