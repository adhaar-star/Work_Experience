@extends('layout.adminlayout')
@section('title','Project | Project Checklist')
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
                            <span>Project Checklist Dashboard</span>
                        </li>
                    </ul>
                </div>

                <h4>Project Checklist</h4>


                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('checklist.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/projectchecklist/create')}}" class="btn btn-primary">
                            @endif
                            Create Project Checklist
                        </a>
                </div>
        <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br>
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse nowrap" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Checklist ID</th>
                                    <th>Checklist Name</th>
                                    <th>Checklist Type</th>
                                    <th>Project ID</th>
                                    <th>Phase ID</th>
                                    <th>Task ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Checklist ID</th>
                                    <th>Checklist Name</th>
                                    <th>Checklist Type</th>
                                    <th>Project ID</th>
                                    <th>Phase ID</th>
                                    <th>Task ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($projectchecklist as $projchecklist)
                                <tr>
                                    <td><a data-toggle="modal" data-target="#table-view-popup_{{$projchecklist->id }}">{{$projchecklist->checklist_id}}</a></td>
                                    <td>{{$projchecklist->checklist_name}}</td>
                                    <td>{{$projchecklist->checklist_type }}</td>
                                    <td>{{$projchecklist->project_id }}</td>
                                    <td>{{$projchecklist->phase_id }}</td>
                                    <td>{{$projchecklist->task_id }}</td>   
                                    <td>
                                        @if($projchecklist->checklist_status=='OK')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        @elseif($projchecklist->checklist_status=='Not OK')
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @elseif($projchecklist->checklist_status==null)
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                        @else
                                        <span>{{$projchecklist->checklist_status}}</span>

                                        @endif
                                        <!----------------->
                                    </td>
                                    <td class="action-btn">
                                         @if (RoleAuthHelper::hasAccess('checklist.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else<a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$projchecklist->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                        @if (RoleAuthHelper::hasAccess('checklist.update')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="{{url('admin/projectchecklist/'.$projchecklist->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i>  </a>

                                            {!! Form::open(array('route' => array('checklist.delete',$projchecklist->id), 'method' => 'DELETE','id'=>'delform'.$projchecklist->id)) !!}
                                            @if (RoleAuthHelper::hasAccess('checklist.delete')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this projchecklist');
                                                          if (res) {
                                                  document.getElementById('delform{{$projchecklist->id}}').submit()
                                                            }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                {!! Form::close() !!}
                                                <div class="modal fade table-view-popup" id="table-view-popup_{{$projchecklist->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                            <a href="{{url('admin/projectchecklist')}}">Project Checklist</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{url('admin/projectchecklist/create')}}">Create Project Checklist</a>
                                                                        </li>
                                                                        <li>
                                                                            <span>{{$projchecklist->checklist_id}}</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form class="static-form">
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">

                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Checklist ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->checklist_id }}</p>
                                                                            </div>
                                                                        </div>   
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Checklist Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->checklist_name }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Checklist Type</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->checklist_type }}</p>
                                                                            </div>
                                                                        </div>   
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->project_id }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>   
                                                                    <!--                                                            <div class="form-group popup-brd-btm">
                                                                                                                                    <div class="col-sm-12">
                                                                                                                                        <div class="col-sm-5">
                                                                                                                                            <p class="form-control-static">Project Name</p>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-sm-5">
                                                                                                                                            <p class="form-control-static">{{$projchecklist->project_name }}</p>
                                                                                                                                        </div>
                                                                                                                                    </div>   
                                                                                                                                </div>-->
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Phase ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->phase_id }}</p>
                                                                            </div>
                                                                        </div>   
                                                                    </div>
                                                                    <!--                                                            <div class="form-group popup-brd-btm">
                                                                                                                                    <div class="col-sm-12">
                                                                                                                                        <div class="col-sm-5">
                                                                                                                                            <p class="form-control-static">Phase Name</p>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-sm-5">
                                                                                                                                            <p class="form-control-static">{{$projchecklist->phase_name }}</p>
                                                                                                                                        </div>
                                                                                                                                    </div>   
                                                                                                                                </div>-->
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Task ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->task_id }}</p>
                                                                            </div>
                                                                        </div>   
                                                                    </div>
                                                                    <!--                                                            <div class="form-group popup-brd-btm">
                                                                                                                                    <div class="col-sm-12">
                                                                                                                                        <div class="col-sm-5">
                                                                                                                                            <p class="form-control-static">Task Name</p>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-sm-5">
                                                                                                                                            <p class="form-control-static">{{$projchecklist->task_name }}</p>
                                                                                                                                        </div>
                                                                                                                                    </div>   
                                                                                                                                </div>-->
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                if ($projchecklist->start_date == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->start_date}}</p>
                                                                                  <?php
                                                                                } else {
                                                                                  $createDate = new DateTime($projchecklist->start_date);

                                                                                  $start_date = $createDate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$start_date}}</p>
                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                $enddate = new DateTime($projchecklist->end_date);

                                                                                $end_date = $enddate->format('Y-m-d');
                                                                                ?>
                                                                                <p class="form-control-static">{{$end_date}}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Actual Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                if ($projchecklist->a_start_date == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->a_start_date}}</p>
                                                                                  <?php
                                                                                } else {
                                                                                  $adate = new DateTime($projchecklist->a_start_date);

                                                                                  $a_date = $adate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$a_date}}</p>
                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Actual End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                if ($projchecklist->a_end_date == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->a_end_date}}</p>
                                                                                  <?php
                                                                                } else {
                                                                                  $aenddate = new DateTime($projchecklist->a_end_date);

                                                                                  $aend_date = $aenddate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$aend_date}}</p>

                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Earliest Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                if ($projchecklist->e_start_date == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->e_start_date}}</p>
                                                                                  <?php
                                                                                } else {
                                                                                  $estartdate = new DateTime($projchecklist->e_start_date);

                                                                                  $estart_date = $estartdate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$estart_date}}</p>
                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Earliest End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                if ($projchecklist->e_end_date == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->e_end_date}}</p>
                                                                                  <?php
                                                                                } else {
                                                                                  $eenddate = new DateTime($projchecklist->e_end_date);

                                                                                  $e_end_date = $eenddate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$e_end_date}}</p>
                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Latest Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                if ($projchecklist->l_start_date == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->l_start_date}}</p>
                                                                                  <?php
                                                                                } else {
                                                                                  $lstartdate = new DateTime($projchecklist->l_start_date);

                                                                                  $l_start_date = $lstartdate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$l_start_date}}</p>
                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Latest End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                if ($projchecklist->l_end_date == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->l_end_date}}</p>
                                                                                  <?php
                                                                                } else {
                                                                                  $lenddate = new DateTime($projchecklist->l_end_date);

                                                                                  $l_end_date = $lstartdate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$l_end_date}}</p>
                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Duration</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->duration }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Person Responsible</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->employee_first_name}}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Created On</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                if ($projchecklist->created_on == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->created_on}}</p>

                                                                                  <?php
                                                                                } else {
                                                                                  $createddate = new DateTime($projchecklist->created_on);

                                                                                  $created_date = $createddate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$created_date}}</p>
                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>     
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Created By</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->created_by}}</p>
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
                                                                                if ($projchecklist->changed_on == null) {
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$projchecklist->changed_on}}</p>
                                                                                  <?php
                                                                                } else {
                                                                                  $changeddate = new DateTime($projchecklist->changed_on);

                                                                                  $changed_date = $changeddate->format('Y-m-d');
                                                                                  ?>
                                                                                  <p class="form-control-static">{{$changed_date}}</p>
                                                                                  <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>     
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Changed By</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$projchecklist->changed_by}}</p>
                                                                            </div>
                                                                        </div>     
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Status</p>
                                                                            </div>

                                                                            <div class="col-sm-5">
                                                                                @if($projchecklist->checklist_status=='OK')
                                                                                <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                                                                @elseif($projchecklist->checklist_status=='Not OK')
                                                                                <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                                                                @else
                                                                                <?php
                                                                                $status = 'Closed';
                                                                                echo $status;
                                                                                ?>
                                                                                @endif  
                                                                            </div> 

                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class="edit-btn"> <a href="{{url('admin/projectchecklist/'.$projchecklist->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
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
                                                </div
                                                </div>
                                                </div>
                                                </div>
                                                @endsection