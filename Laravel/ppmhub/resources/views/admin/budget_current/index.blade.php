@extends('layout.adminlayout')
@section('title','Budget | Current Budget')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Budget Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/originalbudget')}}">Original Budget</a>
                            <a class="dropdown-item" href="{{url('admin/supplementbudget')}}">Supplement Budget</a>
                            <a class="dropdown-item" href="{{url('admin/returnbudget')}}">Return Budget</a>
                            <a class="dropdown-item" href="{{url('admin/currentbudget')}}">Current Budget</a>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/originalbudget')}}">Budget Management</a>
                        </li>
                        <li>
                            <span>Current Budget</span>
                        </li>
                    </ul>
                </div>
                <h4>Current Budget</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('budget.overview.dashboard')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/originalbudget')}}" class="btn btn-primary margin-left-10">
                            @endif<i class="fa fa-send margin-right-5"></i>
                            Original Budget
                        </a>
                        @if (RoleAuthHelper::hasAccess('budget.supplement.dashboard')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/supplementbudget')}}" class="btn btn-primary margin-left-10">
                                @endif
                                <i class="fa fa-send margin-right-5"></i>
                                Supplement Budget
                            </a>
                            @if (RoleAuthHelper::hasAccess('budget.return.dashboard')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/returnbudget')}}" class="btn btn-primary margin-left-10">
                                    @endif
                                    <i class="fa fa-send margin-right-5"></i>
                                    Return Budget
                                </a>
                                @if (RoleAuthHelper::hasAccess('budget.current.dashboard')!=true)  
                                <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                    @else
                                    <a href="{{url('admin/currentbudget')}}" class="btn btn-primary margin-left-10">
                                        @endif
                                        <i class="fa fa-send margin-right-5"></i>
                                        Current Budget
                                    </a>
                                    </div>

                                    <br />
                                    <div class="col-md-12">
                                        <div class="margin-bottom-50">
                                            <table class="table table-inverse" id="example3" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Project Name</th>
                                                        <th>Project ID</th>
                                                        <th>Current Budget</th>
                                                        <th>Changed By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @foreach($originalBudget as $budget)
                                                <tr>
                                                    <td>{{$budget->project_name}}</td>
                                                    <td>{{$budget->pid}}</td>
                                                    <td>{{round($budget->current)}}</td>
                                                    <td>{{$budget->name}}</td>
                                                    <td class="action-btn">
                                                        @if (RoleAuthHelper::hasAccess('budget.view')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$budget->id}}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                            <div class="modal fade table-view-popup" id="table-view-popup_{{$budget->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document" style="text-align:left;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                                                            <div class="margin-bottom-10">
                                                                                <ul class="list-unstyled breadcrumb">
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Budget Management</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Current Budget</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Display Current Budget</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="static-form">
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Project Name</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$budget->project_name}}</p>
                                                                                    </div>
                                                                                </div>
                                                                                @php    
                                                                                unset($project_data[$loop->index]['project_id']);
                                                                                ksort($project_data[$loop->index],1);
                                                                                @endphp
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Period From</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        @foreach($project_data[$loop->index] as $year=>$current)
                                                                                        @if($loop->first)
                                                                                        <p class="form-control-static">{{$year}}</p>
                                                                                        @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Period To</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        @foreach($project_data[$loop->index] as $year=>$current)
                                                                                        @if($loop->last)
                                                                                        <p class="form-control-static">{{$year}}</p>
                                                                                        @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                                @foreach($project_data[$loop->index] as $year=>$current)
                                                                                <div class="form-group popup-brd-btm">  
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$year}}</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$current}}</p>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach                         
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Current Budget</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{round($budget->current)}}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$budget->name}}</p>
                                                                                    </div>
                                                                                </div>    
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Status</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$budget->status}}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </td>                                                                        
                                                </tr>
                                                @endforeach
                                                <tfoot>
                                                    <tr>
                                                        <th>Project Name</th>
                                                        <th>Project ID</th>
                                                        <th>Current Budget</th>
                                                        <th>Changed By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </section>
                                    @endsection