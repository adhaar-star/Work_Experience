<?php /* Smarty version 2.6.16, created on 2017-02-27 08:56:21
         compiled from CharityEdit.tpl */ ?>
<form id="charityEditForm" onsubmit="return false;">

<table class="formTable">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['charitydata']['id']; ?>
">
<tr><td class="formLabel">Charity Name</td><td><input type="text" name="name" value="<?php echo $this->_tpl_vars['charitydata']['name']; ?>
"></td></tr>
<tr><td colspan="2"><input type="submit" value="Save Charity" onclick="xajax_ProcessForm('charityEditArea','CharityEdit', xajax.getFormValues('charityEditForm'))" >
<input type="button" value="Cancel" onclick="document.getElementById('charityEditArea').style.display='none';"></td></tr>

</table>
</form>