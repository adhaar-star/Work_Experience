<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
*/


/**
 * Date class for dealing with MySQL Dates
 */

class Date {
	protected $timestamp;
	protected $dateArr;

	
	public function __construct($date = '') {
		if($date != "") {
			$this->ParseDate($date);
		}
	}
	
	public static function GetTimestampFromMySQLDate($mysqlDate) {
		//$dateArr = strptime($date, "%Y-%m-%d %H:%M:%S");
		$explodedDate = explode("-", $mysqlDate);	
		$timestamp = mktime(0, 0, 0, $explodedDate['1'], $explodedDate['2'], $explodedDate['0']);

//		$dateArr = strptime($mysqlDate, "%Y-%m-%d");
//		$timestamp = mktime($dateArr['tm_hour'], $dateArr['tm_min'], $dateArr['tm_sec'], $dateArr['tm_mon']+1, $dateArr['tm_mday'], $dateArr['tm_year']+1900);
	
		return $timestamp;
	}
	/**
	 * Gets the timestamp from mysql date
	 *
	 * @return int timestamp of the date stored
	 */
	protected function ParseDate($date) {
		if(!isset($this->timestamp)) {
			// Default Date -- set to current time
			if(!$date) {
				$date = date(DATE_FORMAT_MYSQL);
			}

			$this->timestamp = self::GetTimestampFromMySQLDate($date);
		}

		return $this->timestamp;
	}

	/**
	 * Returns a form field to select a date for MYSQL dates
	 *
	 * @param string $fieldName The name the date select fields will use
	 * @param string $value MySQL date string - the current value
	 * @return string Form fields that are used to select the date
	 */
	public function GetFormField($fieldName, $value, $onchange='', $date='', $bitmask=0xffff ) {
		$this->ParseDate($value);
		$this->onChange = $onchange;
		
		if($bitmask & DATE_MONTH)
			$formField .= $this->GetMonthField($fieldName);
		if($bitmask & DATE_DAY)
			$formField .= $this->GetDayField($fieldName);
		if($bitmask & DATE_YEAR)
			$formField .= $this->GetYearField($fieldName);
			
		return $formField;
	}

	/**
	 * Returns a mysql string to be stored in the database from the select fields
	 *
	 * @param array $data The array of date data returned from a form that used GetFormField()
	 * @return string MySQL formatted date string
	 */
	public static function SaveFormData($data) {
		$newStamp = mktime(0,0,0,$data['month'], $data['day'], $data['year']);
		$mysqlString = date(DATE_FORMAT_MYSQL, $newStamp);
		return $mysqlString;
	}

	protected function GetYearField($fieldName) {
		return '<input type="text" name="'.$fieldName.'[year]" value="'.date("Y", $this->timestamp).'" size="4" maxlength="4"'.($this->onChange != "" ? 'onchange="'.$this->onChange.'"':"").'>';
	}

	protected function GetMonthField($fieldName) {
		$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

		$monthSel = '<select name="'.$fieldName.'[month]"'.($this->onChange != "" ? 'onchange="'.$this->onChange.'"':"").'>';

		foreach($months as $index => $mon) {
			$sel = ($index+1 == date('n', $this->timestamp)) ? " SELECTED" : "";
			$monthSel .= '\n<option value="'.($index+1).'"'.$sel.'>'.$mon.'</option>';
		}

		$monthSel .= '</select>';
		return $monthSel;
	}

	protected function GetDayField($fieldName) {
		$daySel = '<select name="'.$fieldName.'[day]"'.($this->onChange != "" ? 'onchange="'.$this->onChange.'"':"").'>';

		for($i=1; $i <= 31; $i++) {
			$sel = ($i == date('j', $this->timestamp)) ? " SELECTED" : "";

			$daySel .= '<option value="'.$i.'"'.$sel.'>'.$i.'</option>\n';
		}

		$daySel .= '</select>';
		return $daySel;
	}

}

?>