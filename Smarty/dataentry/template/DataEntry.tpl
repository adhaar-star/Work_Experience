<div class="sectionHeading sectionHeading1 ">Select Site</div>
<div class="section">
<form name="siteEntry" id="siteEntryForm" onsubmit="return false;">
<input type="hidden" name="siteType" value="{$siteType}">
<span class="siteTxt">Site Number: {$siteType}</span> <input type="number" name="refNumber" class="txtBox"> <input type="submit" value="Go" onclick="xajax_ProcessForm('machEditArea','DataEntry', xajax.getFormValues('siteEntryForm'))" class="btn blue">
	</form>
</div>
<div id="dataDetailsArea" style="display:none">

<div class="sectionHeading">Site Details</div>
<div class="print_btn"><input class="btn blue" style="margin: 10px 0;" type="button" value="Print" onclick="window.print();" /></div>
<div id="siteInfo"></div>
<br>
<div id="machineEntry"></div>
</div>
