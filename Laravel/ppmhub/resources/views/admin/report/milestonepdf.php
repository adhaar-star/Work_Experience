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
	<h2>Project Report: Milestone Report</h2>
	<table class="export_pdf">
		<tr class="export_pdf_hedding">
			<td>Project ID</td>
			<td>Project Description</td>
			<td>Phase ID</td>
			<td>Task ID</td>
			<td>Milestone ID</td>
			<td>Milestone Description</td>
			<td>Scheduled Date</td>
			<td>Actual Date</td>
		</tr>
		<?php foreach($request as $value){ ?>				
			<tr>
				<td><?php echo $value->project_Id  ?></td>
				<td><?php echo $value->project_desc  ?></td>
				<td><?php echo $value->project_phase_id  ?></td>
				<td><?php echo $value->project_task_id  ?></td>
				<td><?php echo $value->project_milestone_Id  ?></td>
				<td><?php echo $value->milestone_name  ?></td>
				<td><?php if (isset($value->schedule_date)) {

				$phpdate = strtotime($value->schedule_date);
				$schedule_date = date('d/M/Y', $phpdate);
				echo '<p class="form-control-static">' . $schedule_date . '</p>';

				} else { ?>
				<p class="form-control-static"></p>

				<?php }  ?>


				</td>				
				<td>
				<?php if (isset($value->actual_date)){
				$phpdate = strtotime($value->actual_date);
				$actual_date = date('d/M/Y', $phpdate);
				echo '<p class="form-control-static">' . $actual_date . '</p>';
				
				}else{ ?>
				<p class="form-control-static"></p>	
					
				<?php } ?>
				</td>				
			</tr>
		<?php 	} ?>
	</table>
</div>