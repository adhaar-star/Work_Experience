<div id="reportOptions"><form id="reportsForm" onsubmit="return false;">
<input type="hidden" name="report" value="{$report}">
	<input type="hidden" name="newsubmenu" value="no">
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
<div id="reportArea"></div>

