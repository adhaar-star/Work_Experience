<style type="text/css">
	.export_pdf tr td{
	font-size:8px;
	text-align:center;
}

.export_pdf_hedding td{
	border:0;font-size:12px !important;background-color:#000;color:#ffffff;padding:10px;
}
</style>
<div class="container">
	<div style="background-color:#38354A"><img src="http://<?php echo $_SERVER['SERVER_NAME'].'/PPMHUB/public/vendors/common/img/ppm_logo.png' ?>" alt="PPM HUB" style="width:100px"/></div>
	<h2>Project Report: Timesheet Report</h2>
	<table class="export_pdf">
		<tr class="export_pdf_hedding">
			<td>Project ID</td>
			<td>Project Description</td>
			<td>Planned Cost</td>
			<td>Actual Cost</td>
			<td>Overall Budget</td>
			<td>Annual Budget</td>
			<td>Avalible Budget</td>
			<td>Resource Costs</td>
			<td>Total Time Entered</td>
			<td>% Of Total Cost</td>
		</tr>
		<?php 
	
		
		foreach($request as $val){ 	 ?>				
			<tr>
				<td><?php echo $val->project_Id ?></td>
				<td><?php echo $val->project_desc ?></td>	
				<td>-</td>	
				<td><?php echo $val->actuall_cost ?></td>															
				<td><?php echo $val->budget_org_overall ?></td>															
				<td>
				<?php
				if(isset($val->budget_org_overall) && isset($val->budget_return_overall) && isset($val->budget_supplement_overall)){
				echo ($val->budget_org_overall + $val->budget_supplement_overall) - $val->budget_return_overall; 
				}									
				?>
				</td>															
				<td>-</td>														

				<td>-</td>  

				<td>-</td>
				<td>
				-
				</td>  				
			</tr>
		<?php 	} ?>
	</table>
</div>