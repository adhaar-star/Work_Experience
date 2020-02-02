@extends('layout.adminlayout')
@section('title','Create Employee')

@section('body')

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">

                <!--Right Drop Down List Start-->
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
                <!--Right Drop Down List End-->

                <!--                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif-->

                <form id="employee" method="post" action="{{url('admin/employee_save')}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate>
                    {!! csrf_field() !!}

                    <div class="margin-bottom-50">
                        <!--Breadcrum Start-->
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">

                                <li>
                                    <a href="{{url('admin/dashboard')}}">Time Management</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/employees')}}">Employee Records</a>
                                </li>
                                <li>
                                    <span>Create Employee</span>
                                </li>

                            </ul>
                        </div>
                        <!--Breadcrum End-->

                        <!--Page Title Start-->       

                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                    Create Employee
                                </h4>
                                <!-- Vertical Form -->
                            </div>


                            <!--Page Title End--> 
                            <div class="card-block">
                                <div class="row" style="margin: 0;">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="2">First Name*:<span class="required"></span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <input class="form-control border-radius-0" placeholder="Please enter First name" id="2" type="text" name="employee_first_name">
                                                    @if($errors->has('employee_first_name')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_first_name') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="3">Middle Name*:<span class="required"></span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <input class="form-control border-radius-0" placeholder="Please enter Middle name" id="3" type="text" name="employee_middle_name">
                                                    @if($errors->has('employee_middle_name')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_middle_name') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="4">Last Name*:<span class="required"></span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <input class="form-control border-radius-0" placeholder="Please enter Last name" id="4" type="text" name="employee_last_name">
                                                    @if($errors->has('employee_last_name')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_last_name') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="6">Employee Email*:<span class="required"></span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('email_id','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter email'))!!}
                                                    @if($errors->has('email_id')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('email_id') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="6">Employee User:</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('employee_user_id',$users_data,'',array('class'=>'select2'))!!}  
                                                    @if($errors->has('employee_user_id')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_user_id') }}
                                                    </div> 
                                                    @endif  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="D-O-B">Date of Birth*:</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        {!!Form::text('employee_dob','',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select date of birth'))!!}
                                                        <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                    </label>
                                                    @if($errors->has('employee_dob')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_dob') }}
                                                    </div> 
                                                    @endif 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="5">Country of Birth*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('employee_birth_country',$country_data,'',array('class'=>'select2','placeholder'=>'Please select country'))!!}  
                                                    @if($errors->has('employee_birth_country')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_birth_country') }}
                                                    </div> 
                                                    @endif  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="6">Employee Type*:<span class="required"></span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <select class="form-control select2" id="emp_type" name="employee_type">
                                                        <option value="" selected>Please select employee type</option>
                                                        <option name="Permanent">Permanent</option>
                                                        <option name="Contract">Contract</option>                     
                                                    </select>
                                                    @if($errors->has('employee_type')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_type') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="6">Employee Role:</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('employee_role','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter employee role'))!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="7">Cost Center*:<span class="required"></span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <select class="form-control select2" id="cost_center" name="employee_cost_centre">
                                                        <option value="" selected>Please select cost center</option>
                                                        <!-- code for display cost centre data -->
                                                        @foreach($cost_centre as $costcentre)
                                                        {
                                                        <option value="{{$costcentre->cost_id}}">{{$costcentre->cost_centre}}
                                                        </option>
                                                        }
                                                        @endforeach       
                                                    </select>
                                                    @if($errors->has('employee_cost_centre')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_cost_centre') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="9">Activity Type*:<span class="required"></span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <select class="form-control select2" id="activity_type" name="employee_activity_type">
                                                        <option value="" selected>Please select activity type</option>
                                                        <!-- code for display activity type data -->
                                                        @foreach($activity_type as $activity)
                                                        {
                                                        <option value="{{$activity->activity_id}}">{{$activity->activity_type}}
                                                        </option>
                                                        }
                                                        @endforeach                      
                                                    </select>
                                                    @if($errors->has('employee_activity_type')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_activity_type') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="10">Timesheet Profile*:<span class="required"></span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <select class="form-control select2" id="profile" name="employee_timesheet_profile">
                                                        <option value="" selected>Please select timesheet profile</option>
                                                        @foreach($timesheet_profile as $timeprofile)
                                                        {
                                                        <option value="{{$timeprofile->time_sheet_profile_id}}">{{$timeprofile->time_sheet_profile_id}}</option>
                                                        }	
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('employee_timesheet_profile')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('employee_timesheet_profile') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="start-date">Start Date:</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">


                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        {!!Form::text('employee_start',isset($emp->employee_start) ? $emp->employee_start : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select employee start date'))!!}
                                                        <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="end-date">End Date:</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        {!!Form::text('employee_end',isset($emp->employee_end) ? $emp->employee_end : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select employee start date'))!!}
                                                        <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="btn-group" data-toggle="buttons">

                                                    <span class="active-bttn btn btn-primary active">
                                                        <!--Active-->
                                                        {!! Form::radio('status','active','true') !!}Active

                                                    </span>
                                                    <span class="inactive-btn btn btn-danger">
                                                        <!--Inactive-->
                                                        {!! Form::radio('status','inactive') !!}Inactive

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Button Form Start-->
                            <div class="card-footer card-footer-box text-right">
                                <button type="submit" class="btn btn-primary card-btn">Save</button>

                                <a href="{{url('admin/employees')}}" class="btn btn-danger">Cancel</a>
                            </div>
                            <!--Button Form End-->

                        </div>
                </form>

            </div>
        </div>
    </div>
    <!--</section>
    </div>-->

    <!-- Page Scripts --> 

    <!-- End Page Scripts --> 

</section>
<script type="text/javascript">
    $(".datepicker-init").datetimepicker({
        format: "YYYY-MM-DD"
    });
</script>  

@endsection