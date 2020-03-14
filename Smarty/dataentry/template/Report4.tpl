{if $newsubmenu=="yes"}

<div id="machEditArea" style="display:none">
<div class="sectionHeading">Vending Machine Details</div>
<div class="section">
<form id="machEditForm" onsubmit="return false;">
</form>
</div>
</div>

<div id="machListingArea" style="display:none">
<div class="sectionHeading">Site Details</div>
<!--<div class="print_btn"><input class="btn blue" style="margin: 10px 0;" type="button" value="Print" onclick="window.print();" /></div>-->
<div id="machinesTable">

</div>
</div>
<div id="dataDetailsArea2" style="display:none">

<div class="sectionHeading">Site Details</div>
<!--<div class="print_btn"><input class="btn blue" style="margin: 10px 0;" type="button" value="Print" onclick="window.print();" /></div>-->
<div id="siteInfo2"></div>
<br>
<div id="machineEntry2"></div>
</div>

<h1>Site NameListing</h1>

<div id="dataprint">
<table class="dataTable" cellspacing="0" width="100%">
<h2>{if $siteType==""}All{else}{$siteType}{/if} {if $inactive}Inactive{else}Active{/if} Sites</h2>	
<tr>
<th>Site No.</th><th>Site Name</th><th>Site Address</th><th>Site Contact</th><th>Site Number</th><th></th>
</tr>
{foreach from=$tableData item=rowData}


<tr class="row{cycle values="0,1"}">
<td>{$rowData.type}{$rowData.refNumber}</td>
<td>{if $rowData.name!=""}{$rowData.name}{else}&nbsp;{/if}</td>
<td>{if $rowData.address!=""}{$rowData.address}{else}&nbsp;{/if}</td>
<td>{if $rowData.contact!=""}{$rowData.contact}{else}&nbsp;{/if}</td>
<td>{if $rowData.phone!=""}{$rowData.phone}{else}&nbsp;{/if}</td>

<td valign="middle" align="center" width="16"><form name="siteEntry" id="siteEntryForm{$rowData.refNumber}" onsubmit="return false;" style="display:block;">
<input type="hidden" name="siteType" value="{$rowData.type}"/>

	
<input type="hidden" name="refNumber" class="txtBox" value="{$rowData.refNumber}"/>	<img title="View" alt="Edit"  src="images/view.png" class="clickable" onclick="xajax_ProcessForm3('machDetails','DataEntry3', xajax.getFormValues('siteEntryForm{$rowData.refNumber}'))" style="width:16px;height16px;">	
<input type="hidden" name="refNumber" class="txtBox" value="{$rowData.refNumber}"/>	<img title="Edit" alt="Edit"  src="images/edit.png" class="clickable" onclick="xajax_ProcessForm3('machDetails','DataEntry2', xajax.getFormValues('siteEntryForm{$rowData.refNumber}'))">
<img title="Delete" alt="Delete" src="images/delete.png" class="clickable" onclick="xajax_DeleteItem('sites','176', 'sitesTable', 'SiteTable')"></form>	</td>
	
</tr>
{/foreach}

</table>
{else}
<h1>Site Listing</h1>
<h2>{if $siteType==""}All{else}{$siteType}{/if} {if $inactive}Inactive{else}Active{/if} Sites</h2>
<table class="dataTable dataprint" cellspacing="0" width="100%">
<tr>
<th>Site No.</th><th>Site Name</th><th>Site Address</th><th>Site Contact</th><th>Site Number</th>
</tr>
{foreach from=$tableData item=rowData}
<tr class="row{cycle values="0,1"}">
<td>{$rowData.type}{$rowData.refNumber}</td>
<td>{if $rowData.name!=""}{$rowData.name}{else}&nbsp;{/if}</td>
<td>{if $rowData.address!=""}{$rowData.address}{else}&nbsp;{/if}</td>
<td>{if $rowData.contact!=""}{$rowData.contact}{else}&nbsp;{/if}</td>
<td>{if $rowData.phone!=""}{$rowData.phone}{else}&nbsp;{/if}</td>

</tr>
{/foreach}

</table>
</div>
{/if}
