@extends('layout.admin')
@section('title', 'Billing')
@section('PageCss')
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section class="panel" style="max-width: 1280px; margin: 0 auto;">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-20 hidden-print">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>You are here : <a href="javascript: void(0);" style="margin-left: 10px;">Dashboard</a></li>
                        <li><a href="{{  route('billing-list') }}">Billing</a></li>
                        <li><span>Billing Invoice</span></li>
                    </ul>
                    <div class="headInvoice pull-right " >
                        <a  download="" target="_blank" class="btn btn-primary" href="{{ route('billing-single-view-pdf', $billing->billing_id) }}"><i class="fa fa-file-pdf-o" ></i></a>
                        <button class="btn btn-primary" onclick=" window.print() "><i class="fa fa-print" ></i></button>
                    </div>
                </div>
                <!-- Page Content -->
                <div class="content content-boxed">
                    <!-- Invoice -->
                    <div class="block">
                        <div class="block-content block-content-narrow">
                            <!-- Invoice Info -->
                            <div class="h2 text-center push-30-t push-30 ">Company Information</div>
                            <hr>
                            <div class="row items-push-2x">

                                @if(!empty($customer))
                                    <div class="col-xs-6 col-sm-6 col-lg-6">
                                        <p class="h2 font-w400 push-5">{{ $customer->name }}</p>
                                        <address>
                                            {{ $customer->street }}<br>
                                            {{ $customer->city }}, {{ $customer->postal_code }}<br>
                                            {{ $customer->state }} @if(!empty($customer->countryInfo)), {{ $customer->countryInfo->country_name }}@endif<br>
                                            <i class="si si-call-end"></i> {{ $customer->office_phone }}
                                        </address>
                                    </div>
                                @endif

                                <div class="col-xs-6 col-sm-6  col-lg-6 text-right">
                                    <p class="h6 font-w400 push-5">Invoice Date: {{ \Carbon\Carbon::parse($billing->created_at)->format('d/m/y') }}</p>
                                    <p class="h3 font-w400 push-5">Tax Invoice No. {{ $billing->billing_no }}</p>
                                    <p class="h6 font-w400 push-5">Due Payment Date: {{ \Carbon\Carbon::parse($billing->due_payment_date)->format('d/m/y') }}</p>
                                    <p class="h6 font-w400 push-5">Purchase Order No.: {{ $billing->sales_order_id }}</p>
                                </div>
                            </div>
                            <div class="table-responsive push-50">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 100px;">Item No.</th>
                                        <th>Description</th>
                                        @if($billing->billing_type =='goods')
                                            <th class="text-center" style="width: 100px;">Quantity</th>
                                            <th class="text-right" style="width: 100px;">Unit Price</th>
                                        @endif

                                        <th class="text-right" style="width: 100px;">Gross Price</th>
                                        <th class="text-right" style="width: 100px;">GST</th>
                                        @if($billing->billing_type =='goods')
                                            <th class="text-right" style="width: 100px;">Freight Charges</th>
                                        @endif
                                        <th class="text-right" style="width: 100px;">Discount</th>
                                        <th class="text-right" style="width: 100px;">Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($billing->billing_type =='goods' || $billing->billing_type =='service')
                                        @if($billingItems->count())
                                            @forelse($billingItems as $billingItem)
                                            <tr>
                                                <td class="text-center">{{$billingItem->sales_order_item_no}}</td>
                                                <td>
                                                    @if($billing->billing_type =='goods')

                                                        @if(!empty($billingItem->material)  &&  !empty($billingItem->salesMaterial))
                                                            <p class="font-w600 push-5">{{$billingItem->material_no}} - {{$billingItem->salesMaterial->name}}</p>
                                                            <div class="text-muted">{{$billingItem->salesMaterial->description}}</div>
                                                        @endif

                                                    @else

                                                        @if( !empty($billingItem->project_id)  &&  !empty($billingItem->salesProject) )
                                                            <p class="font-w600 push-5"> {{ $billingItem->salesProject->project_Id }} - {{ $billingItem->salesProject->project_name }}</p>
                                                            <div class="text-muted">{{ $billingItem->salesProject->project_desc }}</div>
                                                        @endif

                                                    @endif
                                                </td>

                                                @if($billing->billing_type =='goods')
                                                    <td class="text-center"><span class="badge badge-primary">
                                                            {{$billingItem->material_quantity}}
                                                        </span></td>
                                                    <td class="text-right">$<?php
                                                            $unit_price_profit =  $billingItem->profit_margin * $billingItem->unit_price /100;
                                                            echo  $billingItem->unit_price + $unit_price_profit;
                                                    ?></td>
                                                <td class="text-right">${{ $billingItem->gross_price +  $billingItem->profit_margin_amount  }}</td>
                                                @else
                                                <td class="text-right">${{ $billingItem->gross_price }}</td>
                                                @endif

                                                <td class="text-right">${{ $billingItem->tax_amount }}</td>
                                                @if($billing->billing_type == 'goods')
                                                    <td class="text-right">${{ $billingItem->freight_charges }}</td>
                                                @endif
                                                <td class="text-right">${{ $billingItem->discount_amount }}</td>
                                                <td class="text-right">${{ $billingItem->total_price }}</td>

                                            </tr>
                                            @endforeach
                                        @endif
                                    @endif

                                    @if( $billing->billing_type =='milestone' || $billing->billing_type =='timesheet' )
                                        @if($items->count())
                                            @forelse($items as $billingItem)
                                                <tr>
                                                    <td class="text-center">{{$billingItem->salesItem->sales_order_item_no}}</td>
                                                    <td><?php echo $billingItem->description;?></td>
                                                    <td class="text-right">${{ $billingItem->gross_price }}</td>
                                                    <td class="text-right">${{ $billingItem->tax_amount }}</td>
                                                    <td class="text-right">${{ $billingItem->discount_amount }}</td>
                                                    <td class="text-right">${{ $billingItem->total_price }}</td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif


                                    <tr class="text-white bg-info">
                                        <td colspan="{{ ($billing->billing_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Total Gross Amount</td>
                                        <td class="text-right">${{ $billing->gross_price }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="{{ ($billing->billing_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Total GST</td>
                                        <td class="text-right">${{ $billing->tax_amount }}</td>
                                    </tr>

                                     @if($billing->billing_type == 'goods')
                                        <tr>
                                            <td colspan="{{ ($billing->billing_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Freight Charges</td>
                                            <td class="text-right">${{ $billing->freight_charges }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td colspan="{{ ($billing->billing_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Discount</td>
                                        <td class="text-right">${{ $billing->discount_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="{{ ($billing->billing_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Down Payment</td>
                                        <td class="text-right">${{ $billing->down_payment }}</td>
                                    </tr>

                                    <tr class="text-white  background-danger">
                                        <td colspan="{{ ($billing->billing_type == 'goods') ? 8 : 5 }}" class="font-w700 font-w600 text-uppercase text-right">Total Amount Payable</td>
                                        <td class="font-w700 text-right "><strong>${{ $billing->total_payable }}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END Table -->

                            <!-- Footer -->
                            <hr class="">
                            <p class="text-muted text-center"><small>Thank you very much for doing business with us. We look forward to working with you again!</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
@endsection