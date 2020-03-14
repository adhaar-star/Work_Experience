<input type="button" class="clickable" value="New Charity" onclick="xajax_RefreshElement('charityEditForm','CharityEdit','{query_encode data=0}');xajax_ShowDiv('charityEditArea');">
<div id="charityEditArea" style="display:none">
<div class="sectionHeading">Charity Details</div>
<div class="section">
{$charityDetails}
</div>

</div>
<h1>Charities</h1>
<div id="charitiesTable">
{$charityListing}
</div>

