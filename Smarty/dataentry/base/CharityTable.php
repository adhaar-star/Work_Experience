<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
*/

class CharityTable {
	public function __construct() {
		
	}
	
	
	public function Display($data='') {
		$tableObj = new Table('CharityTable', "charities");
		$tableObj->AddField("name", "Charity Name");

		$tableObj->SetEditForm('charityEditForm', 'CharityEdit', 'charityEditArea');
		return $tableObj->Display($data);
	}
}

?>
