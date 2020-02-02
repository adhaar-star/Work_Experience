@extends('layout.admin')
@section('title', 'Sales Order')
@section('PageCss')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        {!! Form::open(['url' => route('sales-order-save'),  'class' => 'form-horizontal GlobalFormValidation']) !!}
        <div class="row">
            <div class="col-lg-12">
                 <div class="margin-bottom-50">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>You are here : <a href="javascript: void(0);" style="margin-left: 10px;">Dashboard</a></li>
                        <li><a href="{{ route('sales-order-index') }}">Sales Order</a></li>
                        <li><span>Create Sales Order</span></li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan"><h4 class="margin-0">Create Sales Order</h4></div>
                    <div class="card-block">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Order Number<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('sales_order_no', $sales_order_no, [ 'class'=>'form-control border-radius-0', 'readonly' ] )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Order Type<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('sales_order_type',[
                                                     'goods'=>'Billing Goods',
                                                     'service'=>'Billing Service ',
                                                     'milestone'=>'Billing Milestone',
                                                     'timesheet'=>'Billing Timesheet'
                                                ],
                                                 null,
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
                                                {!!Form::select('customer', $customers , null,
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
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Down Payment:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::number('down_payment',  null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder' => 'Enter Down Payment'
                                             ] )!!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Number:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('quotation', $quotations, null, ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select quotation number','id'=>'quotation_no'] )!!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Number:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('inquiry', $inquiries, null, ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select inquiry number','id'=>'inquiry_no'] )!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Description:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('description', null, ['class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter sales order detailed description','maxlength'=>255, 'rows'=>3 ] )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Region:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('region', $regions, null, [ 'class' => 'form-control border-radius-0 select2', 'placeholder'=> 'Please select sales region', 'id'=>'sales_region' ]   ) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Organization:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('organization', $organizations, null, [ 'class'=>'form-control border-radius-0 select2','placeholder'=>'Please select sales organization','id'=>'sales_organization']  )!!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Requested By:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('requested_by', $employees, null, [ 'class'=>'form-control border-radius-0 select2','placeholder'=>'Please select requested by','id'=>'requested_by' ] )!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="afterOnChangeOrderType">
                            <div class="row afterOnChangeOrderType">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Total Recurring Period:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::number('total_recurring_period',   null, [
                                                    'class'=>'form-control  border-radius-0 no-resize ',
                                                     'max' =>99,
                                                     'min' => 1,
                                                     'step' =>'0.50',
                                                     'placeholder'=>'Total Recurring Period',

                                                ] )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Recurring Period:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('recurring_period',
                                                [

                                                    '1' => 'Daily',
                                                    '7' => 'Weekly',
                                                    '30' => 'Every 30 days',
                                                    '45' => 'Every 45 days',
                                                    '90' => 'Every 90 days',
                                                    '180' => 'Every 180 days',
                                                    '365' => 'Yearly',
                                                ],
                                                 null,
                                                [
                                                    'class'=>'form-control  border-radius-0 no-resize',
                                                    'placeholder' => 'Select Recurring Period'

                                                 ] )!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Auto Billing Date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('auto_billing_date',   null, [
                                                    'class'=>'form-control  border-radius-0 no-resize datepicker-only-init ',
                                                     'placeholder'=>'Auto Billing Date',

                                                ] )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12 col-md-offset-2">
                                            <div class="form-input-icon">
                                                <label class="containerCheckbox"> Auto Billing
                                                    {!! Form::checkbox('auto_billing', 1) !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Approver 1<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('approver_1', $employees,
                                                    null,
                                                [
                                                    'class'=>'form-control border-radius-0 select2',
                                                    'placeholder'=>'Please select Approver 1',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Sales Order Approver 01 is required',
                                                ]  )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Approver 2:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('approver_2', $employees, null, ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Approver 2']  )!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Approver 3</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('approver_3', $employees,
                                                null, ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Approver 3'

                                                ]  )!!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Approver 4:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('approver_4', $employees,
                                                null, ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Approver 4'

                                                ]  )!!}

                                            </div>
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
            {!! Form::submit('Create Order',array('class'=>'btn btn-primary card-btn','id'=>'btn_save')) !!}
            <a href="{{ route('sales-order-create')  }}" class="btn btn-danger">Cancel</a>
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
        $('.OnChangeOrderType').change( function () {
            if($(this).val() == 'milestone' || $(this).val() == 'timesheet'){
                $('.afterOnChangeOrderType').slideUp();
            }else{
                $('.afterOnChangeOrderType').slideDown();
            }
        });
        
    </script>
@endsection