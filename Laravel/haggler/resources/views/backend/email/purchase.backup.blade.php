<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>haggler</title>

	<style type="text/css">
		body{
			color:#757575;
			line-height:1.428;
			font-family:Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
		}
		.container{
			width:650px;
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
			border-bottom:1px solid #000;
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
			float:left;
			margin:0 5px 0 0px;
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
			float:right;
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
			border-bottom:1px solid #000;
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
			border-bottom:1px solid #000;
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
	</style></head>

	<body>
		<div class="main">
		    <div class="container">
		        <header class="header clearfix">
		            <div class="logo">
		                <a href="#"><img src="http://haggler.in/assets/home/images/logo.png"></a>
		            </div>
		            <div class="ship-no-blk">
		                <p class="ship-head">Order {{$status}}</p>
		                <p class="ship-no">#{{$order->id}}</p>
		            </div>
		        </header>
		        <section class="top-blk clearfix">
		            <div class="main-heading">
		                <p class="name-heading">Hello {{ $order->name }},</p>
		                @if($status == 'confirmed')
			                <p class="sub-cnt">Thank you for your order!</p>
			                <p class="sub-cnt">Once the items in your order have been shipped, you will receive another email.</p>
			                <p class="sub-cnt">Here is your order summary.</p>
			            @elseif($status == 'shipped')
			                <p class="sub-cnt">Your order has been dispatched.  We will send you delivery conformation email once your item(s) have been delivered to your address.</p>
			                <p>Enjoy your purchase.</p>
			            @elseif($status == 'delivered')
			            	<p class="sub-cnt">We thought you'd like to know that seller has dispatched your item(s). Your order is on the way.</p>
			            @elseif($status == 'canceled')
			            	<p>Your order has been canceled.</p>
			            @elseif($status == 'returned')
			            	<p>Your order has been returned.</p>
			            @endif
		            </div>
		        </section>
		        <p class="order-no">Order #{{$order->id}}</p>
		        <section class="order-desc">
		            <div class="date-blk"> Placed On {{ $order->created_at }} </div>
		            <div class="order-blk">
		                @if(!empty($order->items->all()))
		                    @foreach($order->items->all() as  $key => $oi)
		                    	{{ $oi->product->productId }}
		                    	{{ $oi->product->image }}
		                        <div class="order-table clearfix">
		                            <div class="order-img"> <img width="150" height="400" src="{{ $oi->product->image }}" alt="image"> </div> <!-- Remaining -->
		                            <div class="order-name">
		                                <p>{{ $oi->name }}</p>
		                            </div>
		                            <div class="order-amount clearfix">
		                                <div class="amonut-desc clearfix">
		                                    <div class="amonut-heading">
		                                        <p>Item Price:</p>
		                                    </div>
		                                    <div class="amonut-price">
		                                        <p>Rs.{{ number_format($oi->price,2) }}</p>
		                                    </div>
		                                </div>
		                                <div class="amonut-desc clearfix">
		                                    <div class="amonut-heading">
		                                        <p>Shipping & Handling:</p>
		                                    </div>
		                                    <div class="amonut-price">
		                                        <p>Rs.0.00</p>
		                                    </div>
		                                </div>
		                                <div class="amonut-desc clearfix">
		                                    <div class="amonut-heading">
		                                        <p>Quantity:</p>
		                                    </div>
		                                    <div class="amonut-price">
		                                        <p>{{ $oi->quantity }}</p>
		                                    </div>
		                                </div>
		                                <div class="amonut-desc clearfix">
		                                    <div class="amonut-heading">
		                                        <p>Item Subtotal:</p>
		                                    </div>
		                                    <div class="amonut-price">
		                                        <p>Rs.{{$oi->total}}</p>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    @endforeach
		                @endif  
						@if(!empty($order->items->all()))
		                    @foreach($order->items->all() as  $key => $oi)
		                <div class="order-total clearfix">
		                    <div class="order-amount clearfix">
		                        <div class="amonut-desc clearfix">
		                            <div class="amonut-heading">
		                                <p>Order total:</p>
		                            </div>
		                            <div class="amonut-price">
		                                <p>Rs.{{$oi->total}}</p>
		                            </div>
		                        </div>
		                        <div class="amonut-desc clearfix">
		                            <div class="amonut-heading">
		                                <p>Cash Payment Pending:</p>
		                            </div>
		                            <div class="amonut-price">
		                                <p>Rs.{{$oi->total}}</p>
		                            </div>
		                        </div>
		                    </div>
		                </div>
						       @endforeach
		                @endif  
		            </div>
		        </section>
		        <section class="address">
		            <div class="delivery-address clearfix">
		                <div class="delivery-heading">
		                    <p>Delivery Address</p>
		                </div>
		                <div class="delivery-address-blk">
		                    <h3>{{ $order->shipping_name }}</h3>
		                    <p>{{$order->shipping_address}}, {{$order->shipping_city }}</p>
		                    <p>{{ $order->shipping_state }} , {{ $order->shipping_zipcode }}</p>
		                    <p>{{$order->shipping_country}}</p>
		                </div>
		                <div class="delivery-no">
		                    <h3><span>Phn:</span> {{ @$order->user->phone_number }}</h3>
		                </div>
		            </div>
		        </section>
		        <footer class="footer"></footer>
		        <p><span class="green">GO GREEN.</span>As a part of go-green initiative we will not be sending the invoice to you with the shipment. You will receive a soft copy of an invoice as a part of the delivery confirmation email within 24 hours of the delivery completion.</p>
		        <p>We hope to see you again soon.</p>
		        <h4>haggler</h4>
		    </div>
		</div>
	</body>
	</html>
