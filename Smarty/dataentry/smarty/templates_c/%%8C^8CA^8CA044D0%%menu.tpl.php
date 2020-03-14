<?php /* Smarty version 2.6.16, created on 2017-03-07 11:32:01
         compiled from menu.tpl */ ?>
<?php $_from = $this->_tpl_vars['menuNotices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<div class="menuNotice"><?php echo $this->_tpl_vars['v']; ?>
</div>

<?php endforeach; endif; unset($_from);  $_from = $this->_tpl_vars['menuItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<div id="menu<?php echo $this->_tpl_vars['menuNumber']; ?>
_<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['k'] == 0): ?>activeMenuItem<?php else: ?>menuItem<?php endif; ?>" onclick="changeMenu(<?php echo $this->_tpl_vars['menuNumber']; ?>
,<?php echo $this->_tpl_vars['k']; ?>
);xajax_LoadPage('<?php echo $this->_tpl_vars['v']['page']; ?>
','<?php echo $this->_tpl_vars['v']['query']; ?>
',<?php echo $this->_tpl_vars['v']['reload']; ?>
)"><?php if ($this->_tpl_vars['v']['image'] != ""): ?><img src="<?php echo $this->_tpl_vars['v']['image']; ?>
" border="0" align="top"> <?php endif;  echo $this->_tpl_vars['v']['name']; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
