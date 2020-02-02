@extends('layout.adminlayout')
@section('title','Employee Records')

@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif    
<!--<section class="page-content">
    <div class="page-content-inner">-->
        <section class="panel"> 

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">


                        <!--Drop Down List Start-->
                        <div class="togle-btn pull-right">
                            <div class="dropdown inner-drpdwn">
                                <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                                    <span class="hidden-lg-down">Time Management</span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="" role="menu">
                                    <a class="dropdown-item" href="{{url('admin/employees')}}"> 
                                        Employee Personnel Records
                                    </a> 


                                    <a class="dropdown-item" href="{{url('admin/timesheetapprovals')}}">
                                        Time Approval settings
                                    </a>


                                    <a class="dropdown-item" href="{{url('admin/timesheetprofiles')}}"> 	
                                        Time Sheet Profiles
                                    </a> 			

                                    <a class="dropdown-item" href=""> 
                                        Time Sheet Management 
                                    </a>
                                </ul>
                            </div> 
                        </div>
                        <!--Drop Down List End--> 

                        <!--Bread Crum Start-->
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Time Management</a>
                                </li>
                                <li>
                                    <span>Employee Records</span>
                                </li>
                            </ul>
                        </div>
                        <!--Bread Crum Start-->

                        @foreach (['default', 'primary', 'secondary', 'secondary', 'success', 'info', 'warning', 'danger', ''] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <!-- start .flash-message -->
                        <div class="alert alert-{{ $msg }}" role="alert" id="error_container">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ Session::get('alert-' . $msg) }}
                        </div>
                        <script type="text/javascript">
                            $('#error_container').fadeIn('slow').delay(4000).fadeOut('slow');                        </script>
                        @endif
                        @endforeach
                        <!-- end .flash-message -->
                        <h4>Employee Records</h4>
                        <div class="dashboard-buttons">
                            <a href="{{url('admin/addemployee')}}" class="btn btn-primary"> <i class="fa fa-send margin-right-5"></i> Create Employee </a> 
                            <a href="{{url('admin/employees_export')}}" class="btn btn-primary margin-left-10"> <i class="fa fa-send margin-right-5"></i> Export </a> </div>

<!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p--> 
                        <br>
                        <div class="col-md-12">
                            <div class="margin-bottom-50">
                                <table class="table table-inverse" id="example3" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email ID</th>
                                            <th>Employee Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email ID</th>
                                            <th>Employee Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <!-- code for display cost centre data -->
                                        @foreach($employees_data as $employee)
                                        <tr>
                                            <td><a data-toggle="modal" data-target="#table-view-popup_{{$employee->employee_id}}">{{ $employee->employee_id }}</a></td>
                                            <td>{{$employee->employee_first_name}} {{$employee->employee_middle_name}} {{$employee->employee_last_name}}</td>
                                            <td>{{$employee->email_id}}</td>
                                            <td>{{$employee->employee_type}}</td>

                                            <td>                        
                                                @if($employee->status=='active')
                                                <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                                @else
                                                <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                                @endif
                                            </td>
                                            <td class="action-btn">
                                                <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$employee->employee_id}}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                <a href="{{url('admin/editemployee/'.$employee->employee_id)}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>
                                               
                                                {!! Form::open(array('url' => array('admin/employee_delete',$employee->employee_id), 'method' => 'DELETE','id'=>'delform'.$employee->employee_id)) !!}
                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this employee');
                                                            if (res) {
                                                    document.getElementById('delform{{$employee->employee_id}}').submit()
                                                                        }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                {!! Form::close() !!}
                                                <div class="modal fade table-view-popup" id="table-view-popup_{{$employee->employee_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document" style="text-align:left;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                                                <div class="margin-bottom-10">
                                                                    <ul class="list-unstyled breadcrumb">
                                                                        <li>
                                                                            <a href="javascript: void(0);">Time Management</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript: void(0);">Employee Personnel Records</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript: void(0);">Display Employee</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <h4 class="modal-title" id="myModalLabel"></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="static-form">
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">First Name</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->employee_first_name}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Middle Name</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->employee_middle_name}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Last Name</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->employee_last_name}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Personnel ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->employee_id}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">User ID</p>
                                                                        </div>
                                                                        <?php if (isset($employee->users_name)) { ?>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->users_name->id}} ({{$employee->users_name->name}} {{$employee->users_name->lname}})</p>
                                                                        </div>
                                                                        <?php } else { ?>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static"></p>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                             <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Email ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->email_id}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">DOB</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{Carbon\Carbon::parse($employee->employee_dob)->format('d-m-Y')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Birth Country</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->employee_birth_country}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Employee Type</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->employee_type}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Cost Centre</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->cost_centre->cost_centre}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Activity Type</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->activity_type->activity_type}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Role</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->employee_role}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Employee Timesheet Profile</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->employee_timesheet_profile}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Employee Start Date</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{Carbon\Carbon::parse($employee->employee_start)->format('d-m-Y')}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Employee End Date</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{Carbon\Carbon::parse($employee->employee_end)->format('d-m-Y')}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created By</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$employee->creator->name}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created On</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{Carbon\Carbon::parse($employee->created_at)->format('d-m-Y')}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Edited By</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">@if($employee->updated_by !='') {{ $employee->updator->name }} @else  Not Changed   @endif</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Edited At</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{Carbon\Carbon::parse($employee->updated_at)->format('d-m-Y')}}</p>
                                                                        </div>
                                                                    </div>


                                                                </form>
                                                            </div>
                                                            <div class="modal-footer"> 
                                                                <span class="edit-btn"><a href="{{url('admin/editemployee/'.$employee->employee_id)}}" class="btn btn-primary">Edit</a></span>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- End  --></td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--        </section>
    </div>-->

    <!-- Page Scripts --> 

    <!-- End Page Scripts --> 

</section>

<!-- End Page Scripts -->

@endsection