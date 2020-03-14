<?php /* Smarty version 2.6.16, created on 2017-03-08 06:56:53
         compiled from MachineEntry2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'MachineEntry2.tpl', 16, false),array('modifier', 'string_format', 'MachineEntry2.tpl', 24, false),)), $this); ?>

<form id="machineEntryForm" onsubmit="return false;">
<input type="hidden" name="site" value="<?php echo $this->_tpl_vars['siteID']; ?>
">
<input type="hidden" name="lastDate" id="lastDate" value="<?php echo $this->_tpl_vars['date']; ?>
">
<div class="subsection">Date of Entry: <?php echo $this->_tpl_vars['dateSelect']; ?>
<input type="button" value="Update" class="clickable" onclick="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))"></div>
<table class="dataTable" width="100%" cellspacing="0">
<tr>
<th>#</th><th>Machine Name</th><th>Amount</th><th>Commissions</th><th>Charity</th><th>Notes</th>
</tr>

<?php $_from = $this->_tpl_vars['machines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
 $this->assign('id', $this->_tpl_vars['v']['id']);  $this->assign('refNumber', $this->_tpl_vars['v']['refNumber']);  $this->assign('amount', $this->_tpl_vars['v']['amountCollected']);  $this->assign('notes', $this->_tpl_vars['v']['notes']); ?>
<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
">
<td><?php echo $this->_tpl_vars['refNumber']; ?>
</td>
<td><?php if ($this->_tpl_vars['v']['name'] == ""): ?>&nbsp;<?php else:  echo $this->_tpl_vars['v']['name'];  endif; ?></td>
<td><?php echo $this->_tpl_vars['currency']; ?>


<?php if ($this->_tpl_vars['v']['amountCollected'] == ''): ?>
	<input onchange="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))" type="number" placeholder="0.00" id="amountCollected_<?php echo $this->_tpl_vars['id']; ?>
" name="amountCollected_<?php echo $this->_tpl_vars['id']; ?>
" size="6" value="">
<?php else: ?>
	<input onchange="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))" type="number" placeholder="0.00" id="amountCollected_<?php echo $this->_tpl_vars['id']; ?>
" name="amountCollected_<?php echo $this->_tpl_vars['id']; ?>
" size="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['amountCollected'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
">
<?php endif; ?>

</td>
<td><?php echo $this->_tpl_vars['currency']; ?>
<div id="commissions_<?php echo $this->_tpl_vars['id']; ?>
" class="dataEntryField"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['commissions'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</div></td>
<td><?php echo $this->_tpl_vars['currency']; ?>
<div id="charity_<?php echo $this->_tpl_vars['id']; ?>
" class="dataEntryField"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</div></td>
<td><input type="text" size="15" id="notes_<?php echo $this->_tpl_vars['id']; ?>
" name="notes_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['v']['notes']; ?>
" onchange="xajax_ProcessForm('','MachineEntry2', xajax.getFormValues('machineEntryForm'))"></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr class="totals">
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
</table>

	</form>
<input type="submit" value="Update" class="clickable" onclick="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'));xajax_ShowButton('printmachinedetails');xajax_HideDiv('printmachinedetails');">
<input type="button" value="Done" class="clickable" onclick="xajax_ProcessForm('','MachineEntry2', xajax.getFormValues('machineEntryForm'));xajax_HideDiv('dataDetailsArea');document.getElementById('siteEntryForm').refNumber.select()">
<input class="btn blue" style="margin: 10px 0;display:none;" type="button" id="printmachinedetails" value="Print" onclick="window.print();"/>



<table class="dataTable2 " width="100%" id='datatable2' style="display:none;" cellspacing="0">
<tr>
<th>#</th><th>Machine Name</th><th>Amount</th><th>Commissions</th><th>Charity</th><th>Notes</th>
</tr>

<?php $_from = $this->_tpl_vars['machines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
 $this->assign('id', $this->_tpl_vars['v']['id']);  $this->assign('refNumber', $this->_tpl_vars['v']['refNumber']);  $this->assign('amount', $this->_tpl_vars['v']['amountCollected']);  $this->assign('notes', $this->_tpl_vars['v']['notes']); ?>
<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
">
<td><?php echo $this->_tpl_vars['refNumber']; ?>
</td>
<td><?php if ($this->_tpl_vars['v']['name'] == ""): ?>&nbsp;<?php else:  echo $this->_tpl_vars['v']['name'];  endif; ?></td>
<td><?php echo $this->_tpl_vars['currency']; ?>


<?php if ($this->_tpl_vars['v']['amountCollected'] == ''): ?>
	<input onchange="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))" type="number" placeholder="0.00" id="amountCollected_<?php echo $this->_tpl_vars['id']; ?>
" name="amountCollected_<?php echo $this->_tpl_vars['id']; ?>
" size="6" value="">
<?php else: ?>
	<input onchange="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))" type="number" placeholder="0.00" id="amountCollected_<?php echo $this->_tpl_vars['id']; ?>
" name="amountCollected_<?php echo $this->_tpl_vars['id']; ?>
" size="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['amountCollected'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
">
<?php endif; ?>

</td>
<td><?php echo $this->_tpl_vars['currency']; ?>
<div id="commissions_<?php echo $this->_tpl_vars['id']; ?>
" class="dataEntryField"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['commissions'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</div></td>
<td><?php echo $this->_tpl_vars['currency']; ?>
<div id="charity_<?php echo $this->_tpl_vars['id']; ?>
" class="dataEntryField"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</div></td>
<td><input type="text" size="15" id="notes_<?php echo $this->_tpl_vars['id']; ?>
" name="notes_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['v']['notes']; ?>
" onchange="xajax_ProcessForm('','MachineEntry2', xajax.getFormValues('machineEntryForm'))"></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr class="totals">
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
</table>

	
	
	
	