<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class StaffEdit {
	private $userdata;
	private $errors;
	
	public function __construct() {
		$this->userdata = array();
	}
	
	public function FetchUser($userID) {
		$result = Database::Select("staff", "id, username, fullName, level, email", "id='$userID'");
		if($result->HasNext()) {
			$this->userdata = $result->GetNext();
		}
		
	}
	
	public function ValidateForm($data) {
		if(strlen($data['fullName']) == 0)
			$this->errors[] = "Please enter a name for the staff member";
		if(strlen($data['username']) == 0)
			$this->errors[] = "Please enter a username for the staff member";
                if(strlen($data['email']) == 0)
			$this->errors[] = "Please enter a email address for the staff member";
		if($data['password1'] != $data['password2'])
			$this->errors[] = "The passwords entered do not match";
		
		// Additional checking for new accounts
		if($data['id'] == 0) {
			if(Database::EntryExists("staff", "username", $data['username'])) {
				$this->errors[] = "The username ".$data['username']." already exists";
			}

			if(strlen($data['password1']) < 6) {
				$this->errors[] = "Please enter a password that is at least 6 characters long";
			}
		}
		
		return (sizeof($this->errors) == 0);
	}
	
	/**
	 * Allows this class to add any AJAX responses to the requesting page
	 *
	 * @param xajaxResponse $objResponse
	 * @return xajaxResponse
	 */
	public function GetResponse($objResponse) {
		if(sizeof($this->errors) == 0) {
			$updatedTable = new StaffTable();
			$objResponse->addAssign('staffTable', 'innerHTML', $updatedTable->Display());
			$objResponse->addAssign('userEditArea', 'style.display', 'none');
		}
		
		
		
		return $objResponse;
	}
	public function GetErrors() {
		return $this->errors;
	}
	
	public function SaveData($data) {
		$values['fullName'] = $data['fullName'];
		$values['username'] = $data['username'];
                $values['email'] = $data['email'];
		$values['level'] = $data['level'];
		
		if($data['id'] == 0) {
			$values['password'] = md5($data['password1']);
		
			Database::Insert("staff", $values);
		} else {
			if(strlen($data['password1']) > 0) {
				$values['password'] = md5($data['password1']);
			}
			Database::Update("staff", $values, "id='".$data['id']."'");
		}
	}
	
	public function Display($data='') {
		$tpl = new Template('StaffEdit');
		$this->FetchUser($data['id']);
		$tpl->Assign('userdata', $this->userdata);
		return $tpl->GetHtml();
	}
}

?>
