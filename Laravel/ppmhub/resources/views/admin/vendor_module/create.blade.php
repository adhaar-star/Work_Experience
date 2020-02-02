@extends('layout.adminlayout')
@section('title','Create Vendor')

@section('body')

<!-- Vendor -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/vendor_validation.js') !!}

<!-- Vendor -->
<section id="create_form" class="panel">

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
                        </ul>
                    </div> 
                </div>

                @if(!isset($vendor->id))
                {!! Form::open(array('route' => 'vendor.create','method'=>'post', 'id' => 'Vendorform')) !!} 
                @else
                {!! Form::open(array('route'=>array('vendor.update',$vendor->id),'method' => 'put','id' => 'Vendorform')) !!}
                @endif
                {{ csrf_field() }}

                <div class="margin-bottom-50">

                    <div class="margin-bottom-50">
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here :    <a href="javascript: void(0);">Procurement</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/vendor')}}">Vendor</a>
                            </li>
                            <li>
                                <span>Create Vendor</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0"> Create Vendor</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Vendor Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('name',isset($vendor->name) ? $vendor->name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Vendor Name'))!!}
                                                @if($errors->has('name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Vendor ID*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('vendor_id',isset($vendor->vendor_id) ? $vendor->vendor_id : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Vendor Id'))!!}
                                                @if($errors->has('vendor_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('vendor_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Website Address*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('website_address',isset($vendor->website_address) ? $vendor->website_address : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Website Address'))!!}
                                                @if($errors->has('website_address')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('website_address') }}
                                                </div> 
                                                @endif                                    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" >Fax*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('fax',isset($vendor->fax) ? $vendor->fax : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Fax number'))!!}
                                                @if($errors->has('fax')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('fax') }}
                                                </div> 
                                                @endif                                     
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" >Office Phone*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('office_phone','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Office phone'))!!}
                                                @if($errors->has('office_phone')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('office_phone') }}
                                                </div> 
                                                @endif                                     
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Email Address*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('email',isset($vendor->email) ? $vendor->email : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Email Address'))!!}
                                                @if($errors->has('email')) 
                                                <div style='color:red' id='emailError'>
                                                    {{ $errors->first('email') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="created_date" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Street*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('street',isset($vendor->street) ? $vendor->street : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Street'))!!}
                                                @if($errors->has('street')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('street') }}
                                                </div> 
                                                @endif                                    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">City*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('city',isset($vendor->city) ? $vendor->city : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter City'))!!}
                                                @if($errors->has('city')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('city') }}
                                                </div> 
                                                @endif                                     
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">State*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('state',$state_data,'',array('class'=>'form-control select2','placeholder'=>'Please select state','id'=>'state'))!!}  
                                            <!--                                            @if($errors->has('state')) 
                                                                                        <div style='color:red'>
                                                                                            {{ $errors->first('state') }}
                                                                                        </div> 
                                                                                        @endif  -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Country*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('country',$country_data,'',array('class'=>'form-control select2','placeholder'=>'Please select country','id'=>'country'))!!}  
                                            @if($errors->has('country')) 
                                            <div style='color:red'>
                                                {{ $errors->first('country') }}
                                            </div> 
                                            @endif                                
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Postal*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('postal_code',array('1'=>'3000','2'=>'4000','3'=>'6000','4'=>'7000'),'',array('class'=>'form-control select2','placeholder'=>'Please select postal code'))!!}  
                                            @if($errors->has('postal_code')) 
                                            <div style='color:red'>
                                                {{ $errors->first('postal_code') }}
                                            </div> 
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($vendor->id)) 
                                                <a class="active-bttn btn btn-primary active">
                                                    <!--Active-->
                                                    {!! Form::radio('status','active',true) !!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-danger">
                                                    <!--Inactive-->
                                                    {!! Form::radio('status','inactive') !!}Inactive

                                                </a>
                                                @else
                                                <a class="active-bttn btn btn-primary active">
                                                    <!--Active-->
                                                    {!! Form::radio('status','active',isset($vendor->status) && $vendor->status=='active' ? true : false) !!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-default">
                                                    Inactive
                                                    {!! Form::radio('status','inactive',isset($vendor->status) && $vendor->status=='inactive' ? true : false) !!}Inactive
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{url('/admin/vendor')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                    <!--End Vertical Form--> 
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section><!--
<!-- End Dashboard -->

<!-- Page Scripts -->
<script type="text/javascript">
    $(document).ready(function () {
        if (($('#emailError').html() != undefined || $('#emailError').html() != 'undefined') && $('#country').val() != "") {
            getStateList(parseInt($('#country').val()));
        }
    });
    $('#country').change(function () {
        var countryID = $(this).val();
        if (countryID) {
            getStateList(countryID);
        }
    });


    $('#state').select2({
    }).on('change', function () {
        $(this).valid();
    });

    $('#country').select2({
    }).on('change', function () {
        $(this).valid();
    });

    function getStateList(countryId) {
        $.ajax({
            type: "GET",
            url: "/admin/api/state/" + countryId,
            success: function (response) {
                $("#state").html('');
                var stateOptions = '<option value="">Please select state</option>';
                if (response.status) {
                    $.each(response.results, function (stateKey, stateVal) {
                        stateOptions += '<option value="' + stateVal.state_name + '">' + stateVal.state_name + '</option>';
                    })
                }

                $('#state').html(stateOptions);
            }
        });
    }
</script>

@endsection
