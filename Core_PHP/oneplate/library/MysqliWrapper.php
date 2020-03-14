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
        $query = 'SELECT * FROM `user_profile` WHERE `user_id` = ' . $_SESSION['id'];
        $result = $this->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }
  public function get_profile_image($id) {
        $query = 'SELECT * FROM `meal_images` WHERE `meal_image_id` = ' .$id;
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
	 public function food_slider_images($id) {
        
		 if($result = $this->query("SELECT `meal_image` FROM `meal_images` WHERE `meal_image_id`=".$id)){
		 while($row = $result->fetch_array(MYSQLI_ASSOC)){							
	 $response = $row['meal_image'];
	 }
		 }
		 if(isset($response)){
		 return $response;
		 }
		 else{
		 return "";
		 }
    }
	 public function get_all_listing_count() {
        $now = time();
        return $this->query('SELECT count(*) as `total` FROM `leftover_meal_listing`')->fetch_assoc()['total'];
    }
    public function get_location_listing_count() {
        $now = time();
        return $this->query('SELECT count(*) as `total` FROM `canada_demographic`')->fetch_assoc()['total'];
    }
	function get_all_city(){
	if($result = $this->query("SELECT name FROM canada_demographic")){
	while($row = $result->fetch_array(MYSQLI_ASSOC)){							
	 $response[] = $row;
	 }
	}
	return $response;
}
	function add_new_volinteer($firstname , $lastname , $email , $address1 , $address2 , $contact , $city , $zipcode ){
	$firstname = $this->real_escape_string($firstname);
	$lastname = $this->real_escape_string($lastname);
	$email = $this->real_escape_string($email);
	$address1 = $this->real_escape_string($address1);
	$address2 = $this->real_escape_string($address2);
	$contact = $this->real_escape_string($contact);
	$city = $this->real_escape_string($city);
	$zipcode = $this->real_escape_string($zipcode);
	$query = "INSERT INTO  volinteer_profile (`first_name`, `last_name`, `address1`, `address2`, `city`, `provenance`, `telephone`, `zipcode`, `email`)
	VALUES ('{$firstname}', '{$lastname}', '{$address1}', '{$address2}', '{$city}', '{$city}', {$contact}, '{$zipcode}', '{$email}')";
		//die($query);
  $result = $this->query($query) ;
		if($result){
	$output = "Resgistered Successfully";
	return $output;
	}else{
		 die('Could not enter data1: ' . $this->error());
		 }

}
	 public function get_user_listing_count() {
        $now = time();
        return $this->query('SELECT count(*) as `total` FROM `user_profile`')->fetch_assoc()['total'];
    }
	function subscribe_email($sub_email){
	$sub_email = $this->real_escape_string($sub_email);
	$query = "SELECT `id`, `email` FROM `email_subscribed` WHERE email = '{$sub_email}'";
		//die($query);
	$result = $this->query($query);
	 if ($result->num_rows > 0) {
			$sub_emailErr = 'Email already exists';
		 return $sub_emailErr ;
	 }
	else{
			$query = "INSERT INTO `email_subscribed` (`email`) VALUES ('{$sub_email}')";
			$result = $this->query($query) or die($this->error);	
					$sub_emailErr = 'Registered Successfully';
		 			return $sub_emailErr ;
			}
	
}

	public function get_search_location_listing_count($search) {
        $now = time();
        return $this->query("SELECT count(*) as `total` FROM `canada_demographic` WHERE name LIKE '%{$search}%' OR provenance LIKE '%{$search}%'")->fetch_assoc()['total'];
    }
	 function all_food_count(){
$result = $this->query('SELECT count(category_id) as `total` FROM `leftover_meal_listing`')->fetch_assoc()['total'];
	
//var_dump('SELECT count(category_id) as `total` FROM `leftover_meal_listing`');

	//die($result);
	return $result;
}
	function user_food_count($id){
$result = $this->query("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE user_id='$id'")->fetch_assoc()['total'];
	
//var_dump('SELECT count(category_id) as `total` FROM `leftover_meal_listing`');

	//die($result);
	return $result;
}
	function all_food( $limit = 2 , $start = 0){
	
	$query = 'SELECT `leftover_meal_listing`.`id` as `meal_id`, `leftover_meal_listing`.`user_id`, `title`, `category_id`,  `description`, `date_created`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, 
	`meal_category`.`name` as `category_name`
	FROM `leftover_meal_listing`, `user_profile`, `meal_category` WHERE leftover_meal_listing.user_id = user_profile.user_id 
	 AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` LIMIT '.$start.', '. $limit;
	//die($query);
	$result = $this->query($query);
	
	
	return $result;	
}
function search_by_category_count($c, $action){
if(isset($action) && $action!=""){
$result = $this->query("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE `title`='$action' AND `category_id`= {$c}")->fetch_assoc()['total'];
	
}else{
$result = $this->query("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE `category_id`= {$c}")->fetch_assoc()['total'];
//die("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE `category_id`= {$c}");
}
	//die('SELECT count(category_id) as `total` FROM `leftover_meal_listing` WHERE `category_id`= $c  AND `user_id` = $q');
	return $result;	
}

function food_user_detail($id){
$query ="SELECT  `leftover_meal_listing`.`id` as `meal_id`,`leftover_meal_listing`.`user_id` as `meal_user_id`, `category_id`, `title`, `description`, `date_created`, `expire_after`, 
CONCAT(`user_profile`.`first_name`, ' ', `user_profile`.`last_name`) as `user_name`, `user_profile`.`telephone` as `phone`,
CONCAT(`user_profile`.`address1`, ',', `user_profile`.`address2`) as `address`,
`meal_category`.`name` as `category_name`, `user`.`username` as `user_email` 
	FROM `leftover_meal_listing`, `user_profile`, `meal_category`,`user` WHERE leftover_meal_listing.user_id = user_profile.user_id 
	 AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND leftover_meal_listing.id = $id AND `leftover_meal_listing`.`user_id` = `user`.`id` ";
	//die($query);
	$result = $this->query($query);
	
	return $result;	 
}
	function user_meal_detail_list( $limit = 5, $offset = 0, $id){
	
$query = 'SELECT `leftover_meal_listing`.`id` as `meal_id`, `leftover_meal_listing`.`user_id`, `category_id`, `title`, `description`, `date_created`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, 
	`meal_category`.`name` as `category_name`
	FROM `leftover_meal_listing`, `user_profile`, `meal_category` WHERE leftover_meal_listing.user_id = user_profile.user_id 
	 AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND leftover_meal_listing.user_id = '.$id.' LIMIT '.$offset.', '. $limit;
//die($query);
	$result = $this->query($query);
	
	return $result;

}
	function user_category_detail_list($limit = 10, $offset = 0, $id, $cat_id){
	
$query = 'SELECT `leftover_meal_listing`.`id` as `meal_id`, `leftover_meal_listing`.`user_id`, `category_id`, `title`, `description`, `date_created`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, 
`meal_category`.`name` as `category_name`
FROM `leftover_meal_listing`, `user_profile`, `meal_category` WHERE leftover_meal_listing.user_id = user_profile.user_id 
 AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND leftover_meal_listing.user_id = '.$id.' 
 AND  leftover_meal_listing.category_id = '.$cat_id.' LIMIT '.$offset.', '. $limit;
//die($query);
	$result = $this->query($query);

return $result;

}
	function search_by_category( $limit = 10, $offset = 0, $cat, $search_q = ''){
	
	$query = 'SELECT `leftover_meal_listing`.`id` as `meal_id`, `leftover_meal_listing`.`user_id`, `title`, `category_id`, `description`, `date_created`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, 
	`meal_category`.`name` as `category_name`
	FROM `leftover_meal_listing`, `user_profile`, `meal_category` WHERE `leftover_meal_listing`.`category_id`= '.$cat.' AND 
	`leftover_meal_listing`.`user_id` = `user_profile`.`user_id` 
	 AND `leftover_meal_listing`.`category_id` = `meal_category`.`id`';
	if(!empty($search_q)) {
		$query .= " AND (";
		$q = explode(' ', $search_q);
		foreach($q as $word) {
			$query .= " `title` LIKE '%".$this->escape_string($word)."%' OR";
		}
		$query = rtrim($query, ' OR') . " )";
	}
	
	$query .= " ORDER BY `leftover_meal_listing`.`expire_hour` ASC LIMIT ".$offset.', '. $limit;
	//die($query);
	$result = $this->query($query);
	
	return $result;	
}

	function search_food_count($q){
$now = time();
$result = $this->query('SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE `title` LIKE "%'.$q.'%" ')->fetch_assoc()['total'];
	//die($result);
	return $result;
	}
	function search_food($limit = 10, $offset = 0, $q ) {
	$q = $this->real_escape_string($q);
	$query = 'SELECT `leftover_meal_listing`.`id` as `meal_id`, `leftover_meal_listing`.`user_id`, `category_id`,  `title`, `description`, `date_created`, 
	CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `meal_category`.`name` as `category_name`
	FROM `leftover_meal_listing`, `user_profile`, `meal_category` WHERE `leftover_meal_listing`.`user_id` = `user_profile`.`user_id`
	AND `leftover_meal_listing`.`category_id` = `meal_category`.`id`';
	if(!empty($q)) {
		$query .= " AND (";
		$q = explode(' ', $q);
		foreach($q as $word) {
			$query .= " `title` LIKE '%".$this->escape_string($word)."%' OR";
		}
		$query = rtrim($query, ' OR') . " )";
	}
	
	$query .= " ORDER BY `leftover_meal_listing`.`expire_hour` ASC LIMIT ".$offset.', '. $limit;
	//die($query);
	$result = $this->query($query);
	return $result;

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
        return $this->query('SELECT count(*) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 1 AND `leftover_meal_listing`.`category_id` = '.$categoryid)->fetch_assoc()['total'];
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
        return $this->query('SELECT count(*) as `total`  FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`category_id` = '.$categoryid)->fetch_assoc()['total'];
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
	
	
		public function get_location_listings($limit = 5, $start = 0) {
			
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
                $response[] = $record;
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
	public function get_expired_listing_count() {
        $now = time();
        return $this->query('SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE `leftover_meal_listing`.`status` = 4 
		AND `leftover_meal_listing`.`expire_after` < ' . $now)->fetch_assoc()['total'];
    }
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
	public function get_expired_listings($limit = 10, $start = 0) {
        $now = time();
	
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`)
		as `user_name`, `canada_demographic`.`id` as `location_id`,
		CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`,
		`meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, 
		`leftover_meal_listing`.`id` as `listing_id`,`leftover_meal_listing`.`title` as `title`,
		`leftover_meal_listing`.`date_created` as `date_created`,`leftover_meal_listing`.`expire_after`, 
		`leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`,
		`canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile`
		WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = `user`.`id` 
		AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` 
		AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` 
		AND `leftover_meal_listing`.`expire_after` < ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC
		LIMIT ' . $start . ', ' . $limit;
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
	
	
    public function get_all_listings($limit = 10, $start = 0) {
        $now = time();
	
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`,`leftover_meal_listing`.`title` as `title`,`leftover_meal_listing`.`date_created` as `date_created`,`leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` '. ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
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
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`
		, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`,
		`meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, 
		`leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`title`,`leftover_meal_listing`.`date_created`,
		`leftover_meal_listing`.`description`, `user_profile`.`telephone`  FROM `user`, 
		`canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 1 
		AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` 
		AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` 
		AND `leftover_meal_listing`.`category_id`='.$categoryid.'  AND `leftover_meal_listing`.`expire_after` > ' . $now . ' 
		ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
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
		 if($categoryid==""){
		 $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`,
		 `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, 
		 `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, 
		 `leftover_meal_listing`.`expire_after`,`leftover_meal_listing`.`title`,`leftover_meal_listing`.`date_created`,
		 `leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`,
		 `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 4 
		 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` 
		 AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` 
		 AND `leftover_meal_listing`.`expire_after` > ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC
		 LIMIT ' . $start . ', ' . $limit;
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
		 else{
		 	if (!ctype_digit($categoryid)) {
    $response="";
}else{
        $query = 'SELECT `user`.`id` as `user_id`, CONCAT(`user_profile`.`first_name`, " ", `user_profile`.`last_name`) as `user_name`, `canada_demographic`.`id` as `location_id`, CONCAT(`canada_demographic`.`name`, " ", `canada_demographic`.`provenance`) as `location`, `meal_category`.`id` as `meal_cat_id`, `meal_category`.`name` as `meal_name`, `leftover_meal_listing`.`id` as `listing_id`, `leftover_meal_listing`.`expire_after`, `leftover_meal_listing`.`title`,`leftover_meal_listing`.`date_created`,`leftover_meal_listing`.`description`, `user_profile`.`telephone` FROM `user`, `canada_demographic`, `meal_category`, `leftover_meal_listing`, `user_profile` WHERE `leftover_meal_listing`.`status` = 4 AND `leftover_meal_listing`.`user_id` = `user`.`id` AND `leftover_meal_listing`.`category_id` = `meal_category`.`id` AND `leftover_meal_listing`.`location_id` = `canada_demographic`.`id` AND `user`.`id` = `user_profile`.`user_id` AND `leftover_meal_listing`.`category_id`='.$categoryid.'  AND `leftover_meal_listing`.`expire_after` < ' . $now . ' ORDER BY `leftover_meal_listing`.`expire_after` ASC LIMIT ' . $start . ', ' . $limit;
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
	public function get_meal_details($mealid){
$query="SELECT * FROM `leftover_meal_listing` WHERE `id`= '$mealid'";
	  $result = $this->query($query);
		$response=array();
	if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
				$response[] = $record;
			}
	
	}
	return $response;
}
	
	public function get_meal_images($mealid){
$query="SELECT * FROM `meal_images` WHERE `meal_image_id`= '$mealid'";
	  $result = $this->query($query);
		$response=array();
	if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC)) {
				$response[] = $record['meal_image'];
			}
	
	}
	return $response;
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
	
		public function get_provenance($location){
	
$query="SELECT * FROM `canada_demographic` WHERE `name`='$location'";
	$result = $this->query($query);
	
	    if(!$result)
{
  die('Could not get data: ' . mysql_error());
}
	else{
            while ($record = $result->fetch_assoc()) {
				$provenance=$record['provenance'];
			}
	}
return $provenance;	
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
function update_user_profile($firstname, $lastname, $address1, $address2, $contact, $city, $zipcode, $userid, $provenance){
$firstname = $this->real_escape_string($firstname);
	$lastname = $this->real_escape_string($lastname);
	$address1 = $this->real_escape_string($address1);
	$address2 = $this->real_escape_string($address2);
	$contact = $this->real_escape_string($contact);
	$zipcode = $this->real_escape_string($zipcode);
	$city = $this->real_escape_string($city);
	$query = "UPDATE `user_profile` SET `first_name`='$firstname',`last_name`='$lastname',`address1`='$address1',
	`address2`='$address2',`city`='$city', `telephone`='$contact', `zipcode`='$zipcode', `provenance`= '$provenance'  WHERE `user_id`= $userid";
	//die($query);
$result = $this->query($query);
if($result)
{
	$output = "Entered data successfully\n";
  return $output;
}
else{
die('Could not enter data1: ' . $this->error());
}
}
 function insert_new_user($firstname, $lastname,$address1, $address2, $contact, $city, $zipcode, $passwd ,$email, $provenance){
	$firstname = $this->real_escape_string($firstname);
	$lastname = $this->real_escape_string($lastname);
	$address1 = $this->real_escape_string($address1);
	$address2 = $this->real_escape_string($address2);
	$contact = $this->real_escape_string($contact);
	$zipcode = $this->real_escape_string($zipcode);
	$city = $this->real_escape_string($city);
	$email = $this->real_escape_string($email);
	$hash=hash('sha256',$passwd);	
$password=hash('whirlpool',$hash);
$query1 ="INSERT INTO user ( username, passwd) VALUES( '{$email}', '{$password}')";
	//die($query1);
if(($result1 = $this->query($query1)) !== false){
	$user_id = $this->insert_id;
	//die(''.$user_id);exit;
	$query2 ="INSERT INTO user_profile(user_id, first_name, last_name, address1, address2, telephone, city, provenance, zipcode)
	VALUES({$user_id},'{$firstname}', '{$lastname}', '{$address1}', '{$address2}', {$contact}, '{$city}','{$provenance}','{$zipcode}')";
	//die($query2);
	$result2 = $this->query($query2);
	if($result2){
	$output = "Resgistered Successfully";
	return $output;
	}else{
		 die('Could not enter data1: ' . $this->error());
		 }
	
}
	
}
function all_fetch_images($q){
$result= $this->query("SELECT meal_id, meal_image FROM meal_images WHERE meal_image_id ={$q}");
	//die("SELECT meal_id, meal_image FROM meal_images WHERE meal_image_id ={$q}");
	while($row = $result->fetch_array(MYSQLI_ASSOC)){							
	 $response[] = $row;
	}
		 if(isset($response)){
		 return $response;
		 }
		 else{
		 return "null";
		 }

}
function user_category_count($q,$c){

$result = $this->query("SELECT count(*) as `total` FROM `leftover_meal_listing` WHERE `user_id` = {$q} AND `category_id`={$c} ")->fetch_assoc()['total'];
//die($result);
return $result;
}	
}
?>