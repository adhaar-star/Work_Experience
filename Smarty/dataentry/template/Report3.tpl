<h1>Upcoming Service</h1>
<h2>{if $siteType==""}All{else}{$siteType}{/if} Sites Due For Service {if $weeksUntilServiceNeeded==0}Now{else}in {$weeksUntilServiceNeeded} Week{if $weeksUntilServiceNeeded>1}s{/if}{/if}</h2>
<table class="dataTable" cellspacing="0" width="100%">
<tr>
<th>Site No.</th><th>Site Name</th><th>Site Address</th><th>Opening Time</th><th>Machine No.</th><th>Machine Name</th><th>Weeks Since Last Service</th><th>Last Service</th><th>Notes From Last Visit</th>
</tr>
{foreach from=$tableData item=rowData}
<tr class="row{cycle values="0,1"}">
<td>{$rowData.type}{$rowData.siteNum}</td>
<td>{if $rowData.name!=""}{$rowData.name}{else}&nbsp;{/if}</td>
<td>{if $rowData.address!=""}{$rowData.address}{else}&nbsp;{/if}</td>
<td>{$rowData.openingTime}</td>
<td>{if $rowData.machNum!=""}{$rowData.machNum}{else}&nbsp;{/if}</td>
<td>{if $rowData.machineName!=""}{$rowData.machineName}{else}&nbsp;{/if}</td>
<td>{if $rowData.weeksSinceService!=""}{$rowData.weeksSinceService|string_format:"%.1f"}{else}&nbsp;{/if}</td>
<td>{if $rowData.date!=""}{$rowData.date}{else}&nbsp;{/if}</td>
<td>{if $rowData.notes!=""}{$rowData.notes}{else}&nbsp;{/if}</td>
</tr>
{/foreach}

</table>