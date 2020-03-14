<?php

/**
 * MySQLI wrapper to add our own methids for accessing database
 */
class MysqliWrapper extends MySQLI {

    public $user_id = '';
    public $username = '';
    public $passwd = '';

    function __construct($DB_HOST, $DB_USER, $DB_PASS, $DB_DATABASE) {
        parent::__construct($DB_HOST, $DB_USER, $DB_PASS, $DB_DATABASE);
    }

    public function get_global_settings() {
        $query = 'SELECT * FROM `settings`';
        $result = $this->query($query);
        $response = array();
        while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
            $response[$record['name']] = $record['value'];
        }
        return $response;
    }

    /**
     * Validate User
     *
     * @param	string
     * @return	bool
     */
    public function is_valid_user($username = '') {
        $query = "SELECT `id`, `username`, `passwd` FROM `user` WHERE `username` = ?";
        /* create a prepared statement */
        if ($stmt = $this->prepare($query)) {
            /* bind parameters for markers */
            $stmt->bind_param('s', $username);
            /* execute query */
            $stmt->execute();
            /* store result to get num_rows  */
            $stmt->store_result();
            /* bind result variables */
            $stmt->bind_result($this->user_id, $this->username, $this->passwd);
            /* fetch value */
            $stmt->fetch();
            if ($stmt->num_rows == 1) {
                /* close statement */
                $stmt->close();
                return true;
            } else {
                /* close statement */
                $stmt->close();
                return false;
            }
        }
        return false;
    }

    /**
     * 
     * @param string $passwd - input from user
     * @return bool
     */
    public function is_valid_password($passwd) {
        return (bool) ($this->passwd == hash('whirlpool', hash('sha256', $passwd, false), false));
    }

    public function get_user_profile() {
        $query = 'SELECT * FROM `user_profile` WHERE `user_id` = ' . $this->user_id;
        $result = $this->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }

    /**
     * 
     * @param unix-timestamp $expire_time expiry time of meal
     * @return calculated remaining time string
     */
    public function get_remaining_time($expire_time) {
        $expire = (new DateTime())->setTimestamp($expire_time);
        $now = new DateTime('now');
        $remain = $expire->diff($now, $abs = TRUE);
        $response = '';
        $day = $hour = $minute = false;
        if ($remain->d > 0) {
            $response .= $remain->format('%d Days, ');
            $day = true;
        }
        if ($remain->h > 0 || $day) {
            $response .= $remain->format('%H Hours, ');
            $hour = true;
        }
        if ($remain->i > 0 || $day || $hour) {
            $response .= $remain->format('%I Minutes, ');
            $minute = true;
        }
        if ($remain->s > 0 || $day || $hour || $minute) {
            $response .= $remain->format('%S Seconds');
        }
        return $response;
    }

    /**
     * 
     * @return int active listing count
     */
	 public function get_active_listing_count() {
        $now = time();
        return $this->query('SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`expire_after` > ' . $now)->fetch_assoc()['total'];
    }
	
    public function get_location_listing_count() {
        $now = time();
        return $this->query('SELECT count(*) as `total` FROM `canada_demographic`')->fetch_assoc()['total'];
    }
	
	 public function get_user_listing_count() {
        $now = time();
        return $this->query('SELECT count(*) as `total` FROM `user_profile`')->fetch_assoc()['total'];
    }
	
	public function get_search_location_listing_count($search) {
        $now = time();
        return $this->query("SELECT count(*) as `total` FROM `canada_demographic` WHERE name LIKE '%{$search}%' OR provenance LIKE '%{$search}%'")->fetch_assoc()['total'];
    }
	 
	public function get_category_search_expired_listing_count($categoryid,$search) {
        $now = time();
		
		 $query = "SELECT * FROM `canada_demographic` WHERE `name` LIKE '%{$search}%'";
        $result = $this->query($query);
		
	$response=array();
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($response,$record['id']);
				
			}
		 }
			 
					


					 if(count($response)>0){
						 $ids = join("','",$response);  
        return $this->query("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE location_id IN ('$ids') AND status=4")->fetch_assoc()['total'];
					 }
		else{
			
			
			 $query = "SELECT * FROM `user_profile` WHERE `first_name` LIKE '%{$search}%' OR  `last_name` LIKE '%{$search}%'";
        $result = $this->query($query);
		
	$response=array();
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($response,$record['user_id']);
				
			}
		 }
			
		 if(count($response)>0){
						 $ids = join("','",$response);  
        return $this->query("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE user_id IN ('$ids') AND status=4")->fetch_assoc()['total'];
			 
			 return $response;
					 }
			else{
			return 0;
			}
		}
		
		
    }
	
	public function get_category_search_active_listing_count($categoryid,$search) {
        $now = time();
		
		 $query = "SELECT * FROM `canada_demographic` WHERE `name` LIKE '%{$search}%'";
        $result = $this->query($query);
		
	$response=array();
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($response,$record['id']);
				
			}
		 }
			 
					


					 if(count($response)>0){
						 $ids = join("','",$response);  
        return $this->query("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE location_id IN ('$ids') AND status=1")->fetch_assoc()['total'];
					 }
		else{
			
			
			 $query = "SELECT * FROM `user_profile` WHERE `first_name` LIKE '%{$search}%' OR  `last_name` LIKE '%{$search}%'";
        $result2 = $this->query($query);
		
	$response2=array();
		 if ($result2->num_rows > 0) {
            while ($record2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                array_push($response2,$record2['user_id']);
				
			}
		 }
			
		 if(count($response2)>0){
						 $ids2 = join("','",$response2);  
        return $this->query("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE user_id IN ('$ids2') AND status=1")->fetch_assoc()['total'];
			 
			 return $response2;
					 }
			else{
			return 0;
			}
		}
		
		
    }
	
	
	
public function get_search_active_listing_count($search) {
        $now = time();
	
	 $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND (`meal_category`.`name` LIKE '.'%'.$search.'%'.'OR CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) LIKE '.'%'.$search.'%'.'OR CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name` LIKE '.'%'.$search.'%) AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after`';
	
	  $result = $this->query($query);
        if(!$result)
{
  die('Could not get data: ' . mysql_error());
}
	
        $count=$result;
	return $result;
      
    }
	
public function get_category_active_listing_count($categoryid) {
        $now = time();
	if (!ctype_digit($categoryid)) {
    return 0;
}
	else{
        return $this->query('SELECT count(distinct category_id) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`category_id` = '.$categoryid)->fetch_assoc()['total'];
	}
    }
	
	public function get_search_category_listing_count($categoryid,$search) {
        $now = time();
	if (!ctype_digit($categoryid)) {
    return 0;
}
	else{
	
        return $this->query("SELECT count(distinct category_id) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 1 AND  `leftover_meal_listing`.`category_id` = ".$categoryid)->fetch_assoc()['total'];
	}
    }
	
	public function get_category_expired_listing_count($categoryid) {
        $now = time();
	if (!ctype_digit($categoryid)) {
    return 0;
}
	else{
        return $this->query('SELECT count(distinct category_id) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`category_id` = '.$categoryid)->fetch_assoc()['total'];
	}
    }
	
	
	public function get_location_active_listing_count($locationid) {
        $now = time();
	if (!ctype_digit($locationid)) {
    return 0;
}
else{
        return $this->query('SELECT count(distinct location_id) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`location_id` = '.$locationid)->fetch_assoc()['total'];
}
    }
	
		public function get_expired_location_listing_count($locationid) {
        $now = time();
	if (!ctype_digit($locationid)) {
    return 0;
}
else{
        return $this->query('SELECT count(distinct location_id) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`location_id` ='. $locationid)->fetch_assoc()['total'];
}
    }
	
	
	public function get_meal_provenance_active_listing_provenance($locationid) {
		 $query = 'SELECT * FROM `canada_demographic` WHERE id='.$locationid;
        $result = $this->query($query);
		
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record['provenance'];
				
			}
			 $provenance=$response[0];
		
	return $provenance;
		
		}
		
	
		
		 
	
      
    }
	
	public function get_meal_provenance_expired_listing_provenance($locationid) {
		 $query = 'SELECT * FROM `canada_demographic` WHERE id='.$locationid;
        $result = $this->query($query);
		
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record['provenance'];
				
			}
			 $provenance=$response[0];
		
	return $provenance;
		
		}
		
	
		
		 
	
      
    }
	
	public function get_meal_provenance_active_listing_locations($provenance) {
		   $now = time();
		 $query = "SELECT * FROM `canada_demographic` WHERE provenance='$provenance'";
        $result = $this->query($query);
		
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record['id'];
			}
			 	$ids = join("','",$response);   
	 $sql = "SELECT * FROM `leftover_meal_listing` WHERE location_id IN ('$ids') AND expire_after >$now";
        $result2 = $this->query($sql);
		
		
		
	return  $sql;
		}
		
		
	
	
		
      
    }
	
	public function get_meal_provenance_expired_listing_locations($provenance) {
		   $now = time();
		 $query = "SELECT * FROM `canada_demographic` WHERE provenance='$provenance'";
        $result = $this->query($query);
		
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record['id'];
			}
			 	$ids = join("','",$response);   
	 $sql = "SELECT * FROM `leftover_meal_listing` WHERE location_id IN ('$ids')";
        $result2 = $this->query($sql);
		
		
		
	return  $sql;
		}
		
		
	
	
		
      
    }
	
	
	public function get_user_active_listing_count($userid) {
        $now = time();
		if (!ctype_digit($userid)) {
    return 0;
}
else{
        return $this->query('SELECT count(distinct user_id) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = '.$userid)->fetch_assoc()['total'];
}
    }
	
	public function get_user_expired_listing_count($userid) {
        $now = time();
		if (!ctype_digit($userid)) {
    return 0;
}
else{
        return $this->query('SELECT count(distinct user_id) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = '.$userid)->fetch_assoc()['total'];
}
    }
	
	
		public function get_location_listings($limit = 10, $start = 0) {
			
      $query = 'SELECT *  FROM `canada_demographic` ORDER BY `name` ASC LIMIT ' . $start . ', ' . $limit;
	
	  $result = $this->query($query);
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
			}
		}
			return $response;

    }
	
	public function get_cities(){
			
      $query = 'SELECT *  FROM `canada_demographic` ORDER BY `name` ASC';
	
	  $result = $this->query($query);
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record['name'];
			}
		}
			return $response;

    }
	
	public function get_search_location_listings($limit = 10, $start = 0,$search) {
			
      $query = "SELECT *  FROM `canada_demographic` WHERE `name` LIKE '%{$search}%' OR `provenance` LIKE '%{$search}%' ORDER BY `name` ASC LIMIT " . $start . ', ' . $limit;
	
	  $result = $this->query($query);
        if ($result->num_rows > 0) {
			
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
			}
		}
		else{
		$response=0;
		}
		
		
			return $response;

    }
	
	
	public function get_user_listings($limit = 10, $start = 0) {
			
      $query = 'SELECT *  FROM `user_profile` ORDER BY `first_name` ASC LIMIT ' . $start . ', ' . $limit;
	
	  $result = $this->query($query);
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
			}
		}
			return $response;

    }

	
	
    public function get_listing_warning($expire_time) {
        $expire = (new DateTime())->setTimestamp($expire_time);
        $now = new DateTime('now');
        $remain = $expire->diff($now);
        $response = '';
        if ($remain->d == 0 && $remain->h < 2) {
            $response .= 'class="danger"';
        } elseif ($remain->d == 0 && $remain->h > 1 && $remain->h < 5) {
            $response .= 'class="warning"';
        } elseif ($remain->d == 0) {
            $response .= 'class="info"';
        }
        return $response;
    }

    /**
     * Display on dashboard
     */
    public function get_active_listings($limit = 10, $start = 0) {
        $now = time();
	
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`,`leftover_meal_listing`.`title` as `title`,`leftover_meal_listing`.`date_created` as `date_created`,`leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
		
        return $response;
    
	
	}
	
	
	 public function get_search_active_listings($limit = 10, $start = 0,$search) {
        $now = time();
	
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `meal_category`.`name` LIKE '.'%'.$search.'%'.' AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
		
        return $response;
    
	
	}
	
	
	 public function get_category_active_listings($limit = 10, $start = 0,$categoryid) {
        $now = time();
		 	if (!ctype_digit($categoryid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone`  FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`category_id`='.$categoryid.'  AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
			}
        return $response;
    }

	 public function get_category_expired_listings($limit = 10, $start = 0,$categoryid) {
        $now = time();
		 	if (!ctype_digit($categoryid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`category_id`='.$categoryid.'  AND `leftover_meal_listing`.`expire_after` < ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
			}
        return $response;
    }

	
	
	 public function get_category_search_expired_listings($limit = 10, $start = 0,$categoryid,$search) {
		 
		    $now = time();
		
		 $query3 = "SELECT * FROM `canada_demographic` WHERE `name` LIKE '%{$search}%'";
        $result3 = $this->query($query3);
		
	$response3=array();
		 if ($result3->num_rows > 0) {
            while ($record3 = $result3->fetch_array(MYSQLI_ASSOC)) {
                array_push($response3,$record3['id']);
				
			}
		 }
			 
					


					 if(count($response3)>0){
						 $ids = join("','",$response3);  
						 
		if (!ctype_digit($categoryid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone`  FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`category_id`='.$categoryid.'  AND `leftover_meal_listing`.`location_id` IN '."('$ids')".' AND `leftover_meal_listing`.`expire_after` < ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
			}
        return $response;				 
						 
						 
        
					 }
		else{
			
			
			 $query2 = "SELECT * FROM `user_profile` WHERE `first_name` LIKE '%{$search}%' OR  `last_name` LIKE '%{$search}%'";
        $result2 = $this->query($query2);
		
	$response2=array();
		 if ($result2->num_rows > 0) {
            while ($record2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                array_push($response2,$record2['user_id']);
				
			}
		 }
			
		 if(count($response2)>0){
						 $ids2 = join("','",$response2);  
        
			 
			 	if (!ctype_digit($categoryid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`category_id`='.$categoryid.'  AND `leftover_meal_listing`.`user_id` IN '."('$ids2')".' AND `leftover_meal_listing`.`expire_after` < ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
			}
        return $response;	
			 
			 
					 }
			else{
			return 0;
			}
		}
		 
		 
		 
 
		 	
    }

	 public function get_category_search_active_listings($limit = 10, $start = 0,$categoryid,$search) {
		 
		    $now = time();
		
		 $query3 = "SELECT * FROM `canada_demographic` WHERE `name` LIKE '%{$search}%'";
        $result3 = $this->query($query3);
		
	$response3=array();
		 if ($result3->num_rows > 0) {
            while ($record3 = $result3->fetch_array(MYSQLI_ASSOC)) {
                array_push($response3,$record3['id']);
				
			}
		 }
			 
					


					 if(count($response3)>0){
						 $ids = join("','",$response3);  
						 
		if (!ctype_digit($categoryid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`category_id`='.$categoryid.'  AND `leftover_meal_listing`.`location_id` IN '."('$ids')".' AND `leftover_meal_listing`.`expire_after` >' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
			}
        return $response;				 
						 
						 
        
					 }
		else{
			
			
			 $query2 = "SELECT * FROM `user_profile` WHERE `first_name` LIKE '%{$search}%' OR  `last_name` LIKE '%{$search}%'";
        $result2 = $this->query($query2);
		
	$response2=array();
		 if ($result2->num_rows > 0) {
            while ($record2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                array_push($response2,$record2['user_id']);
				
			}
		 }
			
		 if(count($response2)>0){
						 $ids2 = join("','",$response2);  
        
			 
			 	if (!ctype_digit($categoryid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`category_id`='.$categoryid.'  AND `leftover_meal_listing`.`user_id` IN '."('$ids2')".' AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
			}
        return $response;	
			 
			 
					 }
			else{
			return 0;
			}
		}
		 
		 
		 
 
		 	
    }

	
	
	 public function get_location_active_listings($limit = 10, $start = 0,$locationid) {
		 
        $now = time();
		 	if (!ctype_digit($locationid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone`  FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`location_id`='.$locationid.'  AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
		 
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
		 //print_r($response);die;
			}
        return $response;
    }

	 public function get_location_expired_listings($limit = 10, $start = 0,$locationid) {
		 
        $now = time();
		 	if (!ctype_digit($locationid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone`  FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`location_id`='.$locationid.'  AND `leftover_meal_listing`.`expire_after` < ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
		 
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
		 //print_r($response);die;
			}
        return $response;
    }

	
	 public function get_provenance_location_active_listings($limit = 10, $start = 0,$locationid) {
		 
		 $query = 'SELECT * FROM `canada_demographic` WHERE id='.$locationid;
        $result = $this->query($query);
		
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record['provenance'];
				
			}
			 $provenance=$response[0];
		 
			 
			  $sql = "SELECT * FROM `canada_demographic` WHERE provenance='$provenance'";
        $result2 = $this->query($sql);
		
		 if ($result2->num_rows > 0) {
            while ($record2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                $response2[] = $record2['id'];
			}
			 	$ids = join("','",$response2);   
	
		}
		 
        $now = time();
		
        $query2 = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`location_id` IN '."('$ids')".'  AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result3 = $this->query($query2);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
		 
        if ($result3->num_rows > 0) {
			
            while ($record3 = $result3->fetch_array(MYSQLI_ASSOC)) {
                $response3[] = $record3;
            }
            $response3['calc_at'] = $calc_date.' at '.$calc_time;
        }
			 else{
			 $response3[] ="";
			 }
		 //print_r($response);die;
			
        return $response3;
    }

	 }
	
	
	 public function get_provenance_location_expired_listings($limit = 10, $start = 0,$locationid) {
		 
		 $query = 'SELECT * FROM `canada_demographic` WHERE id='.$locationid;
        $result = $this->query($query);
		
		 if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record['provenance'];
				
			}
			 $provenance=$response[0];
		 
			 
			  $sql = "SELECT * FROM `canada_demographic` WHERE provenance='$provenance'";
        $result2 = $this->query($sql);
		
		 if ($result2->num_rows > 0) {
            while ($record2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                $response2[] = $record2['id'];
			}
			 	$ids = join("','",$response2);   
	
		}
		 
        $now = time();
		
        $query2 = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`location_id` IN '."('$ids')".'  AND `leftover_meal_listing`.`expire_after` < ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result3 = $this->query($query2);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
		 
        if ($result3->num_rows > 0) {
			
            while ($record3 = $result3->fetch_array(MYSQLI_ASSOC)) {
                $response3[] = $record3;
            }
            $response3['calc_at'] = $calc_date.' at '.$calc_time;
        }
			 else{
			 $response3[] ="";
			 }
		 //print_r($response);die;
			
        return $response3;
    }

	 }
	
	public function get_user_expired_listings($limit = 10, $start = 0,$userid) {
        $now = time();
	  $now = time();
		 	if (!ctype_digit($userid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`user_id`='.$userid.'  AND `leftover_meal_listing`.`expire_after` < ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
       
    }
	  return $response;
}

public function get_user_active_listings($limit = 10, $start = 0,$userid) {
        $now = time();
	  $now = time();
		 	if (!ctype_digit($userid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`user_id`='.$userid.'  AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
        $result = $this->query($query);
        $calc_time = date('H:i:s');     //For tooltip
        $calc_date = date('d F, Y');    //For tooltip
        $response = array();
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
                $response[] = $record;
            }
            $response['calc_at'] = $calc_date.' at '.$calc_time;
        }
       
    }
	  return $response;
}
public function get_userid($user){
$query="SELECT * FROM `user` WHERE `username`= '$user'";
	  $result = $this->query($query);
	if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
				$userid=$record['id'];
			}
return $userid;	
	}
	
}
public function get_locationid($location){
	
$query="SELECT * FROM `canada_demographic` WHERE `name`='$location'";
	$result = $this->query($query);
	
	    if(!$result)
{
  die('Could not get data: ' . mysql_error());
}
	else{
            while ($record = $result->fetch_assoc()) {
				$locationid=$record['id'];
			}
	}
return $locationid;	
	}
	
public function get_categoryid($category){
$query="SELECT * FROM `meal_category` WHERE `name`= '$category'";
	  $result = $this->query($query);
	if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
				$categoryid=$record['id'];
			}
return $categoryid;	
	}
	
}
}