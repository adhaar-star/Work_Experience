<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.2
 * @filesource
 */

class Sites {
	public function __construct() {
		
	}
	
	public static function Display($query = "") {
		$tmpl = new Template("NewSubmenu");
		
		if(!isset($query['report'])) {
			$query['report'] = 1;
		}
		
		$tmpl->Assign('report', $query['report']);
		
		if(!isset($query['date']) ) {
			$date = date(DATE_FORMAT_MYSQL);
		} else {
			$date = Date::SaveFormData($query['date']);
		}
		$dateObj = new Date();
		if(isset($query['report'])) {
			$reportDateSelectMask[1] = DATE_YEAR;
			$reportDateSelectMask[2] = DATE_MONTH | DATE_YEAR;
			$reportDateSelectMask[3] = 0;
			$reportDateSelectMask[4] = 0;
			$reportDateSelectMask[5] = DATE_YEAR;
			$tmpl->Assign('dateSelect', $dateObj->GetFormField('date', $date, '', '', $reportDateSelectMask[$query['report']]));
			$inactiveOpts = array("0" => "Active", "1"=> "Inactive");
			$tmpl->Assign('inactiveOpts', $inactiveOpts);
			$weeksToServiceOpts = array(0 => "Now", 1 => "in 1 week", 2=>"in 2 weeks", 3=>"in 3 weeks", 4=>"in 4 weeks", 5=>"in 5 weeks", 6=>"in 6 weeks", 7=>"in 7 weeks", 8=>"in 8 weeks");
			$tmpl->Assign('weeksToServiceOpts', $weeksToServiceOpts);
		}
		return $tmpl->GetHtml();
	}
	
	public function ValidateForm($data) {
		return true;
	}
	
	public function SaveData($data) {
		$this->formData = $data;
		if(!isset($data['report'])) {
			$this->formData['report'] = 1;
		}
	}
	
	public function GetResponse($objResponse) {
		$objResponse->addAssign('siteArea', 'innerHTML', $this->{'NewSubmenu'.$this->formData['report']}());
		return $objResponse;
	}
	
	public static function GetMenu() {
		$menu = new Menu("reportsMenu");
		$menu->AddItem("Total Takings", "Reports", array("report" => 1));
		$menu->AddItem("Site Takings", "Reports", array("report"=> 2));
		$menu->AddItem("Service", "Reports", array("report"=> 3));
		$menu->AddItem("Site Listing", "Reports", array("report"=> 4));
		$menu->AddItem("Charity Report", "Reports", array("report"=> 5));
		
		return $menu;
	}
	
	}
	
	private function GetPeriodTakingsAndCalculations($startStamp, $endStamp, $siteType ="", $siteNumber=0) {
		$rowData = array();
		
//		$result = Database::Select("takings as t, machines as m, sites as s", "amountCollected, commissionRate, charity, charityRate, m.coinValue", "t.machine=m.id AND m.site=s.id".($siteType != "" ? " AND s.type='".$siteType."'" : "").($siteNumber != 0 ? " AND s.refNumber=".$siteNumber."" : "")." AND m.inactive=0 AND s.inactive=0 AND date BETWEEN CAST('".date(DATE_FORMAT_MYSQL, $startStamp)."' AS DATE) AND CAST('".date(DATE_FORMAT_MYSQL, $endStamp)."' AS DATE)" );
		$result = Database::Select("takings as t, machines as m, sites as s", "amountCollected, commissionRate, charity, charityRate, m.coinValue", "t.machine=m.id AND m.site=s.id".($siteType != "" ? " AND s.type='".$siteType."'" : "").($siteNumber != 0 ? " AND s.refNumber=".$siteNumber."" : "")." AND date BETWEEN CAST('".date(DATE_FORMAT_MYSQL, $startStamp)."' AS DATE) AND CAST('".date(DATE_FORMAT_MYSQL, $endStamp)."' AS DATE)" );
		
		while($result->HasNext()) {
			$takingData = $result->GetNext();
			$rowData['amountCollected'] += $takingData['amountCollected'];
			$rowData['commissions'] += self::CalculateCommissions($takingData['amountCollected'], $takingData['commissionRate'], $takingData['coinValue']);
			$rowData['charity'] += $takingData['amountCollected'] * $takingData['charityRate'] / 100;
		}
		
		return $rowData;
	}
	
	private function GetPeriodCharityCalculations($startStamp, $endStamp, $siteType ="", $siteNumber=0) {
		$rowData = array();
		
//		$result = Database::Select("takings as t, machines as m, sites as s, charities as c", "amountCollected, commissionRate, charity, charityRate, m.coinValue, c.name", "t.machine=m.id AND m.site=s.id".($siteType != "" ? " AND s.type='".$siteType."'" : "").($siteNumber != 0 ? " AND s.refNumber=".$siteNumber."" : "")." AND m.inactive=0 AND s.inactive=0 AND date BETWEEN CAST('".date(DATE_FORMAT_MYSQL, $startStamp)."' AS DATE) AND CAST('".date(DATE_FORMAT_MYSQL, $endStamp)."' AS DATE) AND c.id=m.charity" );
		$result = Database::Select("takings as t, machines as m, sites as s, charities as c", "amountCollected, commissionRate, charity, charityRate, m.coinValue, c.name", "t.machine=m.id AND m.site=s.id".($siteType != "" ? " AND s.type='".$siteType."'" : "").($siteNumber != 0 ? " AND s.refNumber=".$siteNumber."" : "")." AND date BETWEEN CAST('".date(DATE_FORMAT_MYSQL, $startStamp)."' AS DATE) AND CAST('".date(DATE_FORMAT_MYSQL, $endStamp)."' AS DATE) AND c.id=m.charity" );
		
		while($result->HasNext()) {
			$takingData = $result->GetNext();
			$rowData['amountCollected'] += $takingData['amountCollected'];
			
			$rowData['charity'] += $takingData['amountCollected'] * $takingData['charityRate'] / 100;
			$rowData['charityData'][$takingData['name']] += $takingData['amountCollected'] * $takingData['charityRate'] / 100;
		}
		
		$rowData['sql'] = $result->GetSQL();
		
		return $rowData;
		
	}
	
	public function Report2() {
//die();
		$year = $this->formData['date']['year'];
		$month = $this->formData['date']['month'];
		$siteType = $this->formData['siteType'];
		$inactive = $this->formData['inactive'];
		$startStamp = mktime(0,0,0,$month,1,$year);
		$nextYear = $year;
		$nextMonth = $month + 1;
		if($nextMonth > 12) {
			$nextMonth = 1;
			$nextYear++;
		}
		$endStamp = mktime(0,0,0,$nextMonth,1,$nextYear);
		
		$lastYearStartStamp = mktime(0,0,0,$month,1,$year-1);
		$lastYearEndStamp = mktime(0,0,0,$nextMonth,1,$nextYear-1);
		
		//$out .= "Start: ".date(DATE_FORMAT_LONG, $startStamp)." End: ".date(DATE_FORMAT_LONG, $endStamp);
		
//		$result = Database::Select("sites", "type, refNumber, name", "inactive=0".($siteType != "" ? " AND type='".$siteType."'" : ""), "type, refNumber");
$result = Database::Select("sites", "type, refNumber, name","inactive='$inactive'".($siteType != "" ? " AND type='".$siteType."'" : ""), "type, refNumber");
		//$result = Database::Select("sites", "type, refNumber, name", "inactive=0".($siteType != "" ? "type='".$siteType."'" : "1"), "type, refNumber");
//print_r($result);
		$tableData = array();
		$totals = array();
		while($result->HasNext()) {
			$siteData = $result->GetNext();
			
			$prevYearData = self::GetPeriodTakingsAndCalculations($lastYearStartStamp, $lastYearEndStamp, $siteData['type'], $siteData['refNumber']);
			
			$rowData = self::GetPeriodTakingsAndCalculations($startStamp, $endStamp, $siteData['type'], $siteData['refNumber']);
			$rowData['refNumber'] = $siteData['refNumber'];
			$rowData['siteType'] = $siteData['type'];
			$rowData['name'] = $siteData['name'];
			$rowData['prevYearChange'] = $rowData['amountCollected'] - $prevYearData['amountCollected'];
			
			$totals['amountCollected'] += $rowData['amountCollected'];
			$totals['charity'] += $rowData['charity'];
			$totals['commissions'] += $rowData['commissions'];
			$totals['prevYearChange'] += $rowData['prevYearChange'];
			
			$tableData[] = $rowData;
		}
		
		$tpl = new Template('Report2');
		$tpl->Assign('tableData', $tableData);
		$tpl->Assign('totals', $totals);
		$tpl->Assign('year', $this->formData['date']['year']);
		$tpl->Assign('month', date('F', $startStamp));
		$tpl->Assign('siteType', $siteType);
		$out .= $tpl->GetHtml();

		return $out;
	}
	
	public function Report3() {
		$siteType = $this->formData['siteType'];
		$weeksUntilServiceNeeded = $this->formData['weeksToService'];
		$tableData = array();
		
		$tables[] = "machines as m";
		$tables[] = "takings as t";
		$tables[] = "sites as s";
		$fields = array("m.type", "m.refNumber", "m.weeksToService", "t.date", "t.notes");
		
		$activeMachines = Database::Select("machines as m, sites as s", "s.name, s.address, s.type, s.refNumber as siteNum, m.refNumber as refNumber, m.id as machID, m.name as machineName, m.installDate, m.weeksToService, s.openingTime", "m.inactive=0 AND s.inactive=0 AND m.site=s.id".($siteType != "" ? " AND type='".$siteType."'" : ""), "s.type, s.refNumber, m.refNumber");

		while($activeMachines->HasNext()) {
			$machData = $activeMachines->GetNext();
			
			$result = Database::Select("takings", "date, notes, UNIX_TIMESTAMP(date) as stamp", "machine='".$machData['machID']."'","date DESC", 1, 1);
			
			
			if($result->HasNext()) {
				$rowData = $result->GetNext();	
			} else {
				$rowData['date'] = $machData['installDate'];
			}
			
			$rowData['weeksSinceService'] = (time() - Date::GetTimestampFromMySQLDate($rowData['date']))/(3600*24*7); 
			if($rowData['weeksSinceService'] - $machData['weeksToService'] + $weeksUntilServiceNeeded > 0) {
				$rowData['name'] = $machData['name'];
				$rowData['address'] = $machData['address'];
				$rowData['type'] = $machData['type'];
				$rowData['siteNum'] = $machData['siteNum'];
				$rowData['machNum'] = $machData['refNumber'];
				$rowData['machineName'] = $machData['machineName'];
				$rowData['weeksToService'] = $machData['weeksToService'];
				$rowData['date'] = date(DATE_FORMAT_SHORT, Date::GetTimestampFromMySQLDate($rowData['date']));
				$rowData['openingTime'] = $machData['openingTime'];
				$tableData[] = $rowData;
			}
		}
		//$out .= $activeMachines->GetSQL();
		$tpl = new Template('Report3');
		$tpl->Assign('tableData', $tableData);
		$tpl->Assign('weeksUntilServiceNeeded', $weeksUntilServiceNeeded);
		$tpl->Assign('siteType', $siteType);
		$out .= $tpl->GetHtml();
		
		return $out;
	}
	public function Report4() {
		$siteType = $this->formData['siteType'];
		$inactive = $this->formData['inactive'];
		
		$result = Database::Select("sites", "refNumber, type, name, address, contact, phone", "inactive='$inactive'".($siteType != "" ? " AND type='".$siteType."'" : ""), "type, refNumber");
		$tableData = array();
		while($result->HasNext()) {
			$tableData[] = $result->GetNext();
		}
		
		//print_r($tableData);
		
		$tpl = new Template('Report4');
		$tpl->Assign('tableData', $tableData);
		$tpl->Assign('inactive', $this->formData['inactive']);
		$tpl->Assign('siteType', $siteType);
		$out .= $tpl->GetHtml();
		
		return $out;
	}
	
	public function Report5() {
		$periods = array(1 => 6, 2 => 9, 3 => 12, 4 => 3);
		$year = $this->formData['date']['year'];
		$nextYear = $year;
		$siteType = $this->formData['siteType'];
		
		// Count how many active machines there are
		$machineCount = Database::QuickQuery("SELECT COUNT(*) FROM machines as m, sites as s WHERE m.site=s.id AND s.inactive=0 AND m.inactive=0".($siteType != "" ? " AND s.type='".$siteType."'" : "") );
		
		$totals = array();
		$tableData = array();
		
		// Find previous period start and end months
		$prevPerMonth = $month - 3;
		$prevPerYear = $year;
		if($prevPerMonth < 0)  {
			$prevPerMonth +=12;
			$prevPerYear--;
		}
		//echo "Prev Start: $prevPerYear-$prevPerMonth-01 PrevEnd: $year-$month-01";
		$prevStartStamp =Date::GetTimestampFromMySQLDate("$prevPerYear-$prevPerMonth-01");
		$prevEndStamp = Date::GetTimestampFromMySQLDate("$year-06-01") -10;
		
		foreach($periods as $per => $month) {
			$nextMon = $month + 3;
			if($nextMon > 12) {
				$nextMon -= 12;
				$nextYear++;
			}
			
			
			$startStamp = Date::GetTimestampFromMySQLDate("$year-$month-01");
			$endStamp = Date::GetTimestampFromMySQLDate("$nextYear-$nextMon-01") -10;
			
			$rowData = self::GetPeriodCharityCalculations($startStamp, $endStamp, $siteType);
			$rowData['period'] = $per;
			$rowData['periodText'] = date(DATE_FORMAT_SHORT, $startStamp).' - '.date(DATE_FORMAT_SHORT, $endStamp);
			
			$totals['charity'] += $rowData['charity'];

			
			$tableData[] = $rowData;
			$year = $nextYear;
		}
		//print_r($tableData);
		$tpl = new Template('Report5');
		$tpl->Assign('tableData', $tableData);
		$tpl->Assign('totals', $totals);
		$tpl->Assign('year', $this->formData['date']['year']);
		$tpl->Assign('siteType', $siteType);
		$out .= $tpl->GetHtml();
		
		
		return $out;
	}
	
	public function Spublic function Report1() {

		$periods = array(1 => 6, 2 => 9, 3 => 12, 4 => 3);
		$year = $this->formData['date']['year'];
		$nextYear = $year;
		$siteType = $this->formData['siteType'];
		
		// Count how many active machines there are -- no inactive machines included
		$machineCount = Database::QuickQuery("SELECT COUNT(*) FROM machines as m, sites as s WHERE m.site=s.id AND s.inactive=0 AND m.inactive=0".($siteType != "" ? " AND s.type='".$siteType."'" : "") );
		
		$totals = array();
		$tableData = array();
		
		// Find previous period start and end months
		$prevPerMonth = $month - 3;
		$prevPerYear = $year;
		if($prevPerMonth < 0)  {
			$prevPerMonth +=12;
			$prevPerYear--;
		}
		//echo "Prev Start: $prevPerYear-$prevPerMonth-01 PrevEnd: $year-$month-01";
		$prevStartStamp =Date::GetTimestampFromMySQLDate("$prevPerYear-$prevPerMonth-01");
		$prevEndStamp = Date::GetTimestampFromMySQLDate("$year-06-01") -10;
		$previousPeriod = self::GetPeriodTakingsAndCalculations($prevStartStamp, $prevEndStamp, $siteType);
		
		
		foreach($periods as $per => $month) {
			$nextMon = $month + 3;
			if($nextMon > 12) {
				$nextMon -= 12;
				$nextYear++;
			}
			
			
			$startStamp = Date::GetTimestampFromMySQLDate("$year-$month-01");
			$endStamp = Date::GetTimestampFromMySQLDate("$nextYear-$nextMon-01") -10;
			
			$rowData = self::GetPeriodTakingsAndCalculations($startStamp, $endStamp, $siteType);
			$rowData['period'] = $per;
			$rowData['periodText'] = date(DATE_FORMAT_SHORT, $startStamp).' - '.date(DATE_FORMAT_SHORT, $endStamp);
			$rowData['prevPeriodChange'] = $rowData['amountCollected'] - $previousPeriod['amountCollected'];
			
			$prevYearStartStamp = Date::GetTimestampFromMySQLDate(($year-1)."-$month-01");
			$prevYearEndStamp = Date::GetTimestampFromMySQLDate(($nextYear-1)."-$nextMon-01") -10;
			$prevYearPeriod = self::GetPeriodTakingsAndCalculations($prevYearStartStamp, $prevYearEndStamp, $siteType);
			
			$rowData['prevYearChange'] = $rowData['amountCollected'] - $prevYearPeriod['amountCollected'];
			
			$totals['amountCollected'] += $rowData['amountCollected'];
			$totals['commissions'] += $rowData['commissions'];
			$totals['charity'] += $rowData['charity'];
			$totals['prevPeriodChange'] += $rowData['prevPeriodChange'];
			$totals['prevYearChange'] += $rowData['prevYearChange'];
			
			if($machineCount > 0) {
				$rowData['avgMonthTakings'] = ($rowData['amountCollected'] / $machineCount) / 3;
				$totals['avgMonthTakings'] += $rowData['avgMonthTakings'];
			}
			
			$tableData[] = $rowData;
			$year = $nextYear;
			$previousPeriod = $rowData;
		}
		//print_r($tableData);
		$tpl = new Template('Report1');
		$tpl->Assign('tableData', $tableData);
		$tpl->Assign('totals', $totals);
		$tpl->Assign('year', $this->formData['date']['year']);
		$tpl->Assign('siteType', $siteType);
		$out .= $tpl->GetHtml();
		
		return $out;
	ummary() {
		
		$totals = array();
		// Total number of sites
		$totals['activeTVRsites'] = Database::QuickSelect("sites", "COUNT(*)", "inactive=0 AND type='TVR'" );
		$totals['activeMVNsites'] = Database::QuickSelect("sites", "COUNT(*)", "inactive=0 AND type='MVN'" );
		$totals['activeSites'] = Database::QuickSelect("sites", "COUNT(*)", "inactive=0" );
		
		// Total number of machines
		$totals['activeTVRmachines'] = Database::QuickSelect("machines as m, sites as s", "COUNT(*)", "m.site = s.id AND m.inactive=0 AND s.inactive=0 AND s.type='TVR'" );
		$totals['activeMVNmachines'] = Database::QuickSelect("machines as m, sites as s", "COUNT(*)", "m.site = s.id AND m.inactive=0 AND s.inactive=0 AND s.type='MVN'" );
		$totals['activeMachines'] = Database::QuickSelect("machines as m, sites as s", "COUNT(*)", "m.site = s.id AND m.inactive=0 AND s.inactive=0" );

		// Total number of TVR
		$totals['totalTVR'] = $totals['activeTVRsites'] + $totals['activeTVRmachines'];


		// Total number of MVR
		$totals['totalMVR'] = $totals['activeMVNsites'] + $totals['activeMVNmachines'];
		$tpl = new Template('Summary');
		
		
		$tpl->Assign('totals', $totals);
		$out .= $tpl->GetHtml();
		
		
		return $out;
	}
	
	public static function CalculateCommissions($amountCollected, $commissionRate, $roundToCoin=0) {
		$commission = ($amountCollected * $commissionRate) / 100;
		
		if($roundToCoin != 0) {
			//round to the nearest coin
			$dollarPart = intval(floor($commission));
			$centsPart = ($commission - $dollarPart) * 100;
			$centsString = "$centsPart";
			$coinValue = ($roundToCoin * 100);
			$coinString = "$coinValue";
			$changeOverCoinValue = ($centsString % $coinString) / 100;
			
			$oldCommission = $commission;
			
			if($changeOverCoinValue*100 > ($coinString / 2) ){
				$commission += $roundToCoin;
			}
			
			$commission -= $changeOverCoinValue;
			//$commission = $commission."($oldCommission $changeOverCoinValue .$coinValue)";
		}
		
		return $commission;
	}
	
	public static function FormatNumber($number) {
		return number_format($number, 2, '.', ',');
		//return $number;
	}
}

?>
