<input type="button" class="clickable" value="New Site" onclick="xajax_RefreshElement('siteEditForm','SiteEdit','{query_encode data=0}');xajax_ShowDiv('siteEditArea');">

<div id="siteEditArea" style="display:none">
<div class="sectionHeading">Edit Site</div>
<div class="section">
<form id="siteEditForm" onsubmit="return false;">
</form>
</div>
</div>

<div id="machEditArea" style="display:none">
<div class="sectionHeading">Vending Machine Details</div>
<div class="section">
<form id="machEditForm" onsubmit="return false;">
</form>
</div>
</div>

<div id="machListingArea" style="display:none">
<div class="sectionHeading">Site Details</div>
<div class="print_btn"><input class="btn blue" style="margin: 10px 0;" type="button" value="Print" onclick="window.print();" /></div>
<div id="machinesTable">

</div>
</div>

<h1>Site & Machine Management</h1>

<div id="sitesTable" class="print_hide">{$siteListing}</div>
