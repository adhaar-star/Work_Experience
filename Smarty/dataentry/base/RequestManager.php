<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */


/**
 * - Checks security level
 * - Based upon what is requested(page/module) loads the needed modules
 */
class RequestManager {

	public function __construct() {
		// Decide which page to load
		if(Security::Validate()) {
			// continue
			$this->Display('main');
		} else {
			// display login form
			$this->Display('login');
		}
		
	}



	private function LoadObject($obj) {
		echo Database::GetObject($obj)->GetHtml();
	}

	/**
	 * Loads a module
	 *
	 * @param Module $module The module that is to be displayed
	 * @return string The output from the module
	 */
	private function LoadModule($module) {
		
		
		
	}
	
	private function Display($templateName, &$data = "") {
		global $xajax;
		
		$template = new Template($templateName);
		$template->Assign('main', $data);
		
		$template->Assign('self', $_SERVER['PHP_SELF']);
		$template->Assign('staffUsername', $_SESSION['username']);
		$template->Assign('staffFullName', Database::QuickSelect("staff", "fullName", "username='".$_SESSION['username']."'"));
		
		$template->Assign('xajaxJavaScript', $xajax->getJavascript('xajax'));

		
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
		
			
		
		
		$template->Assign('totals', $totals);
		//$out .= $template->GetHtml();

		
		
		//return '$out';
$template->Display();

	}
}


?>
