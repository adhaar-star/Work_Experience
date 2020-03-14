<?php /* Smarty version 2.6.16, created on 2017-03-08 06:21:42
         compiled from MachineEntry3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'MachineEntry3.tpl', 11, false),array('function', 'cycle', 'MachineEntry3.tpl', 20, false),)), $this); ?>

<div class="subsection sitedetails">
<input type="hidden" name="site" value="<?php echo $this->_tpl_vars['siteID']; ?>
">
<input type="hidden" name="lastDate" id="lastDate" value="<?php echo $this->_tpl_vars['date']; ?>
">
<!--<div class="subsection">Date of Entry: <?php echo $this->_tpl_vars['dateSelect']; ?>
<input type="button" value="Update" class="clickable" onclick="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))"></div>-->

	<!--<table class="dataTable4" width="100%" cellspacing="0" align="right">
<tr>
<th>#</th><th>Machine Name</th><th>Amount</th><th>Commissions</th><th>Charity</th><th>Notes</th>
</tr>
<tr><td>Machine Name</td><td><?php echo $this->_tpl_vars['siteData']['type'];  echo ((is_array($_tmp=$this->_tpl_vars['siteData']['refNumber'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%4s") : smarty_modifier_string_format($_tmp, "%4s")); ?>
</td></tr>

<?php $_from = $this->_tpl_vars['machines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
 $this->assign('id', $this->_tpl_vars['v']['id']);  $this->assign('refNumber', $this->_tpl_vars['v']['refNumber']);  $this->assign('amount', $this->_tpl_vars['v']['amountCollected']);  $this->assign('notes', $this->_tpl_vars['v']['notes']); ?>
<div style="height:10px;">
	</div>		
<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
" style="margin-top:50px;">
<tr><td>Machine Name</td><td><?php if ($this->_tpl_vars['v']['name'] == ""): ?>&nbsp;<?php else:  echo $this->_tpl_vars['v']['name'];  endif; ?></td></tr>
<tr><td>Total Takings-</td><td><?php echo $this->_tpl_vars['currency'];  if ($this->_tpl_vars['v']['amountCollected'] == ''): ?>0.00
<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['v']['amountCollected'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f"));  endif; ?></td></tr>
<tr><td>Commission Due-</td><td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['v']['commissions'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td>Charity Amount-</td><td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['v']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td>Notes<td><td><?php echo $this->_tpl_vars['v']['notes']; ?>
</td></tr>
		
<?php endforeach; endif; unset($_from); ?>
<!--<tr class="totals">
<td colspan="2">Totals</td>
<td><?php echo $this->_tpl_vars['currency']; ?>
<div id="amountCollectedTotal" class="dataEntryField"><?php echo ((is_array($_tmp=$this->_tpl_vars['totals']['amountCollected'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</div></td>
<td><?php echo $this->_tpl_vars['currency']; ?>
<div id="commissionsTotal" class="dataEntryField"><?php echo ((is_array($_tmp=$this->_tpl_vars['totals']['commissions'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</div></td>
<td><?php echo $this->_tpl_vars['currency']; ?>
<div id="charityTotal" class="dataEntryField"><?php echo ((is_array($_tmp=$this->_tpl_vars['totals']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</div></td>
<td>&nbsp;</td>
</tr>
</table>-->
<?php $_from = $this->_tpl_vars['machines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
 $this->assign('id', $this->_tpl_vars['v']['id']);  $this->assign('refNumber', $this->_tpl_vars['v']['refNumber']);  $this->assign('amount', $this->_tpl_vars['v']['amountCollected']);  $this->assign('notes', $this->_tpl_vars['v']['notes']); ?>
<div style="height:10px;">
	</div>
<div class="machinedetails" style="font-size:20px;margin-left:4%;">
Machine Name-<?php if ($this->_tpl_vars['v']['name'] == ""): ?>&nbsp;<?php else:  echo $this->_tpl_vars['v']['name'];  endif; ?><br>
Total Takings-<?php echo $this->_tpl_vars['currency'];  if ($this->_tpl_vars['v']['amountCollected'] == ''): ?>0.00
<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['v']['amountCollected'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f"));  endif; ?><br>
Commission Due-<?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['v']['commissions'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
<br>
Charity Amount-<?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['totals']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
<br>
Notes-<?php echo $this->_tpl_vars['v']['notes']; ?>
	
</div>
<?php endforeach; endif; unset($_from); ?>	
<input class="btn blue" style="margin: 10px 50px;display:block;" type="button" id="printmachinedetails" value="Print" onclick="window.print();"/>



</div>
	
	
	
	