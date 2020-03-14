<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
*/


/**
 * Static class that cannot be instantiated outside of itself.  It is a singleton to ensure only one connection is opened
 * no matter now many times the Database::Connect() method is called.
 */

class Database {
	private static $conn;
	private static $instance;

	/**
	 * Prevents instantiation
	 */
	private function __construct() {
		// Open database connection
		self::$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or trigger_error("Unable to connect to database");
		mysql_select_db(DB_NAME, self::$conn) or trigger_error("Unable to select DB");
	}

	/**
	 * Connects to database if not connected and returns this instance
	 */
	public static function Connect() {
		if( !isset(self::$instance) ) {
			self::$instance = new Database;
		}
		return self::$instance;
	}

	/**
	 * @return Database the instance of this object
	 */
	public static function GetInstance() {
		return self::connect();
	}

	/**
	 * Perform a database query
	 * @return DatabaseQuery the result object to retrieve query result
	 */
	public static function Query($sql) {
		return new DatabaseQuery($sql);
	}

	/**
	 * Perform a quick query is for a single result -- returns the result value
	 * @return mixed resulting value from DB
	 */
	public static function QuickQuery($sql) {
		$result = self::Query($sql);
		return $result->GetSingleField();
	}

	/** Updates the values
	 * @param string $table the table to modify
	 * @param array|string $values an associative array of field => newValue pairs or a string containing a "data='value'" set
	 * @param array|string $condition - an array of conditions or a string containing a single condition string
	 * @return boolean TRUE on successfully updating and FALSE if an error occurred
	 */
	public static function Update($table, $values, $condition) {
		$sql = "UPDATE $table SET ".implode(', ', self::GetValueArr($values))." WHERE ".implode(" AND ", self::MakeArray($condition));
		$result = self::Query($sql);
		if($result) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Perform a database insert operation
	 *
	 * @param string $table The table to insert data into
	 * @param array $values an associative array of field=>newValue pairs
	 * @return integer|false The id of the row inserted or false on failure
	 */
	public static function Insert($table, $values) {
		$sql = "INSERT INTO $table SET ".implode(', ', self::GetValueArr($values));
		$result = self::Query($sql);
		if($result) {
			return mysql_insert_id();
		} else {
			return false;
		}
	}

	/**
	 * Perform a database SELECT operation
	 *
	 * @param array|string $tables Tables involved in the query
	 * @param array|string $fields Fields to be fetched in the query
	 * @param array|string $conditions An array or string of conditions in the query
	 * @param array|string $sort An array or string of sort fields eg. "date ASC"
	 * @param integer $limit The number of items to retrieve (on a page)
	 * @param integer $page The page number that the current list is on
	 * @return DatabaseQuery The object to retrieve database results
	 */
	public static function Select($tables, $fields, $conditions=array("1"), $sort='', $limit=0, $page=1) {
		$sql = "SELECT ".implode(', ', self::MakeArray($fields))." FROM ".self::GetTablesText($tables).self::GetConditionText($conditions).self::GetSortText($sort).self::GetLimitText($limit, $page);
		return self::Query($sql);
	}
	
	/**
	 * Perform a LEFT-JOIN SELECT with multiple tables
	 *
	 * @param array|string $tables Tables involved in the Left Join
	 * @param array|string $fields Fields that are to be returned
	 * @param array|string $on On clauses that joins tables
	 * @param array|string $conditions Conditions on the result set
	 * @param array|string $sort Sort fields
	 * @param integer $limit Number of items to retrieve per page
	 * @param integer $page The page number to return
	 * @return DatabaseQuery The object to retrieve database results
	 */
	public static function LeftJoin($tables, $fields, $on, $conditions=array("1"), $sort='', $limit=0, $page=1) {
		$sql = "SELECT ".implode(', ', self::MakeArray($fields))." FROM ";
		$sql .= implode(' LEFT JOIN ', self::MakeArray($tables));
		$on = self::MakeArray($on);
		if($on[0] != "") {
			$sql .= " ON ".implode(' AND ', $on);
		}
		$sql .= self::GetConditionText($conditions).self::GetSortText($sort).self::GetLimitText($limit, $page);
		return self::Query($sql);
	}

	/**
	 * Perform a 'QuickSelect' query.  If a single value is expected as a result, this function simplifies retrieving
	 * result rows, and returns the value immediately.  If multiple rows are found in a query, the first field in
	 * the first result row is returned.
	 *
	 * @param array|string $tables Database table to select from
	 * @param array|string $fields Field that data is to be returned from
	 * @param array|string $conditions Search conditions in either an array or string
	 * @param array|string $sort Sort conditions -- note the function will only return the first result
	 * @return mixed The result found in the database
	 */
	public static function QuickSelect($tables, $fields, $conditions=array("1"), $sort='', $limit=1, $page=1) {
		$result = self::Select($tables, $fields, $conditions, $sort, $limit, $page);
		return $result->GetSingleField();
	}
	
	public static function Delete($table, $conditions) {
		return self::Query("DELETE FROM $table WHERE $conditions");
	}
	
	public static function EntryExists($table, $condition) {
		$value = addslashes($value);
		$result = Database::Select($table, 'id', $condition);

		return $result->HasNext();
	}


	private static function GetSortText($sort) {
		if($sort) {
			return " ORDER BY ".implode(', ', self::MakeArray($sort));
		} else {
			return "";
		}
	}

	private static function GetLimitText($limit, $page) {
		if($limit > 0) {
			$startRecord = (($page > 0 ? $page : 1) - 1) * $limit;
			return " LIMIT ".$startRecord.", ".$limit;
		} else {
			return "";
		}
	}

	private static function GetConditionText($conditions) {
		if($conditions) {
			return " WHERE ".implode(" AND ", self::MakeArray($conditions));
		} else {
			return "";
		}
	}

	private static function GetTablesText($tables) {
		return implode(", ", self::MakeArray($tables));
	}

	private static function GetValueArr(&$values) {
		$valueArr = array();
		if(is_array($values)) {
			foreach($values as $field => $value) {
				$valueArr[] = "`$field`='$value'";
			}
		} else {
			$valueArr[] = $values;
		}
		return $valueArr;
	}

	private static function MakeArray(&$values) {
		if(is_array($values)) {
			return $values;
		} else {
			$newArr = array();
			$newArr[] = $values;
			return $newArr;
		}
	}


}


?>