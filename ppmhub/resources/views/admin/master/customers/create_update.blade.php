@extends('layout.admin')
@section('title', 'Customer Master')
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($customer))
                    {!! Form::open([ 'route' => ['customer.update', $customer->customer_id],  'method' => 'put', 'class' => 'form-horizontal GlobalFormValidation' ]) !!}
                @else
                    {!! Form::open([ 'route' => ['customer.store'], 'method' =>'post', 'class'=> 'form-horizontal GlobalFormValidation' ]) !!}
                @endif
                <div class="margin-bottom-50">
                    <div class="row PageTitleGlobal">
                        <div class="col-md-6">
                            <h1>Customer Master</h1>
                        </div>
                        <div class="col-md-6 text-right">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('customer.index') }}">Customer Master</a></li>
                                <li><span>@if(!empty($customer))  Update @else Create @endif Customer</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            @if(empty($customer) )
                                <h4 class="margin-0">Create Customer</h4>
                            @else
                                <h4 class="margin-0">Update Customer</h4>
                            @endif
                        </div>
                        <div class="card-block">
                             <div class="row" style="margin: 0;">
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Customer No.<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('customer_no', !empty($customer) ? $customer->customer_no : $CustomerID, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Customer No.',
                                                'data-fv-notempty' => true,
                                                'readonly' => 'readonly',
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Customer No. Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Customer Name<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('name', !empty($customer) ? $customer->name : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter Customer Name',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Customer Name Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Customer Email<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('email', !empty($customer) ? $customer->email : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter Customer Email',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Customer Email Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Office Phone<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('office_phone', !empty($customer) ? $customer->office_phone : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter Office Phone Number',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Office Phone Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Fax:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('fax', !empty($customer) ? $customer->fax : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Fax  Number'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Website Address:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::url('website_address', !empty($customer) ? $customer->website_address : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Website Address'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Postal Code<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!! Form::number('postal_code', !empty($customer) ? $customer->postal_code : null,
                                                [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Postal Code',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Postal Code Is Required',

                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Street Address<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!! Form::text('street', !empty($customer) ? $customer->street : null,
                                                [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Street Address',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Street Address Is Required'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">City<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!! Form::text('city', !empty($customer) ? $customer->city : null,
                                                [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter City',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'City Is Required',

                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Country<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!! Form::select('country', $countries,  !empty($customer) ? $customer->country : null,
                                                [
                                                    'class'=>'form-control border-radius-0 country',
                                                    'placeholder'=>'Select Country',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Country Is Required',

                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">State<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!! Form::select('state', !empty($state) ? $state : [],   !empty($customer) ? $customer->state : null,
                                                [
                                                    'class'=>'form-control border-radius-0 state',
                                                    'placeholder'=>'Select State',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'State Is Required',

                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-lg-offset-1" style="margin-top: 10px;">
                                    @include('layout.admin_layout_include.alert_process')
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{route( 'customer.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
    {!! Html::script('vendors/formValidation/js/formValidation.min.js') !!}
    {!! Html::script('vendors/formValidation/js/framework/bootstrap.min.js') !!}
    {!! Html::script('js/globalValidationCustom.js') !!}
    <script type="text/javascript">
        $(document).ready( function () {
            $('.country').change(function () {
                var countryID = $(this).val();
                if (countryID) {
                    getStateList(countryID);
                }
            });

            function getStateList(countryId) {
                $.ajax({
                    type: "GET",
                    url: "/admin/api/state/" + countryId,
                    success: function (response) {
                        $(".state").html('');
                        var stateOptions = '<option value="">Please select state</option>';
                        if (response.status) {
                            $.each(response.results, function (stateKey, stateVal) {
                                stateOptions += '<option value="' + stateVal.state_name + '">' + stateVal.state_name + '</option>';
                            })
                        }

                        $('.state').html(stateOptions);
                    }
                });
            }

        });


    </script>
@endsection