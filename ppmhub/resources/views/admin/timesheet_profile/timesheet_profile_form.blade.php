@extends('layout.adminlayout')
@section('title','Create Timesheet Profile')

@section('body')

<!--<section class="page-content">
    <div class="page-content-inner">-->
<!-- Portfolio -->
<section id="create_form" class="panel">

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

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="project" method="post" action="{{url('admin/timesheetprofile_save')}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate>
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
                                    <a href="{{url('admin/timesheetprofiles')}}">Time Sheet Profiles</a>
                                </li>
                                <li>
                                    <span>Create Timesheet Profile</span>
                                </li>

                            </ul>
                        </div>
                        <!--Breadcrum End-->

                        <!--Page Title Start-->       

                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                    Create Timesheet Profile
                                </h4>
                                <!-- Vertical Form -->
                            </div>


                            <!--Page Title End--> 
                            <div class="card-block">
                                <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="2">Timesheet Period*:<span class="required"></span></label>						
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('time_sheet_entry_period', [
                                                        '' => 'Select Timesheet Period',
                                                        'Weekly' => 'Weekly',
                                                        'Fortnightly' => 'Fortnightly',
                                                        'Monthly' =>'Monthly'
                                                    ],'',array('class'=>'select2'))!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="2">Timesheet Period (Weeks)*:<span class="required"></span></label>	
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <input class="form-control border-radius-0" placeholder="Mention weeks for period" id="time_sheet_number_days" name="time_sheet_number_days" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin: 0;">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="4">Timesheet Description:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <textarea class="form-control border-radius-0" style="resize:none" rows="3" id="l15" name="time_sheet_description" placeholder="Timesheet profile description..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="btn-group" data-toggle="buttons">

                                                    <span class="active-bttn btn btn-primary active">
                                                        <!--Active-->
                                                        {!! Form::radio('status','active','active') !!}Active

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

                                <a href="{{url('admin/timesheetprofiles')}}" class="btn btn-danger">Cancel</a>
                            </div>
                            <!--Button Form End--> 

                        </div>
                </form>

            </div>
        </div>

    </div>
</section>
</div>

<!-- Page Scripts --> 

<!-- End Page Scripts --> 

</section>
<script type="text/javascript">
    $(".datepicker-init").datetimepicker({
        format: "YYYY-MM-DD"
    });
</script> 
@endsection