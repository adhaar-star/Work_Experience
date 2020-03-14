<?php
use \App\Models\Helper;
?>
@section('content')


<div class="container-fluid">
	<!-- <div class="row"> -->	
	@if (Auth::user()->role == 'admin')
	<div class="col-sm-12">
		<div class="row dashboard_summary">
			<?php 
				if(session('scroll') === NULL){ ?>
					{!!Helper::alert()!!}
				<?php } ?>
			<div class="col-sm-3 widget-1">
				<a href="{{ Helper::adminUrl('product') }}">
					<div class="widget">
						<div class="row">
							<div class="col-sm-4">
								<h3><i class="fa fa-shopping-cart fa-3x"></i></h3>
							</div>
							<div class="col-sm-8">
								<h3>Products</h3>
								<p>Total: {{ \App\Models\Product::count() }}</p>
								<p>Approved: {{ \App\Models\Product::where('visible', 'yes')->count() }}</p>
								<p>Unapproved: {{ \App\Models\Product::where('visible', 'no')->count() }}</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-3 widget-1">
				<a href="{{ Helper::adminUrl('deal') }}">
					<div class="widget">
						<div class="row">
							<div class="col-sm-4">
								<h3><i class="fa fa-thumbs-up fa-3x"></i></h3>
							</div>
							<div class="col-sm-8">
								<h3>Deals</h3>
								<p>Total: {{ \App\Models\Deal::count() }}</p>
								<p>Approved: {{ \App\Models\Deal::where('visible', 'yes')->count() }}</p>
								<p>Unapproved: {{ \App\Models\Deal::where('visible', 'no')->count() }}</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-3 widget-1">
				<a href="{{ Helper::adminUrl('event') }}">
					<div class="widget">
						<div class="row">
							<div class="col-sm-4">
								<h3><i class="fa fa-calendar fa-3x"></i></h3>
							</div>
							<div class="col-sm-8">
								<h3>Events</h3>
								<p>Total: {{ \App\Models\Event::count() }}</p>
								<p>Approved: {{ \App\Models\Event::where('eventStatus', 'active')->count() }}</p>
								<p>Unapproved: {{ \App\Models\Event::where('eventStatus', 'inactive')->count() }}</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-3 widget-1">
				<a href="{{ Helper::adminUrl('user/vendors') }}">
					<div class="widget">
						<div class="row">
							<div class="col-sm-4">
								<h3><i class="fa fa-group fa-3x"></i></h3>
							</div>
							<div class="col-sm-8">
								<h3>Vendors</h3>
								<p>Total: {{ \App\Models\User::where('role', 'vendor')->count() }}</p>
								<p>Stores: {{ \App\Models\Store::count() }}</p>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<!-- Validate Coupon -->
		<div class="row validate_deal_section" id="valid_code">
			<?php 
				if(session('scroll') !== NULL){ ?>
					{!!Helper::alert()!!}
				<?php } ?>
			<div class="col-sm-12">
				<h3 class="back_grey">Validate Deal Code</h3>
				<?= Helper::inlineError() ?>
				<form action="<?= Helper::adminUrl('sale/validate-deal') ?>" method="get" class="form-horizontal">
					<div class="form-group {{$errors->has('deal_code') ? 'has-error' : '' }}">
						<label class="col-sm-12">Enter Code</label>
						<div class="col-sm-12">
							<input type="text" name="deal_code" class="form-control">
							<div class="help-block">{{$errors->first('deal_code')}}</div>
						</div>
					</div>
					<div class="form-group">

						<div class="col-sm-12">
							<input type="submit" value="Validate" class="btn btn-primary">
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
				@if (!empty(session('current_deal')))
				<table class="table table-hover">
					<thead>
						<tr class="headings">
							<th>Name</th>
							<th>Vendor</th>
							<th>Buyer</th>
							<th>Offer Name</th>
							<th>Code</th>
							<th>Type</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$cdeal = session('current_deal');
						switch ($cdeal->status) {
							case 'used':
							$stat_class = 'success';
							$cdeal->status = 'consumed';
							break;

							case 'not-used':
							$stat_class = 'default';
							$cdeal->status = 'bought';
							break;
						}
						if ($cdeal->status != 'used' && $cdeal->deal->offerEndDate < date('Y-m-d')){
							$stat_class = 'danger';
							$cdeal->status = 'expired';
						}
						?>
						<tr>
							<td class="has-options">
								{{$cdeal->deal->offerName}}
								<span>
									<a href="{{Helper::adminUrl('deal/edit', [$cdeal->id])}}">View</a> @if ($cdeal->status !== 'used' && $cdeal->status !== 'expired') | <a href="{{Helper::adminUrl('sale/approve-deal')}}?deal={{$cdeal->id}}">Approve</a> @endif
								</span>
							</td>
							<td>{{@$cdeal->store->storename}}</td>
							<td>{{@$cdeal->buyer->username}}</td>
							<td>{{@$cdeal->deal->offerName}}</td>
							<td>{{@$cdeal->code}}</td>
							<td>{{@$cdeal->deal->offerType}}</td>
							<td><label class="label label-{{$stat_class}}">{{ucwords($cdeal->status)}}</label></td>
						</tr>
					</tbody>
				</table>
				@endif
			</div>
		</div>
		<!-- Latest Products -->
		<div class="row">
			<div class="col-sm-12">
				<h3 class="back_grey">Latest 5 Products</h3>
				<table class="table table-striped table-hover latest_product">
					<thead>
						<th><b>#</b></th>
						<th><b>Name</b></th>
						<th><b>Store</b></th>
						<th><b>Price</b></th>
						<th><b>Offer</b></th>
						<th><b>Action</b></th>
					</thead>
					<tbody>
						<?php $products = \App\Models\Product::select('*')->orderBy('productId', 'desc')->take(5)->get(); ?>
						@if (!empty($products->all()))

							@foreach ($products as $key=>$product)
								<tr>
									<td>{{@$key+1}}</td>
									<td>{{@$product->productName}}</td>
									<td>{{@$product->store->storeName}}</td>
									<td>{{@$product->productPrice}}</td>
									<td>{{(@$product->hasOffer == 'yes' ? 'yes' : 'na' ) }}</td>
									<td>
										@if ($product->visible == 'no')
											<a href="{{ Helper::adminUrl('product/visibility/visible', [$product->productId]) }}?home=1" title="Approve"><i class="btn btn-default btn-sm fa fa-check-circle fa-lg" aria-hidden="true"></i></a> 
										@else
											<a href="{{ Helper::adminUrl('product/visibility/hidden', [$product->productId]) }}?home=1" title="Disapprove"><i class="btn btn-default btn-sm fa fa-ban fa-lg" aria-hidden="true"></i></a> 
										@endif
										<a href="{{ Helper::adminUrl('product/edit', [$product->productId]) }}" title="Edit"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
										<a class="delete" href="{{ Helper::adminUrl('product/delete', [$product->productId]) }}?home=1" title="Delete"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a></span>
									</td>
								</tr>
							@endforeach
						@else
							No products found
						@endif
					</tbody>
				</table>
			</div>
		</div>
		<!-- Latest Deals -->
		<div class="row">
			<div class="col-sm-12">
				<h3 class="back_grey">Latest 5 Deals</h3>
				<table class="table table-striped table-hover latest_deals">
					<thead>
						<th><b>#</b></th>
						<th><b>Name</b></th>
						<th><b>Vendor</b></th>
						<th><b>Store Name</b></th>
						<th><b>Status</b></th>
						<th><b>Action</b></th>
					</thead>
					<tbody>
						<?php $deals = \App\Models\Deal::select('*')->orderBy('offerId', 'desc')->take(5)->get(); ?>
						@if (!empty($deals->all()))
							@foreach ($deals as $key=>$deal)
							<tr>
								<td>{{@$key+1}}</td>
								<td>{{@$deal->offerName}}</td>
								<td>{{@$deal->vendor->username}}</td>
								<td>{{@$deal->store->storeName}}</td>
								<td>{!!  strtotime($deal->offerEndDate) < strtotime('now') ? '<span class="label label-danger">Expired</span>' : '<span class="label label-success">Available</span>'  !!}</td>
								<td>
									@if ($deal->visible == 'no')
										<a href="{{ Helper::adminUrl('deal/visibility/visible', [$deal->offerId]) }}?home=1" title="Approve"><i class="btn btn-default btn-sm fa fa-check-circle fa-lg" aria-hidden="true"></i></a>
									@else
										<a href="{{ Helper::adminUrl('deal/visibility/hidden', [$deal->offerId]) }}?home=1" title="Disapprove"><i class="btn btn-default btn-sm fa fa-ban fa-lg" aria-hidden="true"></i></a>
									@endif
									<a href="{{ Helper::adminUrl('deal/edit', [$deal->offerId]) }}" title="Edit"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
									<a href="{{ Helper::adminUrl('deal/delete', [$deal->offerId]) }}?home=1" title="Delete"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
								</td>
							</tr>
							@endforeach
						</table>
						@else
						No deals to approve
						@endif
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h3 class="back_grey">Unapproved Poducts</h3>
				<?php $products = \App\Models\Product::select('productId', 'productVendorId', 'productName')->with('vendor')->where('visible', 'no')->take(10)->get(); ?>
				@if (!empty($products->all()))
				<table class="table table-striped unapproved_products table-hover">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Vendor</th>
						<th>Action</th>
					</tr>
					@foreach ($products as $product)
					<tr>
						<td>{{@$product->productId}}</td>
						<td>{{@$product->productName}}</td>
						<td>{{@$product->store->storeName}}</td>
						<td>
							@if ($product->visible == 'no')
								<a href="{{ Helper::adminUrl('product/visibility/visible', [$product->productId]) }}?home=1" title="Approve"><i class="btn btn-default btn-sm fa fa-check-circle fa-lg" aria-hidden="true"></i></a> 
							@else
								<a href="{{ Helper::adminUrl('product/visibility/hidden', [$product->productId]) }}?home=1" title="Disapprove"><i class="btn btn-default btn-sm fa fa-ban fa-lg" aria-hidden="true"></i></a> 
							@endif
							<a href="{{ Helper::adminUrl('product/edit', [$product->productId]) }}" title="Edit"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
							<a class="delete" href="{{ Helper::adminUrl('product/delete', [$product->productId]) }}?home=1" title="Delete"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
						</td>
					</tr>
					@endforeach

				</table>
				@else
				No products to approve
				@endif
			</div>
			<div class="col-sm-6">
				<h3 class="back_grey">Unapproved Deals</h3>
				<?php $deals = \App\Models\Deal::select('offerId', 'offerVendorId', 'offerName')->with('vendor')->where('visible', 'no')->take(10)->get(); ?>
				@if (!empty($deals->all()))
				<table class="table table-striped unapproved_deals table-hover">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Vendor</th>
						<th>Action</th>
					</tr>

					@foreach ($deals as $deal)
					<tr>
						<td>{{@$deal->offerId}}</td>
						<td>{{@$deal->offerName}}</td>
						<td>{{@$deal->vendor->username}}</td>
						<td>
							@if ($deal->visible == 'no')
								<a href="{{ Helper::adminUrl('deal/visibility/visible', [$deal->offerId]) }}?home=1" title="Approve"><i class="btn btn-default btn-sm fa fa-check-circle fa-lg" aria-hidden="true"></i></a>
							@else
								<a href="{{ Helper::adminUrl('deal/visibility/hidden', [$deal->offerId]) }}?home=1" title="Disapprove"><i class="btn btn-default btn-sm fa fa-ban fa-lg" aria-hidden="true"></i></a>
							@endif
							<a href="{{ Helper::adminUrl('deal/edit', [$deal->offerId]) }}" title="Edit"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
							<a href="{{ Helper::adminUrl('deal/delete', [$deal->offerId]) }}?home=1" title="Delete"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
						</td>
					</tr>
					@endforeach

				</table>
				@else
				No deals to approve
				@endif
			</div>
		</div>
	</div>
	@else
	<div class="col-sm-12">
		<div class="row dashboard_summary">
			{!!Helper::alert()!!} 
			<div class="col-sm-3 widget-1">
				<a href="{{ Helper::adminUrl('product') }}">
					<div class="widget">
						<div class="row">
							<div class="col-sm-4">
								<h3><i class="fa fa-thumbs-up fa-3x"></i></h3>
							</div>
							<div class="col-sm-8">
								<h3>Products</h3>
								<p>Total: {{ \App\Models\Product::where('productVendorId', Auth::id())->count() }}</p>
								<p>Approved: {{ \App\Models\Product::where('productVendorId', Auth::id())->where('visible', 'yes')->count() }}</p>
								<p>Unapproved: {{ \App\Models\Product::where('productVendorId', Auth::id())->where('visible', 'no')->count() }}</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-3 widget-1">
				<a href="{{ Helper::adminUrl('deal') }}">
					<div class="widget">
						<div class="row">
							<div class="col-sm-4">
								<h3><i class="fa fa-thumbs-up fa-3x"></i></h3>
							</div>
							<div class="col-sm-8">
								<h3>Deals</h3>
								<p>Total: {{ \App\Models\Deal::where('offerVendorId', Auth::id())->count() }}</p>
								<p>Approved: {{ \App\Models\Deal::where('offerVendorId', Auth::id())->where('visible', 'yes')->count() }}</p>
								<p>Unapproved: {{ \App\Models\Deal::where('offerVendorId', Auth::id())->where('visible', 'no')->count() }}</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-3 widget-1">
				<a href="{{ Helper::adminUrl('event') }}">
					<div class="widget">
						<div class="row">
							<div class="col-sm-4">
								<h3><i class="fa fa-thumbs-up fa-3x"></i></h3>
							</div>
							<div class="col-sm-8">
								<h3>Events</h3>
								<p>Total: {{ \App\Models\Event::where('eventVendorId', Auth::id())->count() }}</p>
								<p>Approved: {{ \App\Models\Event::where('eventVendorId', Auth::id())->where('eventStatus', 'active')->count() }}</p>
								<p>Unapproved: {{ \App\Models\Event::where('eventVendorId', Auth::id())->where('eventStatus', 'inactive')->count() }}</p>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<!-- Validate Coupon -->
		<div class="row validate_deal_section">
			<div class="col-sm-12">
				<h3 class="back_grey">Validate Deal Code</h3>
				<?= Helper::inlineError() ?>
				<form action="<?= Helper::adminUrl('sale/validate-deal') ?>" method="get" class="form-horizontal">
					<div class="form-group {{$errors->has('deal_code') ? 'has-error' : '' }}">
						<label class="col-sm-12">Enter Code</label>
						<div class="col-sm-12">
							<input type="text" name="deal_code" class="form-control">
							<div class="help-block">{{$errors->first('deal_code')}}</div>
						</div>
					</div>
					<div class="form-group">

						<div class="col-sm-12">
							<input type="submit" value="Validate" class="btn btn-primary">
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
				@if (!empty(session('current_deal')))
				<table class="table table-hover">
					<thead>
						<tr class="headings">
							<th>Name</th>
							<th>Vendor</th>
							<th>Buyer</th>
							<th>Offer Name</th>
							<th>Code</th>
							<th>Type</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$cdeal = session('current_deal');
						switch ($cdeal->status) {
							case 'used':
							$stat_class = 'success';
							$cdeal->status = 'consumed';
							break;

							case 'not-used':
							$stat_class = 'default';
							$cdeal->status = 'bought';
							break;
						}
						if ($cdeal->status != 'used' && $cdeal->deal->offerEndDate < date('Y-m-d')){
							$stat_class = 'danger';
							$cdeal->status = 'expired';
						}
						?>
						<tr>
							<td class="has-options">
								{{$cdeal->deal->offerName}}
								<span>
									<a href="{{Helper::adminUrl('deal/edit', [$cdeal->id])}}">View</a> @if ($cdeal->status !== 'used' && $cdeal->status !== 'expired') | <a href="{{Helper::adminUrl('sale/approve-deal')}}?deal={{$cdeal->id}}">Approve</a> @endif
								</span>
							</td>
							<td>{{@$cdeal->store->storename}}</td>
							<td>{{@$cdeal->buyer->username}}</td>
							<td>{{@$cdeal->deal->offerName}}</td>
							<td>{{@$cdeal->code}}</td>
							<td>{{@$cdeal->deal->offerType}}</td>
							<td><label class="label label-{{$stat_class}}">{{ucwords($cdeal->status)}}</label></td>
						</tr>
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>
	@endif
</div>
@stop
<?php 
	if(session('scroll') !== NULL){ ?>
		@section('after_footer')
		<script>
			jQuery(function($){
				var width = jQuery(document).width();
				if(width > 786){
					$('html, body').animate({
				        scrollTop: $("#valid_code").offset().top-40
				    }, 1000);
				}else{
					$('html, body').animate({
				        scrollTop: $("#valid_code").offset().top
				    }, 1000);
				}
			});
		</script>
		@stop
	<?php }
?>