@extends('layout.adminlayout')
@section('title','Activity Rates')

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
                                    <span class="hidden-lg-down">Settings</span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="" role="menu">
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/portfoliotypes')}}">
                                            Portfolio Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/projecttype')}}">
                                            Project Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/phasetype')}}">
                                            Phase Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/currencies')}}">
                                            Currency
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/capacityunits')}}">
                                            Capacity Units
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/periodtype')}}">
                                            Period Types
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/planningunit')}}">
                                            Planning Unit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/planningtype')}}">
                                            Planning Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/costingtype')}}">
                                            Costing Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/collectiontype')}}">
                                            Collection Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/viewtype')}}">
                                            View Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/personresponsible')}}">
                                            Person Responsible
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/departmenttype')}}">
                                            Department Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/costcentretype')}}">
                                            Cost Centre Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/projectlocation')}}">
                                            Project Location
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/factorycalendar')}}">
                                            Factory Calendar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/activityrates')}}">
                                            Activity Rates 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/costcentres')}}">
                                            Cost Centres 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('admin/activitytypes')}}">
                                            Activity Types 
                                        </a>
                                    </li>
                                </ul>
                            </div> 
                        </div>
                        <!--Drop Down List End--> 

                        <!--Bread Crum Start-->
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Settings</a>
                                </li>
                                <li>
                                    <span>Activity Rates</span>
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
                          $('#error_container').fadeIn('slow').delay(4000).fadeOut('slow');
                        </script>
                        @endif
                        @endforeach
                        <!-- end .flash-message -->
                        <h4>Activity Rates</h4>
                        <div class="dashboard-buttons">
                            @if (RoleAuthHelper::hasAccess('activityRates.create')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                  <a href="{{url('admin/addactivityrates')}}" class="btn btn-primary"> @endif<i class="fa fa-send margin-right-5"></i> Create Activity Rates </a> <!--<a href="#" class="btn btn-primary"> <i class="fa fa-send margin-right-5"></i> Export </a>--> </div>
                        <br>
                        <div class="col-md-12">
                            <div class="margin-bottom-50">
                                <table class="table table-inverse" id="example3" width="100%"><thead>
                                        <tr>
                                            <th>Activity Type</th>
                                            <th>Actual Rate</th>
                                            <th>Billing Rate</th>
                                            <th>Plan Rate</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Activity Type</th>
                                            <th>Actual Rate</th>
                                            <th>Billing Rate</th>
                                            <th>Plan Rate</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <!-- code for display cost centre data -->
                                        @foreach($activity_rates as $activity)

                                        <tr>
                                            <td><a data-toggle="modal" data-target="#table-view-popup_{{ $activity->activity_rate_id }}">{{ $activity->activity_type_id }}</a></td>
                                            <td>{{ $activity->activity_actual_rate }}</td>
                                            <td>{{ $activity->billing_rate }}</td>
                                            <td>{{ $activity->activity_plan_rate }}</td>
                                            <td><img src="{{$activity->status==1 ? asset('vendors/common/img/green.png') : asset('vendors/common/img/red.png')}}" alt=""> 
                                            <td class="action-btn">
                                                @if (RoleAuthHelper::hasAccess('activityRates.view')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="#" class="btn btn-info btn-xs margin-right-0" data-toggle="modal" data-target="#table-view-popup_{{ $activity->activity_rate_id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a> 
                                                    @if (RoleAuthHelper::hasAccess('activityRates.update')!=true)  
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                        @else
                                                        <a href="{{url('admin/editactivityrate/'.$activity->activity_rate_id)}}" class="btn btn-info btn-xs margin-right-0">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>

                                                        @if (RoleAuthHelper::hasAccess('activityRates.delete')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="{{url('admin/activityrate_delete/'.$activity->activity_rate_id)}}" onclick="var res = confirm('Are you sure you want to delete this Activity Rate');
                                                                  if (res) {
                                                                      document.getElementById('delform').submit()
                                                                  }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                                            <div class="modal fade table-view-popup" id="table-view-popup_{{ $activity->activity_rate_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document" style="text-align:left;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                                                            <div class="margin-bottom-10">
                                                                                <ul class="list-unstyled breadcrumb">
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Settings</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Activity Rates</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Display</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span>{{ $activity->activity_type->activity_type }}</span>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>

                                                                            <!--<h4 class="modal-title" id="myModalLabel">{{ $activity->activity_type }}</h4>-->
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="static-form">
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Activity Type</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $activity->activity_type->activity_type }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Cost Centre</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ isset($activity->cost_centre->cost_centre) ? $activity->cost_centre->cost_centre : '' }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Personnel Number</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $activity->employee_personnel_number->employee_id }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Activity Rate Description</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $activity->activity_rate_description }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Actual Rate</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $activity->activity_actual_rate }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Billing Rate</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $activity->billing_rate }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Plan Rate</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $activity->activity_plan_rate }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Validity Start</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ Carbon\Carbon::parse($activity->activity_validity_start)->format('d-m-Y') }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Validity End</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ Carbon\Carbon::parse($activity->activity_validity_end)->format('d-m-Y') }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$activity->created_by}}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created On</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{Carbon\Carbon::parse($activity->created_at)->format('d-m-Y')}}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Edited By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$activity->changed_by}}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Edited At</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{Carbon\Carbon::parse($activity->updated_at)->format('d-m-Y')}}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer"> 
                                                                            <span class="edit-btn"><a href="{{url('admin/editactivityrate/'.$activity->activity_rate_id)}}" class="btn btn-primary">Edit</a></span>
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