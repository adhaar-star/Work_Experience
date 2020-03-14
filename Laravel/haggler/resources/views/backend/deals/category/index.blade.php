<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="col-md-12">
		<div class="panel panel-default">
			{!!Helper::alert()!!}
			<div class="panel-heading">
				<h3 class="panel-title">Categories <a href="{{ Helper::adminUrl('deal/category/create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Category</a></h3>
			</div>
			<div class="panel-body">
				<div class="col-sm-12 category_heading">
					<div class="table-responsive">
						@if (!empty($categories->all()))
							<table class="table table-hover">
								<thead>
									<tr class="headings">
										<th>#</th>
										<th>Category Name</th>
										<th>Thumbnail</th>
										<th>Created</th>
										<th>Updated</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($categories as $category)
									<tr>
										<th scope="row">{{$category->categoryId}}</th>
										<td class="">
										{{$category->categoryName}}
										</td>
										<td><img src="{{$category->categoryImage}}" width="100" alt="{{$category->categoryName}}"></td>
										<td>{{$category->created_at}}</td>
										<td>{{$category->updated_at}}</td>
										<td>
											<a href="{{ Helper::adminUrl('deal/category/edit', [$category->categoryId]) }}"><i class="btn btn-default btn-sm fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
											<a href="{{ Helper::adminUrl('deal/category/delete', [$category->categoryId]) }}"><i class="btn btn-default btn-sm fa fa-trash fa-lg" aria-hidden="true"></i></a>
										</td>
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
@stop