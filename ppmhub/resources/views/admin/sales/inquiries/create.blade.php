@extends('layout.admin')
@section('title', 'Sales Inquiry')
@section('PageCss')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        @if((!empty($inquiry)))
            {!! Form::open(['url' => route('sales-order-inquiry-update', $inquiry->sales_inquiry_id),  'class' => 'form-horizontal GlobalFormValidation']) !!}
        @else
            {!! Form::open(['url' => route('sales-order-inquiry-save'),  'class' => 'form-horizontal GlobalFormValidation']) !!}
        @endif
        <div class="row">
            <div class="col-lg-12">
                 <div class="margin-bottom-50">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>You are here : <a href="javascript: void(0);" style="margin-left: 10px;">Dashboard</a></li>
                        <li><a href="{{ route('sales-order-inquiry-index') }}">Sales Inquiries</a></li>
                        <li><span>{{ (!empty($inquiry)) ? 'Update' :  'Create' }} Inquiry</span></li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan"><h4 class="margin-0">{{ (!empty($inquiry)) ? 'Update' :  'Create' }} Inquiry</h4></div>
                    <div class="card-block">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Inquiry No.<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('sales_inquiry_no', (!empty($inquiry)) ? $inquiry->sales_inquiry_no :  $no, [ 'class'=>'form-control border-radius-0', 'readonly' ] )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Type<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('sales_order_type',[
                                                     'goods'=>'Goods',
                                                     'service'=>'Service '
                                                ],
                                                (!empty($inquiry)) ? $inquiry->sales_order_type : null,
                                                [
                                                    'class'=>'form-control border-radius-0 OnChangeOrderType',
                                                    'placeholder'=>'Please select sales order type',
                                                    'id'=>'salesorder_type',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Sales Order Type is required',
                                                ]  )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Customer<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('customer', $customers , (!empty($inquiry)) ? $inquiry->customer : null,
                                                [
                                                        'class'=>'form-control border-radius-0 select2 customer',
                                                        'placeholder'=>'Please select customer',
                                                        'id'=>'customer',
                                                        'data-fv-notempty' => true,
                                                        'data-fv-blank' => true,
                                                        'data-rule-required' => true,
                                                        'data-fv-notempty-message' => 'Customer is required',
                                                ]  )!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Description:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('description', (!empty($inquiry)) ? $inquiry->description : null, ['class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter sales order detailed description','maxlength'=>255, 'rows'=>3 ] )!!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Down Payment:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::number('down_payment',  (!empty($inquiry)) ? $inquiry->down_payment : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder' => 'Enter Down Payment'
                                             ] )!!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Region:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('region', $regions, (!empty($inquiry)) ? $inquiry->region : null, [ 'class' => 'form-control border-radius-0 select2', 'placeholder'=> 'Please select sales region', 'id'=>'sales_region' ]   ) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Organization:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('organization', $organizations, (!empty($inquiry)) ? $inquiry->organization : null, [ 'class'=>'form-control border-radius-0 select2','placeholder'=>'Please select sales organization','id'=>'sales_organization']  )!!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Requested By:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('requested_by', $employees, (!empty($inquiry)) ? $inquiry->requested_by : null,  [ 'class'=>'form-control border-radius-0 select2','placeholder'=>'Please select requested by','id'=>'requested_by' ] )!!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 col-lg-offset-1">
                                    @include('layout.admin_layout_include.alert_process')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer card-footer-box">
            <div class='error-message' style='display:none;'> </div>
            {!! Form::submit( (!empty($inquiry)) ? 'Update Inquiry': 'Create Inquiry',array('class'=>'btn btn-primary card-btn','id'=>'btn_save')) !!}
            <a href="{{ route('sales-order-inquiry-index')  }}" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection
@section('PageJquery')
    {!! Html::script('vendors/formValidation/js/formValidation.min.js') !!}
    {!! Html::script('vendors/formValidation/js/framework/bootstrap.min.js') !!}
    {!! Html::script('js/globalValidationCustom.js') !!}
    {!! Html::script('vendors/select2/dist/js/select2.full.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection