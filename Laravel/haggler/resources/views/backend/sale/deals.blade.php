<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="col-md-12">
		{!!Helper::alert()!!}
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Filter Deals</h3>
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
										<input type="text" placeholder="deal code" value="{{Input::get('code')}}" name="code" class="form-control">
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
									<label>type</label>
									<div class="col-sm-12 nopadding">
										<select class="form-control" name="type">
										<option value="all" {{ Input::get('type') == 'all' ? 'selected' : '' }}>All</option>
											<option value="free" {{ Input::get('type') == 'free' ? 'selected' : '' }}>Free</option>
											<option value="exclusive" {{ Input::get('type') == 'exclusive' ? 'selected' : '' }}>Exclusive</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-gorup">
									<label>Status</label>
									<div class="col-sm-12 nopadding">
										<select class="form-control" name="status">
											<option value="all">All</option>
											<option value="used" {{Input::get('status')=='used' ? 'selected' : ''}}>Consumed</option>
											<option value="un-used" {{Input::get('status')=='un-used' ? 'selected' : ''}}>Bought</option>
											<option value="expired" {{Input::get('status')=='expired' ? 'selected' : ''}}>Expired</option>
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
				<div class="row">
					<div class="col-sm-4"><h3 class="panel-title">Consumed Deals: {{$usedDeals}}</h3></div>
					<div class="col-sm-4"><h3 class="panel-title">Bought Deals: {{$unusedDeals}}</h3></div>
					<div class="col-sm-4"><h3 class="panel-title">Expired Deals: {{$expiredDeals}}</h3></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Deals data</h3>
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
										<th>Buyer</th>
										<th>Offer Name</th>
										<th>Code</th>
										<th>Type</th>
										<th>Price</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($deals as $deal)
									<tr>
										<?php //echo "<pre>"; var_dump($deal);exit; ?>
										<th scope="row">{{@$deal->id}}</th>
										<td class="has-options">{{@$deal->deal->offerName}}</td>
										<td>{{@$deal->buyer->username}}</td>
										<td>{{@$deal->deal->offerName}}</td>
										<td>{{@$deal->code}}</td>
										<td>{{@$deal->deal->offerType}}</td>
										<td>
											@if(@$deal->deal->offerType == 'exclusive')
												{{@$deal->deal->offerPrice}}
											@else
												{{@$deal->deal->productOfferPrice}}
											@endif
										</td>
										<td>
											<?php
											switch ($deal->status) {
												case 'used':
													$stat_class = 'success';
													$deal->status = 'consumed';
												break;

												case 'not-used':
													$stat_class = 'default';
													$deal->status = 'bought';
												break;
											}

											if(isset($deal->deal->offerEndDate)){
												if ($deal->status != 'used' && $deal->deal->offerEndDate < date('Y-m-d')) {
													$stat_class = 'danger';
													$deal->status = 'expired';
												}
                                            }
											?>
											<label class="label label-{{$stat_class}}">{{ucwords($deal->status)}}</label>
										</td>
										<td>
											@if ($deal->status !== 'consumed' && $deal->status !== 'expired')
												<a href="{{Helper::adminUrl('sale/approve-deal')}}?deal={{$deal->id}}">Validate</a>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{!! $deals->appends(Input::only('code','status','from','to','type'))->render() !!}
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
@stop