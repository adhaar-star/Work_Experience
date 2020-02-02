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
	<h2>Project Definition Detail Report</h2>
	<table class="export_pdf">
		<tr class="export_pdf_hedding">
			<td>Project ID</td>
			<td>Project Description</td>
			<td>Portfolio ID</td>
			<td>Portfolio Name</td>
			<td>Bucket ID</td>
			<td>Bucket Name</td>
			<td>Cost Center</td>
			<td>Person Responsible</td>
			<td>Department</td>
			<td>Created On</td>			
			<td>Start Date</td>			
			<td>End Date</td>			
			<td>Status</td>			
		</tr>
		<?php foreach($request as $value){ ?>				
			<tr>
				<td><?php echo $value->project_Id; ?></td>
				<td><?php echo $value->project_desc; ?></td>	
				<td><?php echo $value->portfolio_id; ?></td>	
				<td><?php echo $value->portfolio_name; ?></td>
				<td><?php echo $value->bucket_id; ?></td>
				<td><?php echo $value->bucket_name; ?></td>															
				<td><?php echo $value->cost_centre; ?></td>															
				<td><?php echo $value->name; ?></td>															
				<td><?php echo $value->department_name; ?></td>															
				<td><?php echo $value->role_name; ?></td>
				<td><?php echo $value->p_start_date; ?></td>
				<td><?php echo $value->p_end_date; ?></td>
		
				<td>
				<?php if($value->status == 'active'){
					echo 'Active';
					}else{
					echo 'Not Active';
					
					} ?>
				</td>
				
			</tr>
		<?php 	} ?>
	</table>
</div>