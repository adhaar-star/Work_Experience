<?php

namespace App\Models;

use Quill\Database as Database;

class VideoStats extends Database {

    protected $tableName = ' video_stats';
    protected $primarykey = 'video_id';

    /*
     *  Save user detail
     */

    public function save($user) {

        $user['modified_at'] = date('Y-m-d H:i:s');
        $checkStat = $this->checkStat($user);
		
		if($checkStat!=""){
		$user['video_id'] = $checkStat['video_id'];
		}
		
        if (!empty($user['video_id'])) {
                    //    print_r($user);die;
            $response = $this->table()->where(array('video_id' => $user['video_id']))->update($user, true);
            return $response;
            //print_r($response);die;
        } else {
            $user['created_at'] = date('Y-m-d H:i:s');
            return $this->table()->insert($user, true);
        
    }
	}
	
	public function checkStat($user){
	
    return $this->table()->select()->where(array('user_id'=>$user['user_id'],'employer_id'=>$user['employer_id']))->one();	
	}

    public function getVideoDetailsById($user_id){
    
    return $this->table()->select()->where(array('user_id'=>$user_id))->all();  
    }
    
     public function getModifiedVideoLatestDetailsById($user_id){

     $first_date = date("Y-m-d h:i:s");

     $last_date = date('Y-m-d h:i:s', strtotime('-7 days', strtotime($first_date)));

    return $this->table()->select()->where(array('user_id'=>$user_id))->andOrWhere(array('is_view'=> 1,'is_save'=>1,'is_share' => 1))->whereBetween(array('modified_at'=>array($last_date,$first_date)))->all();  
    }

     public function getCreatedVideoLatestDetailsById($user_id){

     $first_date = date("Y-m-d h:i:s");

     $last_date = date('Y-m-d h:i:s', strtotime('-7 days', strtotime($first_date)));

    return $this->table()->select()->where(array('user_id'=>$user_id))->andOrWhere(array('is_view'=> 1,'is_save'=>1,'is_share' => 1))->whereBetween(array('created_at'=>array($last_date,$first_date)))->all();  
    }
       
}