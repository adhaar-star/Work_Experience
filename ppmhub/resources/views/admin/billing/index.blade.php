@extends('layout.admin')
@section('title', 'Billing')
@section('PageCss')
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">

                 <div class="margin-bottom-20">
                     <a class="btn btn-primary" href="{{ route('billing-create') }}"><i class="fa fa-plus"></i> Create Billing</a>

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
                                {!! Form::select('billing_status', [
                                'service' => 'Service',
                                'goods' => 'Goods',
                                'all' => 'ALL Status'
                                ],  old('billing_status', isset( $_GET['billing_type'] )  ? $_GET['billing_type']: null), ['class' => 'form-control', 'placeholder'=>'All ']) !!}
                            </div>
                                |
                            <div class="form-group">
                                <input  value="{{ isset( $_GET['billing_no'] )  ? $_GET['billing_no'] : null }}"  class="datepicker form-control" name="billing_no" placeholder="Billing No.">
                            </div>

                            <button style="margin: 0 15px;" type="submit" class="btn btn-warning"> Search</button>
                        </form>


                    </div>
                </div>
                <hr>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12" style="margin: 10px 0;" >
                            <div class="col-md-2 label label-info  boxDesign "><h3>${{$gross_price}}</h3><h6>Gross Price</h6></div>
                            <div class="col-md-2 label  background-info boxDesign" ><h3>${{$freight_charges}}</h3><h6>Freight Charges</h6></div>
                            <div class="col-md-2 label label-success boxDesign" ><h3>${{$discount_amount}}</h3><h6>Discount</h6></div>
                            <div class="col-md-3 label label-warning boxDesign" ><h3>${{$tax_amount}}</h3><h6>Tax</h6></div>
                            <div class="col-md-3 label  background-danger boxDesign"><h3>${{$total_price}}</h3><h6>Total Amount</h6></div>
                        </div>
                    </div>
                    @if($billings->count())
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Billing No.</th>
                            <th>Date</th>
                            <th>Billing Type</th>
                            <th>Gross Price</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($billings as $billing)
                                <tr>
                                    <td>{{$billing->billing_no}}</td>
                                    <td>{{date("F j, Y ", strtotime($billing->created_at))}}</td>
                                    <td style="text-transform: capitalize">{{$billing->billing_type}}</td>
                                    <td>{{$billing->gross_price}}</td>
                                    <td>{{$billing->total_payable}}</td>
                                    <td><a href="{{  route('billing-single-view', $billing->billing_id) }}"><i class="fa fa-eye"></i> View </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 pull-right">
                        {{ $billings->appends(
                        $_GET
                        )->links() }}
                    </div>
                </div><!-- /.box-footer-->

            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
@endsection