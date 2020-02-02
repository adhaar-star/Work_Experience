@extends('layout.adminlayout')
@section('title','Settings | Checklist Type')
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
                            <span class="hidden-lg-down">Settings</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfoliotypes')}}">Portfolio Type</a>
                            <a class="dropdown-item" href="{{url('admin/projecttype')}}">Project Type</a>
                            <a class="dropdown-item" href="{{url('admin/checklisttype')}}">Checklist Type</a>
                            <a class="dropdown-item" href="{{url('admin/currencies')}}">Currency</a>
                            <a class="dropdown-item" href="{{url('admin/capacityunits')}}">Capacity Units</a>
                            <a class="dropdown-item" href="{{url('admin/periodtype')}}">Period Types</a>
                            <a class="dropdown-item" href="{{url('admin/planningunit')}}">Planning Unit</a>
                            <a class="dropdown-item" href="{{url('admin/planningtype')}}">Planning Type</a>
                            <a class="dropdown-item" href="{{url('admin/costingtype')}}">Costing Type</a>
                            <a class="dropdown-item" href="{{url('admin/collectiontype')}}">Collection Type</a>
                            <a class="dropdown-item" href="{{url('admin/viewtype')}}">View Type</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Settings</a>
                        </li>
                        <li>
                            <span>Checklist Type</span>
                        </li>
                    </ul>
                </div>
                <h4>Checklist Type</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('checklistType.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/checklisttype/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Checklist Type
                        </a>
                </div>
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($checklisttype as $type)
                                <tr>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        @if($type->status=='1')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        <!--button type="button" class="btn btn-success btn-xs">Active</button-->
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @endif
                                    </td>
                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('checklistType.update')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="{{url('admin/checklisttype/'.$type->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> </a>

                                            {!! Form::open(array('route' => array('checklistType.delete',$type->id), 'method' => 'DELETE','id'=>'delform'.$type->id)) !!}
                                            @if (RoleAuthHelper::hasAccess('checklistType.delete')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this checklist type');
                                                  if (res) {
                                          document.getElementById('delform{{$type->id}}').submit()
                                                    }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                {!! Form::close() !!}
                                                </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                                </table>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </section>
                                                @endsection