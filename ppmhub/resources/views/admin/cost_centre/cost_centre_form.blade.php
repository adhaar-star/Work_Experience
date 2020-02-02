@extends('layout.adminlayout')
@section('title','Create Cost Centre')

@section('body')

<!--<section class="page-content">
    <div class="page-content-inner">-->

<!-- Portfolio -->
<section id="create_form" class="panel">
    <!--div class="panel-heading">
        <h3>Basic Form Elements</h3>
    </div-->
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





                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <form id="project" method="post" action="{{url('admin/costcentre_save')}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate>
                    {!! csrf_field() !!}
                    <div class="margin-bottom-50">

                        <!--Bread Crum Start-->

                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">

                                <li>
                                    <a href="{{url('admin/dashboard')}}">Settings</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/costcentretype')}}">Cost Centre</a>
                                </li>
                                <li>
                                    <span>Create Cost Centre</span>
                                </li>

                            </ul>
                        </div>

                        <!--Bread Crum End-->

                        <!--Page Title Start-->       

                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">Create Cost Centre</h4>
                                <!-- Vertical Form -->
                            </div>


                            <!--Page Title End--> 
                            <div class="card-block">
                                <div class="row" style="margin: 0;">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="1">Cost Centre<span class="required">*</span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <input class="form-control border-radius-0 " placeholder="Cost Centre" id="cost_centre" name="cost_centre" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-xs-12 col-md-4 col-form-label" for="2">Cost Description</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <textarea class="form-control border-radius-0 " rows="3" id="l15" style="resize:none" name="cost_description" placeholder="Cost Description..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0;">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-xs-12 col-md-4 col-form-label" for="3">Company Code<span class="required">*</span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <input class="form-control border-radius-0 " placeholder="Company Code" id="company_code" name="company_code" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-xs-12 col-md-4 col-form-label" for="4">Company Code Desc</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <textarea class="form-control border-radius-0 " style="resize:none" rows="3" id="l15" name="company_code_description" placeholder="Company Code Description..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row" style="margin: 0">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-xs-12 col-md-4 col-form-label" for="start-date">Validity Start<span class="required">*</span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input placeholder="Pick your start date" id="start-date" name="validity_start" type="text" class="form-control border-radius-0  datepicker-init">
                                                        <span class="input-group-addon"> <i class="icmn-calendar"></i> </span> </span> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-xs-12 col-md-4 col-form-label" for="end-date">Validity End<span class="required">*</span></label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input placeholder="Pick your end date" id="end-date" name="validity_end" type="text" class="form-control border-radius-0  datepicker-init">
                                                        <span class="input-group-addon"> <i class="icmn-calendar"></i> </span> </span> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Status:</label>
                                            <div class="col-sm-3">
                                                <div class="btn-group" data-toggle="buttons">

                                                    <span class="active-bttn btn btn-primary active">
                                                        <!--Active-->
                                                        {!! Form::radio('status','active','active') !!}Active

                                                    </span>
                                                    <span class="inactive-btn btn btn-danger">
                                                        <!--Inactive-->
                                                        {!! Form::radio('status','inactive') !!}Inactive

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                            </div>



                            <!--Button Form Start-->

                            <div class="card-footer card-footer-box text-right">
                                <button type="submit" class="btn btn-primary card-btn">Save</button>

                                <a href="{{url('admin/costcentres')}}" class="btn btn-danger">Cancel</a>
                            </div>

                            <!--Button Form End-->
                        </div>

                </form>

            </div>

        </div>
    </div>

    <!--        </section>
        </div>-->

    <!-- Page Scripts --> 

    <!-- End Page Scripts --> 

</section>
<script type="text/javascript">
    $(".datepicker-init").datetimepicker({
        format: "YYYY-MM-DD"
    });
</script>    
@endsection