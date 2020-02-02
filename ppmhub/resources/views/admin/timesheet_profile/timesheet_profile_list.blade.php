@extends('layout.adminlayout')
@section('title','Timesheet Profile')

@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

<section class="page-content">
    <div class="page-content-inner">
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
                                    <span>Timesheet Profiles</span>
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
                        <h4>Timesheet Profiles</h4>
                        <div class="dashboard-buttons">
                            <a href="{{url('admin/addtimesheetprofiles')}}" class="btn btn-primary"> <i class="fa fa-send margin-right-5"></i> Create Timesheet Profile </a></div>

                        <br>
                        <div class="col-md-12">
                            <div class="margin-bottom-50">
                                <table class="table table-inverse" id="example3" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Timesheet Profile ID</th>
                                            <th>Timesheet Period</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Timesheet Profile ID</th>
                                            <th>Timesheet Period</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <!-- code for display cost centre data -->
                                        @foreach($timesheet_profile as $timeprofile)

                                        <tr>
                                            <td><a data-toggle="modal" data-target="#table-view-popup_{{ $timeprofile->time_sheet_profile_id }}">{{ $timeprofile->time_sheet_profile_id }}</a></td>
                                            <td class="sorting_1">{{ $timeprofile->time_sheet_entry_period }}</td>
                                            <td><img src="{{$timeprofile->status=='active' ? asset('vendors/common/img/green.png') : asset('vendors/common/img/red.png')}}" alt=""> 
                                            </td>

                                            
                                            <td class="action-btn">
                                                <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{ $timeprofile->time_sheet_profile_id }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a> 
                                                <a href="{{url('admin/edittimesheetprofile/'.$timeprofile->time_sheet_profile_id)}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>

                                                
                                                {!! Form::open(array('url' => array('admin/timesheetprofile_delete',$timeprofile->time_sheet_profile_id), 'method' => 'DELETE','id'=>'delform'.$timeprofile->time_sheet_profile_id)) !!}
                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this Timesheet Profile');
                                                                    if (res) {
                                                            document.getElementById('delform{{$timeprofile->time_sheet_profile_id}}').submit()
                                                                                }" class="btn btn-danger btn-xs margin-0"><i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                                {!! Form::close() !!}

                                                <div class="modal fade table-view-popup" id="table-view-popup_{{ $timeprofile->time_sheet_profile_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                            <a href="javascript: void(0);">Timesheet Profile</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript: void(0);">Display</a>
                                                                        </li>
                                                                        <li>
                                                                            <span>{{$timeprofile->time_sheet_profile_number}} </span>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="static-form">
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Timesheet Profile ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$timeprofile->time_sheet_profile_id}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Timesheet Period</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{ $timeprofile->time_sheet_entry_period }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Timesheet Period (Weeks)</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{ $timeprofile->time_sheet_number_days }} Weeks</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Timesheet Description</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{ $timeprofile->time_sheet_description }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created By</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{ $timeprofile->creator->name }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created On</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{ Carbon\Carbon::parse($timeprofile->created_at)->format('d-m-Y') }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Edited By</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{ isset($timeprofile->updated_by) ? $timeprofile->updator->name : '' }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Updated By</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{ Carbon\Carbon::parse($timeprofile->updated_at)->format('d-m-Y') }}</p>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer"> 
                                                                <span class="edit-btn"><a href="{{url('admin/edittimesheetprofile/'.$timeprofile->time_sheet_profile_id)}}" class="btn btn-primary">Edit</a></span>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- End  --></td>
                                        </tr>

                                        @endforeach
                                        <!-- code ends here -->

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Page Scripts --> 

    <!-- End Page Scripts --> 

</section>

<!-- End Page Scripts -->

@endsection