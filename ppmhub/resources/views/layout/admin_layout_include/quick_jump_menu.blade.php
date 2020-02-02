<div class="dropdown inner-drpdwn">
    <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
        <span class="hidden-lg-down">@yield('title')</span><span class="caret"></span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="" role="menu">
        <a class="dropdown-item" href="{{url('admin/employees')}}">Employee Personnel Records</a>
        <a class="dropdown-item" href="{{url('admin/timesheetapprovals')}}">Time Approval settings</a>
        <a class="dropdown-item" href="{{url('admin/timesheetprofiles')}}">Time Sheet Profiles</a>
        <a class="dropdown-item" href="{{ route('timesheet.cost.dashboard')}}">Time Sheet Cost</a>
        <a class="dropdown-item" href="{{ route('timesheet.work.approvals.list')}}">Time Sheet Approval</a>
        <a class="dropdown-item" href="{{ route('timesheet.work.list.dashboard')}}">Time Sheet Management</a>
    </ul>
</div>