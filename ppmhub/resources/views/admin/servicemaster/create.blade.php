@extends('layout.adminlayout')

<?php if (isset($service_master->service_id)) { ?>
    @section('title','Edit Service Master')
<?php } else { ?>
    @section('title','Create Service Master')
<?php } ?>
@section('body')

<!-- Service Master -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/service_validation.js') !!}

<!-- Service Master -->
<section id="create_form" class="panel">
    <!--div class="panel-heading">
        <h3>Basic Form Elements</h3>
    </div-->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Portfolio Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                            <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                            <a class="dropdown-item" href="javascript:void(0)">Portfolio Structure</a>
                            <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
                            <a class="dropdown-item" href="javascript:void(0)">Portfolio Resource Plaining</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>

                @if(!isset($service_master->service_id))
                {!! Form::open(array('route' => 'service_master.create','method'=>'post', 'id' => 'Serviceform')) !!} 
                @else
                {!! Form::open(array('route'=>array('service_master.update',$service_master->service_id),'method' => 'put','id' => 'Serviceform')) !!}
                @endif
                {{ csrf_field() }}

                <div class="margin-bottom-50">

                    <div class="margin-bottom-50">
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here : <a href="javascript: void(0);">Procurement</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/service_master')}}">Service Master</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($service_master->service_id))
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Service Master </span>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($service_master->service_id))
                                Edit
                                @else
                                Create
                                @endif 
                                Service Master
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Service Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('service_name',isset($service_master->service_name) ? $service_master->service_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Service Name'))!!}
                                                @if($errors->has('service_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('service_name') }}
                                                </div> 
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Supplier:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('supplier',$vid,isset($service_master->supplier) ? $service_master->supplier : '',array('class'=>'form-control','placeholder'=>'Please select Supplier','id'=>'vendorid'))!!}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Short Text:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('short_text',isset($service_master->short_text) ? $service_master->short_text : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Short text'))!!}
                                                @if($errors->has('short_text')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('short_text') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Service Description:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('service_description',isset($service_master->service_description) ? $service_master->service_description : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Description','size' => '30x8'))!!}
                                                @if($errors->has('service_description')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('service_description') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Service Category*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('service_category',array('Purchasing'=>'Purchasing'),isset($service_master->service_category) ? $service_master->service_category : '',array('class'=>'form-control select2','placeholder'=>'Please select Servicecategory','id'=>'service_category'))!!}  
                                            @if($errors->has('service_category')) 
                                            <div style='color:red'>
                                                {{ $errors->first('service_category') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Service Group*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('service_group',array('Purchasing'=>'Purchasing','service'=>'service','electrical'=>'electrical'),isset($service_master->service_group) ? $service_master->service_group : '',array('class'=>'form-control select2','placeholder'=>'Please select Servicegroup','id'=>'service_group'))!!}  
                                            @if($errors->has('service_group')) 
                                            <div style='color:red'>
                                                {{ $errors->first('service_group') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Unit Of Measure*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('unit_of_measure',$unitmeasure, isset($service_master->unit_of_measure) ? $service_master->unit_of_measure : '',array('class'=>'form-control select2','placeholder'=>'Please select Unit of user','id'=>'unit_of_measure'))!!}  
                                            @if($errors->has('unit_of_measure')) 
                                            <div style='color:red'>
                                                {{ $errors->first('unit_of_measure') }}
                                            </div> 
                                            @endif  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Ordering Unit*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('ordering_unit',$orderingut,isset($service_master->ordering_unit) ? $service_master->ordering_unit : '',array('class'=>'form-control select2','placeholder'=>'Please select Ordering Unit','id'=>'ordering_unit'))!!}  
                                            @if($errors->has('ordering_unit')) 
                                            <div style='color:red'>
                                                {{ $errors->first('ordering_unit') }}
                                            </div> 
                                            @endif  
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Standard Rate:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('standard_rate',isset($service_master->standard_rate) ? $service_master->standard_rate : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Standard Rate'))!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contractor Name:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('contractor_name',isset($service_master->contractor_name) ? $service_master->contractor_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contractor Name'))!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Tax classification:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('tax_classification',isset($service_master->tax_classification) ? $service_master->tax_classification : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Tax Classification'))!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Validity Start:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('validity_start',isset($service_master->validity_start) ? $service_master->validity_start : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select validity start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Validity End:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('validity_end',isset($service_master->validity_end) ? $service_master->validity_end : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select validity end date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Currency*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('currency',$currency,isset($service_master->currency) ? $service_master->currency : '',array('class'=>'form-control select2','placeholder'=>'Please select Currency','id'=>'currency'))!!}  
                                            @if($errors->has('currency')) 
                                            <div style='color:red'>
                                                {{ $errors->first('currency') }}
                                            </div> 
                                            @endif  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($service_master->status))
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-danger">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @else
                                                @if($service_master->status == 'active')
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <a class="active-bttn btn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
                                                <a class="inactive-btn btn btn-danger active">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer card-footer-box text-right">
                        @if(!isset($service_master->service_id))
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary card-btn')) !!}  
                        @else
                        {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn')) !!}  
                        @endif
                        <a href="{{url('/admin/service_master')}}" class="btn btn-danger">Cancel</a> </div>
                </div>
            </div>
            <!--End Vertical Form--> 
            {!! Form::close() !!}
        </div>
    </div>
</section><!--
<!-- End Dashboard -->

<!-- Page Scripts -->
<script type="text/javascript">
    $(document).ready(function () {

        $('#service_category').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#service_group').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#unit_of_measure').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#ordering_unit').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#currency').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#vendorid').select2().append('<option value=' + $vid + '>' + $vid + '</option>');
    });
</script>
@endsection