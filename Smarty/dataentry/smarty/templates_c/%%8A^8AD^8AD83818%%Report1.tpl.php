<?php /* Smarty version 2.6.16, created on 2017-02-27 10:28:54
         compiled from Report1.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'Report1.tpl', 8, false),array('modifier', 'string_format', 'Report1.tpl', 11, false),)), $this); ?>
<h1>Total Takings</h1>
<h2>June <?php echo $this->_tpl_vars['year']; ?>
 to May <?php echo $this->_tpl_vars['year']+1; ?>
 - <?php if ($this->_tpl_vars['siteType'] == ""): ?>All Machines<?php else:  echo $this->_tpl_vars['siteType']; ?>
 Machines<?php endif; ?></h2>
<table class="dataTable" cellspacing="0" width="100%">
<tr>
<th>Period No.</th><th>Period Dates</th><th>Total Takings</th><th>Total Charity</th><th>Total Commission</th><th>+/- Previous Period</th><th>+/- Previous Year</th><th>Avg. Monthly Takings</th>
</tr>
<?php $_from = $this->_tpl_vars['tableData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rowData']):
?>
<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
">
<td><?php echo $this->_tpl_vars['rowData']['period']; ?>
</td>
<td><?php echo $this->_tpl_vars['rowData']['periodText']; ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['rowData']['amountCollected'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['rowData']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['rowData']['commissions'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['rowData']['prevPeriodChange'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['rowData']['prevYearChange'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['rowData']['avgMonthTakings'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr class="totals">
<td colspan="2">Totals</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['totals']['amountCollected'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['totals']['charity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['totals']['commissions'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['totals']['prevPeriodChange'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['totals']['prevYearChange'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td><?php echo $this->_tpl_vars['currency'];  echo ((is_array($_tmp=$this->_tpl_vars['totals']['avgMonthTakings'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
</tr>
</table>