<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h3>Deals Histroy</h3>

			{!!Helper::alert()!!}

			<div class="table-responsive">

			@if (!empty($deals->all()))
				<table class="table table-hover">
					<thead>
						<tr class="headings">
							<th>#</th>
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
						@foreach ($deals as $deal)
						<tr>
							<th scope="row">{{$deal->id}}</th>
							<td class="has-options">
							{{$deal->deal->offerName}}
							</td>
							<td>{{$deal->vendor->username}}</td>
							<td>{{$deal->buyer->username}}</td>
							<td>{{$deal->deal->offerName}}</td>
							<td>{{$deal->code}}</td>
							<td>{{$deal->deal->offerType}}</td>
							<td>
								<?php

								$stat_class = "";
								
								switch ($deal->status) {
									case 'used':
										$stat_class = 'success';
									break;

									case 'not-used':
										$stat_class = 'default';
									break;
								}

								if ($deal->status != 'used' && $deal->deal->offerEndDate < date('Y-m-d'))
									$stat_class = 'danger';
									$deal->status = 'expired';
								?>
								<label class="label label-{{$stat_class}}">{{ucwords($deal->status)}}</label>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>

				{!! $deals->render() !!}
			@else
			<p>No records to display!</p>
			@endif
			</div>
		</div>
	</div>
</div>
@stop

@section('after_footer')

<script src="{{url('assets/jquery-ui/jquery-ui.min.js')}}"></script>

@stop