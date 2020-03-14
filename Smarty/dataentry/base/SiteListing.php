<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class SiteListing {
	public function __construct() {
		
	}
	
	
	public function Display($data='') {

		$tableObj = new Table('SiteListing', "sites");
		
		$tableObj->AddField("CONCAT(type,refNumber)", "Ref Number");
		$tableObj->AddField("name", "Site Name");
		$tableObj->AddField("address", "Site Address");
		$tableObj->AddField("contact", "Contact");
		$tableObj->AddField("phone", "Phone");

		return $tableObj->Display($data);
	}
}

?>
