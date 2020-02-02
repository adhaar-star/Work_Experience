@extends('layout.admin')
@section('title', 'Sales Quotation')
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
                                        @include('admin.sales.quotations.include.order_entry_item')
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->sales_order_type == 'service')
                            <div class="card salesItemFormContent" @if(empty($updateItem) &&  !empty($orderItems->count())) style="display: none; margin-bottom: 60px;" @endif>
                                <div class="card-block">
                                    <div class="tab-content">
                                        @include('admin.sales.quotations.include.order_entry_item_service')
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
                                    <button  style="margin: -5px 0 0;" class="btn btn-sm btn-success pull-right">Quotation No. {{ $order->sales_quotation_no  }}</button>
                                @endif
                            </div>
                            <div class="card-block">
                                <div class="tab-content">
                                    @include('admin.sales.quotations.include.order_items')
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(!empty($order->subject))
                        <div class="card">
                            <div class="card-header">
                                To: @if( !empty($order->customer) && !empty($order->customerMaster)){{ $order->customerMaster->email  }}@endif
                            </div>
                            <div class="card-block">
                                <div class="tab-content">
                                    <p>Subject : {{ $order->subject  }}</p>
                                    Message : <br> {{ $order->message  }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($comments->count()))
                        <div class="row SalesComments">
                            @forelse($comments as $comment)
                                <div class="col-md-12">
                                    <div class="SalesComment">
                                        <div class="SalesCommentHead">{{date("F j, Y ", strtotime($comment->created_at))}}</div>
                                        <div class="SalesCommentMessage">{{ $comment->description }}</div>
                                    </div>
                                </div>
                            @endforeach
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
                                    @if( !empty($order->approver_1)  && !empty($order->SalesApprover1))
                                         <tr>
                                             <td>Approver 01</td>
                                             <td>{{ $order->SalesApprover1->full_name }}
                                                 @if($order->status == 'pending' )
                                                     @if($order->approve_status > 0 )
                                                         <button type="button"  class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i></button>
                                                     @endif
                                                     @if($order->approve_status == 0 )
                                                         <button type="button" data-toggle="modal" data-target="#OrderApproved" class="btn btn-sm btn-primary pull-right">Approve</button>
                                                     @endif
                                                 @endif
                                             </td>
                                         </tr>
                                    @endif

                                     @if( !empty($order->approver_2)  && !empty($order->SalesApprover2))
                                         <tr>
                                             <td>Approver 02</td>
                                             <td>{{ $order->SalesApprover2->full_name }}
                                                 @if($order->status == 'pending' )
                                                     @if($order->approve_status > 1 )
                                                         <button type="button"  class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i></button>
                                                     @endif
                                                     @if($order->approve_status == 1 )
                                                         <button type="button" data-toggle="modal" data-target="#OrderApproved" class="btn btn-sm btn-primary pull-right">Approve</button>
                                                     @endif
                                                 @endif
                                             </td>
                                         </tr>
                                     @endif
                                     @if( !empty($order->approver_3)  && !empty($order->SalesApprover3))
                                         <tr>
                                             <td>Approver 03</td>
                                             <td>{{ $order->SalesApprover3->full_name }}
                                                 @if($order->status == 'pending' )
                                                     @if($order->approve_status > 2 )
                                                         <button type="button"  class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i></button>
                                                     @endif
                                                     @if($order->approve_status == 2 )
                                                         <button type="button" data-toggle="modal" data-target="#OrderApproved" class="btn btn-sm btn-primary pull-right">Approve</button>
                                                     @endif
                                                 @endif
                                             </td>
                                         </tr>
                                     @endif
                                     @if( !empty($order->approver_4)  && !empty($order->SalesApprover4))
                                         <tr>
                                             <td>Approver 04</td>
                                             <td>{{ $order->SalesApprover4->full_name }}
                                                 @if($order->status == 'pending' )
                                                     @if($order->approve_status > 3 )
                                                         <button type="button"  class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i></button>
                                                     @endif
                                                     @if($order->approve_status == 3 )
                                                         <button type="button" data-toggle="modal" data-target="#OrderApproved" class="btn btn-sm btn-primary pull-right">Approve</button>
                                                     @endif
                                                 @endif
                                             </td>
                                         </tr>
                                     @endif

                                     @if( !empty($order->description) )
                                     <tr>
                                         <td colspan="2">{{ $order->description }}</td>
                                     </tr>
                                     @endif
                                     <tr>
                                         @if($order->status == 'created' )
                                             <td  colspan="2">Current Status: <div class="label label-warning" style="margin-right: 15px; text-transform: capitalize;">{{ $order->status }}</div></td>
                                         @endif
                                         @if($order->status == 'success' )
                                             <td>Current Status: <div class="label label-success" style="margin-right: 15px; text-transform: capitalize;">{{ $order->status }}</div></td>
                                             <td><a href="{{ route('sales-order-items', $order->sales_order_id  ) }}"> Sales Order No. {{ $order->salesOrder->sales_order_no }} </a></td>
                                         @endif
                                     </tr>
                                     @if( $order->status == 'created' &&  $order->total_price  >0 )
                                         <tr>
                                             <td colspan="2" align="center">
                                                <button data-toggle="modal" data-target="#submitQuotation"  class="btn btn-info-light">Submit for Approval</button>
                                             </td>
                                         </tr>
                                     @endif
                                     @if( $order->status == 'submitted' &&  $order->total_price  >0 )
                                         <tr>
                                             <td colspan="2" align="center">
                                                <button  data-toggle="modal" data-target="#customerResponse"  class="btn btn-info-light"><i class="fa fa-plus"></i> Customer Response</button>
                                             </td>
                                         </tr>
                                     @endif
                                     @if( $order->status == 'approved' &&  $order->total_price  >0 )
                                         <tr>
                                             <td colspan="2" align="center">
                                                <button  data-toggle="modal" data-target="#createSalesOrder"  class="btn btn-info-light"><i class="fa fa-plus"></i> Create Sales Order</button>
                                             </td>
                                         </tr>
                                     @endif
                                 </table>
                                @if($order->status == 'created' )
                                    <a href="{{ route('sales-order-quotation-edit', $order->sales_quotation_id ) }}"  style="margin-left: 15px;" class="btn btn-sm btn-primary">Update Information</a>
                                @else
                                    <button type="button" data-toggle="modal" data-target="#MoreOrderInformation"  style="margin-left: 15px;" class="btn btn-sm btn-primary">More Information</button>
                                @endif
                                <button  style="margin-right: 15px;" class="btn btn-sm btn-success pull-right">Quotation No. {{ $order->sales_quotation_no  }}</button>
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
                    <div class="col-sm-8"><p class="form-control-static">{{ $order->sales_quotation_no }}</p></div>
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

<div class="modal fade table-view-popup" id="customerResponse" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document" style="text-align:left; width: 80%;">
        <div class="modal-content" style="border-radius: 0;">
            <div class="modal-header bg-warning" >
                <div class="col-sm-12">
                    <h3 class="model-list-striped-title text-white">Customer Confirmation</h3>
                    <button type="button" class="btn btn-sm btn-danger pull-right" style="margin-right:20px;" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6" style="text-align: center;">

                        {!! Form::open(['url' => route( 'sales-order-quotation-reject',  $order->sales_quotation_id ),  'class' => 'form-horizontal GlobalFormValidation ']) !!}
                        {!! Form::textarea('comment', null,
                        [
                            'class'=>'form-control border-radius-0 rejectComment',
                            'placeholder'=>'Write your comment...',
                            'data-fv-notempty' => true,
                            'data-fv-blank' => true,
                            'rows' => 3,
                            'data-rule-required' => true,
                            'data-fv-notempty-message' => 'Comment is required'

                        ]) !!}
                        {!! Form::hidden('client', true) !!}
                        <div class="row">
                            <div class="col-sm-10 col-lg-offset-1">
                                @include('layout.admin_layout_include.alert_process')
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger margin-top-15" >Customer Rejected this Quotation</button>
                        {!! Form::close() !!}
                    </div>

                    <div class="col-md-6"  style="text-align: center;">
                        {!! Form::open(['url' => route('sales-order-quotation-approve-customer',  $order->sales_quotation_id),  'class' => 'form-horizontal GlobalFormValidation ']) !!}
                        <div class="row">
                            <div class="col-sm-10 col-lg-offset-1">
                                @include('layout.admin_layout_include.alert_process')
                            </div>
                        </div>
                        <button class="btn btn-primary margin-top-15" type="submit">Customer Approved this Quotation</button>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade table-view-popup" id="OrderApproved" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document" style="text-align:left; width: 80%;">
        <div class="modal-content" style="border-radius: 0;">
            <div class="modal-header bg-warning" >
                <div class="col-sm-12">
                    <h3 class="model-list-striped-title text-white">Order Confirmation</h3>
                    <button type="button" class="btn btn-sm btn-danger pull-right" style="margin-right:20px;" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6" style="text-align: center;">
                        <div class="col-sm-10 col-lg-offset-1 text-center">
                            Are you Sure? you want to reject this Quotation. <br><strong>After reject Order <br> It will go beck to update mode and come back to you with necessary changes.</strong>
                        </div>
                        {!! Form::open(['url' => route( 'sales-order-quotation-reject',  $order->sales_quotation_id ),  'class' => 'form-horizontal GlobalFormValidation ']) !!}
                        {!! Form::textarea('comment', null, ['class'=>'form-control border-radius-0 rejectComment','placeholder'=>'Write your comment...',

                                                        'data-fv-notempty' => true,
                                                        'data-fv-blank' => true,
                                                        'rows' => 3,
                                                        'data-rule-required' => true,
                                                        'data-fv-notempty-message' => 'Comment is required'

                        ]) !!}
                        <div class="row">
                            <div class="col-sm-10 col-lg-offset-1">
                                @include('layout.admin_layout_include.alert_process')
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger margin-top-15" >No Rejected Order</button>
                        {!! Form::close() !!}
                    </div>

                    <div class="col-md-6"  style="text-align: center;">
                        <div class="col-sm-10 col-lg-offset-1 text-center">
                            Are you Sure? you want to approve this Quotation. <br><strong>After Approved Quotation, A automatic email will send to the customer.</strong>
                        </div>
                        {!! Form::open(['url' => route('sales-order-quotation-approve',  $order->sales_quotation_id),  'class' => 'form-horizontal GlobalFormValidation ']) !!}
                        {!! Form::hidden('approve_status', $order->approve_status +1 , []) !!}
                        <div class="row">
                            <div class="col-sm-10 col-lg-offset-1">
                                @include('layout.admin_layout_include.alert_process')
                            </div>
                        </div>
                        <button class="btn btn-primary margin-top-15" type="submit">Yes Approve Now</button>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endif

@if($order->status == 'approved')
    <div class="modal fade table-view-popup" id="createSalesOrder" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document" style="text-align:left;">
            <div class="modal-content" style="border-radius: 0;">
                <div class="modal-header bg-success" >
                    <div class="col-sm-12">
                        <h3 class="model-list-striped-title text-white"  >Create Sales Order</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class=" text-white">&times;</span>
                        </button>
                    </div>
                </div>
                {!! Form::open(['url' => route('sales-order-quotation-create-order', $order->sales_quotation_id),  'class' => 'form-horizontal GlobalFormValidation ModelDeleteFormValidation']) !!}
                <div class="modal-body">
                    <div class="row afterOnChangeOrderType">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <div class="col-xs-12 col-sm-12">
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
                                <div class="col-xs-12 col-sm-12">
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
                                <div class="col-xs-12 col-sm-12">
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
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-10 col-lg-offset-1">
                            @include('layout.admin_layout_include.alert_process')
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Create Sales Order</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                    {!! Form::close() !!}

            </div>
        </div>
    </div>
@endif
    <div class="modal fade table-view-popup" id="submitQuotation" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document" style="text-align:left;">
            <div class="modal-content" style="border-radius: 0;">
                <div class="modal-header bg-success" >
                    <div class="col-sm-12">
                        <h3 class="model-list-striped-title text-white">Submit Quotation</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class=" text-white">&times;</span>
                        </button>
                    </div>
                </div>
                {!! Form::open(['url' => route('sales-order-quotation-submit', $order->sales_quotation_id ),  'class' => 'form-horizontal GlobalFormValidation']) !!}
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-input-icon">
                                {!!Form::text('subject', (!empty($order)) ? $order->subject : null,
                                [
                                    'class' => 'form-control border-radius-0 no-resize',
                                    'placeholder'   => 'Subject',
                                    'maxlength' =>255,
                                    'data-fv-notempty' => true,
                                    'data-fv-blank' => true,
                                    'data-rule-required' => true,
                                    'data-fv-notempty-message' => 'Subject is required',
                                 ] )!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-input-icon">
                                {!!Form::textarea('message', (!empty($order)) ? $order->message : null, ['class'=>'form-control  border-radius-0 no-resize','placeholder'=>'Please enter Message..', 'rows'=>5,
                                    'data-fv-notempty' => true,
                                    'data-fv-blank' => true,
                                    'data-rule-required' => true,
                                    'data-fv-notempty-message' => 'Message is required',
                                 ] )!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-10 col-lg-offset-1 text-center">Are you Sure? you want to submit this Quotation.</div>
                    <div class="row">
                        <div class="col-sm-10 col-lg-offset-1">
                            @include('layout.admin_layout_include.alert_process')
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit Quotation</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


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