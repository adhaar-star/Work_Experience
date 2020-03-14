<?php /* Smarty version 2.6.16, created on 2017-03-07 14:13:07
         compiled from Report4.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'Report4.tpl', 38, false),)), $this); ?>
<?php if ($this->_tpl_vars['newsubmenu'] == 'yes'): ?>

<div id="machEditArea" style="display:none">
<div class="sectionHeading">Vending Machine Details</div>
<div class="section">
<form id="machEditForm" onsubmit="return false;">
</form>
</div>
</div>

<div id="machListingArea" style="display:none">
<div class="sectionHeading">Site Details</div>
<!--<div class="print_btn"><input class="btn blue" style="margin: 10px 0;" type="button" value="Print" onclick="window.print();" /></div>-->
<div id="machinesTable">

</div>
</div>
<div id="dataDetailsArea2" style="display:none">

<div class="sectionHeading">Site Details</div>
<!--<div class="print_btn"><input class="btn blue" style="margin: 10px 0;" type="button" value="Print" onclick="window.print();" /></div>-->
<div id="siteInfo2"></div>
<br>
<div id="machineEntry2"></div>
</div>

<h1>Site NameListing</h1>

<div id="dataprint">
<table class="dataTable" cellspacing="0" width="100%">
<h2><?php if ($this->_tpl_vars['siteType'] == ""): ?>All<?php else:  echo $this->_tpl_vars['siteType'];  endif; ?> <?php if ($this->_tpl_vars['inactive']): ?>Inactive<?php else: ?>Active<?php endif; ?> Sites</h2>	
<tr>
<th>Site No.</th><th>Site Name</th><th>Site Address</th><th>Site Contact</th><th>Site Number</th><th></th>
</tr>
<?php $_from = $this->_tpl_vars['tableData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rowData']):
?>


<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
">
<td><?php echo $this->_tpl_vars['rowData']['type'];  echo $this->_tpl_vars['rowData']['refNumber']; ?>
</td>
<td><?php if ($this->_tpl_vars['rowData']['name'] != ""):  echo $this->_tpl_vars['rowData']['name'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['address'] != ""):  echo $this->_tpl_vars['rowData']['address'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['contact'] != ""):  echo $this->_tpl_vars['rowData']['contact'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['phone'] != ""):  echo $this->_tpl_vars['rowData']['phone'];  else: ?>&nbsp;<?php endif; ?></td>

<td valign="middle" align="center" width="16"><form name="siteEntry" id="siteEntryForm<?php echo $this->_tpl_vars['rowData']['refNumber']; ?>
" onsubmit="return false;" style="display:block;">
<input type="hidden" name="siteType" value="<?php echo $this->_tpl_vars['rowData']['type']; ?>
"/>

	
<input type="hidden" name="refNumber" class="txtBox" value="<?php echo $this->_tpl_vars['rowData']['refNumber']; ?>
"/>	<img title="View" alt="Edit"  src="images/view.png" class="clickable" onclick="xajax_ProcessForm3('machDetails','DataEntry3', xajax.getFormValues('siteEntryForm<?php echo $this->_tpl_vars['rowData']['refNumber']; ?>
'))" style="width:16px;height16px;">	
<input type="hidden" name="refNumber" class="txtBox" value="<?php echo $this->_tpl_vars['rowData']['refNumber']; ?>
"/>	<img title="Edit" alt="Edit"  src="images/edit.png" class="clickable" onclick="xajax_ProcessForm3('machDetails','DataEntry2', xajax.getFormValues('siteEntryForm<?php echo $this->_tpl_vars['rowData']['refNumber']; ?>
'))">
<img title="Delete" alt="Delete" src="images/delete.png" class="clickable" onclick="xajax_DeleteItem('sites','176', 'sitesTable', 'SiteTable')"></form>	</td>
	
</tr>
<?php endforeach; endif; unset($_from); ?>

</table>
<?php else: ?>
<h1>Site Listing</h1>
<h2><?php if ($this->_tpl_vars['siteType'] == ""): ?>All<?php else:  echo $this->_tpl_vars['siteType'];  endif; ?> <?php if ($this->_tpl_vars['inactive']): ?>Inactive<?php else: ?>Active<?php endif; ?> Sites</h2>
<table class="dataTable dataprint" cellspacing="0" width="100%">
<tr>
<th>Site No.</th><th>Site Name</th><th>Site Address</th><th>Site Contact</th><th>Site Number</th>
</tr>
<?php $_from = $this->_tpl_vars['tableData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rowData']):
?>
<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
">
<td><?php echo $this->_tpl_vars['rowData']['type'];  echo $this->_tpl_vars['rowData']['refNumber']; ?>
</td>
<td><?php if ($this->_tpl_vars['rowData']['name'] != ""):  echo $this->_tpl_vars['rowData']['name'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['address'] != ""):  echo $this->_tpl_vars['rowData']['address'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['contact'] != ""):  echo $this->_tpl_vars['rowData']['contact'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['phone'] != ""):  echo $this->_tpl_vars['rowData']['phone'];  else: ?>&nbsp;<?php endif; ?></td>

</tr>
<?php endforeach; endif; unset($_from); ?>

</table>
</div>
<?php endif; ?>