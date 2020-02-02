@extends('layout.admin')
@section('title', 'Sales Order')
@section('PageCss')
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">

                 <div class="margin-bottom-20">
                     <a class="btn btn-primary" href="{{ route('sales-order-create') }}"><i class="fa fa-plus"></i> Create Sales Order</a>
                    <div class="box-header with-border pull-right">
                        <form class="form-inline" method="get">
                            <a style="margin: 0 15px 0 5px; "  href="{{ route('sales-order-index')  }}" class="btn btn-warning"><span class="fa fa-refresh"></span></a>
                            <div class="form-group">
                                <input  value="{{ isset( $_GET['start_date'] )  ? $_GET['start_date']: null }}" class="datepicker-only-init form-control" name="start_date" placeholder="From: Y-M-D">
                            </div>
                            <div class="form-group">
                                <input   value="{{isset( $_GET['end_date'] )  ? $_GET['end_date']: null}}" class="datepicker-only-init  form-control" name="end_date" placeholder="TO: Y-M-D">
                            </div>

                            <div class="form-group">
                                {!! Form::select('sales_order_status', [
                                'created' => 'Created',
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'success' => 'Success',
                                'billed' => 'Billed',
                                'all' => 'ALL Status'
                                ],  old('sales_order_status', isset( $_GET['sales_order_status'] )  ? $_GET['sales_order_status']: null), ['class' => 'form-control', 'placeholder'=>'All ']) !!}
                            </div>
                                |
                            <div class="form-group">
                                <input  value="{{ isset( $_GET['sales_order_no'] )  ? $_GET['sales_order_no']: null }}"  class="datepicker form-control" name="sales_order_no" placeholder="Order No.">
                            </div>

                            <button style="margin: 0 15px;" type="submit" class="btn btn-warning"> Search</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12" style="margin: 10px 0;" >
                            <div class="col-md-2 label label-warning  boxDesign "><h3>${{$gross_price}}</h3><h6>Gross Price</h6></div>
                            <div class="col-md-2 label label-info boxDesign" ><h3>${{$tax_amount}}</h3><h6>Tax</h6></div>
                            <div class="col-md-2 label label-primary boxDesign" ><h3>${{$profit_margin_amount}}</h3><h6>Profit Margin</h6></div>
                            <div class="col-md-2 label  background-info boxDesign" ><h3>${{$freight_charges}}</h3><h6>Freight Charges</h6></div>
                            <div class="col-md-2 label label-success boxDesign" ><h3>${{$discount_amount}}</h3><h6>Discount</h6></div>
                            <div class="col-md-2 label  background-danger boxDesign"><h3>${{$total_price}}</h3><h6>Total Amount</h6></div>
                        </div>
                    </div>
                    @if($orders->count())
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Date</th>
                                    <th>Order Type</th>
                                    <th>Gross Price</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->sales_order_no}}</td>
                                        <td>{{date("F j, Y ", strtotime($order->created_at))}}</td>
                                        <td style="text-transform: capitalize">{{$order->sales_order_type}}</td>
                                        <td>{{$order->gross_price}}</td>
                                        <td>{{$order->total_price}}</td>
                                        <td  style="text-transform: capitalize">{{$order->sales_order_status}}
                                            @if($order->auto_billing == 1 && $order->sales_order_status == 'approved' )
                                                <span style="display: block; font-size: 10px;">Auto Billing Date:  {{ Carbon\Carbon::parse($order->auto_billing_date)->format('d/m/y') }}</span>
                                            @endif
                                        </td>
                                        <td><a href="{{  route('sales-order-items', $order->sales_order_id) }}"><i class="fa fa-eye"></i> View </a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 pull-right">
                        {{ $orders->appends(
                        $_GET
                        )->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
@endsection