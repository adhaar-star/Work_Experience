<form id="charityEditForm" onsubmit="return false;">

<table class="formTable">
<input type="hidden" name="id" value="{$charitydata.id}">
<tr><td class="formLabel">Charity Name</td><td><input type="text" name="name" value="{$charitydata.name}"></td></tr>
<tr><td colspan="2"><input type="submit" value="Save Charity" onclick="xajax_ProcessForm('charityEditArea','CharityEdit', xajax.getFormValues('charityEditForm'))" >
<input type="button" value="Cancel" onclick="document.getElementById('charityEditArea').style.display='none';"></td></tr>

</table>
</form>
