<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
	<div class="row">
	   <div class="col-md-12">
	   		{!!Helper::alert()!!}
		   	<div class="panel panel-default">
		   		<div class="panel-heading">
		   			<h3 class="panel-title">Set Vendor Permissions</h3>
		   		</div>
		   		<div class="panel-body">
		   			<div class="col-sm-12">
		   				<div class="back_filter">
		   					<form method="post" action="<?= Helper::adminUrl('user/permissions') ?>">
		   						{{csrf_field()}}
		   						<div class="row">
			   						<div class="col-sm-2">
			   							<label>Products Access</label>
			   						</div>
			   						<div class="col-sm-10">
										<div class="checkbox">
											<label><input type="checkbox"  name="product_add" {{$productPr['add']==1?'checked':''}}>Add</label>
										</div>
										<div class="checkbox">
											<label><input type="checkbox"  name="product_edit" {{$productPr['edit']==1?'checked':''}}>Edit</label>
										</div>
										<div class="checkbox">
											<label><input type="checkbox"  name="product_delete" {{$productPr['delete']==1?'checked':''}}>Delete</label>
										</div>
			   						</div>
			   					</div>
			   					<div class="row">
			   						<div class="col-sm-2">
			   							<label>Deals Access</label>
			   						</div>
			   						<div class="col-sm-10">
										<div class="checkbox">
											<label><input type="checkbox" name="deal_add" {{$dealPr['add']==1?'checked':''}}>Add</label>
										</div>
										<div class="checkbox">
											<label><input type="checkbox" name="deal_edit" {{$dealPr['edit']==1?'checked':''}}>Edit</label>
										</div>
										<div class="checkbox">
											<label><input type="checkbox" name="deal_delete" {{$dealPr['delete']==1?'checked':''}}>Delete</label>
										</div>
			   						</div>
			   					</div>
			   					<div class="row">
			   						<div class="col-sm-2">
			   							<label>Events Access</label>
			   						</div>
			   						<div class="col-sm-10">
										<div class="checkbox">
											<label><input type="checkbox"  name="event_add" {{$eventPr['add']==1?'checked':''}}>Add</label>
										</div>
										<div class="checkbox">
											<label><input type="checkbox"  name="event_edit" {{$eventPr['edit']==1?'checked':''}}>Edit</label>
										</div>
										<div class="checkbox">
											<label><input type="checkbox"  name="event_delete" {{$eventPr['delete']==1?'checked':''}}>Delete</label>
										</div>
			   						</div>
			   					</div>
			   					<div class="row">
			   						<div class="col-sm-12">
			   							<button type="submit" class="btn btn-theme" name="submit">Update</button>
			   						</div>
			   					</div>
		   					</form>
		   				</div> 
		   			</div>
		   		</div>
		   	</div>
	   </div>
	</div>
</div>
@stop