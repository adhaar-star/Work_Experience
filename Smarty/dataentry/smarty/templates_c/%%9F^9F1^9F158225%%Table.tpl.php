<?php /* Smarty version 2.6.16, created on 2017-02-28 11:35:14
         compiled from Table.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'Table.tpl', 10, false),)), $this); ?>
<table class="dataTable" width="100%" cellspacing="0">
<tr>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<th onclick="xajax_RefreshElement('<?php echo $this->_tpl_vars['divName']; ?>
','<?php echo $this->_tpl_vars['className']; ?>
','<?php echo $this->_tpl_vars['fieldSort'][$this->_tpl_vars['k']]; ?>
')"<?php if ($this->_tpl_vars['curField'] == $this->_tpl_vars['k']): ?> class="activeColumn"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</th>
<?php endforeach; endif; unset($_from); ?>
<th width="46"><img src="images/spacer.gif" width="32" height="1"></th>
</tr>
<?php $_from = $this->_tpl_vars['rowData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
 $this->assign('id', $this->_tpl_vars['v']['id']); ?>
<tr class="row<?php echo smarty_function_cycle(array('values' => "0,1"), $this);?>
">

<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['fieldname']):
?>

<td><?php if ($this->_tpl_vars['v'][$this->_tpl_vars['field']] == ""): ?>&nbsp;<?php endif;  echo $this->_tpl_vars['v'][$this->_tpl_vars['field']]; ?>
</td>
<?php endforeach; endif; unset($_from); ?>
<td valign="middle" align="center" width="46"><img title="Edit" alt="Edit" src="images/edit.png" class="clickable" onclick="xajax_RefreshElement('<?php echo $this->_tpl_vars['editDiv']; ?>
','<?php echo $this->_tpl_vars['editClass']; ?>
','<?php echo $this->_tpl_vars['editData'][$this->_tpl_vars['id']]; ?>
');xajax_ShowDiv('<?php echo $this->_tpl_vars['areaDiv']; ?>
');">
<img title="Delete" alt="Delete" src="images/delete.png" class="clickable" onclick="xajax_DeleteItem('<?php echo $this->_tpl_vars['tableName']; ?>
','<?php echo $this->_tpl_vars['v']['id']; ?>
', '<?php echo $this->_tpl_vars['divName']; ?>
', '<?php echo $this->_tpl_vars['className']; ?>
')"></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php if ($this->_tpl_vars['newButton'] != ""): ?>
<input type="button" class="clickable" value="<?php echo $this->_tpl_vars['newButton']; ?>
" onclick="xajax_RefreshElement('<?php echo $this->_tpl_vars['editDiv']; ?>
','<?php echo $this->_tpl_vars['editClass']; ?>
','<?php echo $this->_tpl_vars['newData']; ?>
');xajax_ShowDiv('<?php echo $this->_tpl_vars['areaDiv']; ?>
');">
<?php endif; ?>