<?
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class SiteInfo {
	
	
	public static function Display($data) {
		$info = new Template('SiteInfo');
		$info->Assign('siteData', SiteEdit::FetchSite($data['id']));
		$later = strtotime('+20 day');
$info->assign('later', $later);
		
		
		$info->Assign('editSiteData', QueryEncode(array('id' => $data['id'])));
		$info->Assign('newMachData', QueryEncode(array('id'=>0, 'site'=>$data['id'])));
		
		return $info->GetHtml();
	}
}

?>