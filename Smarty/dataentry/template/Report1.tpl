<h1>Total Takings</h1>
<h2>June {$year} to May {$year+1} - {if $siteType==""}All Machines{else}{$siteType} Machines{/if}</h2>
<table class="dataTable" cellspacing="0" width="100%">
<tr>
<th>Period No.</th><th>Period Dates</th><th>Total Takings</th><th>Total Charity</th><th>Total Commission</th><th>+/- Previous Period</th><th>+/- Previous Year</th><th>Avg. Monthly Takings</th>
</tr>
{foreach from=$tableData item=rowData}
<tr class="row{cycle values="0,1"}">
<td>{$rowData.period}</td>
<td>{$rowData.periodText}</td>
<td>{$currency}{$rowData.amountCollected|string_format:"%.2f"}</td>
<td>{$currency}{$rowData.charity|string_format:"%.2f"}</td>
<td>{$currency}{$rowData.commissions|string_format:"%.2f"}</td>
<td>{$currency}{$rowData.prevPeriodChange|string_format:"%.2f"}</td>
<td>{$currency}{$rowData.prevYearChange|string_format:"%.2f"}</td>
<td>{$currency}{$rowData.avgMonthTakings|string_format:"%.2f"}</td>
</tr>
{/foreach}
<tr class="totals">
<td colspan="2">Totals</td>
<td>{$currency}{$totals.amountCollected|string_format:"%.2f"}</td>
<td>{$currency}{$totals.charity|string_format:"%.2f"}</td>
<td>{$currency}{$totals.commissions|string_format:"%.2f"}</td>
<td>{$currency}{$totals.prevPeriodChange|string_format:"%.2f"}</td>
<td>{$currency}{$totals.prevYearChange|string_format:"%.2f"}</td>
<td>{$currency}{$totals.avgMonthTakings|string_format:"%.2f"}</td>
</tr>
</table>