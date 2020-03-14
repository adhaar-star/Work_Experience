<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 category_heading">
			<h3>Categories <a href="{{Helper::adminUrl('category/create')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New</a></h3>
			{!!Helper::alert()!!}
			<div class="table-responsive">

			@if (!empty($categories->all()))
				<table class="table table-hover">
					<thead>
						<tr class="headings">
							<th>#</th>
							<th>Category Name</th>
							<th>Parent Category</th>
							<th>Thumbnail</th>
							<th>Commission (%)</th>
							<th>Created</th>
							<th>Updated</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($categories as $category)
						<tr>
							<th scope="row">{{$category->categoryId}}</th>
							<td class="has-options">
							{{$category->categoryName}}
							<span><a href="{{ Helper::adminUrl('category/edit', [$category->categoryId]) }}">Edit</a> | <a href="">Delete</a></span>
							</td>
							<td>{{@$category->parent_category->categoryName}}</td>
							<td><img src="{{$category->categoryImage}}" width="100" alt="{{$category->categoryName}}"></td>
							<td>{{$category->categoryPercentage}}</td>
							<td>{{$category->created_at}}</td>
							<td>{{$category->updated_at}}</td>
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
@stop