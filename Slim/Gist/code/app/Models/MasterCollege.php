<?php

namespace App\Models;

use Quill\Database as Database;

class MasterCollege extends Database {

    protected $tableName = ' master_college';
    protected $primarykey = 'college_id';

    /*
     *  Save user detail
     */

        public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');

        if (!empty($user['study_field_id'])) {
            return $this->table()->where(array('user_id' => $user['user_id']))->update($user, true);
        } else {

            $user['created_at'] = date('Y-m-d H:i:s');
           // print_r($user['study_field']);die;
            if(is_array($user['college'])){
                $finalcolleges = array();
                $colleges = array_unique($user['college']);

                foreach($colleges  as $key=>$value){
                $newcollege = array();

          $newcollege['user_id'] = $user['user_id'];
         $newcollege['college'] = $value;  
  $checkdefaultcollege = $this->checkdefaultcollege($newcollege);
  //print_r($checkdefaultstudyfield);die;
  $checkcollege = $this->checkcollege($newcollege);

         if($checkdefaultcollege !=""){
    array_push($finalcolleges,$checkdefaultcollege['college_id']);
         }
         else if($checkcollege !="")
         {
            array_push($finalcolleges,$checkcollege ['college_id']);
         }
         else{

        $query = $this->table()->insert($newcollege, true);
            array_push($finalcolleges,$query['college_id']);
     }
                }
                return $finalcolleges;
            }
            else{
                $finalcolleges = array();
                $checkdefaultcollege = $this->checkdefaultcollege($user);
  //print_r($checkdefaultstudyfield);die;
  $checkcollege = $this->checkcollege($user);
                  if($checkdefaultcollege !=""){
    array_push($finalscolleges,$checkdefaultcollege['college_id']);
         }
         else if($checkcollege!="")
         {
            array_push($finalcolleges,$checkcollege ['college_id']);
         }
         else{
        
        $query = $this->table()->insert($user, true);
            array_push($finalcolleges,$query['college_id']);
     }
            return $finalcolleges; 
        }
        }
        }
    

    public function getcolleges($user_id = '') {

        $user['modified_at'] = date('Y-m-d H:i:s');

       return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin'))
                        ->orWhere(array('Users.Role' => 'candidate'))
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->all();
    }

     public function getdefaultcolleges($user_id = '') {

        $user['modified_at'] = date('Y-m-d H:i:s');

       return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin'))
                        ->all();
    }
     
     public function getOthers() {

        $user['modified_at'] = date('Y-m-d H:i:s');

       return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin',$this->tableName . '.college'=>'Others'))
                        ->one();
    }
     
    public function checkcollege($college) {

        $user['modified_at'] = date('Y-m-d H:i:s');

        return $this->table()->select()->where(array('user_id' => $college['user_id'],'college'=>$college['college']))->one();

    }
    public function checkother($collegeid) {

        $user['modified_at'] = date('Y-m-d H:i:s');

        return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin','master_college.college_id'=>$collegeid))
                        ->one();

    }
    public function checkdefaultcollege($college){

        return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin','master_college.college_id' => $college['college']))
                        ->one();
    }
    
    public function getAllFilteredCandidates($colleges){
     if($colleges['other_college']=="yes"){
     // print_r($colleges['colleges']);die;
        if(count($colleges['colleges'])==1){
            $query = $this->table()->select($this->tableName . '.college, candidate_education.user_id,Users.Role')
                        ->join('candidate_education', 'candidate_education.college_id', $this->tableName . '.college_id')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')       
                         ->where(array('Users.Role' => 'Candidate'))
                         ->all();

        }
        else{

             $query = $this->table()->select($this->tableName . '.college, candidate_education.user_id,Users.Role')
                        ->join('candidate_education', 'candidate_education.college_id', $this->tableName . '.college_id')
                         ->join('Users', 'Users.user_id', $this->tableName . '.user_id')       
                         ->whereIn(array($this->tableName . '.college_id' => $colleges['colleges']))
                         ->orWhere(array('Users.Role' => 'Candidate'))
                         ->all();
        }
    }

     else{
          if(count($colleges['colleges'])==1){
          $query = $this->table()->select($this->tableName . '.college, candidate_education.user_id,Users.Role')
                        ->join('candidate_education', 'candidate_education.college_id', $this->tableName . '.college_id')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id') 
                         ->where(array($this->tableName . '.college_id' => $colleges['colleges']))
                         ->where(array('Users.Role' => 'Admin'))
                         ->all();

          }
          else{
     $query = $this->table()->select($this->tableName . '.college, candidate_education.user_id,Users.Role')
                        ->join('candidate_education', 'candidate_education.college_id', $this->tableName . '.college_id')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id') 
                         ->whereIn(array($this->tableName . '.college_id' => $colleges['colleges']))
                         ->where(array('Users.Role' => 'Admin'))
                         ->all();
       }
       }
       return $query;
    }

}