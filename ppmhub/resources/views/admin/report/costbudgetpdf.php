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
	<h2>Project Report: Cost Budget Report</h2>
	<table class="export_pdf">
		<tr class="export_pdf_hedding">
			<td>Project ID</td>
			<td>Project Description</td>
			<td>Planned Cost</td>
			<td>Actual Cost</td>
			<td>Overall Budget</td>
			<td>Overall Supplement</td>
			<td>Overall Return</td>
			<td>Available Budget</td>
			<td>Value</td>
			<td>Start Date</td>
			<td>End Date</td>
		</tr>
		<?php foreach($request as $value){ ?>				
			<tr>
				<td><?php echo $value->project_Id  ?></td>
				<td><?php echo $value->project_desc  ?></td>
				<td>-</td>
				<td><?php echo $value->actuall_cost  ?></td>
				<td><?php echo $value->budget_org_overall;?></td>				
				<td><?php echo $value->budget_supplement_overall;?></td>				
				<td><?php echo $value->budget_return_overall;?></td>
				<td><?php
				if(isset($value->budget_org_overall) && isset($value->budget_return_overall) && isset($value->budget_supplement_overall)){
				echo ($value->budget_org_overall + $value->budget_supplement_overall) - $value->budget_return_overall; 
				}									
				?></td>
				<td>-</td>
				<td><?php echo $value->p_start_date  ?></td>
				<td><?php echo $value->p_end_date  ?></td>
			</tr>
		<?php 	} ?>
	</table>
</div>