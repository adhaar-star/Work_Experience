<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="col-md-12">
		{!!Helper::alert()!!}
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Filter Events <a href="{{ Helper::adminUrl('event/create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Event</a></h3>
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
									<label>Venue</label>
									<div class="col-sm-12 nopadding">
										<input type="text" value="{{Input::get('vn')}}" name="vn"  class="form-control">
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
				<h3 class="panel-title">Manage Events</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							@if (!empty($events->all()))
							<table class="table table-hover">
								<thead>
									<tr class="headings">
										<th>#</th>
										<th>Title</th>
										<th>Venue</th>
										<th>Thumbnail</th>
										<th>Timing</th>
										<th>Created</th>
										<th>Updated</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($events as $event)
									<tr>
										<th scope="row">{{$event->eventId}}</th>
										<td class="has-options">{{$event->eventTitle}}</td>
										<td>{{@$event->eventAddress}}</td>
										<td><img src="{{$event->eventImage}}" width="100" alt="{{$event->eventImage}}"></td>
										<td>{{$event->eventStartDate}} <abbr>--</abbr> {{$event->eventEndDate}}</td>
										<td>{{$event->created_at}}</td>
										<td>{{$event->updated_at}}</td>
										<td>
											<a href="{{ Helper::adminUrl('event/edit', [$event->eventId]) }}"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
											<a href="{{ Helper::adminUrl('event/delete', [$event->eventId]) }}"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
										</td>
									</tr>
									@endforeach

								</tbody>
							</table>
							{!!$events->render()!!}
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