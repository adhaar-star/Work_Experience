<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

/**
 * Integer type for storing standard ints
 */

class Time {
	protected $timestamp;
	
	public function __construct($date = '') {
		if($date != "") {
			$this->ParseDate($date);
		}
	}
	
	public static function GetTimestampFromMySQL($mysqlTime) {
		//$dateArr = strptime($date, "%Y-%m-%d %H:%M:%S");
		$timeArr = strptime($mysqlTime, "%H:%M:%S");

		$timestamp = mktime($timeArr['tm_hour'], $timeArr['tm_min'], $timeArr['tm_sec'], 1,1,1969);
	
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

			$this->timestamp = self::GetTimestampFromMySQL($date);
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
	public function GetFormField($fieldName, $value, $onchange='', $date='') {
		$this->ParseDate($value);
		$this->onChange = $onchange;
		
		$formField = $this->GetHourField($fieldName) . ":" . $this->GetMinField($fieldName);
			
		return $formField;
	}

	/**
	 * Returns a mysql string to be stored in the database from the select fields
	 *
	 * @param array $data The array of date data returned from a form that used GetFormField()
	 * @return string MySQL formatted date string
	 */
	public static function SaveFormData($data) {
		$newStamp = mktime($data['hour'],$data['min'],0,1, 1, 1969);
		$mysqlString = date(TIME_FORMAT_MYSQL, $newStamp);
		return $mysqlString;
	}

	protected function GetHourField($fieldName) {
		$daySel = '<select name="'.$fieldName.'[hour]"'.($this->onChange != "" ? 'onchange="'.$this->onChange.'"':"").'>';

		for($i=1; $i <= 24; $i++) {
			$sel = ($i == date('h', $this->timestamp)) ? " SELECTED" : "";

			$daySel .= '<option value="'.$i.'"'.$sel.'>'.$i.'</option>\n';
		}

		$daySel .= '</select>';
		return $daySel;
	}
	
	protected function GetMinField($fieldName) {
		$daySel = '<select name="'.$fieldName.'[min]"'.($this->onChange != "" ? 'onchange="'.$this->onChange.'"':"").'>';

		for($i=0; $i < 60; $i += 15) {
			$sel = ($i == date('h', $this->timestamp)) ? " SELECTED" : "";

			$daySel .= '<option value="'.$i.'"'.$sel.'>'.($i < 10 ? "0" : "").$i.'</option>\n';
		}

		$daySel .= '</select>';
		return $daySel;
	}

}

?>