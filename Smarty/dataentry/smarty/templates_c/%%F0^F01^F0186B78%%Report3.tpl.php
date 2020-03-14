<?php /* Smarty version 2.6.16, created on 2014-12-17 10:41:32
         compiled from Report3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'Report3.tpl', 8, false),array('modifier', 'string_format', 'Report3.tpl', 15, false),)), $this); ?>
<h1>Upcoming Service</h1>
<h2><?php if ($this->_tpl_vars['siteType'] == ""): ?>All<?php else:  echo $this->_tpl_vars['siteType'];  endif; ?> Sites Due For Service <?php if ($this->_tpl_vars['weeksUntilServiceNeeded'] == 0): ?>Now<?php else: ?>in <?php echo $this->_tpl_vars['weeksUntilServiceNeeded']; ?>
 Week<?php if ($this->_tpl_vars['weeksUntilServiceNeeded'] > 1): ?>s<?php endif;  endif; ?></h2>
<table class="dataTable" cellspacing="0" width="100%">
<tr>
<th>Site No.</th><th>Site Name</th><th>Site Address</th><th>Opening Time</th><th>Machine No.</th><th>Machine Name</th><th>Weeks Since Last Service</th><th>Last Service</th><th>Notes From Last Visit</th>
</tr>
<?php $_from = $this->_tpl_vars['tableData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rowData']):
?>
<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
">
<td><?php echo $this->_tpl_vars['rowData']['type'];  echo $this->_tpl_vars['rowData']['siteNum']; ?>
</td>
<td><?php if ($this->_tpl_vars['rowData']['name'] != ""):  echo $this->_tpl_vars['rowData']['name'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['address'] != ""):  echo $this->_tpl_vars['rowData']['address'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php echo $this->_tpl_vars['rowData']['openingTime']; ?>
</td>
<td><?php if ($this->_tpl_vars['rowData']['machNum'] != ""):  echo $this->_tpl_vars['rowData']['machNum'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['machineName'] != ""):  echo $this->_tpl_vars['rowData']['machineName'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['weeksSinceService'] != ""):  echo ((is_array($_tmp=$this->_tpl_vars['rowData']['weeksSinceService'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f"));  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['date'] != ""):  echo $this->_tpl_vars['rowData']['date'];  else: ?>&nbsp;<?php endif; ?></td>
<td><?php if ($this->_tpl_vars['rowData']['notes'] != ""):  echo $this->_tpl_vars['rowData']['notes'];  else: ?>&nbsp;<?php endif; ?></td>
</tr>
<?php endforeach; endif; unset($_from); ?>

</table>