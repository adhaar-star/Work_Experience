@extends('layout.adminlayout')
@section('title','Cost Centre')

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
                                    <span>Cost Centres</span>
                                </li>
                            </ul>
                        </div>

                        <!--Bread Crum End-->                
                        <h4>Cost Centres</h4>
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
                        <div class="dashboard-buttons"> 
                            @if (RoleAuthHelper::hasAccess('costcentres.create')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/addcostcentre')}}" class="btn btn-primary"> @endif<i class="fa fa-send margin-right-5"></i> Create Cost Centre </a> </div>

                        <br>
                        <div class="col-md-12">
                            <div class="margin-bottom-50">
                                <table class="table table-inverse" id="example3" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Cost Centre</th>
                                            <th>Company Code</th>
                                            <th>Validity Start</th>
                                            <th>Validity End</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Cost Centre</th>
                                            <th>Company Code</th>
                                            <th>Validity Start</th>
                                            <th>Validity End</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <!-- code for display cost centre data -->
                                        @foreach($cost_centre as $cost)

                                        <tr>
                                            <td> @if (RoleAuthHelper::hasAccess('costcentres.view')!=true)  
                                                {{ $cost->cost_centre }}
                                                @else
                                                <a data-toggle="modal" data-target="#table-view-popup_{{ $cost->cost_id }}">
                                                    {{ $cost->cost_centre }}
                                                    @endif
                                                </a>
                                            </td>
                                            <td>{{ $cost->company_code }}</td>
                                            <td>{{ Carbon\Carbon::parse($cost->validity_start)->format('d-m-Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($cost->validity_end)->format('d-m-Y') }}</td>
                                            <td><img src="{{$cost->status=='active' ? asset('vendors/common/img/green.png') : asset('vendors/common/img/red.png')}}" alt=""> 

                                            <td class="action-btn">
                                                @if (RoleAuthHelper::hasAccess('costcentres.view')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{ $cost->cost_id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                    @if (RoleAuthHelper::hasAccess('costcentres.update')!=true)  
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                        @else
                                                        <a href="{{url('admin/editcostcentre/'.$cost->cost_id)}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                        @if (RoleAuthHelper::hasAccess('costcentres.delete')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="{{url('admin/costcentre_delete/'.$cost->cost_id)}}" onclick="var res = confirm('Are you sure you want to delete this Cost Centre');
                                                                  if (res) {
                                                                      document.getElementById('delform').submit()
                                                                  }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>	
                                                            <div class="modal fade table-view-popup" id="table-view-popup_{{ $cost->cost_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document" style="text-align:left;">
                                                                    <div class="modal-content">
                                                            <!--	<style>
                                                                    .popup-brd-btm {border-bottom: 1px solid #ccc;}
                                                                    </style>-->
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                                                            <div class="margin-bottom-10">
                                                                                <ul class="list-unstyled breadcrumb">
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Settings</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Cost Centres</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="javascript: void(0);">Display Cost Centre</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span>{{ $cost->cost_centre }}</span>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>

                                                                            <!--<h4 class="modal-title" id="myModalLabel">{{ $cost->cost_centre }}</h4>-->
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="static-form">
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Cost Description</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $cost->cost_description }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Company Code</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $cost->company_code }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Company Code Description</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ $cost->company_code_description }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Validity Start</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ Carbon\Carbon::parse($cost->validity_start)->format('d-m-Y') }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Validity End</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ Carbon\Carbon::parse($cost->validity_end)->format('d-m-Y') }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$cost->created_by}}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created On</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ Carbon\Carbon::parse($cost->created_at)->format('d-m-Y') }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Edited By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{$cost->changed_by}}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group popup-brd-btm">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Updated On</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">{{ Carbon\Carbon::parse($cost->updated_at)->format('d-m-Y') }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="edit-btn"><a href="{{url('admin/editcostcentre/'.$cost->cost_id)}}" class="btn btn-primary">Edit</a></span>
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

                                                            @endsection