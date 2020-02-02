@extends('layout.adminlayout')
@section('title','Time Management | Time Approval Settings')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

@foreach (['default', 'primary', 'secondary', 'secondary', 'success', 'info', 'warning', 'danger', ''] as $msg)
@if(Session::has('alert-' . $msg))
<!-- start .flash-message -->
<div class="alert alert-{{ $msg }}" role="alert" id="error_container">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <em>{{ Session::get('alert-' . $msg) }}</em>
</div>
<script type="text/javascript">
    $('#error_container').fadeIn('slow').delay(4000).fadeOut('slow');
</script>
@endif
@endforeach

<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
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
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Time Management</a>
                        </li>
                        <li>
                            <span>Time Approval Settings</span>
                        </li>
                    </ul>
                </div>
                <h4>Time Approval Settings</h4>
                <div class="dashboard-buttons">
                    <a href="{{url('admin/addtimesheetapprover')}}" class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create Timesheet Approver
                    </a>
                </div>
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Timesheet Approver</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>User</th>
                                    <th>Timesheet Approver</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($timesheet_approver as $approver)
                                <tr>
                                    <td>{{isset($approver->users_name->employee_first_name) ? $approver->users_name->employee_first_name : '' }} {{isset($approver->users_name->employee_middle_name) ? $approver->users_name->employee_middle_name : '' }} {{isset($approver->users_name->employee_last_name) ? $approver->users_name->employee_last_name : '' }}</td>
                                    <td>{{isset($approver->approvers->employee_first_name) ? $approver->approvers->employee_first_name : '' }} {{isset($approver->approvers->employee_middle_name) ? $approver->approvers->employee_middle_name : '' }} {{isset($approver->approvers->employee_last_name) ? $approver->approvers->employee_last_name : '' }}</td>
                                    <td>{{isset($approver->approvers->email_id) ? $approver->approvers->email_id : '' }}</td>
                                    <td class="action-btn">
                                        <a href="{{url('admin/edittimesheetapprover/'.$approver->id)}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i>  </a>
                                        <a href="{{url('admin/timesheetapprover_delete/'.$approver->id)}}" onclick="var res = confirm('Are you sure you want to delete this Approver');
                                                if (res) {
                                                    document.getElementById('delform').submit()
                                                }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a>

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