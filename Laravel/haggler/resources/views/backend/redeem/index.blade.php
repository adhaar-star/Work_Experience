<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="col-sm-12">
		{!!Helper::alert()!!}
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
@stop