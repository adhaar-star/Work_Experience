<div class="main">
    <div class="container">
        <header class="header clearfix">
            <div class="logo">
                <a href="#"><img src="http://haggler.in/assets/home/images/logo.png"></a>
            </div>
            <div class="ship-no-blk">
                <p class="ship-head">Order Confirmation</p>
                <p class="ship-no">#{{$order->id}}</p>
            </div>
        </header>
        <section class="top-blk clearfix">
            <div class="main-heading">
                <p class="name-heading">Hello {{ $order->name }},</p>
                <p class="sub-cnt">Thank you for your order!</p>
                <p class="sub-cnt">Once the items in your order have been shipped, you will receive another email.</p>
                <p class="sub-cnt">Here is yourorder summary.</p>
                <p class="order-no">Order #{{$order->id}}</p>
            </div>
        </section>
        <section class="order-desc">
            <div class="date-blk"> Placed On {{ $order->created_at }} </div>
            <div class="order-blk">
                @if(!empty($order->items->all()))
                    @foreach($order->items->all() as  $key => $oi)
                        <div class="order-table clearfix">
                            <div class="order-img"> <img src="https://gallery.mailchimp.com/a73e542210b5ce6c0bcd5ccc8/images/2da20420-7d96-4315-b133-ca539f137d24.jpg"> </div> <!-- Remaining -->
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
