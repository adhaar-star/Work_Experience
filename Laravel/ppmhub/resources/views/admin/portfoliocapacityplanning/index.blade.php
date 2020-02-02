@extends('layout.admin')
@section('title', 'Portfolio Capacity Planning')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
<section class="panel">
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1>Portfolio Capacity Planning</h1>
            </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                    </li>
                    <li>
                        <span>Portfolio Capacity Planning</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-12 margin-bottom-15">
                <a href="{{route('portfolio-cp.dashboard', null)}}" class="btn btn-warning btn-sm">
                    <i class="fa fa-plus-circle"></i> Capacity Planning-Projects
                </a>
                <a href="{{route('manualCapacity.dashboard')}}" class="btn btn-primary btn-sm">
                    <i class="fa fa-dashboard"></i> Manual Capacity Planning
                </a>
                <a href="{{route('portfolio-cp.graphics.dashboard')}}" class="btn btn-success btn-sm">
                    <i class="fa fa-area-chart"></i> Portfolio Graphic
                </a>
            </div>
        </div>
        <div class="margin-bottom-50">
            <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                <thead>
                    <tr>
                        <th>Portfolio ID</th>
                        <th>Portfolio Name</th>
                        <th>Created Date</th>
                        <th>Created By</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
{!! Html::script('vendors/jqueryDataTable/jquery.dataTables.min.js') !!}
<script type="text/javascript">
  $(document).ready(function () {
      var table = $("#DateTablePPMHUB").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{!! route('portfolioCapacity-data-table') !!}',
          columns: [
              {data: 'port_id', name: 'port_id'},
              {data: 'name', name: 'name'},
              {data: 'created_at', name: 'created_at'},
              {data: 'created_by', name: 'created_by'},
          ]
      });
      table.draw();
  });
  //        orderable: false, searchable: false
</script>
@endsection