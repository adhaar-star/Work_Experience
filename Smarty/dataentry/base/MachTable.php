<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class MachTable {
	public function __construct() {
		
	}
	
	
	public function Display($data='') {
		$info = new Template('SiteInfo');
		$info->Assign('siteData', SiteEdit::FetchSite($data['id']));
		$info->Assign('editSiteData', QueryEncode(array('id' => $data['id'])));
		$info->Assign('newMachData', QueryEncode(array('id'=>0, 'site'=>$data['id'])));
		$info->Assign('edit', true);
		
		$tableObj = new Table('MachTable', "machines", array("machines", "charities"), "machines.site=".$data['id']." AND (machines.charity=charities.id OR machines.charity=0)");
		
		$tableObj->AddField("refNumber", "#", "machines.refNumber as refNumber");
		$tableObj->AddField("status", "Status", "(CASE WHEN machines.inactive=1 THEN 'Inactive' ELSE 'Active' END) AS status");
		$tableObj->AddField("name", "Machine", "machines.name as name");
		$tableObj->AddField("commissionRate", "Commission %", "machines.commissionRate as commissionRate");
		$tableObj->AddField("coinValue", "Coin Accepted ".CURRENCY_SYMBOL, "machines.coinValue as coinValue");
		$tableObj->AddField("charity", "Charity", "charities.name as charity");
		$tableObj->AddField("charityRate", "Charity %", "machines.charityRate as charityRate");
		$tableObj->AddField("installDate", "Installed", "machines.installDate as installDate");
		$tableObj->setOnText("machines.charity=charities.id");

		$tableObj->SetEditForm('machEditForm', 'MachEdit', 'machEditArea');
		$tableObj->SetEditValue('site', $data['id']);
		
		//$tableObj->NewButton("New Machine");
		return $info->GetHtml().$tableObj->Display($data);
	}
}

?>
