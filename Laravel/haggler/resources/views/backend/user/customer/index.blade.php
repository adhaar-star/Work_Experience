<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="row">
	<div class="col-md-12" style="padding-bottom:37px">
			{!!Helper::alert()!!}


			
		
	</div>
		<div class="col-sm-12">
			<div class="table-responsive">

			@if (!empty($customers->all()))
				<table class="table table-hover">
					<thead>
						<tr class="headings">
							<th>#</th>
							<th>Username</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Reward Points</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($customers as $customer)
						
						<tr> 
							<th scope="row">{{$customer->id}}</th>
							<td class="has-options">{{$customer->username}}</td>
							<td>{{$customer->email}}</td>
							<td>{{$customer->phone_number}}</td>
							<td>@if(!empty($customer->address->all()))
                                  @foreach($customer->address->all() as $address)
                                  <p>{{ $address->address }} 
                                   @if(!empty($address->type))
                                      (<i>{{ $address->type }}</i>)
                                   @endif
                                  </p>
                                  @endforeach
							  @endif</td>
							 <td>{{ (@$customer->reward->reward_point) ? $customer->reward->reward_point : 0 }}</td> 
							<td>{{$customer->status}}</td>
							<td>
								<a href="{{ Helper::adminUrl('user/customer/edit', [$customer->id]) }}"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
								<a href="{{ Helper::adminUrl('user/customer/delete', [$customer->id]) }}"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
				{!!$customers->render()!!}
			@else
			<p>No records to display!</p>
			@endif
			</div>
		</div>
	</div>
</div>
@stop