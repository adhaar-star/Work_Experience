
<div class="subsection sitedetails">
<input type="hidden" name="site" value="{$siteID}">
<input type="hidden" name="lastDate" id="lastDate" value="{$date}">
<!--<div class="subsection">Date of Entry: {$dateSelect}<input type="button" value="Update" class="clickable" onclick="xajax_ProcessForm('','MachineEntry', xajax.getFormValues('machineEntryForm'))"></div>-->

	<!--<table class="dataTable4" width="100%" cellspacing="0" align="right">
<tr>
<th>#</th><th>Machine Name</th><th>Amount</th><th>Commissions</th><th>Charity</th><th>Notes</th>
</tr>
<tr><td>Machine Name</td><td>{$siteData.type}{$siteData.refNumber|string_format:"%4s"}</td></tr>

{foreach from=$machines item=v}
{assign var='id' value=$v.id}
{assign var='refNumber' value=$v.refNumber}
{assign var='amount' value=$v.amountCollected}
{assign var='notes' value=$v.notes}
<div style="height:10px;">
	</div>		
<tr class="row{cycle values="0,1"}" style="margin-top:50px;">
<tr><td>Machine Name</td><td>{if $v.name==""}&nbsp;{else}{$v.name}{/if}</td></tr>
<tr><td>Total Takings-</td><td>{$currency}{if $v.amountCollected eq ''}0.00
{else}{$v.amountCollected|string_format:"%.2f"}{/if}</td></tr>
<tr><td>Commission Due-</td><td>{$currency}{$v.commissions|string_format:"%.2f"}</td></tr>
<tr><td>Charity Amount-</td><td>{$currency}{$v.charity|string_format:"%.2f"}</td></tr>
<tr><td>Notes<td><td>{$v.notes}</td></tr>
		
{/foreach}
<!--<tr class="totals">
<td colspan="2">Totals</td>
<td>{$currency}<div id="amountCollectedTotal" class="dataEntryField">{$totals.amountCollected|string_format:"%.2f"}</div></td>
<td>{$currency}<div id="commissionsTotal" class="dataEntryField">{$totals.commissions|string_format:"%.2f"}</div></td>
<td>{$currency}<div id="charityTotal" class="dataEntryField">{$totals.charity|string_format:"%.2f"}</div></td>
<td>&nbsp;</td>
</tr>
</table>-->
{foreach from=$machines item=v}
{assign var='id' value=$v.id}
{assign var='refNumber' value=$v.refNumber}
{assign var='amount' value=$v.amountCollected}
{assign var='notes' value=$v.notes}
<div style="height:10px;">
	</div>
<div class="machinedetails" style="font-size:20px;margin-left:4%;">
Machine Name-{if $v.name==""}&nbsp;{else}{$v.name}{/if}<br>
Total Takings-{$currency}{if $v.amountCollected eq ''}0.00
{else}{$v.amountCollected|string_format:"%.2f"}{/if}<br>
Commission Due-{$currency}{$v.commissions|string_format:"%.2f"}<br>
Charity Amount-{$currency}{$totals.charity|string_format:"%.2f"}<br>
Notes-{$v.notes}	
</div>
{/foreach}	
<input class="btn blue" style="margin: 10px 50px;display:block;" type="button" id="printmachinedetails" value="Print" onclick="window.print();"/>



</div>
	
	
	
	