<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */
class MachEdit {
	private $sitedata;
	private $errors;
	
	public function __construct() {
		$this->sitedata = array();
	}
	
	private function FetchMachine($machID) {
		$result = Database::Select("machines", "id, site, refNumber, name, commissionRate, coinValue, charity, charityRate, installDate, weeksToService, inactive", "id='$machID'");
		if($result->HasNext()) {
			$this->machineData = $result->GetNext();
		}
		
	}
	
	public function ValidateForm($data) {
		if(!isset($data['site']))
			$this->errors[] = "Error, no site specified.  Bad request.";
		if(!is_numeric($data['refNumber']))
			$this->errors[] = "Please enter an integer for the reference number.";
		if(strlen($data['name']) == 0)
			$this->errors[] = "Please enter a name for the machine";
		if(!is_numeric($data['commissionRate']))
			$this->errors[] = "Please enter a percentage for the commission rate.";
		if(!is_numeric($data['coinValue']))
			$this->errors[] = "Coin value not valid. Bad request. Check form source.";
		if($data['charity'] != 0 && !is_numeric($data['charityRate']))
			$this->errors[] = "Please enter a percentage for the charity.";
		if($data['charity'] == 0 && $data['charityRate'] != 0)
			$this->errors[] = "No charity has been selected, but a percentage to be donated was provided.  Either provide a charity or set the percentage to 0.";

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
			$updatedTable = new MachTable();
			$objResponse->addAssign('machinesTable', 'innerHTML', $updatedTable->Display(array('id' => $this->data['site'])));
			$objResponse->addAssign('machEditArea', 'style.display', 'none');
		}
		
		
		
		return $objResponse;
	}
	public function GetErrors() {
		return $this->errors;
	}
	
	public function SaveData($data) {
		$this->data = $data;
		$values['site'] = $data['site'];
		$values['refNumber'] = $data['refNumber'];
		$values['name'] = $data['name'];
		$values['commissionRate'] = $data['commissionRate'];
		$values['coinValue'] = $data['coinValue'];
		$values['charity'] = $data['charity'];
		$values['charityRate'] = $data['charityRate'];
		$values['installDate'] = Date::SaveFormData($data['installDate']);
		$values['weeksToService'] = $data['weeksToService'];
		$values['inactive'] = $data['inactive'];
		
		
		if($data['id'] == 0) {
			Database::Insert("machines", $values);
		} else {
			$result = Database::Update("machines", $values, "id='".$data['id']."'");
		}
	}
	
	public static function GetCharities() {
		$result = Database::Select("charities", "id, name");
		$charityArray = array("0" => "- none -");
		
		while ($result->HasNext()) {
			$data = $result->GetNext();
			$charityArray[$data['id']] = $data['name'];
		}
		
		return $charityArray;
	}
	
	public function Display($data='') {
		$tpl = new Template('MachEdit');
		if($data != 0) 
			$this->FetchMachine($data['id']);

		$coinValues = array("1" => CURRENCY_SYMBOL."1.00", 
						".5" => CURRENCY_SYMBOL."0.50",
						".2" => CURRENCY_SYMBOL."0.20", 
						".1" => CURRENCY_SYMBOL."0.10");
		
		$serviceWeeks = array(1,2,3,4,5,6,7,8);
		$inactiveOptions = array(0 => "Active", 1 => "Inactive");
		$tpl->Assign('inactiveOpts', $inactiveOptions);
		
		$tpl->Assign('machineData', $this->machineData);
		$tpl->Assign('charities', $this->GetCharities());
		$tpl->Assign('coinValues', $coinValues);
		$tpl->Assign('site', $data['site']);
		$tpl->Assign('siteData', SiteEdit::FetchSite($data['site']));
		$tpl->Assign('serviceWeeks', $serviceWeeks);
		
		$dateObj = new Date();
		$installDateField = $dateObj->GetFormField('installDate', $data['installDate']);
		$tpl->Assign('installDateField', $installDateField);
		
		return $tpl->GetHtml();
	}
}

?>
