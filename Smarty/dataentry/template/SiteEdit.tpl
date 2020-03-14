<table class="formTable">
<input type="hidden" name="id" value="{$sitedata.id}">
<tr><td class="formLabel">Reference Number</td>
<td>{foreach from=$siteTypes item=type}<input style="width:25px;height: 25px;" type="radio" name="type" value="{$type}"{if $type==$sitedata.type} checked{/if} >{$type}
{/foreach}<br>
 <input type="text" name="refNumber" value="{$sitedata.refNumber}" size="6"></td></tr>
<tr><td class="formLabel">Site Name</td><td><input type="text" name="name" value="{$sitedata.name}"></td></tr>

<tr><td class="formLabel" valign="top">Address</td><td><textarea name="address">{$sitedata.address}</textarea></td></tr>
<tr><td class="formLabel">Contact Name</td><td><input type="text" name="contact" value="{$sitedata.contact}"></td></tr>
<tr><td class="formLabel">Contact Phone</td><td><input type="text" name="phone" value="{$sitedata.phone}"></td></tr>
<tr><td class="formLabel">Site Status</td><td><select name="inactive">
{foreach from=$inactiveOpts item=text key=val}
<option value="{$val}"{if $val==$sitedata.inactive} SELECTED{/if}>{$text}</option>
{/foreach}</select></td></tr>
<tr><td class="formLabel">Opening Time</td><td><input type="text" name="openingTime" value="{$sitedata.openingTime}"></td></tr>
<tr><td colspan="2"><input type="submit" value="Save Site" onclick="xajax_ProcessForm('siteEditArea','SiteEdit', xajax.getFormValues('siteEditForm'))" >
<input type="button" value="Cancel" onclick="document.getElementById('siteEditArea').style.display='none';"></td></tr>


</table>
