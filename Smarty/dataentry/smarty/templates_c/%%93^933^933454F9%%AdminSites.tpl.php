<?php /* Smarty version 2.6.16, created on 2017-03-06 08:55:59
         compiled from AdminSites.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'query_encode', 'AdminSites.tpl', 1, false),)), $this); ?>
<input type="button" class="clickable" value="New Site" onclick="xajax_RefreshElement('siteEditForm','SiteEdit','<?php echo SmartyQueryEncode(array('data' => 0), $this);?>
');xajax_ShowDiv('siteEditArea');">

<div id="siteEditArea" style="display:none">
<div class="sectionHeading">Edit Site</div>
<div class="section">
<form id="siteEditForm" onsubmit="return false;">
</form>
</div>
</div>

<div id="machEditArea" style="display:none">
<div class="sectionHeading">Vending Machine Details</div>
<div class="section">
<form id="machEditForm" onsubmit="return false;">
</form>
</div>
</div>

<div id="machListingArea" style="display:none">
<div class="sectionHeading">Site Details</div>
<div class="print_btn"><input class="btn blue" style="margin: 10px 0;" type="button" value="Print" onclick="window.print();" /></div>
<div id="machinesTable">

</div>
</div>

<h1>Site & Machine Management</h1>

<div id="sitesTable" class="print_hide"><?php echo $this->_tpl_vars['siteListing']; ?>
</div>