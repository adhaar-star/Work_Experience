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
<meta name="csrf-token" content="{{ csrf_token() }}" /> 
@section('PageCss')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
<div class="alert alert-success message" style="display: none">
  <span class="glyphicon glyphicon-ok"></span>
  <em id="msg"></em>
</div>
<section class="panel">
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1>Manual Capacity Planning</h1>
                <a href="{{url('admin/manualCapacity/create')}}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Create Manual Capacity Planning
                </a>
            </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                    </li>
                    <li>
                        <span>Manual Capacity Planning</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="margin-bottom-50">
            <table class="table table-inverse" id="DateTablePPMHUB" width="100%" data-url="{{route('portfolioCapacity-manual-data-table')}}">
                <thead>
                    <tr>
                        <th>Portfolio ID</th>
                        <th>Portfolio Name</th>
                        <th>Bucket</th>
                        <th>View</th>
                        <th>Group</th>
                        <th>Category</th>
                        <th>Hours</th>
                        <th>Created Date</th>
                        <th>Action</th>
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
{!! Html::script('/js/manual_capacity_dashboard.js') !!}
@endsection