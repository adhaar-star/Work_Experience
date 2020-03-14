<table class="formTable">
<input type="hidden" name="id" value="{$machineData.id}">
<input type="hidden" name="site" value="{$site}">
<tr><td class="formLabel">Site</td><td>{$siteData.type}{$siteData.refNumber} - {$siteData.name}</td></tr>

<tr><td class="formLabel">Machine Number</td><td><input type="text" name="refNumber" value="{$machineData.refNumber}" size="4"></td></tr>
<tr><td class="formLabel">Machine Name</td><td><input type="text" name="name" value="{$machineData.name}" size="15"></td></tr>
<tr><td class="formLabel">Commission Rate</td><td><input type="text" name="commissionRate" value="{$machineData.commissionRate}" size="4">%</td></tr>
<tr><td class="formLabel">Coin Accepted</td><td><select name="coinValue">
{foreach from=$coinValues key=coinVal item=coinText}
<option value="{$coinVal}"{if $charID==$machineData.coinVal} SELECTED{/if}>{$coinText}</option>
{/foreach}</td></tr>

<tr><td class="formLabel">Charity</td><td><select name="charity">
{foreach from=$charities key=charID item=charName}
<option value="{$charID}"{if $charID==$machineData.charity} SELECTED{/if}>{$charName}</option>
{/foreach}</td></tr>
<tr><td class="formLabel">Charity Rate</td><td><input type="text" name="charityRate" value="{$machineData.charityRate}" size="4">%</td></tr>
<tr><td class="formLabel">Installation Date</td><td>{$installDateField}</td></tr>
<tr><td class="formLabel">Weeks between servicing</td><td><select name="weeksToService">
{foreach from=$serviceWeeks item=weekVal}
<option value="{$weekVal}"{if $weekVal==$machineData.weeksToService} SELECTED{/if}>{$weekVal}</option>
{/foreach}</td></tr>
<tr><td class="formLabel">Machine Status</td><td><select name="inactive">
{foreach from=$inactiveOpts item=text key=val}
<option value="{$val}"{if $val==$machineData.inactive} SELECTED{/if}>{$text}</option>
{/foreach}</select></td></tr>
<tr><td colspan="2"><input type="submit" value="Save Vending Machine" onclick="xajax_ProcessForm('machEditArea','MachEdit', xajax.getFormValues('machEditForm'))" >
<input type="button" value="Cancel" onclick="document.getElementById('machEditArea').style.display='none';"></td></tr>

</table>
