@extends('layout.admin')
@section('title', 'Company Management | Manage User')
@section('body')
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
<section class="panel">
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1>User Management</h1>
                @if (RoleAuthHelper::hasAccess('user-management.create')!=true)  
                <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
                    @else
                    <a class="btn btn-primary btn-sm" href="{{ url('admin/user-managment/create')}}">@endif<i class="fa fa-plus"></i> Add New</a>          </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Company Management</a>
                    </li>
                    <li> <a href="{{url('admin/user-managment')}}">User Management</a></li>
                </ul>
            </div>
        </div>
        <div class="margin-bottom-50">
            <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Role Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    {!! Form::open(array('route' => array('user-management.dashboard'), 'method' => 'DELETE','id'=>'delform')) !!}

    {!! Form::close() !!}
</section>
@endsection
@section('PageJquery')
{!! Html::script('vendors/jqueryDataTable/jquery.dataTables.min.js') !!}
<script type="text/javascript">
  $(document).ready(function () {
      var table = $("#DateTablePPMHUB").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{!! route('user-managment-datatable') !!}',
          createdRow: function (row, data, dataIndex) {
              $(row).find('td:eq(4)').attr('class', 'action-btn');
          },
          columns: [
              {data: 'name', name: 'name'},
              {data: 'roles_master.role_name', name: 'roles_master.role_name'},
              {data: 'email', name: 'email'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', searchable: false, "orderable": false},
          ]
      });
      table.draw();
  });
  //        orderable: false, searchable: false
</script>
@endsection