<?php

namespace App\Models;

use Quill\Database as Database;

class MasterStudyField extends Database {

    protected $tableName = ' master_study_field';
    protected $primarykey = 'study_field_id';

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
            if(is_array($user['study_field'])){
            	$finalstudyfields = array();
            	$studyfields = array_unique($user['study_field']);

            	foreach($studyfields  as $key=>$value){
                $newstudyfield = array();

          $newstudyfield['user_id'] = $user['user_id'];

          $existcheck = $this->checkstudyfield($user['user_id'],$value);
         if($existcheck==""){
         $newstudyfield['study_field'] = $value;        
          $query = $this->table()->insert($newstudyfield, true);
            array_push($finalstudyfields,$query['study_field_id']);
           }
           else{
            array_push($finalstudyfields,$existcheck['study_field_id']);
           }
            	}
            	return $finalstudyfields;
            }
            else{
            	$finalstudyfields = array();
     
  $query = $this->table()->insert($user, true);
            array_push($finalstudyfields,$query['study_field_id']);
            return $finalstudyfields; 
        }
        }
        }
    

    public function getstudyfields($user_id = '') {
   //echo $user_id;die;
        $user['modified_at'] = date('Y-m-d H:i:s');
        $query = $this->table()->select($this->tableName . '.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin'))
                        ->orWhere(array('Users.Role' => 'Candidate'))
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->all();
                        //print_r($query);die;
                        return $query;
       // return $this->table()->select()->where(array('user_id' => 0))->all();
    }

    public function getdefaultstudyfields($user_id = '') {

        $user['modified_at'] = date('Y-m-d H:i:s');
        return $this->table()->select($this->tableName . '.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin'))                      
                        ->all();
       // return $this->table()->select()->where(array('user_id' => 0))->all();
    }

    public function getOthers() {

        $user['modified_at'] = date('Y-m-d H:i:s');
        return $this->table()->select($this->tableName . '.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin',$this->tableName . '.study_field'=>'Others'))                      
                        ->one();
       // return $this->table()->select()->where(array('user_id' => 0))->all();
    }

    public function checkstudyfield($user_id = '',$studyfield = '') {

        $user['modified_at'] = date('Y-m-d H:i:s');

       $query = $this->table()->select($this->tableName . '.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin'))
                        ->orWhere(array('Users.Role' => 'Candidate'))
                        ->where(array($this->tableName . '.user_id' => $user_id))
                        ->where(array($this->tableName . '.study_field' => $studyfield))
                        ->one();
                        //print_r($query);die;
                        return $query;

    }
    public function checkother($studyfieldid) {

        $user['modified_at'] = date('Y-m-d H:i:s');

        return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin','master_study_field.study_field_id'=>$studyfieldid))
                        ->one();

    }
    public function checkdefaultstudyfield($studyfield){

    	return $this->table()->select($this->tableName . '.*, Users.*')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                        ->where(array('Users.Role' => 'admin','master_study_field.study_field'=>$studyfield['study_field']))
                        ->one();
    }

     public function getAllFilteredCandidates($study_fields){
     if($study_fields['other_study_field']=="yes"){

        if(count($study_fields['study_fields'])==1){
         $query = $this->table()->select($this->tableName . '.study_field, candidate_education.user_id,Users.Role')
                        ->join('candidate_education', 'candidate_education.study_field_id', $this->tableName . '.study_field_id')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id')                
                         ->where(array('Users.Role' => 'Candidate'))
                         ->all();

        }
        else{
     $query = $this->table()->select($this->tableName . '.study_field, candidate_education.user_id,Users.Role')
                        ->join('candidate_education', 'candidate_education.study_field_id', $this->tableName . '.study_field_id')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id') 
                         ->whereIn(array($this->tableName . '.study_field_id' => $study_fields['study_fields']))
                         ->orWhere(array('Users.Role' => 'Candidate'))
                         ->all();
           }
     }
     else{
        if(count($study_fields['study_fields'])==1){
        $query = $this->table()->select($this->tableName . '.*, candidate_education.*,Users.Role')
                        ->join('candidate_education', 'candidate_education.study_field_id', $this->tableName . '.study_field_id')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id') 
                         ->where(array($this->tableName . '.study_field_id' => $study_fields['study_fields']))
                         ->where(array('Users.Role' => 'Admin'))
                         ->all();
        }
        else{
     $query = $this->table()->select($this->tableName . '.*, candidate_education.*,Users.Role')
                        ->join('candidate_education', 'candidate_education.study_field_id', $this->tableName . '.study_field_id')
                        ->join('Users', 'Users.user_id', $this->tableName . '.user_id') 
                         ->whereIn(array($this->tableName . '.study_field_id' => $study_fields['study_fields']))
                         ->where(array('Users.Role' => 'Admin'))
                         ->all();
       }
       }
       return $query;
    }

}