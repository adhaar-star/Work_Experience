@extends('layout.admin')
@section('title', 'Timesheet Approval')
@section('body')
    @include('layout.admin_layout_include.alert_messages')
@section('PageCss')
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
                <div class="margin-bottom-50">
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ route('timesheet.work.list.dashboard') }}">Time Sheet Management</a>
                                </li>
                                <li>
                                    <span>Timesheet Approval</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <div class="col-md-12">
                        <h3>{{ $st_work->employee->getFullNameAttribute() }}</h3>
                        <h5>{{\Carbon\Carbon::parse($st_work->st_work_date )->format('d/m/Y') }}</h5>
                            <div class="margin-bottom-50">
                                <table class="table table-striped"  width="100%">
                                    <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Lunch</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($st_work->StWorkTimes as $stWorkTime)
                                                <tr>
                                                    <td>{{ $stWorkTime->project->project_name }}</td>
                                                    <td>{{$stWorkTime->start_time}}</td>
                                                    <td>{{ $stWorkTime->end_time }}</td>
                                                    <td>{{ $stWorkTime->lunch_time }}</td>
                                                    <td><strong>{{ $stWorkTime->total_time }}</strong></td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><a class="btn btn-danger" href="{{ route('timesheet-work-make-rejected', $st_work->st_work_id) }}">Rejected</a> </td>
                                        <td><a class="btn btn-success" href="{{ route('timesheet-work-make-approved', $st_work->st_work_id) }}">Approved</a> </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection