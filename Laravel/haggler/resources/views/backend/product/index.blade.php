<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="col-md-12">
        {!!Helper::alert()!!}
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Filter Products <a href="{{ Helper::adminUrl('product/create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Product</a></h3>
			</div>
			<div class="panel-body">
				<!-- <div class="row"> -->
				<div class="col-sm-12">
					<div class="back_filter">

						<form>
							<div class="col-sm-2">
								<div class="form-gorup">
									<label>Search</label>
									<div class="col-sm-12 nopadding">
										<input type="text" value="{{Input::get('q')}}" name="q" class="form-control ">
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-gorup">
									<label>From</label>
									<div class="col-sm-12 nopadding">
										<input type="text" value="{{Input::get('from')}}" name="from" class="form-control datepicker ">
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-gorup">
									<label>To</label>
									<div class="col-sm-12 nopadding">
										<input type="text" value="{{Input::get('to')}}" name="to"  class="form-control datepicker ">
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-gorup">
									<label>Vendor</label>
									<div class="col-sm-12 nopadding">
										<select class="form-control" name="vendor">

											<option value="">All</option>

											<?php
											$s = \App\Models\Store::all();

											if (!empty($s)) {

												?>
												@foreach ($s as $i)
												<option value="{{$i->vendorId}}"  {{(\Input::get('vendor') == $i->vendorId ) ? 'selected' : ''  }}>{{@$i->storeName}}</option>
												@endforeach
											<?php } ?>

										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-gorup">
									<label>&nbsp;</label>
									<div class="col-sm-12">
										<button class="btn btn-primary">Filter</button>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Manage Products</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							@if (!empty($products->all()))
								<table class="table table-hover products_table">
									<thead>
										<tr class="headings">
											<th>#</th>
											<th>Name</th>
											<th>Store</th>
											<th>Categories</th>
											<th>Thumbnail</th>
											<th>Price</th>
											<th>Offer</th>
											<!-- <th>OfferEndDate</th> -->
											<th>Action</th>
											<!-- <th>Created</th>
											<th>Updated</th> -->
										</tr>
									</thead>
									<tbody>
										@foreach ($products as $key => $product)
											<tr>
												<th scope="row">{{$product->productId}}</th>
												<td style="width:296px">{{$product->productName}}</td>
												<td>{{@$product->store->storeName}}</td>
												<td>{{\App\Models\Product::categoryNames($product)}}</td>
												<td><img src="{{$product->thumbnail}}" width="100" alt="{{$product->productName}}"></td>
												<td>{{@$product->productPrice}}</td>
												<td>{{(@$product->hasOffer == 'yes' ? 'yes' : 'na' ) }}</td>
												<!-- <td>{{@$product->offerEndDate}}</td> -->
												<td>
													<span>
														@if (Auth::user()->role == 'admin') 
															@if ($product->visible == 'no')
																<a href="{{ Helper::adminUrl('product/visibility/visible', [$product->productId]) }}" title="Approve"><i class="btn btn-default btn-sm fa fa-check-circle fa-lg" aria-hidden="true"></i></a> 
															@else
																<a href="{{ Helper::adminUrl('product/visibility/hidden', [$product->productId]) }}" title="Disapprove"><i class="btn btn-default btn-sm fa fa-ban fa-lg" aria-hidden="true"></i>
															</a> 
															@endif
														@endif
														<a href="{{ Helper::adminUrl('product/edit', [$product->productId]) }}" title="Edit"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
														<a class="delete" href="{{ Helper::adminUrl('product/delete', [$product->productId]) }}" title="Delete"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
													</span>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								{!!$products->render()!!}
							@else
								<p>No records to display!</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- </div> -->
</div>
@stop
@section('after_footer')
<script src="{{url('assets/jquery-ui/jquery-ui.min.js')}}"></script>
@stop