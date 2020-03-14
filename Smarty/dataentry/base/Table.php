<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class Table {	
	private $rowData;
	private $className;
	private $tableName;
	private $condition;
	private $editDiv;
	private $editClass;
	
	public function __construct($className, $tableName, $dbTables="", $condition="1") {
		$this->rowData = array();
		$this->fields = array();
		$this->className = $className;
		$this->tableName = $tableName;
		if($dbTables == "")
			$this->dbTables = $tableName;
		else
			$this->dbTables = $dbTables;
		$this->condition = $condition;
		$this->rowEditData = array();
		$this->newButton = "";
	}
	
	public function AddField($fieldName, $fieldDisplayName, $dbFieldQuery="") {
		$this->fields[$fieldName] = $fieldDisplayName;
		if($dbFieldQuery != "")
			$this->dbFields[] = $dbFieldQuery;
		else
			$this->dbFields[] = $fieldName;
	}
	
	public function SetEditForm($editDiv, $editClass, $areaDiv="") {
		$this->editDiv = $editDiv;
		$this->editClass = $editClass;
		$this->areaDiv = $areaDiv;
	}
	
	public function SetEditValue($key, $value) {
		$this->rowEditData[$key] = $value;
	}
	
	private function GetFieldList() {
		$fieldArr = $this->dbFields;
		array_unshift($fieldArr, $this->tableName.'.id as id');
		return implode(', ', $fieldArr);
	}
	
	public function setOnText($clause) {
		$this->onText = $clause;
	}
	
	private function FetchData($page=1, $sort ='') {
		$result = Database::LeftJoin($this->dbTables, $this->GetFieldList(), $this->onText, $this->condition, $sort);
		//$result = Database::LeftJoin($this->dbTables, $this->GetFieldList(), $this->onText, $this->condition, $sort, ITEMS_PER_PAGE, $page);
		//$result = Database::Select($this->dbTables, $this->GetFieldList(), $this->condition, $sort, ITEMS_PER_PAGE, $page);
		while($result->HasNext()) {
			$this->rowData[] = $result->GetNext();
		}
		$this->sql = $result->GetSQL();
	}
	
	public function NewButton($text="New") {
		$this->newButton = $text;
	}
	
	public function Display($data='') {
		$this->FetchData($data['page'], $data['sort']);
		//print_r($data);
		$fieldSort = array();
		if(isset($data['sort'])) {
			$curSorted = explode(" ", $data['sort']);
			$curField = $curSorted[0];
		} else {
			$curField = 'id';
		}
		
		$newdata = $data;
		foreach($this->fields as $field => $name) {
			if($data['sort'] == $field) {
				$newdata['sort'] = $field.' DESC';
			} else {
				$newdata['sort'] = $field;
			}
			$fieldSort[$field] = QueryEncode($newdata);
		}
		
		$editData = array();
		foreach($this->rowData as $data) {
			$this->rowEditData['id'] = $data['id'];
			$editData[$data['id']] = QueryEncode($this->rowEditData);
		}
		
		$this->rowEditData['id'] = 0;
		$newData = QueryEncode($this->rowEditData);
		
		$tpl = new Template('Table');
		$tpl->Assign('fields', $this->fields);
		$tpl->Assign('fieldSort', $fieldSort);
		$tpl->Assign('curField', $curField);
		$tpl->Assign('rowData', $this->rowData);
		$tpl->Assign('className', $this->className);
		$tpl->Assign('divName', $this->tableName.'Table');
		$tpl->Assign('tableName', $this->tableName);
		$tpl->Assign('editDiv', $this->editDiv);
		$tpl->Assign('editClass', $this->editClass);
		$tpl->Assign('editData', $editData);
		$tpl->Assign('areaDiv', $this->areaDiv);
		$tpl->Assign('newData', $newData);
		$tpl->Assign('newButton', $this->newButton);
		$tpl->Assign('sql', $this->sql);
		
		return $tpl->GetHtml();
	}
	
}

?>