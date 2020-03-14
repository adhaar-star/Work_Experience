<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class SiteEdit2{
	private $sitedata;
	private $errors;
	
	public function __construct() {
		$this->sitedata = array();
	}
	
	private function LoadSiteData($siteID) {
		$this->sitedata = self::FetchSite($siteID);
	}
	
	public static function FetchSite($siteID) {
		$result = Database::Select("sites", "id, refNumber, type, name, address, contact, phone, inactive, openingTime", "id='$siteID'");
		if($result->HasNext()) {
			return $result->GetNext();
		} else {
			return "";
		}
	}
	
	public function ValidateForm($data) {
		if(strlen($data['type']) == 0)
			$this->errors[] = "Please enter a type";
		if(strlen($data['name']) == 0)
			$this->errors[] = "Please enter a site name";
		if(!is_numeric($data['refNumber']))
			$this->errors[] = "Please enter an integer for the reference number. '".$data['refNumber']. "' is an invalid input";
		if(strlen($data['address']) == 0)
			$this->errors[] = "Please enter the address of the site";
		if(strlen($data['contact']) == 0)
			$this->errors[] = "Please enter the contact name for the site";
		if(strlen($data['phone']) == 0)
			$this->errors[] = "Please enter the contact phone for the site";

		// Additional checking for new sites
		if($data['id'] == 0 ) {
			if(Database::EntryExists("`sites`", "type='".$data['type']."' AND refNumber=".$data['refNumber']."") ) {
				$this->errors[] = "The site number ".$data['refNumber']." is already in use";
			}
			
		} else {
			$this->LoadSiteData($data['id']);
			// a different ref number was entered
			//print_r($data);
			//print_r($this->sitedata);
			if($data['refNumber'] != $this->sitedata['refNumber'] || $data['type'] != $this->sitedata['type']) {
				if(Database::EntryExists("`sites`", "type='".$data['type']."' AND refNumber='".$data['refNumber']."'") ) {
					$this->errors[] = "The site number ".$data['refNumber']." is already in use";
				}
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
			$updatedTable = new SiteTable();
			$objResponse->addAssign('sitesTable', 'innerHTML', $updatedTable->Display());
			$objResponse->addAssign('siteEditArea', 'style.display', 'none');
			
			$machTable = new MachTable();
			$objResponse->addAssign('machinesTable', 'innerHTML', $machTable->Display(array('id'=>$this->data['id'])));
			$objResponse->addAssign('machListingArea', 'style.display', 'block');
		}
		
		return $objResponse;
	}
	public function GetErrors() {
		return $this->errors;
	}
	
	public function SaveData($data) {
		$this->data = $data;
		
		$values['type'] = $data['type'];-
		$values['refNumber'] = $data['refNumber'];
		$values['name'] = $data['name'];
		$values['address'] = $data['address'];
		$values['contact'] = $data['contact'];
		$values['phone'] = $data['phone'];
		$values['inactive'] = $data['inactive'];
		$values['openingTime'] = $data['openingTime'];
		//echo $values['openingTime'];
		
		if($data['id'] == 0) {
			$this->data['id'] = Database::Insert("sites", $values);
		} else {
			Database::Update("sites", $values, "id='".$data['id']."'");
		}
	}
	
	public function Display($data='') {
		$tpl = new Template('SiteEdit');
		
		if($data != 0)
			$this->LoadSiteData($data['id']);

                       $siteRef = Database::QuickQuery("SELECT refNumber FROM sites order by refNumber desc");
                       $siteCount = $siteRef + 1;
		       if(isset($this->sitedata) && $this->sitedata['id'] != '')
			{

			}
			 else
			{
			 $this->sitedata['refNumber'] = $siteCount;
			}
			
		$siteTypes = array("TVR", "MVN");
		$inactiveOptions = array(0 => "Active", 1 => "Inactive");
		$tpl->Assign('inactiveOpts', $inactiveOptions);
		
		$tpl->Assign('sitedata', $this->sitedata);
		$tpl->Assign('siteTypes', $siteTypes);
		
		return $tpl->GetHtml();
	}
}

?>
