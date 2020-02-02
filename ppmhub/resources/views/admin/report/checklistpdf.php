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
	<h2>Project Report: Check List Report</h2>
	<table class="export_pdf">
		<tr class="export_pdf_hedding">
			<td>Project ID</td>
			<td>Project Description</td>
			<td>Project Manager</td>
			<td>Checklist ID</td>
			<td>Check List Description</td>
			<td>Checklist Status</td>
			<td>Checklist Date</td>			
		</tr>
		<?php foreach($request as $value){ ?>				
			<tr>
				<td><?php echo $value->project_Id  ?></td>
				<td><?php echo $value->project_desc  ?></td>
				<td><?php echo $value->name  ?></td>
				<td><?php echo $value->checklist_id  ?></td>
				<td><?php echo $value->checklist_name  ?></td>
				<td>
					<?php if($value->checklist_status == 'active') { ?>
						Active
					<?php } else { ?>
						Not Active
					<?php }  ?>
				</td>
				<td><?php
				$value = new DateTime($value->created_on);
				$date = $value->format('Y-m-d');
				echo $date;
				?></td>
				
			</tr>
		<?php 	} ?>
	</table>
</div>