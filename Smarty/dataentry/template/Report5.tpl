<h1>Charity Report</h1>
<h2>June {$year} to May {$year+1} - {if $siteType==""}All Machines{else}{$siteType} Machines{/if}</h2>
<table class="dataTable" cellspacing="0" width="100%">
<tr>
<th>Period No.</th><th>Period Dates</th><th>Charity & Amount</th><th>Total Charity Amount</th>
</tr>
{foreach from=$tableData item=rowData}
<tr class="row{cycle values="0,1"}">
<td valign="top">{$rowData.period}</td>
<td valign="top">{$rowData.periodText}</td>
<td valign="top" style="padding: 0px; border-left:none; border-top:none">{foreach from=$rowData.charityData item=charAmount key=charName name=charData}
{if $smarty.foreach.charData.first}<table cellpadding="0" cellspacing="0" class="dataTable" width="100%">{/if}
<tr><td>{$charName}</td><td>{$currency}{$charAmount|string_format:"%.2f"}</td></tr>
{if $smarty.foreach.charData.last}</table>{/if}
{foreachelse}
&nbsp;
{/foreach}
</td>
<td valign="top">{$currency}{$rowData.charity|string_format:"%.2f"}</td>
</tr>
{/foreach}
<tr class="totals">
<td colspan="3">Totals</td>
<td>{$currency}{$totals.charity|string_format:"%.2f"}</td>
</tr>
</table>