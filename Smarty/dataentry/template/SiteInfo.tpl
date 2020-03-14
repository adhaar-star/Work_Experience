
<div class="subsection">
<table width="100%"><tr><td>

<table>
<tr><td>Site Number</td><td>{$siteData.type}{$siteData.refNumber|string_format:"%4s"}</td></tr>
<tr><td>Site Name</td><td>{$siteData.name}</td></tr>
<tr><td valign="top">Address</td><td>{$siteData.address|nl2br}</td></tr>
<tr><td>Contact</td><td>{$siteData.contact}</td></tr>
<tr><td>Phone</td><td>{$siteData.phone}</td></tr>
<tr><td>Status</td><td>{if $siteData.inactive == 1}Inactive{else}Active{/if}</td></tr>
<tr><td>Opening Time</td><td>{$siteData.openingTime}</td></tr>
</table>

</td><td valign="top" align="right">
{if $edit==true}
<input type="button" value="Edit Site Information" class="clickable" onclick="xajax_RefreshElement('siteEditForm','SiteEdit','{$editSiteData}');xajax_ShowDiv('siteEditArea');">
<input type="button" class="clickable" value="New Vending Machine" onclick="xajax_RefreshElement('machEditForm','MachEdit','{$newMachData}');xajax_ShowDiv('machEditArea');">
{/if}
</td></tr></table>
<script>
	
	
	</script>
</div>