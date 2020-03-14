<div class="sectionHeading">Select Site</div>
<div class="section">
<form name="siteEntry" id="siteEntryForm" onsubmit="return false;">
<input type="hidden" name="siteType" value="{$siteType}">
Site Number: {$siteType} <input type="text" name="refNumber" size="5"> <input type="submit" value="Go" onclick="xajax_ProcessForm('machEditArea','DataEntry', xajax.getFormValues('siteEntryForm'))">
</form>
</div>

<div id="dataDetailsArea" style="display:none">
<div class="sectionHeading">Site Details</div>
<div id="siteInfo"></div>
<div id="machineEntry"></div>
</div>