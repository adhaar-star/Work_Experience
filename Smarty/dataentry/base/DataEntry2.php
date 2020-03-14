<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
*/


class DataEntry2 {
	public function __construct() {
		
		
	}
	
	public function ValidateForm($data) {
		$this->data = $data;
		
		if(!Database::EntryExists("sites", "refNumber='".$data['refNumber']."' AND type='".$data['siteType']."'")) {
			$this->errors[] = "The site ".$data['siteType'].$data['refNumber']." does not exist";
		}
		
		return (sizeof($this->errors) == 0);
	}
	
	public function GetErrors() {
		return $this->errors;
	}
	
	public function SaveData($data) {
		
	}
	
	public function GetResponse(xajaxResponse $objResponse) {
		if(sizeof($this->errors) == 0) {
			// Update the page with new machine
				$objResponse->addAssign('siteInfo2','innerHTML','');
						$objResponse->addAssign('machineEntry2', 'innerHTML','');

			$objResponse->addAssign('dataDetailsArea2', 'style.display', 'block');
			$data['id'] = Database::QuickSelect("sites", "id", "refNumber='".$this->data['refNumber']."' AND type='".$this->data['siteType']."'");
			//$objResponse->addAlert($data['id']);
			$objResponse->addAssign('siteInfo2', 'innerHTML', SiteInfo::Display($data));
			$objResponse->addAssign('machineEntry2', 'innerHTML', MachineEntry2::Display($data));
		}
		
		return $objResponse;
	}
	
	public static function Display($query = "") {
		$out = "";
		$siteType = (isset($query['siteType'])) ? $query['siteType'] : "TVR";
		
		$tpl = new Template('DataEntry2');
		$tpl->Assign('siteType', $siteType);
		
		return $tpl->GetHtml();
	}
	
	public static function GetMenu() {
		$menu = new Menu("dataEntryMenu");
		$menu->AddItem("TVR", "DataEntry2", array("siteType" => "TVR") );
		$menu->AddItem("MVN", "DataEntry2", array("siteType" => "MVN") );
		
		return $menu;
	}
	
}

?>