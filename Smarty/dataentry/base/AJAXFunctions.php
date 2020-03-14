<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 * 
 * AJAX Functions
 * 
 * The functions that will be used to process data through xajax
*/

function QueryEncode($data) {
	return base64_encode(serialize($data));
}

function QueryDecode($data) {
	return unserialize(base64_decode($data));
}

function ProcessForm($divId, $className, $formData) {
	$obj = new $className();
	$objResponse = new xajaxResponse();
	
	if($obj->ValidateForm($formData)) { // if the data is good
		$obj->SaveData($formData);
		//$objResponse->addAlert("The form was saved.");
	} else { // the data was bad
		$objResponse->addAlert(implode("\n", $obj->GetErrors()));
	}
	
	$objResponse = $obj->GetResponse($objResponse);
	
//$objResponse->addAssign($divId,"innerHTML", $obj->Display($parsedQuery));
	
	return $objResponse;
		

}

function ProcessForm2($divId, $className, $formData) {
	$obj = new $className();
	$objResponse = new xajaxResponse();
	
	if($obj->ValidateForm($formData)) { // if the data is good
		$obj->SaveData($formData);
		//$objResponse->addAlert("The form was saved.");
	} else { // the data was bad
		$objResponse->addAlert(implode("\n", $obj->GetErrors()));
	}
	
	$objResponse = $obj->GetResponse($objResponse);
	
$objResponse->addAssign($divId,"innerHTML", $obj->Display($parsedQuery));
	
	return $objResponse;
		

}
function ProcessForm4($divId, $className, $formData) {
	$obj = new $className();
	$objResponse = new xajaxResponse();
	
	if($obj->ValidateForm($formData)) { // if the data is good
		//$obj->SaveData($formData);
		//$objResponse->addAlert("The form was saved.");
	} else { // the data was bad
		$objResponse->addAlert(implode("\n", $obj->GetErrors()));
	}
	
	$objResponse = $obj->GetResponse($objResponse);
	
$objResponse->addAssign($divId,"innerHTML", $obj->Display($parsedQuery));
	
	return $objResponse;
		

}

function ProcessForm3($divId, $className, $formData) {
	$obj = new $className();
	$objResponse = new xajaxResponse();
	
	if($obj->ValidateForm($formData)) { // if the data is good
//$objResponse = $obj->GetResponse($objResponse);		//$obj->SaveData($formData);
		//$objResponse = $obj->GetResponse($objResponse);
		//$objResponse->addAlert("The form was saved.");
			$obj->SaveData($formData);
		
	} else { // the data was bad
		$objResponse->addAlert(implode("\n", $obj->GetErrors()));
	}
	$objResponse = $obj->GetResponse($objResponse);
	$objResponse->addAssign($divId,"innerHTML", $obj->Display($parsedQuery));
//	$objResponse = $obj->GetResponse($objResponse);
	

	
	return $objResponse;
		

}

function ProcessSites($divId, $className, $formData) {
	$obj = new $className();
	$objResponse = new xajaxResponse();
	
	if($obj->ValidateForm($formData)) { // if the data is good
		$obj->SaveData($formData);
		//$objResponse->addAlert("The form was saved.");
	} else { // the data was bad
		$objResponse->addAlert(implode("\n", $obj->GetErrors()));
	}
	
	$objResponse = $obj->GetResponse($objResponse);
	

	
	return $objResponse;
}

function SmartyQueryEncode($params, &$smarty)
{
	return QueryEncode($params['data']);
}

function RefreshElement($divId, $className, $query) {
	$obj = new $className();
	
	$objResponse = new xajaxResponse();
	$parsedQuery = QueryDecode($query);

	$objResponse->addAssign($divId,"innerHTML", $obj->Display($parsedQuery));
	
	return $objResponse;
}

function ShowDiv($divId) {
	$objResponse = new xajaxResponse();
	
	$objResponse->addAssign($divId, 'style.display', 'block');
	
	return $objResponse;
}

function ShowTable($divId) {
	$objResponse = new xajaxResponse();
	
	$objResponse->addAssign($divId, 'style.display', 'block');
	
	return $objResponse;
}

function HideDiv($divId) {
	$objResponse = new xajaxResponse();
	
	$objResponse->addAssign($divId, 'style.display', 'none');
	
	return $objResponse;
}
function showButton($divId) {
	$objResponse = new xajaxResponse();
	
	$objResponse->addAssign($divId, 'style.display', 'block');
	
	return $objResponse;
}
function HideButton($divId) {
	$objResponse = new xajaxResponse();
	
	$objResponse->addAssign($divId, 'style.display', 'none');
	
	return $objResponse;
}

/**
 * Will delete an item from database if the action is confirmed
 *
 * @param string $tableName
 * @param string $id
 */
function DeleteItem($tableName, $id,  $refreshDiv='', $refreshClass='', $confirmed=0) {
	$objResponse = new xajaxResponse();
	
	if(!$confirmed) {
		$objResponse->addConfirmCommands(1, "Are you sure you want to delete this item?");
		$objResponse->addScript("xajax_DeleteItem('$tableName','$id', '$refreshDiv', '$refreshClass', 1)");
	} else {
		Database::Delete($tableName, "id='$id'");
		$obj = new $refreshClass();
		$objResponse->addAssign($refreshDiv, 'innerHTML', $obj->Display());
	}
	
	return $objResponse;
}

function LoadPage($className, $query, $loadSubMenu=0) {
	$obj = new $className();
	$menu = $obj->GetMenu();
	
	//sleep(2);
	
	$objResponse = new xajaxResponse();
	$parsedQuery = QueryDecode($query);

	$objResponse->addAssign("mainPage","innerHTML", $obj->Display($parsedQuery));
	
	if($loadSubMenu && $menu->size() > 0) {
		$objResponse->addAssign("sMenu", "style.display", "block");
		$objResponse->addAssign("sMenu", "innerHTML", $menu->Display());
		$objResponse->addScript('menuSize['.$_SESSION['menuCount'].'] = '.$menu->size().';');
	} else if($loadSubMenu) {
		$objResponse->addAssign("sMenu", "style.display", "none");
	}
	
	if($className == 'DataEntry') {
		$objResponse->addScript("document.getElementById('siteEntryForm').refNumber.focus()");
	}
	
	if($className == 'Reports') {
		$objResponse->addAssign('reportArea', 'innerHTML', $obj->Summary());
	}
	
	return $objResponse;
}

function LoadMenu() {
	$_SESSION['menuCount'] = 0;
	$menu = new Menu("mainMenu");
	$menu->AddItem("Data Entry","DataEntry", array("TVM"), 1, "images/edit.png");
	$menu->AddItem("Reports", "Reports", '', 1, "images/reports.png");
	$menu->AddItem("Administration", "Administration", '', 1, "images/admin.png");
	$staffFullName = Database::QuickSelect("staff", "fullName", "username='".$_SESSION['username']."'");
	$menu->AddNotice('Welcome '.$staffFullName.' <a class="btn" href="'.$_SERVER['PHP_SELF'].'?logout=1">Logout</a>');
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("mainMenu", "innerHTML", $menu->Display());
	$objResponse->addScript('menuSize['.$_SESSION['menuCount'].'] = '.$menu->size().';');
	return $objResponse;
}




// Register the functions, and process requests
$xajax->registerFunction("LoadMenu");
$xajax->registerFunction("LoadPage");
$xajax->registerFunction("RefreshElement");
$xajax->registerFunction("ProcessForm");
$xajax->registerFunction("ProcessForm2");
$xajax->registerFunction("ProcessForm3");
$xajax->registerFunction("ProcessSites");
$xajax->registerFunction("ShowDiv");
$xajax->registerFunction("HideDiv");
$xajax->registerFunction("ShowTable");
$xajax->registerFunction("DeleteItem");
$xajax->registerFunction("ShowButton");

$xajax->registerFunction("HideButton");
//$xajax->debugOn();
$xajax->processRequests();


?>
