<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="col-md-12">
		{!!Helper::alert()!!}
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Filter Deals <a href="{{ Helper::adminUrl('deal/create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Deal</a></h3>
			</div>
			<div class="panel-body">
				<!-- <div class="row"> -->
				<div class="col-sm-12">
					<div class="back_filter">

						<!-- filters -->
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
											if (!empty($s)) { ?>
												@foreach ($s as $i)
													<option value="{{$i->vendorId}}" {{(\Input::get('vendor') == $i->vendorId ) ? 'selected' : ''  }}>{{@$i->storeName}}</option>
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
				<h3 class="panel-title">Manage Deals</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							@if (!empty($deals->all()))
							<table class="table table-hover">
								<thead>
									<tr class="headings">
										<th>#</th>
										<th>Name</th>
										<th>StoreName</th>
										<th>Category</th>
										<th>Thumbnail</th>
										<th>Status</th>
										<th>Created</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($deals as $deal)
									<tr>
										<th scope="row">{{$deal->offerId}}</th>
										<td class="has-options">{{$deal->offerName}}</td>
										<td>{{@$deal->store->storeName}}</td>
										<td>{{@$deal->category->categoryName}}</td>
										<td><img src="{{$deal->offerImage}}" width="100" alt="{{$deal->offerName}}"></td>
										<td>{!!  strtotime($deal->offerEndDate) < strtotime('now') ? '<span class="label label-danger">Expired</span>' : '<span class="label label-success">Available</span>'  !!}</td>
										<td>{{$deal->created_at}}</td>
										<td>
											@if (Auth::user()->role == 'admin')
												@if ($deal->visible == 'no')
													<a href="{{ Helper::adminUrl('deal/visibility/visible', [$deal->offerId]) }}"><i class="btn btn-default btn-sm fa fa-check-circle fa-lg" aria-hidden="true"></i></a>
												@else
													<a href="{{ Helper::adminUrl('deal/visibility/hidden', [$deal->offerId]) }}"><i class="btn btn-default btn-sm fa fa-ban fa-lg" aria-hidden="true"></i></a>
												@endif
											@endif
											<a href="{{ Helper::adminUrl('deal/edit', [$deal->offerId]) }}"><i class="btn btn-default btn-sm hello fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
											<a href="{{ Helper::adminUrl('deal/delete', [$deal->offerId]) }}"><i class="btn btn-default hell btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{!!$deals->render()!!}
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