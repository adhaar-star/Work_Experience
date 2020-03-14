<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
*/

/**
 * Object that actually runs queries, and provides an interface to easily work with the result.
 * It provides methods to quickly extract data from a result set, eg. for simple queries.
 * It also provides an iterator-like interface to retrieve multiple row results
 */

class DatabaseQuery {
	private $result;
	private $curRow;
	private $fields;
	private $sql;

	public static $sqlTime;
	public static $sqlCount;
	
	public function __construct(&$sqlQuery) {
		$this->sql =& $sqlQuery;
		$sqlTimer = new Timer();
		$this->result = mysql_query($sqlQuery) or trigger_error("MySQL Query Error" .(DEBUG ? ": ".mysql_error() : "") );
		$timeTaken = $sqlTimer->GetElapsed();
		self::$sqlTime += $timeTaken;
		++self::$sqlCount;
		//echo self::$sqlCount." Query: $sqlQuery Time: $timeTaken Total SQL: ".self::$sqlTime."<br>\n";
		if($this->result !== true && $this->result !== false) {
			$this->curRow = mysql_fetch_assoc($this->result);
			$this->GetFieldList();
		}
	}

	private function GetFieldList() {
		$this->fields = array();
		$numFields = mysql_num_fields($this->result);
		for($i=0; $i < $numFields; $i++) {
			$this->fields[] = mysql_field_name($this->result, $i);
		}
	}
	
	public function GetSQL() {
		return $this->sql;
	}
	
	public function HasNext() {
		return ($this->curRow != false);
	}

	public function GetNext() {
		if($this->curRow) {
			$returnResult =& $this->curRow;
			$nextRow = mysql_fetch_assoc($this->result);
			$this->curRow =& $nextRow;
			return $returnResult;
		} else {
			trigger_error("No more rows, attempting to getNext when there is none");
		}
	
	}

	public function GetFields() {
		return $this->fields;
	}

	public function GetSingleField() {
		if($this->curRow) {
			return mysql_result($this->result, 0);
		} else {
			return "";
			//trigger_error("No more rows, attempting to getSingleField when there is none");
		}
	}
	
	// Retrieves the requested field from the current Result row
	public function Get($fieldName) {
		return $this->curRow[$fieldName];
	}
}

?>