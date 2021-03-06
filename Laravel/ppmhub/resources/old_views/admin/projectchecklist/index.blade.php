@extends('layout.adminlayout')
@section('title','Project | Project Checklist')
@section('headjscss')
<link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
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
                  <div class="x_title">
                    <h2>Project Checklist</h2>
                    <a href="{{url('admin/projectchecklist/create')}}" class="btn btn-sm btn-primary pull-right">Create Project Checklist</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>Checklist ID</th>
                          <th>Checklist Name</th>
                          <th>Checklist Type</th>
                          <th>Project Name</th>
                          <th>Status</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Phase Reference</th>
                          <th>Created on</th>
                          <th>Created by</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($projectchecklist as $projchecklist)
                        	<tr>
                        		<td>{{$projchecklist->checklist_Id }}</td>
                        		<td>{{$projchecklist->checklist_name}}</td>
                        		<td>{{$projchecklist->checklist_type }}</td>
                        		<td>{{$projchecklist->project_id }}</td>
                        		<td>
									@if($projchecklist->status==1)
									<button type="button" class="btn btn-success btn-xs">Active</button>
									@else
									<button type="button" class="btn btn-danger btn-xs">Inactive</button>
	                        		@endif
                        		</td>
                        		<td>{{$projchecklist->start_date }}</td>
                        		<td>{{$projchecklist->end_date }}</td>
                        		
                        		<td>{{$projchecklist->reference_phase }}</td>
                        		<td>{{$projchecklist->created_date }}</td>
                        		<td>{{$projchecklist->created_by }}</td>
                        		<td style="text-align: center;">
                        			<a href="{{url('admin/projectchecklist/'.$projchecklist->id.'/edit')}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                        			<form action="{{url('admin/projectchecklist/'.$projchecklist->id)}}" method="post" id="delform">
                        			{{ method_field('DELETE') }}
                        			{{ csrf_field() }}
                        			<a href="javascript:void(0)" onclick="var res=confirm('Are you sure you want to delete this project checklist'); if(res){document.getElementById('delform').submit()}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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