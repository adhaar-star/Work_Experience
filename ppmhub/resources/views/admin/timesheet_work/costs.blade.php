@extends('layout.admin')
@section('title', 'Timesheet Cost')
@section('body')
@include('layout.admin_layout_include.alert_messages')
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
                            <li><span>Timesheet Cost</span></li>
                        </ul>
                        <div class="box-header with-border pull-right">
                            <form class="form-inline" method="get">
                                <a style="margin: 0 15px 0 5px; "  href="{{ route('timesheet.cost.dashboard')  }}" class="btn btn-warning"><span class="fa fa-refresh"></span></a>
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
                            <div class="col-md-6 label label-warning  boxDesign "><h3><?php
                            if(!empty($total_minutes)){
                                echo $hours = intval($total_minutes/60);
                                echo ':';
                                echo $minutes = $total_minutes - ($hours * 60);
                            }?></h3><h6>Time</h6></div>
                            <div class="col-md-6 label label-info boxDesign" ><h3>${{$total_cost}}</h3><h6>Cost</h6></div>
                        </div>
                    </div>
                    @if($costs->count())
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Project</th>
                                    <th>Task</th>
                                    <th>Activity Type</th>
                                    <th>Cost Element</th>
                                    <th>Date</th>
                                    <th>Activity Rate</th>
                                    <th>Total Time</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($costs as $cost)
                                <tr>
                                    <td>{{  ($cost->employee_id > 0 && !empty($cost->employee)) ? $cost->employee->getFullNameAttribute()  : 'N/A'   }}</td>
                                    <td>{{  ($cost->project_id > 0 && !empty($cost->project)) ? $cost->project->project_name  : 'N/A'  }}</td>
                                    <td>{{  ($cost->task_id > 0 && !empty($cost->task)) ? $cost->task->task_name : 'N/A' }}</td>
                                    <td>{{  ($cost->activity_type_id > 0 && !empty($cost->activityType)) ? $cost->activityType->activity_type  : 'N/A' }}</td>
                                    <td>{{  ($cost->activity_type_id > 0 && !empty($cost->activityType)) ? $cost->activityType->cost_element  : 'N/A'  }}</td>
                                    <td>{{  ($cost->st_work_id > 0 && !empty($cost->StWork)) ?  Carbon\Carbon::parse($cost->StWork->st_work_date)->format('d/m/Y')  : 'N/A' }}</td>
                                    <td>{{  $cost->activity_rate }}</td>
                                    <td><?php
                                        if(!empty($cost->total_minutes)){
                                            echo $hours = intval($cost->total_minutes/60);
                                            echo ':';
                                            echo $minutes = $cost->total_minutes - ($hours * 60);
                                    }?></td>
                                    <td>{{  $cost->total_cost }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 pull-right">
                        {{ $costs->appends(
                        $_GET
                        )->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection