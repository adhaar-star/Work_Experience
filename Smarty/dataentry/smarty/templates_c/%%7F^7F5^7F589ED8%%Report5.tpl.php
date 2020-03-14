<?php /* Smarty version 2.6.16, created on 2017-02-28 05:42:23
         compiled from Report5.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'Report5.tpl', 8, false),array('modifier', 'string_format', 'Report5.tpl', 13, false),)), $this); ?>
<h1>Charity Report</h1>
<h2>June <?php echo $this->_tpl_vars['year']; ?>
 to May <?php echo $this->_tpl_vars['year']+1; ?>
 - <?php if ($this->_tpl_vars['siteType'] == ""): ?>All Machines<?php else:  echo $this->_tpl_vars['siteType']; ?>
 Machines<?php endif; ?></h2>
<table class="dataTable" cellspacing="0" width="100%">
<tr>
<th>Period No.</th><th>Period Dates</th><th>Charity & Amount</th><th>Total Charity Amount</th>
</tr>
<?php $_from = $this->_tpl_vars['tableData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rowData']):
?>
<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
">
<td valign="top"><?php echo $this->_tpl_vars['rowData']['period']; ?>
</td>
<td valign="top"><?php echo $this->_tpl_vars['rowData']['periodText']; ?>
</td>
<td valign="top" style="padding: 0px; border-left:none; border-top:none"><?php $_from = $this->_tpl_vars['rowData']['charityData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['charData'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['charData']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['charName'] => $this->_tpl_vars['charAmount']):
        $this->_foreach['charData']['iteration']++;
 if (($this->_foreach['charData']['iteration'] <= 1)): ?><table cellpadding="0" cellspacing="0" class="dataTable" width="100%"><?php endif; ?>
<tr><td><?php echo $this->_tpl_vars['charName']; ?>
</td><td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['charAmount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php if (($this->_foreach['charData']['iteration'] == $this->_foreach['charData']['total'])): ?></table><?php endif;  endforeach; else: ?>
&nbsp;
<?php endif; unset($_from); ?>
</td>
<td valign="top"><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['rowData']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr class="totals">
<td colspan="3">Totals</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['totals']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
</tr>
</table>