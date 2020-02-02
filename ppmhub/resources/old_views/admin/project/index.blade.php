@extends('layout.adminlayout')
@section('title','Project | Project')
@section('headjscss')
<link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
<style>
.project-top-btn {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background: #1abb9c none repeat scroll 0 0;
  border-color: currentcolor currentcolor #119a80;
  border-image: none;
  border-radius: 2px;
  border-style: none none solid;
  border-width: 0 0 3px;
  color: #fff;
  font-size: 14px;
  margin: 5px;
  position: relative;
  text-transform: uppercase;
}
.project_title {
  margin: 30px 0;
  position: relative;
}
.btn-color {
  background: #2a3f54 none repeat scroll 0 0;
  border: 0 none;
  border-radius: 0;
  color: #fff;
  font-size: 12px;
  padding: 7px;
}
.project-tableform label {
  float: left;
  line-height: 38px;
  width: 35%;
}
.project-tableform .form-control {
  width: 65%;
}
.project-tableform p {
  font-weight: 600;
  line-height: 38px;
}
.pro_table {
  float: left;
  margin-bottom: 30px;
  width: 100%;
}
input[type="radio"].custom {
	width: 25px;
	height: 25px;
	z-index: 9;
	position: absolute;
	opacity:0;
}

.custom-radio {
	width: 25px;
	height: 25px;
	opacity: 1;
	position: relative;
	top: 3px;
}

.yellow-light {
	background: url("../../images/yellow.png");
	opacity:0.45;
}

.green-light {
	background: url("../../images/green.png");
	opacity:0.45;
}

.red-light {
	background: url("../../images/red.png");
	opacity:0.45;
}
input.custom[type="radio"]:checked + .yellow-light, input.custom[type="radio"]:checked + .green-light, input.custom[type="radio"]:checked + .red-light {
	opacity:1;
}
</style>
@endsection
@section('body')
	@if(Session::has('flash_message'))
    <div class="alert alert-success">
    	<span class="glyphicon glyphicon-ok"></span>
    	<em> {!! session('flash_message') !!}</em>
    </div>
	@endif
		<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
				<div class="col-xs-12">
					<a href="#" class="btn project-top-btn">Project Scheduling</a>
					<a href="#" class="btn project-top-btn">Project Cost Planning</a>
					<a href="#" class="btn project-top-btn">Project Response Planning</a>
					<a href="#" class="btn project-top-btn">Project Risk Analysis</a>
					<a href="#" class="btn project-top-btn">Time Sheet</a>
					<a href="#" class="btn project-top-btn">Milestone Report</a>
					<a href="#" class="btn project-top-btn">Checklist Items Report</a>
					<a href="#" class="btn project-top-btn">Capacity & Finacial Report</a>
					<a href="#" class="btn project-top-btn">Project Cockpit</a>
					<a href="#" class="btn project-top-btn">Project Report</a>
				</div>
				<div class="col-xs-12">
					<div class="x_title project_title">
						<h2>Projects</h2>
						<a href="{{url('admin/project/create')}}" class="btn btn-sm btn-primary pull-right">Create Project</a>
						<div class="clearfix"></div>
					</div>
				</div>
				  
				<div class="col-xs-12">
					<div class="row">
						<div class="pro_table">
							<div class="col-sm-4">
								<div class="project-tableform">
									<div class="form-group">
										<label>Portfolio Name</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
										<label>Portfolio ID</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
										<label>Bucket Name</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
										<label>Bucket ID</label>
										<p>623487239488</p>
									</div>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="project-btnlist">
									<div class="buttons">
										<a href="#" class="btn btn-color">Change Portfolio</a>
									</div>
									<div class="buttons">
										<a href="#" class="btn btn-color">Change Bucket</a>
									</div>
									<div class="buttons">
										<a href="#" class="btn btn-color">Select Project from all Buckets</a>
										<a href="#" class="btn btn-color">My Projects</a>
										<a href="#" class="btn btn-color">My Tasks</a>
										<a href="#" class="btn btn-color">My Inbox</a>
										<a href="#" class="btn btn-color">Create New Project</a>
										<a href="#" class="btn btn-color">Change Projects</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>                 
				<div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr><th>Status</th>
                          <th>Project ID </th>
                          <th>Project Type</th>
                          <th>Buckets</th>
                          <th>Portfolio</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Project Reference</th>
                          <th>Created on</th>
                          <th>Created by</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($project as $proj)
                        	<tr>
							<td>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="row">
										<div class="col-sm-4">
											<div class="col-xs-3">
												<input type="radio" class="custom" name="status" value="1" <?php if(isset($portfoliotype) && $portfoliotype->status==1){ echo "checked"; } ?>> 
												<div class="custom-radio yellow-light"></div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="col-xs-3">
												<input type="radio" class="custom" name="status" value="0" <?php if(isset($portfoliotype) && $portfoliotype->status==0){ echo "checked"; } ?>>
												<div class="custom-radio red-light"></div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="col-xs-3">
												<input type="radio" class="custom" name="status" value="2" <?php if(isset($portfoliotype) && $portfoliotype->status==0){ echo "checked"; } ?>>
												<div class="custom-radio green-light"></div>
											</div>
										</div>
									</div>
								</div>
							</td>
                        		<td>{{$proj->project_Id }}</td>
                        		<td>{{$proj->project_type}}</td>
                        		
                        		<td>{{$proj->bucket_id }}</td>
                        		<td>{{$proj->portfolio_id }}</td>
                        		<td>{{$proj->start_date }}</td>
                        		<td>{{$proj->end_date }}</td>
                        		
                        		<td>{{$proj->project_ref }}</td>
                        		<td>{{$proj->created_date }}</td>
                        		<td>{{$proj->created_by }}</td>
                        		<td style="text-align: center;">
                        			<a href="{{url('admin/project/'.$proj->Id.'/edit')}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                        			<form action="{{url('admin/project/'.$proj->Id)}}" method="post" id="delform">
                        			{{ method_field('DELETE') }}
                        			{{ csrf_field() }}
                        			<a href="javascript:void(0)" onclick="var res=confirm('Are you sure you want to delete this Project'); if(res){document.getElementById('delform').submit()}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                        			</form>
                        		</td>
                        	</tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>
			</div>
        </div>
@endsection

@section('footerjscss')
<!-- Datatables -->
    <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
@endsection