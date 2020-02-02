@extends('layout.adminlayout')
@section('title','Project | Project Milestone')
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
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
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
                            <span>Project Milestone Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Project Milestone</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('projectmilestone.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/projectmilestone/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Project Milestone
                        </a>
                </div>
        <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Milestone ID</th>
                                    <th>Milestone Name</th>
                                    <th>Milestone Type</th>
                                    <th>Project ID</th>
                                    <th>Project Description</th>
                                    <th>Task ID</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Milestone ID</th>
                                    <th>Milestone Name</th>
                                    <th>Milestone Type</th>
                                    <th>Project ID</th>
                                    <th>Project Description</th>
                                    <th>Task ID</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($projectmilestone as $projmilestone)
                                <tr>
                                    <td>{{$projmilestone->milestone_Id }}</td>
                                    <td>{{$projmilestone->milestone_name}}</td>
                                    <td>{{$projmilestone->milestone_type }}</td>
                                    <td>{{$projmilestone->project_id }}</td>
                                    <td>{{$projmilestone->project_desc }}</td>
                                    <td>{{$projmilestone->task_id }}</td>
                                    <td>{{ Carbon\Carbon::parse($projmilestone->start_date)->format('Y-m-d') }}</td>
                                    <td>{{ Carbon\Carbon::parse($projmilestone->finish_date)->format('Y-m-d') }}</td>
                                    <td>
                                        @if($projmilestone->status== 'active' )                                            
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        @else                                        
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @endif
                                    </td>
                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('projectmilestone.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$projmilestone->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                            @if (RoleAuthHelper::hasAccess('projectmilestone.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/projectmilestone/'.$projmilestone->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i>  </a>



                                                {!! Form::open(array('route' => array('projectmilestone.delete',$projmilestone->id), 'method' => 'DELETE','id'=>'delform'.$projmilestone->id)) !!}
                                                @if (RoleAuthHelper::hasAccess('projectmilestone.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this projectmilestone');
                                                              if (res) {
                                                      document.getElementById('delform{{$projmilestone->id}}').submit()
                                                                }" class="btn btn-danger btn-xs margin-right-1">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                    {!! Form::close() !!}

                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$projmilestone->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                                <a href="{{url('admin/projectmilestone')}}">Project Milestone</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{url('admin/projectmilestone/create')}}">Create Display Milestone</a>
                                                                            </li>
                                                                            <li>
                                                                                <span>{{$projmilestone->milestone_name}}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-xs-12">
                                                                        <form class="static-form">
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Milestone ID</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$projmilestone->milestone_Id }}</p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Milestone Name</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$projmilestone->milestone_name }}</p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Milestone Type</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$projmilestone->milestone_type }}</p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>

                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Project ID</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$projmilestone->project_id }}</p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Phase ID</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$projmilestone->phase_id}}</p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>

                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Task ID</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$projmilestone->task_id }}</p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>

                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Start Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->start_date);
                                                                                        $start_date = date('d/M/Y', $update);
                                                                                        ?>
                                                                                        <p class="form-control-static">{{$start_date }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Finish Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->finish_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$end_date }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Fixed Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->fixed_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$end_date }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Actual Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->actual_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$end_date }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Scheduled Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->schedule_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$end_date }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Billing Plan %</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->billingplan_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$end_date }}</p>
                                                                                    </div>
                                                                                </div>     
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Progress %</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->progress_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$end_date }}</p>
                                                                                    </div>
                                                                                </div>     
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Event Reminder Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->event_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$end_date }}</p>
                                                                                    </div>

                                                                                    <!--                                                                            <div class="col-sm-5">
                                                                                    <?php
                                                                                    $update = strtotime($projmilestone->updated_at);
                                                                                    $updated_at = date('d/M/Y', $update);
                                                                                    ?>
                                                                                    
                                                                                                                                                                    <p class="form-control-static">{{$projmilestone->reference_phase }}</p>-->
                                                                                </div>
                                                                            </div>     

                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created On</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->created_date);
                                                                                        $created_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$created_date }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$projmilestone->created_by }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Changed On</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->created_date);
                                                                                        $created_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static">{{$created_date }}</p>
                                                                                    </div>
                                                                                </div>     
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Changed By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$projmilestone->created_by }}</p>
                                                                                    </div>
                                                                                </div>     
                                                                            </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class="edit-btn"><a href="{{url('admin/projectmilestone/'.$projmilestone->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
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
                                                    @endsection