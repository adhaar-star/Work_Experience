@extends('layout.adminlayout')
@section('title','Project | Project Task')
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
                            <a class="dropdown-item" href="{{url('admin/projectresourceplan')}}">Project Resource Plan</a>
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
                            <span>Project Task Dashboard</span>
                        </li>
                    </ul>

                </div>
                <h4>Project Task</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('task.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/projecttask/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Task
                        </a>
                </div>

                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Task Id</th>
                                    <th>Task Name</th>
                                    <th>ProjectId</th>
                                    <th>Task Type</th>
                                    <th>Sub Task Id</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Task Id</th>
                                    <th>Task Name</th>
                                    <th>ProjectId</th>
                                    <th>Task Type</th>
                                    <th>Sub Task </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($projecttask as $proj)
                                <tr>
                                    <td><a data-toggle="modal" data-target="#table-view-popup_{{$proj->id}}">{{$proj->task_Id}}</a></td>


                                    <td>{{$proj->task_name}}</td>
                                    <td>{{$proj->project_id}}</td>
                                    <td>{{$proj->task_type }}</td>
                                    <td>{{$proj->sub_task_id}}</td>
                                    <td>
                                        @if($proj->status=='Created')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        @elseif($proj->status=='In Progress')
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @else
                                        <?php
                                        $status = 'Complete';
                                        echo $status;
                                        ?>
                                        @endif

                                    </td>

                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('task.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else<a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$proj->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                        @if (RoleAuthHelper::hasAccess('task.update')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="{{url('admin/projecttask/'.$proj->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> </a>

                                            {!! Form::open(array('route' => array('task.delete',$proj->id), 'method' => 'DELETE','id'=>'delform'.$proj->id)) !!}
                                            @if (RoleAuthHelper::hasAccess('task.delete')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this project phase');
                                                          if (res) {
                                                  document.getElementById('delform{{$proj->id}}').submit()
                                                            }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                {!! Form::close() !!}
                                                <div class="modal fade table-view-popup" id="table-view-popup_{{$proj->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                            <a href="{{url('admin/projecttask')}}">Project Task/Subtask</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0);">Display Project Task</a>
                                                                        </li>
                                                                        <li>
                                                                            <span>{{$proj->task_Id}}</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="static-form">
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Task ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$proj->task_Id }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Task Name</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$proj->task_name }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Task Type</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$proj->task_type }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Subtask ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$proj->sub_task_id}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Project ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$proj->project_id}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Phase ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$proj->phase_id }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Start Date</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <?php
                                                                            $strtdate = strtotime($proj->start_date);
                                                                            $start_date = date('d/M/Y', $strtdate);
                                                                            ?>
                                                                            <p class="form-control-static">{{$start_date }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">End Date</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <?php
                                                                            $endate = strtotime($proj->end_date);
                                                                            $end_date = date('d/M/Y', $endate);
                                                                            ?>
                                                                            <p class="form-control-static">{{$end_date }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created On</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <?php
                                                                            $createdate = strtotime($proj->created_date);
                                                                            $created_date = date('d/M/Y', $createdate);
                                                                            ?>
                                                                            <p class="form-control-static">
                                                                                {{$created_date }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created By</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">
                                                                                {{$user_name}}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class="edit-btn"><a href="{{url('admin/projecttask/'.$proj->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
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
                                                </section>
                                                @endsection