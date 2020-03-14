
<form id="machineEntryForm" onsubmit="return false;">
<input type="hidden" name="site" value="{$siteID}">
<input type="hidden" name="lastDate" id="lastDate" value="{$date}">
<div class="subsection">Date of Entry: {$dateSelect}<input type="button" value="Update" class="clickable" onclick="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))"></div>
<table class="dataTable" width="100%" cellspacing="0">
<tr>
<th>#</th><th>Machine Name</th><th>Amount</th><th>Commissions</th><th>Charity</th><th>Notes</th>
</tr>

{foreach from=$machines item=v}
{assign var='id' value=$v.id}
{assign var='refNumber' value=$v.refNumber}
{assign var='amount' value=$v.amountCollected}
{assign var='notes' value=$v.notes}
<tr class="row{cycle values="0,1"}">
<td>{$refNumber}</td>
<td>{if $v.name==""}&nbsp;{else}{$v.name}{/if}</td>
<td>{$currency}

{if $v.amountCollected eq ''}
	<input onchange="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))" type="number" placeholder="0.00" id="amountCollected_{$id}" name="amountCollected_{$id}" size="6" value="">
{else}
	<input onchange="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))" type="number" placeholder="0.00" id="amountCollected_{$id}" name="amountCollected_{$id}" size="6" value="{$v.amountCollected|string_format:"%.2f"}">
{/if}

</td>
<td>{$currency}<div id="commissions_{$id}" class="dataEntryField">{$v.commissions|string_format:"%.2f"}</div></td>
<td>{$currency}<div id="charity_{$id}" class="dataEntryField">{$v.charity|string_format:"%.2f"}</div></td>
<td><input type="text" size="15" id="notes_{$id}" name="notes_{$id}" value="{$v.notes}" onchange="xajax_ProcessForm('','MachineEntry2', xajax.getFormValues('machineEntryForm'))"></td>
</tr>
{/foreach}
<tr class="totals">
<td colspan="2">Totals</td>
<td>{$currency}<div id="amountCollectedTotal" class="dataEntryField">{$totals.amountCollected|string_format:"%.2f"}</div></td>
<td>{$currency}<div id="commissionsTotal" class="dataEntryField">{$totals.commissions|string_format:"%.2f"}</div></td>
<td>{$currency}<div id="charityTotal" class="dataEntryField">{$totals.charity|string_format:"%.2f"}</div></td>
<td>&nbsp;</td>
</tr>
</table>

	</form>
<input type="submit" value="Update" class="clickable" onclick="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'));xajax_ShowButton('printmachinedetails');xajax_HideDiv('printmachinedetails');">
<input type="button" value="Done" class="clickable" onclick="xajax_ProcessForm('','MachineEntry2', xajax.getFormValues('machineEntryForm'));xajax_HideDiv('dataDetailsArea');document.getElementById('siteEntryForm').refNumber.select()">
<input class="btn blue" style="margin: 10px 0;display:none;" type="button" id="printmachinedetails" value="Print" onclick="window.print();"/>



<table class="dataTable2 " width="100%" id='datatable2' style="display:none;" cellspacing="0">
<tr>
<th>#</th><th>Machine Name</th><th>Amount</th><th>Commissions</th><th>Charity</th><th>Notes</th>
</tr>

{foreach from=$machines item=v}
{assign var='id' value=$v.id}
{assign var='refNumber' value=$v.refNumber}
{assign var='amount' value=$v.amountCollected}
{assign var='notes' value=$v.notes}
<tr class="row{cycle values="0,1"}">
<td>{$refNumber}</td>
<td>{if $v.name==""}&nbsp;{else}{$v.name}{/if}</td>
<td>{$currency}

{if $v.amountCollected eq ''}
	<input onchange="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))" type="number" placeholder="0.00" id="amountCollected_{$id}" name="amountCollected_{$id}" size="6" value="">
{else}
	<input onchange="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))" type="number" placeholder="0.00" id="amountCollected_{$id}" name="amountCollected_{$id}" size="6" value="{$v.amountCollected|string_format:"%.2f"}">
{/if}

</td>
<td>{$currency}<div id="commissions_{$id}" class="dataEntryField">{$v.commissions|string_format:"%.2f"}</div></td>
<td>{$currency}<div id="charity_{$id}" class="dataEntryField">{$v.charity|string_format:"%.2f"}</div></td>
<td><input type="text" size="15" id="notes_{$id}" name="notes_{$id}" value="{$v.notes}" onchange="xajax_ProcessForm('','MachineEntry2', xajax.getFormValues('machineEntryForm'))"></td>
</tr>
{/foreach}
<tr class="totals">
<td colspan="2">Totals</td>
<td>{$currency}<div id="amountCollectedTotal" class="dataEntryField">{$totals.amountCollected|string_format:"%.2f"}</div></td>
<td>{$currency}<div id="commissionsTotal" class="dataEntryField">{$totals.commissions|string_format:"%.2f"}</div></td>
<td>{$currency}<div id="charityTotal" class="dataEntryField">{$totals.charity|string_format:"%.2f"}</div></td>
<td>&nbsp;</td>
</tr>
</table>

	
	
	
	