@extends('layout.admin')
@section('title', 'Sales Quotation')
@section('PageCss')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        @if((!empty($quotation)))
            {!! Form::open(['url' => route('sales-order-quotation-update', $quotation->sales_quotation_id),  'class' => 'form-horizontal GlobalFormValidation']) !!}
        @else
            {!! Form::open(['url' => route('sales-order-quotation-save'),  'class' => 'form-horizontal GlobalFormValidation']) !!}
        @endif
        <div class="row">
            <div class="col-lg-12">
                 <div class="margin-bottom-50">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>You are here : <a href="javascript: void(0);" style="margin-left: 10px;">Dashboard</a></li>
                        <li><a href="{{ route('sales-order-quotation-index') }}">Sales Quotations</a></li>
                        <li><span>{{ (!empty($quotation)) ? 'Update' :  'Create' }} Quotation</span></li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan"><h4 class="margin-0">{{ (!empty($quotation)) ? 'Update' :  'Create' }} Quotation</h4></div>
                    <div class="card-block">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Quotation No.<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('sales_quotation_no', (!empty($quotation)) ? $quotation->sales_quotation_no :  $no, [ 'class'=>'form-control border-radius-0', 'readonly' ] )!!}
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
                                                (!empty($quotation)) ? $quotation->sales_order_type : null,
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
                                                {!!Form::select('customer', $customers , (!empty($quotation)) ? $quotation->customer : null,
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
                                                {!!Form::textarea('description', (!empty($quotation)) ? $quotation->description : null, ['class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter sales order detailed description','maxlength'=>255, 'rows'=>3 ] )!!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Down Payment:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::number('down_payment',  (!empty($quotation)) ? $quotation->down_payment : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder' => 'Enter Down Payment'
                                             ] )!!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Region:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('region', $regions, (!empty($quotation)) ? $quotation->region : null, [ 'class' => 'form-control border-radius-0 select2', 'placeholder'=> 'Please select sales region', 'id'=>'sales_region' ]   ) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Organization:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('organization', $organizations, (!empty($quotation)) ? $quotation->organization : null, [ 'class'=>'form-control border-radius-0 select2','placeholder'=>'Please select sales organization','id'=>'sales_organization']  )!!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Requested By:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('requested_by', $employees, (!empty($quotation)) ? $quotation->requested_by : null,  [ 'class'=>'form-control border-radius-0 select2','placeholder'=>'Please select requested by','id'=>'requested_by' ] )!!}
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
                                                (!empty($quotation)) ? $quotation->approver_1 : null, ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Approver 1',
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
                                                {!!Form::select('approver_2', $employees,
                                                (!empty($quotation)) ? $quotation->approver_2 : null , ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Approver 2'

                                                ]  )!!}

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
                                                 (!empty($quotation)) ? $quotation->approver_3 : null , ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Approver 3'

                                                ]  )!!}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Approver 4:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('approver_4', $employees,
                                                  (!empty($quotation)) ? $quotation->approver_4 : null  , ['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Approver 4'

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
            {!! Form::submit( (!empty($quotation)) ? 'Update Quotation': 'Create Quotation',array('class'=>'btn btn-primary card-btn','id'=>'btn_save')) !!}
            <a href="{{ route('sales-order-quotation-index')  }}" class="btn btn-danger">Cancel</a>
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