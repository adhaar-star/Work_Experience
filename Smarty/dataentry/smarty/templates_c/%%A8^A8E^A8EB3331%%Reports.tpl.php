<?php /* Smarty version 2.6.16, created on 2017-02-28 08:47:15
         compiled from Reports.tpl */ ?>
<div id="reportOptions"><form id="reportsForm" onsubmit="return false;">
<input type="hidden" name="report" value="<?php echo $this->_tpl_vars['report']; ?>
">
	<input type="hidden" name="newsubmenu" value="no">
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
<div id="reportArea"></div>
