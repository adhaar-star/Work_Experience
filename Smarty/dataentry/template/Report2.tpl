<h1>Site Takings</h1>
<h2>{$month} {$year} - {if $siteType==""}All{else}{$siteType}{/if} Machines</h2>
<table class="dataTable" cellspacing="0" width="100%">
<tr>
<th>Site No.</th><th>Site Name</th><th>Total Takings</th><th>Total Charity</th><th>Total Commission</th><th>+/- Previous Year</th>
</tr>
{foreach from=$tableData item=rowData}
<tr class="row{cycle values="0,1"}">
<td>{$rowData.siteType}{$rowData.refNumber}</td>
<td>{$rowData.name}</td>
<td>{$currency}{$rowData.amountCollected|string_format:"%.2f"}</td>
<td>{$currency}{$rowData.charity|string_format:"%.2f"}</td>
<td>{$currency}{$rowData.commissions|string_format:"%.2f"}</td>
<td>{$currency}{$rowData.prevYearChange|string_format:"%.2f"}</td>
</tr>
{/foreach}
<tr class="totals">
<td colspan="2">Totals</td>
<td>{$currency}{$totals.amountCollected|string_format:"%.2f"}</td>
<td>{$currency}{$totals.charity|string_format:"%.2f"}</td>
<td>{$currency}{$totals.commissions|string_format:"%.2f"}</td>
<td>{$currency}{$totals.prevYearChange|string_format:"%.2f"}</td>
</tr>
</table>