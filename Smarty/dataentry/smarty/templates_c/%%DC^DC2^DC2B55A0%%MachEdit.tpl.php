<?php /* Smarty version 2.6.16, created on 2017-02-28 06:51:31
         compiled from MachEdit.tpl */ ?>
<table class="formTable">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['machineData']['id']; ?>
">
<input type="hidden" name="site" value="<?php echo $this->_tpl_vars['site']; ?>
">
<tr><td class="formLabel">Site</td><td><?php echo $this->_tpl_vars['siteData']['type'];  echo $this->_tpl_vars['siteData']['refNumber']; ?>
 - <?php echo $this->_tpl_vars['siteData']['name']; ?>
</td></tr>

<tr><td class="formLabel">Machine Number</td><td><input type="text" name="refNumber" value="<?php echo $this->_tpl_vars['machineData']['refNumber']; ?>
" size="4"></td></tr>
<tr><td class="formLabel">Machine Name</td><td><input type="text" name="name" value="<?php echo $this->_tpl_vars['machineData']['name']; ?>
" size="15"></td></tr>
<tr><td class="formLabel">Commission Rate</td><td><input type="text" name="commissionRate" value="<?php echo $this->_tpl_vars['machineData']['commissionRate']; ?>
" size="4">%</td></tr>
<tr><td class="formLabel">Coin Accepted</td><td><select name="coinValue">
<?php $_from = $this->_tpl_vars['coinValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['coinVal'] => $this->_tpl_vars['coinText']):
?>
<option value="<?php echo $this->_tpl_vars['coinVal']; ?>
"<?php if ($this->_tpl_vars['charID'] == $this->_tpl_vars['machineData']['coinVal']): ?> SELECTED<?php endif; ?>><?php echo $this->_tpl_vars['coinText']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></td></tr>

<tr><td class="formLabel">Charity</td><td><select name="charity">
<?php $_from = $this->_tpl_vars['charities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['charID'] => $this->_tpl_vars['charName']):
?>
<option value="<?php echo $this->_tpl_vars['charID']; ?>
"<?php if ($this->_tpl_vars['charID'] == $this->_tpl_vars['machineData']['charity']): ?> SELECTED<?php endif; ?>><?php echo $this->_tpl_vars['charName']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></td></tr>
<tr><td class="formLabel">Charity Rate</td><td><input type="text" name="charityRate" value="<?php echo $this->_tpl_vars['machineData']['charityRate']; ?>
" size="4">%</td></tr>
<tr><td class="formLabel">Installation Date</td><td><?php echo $this->_tpl_vars['installDateField']; ?>
</td></tr>
<tr><td class="formLabel">Weeks between servicing</td><td><select name="weeksToService">
<?php $_from = $this->_tpl_vars['serviceWeeks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['weekVal']):
?>
<option value="<?php echo $this->_tpl_vars['weekVal']; ?>
"<?php if ($this->_tpl_vars['weekVal'] == $this->_tpl_vars['machineData']['weeksToService']): ?> SELECTED<?php endif; ?>><?php echo $this->_tpl_vars['weekVal']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></td></tr>
<tr><td class="formLabel">Machine Status</td><td><select name="inactive">
<?php $_from = $this->_tpl_vars['inactiveOpts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val'] => $this->_tpl_vars['text']):
?>
<option value="<?php echo $this->_tpl_vars['val']; ?>
"<?php if ($this->_tpl_vars['val'] == $this->_tpl_vars['machineData']['inactive']): ?> SELECTED<?php endif; ?>><?php echo $this->_tpl_vars['text']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select></td></tr>
<tr><td colspan="2"><input type="submit" value="Save Vending Machine" onclick="xajax_ProcessForm('machEditArea','MachEdit', xajax.getFormValues('machEditForm'))" >
<input type="button" value="Cancel" onclick="document.getElementById('machEditArea').style.display='none';"></td></tr>

</table>