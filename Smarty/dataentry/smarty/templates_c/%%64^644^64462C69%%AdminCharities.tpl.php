<?php /* Smarty version 2.6.16, created on 2017-02-27 10:57:36
         compiled from AdminCharities.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'query_encode', 'AdminCharities.tpl', 1, false),)), $this); ?>
<input type="button" class="clickable" value="New Charity" onclick="xajax_RefreshElement('charityEditForm','CharityEdit','<?php echo SmartyQueryEncode(array('data' => 0), $this);?>
');xajax_ShowDiv('charityEditArea');">
<div id="charityEditArea" style="display:none">
<div class="sectionHeading">Charity Details</div>
<div class="section">
<?php echo $this->_tpl_vars['charityDetails']; ?>

</div>

</div>
<h1>Charities</h1>
<div id="charitiesTable">
<?php echo $this->_tpl_vars['charityListing']; ?>

</div>
