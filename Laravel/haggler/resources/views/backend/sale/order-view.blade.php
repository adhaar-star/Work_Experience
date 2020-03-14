<?php
use \App\Models\Helper;
?>
@section('content')
<style>
	.row.product-item {
  padding: 5px;
  margin-bottom: 28px;
  border-radius: 11px;
}

.panel.panel-info.item-info {
  margin-top: 40px;
}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			 <h4>VIEW ORDER</h4>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>

					  <tr>
						  <th>ORDER ID</th>
						  <th>PAYMENT STATUS</th>
						  <th>CUSTOMER</th>
						  <th>ORDER DATE</th>
					  </tr>

					</thead>
					<tbody>
					   <tr>
						   <td>{{$order->id}}</td>
						   <td>{{$order->order_status }}</td>
						   <td>{{ $order->name }}</td>
						   <td>{{ $order->created_at }}</td>
					   </tr>
					</tbody>

				</table>
			</div>

			<h4>ORDER DETAILS</h4>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>

					<tr>
						<th>#</th>
						<th>PRODUCT NAME</th>
						<th>PRICE</th>
						<th>QUANTITY</th>
						<th>COMMISSION</th>
						<th>TOTAL</th>
					</tr>

					</thead>
					<tbody>
					@if(!empty($order->items->all()))
						@foreach($order->items->all() as  $key => $oi)
                            <?php
                            $productCategories = App\Models\ProductCategory::where('productId',$oi->product_id)->get();

                            $size = sizeof($productCategories->toArray());


                            if($size > 0 ){
                                $commisionCategory =$productCategories->toArray()[$size-1]['categoryId'];

                                $category = App\Models\Category::where('categoryId',$commisionCategory)->first();

                            }
                            $itemVendor = $oi->product->vendor;

							if(isset($category)){
							  $cp = ($oi->total *$category->categoryPercentage)/100;

							}else{
								$cp = 0;
							}

							?>
							<tr>
								<td>{{$key + 1}}</td>
								<td>{{ $oi->name }}</td>
								<td>{{ number_format($oi->price,2) }}</td>
								<td>{{ $oi->quantity }}</td>
								<td>{{ isset($category) ? "{$category->categoryPercentage} %   ({$cp})"  :  0 }} </td>
								<td>{{$oi->total}}</td>
							</tr>
						@endforeach
						<tr>
							<td><td></td></td><td></td><td></td><td><b>ORDER TOTAL</b></td><td><b>{{ number_format($order->total,2) }}</b></td>
						</tr>
					@endif
					</tbody>

				</table>
			</div>


			<h4>CUSTOMER DETAILS</h4>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>

					<tr>

						<th>NAME</th>
						<th>EMAIL</th>
						<th>PHONE NUMBER</th>
					</tr>

					</thead>
					<tbody>

					<tr>

						<td>{{ $order->name }}</td>
						<td>{{ @$order->user->email}}</td>
						<td>{{ @$order->user->phone_number }}</td>

					</tr>

					</tbody>

				</table>
			</div>


			<h4>CUSTOMER ADDRESS DETAILS</h4>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>

					<tr>

						<th>ADDRESS</th>
					</tr>

					</thead>
					<tbody>

					<tr>

						<td>
							<b>{{ $order->shipping_name }},</b><br/>
							{{$order->shipping_address}},<br/>
							{{$order->shipping_city }}, {{ $order->shipping_state }} , {{ $order->shipping_zipcode }}<br/>
							{{$order->shipping_country}}


						</td>


					</tr>

					</tbody>

				</table>
			</div>

		</div>
	</div>
</div>

@stop

@section('after_footer')

<script src="{{url('assets/jquery-ui/jquery-ui.min.js')}}"></script>

@stop