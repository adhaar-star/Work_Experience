@extends('layout.admin')
@section('title', 'Timesheet Entry')
@section('PageCss')
    <style type="text/css">
    .bg-head-table{background:#e0e0e0;}
    .my-spacing-table{border-collapse: initial;display:table; border-spacing: 1px;}
    .timesheet-btn{line-height:16px; padding:4px 16px;}
    .shadow-detail{border-bottom: 1px solid #eceff4;}
    .time-field{ padding-left:6px !important; padding-right:6px; width:72px; text-align:center;}
    .width-custom-list{ padding-left:6px !important; width:110px;}
    .text-area-custom{ padding-left:6px !important; height:39px;}
    .timeSheetInfo .col-xs-6{ padding: 5px;}
    .table.table-striped tbody tr:nth-of-type(odd) {
        background: #f2f8f4;
    }
    .table.table-hover tbody tr:hover {
        background: #bce9ff;
    }
</style>
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    @include('layout.admin_layout_include.quick_jump_menu')
                </div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                    <div class="margin-bottom-50">
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                                <li><a href="{{ route('timesheet.work.list.dashboard') }}">Time Sheet Management</a></li>
                                <li><span>Timesheet Entry</span></li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-header card-header-box  bg-lightcyan">
                                <h4 class="margin-0">
                                    Timesheet Entry
                                </h4>
                            </div>
                            <!--User Details Views Start-->
                            <div class="margin-bottom-50">
                                @if(!empty($login_employee))
                                <div class="card-block">
                                    <div class="row timeSheetInfo">

                                        <div class="col-xs-6">
                                            <div class="form-group form-margin-btm">
                                                <div class="col-sm-4">Employee</div>
                                                <div class="col-sm-8">
                                                    <div class="form-input-icon">
                                                        {{ $login_employee->employee_id }} - <?php echo $login_employee->employee_first_name . ' ' . $login_employee->employee_middle_name . ' ' . $login_employee->employee_last_name ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-6">
                                            <div class="form-group form-margin-btm">
                                                <div class="col-sm-4">Timesheet Profile</div>
                                                <div class="col-sm-8">
                                                    <div class="form-input-icon">
                                                        {{  $login_employee->timesheet_profile_name->time_sheet_profile_id }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="form-group form-margin-btm">
                                                <div class="col-sm-4">Cost Centre</div>
                                                <div class="col-sm-8">
                                                    <div class="form-input-icon">
                                                        <?php echo isset($login_employee->cost_centre->cost_centre) ? $login_employee->cost_centre->cost_centre : ''; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="form-group form-margin-btm">
                                                <div class="col-sm-4">Activity Type</div>
                                                <div class="col-sm-8">
                                                    <div class="form-input-icon">
                                                        <?php echo $login_employee->activity_type->activity_type; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="form-group form-margin-btm">
                                                <div class="col-sm-4">Timesheet Date</div>
                                                <div class="col-sm-8">
                                                    <div class="form-input-icon">
                                                        <?php echo date('l', strtotime($entry_date)) . ', ' . date('d M Y', strtotime($entry_date)); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="form-group form-margin-btm">
                                                <div class="col-sm-4">Approver</div>
                                                <div class="col-sm-8">
                                                    <div class="form-input-icon">
                                                        <?php
                                                        if (!empty($login_approvers_data)) {
                                                            echo $login_approvers_data->approvers->employee_first_name . ' ' . $login_approvers_data->approvers->employee_middle_name . ' ' . $login_approvers_data->approvers->employee_last_name;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if(!empty($st_works) &&  !isset( request()->copy_date) )
                                            <div class="col-xs-6">
                                                <div class="form-group form-margin-btm">
                                                    <div class="col-sm-4">Copy Timesheet</div>
                                                    <div class="col-sm-8">
                                                        <div class="form-input-icon">
                                                            {!! Form::open(['url' =>route('timesheet.work.create'), 'method' => 'get', 'id' => 'buckets', 'class' => 'form-horizontal form-label-left']) !!}
                                                            {!! Form::hidden( "employee_id", $login_employee->employee_id ) !!}
                                                            {!! Form::hidden( "st_work_day", $entry_date ) !!}
                                                                <div class="form-input-icon  input-group mb-2 mb-sm-0">
                                                                    {!!Form::text('copy_date',   null, ['class'=>'form-control  border-radius-0 no-resize datepicker-only-init',
                                                                      'placeholder'=>'Select Date',
                                                                      'required'=>'required',
                                                                      'style' => 'width: 180px;  margin-right: 5px;  padding: 5px;',
                                                                      ] )!!}

                                                                    <div class="input-group-addon" style="border: 0; padding: 2px 0 0; float: left;">
                                                                        <button type="submit" class="btn btn-primary btn-sm card-btn"><i class="fa fa-copy"></i> Copy </button>
                                                                    </div>
                                                                </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif



                                    </div>
                                </div>
                                @endif
                            <!--User Details Views End-->

                            {!! Form::open(['url' =>route('timesheet.work.save'), 'method' => 'post', 'class' => 'form-horizontal form-label-left GlobalFormValidation']) !!}
                                <div>
                                        <!--Table Start-->
                                        {!! Form::hidden( "employee_id", $login_employee->employee_id ) !!}
                                        {!! Form::hidden( "st_work_date", $entry_date ) !!}
                                        @if(!empty($st_works) && !isset(  request()->copy_date ))
                                            {!! Form::hidden( "st_work_id", $st_works->st_work_id, ['class' => 'RunTotalTime'] ) !!}
                                        @endif

                                        <div class="margin-bottom-50">
                                            <table class="table table-striped table-bordered table-hover" style="border-left: 0; border-right: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="border-left: 0;">Project</th>
                                                    <th>Project Description</th>
                                                    <th>Task</th>
                                                    <th style="border-right: 0;">Work Time<sup class="start-sup" style="font-size: 15px;color: red;vertical-align: text-bottom;">*</sup></th>
                                                </tr>
                                                </thead>
                                                <tfoot style=" background: #bce9ff;;">
                                                <tr>
                                                    <th style="border-left: 0;">&nbsp;</th>
                                                    <th>&nbsp;</th>

                                                    <th>Total Time</th>
                                                    <th style="border-right: 0;"><span id="hours_total">0</span></th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                @if(empty($st_works) )
                                                    @foreach ( $project_tasks as  $task )
                                                        <?php
                                                            $project = $task->project;
                                                            $task_id = $task->id;
                                                        ?>
                                                        <tr class="taskTimeEntry_{{$task_id}}">
                                                            <td style="border-left: 0;">
                                                                <div class="form-input-icon">

                                                                    {!! Form::hidden("st_works[{$task_id}][project_id]", $project->id) !!}
                                                                    {!! Form::hidden("st_works[{$task_id}][task_id]", $task_id) !!}
                                                                    {{$project->project_Id}} - {{$project->project_name}}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-input-icon">
                                                                    {{$project->project_desc}}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-input-icon">
                                                                    {{ $task->task_name }}
                                                                </div>
                                                            </td>

                                                            <td style="border-right: 0;">
                                                                <div class="form-input-icon">
                                                                    {!! Form::text( "st_works[{$task_id}][total_time]", null,
                                                                    [
                                                                        'class' => ' StTotalTime form-control datepicker-init border-radius-0 time-field',
                                                                        'placeholder'=>'HH:MM'
                                                                     ]) !!}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    @foreach ( $st_works->StWorkTimes as  $st_work )
                                                        <?php
                                                            $project = $st_work->project;
                                                            $task = $st_work->task;
                                                            $task_id = $st_work->task_id;
                                                        ?>
                                                        <tr class="taskTimeEntry_{{ $task_id}}">
                                                            <td>
                                                                <div class="form-input-icon">
                                                                    @if(!isset(  request()->copy_date ))
                                                                        {!! Form::hidden("st_works[{$task_id}][st_work_time_id]", $st_work->st_work_time_id) !!}
                                                                    @else
                                                                        {!! Form::hidden("st_works[{$task_id}][project_id]", $project->id) !!}
                                                                        {!! Form::hidden("st_works[{$task_id}][task_id]", $task_id) !!}
                                                                    @endif
                                                                    {{$project->project_Id}} - {{$project->project_name}}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-input-icon">
                                                                    {{$project->project_desc}}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-input-icon">
                                                                    {{ $task->task_name }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-input-icon">
                                                                    {!! Form::text("st_works[{$task_id}][total_time]",
                                                                        $st_work->total_time,
                                                                     [
                                                                        'class' => 'StTotalTime form-control border-radius-0 datepicker-init time-field',
                                                                        'placeholder'=>'HH:MM'
                                                                      ]) !!}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10 col-lg-offset-1">
                                        @include('layout.admin_layout_include.alert_process')
                                    </div>
                                </div>
                                <div class="card-footer card-footer-box">
                                    @if(!empty($st_works) && $st_works->st_work_status ==  'approved' )
                                        <button style="cursor: default;" type="button" class="btn btn-success ">Time Sheet Approved</button>
                                    @else
                                        @if(!empty($st_works) && $st_works->st_work_status ==  'draft' )
                                            <span style="cursor: default;" type="button" class="label label-warning  ">Time Sheet is on Draft</span>
                                        @endif
                                        @if(!empty($st_works) && $st_works->st_work_status ==  'rejected' )
                                            <span style="cursor: default;" type="button" class="label label-danger  ">Time Sheet is  Rejected</span>
                                        @endif

                                        {!! Form::select( "st_work_status", ['pending'=>'Submit', 'draft'=>'Draft'], 'pending', [ 'class' => 'form-control', 'placeholder'=>'Select Status', 'required'=>'required' , 'style'=>' max-width: 180px;    display: inline;    min-height: 37px;' ]) !!}
                                        @if(!empty($st_works) && !isset(  request()->copy_date ))
                                            <button type="submit" class="btn btn-primary card-btn">Update</button>
                                        @else
                                            <button type="submit" class="btn btn-primary card-btn">Submit</button>
                                        @endif

                                        <a href="{{ route('timesheet.work.list.dashboard') }}" class="btn btn-danger" >Cancel</a>
                                    @endif
                                </div>
                            {!! Form::close() !!}
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
    {!! Html::script('vendors/formValidation/js/formValidation.min.js') !!}
    {!! Html::script('vendors/formValidation/js/framework/bootstrap.min.js') !!}
    {!! Html::script('js/globalValidationCustom.js') !!}
    {!! Html::script('pages/timesheet/entry.js') !!}
@endsection