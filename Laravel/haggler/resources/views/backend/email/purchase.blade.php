<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>haggler</title>

	<style type="text/css">
		body{
			color:#000 !important;
			line-height:1.428;
			font-family:Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
		}
		.container{
			width:100%;
			max-width:650px;
			margin:0px auto;
		}
		.clearfix:after,.clearfix:before{
			display:block;
			content:" ";
			clear:both;
		}
		header.header{
			width:100%;
			display:inline-block;
		}
		.logo{
			float:left;
		}
		.ship-no-blk{
			float:right;
			margin:25px 0 0;
		}
		.ship-head{
			font-size:16px;
			font-weight:600;
			margin:0 0 7px;
			color:#333333;
		}
		.ship-no{
			margin:0;
			color:#333333;
		}
		.main-heading{
			border-bottom:1px solid #1155cc;
			padding:15px 0;
		}
		.name-heading,.order-no{
			color:#333333;
		}
		.order-img{
			float:left;
			width:20%;
		}
		.order-name{
			width:30%;
			float:left;
		}
		.order-name p{
			font-size:14px;
		}
		.order-amount{
			width:40%;
			float:right;
			margin-top:20px;
		}
		.amonut-heading{
			width: 50%;
			text-align: right;
			float: left;
			padding: 0 10px 0 0;
			box-sizing: border-box;
		}
		.amonut-heading p{
			margin:0 5px 0 0;
			font-size:14px;
		}
		.order-total .order-amount{
			width:45%;
		}
		.amonut-desc{
			margin-bottom:10px;
			display:inline-block;
			width:100%;
		}
		.amonut-price{
			float:left;
			width:50%;
		}
		.amonut-price p{
			margin:0;
		}
		.top-blk{
			margin-bottom:20px;
			display:inline-block;
			width:100%;
		}
		.order-desc{
			border-bottom:1px solid #1155cc;
			padding-bottom:15px;
			margin-bottom:15px;
			display:inline-block;
			width:100%;
		}
		.order-total {
			width: 100%;
			display: inline-block;
		}
		.delivery-address-blk h3{
			color:#333333;
			margin-top:0;
		}
		.delivery-address-blk p{
			margin:0;
		}
		.delivery-address-blk{
			width:60%;
			float:left;
		}
		.delivery-no{
			float:right;
		}
		.delivery-no h3 span{
			color:#333333;
		}
		.delivery-no h3{
			color:#1155cc;
			margin-top:0;
		}
		.address{
			border-bottom:1px solid #1155cc;
			padding-bottom:20px;
			margin-bottom:15px;
			display:inline-block;
			width:100%;
		}
		.sub-cnt{
			font-size:13px;
		}
		.address .date-blk{
			color:#333333;
			font-size:15px;
		}
		.date-blk{
			font-size:13px;
		}
		.order-head p{
			font-size:14px;
		}
		.order-head p span{
			margin-right:5px;
		}
		.green{
			color:#00b050;
			padding-right:5px;
		}
		.footer
		{
			display:inline-block;
			width:100%;
		}
		.footer p{
			font-size:14px;
		}
		.footer h4{
			margin-top:10px;
			color:#333333;
		}
		
		@media only screen and (max-width:768px){
			.order-img, .order-name, .order-detail-outer{
				width:100% !important;
			}
			.amonut-heading{
				text-align:left !important;
				max-width:200px !important;
			}
			.amonut-heading p, .amonut-price p, .order-total, .order-amount{
				margin:0 !important;
				padding:0 !important;
			}
			.delivery-no > span{
				height:0 !important;
			}
			.delivery-no h3{
				width:100% !important;
			}
		}
		
	</style>
	
	</head>

	<body style="color:#000 !important">
		<div class="main" style="max-width:100%;">
		    <div class="container" style="max-width:100%;">
		        <header class="header clearfix" style="float:left;width:100%;">
					 <div class="ship-no-blk" style="float:right;width:50%;">
						 <p class="ship-head"><strong>Order</strong> @if($status == 'confirmed')<strong>Confirmation</strong>   @elseif($status == 'shipped') <strong>Dispatched</strong>  @elseif($status == 'delivered') <strong>Delivered Confirmation</strong> @else {{$status}} @endif</p>
		                <p class="ship-no"> @if($status != 'delivered')#{{$order->id}} @endif</p>
		            </div>
		            <div class="logo" style="float:left;width:50%;">
		                <a href="#"><img src="http://haggler.in/assets/home/images/haggle-logo.jpg"></a>
		            </div>		           
		        </header>
		        <section class="top-blk clearfix">
		            <div class="main-heading" style="float:left;width:100%;">
		                <p class="name-heading"><strong>Hello {{ $order->name }},</strong></p>
		                @if($status == 'confirmed')
						<p class="sub-cnt">Thank you for your order!</p>
			                <p class="sub-cnt">Once the items in your order have been shipped, you will receive another email</p>
						
					
						<p class="sub-cnt">Here is your order summary.</p>
						<p class="order-no">Order #{{ $order->id }}</p>
			            @elseif($status == 'shipped')
			                <p class="sub-cnt">We thought you'd like to know that seller has dispatched your item(s). Your order is on the way.We will send you delivery conformation email once your item(s) have been delivered to your address.</p>
			                <p>Enjoy your purchase.</p>
	                        <p>Team Haggler</p><br/>
						   <p class="order-no">Order #{{$order->id}}</p>
			            @elseif($status == 'delivered')
						     <p class="sub-cnt">Great news!</p>
			            	<p class="sub-cnt">Your package has been delivered. We feel delighted that we managed to bring a smile to your face.
We hope to see you again soon.</p>
						<p><strong>Team Haggler</strong></p>
						<p>Package Details</p>
			            @elseif($status == 'canceled')
			            	<p>Your order has been canceled.</p>
			            @elseif($status == 'returned')
			            	<p>Your order has been returned.</p>
			            @endif
		            </div>
		        </section>
		        <section class="order-desc" style="width:100%">
		         
		            <div class="order-blk">
		                @if(!empty($order->items->all()))
		                    @foreach($order->items->all() as  $key => $oi)
		                        <div class="order-table clearfix">
   <div class="date-blk" style="float:left;width:100%;"> Placed On {{date('l, F jS, Y', strtotime($order->created_at))}}</div>
					<div class="seller-blk" style="float:left;width:100%;"><strong>Seller:</strong> {{ $vendorname }}</div>
		                            <div class="order-img" style="float:left;width:25%"> 
										<img width="150" height="auto" src="http://haggler.in/assets/images/product/{{ $oi->product->image }}" alt="image"> 
									</div> <!-- Remaining -->
		                            <div class="order-name" style="float:left;width:25%">
		                                <p>{{ $oi->name }}</p>
		                            </div>
									<div class="order-detail-outer"  style="float:left;width:50%">
		                            <div class="order-amount clearfix" style="width:100%">
		                                <div class="amonut-desc clearfix">
		                                    <div class=" amonut-heading" style="width: 50%;text-align: right;float: left;padding: 0 10px 0 0;box-sizing: border-box;">
		                                        <p style="margin:0">Item Subtotal:</p>
		                                    </div>
		                                    <div class="amonut-price" style="float:left;width:50%;">
		                                        <p style="margin:0">Rs.{{$oi->total}}</p>
		                                    </div>
		                                </div>
		                                <div class="amonut-desc clearfix">
		                                    <div class=" amonut-heading" style="width: 50%;text-align: right;float: left;padding: 0 10px 0 0;box-sizing: border-box;">
		                                        <p style="margin:0">Shipping & Handling:</p>
		                                    </div>
		                                    <div class=" amonut-price" style="float:left;width:50%;">
		                                        <p style="margin:0">Rs.0.00</p>
		                                    </div>
		                                </div>
		                                <div class="amonut-desc clearfix">
		                                    <div class=" amonut-heading" style="width: 50%;text-align: right;float: left;padding: 0 10px 0 0;box-sizing: border-box;">
		                                        <p style="margin:0">Quantity:</p>
		                                    </div>
		                                    <div class=" amonut-price" style="float:left;width:50%;">
		                                        <p style="margin:0">{{ $oi->quantity }}</p>
		                                    </div>
		                                </div>
		                               <!-- <div class="amonut-desc clearfix">
		                                    <div class=" amonut-heading" style="width: 50%;text-align: right;float: left;padding: 0 10px 0 0;box-sizing: border-box;">
		                                        <p style="margin:0">Item Subtotal:</p>
		                                    </div>
		                                    <div class=" amonut-price" style="float:left;width:50%;">
		                                        <p style="margin:0">Rs.{{$oi->total}}</p>
		                                    </div>
		                                </div>-->
		                            </div>
										<div class="order-total clearfix" style="float:left;width:100%">
		                    <div class="order-amount clearfix" style="width:100%">
		                        <div class="amonut-desc clearfix">
		                            <div class=" amonut-heading" style="width: 50%;text-align: right;float: left;padding: 0 10px 0 0;box-sizing: border-box;">
		                                <p style="margin:0;font-weight: bold;color:black;">Order total:</p>
		                            </div>
		                            <div class="amonut-price" style="float:left;width:50%;">
		                                <p style="margin:0;font-weight: bold;color:black;">Rs.{{$oi->total}}</p>
		                            </div>
		                        </div>
		                        <div class="amonut-desc clearfix">
		                            <div class=" amonut-heading" style="width: 50%;text-align: right;float: left;padding: 0 10px 0 0;box-sizing: border-box;">
		                                <p style="margin:0">Cash Payment Pending:</p>
		                            </div>
		                            <div class=" amonut-price" style="float:left;width:50%;">
		                                <p style="margin:0">Rs.{{$oi->total}}</p>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                        </div>
						</div>
						       @endforeach
		                @endif  
		            </div>
 <div style="border-top:1px solid #1155cc;float:left;width:100%;padding-bottom:5px;"> <font color="#000000">Arriving:</font> <b>{{date('l, F jS', strtotime($order->created_at.'+4 days'))}} - {{date('l, F jS', strtotime($order->created_at.'+5 days'))}}</b></div>
		        </section>
		        <section class="address" style="float:left;width:100%;">
					
		            <div class="delivery-address clearfix">
		                <div class="delivery-heading" style="float:left;width:100%">
		                    <p style="margin:15px 0 0">Delivery Address</p>
						</div>
		                <div class="delivery-address-blk" style="width:50%; float:left">
		                    <h3>{{ $order->shipping_name }}</h3>
		                    <p>{{$order->shipping_address}}, {{$order->shipping_city }}</p>
		                    <p>{{ $order->shipping_state }} , {{ $order->shipping_zipcode }}</p>
		                    <p>{{$order->shipping_country}}</p>
		                </div>
		                <div class="delivery-no" style="width:50%; float:left">
							<span style="width:50%; float:left;height:5px"></span>
		                    <h3 style="width:50%; float:left;"><span>Phn:</span> <span style="color:#0000ff;text-decoration:underline">{{ @$order->user->phone_number }}</span></h3>
		                </div>
		            </div>
		        </section>
		        <footer class="footer" style="float:left;width:100%;"></footer>
				<div style="float:left;width:100%;">
					<div style="border-top:1px solid #1155cc;float:left;width:100%;padding-bottom:5px;margin-top:15px;"> 
		       @if($status != 'delivered') <p><span class="green">GO GREEN.</span>You will receive a soft copy of an invoice as a part of the delivery confirmation email within 24 hours of the delivery completion.</p> @endif
		       @if($status == 'confirmed')   <p>Do shop with us again!</p>
					<strong><p>Team haggler</p></strong>@endif
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

