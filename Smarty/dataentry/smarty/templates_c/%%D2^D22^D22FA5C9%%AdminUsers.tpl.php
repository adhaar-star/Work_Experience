<?php /* Smarty version 2.6.16, created on 2017-02-27 11:05:51
         compiled from AdminUsers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'query_encode', 'AdminUsers.tpl', 1, false),)), $this); ?>
<input type="button" class="clickable" value="New User" onclick="xajax_RefreshElement('userEditForm','StaffEdit','<?php echo SmartyQueryEncode(array('data' => 0), $this);?>
');xajax_ShowDiv('userEditArea');">
<div id="userEditArea" style="display:none">
<div class="sectionHeading">User Details</div>
<div class="section">
<?php echo $this->_tpl_vars['userdetails']; ?>

</div>

</div>
<h1>User List</h1>
<div id="staffTable">
<?php echo $this->_tpl_vars['userlist']; ?>

</div>
