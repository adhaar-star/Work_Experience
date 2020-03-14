<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class StaffTable {
	public function __construct() {
		
	}
	
	
	public function Display($data='') {
		$tableObj = new Table('StaffTable', "staff");
		$tableObj->AddField("username", "Username");
		$tableObj->AddField("fullName", "Name");
                $tableObj->AddField("email", "Email");
		$tableObj->AddField("level", "Access Level");
		$tableObj->SetEditForm('userEditForm', 'StaffEdit', 'userEditArea');
		return $tableObj->Display($data);
	}
}

?>
