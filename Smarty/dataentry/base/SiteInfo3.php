<?
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class SiteInfo3 {
	
	
	public static function Display($data) {
		$info = new Template('SiteInfo3');
		$info->Assign('siteData', SiteEdit::FetchSite($data['id']));
		$later = strtotime('+0 day');
$info->Assign('later', $later);
		$username=$_SESSION['username'];
		$info->assign('username', $username);
	//	$info->Assign('editSiteData', QueryEncode(array('id' => $data['id'])));
	//	$info->Assign('newMachData', QueryEncode(array('id'=>0, 'site'=>$data['id'])));
		
		return $info->GetHtml();
	}
}

?>