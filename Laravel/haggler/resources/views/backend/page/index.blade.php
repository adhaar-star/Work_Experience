<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 category_heading">
			<h3>Pages <a href="{{Helper::adminUrl('page/create')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New</a></h3>
			{!!Helper::alert()!!}
			<div class="table-responsive">

			@if (!empty($pages->all()))
				<table class="table table-hover">
					<thead>
						<tr class="headings">
							<th>#</th>
							<th>Title</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($pages as $page)
						<tr>
							<th scope="row">{{$page->id}}</th>
							<td class="has-options">
							{{$page->title}}
							<span></span>
							</td>
							<td>
								<a href="{{ Helper::adminUrl('page/edit', [$page->id]) }}"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
								<a href="{{ Helper::adminUrl('page/delete', [$page->id]) }}"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>

				{!!$pages->render()!!}

			@else
			<p>No records to display!</p>
			@endif
			</div>
		</div>
	</div>
</div>
@stop