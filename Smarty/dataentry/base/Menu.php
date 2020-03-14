<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

class Menu {
	public $menuItems;
	public $menuNotices;
	
	public function __construct($menuName) {
		$_SESSION['menuCount']++;
		$this->menuItems = array();
	}
	
	public function AddItem($name, $pageClass, $query="", $reload=0, $image="") {
		$this->menuItems[] = array("name" => $name, "page" => $pageClass, "query" => QueryEncode($query), "reload" => $reload, "image" => $image);
	}
	
	public function AddNotice($text) {
		$this->menuNotices[] = $text;
	}
	
	public function size() {
		return sizeof($this->menuItems);
	}
	
	public function Display() {
		$tpl = new Template('menu');
		$tpl->Assign('menuItems', $this->menuItems);
		$tpl->Assign('menuNumber', $_SESSION['menuCount']);
		$tpl->Assign('menuNotices', $this->menuNotices);
		return $tpl->GetHtml();
	}
}

?>