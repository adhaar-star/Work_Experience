<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class SiteTable {
	public function __construct() {
		
	}
	
	
	public function Display($data='') {

		$tableObj = new Table('SiteTable', "sites");
		$tableObj->AddField("type", "Site Type");
		//$tableObj->AddField("status", "Status", "(CASE WHEN inactive=1 THEN 'Inactive' ELSE 'Active' END) AS status");
		//$tableObj->AddField("refNumber", "Site Number");
		$tableObj->AddField("CONCAT(type,refNumber)", "Ref Number");
		$tableObj->AddField("name", "Site Name");
		$tableObj->AddField("address", "Site Address");
		$tableObj->AddField("contact", "Contact");
		$tableObj->AddField("phone", "Phone");

		$tableObj->SetEditForm('machinesTable', 'MachTable', 'machListingArea');
		return $tableObj->Display($data);
	}
}

?>
