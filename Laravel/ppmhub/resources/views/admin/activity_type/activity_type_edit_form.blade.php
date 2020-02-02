@extends('layout.adminlayout')
@section('title','Edit Activity Type')

@section('body')
<!--Form Part start-->

<!-- Portfolio -->
<section id="create_form" class="panel">
    <!--div class="panel-heading">
        <h3>Basic Form Elements</h3>
    </div-->
    <div class="panel-body bg-lightcyan">

        <div class="row">
            <div class="col-lg-12">

                <!--Right Drop Down List Start-->
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
                <!--Right Drop Down List End-->

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="project" method="post" action="{{url('admin/activitytype_edit_save/'.$activity_type->activity_id)}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate>
                    {!! csrf_field() !!}

                    <div class="margin-bottom-50">
                        <!--Breadcrum Start-->
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">

                                <li>
                                    <a href="{{url('admin/dashboard')}}">Settings</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/activitytypes')}}">Activity Types</a>
                                </li>
                                <li>
                                    <span>Edit Activity Type</span>
                                </li>

                            </ul>

                            </ul>
                        </div>
                        <!--Breadcrum End-->

                        <!--Page Title Start-->       

                        <div class="card">
                            <div class="card-header card-header-box">
                                <h4 class="margin-0">
                                    Edit Activity Type
                                </h4>
                                <!-- Vertical Form -->
                            </div>


                            <!--Page Title End--> 
                            <div class="card-block bg-lightcyan">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="1">Activity Type<span class="required">*</span></label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input class="form-control border-radius-0 " placeholder="Activity Type" id="activity_type" name="activity_type" type="text" value="{{$activity_type->activity_type}}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="2">Activity Description</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <textarea class="form-control border-radius-0 " rows="3" id="l15" style="resize:none" name="activity_description" placeholder="Activity Description...">{{$activity_type->activity_description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="3">Cost Element<span class="required">*</span></label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input class="form-control border-radius-0 " placeholder="Cost Element" id="cost_element" name="cost_element" type="text" value="{{$activity_type->cost_element}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="4">Cost Element Desc</label>

                                            <div class="col-xs-12 col-sm-3">
                                                <div class="form-input-icon">
                                                    <textarea class="form-control border-radius-0 " style="resize:none" rows="3" id="l15" name="cost_element_description" placeholder="Cost Element Description...">{{$activity_type->cost_element_description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="start-date">Validity Start<span class="required">*</span></label>

                                            <div class="col-xs-12 col-sm-3">
                                                <div class="form-input-icon">
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input placeholder="Pick your start date" id="start-date" name="validity_start" type="text" class="form-control border-radius-0  datepicker-init" value="{{$activity_type->validity_start}}">
                                                        <span class="input-group-addon"> <i class="icmn-calendar"></i> </span> </span> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="end-date">Validity End<span class="required">*</span></label>

                                            <div class="col-xs-12 col-sm-3">
                                                <div class="form-input-icon">
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input placeholder="Pick your end date" id="end-date" name="validity_end" type="text" class="form-control border-radius-0  datepicker-init" value="{{$activity_type->validity_end}}">
                                                        <span class="input-group-addon"> <i class="icmn-calendar"></i> </span> </span> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="6">Activity Type Status</label>

                                            <div class="col-xs-12 col-sm-3">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <a class="active-bttn btn btn-default {{$activity_type->status==1 ? 'active' : '' }}">
                                                        <input type="radio" id="status" name="status" value="1" {{$activity_type->status==1 ? 'checked' : '' }} >
                                                        Active
                                                    </a>
                                                    <a class="inactive-btn btn btn-default {{$activity_type->status==0 ? 'active' : '' }}">
                                                        <input type="radio" id="status" name="status" value="0" {{$activity_type->status==0 ? 'checked' : '' }}>
                                                        Inactive
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="changed_by" value="{{ Auth::user()->name }}">
                                </div>
                            </div>


                                <!--Button Form Start-->

                                <div class="card-footer card-footer-box">
                                    <button type="submit" class="btn btn-primary card-btn">Save</button>

                                    <a href="{{url('admin/activitytypes')}}" class="btn btn-danger">Cancel</a>

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