<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
*/

class CharityEdit {
	private $charitydata;
	private $errors;
	
	public function __construct() {
		$this->sitedata = array();
	}
	
	private function FetchCharity($charityID) {
		$result = Database::Select("charities", "id, name", "id='$charityID'");
		if($result->HasNext()) {
			$this->charitydata = $result->GetNext();
		}
		
	}
	
	public function ValidateForm($data) {
		if(strlen($data['name']) == 0)
			$this->errors[] = "Please enter a charity name";
		
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
			$updatedTable = new CharityTable();
			$objResponse->addAssign('charitiesTable', 'innerHTML', $updatedTable->Display());
			$objResponse->addAssign('charityEditArea', 'style.display', 'none');
		}
		
		
		
		return $objResponse;
	}
	
	public function GetErrors() {
		return $this->errors;
	}
	
	public function SaveData($data) {
		$values['name'] = $data['name'];
		
		if($data['id'] == 0) {
			Database::Insert("charities", $values);
		} else {
			Database::Update("charities", $values, "id='".$data['id']."'");
		}
	}
	
	public function Display($data='') {
		$tpl = new Template('CharityEdit');
		$this->FetchCharity($data['id']);
		
		$tpl->Assign('charitydata', $this->charitydata);
		
		return $tpl->GetHtml();
	}
}

?>