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
	<h4>Project Report: Task Detail Report</h4>
	<table class="export_pdf">
			<tr class="export_pdf_hedding">
				<td>Project ID</td>
				<td>Project Description</td>
				<td>Phase ID</td>			
				<td>Phase Description</td>			
				<td>Task ID</td>			
				<td>Task Description</td>			
				<td>Start Date</td>			
				<td>End Date</td>			
				<td>Percent Complete</td>
				<td>Duration</td>							
				<td>Resource Assigned</td>							
				<td>Status</td>
			</tr>

		<?php foreach($request as $value){ ?>				
			<tr>
				<td><?php echo $value->project_Id  ?></td>
				<td><?php echo $value->project_desc ?></td>	
				<td><?php echo $value->project_phase_id;?></td>												
				<td><?php echo $value->phase_name ?></td>												
				<td><?php echo $value->task_Id ?></td>												
				<td><?php echo $value->task_name ?></td>												
				<td><?php if (isset($value->start_date))
				
				$phpdate = strtotime($value->start_date);
				$start_date = date('d/M/Y', $phpdate);
				echo '<p class="form-control-static">' . $start_date . '</p>';
				?>
				</td>		
				<td><?php if (isset($value->end_date))
				
				$phpdate = strtotime($value->end_date);
				$end_date = date('d/M/Y', $phpdate);
				echo '<p class="form-control-static">' . $end_date . '</p>';
				?>
				</td>												
				<td><?php echo $value->task_name ?></td>												
				<td><?php echo $value->duration ?></td>		
				<td><?php echo $value->resource_name ?></td>		
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