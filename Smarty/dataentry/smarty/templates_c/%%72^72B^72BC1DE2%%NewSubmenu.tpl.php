<?php /* Smarty version 2.6.16, created on 2017-03-06 08:56:00
         compiled from NewSubmenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'NewSubmenu.tpl', 27, false),)), $this); ?>

<div id="reportOptions"><form id="reportsForm" onsubmit="return false;">
<input type="hidden" name="report" value="4">
	<input type="hidden" name="newsubmenu" value="yes">

<?php if ($this->_tpl_vars['dateSelect'] != ""): ?>Report Date:<?php endif;  echo $this->_tpl_vars['dateSelect']; ?>
 Site Type:<select name="siteType"><option value="">TVR + MVN</option><option value="TVR">TVR</option><option value="MVN">MVN</option></select>
<?php if ($this->_tpl_vars['report'] == 4): ?>Status: <select name="inactive">
<?php $_from = $this->_tpl_vars['inactiveOpts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val'] => $this->_tpl_vars['text']):
?>
<option value="<?php echo $this->_tpl_vars['val']; ?>
"><?php echo $this->_tpl_vars['text']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select><?php endif;  if ($this->_tpl_vars['report'] == 3): ?>Machines Due For Service<select name="weeksToService">
<?php $_from = $this->_tpl_vars['weeksToServiceOpts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val'] => $this->_tpl_vars['text']):
?>
<option value="<?php echo $this->_tpl_vars['val']; ?>
"><?php echo $this->_tpl_vars['text']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<?php endif; ?>
<input class="btn blue" type="submit" value="Go" onclick="xajax_ProcessForm('', 'Reports', xajax.getFormValues('reportsForm'))">
	</form>
</div>




<table class="dataTable dataprintdetails" cellspacing="0" width="100%">

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

<?php endforeach; endif; unset($_from); ?>
</table>

<div id="reportArea">


</div>

