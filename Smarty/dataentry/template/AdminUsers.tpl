<input type="button" class="clickable" value="New User" onclick="xajax_RefreshElement('userEditForm','StaffEdit','{query_encode data=0}');xajax_ShowDiv('userEditArea');">
<div id="userEditArea" style="display:none">
<div class="sectionHeading">User Details</div>
<div class="section">
{$userdetails}
</div>

</div>
<h1>User List</h1>
<div id="staffTable">
{$userlist}
</div>

