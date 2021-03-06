@extends('layout.adminlayout')
@section('title','Project | Project Resource Planning | Create Role')
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

                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                        </li>
                        <li>
                            <a href="{{url('admin/projectresourceplanning')}}">Project Resource Planning</a>
                        </li>
                        <li>
                            <span> Create Role Dashboard</span>
                        </li>
                    </ul>
                </div>     

                <div class="card card-info-custom">
                    <div class="card-header">
                        <h4 class="margin-bottom-0">Create Role</h4>
                    </div>
                    <div class="card-block">
                        <div>
                            @if (RoleAuthHelper::hasAccess('createrole.create')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/createrole/create')}}" class="btn btn-primary">                       
                                    @endif
                                    Create Role
                                </a>                   
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-inverse" id="example3" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Project ID</th>
                                            <th>Role Name</th>
                                            <th>Role Type</th>
                                            <th>Role Function</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <!--<th>Status</th>-->
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach($createrole as $role)
                                        <tr>
                                            <td>{{$role->project_id}}</td>
                                            <td><a data-toggle="modal" data-target="#table-view-popup_{{$role->id }}">{{$role->role_name}}</a></td>
                                            <td>{{$role->role_type}}</td>
                                            <td>{{$role->role_fun }}</td>
                                            <td>{{$role->description }}</td>
                                            <td>{{$role->start_date }}</td>
                                            <td>{{$role->end_date}}</td>
                                            <td class="action-btn">
                                                @if (RoleAuthHelper::hasAccess('createrole.view')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$role->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                                    @if (RoleAuthHelper::hasAccess('createrole.update')!=true)  
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                        @else
                                                        <a href="{{url('admin/createrole/'.$role->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i>  </a>

                                                        {!! Form::open(array('route' => array('createrole.delete',$role->id), 'method' => 'DELETE','id'=>'delform'.$role->id)) !!}
                                                        @if (RoleAuthHelper::hasAccess('createrole.delete')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this role');
                                                                      if (res) {
                                                              document.getElementById('delform{{$role->id}}').submit()
                                                                        }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                            {!! Form::close() !!}
                                                            <div class="modal fade table-view-popup" id="table-view-popup_{{$role->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                                <div class="modal-dialog" role="document" style="text-align:left;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            <div class="margin-bottom-10">
                                                                                <ul class="list-unstyled breadcrumb">
                                                                                    <li>
                                                                                        <a href="{{url('admin/dashboard')}}">Project Managemnt</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="{{url('admin/projectresourceplanning')}}">Project Resource Planning</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="{{url('admin/craterole/create')}}">Create Role</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span>{{$role->project_id}}</span>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <form class="static-form">
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Project ID</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$role->project_id}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Role Name</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$role->role_name }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Role Type</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$role->role_type }}</p>
                                                                                        </div>
                                                                                    </div>   
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Role Function</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$role->role_fun }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>   
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Role Description</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$role->description }}</p>                                                                    </div>
                                                                                    </div>   
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Role Start Date</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <?php
                                                                                            $strtdate = strtotime($role->start_date);
                                                                                            $start_date = date('d/M/Y', $strtdate);
                                                                                            ?>
                                                                                            <p class="form-control-static">{{$start_date }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Role End Date</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <?php
                                                                                            $enddate = strtotime($role->end_date);
                                                                                            $end_date = date('d/M/Y', $enddate);
                                                                                            ?>
                                                                                            <p class="form-control-static">{{$end_date }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>

                                                                        </form>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <span class="edit-btn"> <a href="{{url('admin/createrole/'.$role->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>
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
                                                            </div>
                                                            </div>

                                                            </section>

                                                            @endsection