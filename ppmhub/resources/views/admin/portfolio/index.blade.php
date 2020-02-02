
@extends('layout.admin')
@section('title', 'Portfolio | Portfolio')
@section('body')
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
<meta name="csrf-token" content="{{ csrf_token() }}" /> 
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
<style>
  .mybtn
  {

    min-width: 100px;
    text-align: center;
  }
  .label-warning{
    background-color: #F6A63F !important;
  }


</style>
@endsection
<div class="alert alert-success message" style="display: none">
  <span class="glyphicon glyphicon-ok"></span>
  <em id="msg"></em>
</div>
<div class="alert alert-danger message1 " style="display: none">
  <span class="glyphicon glyphicon-ok"></span>
  <em id="msg1"></em>
</div>
@if(Session::has('flash_message'))
<div class="alert alert-success myalert">
  <span class="glyphicon glyphicon-ok"></span>
  <em> {!! session('flash_message') !!}</em>
</div>
@endif

<section class="panel">
  <div class="panel-body">
    <div class="row PageTitleGlobal">
      <div class="col-md-6">
        <h1>Portfolio</h1>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if (RoleAuthHelper::hasAccess('portfolio.create')!=true)  
        <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
          @else
          <a href="{{url('admin/portfolio/create')}}" class="btn btn-primary btn-sm">
            @endif 
            <i class="fa fa-plus margin-right-5"></i>Create Portfolio</a>

          @if (RoleAuthHelper::hasAccess('portfolio.export_csv')!=true)  
          <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
            @else
            <a href="{{url('admin/export')}}" class="btn btn-primary btn-sm">
              @endif 
              <i class="fa fa-share margin-right-5"></i>Export</a>

            <br/>
            </div>
            <div class="col-md-6 text-right">
              <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
              <ul class="list-unstyled breadcrumb breadcrumb-custom">
                <li>
                  <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                </li>
                <li><span>Portfolio Dashboard</span></li>
              </ul>
              <!--        <div class="togle-btn pull-right">
                        <div class="dropdown inner-drpdwn">
                            <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                                <span class="hidden-lg-down">Portfolio Management</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="" role="menu">
                                <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                                <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                                <a class="dropdown-item" href="{{url('admin/portfolioStructure')}}">Portfolio Structure</a>
                                <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Planning</a>
                                <a class="dropdown-item" href="{{url('admin/portfolioresourceplanning')}}">Portfolio Resource Planning</a>
                               
                            </ul>
                        </div>
                    </div>-->
            </div>
            </div>
            <div class="margin-bottom-50">
              <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                <thead>
                  <tr>
                    <th>Portfolio Name</th>
                    <th>Portfolio ID</th>
                    <th>Portfolio Type</th>
                    <th>Changed By</th>
                    <th>No. of Buckets</th>
                    <th>Status</th>
                    <!--<th>Risk Score</th>-->
                    <!--<th>Risk Score Status</th>-->
                    <th style="width: 185px;">Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>            
            </div>
  
            </section>
            <div class="modal fade table-view-popup" id="table-view-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
              <div class="modal-dialog" role="document" style="text-align:left;">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <!--view--> 
                    <div class="margin-bottom-10">
                      <ul class="list-unstyled breadcrumb">
                        <li>
                          <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                        </li>
                        <li>
                          <a href="{{url('admin/portfolio')}}">Portfolio</a>
                        </li>
                        <li>
                          <span id="span_port_id"></span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="modal-body ">
                    <form class="static-form">
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Portfolio Name</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="port_name"></p>
                        </div>
                      </div>

                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Portfolio ID</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="port_id"></p>
                        </div>
                      </div>
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Portfolio Type</p>
                        </div>
                        <div class="col-sm-5">

                          <p  class="form-control-static" id="port_type"></p>

                        </div>
                      </div>
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Description</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="port_desc"></p>
                        </div>
                      </div>
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Financial Planning Period</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="port_financial_plan"></p>
                        </div>
                      </div>
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Capacity Unit</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="port_capacity_unit"></p>
                        </div> 
                      </div>
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Created On</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="created_on"></p>
                        </div>
                      </div>
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Created By</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="created_by"></p>
                        </div>
                      </div>
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Changed On</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="changed_on"></p>
                        </div>
                      </div> 
                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Changed By</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="changed_by"></p>
                        </div>
                      </div> 

                      <div class="form-group popup-brd-btm">
                        <div class="col-sm-5">
                          <p class="form-control-static">Status</p>
                        </div>
                        <div class="col-sm-5">
                          <p class="form-control-static" id="status"></p>
                        </div>
                      </div> 
                      <!--view-->
                    </form>
                  </div>
                  <div class="modal-footer text-center">
                    <!--admin/qualitative_risk/'.$risk->id.'/edit-->
                    <a href="#" class="btn btn-primary" id="popupEdit">Edit</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            @endsection

            @section('PageJquery')

            {!! Html::script('vendors/jqueryDataTable/jquery.dataTables.min.js') !!}
            {!! Html::script('/js/portfolio_dataTable.js') !!}
            @endsection
