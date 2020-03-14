<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class MachineEntry {
	private static $totals;
	private $machines;
	
	public function ValidateForm($data) {
		
		
		return true;
	}
	
	public function SaveData($data) {
		$this->formData = $data;
		
		$date = Date::SaveFormData($this->formData['date']);
		$this->date = $date;
		$this->machines = self::GetMachines($data['site'], $date);
		
		$this->newDate = true;
		
		if($data['lastDate'] == Date::SaveFormData($data['date'])) {
			$this->newDate = false;
			
			foreach($this->machines as $machine) {
				$id = $machine['id'];
				
				$values['amountCollected'] = $this->formData['amountCollected_'.$id];
				$values['staff'] = $_SESSION['userID'];
				$values['notes'] = $this->formData['notes_'.$id];
				
				if(Database::EntryExists("takings", "machine='$id' AND date='$date'")) {
					Database::Update("takings", $values, "machine='$id' AND date='$date'");
				} else {
					$values['machine'] = $id;
					$values['date'] = $date;
					Database::Insert("takings", $values);
				}
			}
		
			$this->machines = self::GetMachines($data['site'], Date::SaveFormData($this->formData['date']));
		}
	}
	
	public static function ArrayToString($arr) {
		$arrText = "";
		foreach($arr as $key => $value) {
			$arrText .= "$key = $value\n";
		}
		
		return $arrText;
	}
	
	public function GetResponse(xajaxResponse $objResponse) {
		//$objResponse->addAlert(self::ArrayToString($this->formData));
		
		foreach($this->machines as $machine) {
			$id = $machine['id'];
			if($this->newDate) {
				$objResponse->addAssign("amountCollected_$id", 'value', Reports::FormatNumber($machine['amountCollected']));
				$objResponse->addAssign("notes_$id", 'value', $machine['notes']);
				$objResponse->addAssign("lastDate", 'value', $this->date);
			}
			$objResponse->addAssign("commissions_$id", 'innerHTML', Reports::FormatNumber($machine['commissions']));
			$objResponse->addAssign("charity_$id", 'innerHTML', Reports::FormatNumber($machine['charity']));
			//$objResponse->addAlert(self::ArrayToString($machine));
		}
		
		$objResponse->addAssign("amountCollectedTotal", 'innerHTML', Reports::FormatNumber(self::$totals['amountCollected']));
		$objResponse->addAssign("commissionsTotal", 'innerHTML', Reports::FormatNumber(self::$totals['commissions']));
		$objResponse->addAssign("charityTotal", 'innerHTML', Reports::FormatNumber(self::$totals['charity']));
		
		return $objResponse;
	}
	
	public static function GetMachines($siteID, $date=0) {
		$machines = array();
		$result = Database::Select("machines as m, sites as s", "m.id, s.type, m.refNumber, m.name, commissionRate, coinValue, charity, charityRate", "m.site='$siteID' AND s.id=m.site");
		while($result->HasNext()) {
			$machines[] = $result->GetNext();
		}
		
		return self::GetData($machines, $date);
	}
	
	public static function CalcValues(&$machines) {
		self::$totals = array();
		
		foreach($machines as $key => $machine) {
			if($machine['type'] == 'MVN') {
				$machines[$key]['commissions'] = Reports::CalculateCommissions($machine['amountCollected'], $machine['commissionRate'], $machine['coinValue']);
			} else {
				$machines[$key]['commissions'] = Reports::CalculateCommissions($machine['amountCollected'], $machine['commissionRate']);
			}
			//($machine['commissionRate']  * $machine['amountCollected'])/100;
			$machines[$key]['charity'] = ($machine['charityRate']  * $machines[$key]['amountCollected'] )/100;
			
			self::$totals['amountCollected'] += $machines[$key]['amountCollected'];
			self::$totals['commissions'] += $machines[$key]['commissions'];
			self::$totals['charity'] += $machines[$key]['charity'];
		}
		
		return $machines;
	}
	
	public static function GetData($machines, $date=0) {
		if(!$date) {
			$date = date(DATE_FORMAT_MYSQL);
		}
		
		foreach($machines as $key => $machine) {
			$result = Database::Select("takings", "date, amountCollected, notes", "machine='".$machine['id']."' AND date='$date'");
			if($result->HasNext()) {
				$data = $result->GetNext();
				$machines[$key]['amountCollected'] = $data['amountCollected'];
				$machines[$key]['notes'] = $data['notes'];
			} else {
				$machines[$key]['amountCollected'] = '';
			}
			
		}
		
		return self::CalcValues($machines);
	}
	
	public static function Display($data) {
		$machineData = self::GetMachines($data['id']);

		$tpl = new Template("MachineEntry");
		
		$tpl->Assign('siteID', $data['id']);
		$tpl->Assign('machines', $machineData);
		$tpl->Assign('totals', self::$totals);
		
		$date = new Date();
		$tpl->Assign('dateSelect', $date->GetFormField('date', date(DATE_FORMAT_MYSQL), "xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))"));
		$tpl->Assign('date', date(DATE_FORMAT_MYSQL));
		
		return $tpl->GetHtml();
	}
}

?>
