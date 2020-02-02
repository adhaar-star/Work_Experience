@extends('layout.admin')
@section('title', 'Sales Inquiry')
@section('PageCss')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-8">
                @if(!empty($order))
                    @if($order->status == 'created')
                        @if($order->sales_order_type == 'goods')
                            <div class="card salesItemFormContent" @if(empty($updateItem) &&  !empty($orderItems->count())) style="display: none; margin-bottom: 60px;" @endif>
                                <div class="card-block">
                                    <div class="tab-content">
                                        @include('admin.sales.inquiries.include.order_entry_item')
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->sales_order_type == 'service')
                            <div class="card salesItemFormContent" @if(empty($updateItem) &&  !empty($orderItems->count())) style="display: none; margin-bottom: 60px;" @endif>
                                <div class="card-block">
                                    <div class="tab-content">
                                        @include('admin.sales.inquiries.include.order_entry_item_service')
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    @if(!empty($orderItems->count()))
                        <div class="card">
                            <div class="card-header"><span class="highlightCustom"> {{ $order->sales_order_type  }} </span>
                                @if($order->status == 'created')
                                    @if((empty($updateItem)))
                                        <button style="margin-top: -5px;" type="button" class="salesItemFormContentShowBtn btn btn-primary pull-right btn-sm"><i class="fa fa-plus"></i> Add New Item</button>
                                    @endif
                                @else
                                    <button  style="margin: -5px 0 0;" class="btn btn-sm btn-success pull-right">Inquiry No. {{ $order->sales_inquiry_no  }}</button>
                                @endif
                            </div>
                            <div class="card-block">
                                <div class="tab-content">
                                    @include('admin.sales.inquiries.include.order_items')
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-block" style="padding-top: 5px;">
                        <div class="tab-content">
                            <div class="row">
                                 <table class="table table-striped">
                                     <tr class="bg-success" style="border-radius: 5px;">
                                         <td>Gross Amount</td>
                                         <td>{{ $order->gross_price }}</td>
                                     </tr>
                                     <tr>
                                         <td>Profit Margin Amount</td>
                                         <td>{{ $order->profit_margin_amount }}</td>
                                     </tr>

                                     @if($order->sales_order_type == 'goods')
                                     <tr>
                                         <td>Freight Charges</td>
                                         <td>{{ $order->freight_charges }}</td>
                                     </tr>
                                     @endif
                                     <tr>
                                         <td>Subtotal Without Discount</td>
                                         <td>{{ $order->gross_price +  $order->freight_charges + $order->profit_margin_amount }}</td>
                                     </tr>
                                     <tr>
                                         <td>Discount Amount</td>
                                         <td>{{ $order->discount_amount }}</td>
                                     </tr>

                                     <tr>
                                         <td>After Discount</td>
                                         <td>{{ $order->gross_price +  $order->freight_charges + $order->profit_margin_amount - $order->discount_amount}}</td>
                                     </tr>

                                     <tr>
                                         <td>Tax Amount</td>
                                         <td>{{ $order->tax_amount }}</td>
                                     </tr>

                                    <tr class="bg-info">
                                         <td>Total Amount</td>
                                         <td>{{ $order->total_price }}</td>
                                     </tr>

                                     @if( !empty($order->down_payment))
                                         <tr>
                                             <td>Down Payment</td>
                                             <td>{{ $order->down_payment }}</td>
                                         </tr>
                                         <tr class="bg-warning">
                                             <td>Total Payable</td>
                                             <td>{{  $order->total_price  - $order->down_payment }}</td>
                                         </tr>
                                     @endif

                                     @if( !empty($order->customer) && !empty($order->customerMaster))
                                         <tr>
                                             <td>Customer</td>
                                             <td>{{ $order->customerMaster->name  }}</td>
                                         </tr>
                                     @endif

                                     @if( !empty($order->organization)  && !empty($order->SalesOrganization))
                                         <tr>
                                             <td>Organization</td>
                                             <td>{{ $order->SalesOrganization->sales_organization }}</td>
                                         </tr>
                                     @endif
                                     @if( !empty($order->description) )
                                     <tr>
                                         <td colspan="2">{{ $order->description }}</td>
                                     </tr>
                                     @endif
                                     <tr>
                                         @if($order->status == 'created' )
                                             <td  colspan="2" >Current Status: <div class="label label-warning" style="margin-right: 15px; text-transform: capitalize;">{{ $order->status }}</div></td>
                                         @endif
                                         @if($order->status == 'success' )
                                             <td>Current Status: <div class="label label-success" style="margin-right: 15px; text-transform: capitalize;">{{ $order->status }}</div></td>
                                             <td><a href="{{ route('sales-order-quotation-items', $order->quotation->sales_quotation_id  ) }}"> Quotation {{ $order->quotation->sales_quotation_no }} </a></td>
                                         @endif
                                     </tr>
                                     @if( $order->status == 'created' &&  $order->total_price  >0 )
                                         <tr>
                                             <td colspan="2" align="center">
                                                <button   data-toggle="modal" data-target="#CreateQuotation"  class="btn btn-info-light ">Create A Quotation</button>
                                             </td>
                                         </tr>
                                     @endif
                                 </table>
                                @if($order->status == 'created' )
                                    <a href="{{ route('sales-order-inquiry-edit', $order->sales_inquiry_id ) }}"  style="margin-left: 15px;" class="btn btn-sm btn-primary">Update Information</a>
                                @else
                                    <button type="button" data-toggle="modal" data-target="#MoreOrderInformation"  style="margin-left: 15px;" class="btn btn-sm btn-primary">More Information</button>
                                @endif
                                <button  style="margin-right: 15px;" class="btn btn-sm btn-success pull-right">Inquiry No. {{ $order->sales_inquiry_no  }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if($order->status == 'created')
<div class="modal fade table-view-popup" id="deleteModelGlobal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document" style="text-align:left;">
        <div class="modal-content" style="border-radius: 0;">
            <div class="modal-header bg-danger" >
                <div class="col-sm-8 col-lg-offset-2">
                    <h3 class="model-list-striped-title text-white"  >Delete Confirmation</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class=" text-white">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="col-sm-8 col-lg-offset-2 text-center">
                    Are you Sure? you want to delete this item.
                </div>

            </div>
            <div class="modal-footer">
                {!! Form::open(['url' => '',  'class' => 'form-horizontal GlobalFormValidation ModelDeleteFormValidation']) !!}
                <div class="row">
                    <div class="col-sm-10 col-lg-offset-1">
                        @include('layout.admin_layout_include.alert_process')
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Yes Delete Now</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
<div class="modal fade table-view-popup" id="CreateQuotation" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document" style="text-align:left;">
        <div class="modal-content" style="border-radius: 0;">
            <div class="modal-header bg-warning" >
                <div class="col-sm-12">
                    <h3 class="model-list-striped-title text-white">Create Quotation from Inquiry</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class=" text-white">&times;</span>
                    </button>
                </div>
            </div>
            {!! Form::open(['url' => route('sales-order-quotation-create-form-inquiry', $order->sales_inquiry_id ),  'class' => 'form-horizontal GlobalFormValidation']) !!}
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">

                                <div class="form-input-icon">
                                    {!!Form::select('approver_1', $employees,
                                        null,
                                    [
                                        'class'=>'form-control border-radius-0 select2',
                                        'placeholder'=>'Select Approver 1*',
                                        'data-fv-notempty' => true,
                                        'data-fv-blank' => true,
                                        'data-rule-required' => true,
                                        'data-fv-notempty-message' => 'Sales Order Approver 01 is required',
                                    ]  )!!}
                                </div>

                        </div>
                        <div class="form-group row">
                            <div class="form-input-icon">
                                {!!Form::select('approver_2', $employees, null, ['class'=>'form-control border-radius-0 select2','placeholder'=>'Select Approver 2']  )!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                                <div class="form-input-icon">
                                    {!!Form::select('approver_3', $employees,
                                    null, ['class'=>'form-control border-radius-0 select2', 'placeholder'=>'Select Approver 3']  )!!}

                                </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-input-icon">
                                {!!Form::select('approver_4', $employees,
                                null, ['class'=>'form-control border-radius-0 select2','placeholder'=>'Select Approver 4']  )!!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="col-sm-10 col-lg-offset-1 text-center">Are you Sure? you want to create Quotation using Inquiry (No. {{ $order->sales_inquiry_no }}).</div>
                <div class="row">
                    <div class="col-sm-10 col-lg-offset-1">
                        @include('layout.admin_layout_include.alert_process')
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Yes Create A Quotation</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@else
    <div class="modal fade table-view-popup" id="MoreOrderInformation" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document" style="text-align:left;">
            <div class="modal-content" style="border-radius: 0;">
                <div class="modal-header">
                    <h3 class="model-list-striped-title">Sales Order Information</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body model-list-striped">

                    <div class="form-group">
                        <div class="col-sm-4"><p class="form-control-static">No.</p></div>
                        <div class="col-sm-8"><p class="form-control-static">{{ $order->sales_inquiry_no }}</p></div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <p class="form-control-static">Description</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{ $order->description }}</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" style="margin-right:20px;" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endif


@endsection
@section('PageJquery')
    {!! Html::script('vendors/select2/dist/js/select2.full.min.js') !!}
    {!! Html::script('vendors/formValidation/js/formValidation.min.js') !!}
    {!! Html::script('vendors/formValidation/js/framework/bootstrap.min.js') !!}
    {!! Html::script('js/globalValidationCustom.js') !!}
    @if($order->sales_order_type == 'goods')
        {!! Html::script('js/sales/order-items.js') !!}
    @else
        {!! Html::script('js/sales/order-items-service.js') !!}
    @endif
    <script type="text/javascript">
        $(document).ready(function () {
            $('.deleteGlobalBtn').click(function () {
                var url = $(this).attr('data-url');
                if(url != ''){
                    $('.ModelDeleteFormValidation').attr('action', url);
                    $('#deleteModelGlobal').modal('show');
                }
            });
            $('.deliveryGlobalBtn').click(function () {
                var url = $(this).attr('data-url');
                if(url != ''){
                    $('.ModelDeliveryFormValidation').attr('action', url);
                    $('#deliveryModelGlobal').modal('show');
                }
            });
            $('.reloadAfter5s').click( function () {
                setTimeout(function(){
                    window.location.href = location.href;
                }, 4000);
            });
        });
    </script>
@endsection