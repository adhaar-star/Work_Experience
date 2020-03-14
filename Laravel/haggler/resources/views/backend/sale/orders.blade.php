<?php
use \App\Models\Helper;

$orderStatus = App\Models\Order::orderStatus();

?>
@section('content')

<div class="container-fluid">

	<div class="col-md-12">
		{!!Helper::alert()!!}
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Filter Orders </h3>
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
							<div class="col-sm-3">
								<div class="form-gorup">
									<label>From</label>
									<div class="col-sm-12 nopadding">
										<input type="text" value="{{Input::get('from')}}" name="from" class="form-control datepicker ">
									</div>
								</div>
							</div>
							<div class="col-sm-3">
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
										<select class="form-control" name="o_s">
											<option value="">All</option>
											@if(!empty($orderStatus))
													@foreach($orderStatus as $key=>$status)
														<option value="{{ $key }}" {{ Input::get('o_s') == $key ? 'selected' : '' }}>{{ $status }}</option>
													@endforeach
											@endif

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
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Manage Orders</h3>
				</div>
				<div class="panel-body">

			<div class="table-responsive">

			@if (!empty($orders->all()))
				<table class="table table-hover">
					<thead>
						<tr class="headings">
							<th>#</th>
							<th>Customer</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Date</th>
							@if(\Auth::user()->role == "admin")
							<th>Action</th>
							@endif
						</tr>
					</thead>
					<tbody>

						@foreach ($orders as $order)
						<tr>
							<th scope="row">{{$order->id}}</th>
							<td class="has-options">{{$order->name}}</td>
							<td>{{$order->total}}</td>
							<td>
								@if(\Auth::user()->role == "admin")
								<select class="form-control" style="width:125px;" id="select-{{ $order->id}}">
									<?php
									$orderStatus = App\Models\Order::orderStatus();
									?>
									@foreach($orderStatus as $key=>$status)
										<option value="{{ $key }}" {{ $order->order_status == $key ? 'selected' : ''  }}>{{ $status }}</option>
									@endforeach
								</select>

									@else
									     {{ $order->order_status }}
									@endif

							</td>
							<td>{{$order->created_at}}</td>
							@if(\Auth::user()->role == "admin")
								<td>
									<form id="form-{{ $order->id }}" method="post" action="{{Helper::adminUrl('sale/order')}}" style="display: inline;">
										{{ csrf_field() }}
										<input type="hidden" name="order_id" value="{{ $order->id }}">
										<input type="hidden" name="status" id="status-{{ $order->id }}" >
										<a href="javascript:void(0)" data-id="{{ $order->id }}" class="update_status"><i class="btn btn-default btn-sm fa fa-upload fa-lg" aria-hidden="true"></i></a>
									</form>
									<a href="{{Helper::adminUrl('sale/order/view/'.$order->id)}}" target="_blank"><i class="btn btn-default btn-sm fa fa-eye fa-lg" aria-hidden="true"></i></a>
								</td>
								@endif
						</tr>
						@endforeach

					</tbody>
				</table>

				{!! $orders->render() !!}
			@else
			<p>No records to display!</p>
			@endif
			</div>
		</div>
			</div>
	</div>
</div>
@stop

@section('after_footer')

<script src="{{url('assets/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
	jQuery(function($){
       $('.update_status').on("click",function(){
       	   
       	   var o = $(this).data('id');
       	   $('#status-'+o).val($("#select-"+o).val());
       	   $('#form-'+o).submit();
       });
	});
</script>

@stop