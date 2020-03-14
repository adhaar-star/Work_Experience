<?php /* Smarty version 2.6.16, created on 2017-02-27 10:26:32
         compiled from StaffEdit.tpl */ ?>
<form id="userEditForm" onsubmit="return false;">

<table class="formTable">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['userdata']['id']; ?>
">
<tr><td class="formLabel">Full Name</td><td><input type="text" name="fullName" value="<?php echo $this->_tpl_vars['userdata']['fullName']; ?>
"></td></tr>
<tr><td class="formLabel">Username</td><td><input type="text" name="username" value="<?php echo $this->_tpl_vars['userdata']['username']; ?>
"></td></tr>
<tr><td class="formLabel">Email</td><td><input type="text" name="email" value="<?php echo $this->_tpl_vars['userdata']['email']; ?>
"></td></tr>
<tr><td class="formLabel">New Password</td><td><input type="password" name="password1"></td></tr>
<tr><td class="formLabel">New Password(Again)</td><td><input type="password" name="password2"></td></tr>
<tr><td class="formLabel">Access Level</td><td><input type="text" name="level" value="<?php echo $this->_tpl_vars['userdata']['level']; ?>
"></td></tr>
<tr><td colspan="2"><input type="submit" value="Save User" onclick="xajax_ProcessForm('userEditArea','StaffEdit', xajax.getFormValues('userEditForm'))" >
<input type="button" value="Cancel" onclick="document.getElementById('userEditArea').style.display='none';"></td></tr>

</table>
</form>