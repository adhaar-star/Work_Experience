<html>
	<head>
		<style>
			.container{
				width:100%;
				max-width:800px;
				margin:0 auto;
			}
			table, tr, th, td{
				border:1px solid #000;
				border-collapse:collapse;
				padding:5px;
			}
			@media only screen and (max-width:768px){
				.invoice-detail h3{
					font-size:16px !important;
				}
			}
		</style>
	</head>
	<body style="color:#000 !important">
		<div class="container">
			<div class="header-top">
				<div style="float:left;width:50%;">
		                <a href="#"><img src="http://haggler.in/assets/home/images/haggle-logo.jpg"></a>
				</div>
				<div style="float:left;width:50%;text-align:right">
					<p><strong>Invoice: </strong># LR_WFLD20150801037696</p>
				</div>
			</div>
			<div style="float:left;width:100%;">
				<p><strong>Hello {{ $order->name }},</strong></p>
				<p>This is to inform you that your order, with order no. {{ $order->id }} has been delivered.  Please find the soft copy of the invoice order for {{ $order->id }} attached for your reference.</p>
				<p>Thanks for Shopping! We welcome your feedback.</p>
				<p>Team Haggler </p>
			</div>
			<div class="invoice-detail">
				<h3 style="width:100%;text-align:center;float:left;margin:0;color:#000;">Retail Invoices/Bill</h3>
				<p style="float:right;border:1px dotted;padding:2px 5px;"><strong>Invoice No:</strong> #kdfhg9078907</p>
				<div style="width:100%;float:left;margin:5px 0; border-bottom:1px solid #000;">
					<h3 style="margin:0;">Sold By: <span style="font-weight:normal">WS retail Services Pvt. Ltd.,</span></h3>
					<p style="margin:0 0 5px">Ware house address: dummy address</p>
				</div>
				<?php  $originalDate = $order->created_at;
$newDate = date("d-m-Y", strtotime($originalDate));?>
				<div class="invoice-body" style="float:left;width:100%;">
					<div style="float:left;width:25%;padding:0 10px 0 0;box-sizing:border-box;">
						<p style="margin:0"><strong>Order ID: {{ $order->id }}</strong></p>
						<p><strong>Order Date: </strong>{{ $newDate }}</p>
						<p><strong>Invoice Date: </strong>23-08-17</p>
						<p><strong>VAT/TIN: </strong>12236484</p>
						<p><strong>Service tax #: </strong>AAAAADDDDDDDDDD</p>
						<p><strong></strong></p>
					</div>
					<div style="float:left;width:25%;padding:0 10px 0 0;box-sizing:border-box;">
						<p style="margin:0"><strong>Billing Address</strong></p>
						  @if(!empty($user->address->all()))
						<?php  $count=0;?>
		                    @foreach($user->address->all() as  $key => $oi)
						<?php  if($count==0){
						if($oi->type == "billing"){
						?>
						<p style="margin:0">{{ $oi->name }}</p>
						<p style="margin:0">{{ $oi->address }}</p>
						<p style="margin:0">{{ $oi->city }} {{ $oi->zipcode }} {{ $oi->state }}</p>
						<p style="margin:0"><strong>Phone</strong>{{ $oi->phone }}</p>						 

						<?php }}?>
						<?php $count++; ?>
						      @endforeach
		                @endif
					</div>
					<div style="float:left;width:25%;padding:0 10px 0 0;box-sizing:border-box;">
						<p style="margin:0"><strong>Shipping Address</strong></p>
						  @if(!empty($user->address->all()))
						<?php  $count=0;?>
		                    @foreach($user->address->all() as  $key => $oi)
						<?php  if($count==0){
						if($oi->type == "shipping"){
						?>
						<p style="margin:0">{{ $oi->name }}</p>
						<p style="margin:0">{{ $oi->address }}</p>
						<p style="margin:0">{{ $oi->city }} {{ $oi->zipcode }} {{ $oi->state }}</p>
						<p style="margin:0">Phone{{ $oi->phone }}</p>						 
						<?php }}?>
						<?php $count++; ?>
						      @endforeach
		                @endif

					</div>
					<div style="float:left;width:25%;padding:0 10px 0 0;box-sizing:border-box;">
						<p>*Keep this invoice and manufacturer box for warranty purposes.</p>
					</div>
					<table style="width:100%;text-align:left;">
						<tr>
							<th>Product</th>
							<th>Title</th>
							<th>Qty</th>
							<th>Price(₹)</th>
							<th>Tax(%)</th>
							<th>Tax(₹)</th>
							<th>Total(₹)</th>
						</tr>
						   @if(!empty($order->items->all()))
		                    @foreach($order->items->all() as  $key => $oi)
						<tr>
							<td>
								<p><strong>Handsets FSN: </strong> dfgkasjdgf dfghk</p>
								<p>WID: <strong>VB123456</strong></p>
							</td>
							<td>
								<p><strong>Product Name</strong></p>
								<ol style="padding:0 0 0 16px">
									<li>dgh dfghls</li>
									<li>sd;gjlasdf ldg </li>
								</ol>
							</td>
							<td>
								<p>{{ $oi->quantity }}</p>
							</td>
							<td>
								<p>{{$oi->total}}</p>
							</td>
							<td>
								<p>5.5% CST</p>
							</td>
							<td>
								<p>2319.24</p>
							</td>
							<td>
								<p>44495.15</p>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="right" style="font-size:18px;"><strong>Total:</strong></td>
							<td style="font-size:18px;"><strong>{{ $oi->quantity }}</strong></td>
							<td style="font-size:18px;"><strong>{{ $oi->total }}</strong></td>
							<td></td>
							<td style="font-size:18px;"><strong>2319.24</strong></td>
							<td style="font-size:18px;"><strong>44495.15</strong></td>
						</tr>
						<tr>
							<td colspan="5" align="right" style="font-size:24px;">Grand Total:</td>
							<td colspan="5" align="right" style="font-size:24px;">44495.15</td>
						</tr>
						  @endforeach
		                @endif 
					</table>
					<div style="float:left;width:100%;text-align:center;">
						<p style="margin:0;font-size:13px">*This is a computer generated invoice.</p>
					</div>
					<div style="float:left;width:100%;text-align:right">
						<p><strong>WS Retail Services Pvt. Ltd:</strong></p>
						<p style="margin:100px 0 0">(Authorized Signatory)</p>
					</div>
				</div>
					<div style="width: 100%;text-align:center;float: right;">
	<p style="text-align:center; width:100%;"><strong>Download our App</strong></p>
<div style="display:inline;">
<a href="https://itunes.apple.com/in/app/haggler/id1159759619?mt=8"><img src="http://haggler.in/assets/home/images/app-store.jpg"></a>
<a href="https://play.google.com/store/apps/details?id=dev.Haggler2&hl=e"><img src="http://haggler.in/assets/home/images/googleplay.jpg"></a>
	</div>
				<p style="text-align:center; width:100%;"><strong>Follow us on</strong></p><br/>
					<p style="float:left; margin-right:5px;">Need help? Have feedback?</p>
	<p style="float:left;">Feel free to <a href="mailto:info@haggler.in">contact us</a></p>	
				</div>		
	
			</div>
		</div>
	</body>
</html>