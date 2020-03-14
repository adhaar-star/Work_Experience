<?php /* Smarty version 2.6.16, created on 2017-03-01 05:30:34
         compiled from SiteInfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'SiteInfo.tpl', 6, false),array('modifier', 'nl2br', 'SiteInfo.tpl', 8, false),)), $this); ?>

<div class="subsection">
<table width="100%"><tr><td>

<table>
<tr><td>Site Number</td><td><?php echo $this->_tpl_vars['siteData']['type'];  echo ((is_array($_tmp=$this->_tpl_vars['siteData']['refNumber'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%4s") : smarty_modifier_string_format($_tmp, "%4s")); ?>
</td></tr>
<tr><td>Site Name</td><td><?php echo $this->_tpl_vars['siteData']['name']; ?>
</td></tr>
<tr><td valign="top">Address</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['siteData']['address'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td></tr>
<tr><td>Contact</td><td><?php echo $this->_tpl_vars['siteData']['contact']; ?>
</td></tr>
<tr><td>Phone</td><td><?php echo $this->_tpl_vars['siteData']['phone']; ?>
</td></tr>
<tr><td>Status</td><td><?php if ($this->_tpl_vars['siteData']['inactive'] == 1): ?>Inactive<?php else: ?>Active<?php endif; ?></td></tr>
<tr><td>Opening Time</td><td><?php echo $this->_tpl_vars['siteData']['openingTime']; ?>
</td></tr>
</table>

</td><td valign="top" align="right">
<?php if ($this->_tpl_vars['edit'] == true): ?>
<input type="button" value="Edit Site Information" class="clickable" onclick="xajax_RefreshElement('siteEditForm','SiteEdit','<?php echo $this->_tpl_vars['editSiteData']; ?>
');xajax_ShowDiv('siteEditArea');">
<input type="button" class="clickable" value="New Vending Machine" onclick="xajax_RefreshElement('machEditForm','MachEdit','<?php echo $this->_tpl_vars['newMachData']; ?>
');xajax_ShowDiv('machEditArea');">
<?php endif; ?>
</td></tr></table>
<script>
	
	
	</script>
</div>