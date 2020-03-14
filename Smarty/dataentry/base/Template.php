<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
 */

/**
 * Template wrapper for Smarty
 *
 * This class is a wrapper for the functions of smarty, to separate smarty from the implementation
 * of a templating system which may change in the future.
 *
 */
class Template {
	private $smartyObj;
	private $templateName;

	public function __construct($name) {
		// Check to see if there's a template for this name
		if(file_exists(SMARTY_TEMPLATE_DIR.'/'.$name.'.tpl')) {
			$this->templateName = $name;
		} else {
			$this->templateName = "Object";
		}

		$this->smartyObj = new Smarty();
		$this->smartyObj->template_dir = SMARTY_TEMPLATE_DIR;
		$this->smartyObj->compile_dir = SMARTY_COMPILE_DIR;
		$this->smartyObj->cache_dir = SMARTY_CACHE_DIR;
		$this->smartyObj->config_dir = SMARTY_CONFIG_DIR;
		$this->smartyObj->register_function('query_encode', 'SmartyQueryEncode');
		
		$this->Assign('currency', CURRENCY_SYMBOL);
	}

	public function AssignObject(&$object) {
		$this->smartyObj->register_object("obj", $object);
		$this->Assign("data", $object->GetValues());
	}

	public function Assign($fieldName, $data) {
		$this->smartyObj->assign_by_ref($fieldName, $data);
	}

	public function GetHtml() {
		return $this->smartyObj->fetch($this->templateName.'.tpl');
	}

	public function Display() {
		echo $this->GetHtml();
	}
}

?>