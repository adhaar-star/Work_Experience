<html>
	<head>
		<style>
			.container{
				width:100%;
				max-width:800px;
				margin:0 auto;
			}
			table, tr, th, td{
				border:1px solid #dadada;
				border-collapse:collapse;
				padding:5px;
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
				 <p class="ship-head"><strong>Deal Confirmation</strong></p>
		                <p class="ship-no">#{{$deal->offerId}}</p>
				</div>
			</div>
			<div style="float:left;width:100%;">
				<p><strong>Hello {{$user->username}},</strong></p>
				<p>Thank you for subscribing deal(s) through haggler. Here is the coupon code for availing deal from merchant/store.</p>
			</div>
			<div style="float:left;width:100%;">
				<div style="width:100%;max-width:400px;margin:0 auto;">
					<div class="deal-header" style="background:#f6f6f6;padding:5px 10px;float:left;width:100%;box-sizing:border-box;">
						<img style="max-width:80px;height:auto; float:left;margin:0 10px 0 0;" src="http://haggler.in/assets/home/images/dealimage.jpg" />
						<p class="deal-discount" style="float:left;">{{ $deal->offerName }}</p>
						<p class="deal-price" style="float:right;">INR {{ $deal->originalPrice }}</p>
					</div>
					<div style="background:url('http://haggler.in/assets/home/images/code-bg.jpg');background-repeat:no-repeat; height:72px;width:100%;background-position:center;float:left;margin:10px 0;text-align:center;">
						<p style="color: #ffffff;font-size: 20px;padding: 4px 0;">{{ $userdeal->code }}</p>
					</div>
					<table style="margin:20px 0 50px;float:left;display:table;border:1px solid #dadada;border-collapse:collapse;padding:5px;">
						<tr style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;"><strong>Deal Name</strong></td>
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">{{ $deal->offerName }}</td>
						</tr>
						<tr style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;"><strong>Description</strong></td>
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">{{ $deal->description }}</td>
						</tr>
						<tr style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;"><strong>Original Price</strong></td>
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">{{ $deal->originalPrice }}</td>
						</tr>
						<tr style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;"><strong>Offer Price</strong></td>
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">{{ $deal->productOfferPrice }}</td>
						</tr>
						<tr style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;"><strong>Deal EndDate</strong></td>
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">{{ $deal->productofferEndDate }}</td>
						</tr>
						<tr style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;"><strong>Terms & Conditions</strong></td>
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">{{ $deal->productofferTerms }}</td>
						</tr>
						<tr style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;"><strong>Address</strong></td>
							<?php  $count=0; ?>
							    @foreach($deal->store->all() as  $key => $oi)
							<?php if($count==0){ ?>
							<td style="border:1px solid #dadada;border-collapse:collapse;padding:5px;">{{ $oi->address }}</td>
							<?php   }$count++;?>
							  @endforeach
						</tr>
					</table>
				</div>
			</div>
			<div style="float:left;width:100%;">
				<div style="border-top:1px solid #1155cc;float:left;width:100%;padding-bottom:5px;">
				<p>Do shop with us again!</p>
				<p><strong>Team Haggler</strong></p>				
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
	</body>
</html>