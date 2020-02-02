@extends('layout.admin')
@section('title', 'Billing')
@section('PageCss')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        {!! Form::open(['url' => route('billing-save'),  'class' => 'form-horizontal GlobalFormValidation']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-20">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>You are here : <a href="javascript: void(0);" style="margin-left: 10px;">Dashboard</a></li>
                        <li><a href="{{ route('billing-list') }}">Billing</a></li>
                        <li><span>Create Billing</span></li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan">
                        <h4 class="margin-0">Create Billing</h4>
                    </div>
                    <div class="card-block">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Billing No.<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('billing_no', $billing_no,    [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Billing No.',
                                                'readonly' => 'readonly',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Billing No. is required'
                                                ]  )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Order No.<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('sales_order_id', $sales_order_no,   null, [
                                                'class'=>'form-control border-radius-0 select2 OnChangeSalesOrderNo',
                                                'placeholder'=>'Select Sales Order No.',
                                                'data-url' => route('get-sales-order-items-billing'),
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Sales Order No. is required',

                                                ]  )!!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <table class="table table-striped BillingItem hidden">
                                        <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Item No.</th>
                                            <th>Description</th>
                                            <th>Gross Amount</th>
                                            <th>Total Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
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
            {!! Form::submit('Create Billing',array('class'=>'btn btn-primary card-btn','id'=>'btn_save')) !!}
            <a href="{{ route('billing-create')  }}" class="btn btn-danger">Cancel</a>
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
            $('.OnChangeSalesOrderNo').change( function () {
                var SalesOrderID = $(this).val();
                var URL = $(this).attr('data-url');
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: URL,
                    data: { sales_order_id : SalesOrderID },
                    success: function(json){
                        if(json.status == 'success'){
                            $('.BillingItem').removeClass('hidden');
                            var html = '';
                            $('.BillingItem tbody').html('')
                            $.each( json.SalesOrderItem, function( key, OrderItem ) {
                                html += '<tr><td><input type="checkbox" name="sales_order_item[]" value="'+ OrderItem.sales_order_item_id +'" ></td>';
                                html += '<td>'+ OrderItem.sales_order_item_no +'</td>';
                                html += '<td>'+ OrderItem.description +'</td>';
                                html += '<td>'+ OrderItem.gross_price +'</td>';
                                html += '<td>'+ OrderItem.total_price +'</td>';
                            });
                            $('.BillingItem tbody').append(html)

                        }
                        else if(json.status == 'false') {}
                        else if(json.status == 'validation'){
                            $('.BillingItem tbody').html('')
                            $('.BillingItem').addClass('hidden');
                        }
                    },
                    error : function(json){

                    },
                    dataType: "json"
                });
            });


        });
    </script>
@endsection