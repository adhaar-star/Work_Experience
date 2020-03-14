
<div class="subsection sitedetails">


<!--<table class="dataTable4">
<tr><td>Site Number</td><td>{$siteData.type}{$siteData.refNumber|string_format:"%4s"}</td></tr>
<tr><td>Site Name</td><td>{$siteData.name}</td></tr>
<tr><td>Date</td><td>{ $later|date_format:'%d/%m/%Y'}
 </td></tr>
<tr><td>Time</td><td>{ $later|date_format:'%H:%M:%S'}</td></tr>
<tr><td>Rep</td><td>{$username}</td></tr>
</table>-->
<div style="height:10px;">
	</div>
<div id="sitedetails1" style="font-size:20px;margin-left:4%;">
Site No:{$siteData.refNumber|string_format:"%4s"}<br>
Site Name:{$siteData.name}<br>
DATE:{ $later|date_format:'%d/%m/%Y'}<br>
TIME:{ $later|date_format:'%H:%M:%S'}<br>
Rep:{$username}
</div>

