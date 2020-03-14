<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">

	<div class="col-md-12">
		{!!Helper::alert()!!}

		@if(\Auth::user()->role != 'admin')
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Wallet</h3>
			</div>
			<div class="panel-body">

			<div class="row dashboard_summary">
				<div class="col-sm-4">
					<div class="widget">
						<div class="row">
							<div class="col-sm-12">
								<p>Total Amount Available</p>
								<p>{{ (@$wallet->amount) ? @$wallet->amount : 0 }}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="widget">
						<div class="row">
							<div class="col-sm-12">
								<p>Total Amount Redeemed</p>
								<p>{{ (@$wallet->redeemed) ? @$wallet->redeemed : 0 }}</p>
							</div>
						</div>
					</div>
				</div>

				@if(@$wallet->amount > 0)
					<div class="col-sm-4">
						<div class="widget">
							<div class="row">
								<div class="col-sm-12">
									<form method="post" action="{{ Helper::adminUrl('wallet/redeem-request') }}">
										{{ csrf_field() }}
										<lable><h5>Enter Amount To Redeem  (Max Amount: {{ @$wallet->v_amount }})</h5></lable>
										<div class="form-group">
											<input type="text" class="form-control" name="redeem_amount">
										</div>
										<div class="help-block">{{ $errors->first('redeem_amount') }}</div>
										<div class="form-group text-center">
											<input type="submit" class="btn btn-primary" name="redeem_button" value="Redeem">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>

		    </div>
		</div>



		@endif


	</div>
	<!--  -->

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Payment Requests </h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							@if (!empty($walletRequests->all()))
								<table class="table table-hover wallet_table">
									<thead>
									<tr class="headings">
										<th>#</th>
										<th>Name</th>
										<th>Email</th>
										<th>Request Amount</th>
										<th>Status</th>
										@if(\Auth::user()->role == 'admin')
											<th colspan="2">Action</th>
									    @endif
									</tr>
									</thead>
									<tbody>
									@foreach ($walletRequests as $key => $w)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{ @$w->user->username  }}</td>
											<td>{{ @$w->user->email  }}</td>
											<td>{{ $w->request_amount }}</td>
											<td>{{ $w->status }}</td>
											@if(\Auth::user()->role == 'admin')

												 @if($w->status == "pending")
												<td>
													<form id="form-{{ $w->id }}" method="post" action="{{Helper::adminUrl('wallet/request-status')}}">
														{{ csrf_field() }}
														<input type="hidden" name="request_id" value="{{ $w->id }}" />
														<input type="hidden" name="user_id" value="{{ $w->user_id }}" />

														<input type="hidden" name="request_amount" value="{{ $w->request_amount }}" />
														<select class="form-control" id="select-{{ $w->id }}" name="status">
															<option value="pending" {{ ($w->status == "pending") ? "selected" : '' }}>pending</option>
															<option value="approved" {{ ($w->status == "approved") ? "selected" : '' }}>approved</option>
															<option value="disapproved" {{ ($w->status == "disapproved") ? "selected" : '' }} >disapproved</option>
														</select>
														<a href="javascript:void(0)" class="update_status" target="_blank"><img src="{{ url('assets/images/submit.png') }}" width="30" height="30" /></a>
													</form>
												</td>

													 @else
													 <td>No action available.</td>
													 @endif





											@endif

										</tr>
									@endforeach
									</tbody>
								</table>

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
@stop
@section('after_footer')
<script src="{{url('assets/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
	jQuery(function(){
	    jQuery(".update_status").on("click",function(){
//	        var rid = jQuery(this).data("id");
//	        jQuery("#status-"+rid).val(jQuery("#select-"+rid).val());
//	        jQuery("#form-"+rid).submit();

            jQuery(this).closest('form').submit();
		});
	});
</script>
@stop