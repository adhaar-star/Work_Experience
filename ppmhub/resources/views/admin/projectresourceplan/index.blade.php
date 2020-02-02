@extends('layout.adminlayout')
@section('title','Project | Project Resource Planning')
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
                            <span class="hidden-lg-down">Project Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/project')}}">Project</a>
                            <a class="dropdown-item" href="{{url('admin/projectphase')}}">Phase</a>
                            <a class="dropdown-item" href="{{url('admin/projecttask')}}">Task/Subtask</a>
                            <a class="dropdown-item" href="{{url('admin/projectchecklist')}}">Checklist</a>
                            <a class="dropdown-item" href="{{url('admin/projectmilestone')}}">Milestone</a>
                            <a class="dropdown-item" href="{{url('admin/projectcostplan')}}">Project Cost Plan</a>
                            <a class="dropdown-item" href="{{url('admin/projectresourceplanning')}}">Project Resource Planning</a>
                        </ul>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                        </li>
                        <li>
                            <span> Resource Planning Dashboard</span>
                        </li>
                    </ul>
                </div>
                <div class="card card-info-custom">
                    <div class="card-header">
                        <h4 class="margin-bottom-0">Resource Planning</h4>
                    </div>
                    <div class="card-block">
                        <div>
                            @if (RoleAuthHelper::hasAccess('createrole.create')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/createrole')}}" class="btn btn-primary margin-bottom-10">                       
                                    @endif
                                    Create Role
                                </a>
                                @if (RoleAuthHelper::hasAccess('assign.roleTo.person.create')!=true)  
                                <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                    @else
                                    <a href="{{url('admin/assignroletoperson')}}" class="btn btn-primary margin-bottom-10">                        
                                        @endif
                                        Assign Role To Person
                                    </a>
                                    @if (RoleAuthHelper::hasAccess('taskassign.create')!=true)  
                                    <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                        @else
                                        <a href="{{url('admin/taskassign')}}" class="btn btn-primary margin-bottom-10">                        
                                            @endif
                                            Assign Task To Role
                                        </a>
                                        @if (RoleAuthHelper::hasAccess('person.assignment.toTask.create')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="{{url('admin/personassignmenttotask')}}" class="btn btn-primary margin-bottom-10">                        
                                                @endif
                                                Person Assignment To Task 
                                            </a>
                                            @if (RoleAuthHelper::hasAccess('resource.overview.dashboard')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/resourceoverview')}}" class="btn btn-primary margin-bottom-10">                        
                                                    @endif
                                                    Resource Overview
                                                </a>
                                                @if (RoleAuthHelper::hasAccess('resource.loading.dashboard')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="{{url('admin/resourceloading')}}" class="btn btn-primary margin-bottom-10">                        
                                                        @endif
                                                        Resource Loading
                                                    </a>
                                                    @if (RoleAuthHelper::hasAccess('resource.availability.dashboard')!=true)  
                                                    <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                                        @else
                                                        <a href="{{url('admin/resourceavailability')}}" class="btn btn-primary margin-bottom-10">                        
                                                            @endif
                                                            Resource Availability
                                                        </a>
                                                        @if (RoleAuthHelper::hasAccess('resource.demandvsasssigned.dashboard')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="{{url('admin/resourcedemandvsasssigned')}}" class="btn btn-primary margin-bottom-10">                        
                                                                @endif
                                                                Demand Vs Assigned
                                                            </a>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table class="table table-inverse" id="example3" width="100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Project ID</th>
                                                                                <th>Project Description</th>
                                                                                <th>Role Name</th>
                                                                                <th>Resource</th>
                                                                                <th>Task ID</th>
                                                                                <th>Task Description</th>
                                                                            </tr>
                                                                        </thead> 
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th>Project ID</th>
                                                                                <th>Project Description</th>
                                                                                <th>Role Name</th>
                                                                                <th>Resource</th>
                                                                                <th>Task ID</th>
                                                                                <th>Task Description</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                        <tbody>
                                                                            @foreach($resourceData as $projresourceplan)
                                                                            <tr>
                                                                                <td>{{$projresourceplan->project_id }}</td>
                                                                                <td>{{$projresourceplan->project_desc}}</td>
                                                                                <td>{{$projresourceplan->role_name }}</td>
                                                                                <td>{{$projresourceplan->resource_name }}</td>
                                                                                <td>{{$projresourceplan->task_id}}</td>                                  
                                                                                <td>{{$projresourceplan->task_name}}</td>                                 

                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </section>
                                                            @endsection