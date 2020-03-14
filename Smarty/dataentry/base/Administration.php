<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
*/

class Administration {
	public function __construct() {
		
	}
	
	public static function Display($query = "") {
		if($query['action'] == "charities") {
			$out = self::ManageCharities();
		} else if($query['action'] == "users") {
			$out = self::ManageUsers();
		} 
		else if($query['action'] == "submenu") {
			$out = self::ManageSubmenu();
		}
		else { // manage sites
			$out = self::ManageSites();
		}
		return $out;
	}


	
	private static function ManageSites() {
		$tpl = new Template('AdminSites');
		
		$sitesTableObj = new SiteTable();
		$sitesTable = $sitesTableObj->Display();

		$tpl->Assign('siteListing', $sitesTable);

		return $tpl->GetHtml();
		
	}
	private static function ManageSubmenu() {
$tpl = new Template('NewSubmenu');		
			$sitesTableObj = new SiteTable();
		$sitesTable = $sitesTableObj->Display();

		$tpl->Assign('siteListing2', $sitesTable);

		return $tpl->GetHtml();
		
	}
	
	private static function ManageUsers() {
		$staff = new StaffTable();
		$userlist = $staff->Display();
		
		$editForm = new StaffEdit();
		$userdetails = $editForm->Display();
		
		$tpl = new Template('AdminUsers');
		
		$tpl->Assign('userlist', $userlist);
		$tpl->Assign('userdetails', $userdetails);

		return $tpl->GetHtml();
	}
		private static function ManageCharities() {
		$tpl = new Template('AdminCharities');
		
		$tableObj = new CharityTable();
		$table = $tableObj->Display();

		$editForm = new CharityEdit();
		$details = $editForm->Display();

		$tpl->Assign('charityListing', $table);
		$tpl->Assign('charityDetails', $details);

		return $tpl->GetHtml();
		
	}
	
	public static function GetMenu() {
		$menu = new Menu("adminMenu");
		$menu->AddItem("Manage Sites", "Administration", array("action" => "sites"));
		$menu->AddItem("Manage Users", "Administration", array("action" => "users"));
		$menu->AddItem("Manage Charities", "Administration", array("action" => "charities"));
			$menu->AddItem("New Submenu", "Administration", array("action" => "submenu"));
		return $menu;
	}
	
}

?>
