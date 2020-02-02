@extends('layout.admin')
@section('title', 'Timesheet View')
@section('body')
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
<style type="text/css">
    .table-active-bg{background:#fff;}    .my-spacing-table{border-collapse: initial;display:table; border-spacing: 1px;}.timesheet-btn{line-height:16px; padding:4px 16px;}
    fieldset {border: 1px solid silver; margin: 0 2px;padding: 0.35em 0.625em 0.75em;} legend{ width:auto;}.shadow-detail{border-bottom: 1px solid #eceff4;}
</style>
@endsection
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
                <div class="margin-bottom-50"> <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li> <a href="{{url('admin/dashboard')}}">Time Management</a> </li>
                        <li> <a href="{{ route('timesheet.work.list.dashboard') }}">Time Sheet Management</a> </li>
                        <li> <span>Timesheet View</span> </li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-header card-header-box">
                        <h4 class="margin-0"> Timesheet View </h4>
                    </div>
                    <div class="card-block">
                        <!--Employee and Date Field Start-->
                        @if (Auth::user()->role_id == config('app.role.CompanyAdministrator'))
                        <form id="buckets" method="get" action="{{ route('timesheet.work.list.dashboard') }}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                            <div class="row margin-bottom-50">
                                <div class="col-xs-12 col-sm-5">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-2">
                                            <label>Employee:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-10">
                                            <div class="form-input-icon">
                                                {!! Form::select("employee_id", $employee_data, $employee_id,
                                                 ['class' => 'form-control select2 border-radius-0', 'placeholder'=>'Select Employee', 'required'=> "required", 'onChange'=> "change_employee()" ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-5">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 text-right col-sm-2">
                                            <label>Date:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-10">
                                            <div class="form-input-icon">
                                                <input class="form-control border-radius-0 datepicker-only-init"  placeholder="Select Date"  name="period_start" value="{{$current_date}}" required="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-input-icon">
                                            <button type="submit" class="btn btn-primary width-150">Display</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--Employee and Date Field End-->
                        @else
                        <!--User Details Views Start-->
                        <div class="margin-bottom-50">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group form-margin-btm shadow-detail">
                                        <div class="col-sm-6 no-pade">
                                            <p><strong>Personnel Number</strong></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-input-icon">
                                                <p class="form-control-static"><?php echo $login_employee->employee_id ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group form-margin-btm shadow-detail">
                                        <div class="col-sm-6 no-pade">
                                            <p><strong>Name</strong></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-input-icon">
                                                <p class="form-control-static"><?php echo $login_employee->employee_first_name . ' ' . $login_employee->employee_middle_name . ' ' . $login_employee->employee_last_name ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group form-margin-btm shadow-detail">
                                        <div class="col-sm-6 no-pade">
                                            <p><strong>Timesheet Profile</strong></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-input-icon">
                                                <p class="form-control-static"><?php echo $login_employee->timesheet_profile_name->time_sheet_profile_id; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group form-margin-btm shadow-detail">
                                        <div class="col-sm-6 no-pade">
                                            <p><strong>Cost Centre</strong></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-input-icon">
                                                <p class="form-control-static"><?php echo isset($login_employee->cost_centre->cost_centre)?$login_employee->cost_centre->cost_centre:''; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group form-margin-btm shadow-detail">
                                        <div class="col-sm-6 no-pade">
                                            <p><strong>Activity Type</strong></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-input-icon">
                                                <p class="form-control-static"><?php echo $login_employee->activity_type->activity_type; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group form-margin-btm shadow-detail">
                                        <div class="col-sm-6 no-pade">
                                            <p><strong>Approver</strong></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-input-icon">
                                                <p class="form-control-static"><?php echo $login_approvers_data->approvers->employee_first_name . ' ' . $login_approvers_data->approvers->employee_middle_name . ' ' . $login_approvers_data->approvers->employee_last_name; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group form-margin-btm shadow-detail">
                                        <div class="col-sm-6 no-pade">
                                            <p><strong>From Date</strong></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-input-icon">
                                                <p class="form-control-static"><?php echo $from_date; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group form-margin-btm shadow-detail">
                                        <div class="col-sm-6 no-pade">
                                            <p><strong>To Date</strong></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-input-icon">
                                                <p class="form-control-static"><?php echo $to_date; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--User Details Views End-->
                        @endif

                        <!--Table Start-->
                        <?php if (!(empty($employee_id))) { ?>
                        <div class="margin-bottom-50">
                                @foreach ($week_dates as $weekNumberOfYear  => $week)
                                <table class="table table-striped table-responsive my-spacing-table margin-bottom-50" border="0" width="100%" cellspacing="1" cellpadding="4">
                                    <thead>
                                        <tr class="table-active-bg">
                                            <th>&nbsp;</th>
                                            <th>Week {{$weekNumberOfYear}}</th>
                                            @foreach($week as $day)
                                                <th>
                                                    <a class="btn @if($day == $current_date) btn-warning @else btn-primary @endif width-auto timesheet-btn" href="{{ route('timesheet.work.create',[
                                                        'employee_id' => $employee_id,
                                                        'st_work_day' => $day,
                                                    ]) }}">{{ \Carbon\Carbon::parse($day)->format('D') }} <br> {{ \Carbon\Carbon::parse($day)->format('d M') }}</a>
                                                </th>
                                            @endforeach

                                            <th>Total</th>
                                            <th style="max-width: 125px">@if(isset($totalWorkTimes[$weekNumberOfYear]))
                                                <button  type="button" class="btn btn-success copyWeekModal" date-week-number="{{$weekNumberOfYear}}"><i class="fa fa-copy"></i> Copy Week</button>
                                                @else
                                                <button  type="button" class="btn btn-success setWeekModal" date-week-number="{{$weekNumberOfYear}}"><i class="fa fa-copy"></i> Copy Week</button>
                                                @endif
                                            </th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                    @if(!empty($all_weeks_project_data[$weekNumberOfYear] && $all_weeks_project_data[$weekNumberOfYear] != null ))

                                        @forelse($all_weeks_project_data[$weekNumberOfYear] as $stWork )
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td width="244">{{$stWork['project_name']}}</td>
                                            @foreach($week as $day)
                                                <td>@if(isset($stWork[$day]))
                                                    <?php list($hour, $minute, $second) = explode(':', $stWork[$day]); echo "{$hour}:$minute";?>
                                                    @endif</td>
                                            @endforeach
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td width="244"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif


                                    @if(isset($totalWorkTimes[$weekNumberOfYear]))
                                        <tfoot>
                                        <tr class="table-active-bg">
                                            <th>&nbsp;</th>
                                            <th>Total</th>
                                            @foreach($week as $day)
                                                <td>@if(isset($totalWorkTimes[$day]))
                                                        <?php list($hour, $minute, $second) = explode(':', $totalWorkTimes[$day]); echo "{$hour}:$minute";?>
                                                    @endif</td>
                                            @endforeach
                                            <th><?php list($hour, $minute, $second) = explode(':', $totalWorkTimes[$weekNumberOfYear] ); echo "{$hour}:$minute";?></th>
                                            <th><i class="fa fa-print"></i></th>
                                        </tr>
                                        </tfoot>
                                    @else
                                        <tfoot>
                                            <tr class="table-active-bg">
                                                <th colspan="11"  style="text-align: center; font-size: 10px; color: #ddd; font-weight: normal; font-style: italic;"  >No Timesheet Found!</th>
                                            </tr>
                                        </tfoot>
                                    @endif

                                </table>
                                @endforeach
                                {{--End of Week--}}
                        </div>
                        <?php } else {?>
                            No Data to show
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.timesheet_work.include.timesheet_view_modal')


</section>
@endsection
@section('PageJquery')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.copyWeekModal').click(function () {
                var  weekId = $(this).attr('date-week-number');
                $('.weekFormId').val(weekId);
                $('#copyWeekModal').modal();
            });
            $('.setWeekModal').click(function () {
                var  weekId = $(this).attr('date-week-number');
                $('.setWeekId').val(weekId);
                $('#setWeekModal').modal();
            });
        });
    </script>
    @if (Auth::user()->role_id ==1)
    <script type="text/javascript">
            var employee_id = $("#employee_id option:selected").val();
            $('#employee_id_timesheet').val(employee_id);

            function change_employee()
            {
                var employee_id = $("#employee_id option:selected").val();
                $('#employee_id_timesheet').val(employee_id);
            }
        </script>
    @endif
@endsection