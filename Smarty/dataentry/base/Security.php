<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class Security {
	public function __construct() {
		
	}
	
	public static function Logout() {
		$_SESSION['loggedIn'] = 0;
	}
	
	public static function Validate() {
		if($_REQUEST['logout'] == 1) {
			self::Logout();
			return false;
		}
		if($_SESSION['loggedIn'] == 1 && $_SESSION['username'] != "") {
			return true;
		}
		if($_REQUEST['login'] == 1) {
			if(self::LogIn($_REQUEST['username'], $_REQUEST['password'])) {
				return true;
			} 
		}
		
		return false;
	}
	
	public static function LogIn($username, $password) {
		$id = self::CheckPassword($username, $password);
		if($id > 0) {
			$_SESSION['loggedIn'] = 1;
			$_SESSION['username'] = $username;
			$_SESSION['userID'] = $id;
			return true;
		} else {
			return false;
		}
	}
	
	public static function CheckPassword($username, $password) {
		$id = Database::QuickSelect(USERS_TABLE, "id", "username='$username' AND password='".md5($password)."'");
		return $id;
	}
	
}

?>