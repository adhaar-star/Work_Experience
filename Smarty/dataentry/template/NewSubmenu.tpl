
<div id="reportOptions"><form id="reportsForm" onsubmit="return false;">
<input type="hidden" name="report" value="4">
	<input type="hidden" name="newsubmenu" value="yes">

{if $dateSelect!=""}Report Date:{/if}{$dateSelect} Site Type:<select name="siteType"><option value="">TVR + MVN</option><option value="TVR">TVR</option><option value="MVN">MVN</option></select>
{if $report==4}Status: <select name="inactive">
{foreach from=$inactiveOpts item=text key=val}
<option value="{$val}">{$text}</option>
{/foreach}</select>{/if}
{if $report==3}Machines Due For Service<select name="weeksToService">
{foreach from=$weeksToServiceOpts item=text key=val}
<option value="{$val}">{$text}</option>
{/foreach}
</select>
{/if}
<input class="btn blue" type="submit" value="Go" onclick="xajax_ProcessForm('', 'Reports', xajax.getFormValues('reportsForm'))">
	</form>
</div>




<table class="dataTable dataprintdetails" cellspacing="0" width="100%">

{foreach from=$tableData item=rowData}
<tr class="row{cycle values="0,1"}">
<td>{$rowData.type}{$rowData.refNumber}</td>
<td>{if $rowData.name!=""}{$rowData.name}{else}&nbsp;{/if}</td>
<td>{if $rowData.address!=""}{$rowData.address}{else}&nbsp;{/if}</td>
<td>{if $rowData.contact!=""}{$rowData.contact}{else}&nbsp;{/if}</td>
<td>{if $rowData.phone!=""}{$rowData.phone}{else}&nbsp;{/if}</td>

{/foreach}
</table>

<div id="reportArea">


</div>

