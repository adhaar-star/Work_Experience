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
	<h4>Portfolio Report: Projects in Portfolio</h4>
	<table class="export_pdf">
			<tr class="export_pdf_hedding">
				<td>Project ID</td>
				<td>Project Description</td>
				<td>Bucket ID</td>
				<td>Bucket Name</td>
				<td>Portfolio ID</td>						
				<td>Portfolio Name</td>
			</tr>

		<?php foreach($request as $val){ ?>				
			<tr>
				<td><?php echo $val->project_Id ?></td>
				<td><?php echo $val->project_desc ?></td>	
				<td><?php echo $val->bucket_id ?></td>	
				<td><?php echo $val->bucket_name ?></td>															
				<td><?php echo $val->portfolio_id ?></td>															
				<td><?php echo $val->portfolio_name ?></td>			
			</tr>
		<?php 	} ?>
	</table>
</div>