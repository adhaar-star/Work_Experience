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
	<h4>Project Report: Purchase Requisitions For A Project</h4>
	<table class="export_pdf">
			<tr class="export_pdf_hedding">
				<td>Project ID</td>
				<td>Project Description</td>
				<td>Purchase Requisition</td>
				<td>Purchase Requisition Item</td>
				<td>Total Price</td>
				<td>Project Manager</td>
				<td>Vendor</td>
				<td>Delivery Date</td>
				<td>Status</td>		
			</tr>

		<?php foreach($request as $val){  ?>				
			<tr>
				<td><?php echo $val->project_Id ?></td>
				<td><?php echo $val->project_desc ?></td>	
								<td><?php echo $val->requisition_number ?></td>												
								<td><?php echo $val->item_no ?></td>												
								<td><?php echo $val->item_cost ?></td>												
								<td><?php echo $val->user_name ?></td>												
								<td><?php echo $val->vendor_name ?></td>	<td>
								<?php
								if (isset($val->delivery_date))
								$phpdate = strtotime($val->delivery_date);
								$delivery_date = date('d/M/Y', $phpdate);
								echo '<p class="form-control-static">' . $delivery_date . '</p>';
								?>
								</td>		
																				
								<td><?php if (isset($val->status) && $val->status == "active"){
								
								echo'Active';
								}else{
									echo'Not Active';
									
									}  ?> </td>	
			</tr>
		<?php 	} ?>
	</table>
</div>