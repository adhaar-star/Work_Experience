@extends('layout.admin')
@section('title', 'Timesheet Approvals')
@section('body')
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
 <section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-10">
                    <div class="margin-bottom-5">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li><a href="{{ route('timesheet.work.list.dashboard') }}">Time Sheet Management</a></li>
                            <li><span>Timesheet Approval</span></li>
                        </ul>
                        <div class="box-header with-border pull-right">
                            <form class="form-inline" method="get">
                                <a style="margin: 0 15px 0 5px; "  href="{{ route('timesheet.work.approvals.list')  }}" class="btn btn-warning"><span class="fa fa-refresh"></span></a>
                                <div class="form-group">
                                    <input  value="{{ isset( $_GET['start_date'] )  ? $_GET['start_date']: null }}" class="datepicker-only-init form-control" name="start_date" placeholder="From: Y-M-D">
                                </div>
                                <div class="form-group">
                                    <input   value="{{isset( $_GET['end_date'] )  ? $_GET['end_date']: null}}" class="datepicker-only-init  form-control" name="end_date" placeholder="TO: Y-M-D">
                                </div>
                                <button style="margin: 0 15px;" type="submit" class="btn btn-warning"> Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12" style="margin: 10px 0;" >
                            <div class="col-md-6 label label-info boxDesign" ><h3>{{$pending_timesheet}}</h3><h6>Pending Timesheet</h6></div>
                            <div class="col-md-6 label label-warning  boxDesign "><h3><?php
                                    if(!empty($pending_timesheet_times)){
                                        echo $hours = intval($pending_timesheet_times/60);
                                        echo ':';
                                        echo $minutes = $pending_timesheet_times - ($hours * 60);
                                    }else { echo 0;}?></h3><h6>Time</h6></div>
                        </div>
                    </div>
                    @if($st_works->count())
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Total Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($st_works as $st_work)
                                <tr>
                                    <td>{{  ($st_work->employee_id > 0 && !empty($st_work->employee)) ? $st_work->employee->getFullNameAttribute()  : 'N/A'   }}</td>
                                    <td>{{    \Carbon\Carbon::parse($st_work->st_work_date)->format('d/m/Y')  }}</td>
                                    <td><?php
                                        $st_works_time = $st_work->StWorkTimes->sum('total_minutes');
                                        $hours = 0;
                                        $minutes = 0;
                                        if(!empty($st_works_time)){
                                            $hours = intval($st_works_time /60);
                                            $minutes = $st_works_time- ($hours * 60);
                                            echo "$hours:$minutes";
                                        }else{
                                            echo 0;
                                        }?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#table-view-popup_{{ $st_work->st_work_id }}"  title="View Detail"><i class="fa fa-eye"></i> View</button>
                                        <div class="modal fade table-view-popup" id="table-view-popup_{{ $st_work->st_work_id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content" style="border-radius: 0;">
                                                    <div class="modal-header">
                                                        <h3 class="model-list-striped-title">Approve Timesheet</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body model-list-striped">
                                                         <div class="form-group bg-success">
                                                            <div class="col-sm-4"><p class="form-control-static">Date</p></div>
                                                            <div class="col-sm-8">
                                                                <p class="form-control-static">{{    \Carbon\Carbon::parse($st_work->st_work_date)->format('d/m/Y')  }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-4">
                                                                <p class="form-control-static">Employee</p>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="form-control-static">{{  ($st_work->employee_id > 0 && !empty($st_work->employee)) ? $st_work->employee->getFullNameAttribute()  : 'N/A'   }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" style="background: #FFF;     margin: -1px 0 0;">

                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead>
                                                                    <tr style="background: #fff;">
                                                                        <th>Project</th>
                                                                        <th>Task</th>
                                                                        <th>Work Time</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($st_work->StWorkTimes as $stWorkTime)
                                                                        <tr>
                                                                            <td>{{ $stWorkTime->project->project_Id }} - {{ $stWorkTime->project->project_name }}</td>
                                                                            <td>{{ $stWorkTime->task->task_name }}</td>
                                                                            <td><strong><?php
                                                                                    $hours_s =0;
                                                                                    $minutes_s =0;
                                                                                        if($stWorkTime->total_minutes > 0){
                                                                                            $hours_s = intval($stWorkTime->total_minutes /60);
                                                                                            $minutes_s = $stWorkTime->total_minutes - ($hours_s * 60);
                                                                                            echo "$hours_s:$minutes_s";
                                                                                        }else {
                                                                                            echo 0;
                                                                                        }
                                                                                    ?></strong></td>
                                                                        </tr>
                                                                    @endforeach
                                                                    <tr class=" bg-warning" style="font-weight: bold;">
                                                                        <td colspan="2" style="text-align: right;"> Total Time </td>
                                                                        <td>{{ (isset($minutes) &&  $minutes > 0) ?  "$hours:$minutes" : 0 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td  colspan="2"><a class="btn btn-danger" href="{{ route('timesheet-work-make-rejected', $st_work->st_work_id) }}">Rejected</a> </td>

                                                                        <td><a class="btn btn-success" href="{{ route('timesheet-work-make-approved', $st_work->st_work_id) }}">Approved</a> </td>
                                                                    </tr>
                                                                    </tbody>

                                                                </table>

                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 pull-right">
                        {{ $st_works->appends(
                        $_GET
                        )->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
@endsection