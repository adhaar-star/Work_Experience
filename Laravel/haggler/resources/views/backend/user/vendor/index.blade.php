<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid" xmlns:Input="http://www.w3.org/1999/xhtml">
	<div class="col-md-12">
        {!!Helper::alert()!!}
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Filter Vendors <a href="{{ Helper::adminUrl('user/vendor/create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Vendor</a></h3>
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
									<label>Status</label>
									<div class="col-sm-12 nopadding">
										<select class="form-control" name="st">
											<option value="active" {{ Input::get('st') == 'active' ? 'selected' : '' }}>Active</option>
											<option value="inactive" {{ Input::get('st') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
				<h3 class="panel-title">Manage Vendors</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							@if (!empty($vendors->all()))
							<table class="table table-hover">
								<thead>
									<tr class="headings">
										<th>#</th>
										<th>Vendor Name</th>
										<th>Store Name</th>
										<th>Email</th>
										<th>Status</th>
										<th>Created</th>
										<th>Updated</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($vendors as $vendor)
									
									<tr>
										<th scope="row">{{$vendor->id}}</th>
										<td class="has-options">{{$vendor->username}}</td>
										<td>{{@$vendor->store->storeName}}</td>
										<td>{{$vendor->email}}</td>
										<td>{{$vendor->status}}</td>
										<td>{{$vendor->created_at}}</td>
										<td>{{$vendor->updated_at}}</td>
										<td>
											<a href="{{ Helper::adminUrl('user/vendor/edit', [$vendor->id]) }}"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
											@if ( isset($vendor->store->storeId) )<a href="{{ Helper::adminUrl('store/edit', [$vendor->store->storeId]) }}"><i class="btn btn-default btn-sm fa fa-home fa-lg" aria-hidden="true"></i></a>  @endif
											<a href="{{ Helper::adminUrl('user/vendor/delete', [$vendor->id]) }}"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
										</td>
									</tr>
									@endforeach

								</tbody>
							</table>
								{!!$vendors->render()!!}
								@else
								<p>No records to display!</p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop