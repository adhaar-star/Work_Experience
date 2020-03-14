<?php /* Smarty version 2.6.16, created on 2017-02-27 07:11:00
         compiled from SiteEdit.tpl */ ?>
<table class="formTable">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['sitedata']['id']; ?>
">
<tr><td class="formLabel">Reference Number</td>
<td><?php $_from = $this->_tpl_vars['siteTypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type']):
?><input style="width:25px;height: 25px;" type="radio" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
"<?php if ($this->_tpl_vars['type'] == $this->_tpl_vars['sitedata']['type']): ?> checked<?php endif; ?> ><?php echo $this->_tpl_vars['type']; ?>

<?php endforeach; endif; unset($_from); ?><br>
 <input type="text" name="refNumber" value="<?php echo $this->_tpl_vars['sitedata']['refNumber']; ?>
" size="6"></td></tr>
<tr><td class="formLabel">Site Name</td><td><input type="text" name="name" value="<?php echo $this->_tpl_vars['sitedata']['name']; ?>
"></td></tr>

<tr><td class="formLabel" valign="top">Address</td><td><textarea name="address"><?php echo $this->_tpl_vars['sitedata']['address']; ?>
</textarea></td></tr>
<tr><td class="formLabel">Contact Name</td><td><input type="text" name="contact" value="<?php echo $this->_tpl_vars['sitedata']['contact']; ?>
"></td></tr>
<tr><td class="formLabel">Contact Phone</td><td><input type="text" name="phone" value="<?php echo $this->_tpl_vars['sitedata']['phone']; ?>
"></td></tr>
<tr><td class="formLabel">Site Status</td><td><select name="inactive">
<?php $_from = $this->_tpl_vars['inactiveOpts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val'] => $this->_tpl_vars['text']):
?>
<option value="<?php echo $this->_tpl_vars['val']; ?>
"<?php if ($this->_tpl_vars['val'] == $this->_tpl_vars['sitedata']['inactive']): ?> SELECTED<?php endif; ?>><?php echo $this->_tpl_vars['text']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select></td></tr>
<tr><td class="formLabel">Opening Time</td><td><input type="text" name="openingTime" value="<?php echo $this->_tpl_vars['sitedata']['openingTime']; ?>
"></td></tr>
<tr><td colspan="2"><input type="submit" value="Save Site" onclick="xajax_ProcessForm('siteEditArea','SiteEdit', xajax.getFormValues('siteEditForm'))" >
<input type="button" value="Cancel" onclick="document.getElementById('siteEditArea').style.display='none';"></td></tr>


</table>