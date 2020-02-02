@extends('layout.adminlayout')
@section('title','Role Management | Company Roles')
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
                            <span class="hidden-lg-down">Company Role</span>
                            <span class="caret"></span>
                        </a>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Role Management</a>
                        </li>
                        <li>
                            <span>Company Roles</span>
                        </li>
                    </ul>
                </div>
                <h4>Company Roles</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('company.roles.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/CompanyRoles/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-plus margin-right-5"></i>
                            Create Company Role
                        </a>
                </div>
                <br />
                <div class="col-md-12">
                    <div>
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Role ID </th>
                                    <th>Role Name </th>
                                    <th>Created on</th>
                                    <th>Created by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Role ID </th>
                                    <th>Role Name </th>
                                    <th>Created on</th>
                                    <th>Created by</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($roles as $role)


                                <tr>    
                                    <td>
                                        @if (RoleAuthHelper::hasAccess('company.roles.view')!=true)  
                                        {{$role->id }}
                                        @else
                                        <a data-toggle="modal" data-target="#table-view-popup_{{$role->id }}">
                                            {{$role->id }}
                                            @endif
                                        </a>
                                    </td>
                                    <td>{{$role->role_name}}</td>
                                    <?php
                                    $date = new DateTime($role->created_at);

                                    $created_date = $date->format('Y-m-d');
                                    ?>

                                    <td>{{$created_date}}</td>
                                    <td>{{$role->created_by}}</td>

                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('company.roles.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$role->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                            @if (RoleAuthHelper::hasAccess('company.roles.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/CompanyRoles/'.$role->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                @if (RoleAuthHelper::hasAccess('company.roles.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-trash-o"></i></a>
                                                @else
                                                @if($role->role_name == 'Company Admin')
                                                <a href="javascript:void(0)" class="btn btn-danger btn-xs disabled" disabled="disabled"><i class="fa fa-trash-o"></i></a>

                                                @else
                                                {!! Form::open(array('route' => array('company.roles.delete',$role->id), 'method' => 'DELETE','id'=>'delform'.$role->id)) !!}
                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this Role');
                                                  if (res) {
                                          document.getElementById('delform{{$role->id}}').submit()
                                                    }" class="btn btn-danger btn-xs "><i class="fa fa-trash-o"></i></a>

                                                {!! Form::close() !!}
                                                @endif 
                                                @endif

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
                                                                            <a href="{{url('admin/dashboard')}}">Role Management</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{url('admin/CompanyRoles')}}">Company Roles</a>
                                                                        </li>
                                                                        <li>
                                                                            <span>{{$role->role_name }}</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                            <div class="modal-body" style="width: 100%;padding: 0px;">
                                                                <form class="static-form">
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-4">
                                                                            <p class="form-control-static">Role ID</p>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <p class="form-control-static">{{$role->id}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-4">
                                                                            <p class="form-control-static">Role Name</p>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <p class="form-control-static">{{$role->role_name}}</p>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class="edit-btn"><a href="{{url('admin/CompanyRoles/'.$role->id.'/edit')}}" class="btn btn-primary">Edit</a></span>

                                                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End  -->

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
                                                <!-- End  -->


                                                @endsection