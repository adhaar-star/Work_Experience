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
	<h2>Project Report: Risk Analysis Report</h2>
	<table class="export_pdf">
		
			<tr class="export_pdf_hedding">
			<td>Project ID</td>
			<td>Project Manager</td>
			<td>Risk ID</td>			
			<td>Risk Type</td>
			<td>Risk Score</td>							
			<td>Status</td>
			</tr>
		
		
		
		
		
		
		

		<?php foreach($request as $value){ ?>				
			<tr>
				<td><?php echo $value->project_id  ?></td>
					<td><?php echo $value->name ?></td>	
					<td><?php echo $value->risk_id;?></td>												
					<td>-</td>												
					<td>-</td>	
				
				<td>
				<?php if($value->status == 1){
					echo 'Active';
					}else{
					echo 'Not Active';
					}?></td>			
			</tr>
		<?php 	} ?>
	</table>
</div>