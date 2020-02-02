@extends('layout.adminlayout')
@section('title','Project | Project Cost Plan')
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
                            <a class="dropdown-item" href="{{url('admin/projectresourceplan')}}">Project Resource Plan</a>							<!--div class="dropdown-divider"></div>
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
                            <span>Project Cost Plan Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Project Cost Plan</h4>
                <div class="dashboard-buttons">
                    <a href="{{url('admin/projectcostplan/create')}}" class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create Project Cost Plan
                    </a>
                </div>
        <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Project ID</th>
                                    <th>Task Name</th>
                                    <th>Task ID</th>
                                    <th>Software Description</th>
                                    <th>Purchase Order</th>
                                    <th>PO Item No.</th>
                                    <th>Total Price</th>
                                    <th>Currency</th>
                                    <th>Task Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Project ID</th>
                                    <th>Task Name</th>
                                    <th>Task ID</th>
                                    <th>Software Description</th>
                                    <th>Purchase Order</th>
                                    <th>PO Item No.</th>
                                    <th>Total Price</th>
                                    <th>Currency</th>
                                    <th>Task Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($projectcostplan as $projcostplan)
                                <tr>
                                    <td>{{$projcostplan->cost_plan_Id }}</td>
                                    <td>{{$projcostplan->cost_plan_name}}</td>
                                    <td>{{$projcostplan->cost_plan_type }}</td>
                                    <td>{{$projcostplan->cost_plan_Id }}</td>
                                    <td>{{$projcostplan->cost_plan_name}}</td>
                                    <td>{{$projcostplan->cost_plan_type }}</td>
                                    <td>{{$projcostplan->cost_plan_Id }}</td>
                                    <td>{{$projcostplan->cost_plan_currency}}</td>
                                    <td>{{$projcostplan->cost_plan_type }}</td>
                                    <td>
                                        @if($projcostplan->status==1)
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        <!--button type="button" class="btn btn-success btn-xs">Active</button-->
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                        <!--button type="button" class="btn btn-danger btn-xs">Inactive</button-->
                                        @endif
                                    </td>
                                    <td class="action-btn">
                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$projcostplan->id }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                        <a href="{{url('admin/projectcostplan/'.$projcostplan->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i>  </a>

                                        <form action="{{url('admin/projectcostplan/'.$projcostplan->id)}}" method="post" id="delform">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this project checklist');
                                                    if (res) {
                                                        document.getElementById('delform').submit()
                                                    }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a>
                                        </form>

                                        <div class="modal fade table-view-popup" id="table-view-popup_{{$projcostplan->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
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
                                                                    <a href="{{url('admin/projectcostplan')}}">Project Checklist</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/projectcostplan/create')}}">Create Project Checklist</a>
                                                                </li>
                                                                <li>
                                                                    <span>{{$projcostplan->checklist_name}}</span>
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
                                                                            <p class="form-control-static">Checklist ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->checklist_Id }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Checklist Name</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->checklist_name }}</p>
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Checklist Type</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->checklist_type }}</p>
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Project ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->project_id }}</p>
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Start Date</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->start_date }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">End Date</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->end_date }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Phase Reference</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->reference_phase }}</p>
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created On</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->created_date }}</p>
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created By</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$projcostplan->created_by }}</p>
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{url('admin/projectcostplan/'.$projcostplan->id.'/edit')}}" class="btn btn-primary">Edit</a>
                                                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <!--td>{{$projcostplan->project_id }}</td>
                                    <td>{{$projcostplan->start_date }}</td>
                                    <td>{{$projcostplan->end_date }}</td>
                                    <td>{{$projcostplan->reference_phase }}</td>
                                    <td>{{$projcostplan->created_date }}</td>
                                    <td>{{$projcostplan->created_by }}</td-->
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endsection