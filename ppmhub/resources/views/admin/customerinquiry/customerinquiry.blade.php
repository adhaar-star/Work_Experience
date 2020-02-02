@extends('layout.adminlayout')
@section('title','Customer Inquiry')

@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif


<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            You are here :   <a href="javascript: void(0);">Sales Order</a>
                        </li>
                        <li>
                            <span>Customer Inquiry Dashboard</span>
                        </li>
                    </ul>
                </div>

                <h4>Customer Inquiry</h4>

                <div class="dashboard-buttons">
                    <a href="{{url('admin/customer_inquiry/create')}}"  class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create Customer Inquiry
                    </a>
                    <a href="{{url('admin/customer_inquiry_exportcsv')}}" class="btn btn-primary margin-left-10">

                        Export to Excel
                    </a>

                    <a href="{{ route('pdfview',['download'=>'pdf']) }}" download=".pdf" class="btn btn-primary margin-left-10">

                        Print to PDF
                    </a>
                </div>
                <br/>
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Inquiry Number</th>
                                    <th>Inquiry Short Description</th>
                                    <th>Quotation</th>
                                    <th>Sales Order</th>
                                    <th>Invoice Number</th>
                                    <th>Created On</th>
                                    <th>Created by</th>
                                    <th>Requested by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Inquiry Number</th>
                                    <th>Inquiry Short Description</th>
                                    <th>Quotation</th>
                                    <th>Sales Order</th>
                                    <th>Invoice Number</th>
                                    <th>Created On</th>
                                    <th>Created by</th>
                                    <th>Requested by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($customer_inquiry as $customer)
                                <tr>
                                    <td><a data-toggle="modal" data-target="#table-view-popup_{{$customer->id}}">{{$customer->inquiry_number}}</a></td>
                                    <td>{{$customer->inquiry_description}}</td>
                                    <td><a href="{{url('admin/quotation/'.$customer->quotation)}}">{{$customer->quotation}}</a></td>
                                    <td><a href="{{url('admin/sales_order/'.$customer->sales_order)}}">{{$customer->sales_order}}</a></td>
                                    <td>{{$customer->invoice_number}}</td>
                                    <?php
                                    if ($customer->created_on == null) {
                                        ?>
                                        <td>{{$customer->created_on}}</td>  
                                        <?php
                                    } else {
                                        $createDate = new DateTime($customer->created_on);

                                        $created_date = $createDate->format('Y-m-d');
                                        ?>
                                        <td>{{$created_date}}</td>
                                        <?php
                                    }
                                    ?>   
                                    <td>{{$customer->created_by}}</td>
                                    <td>{{$customer->requested_by}}</td>
                                    <td>
                                        @if($customer->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                        @endif
                                    </td>
                                    <td class="">
                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$customer->id }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                        <a href="{{url('admin/customer_inquiry/'.$customer->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>
                                        {!! Form::open(array('route' => array('customer_inquiry.destroy',$customer->id), 'method' => 'DELETE','id'=>'delform'.$customer->id)) !!}
                                        <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this customer inquiry?');
                                                    if (res) {
                                            document.getElementById('delform{{$customer->id}}').submit()
                                                }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        {!! Form::close() !!}
                                        <div class="modal fade table-view-popup" id="table-view-popup_{{$customer->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <!--view--> 
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="javascript: void(0);">Sales Order</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('/admin/customer_inquiry')}}">Customer Inquiry</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript: void(0);">Display Customer Inquiry</a>
                                                                </li>
                                                                <li>
                                                                    <span>{{$customer->inquiry_number}}</span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                    <div class="modal-body">
                                                        <form class="static-form">

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Inquiry Number</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->inquiry_number}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Inquiry Type</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->inquiry_type}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Customer</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->customer}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Sales Region</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->sales_region}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Purchase order number</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->purchase_order_number}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Purchase Order Date</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <?php
                                                                    if ($customer->purchase_order_date == null) {
                                                                        ?>
                                                                        <p class="form-control-static">{{$customer->purchase_order_date}}</p>
                                                                        <?php
                                                                    } else {
                                                                        $p_date = new DateTime($customer->purchase_order_date);

                                                                        $purchaseorder_date = $p_date->format('Y-m-d');
                                                                        ?>
                                                                        <p class="form-control-static">{{$purchaseorder_date}}</p>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>

                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Requested delivery date</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <?php
                                                                    if ($customer->req_delivery_date == null) {
                                                                        ?>
                                                                        <p class="form-control-static">{{$customer->req_delivery_date}}</p>
                                                                        <?php
                                                                    } else {
                                                                        $r_date = new DateTime($customer->req_delivery_date);

                                                                        $rdelivery_date = $r_date->format('Y-m-d');
                                                                        ?>
                                                                        <p class="form-control-static">{{$rdelivery_date}}</p>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>

                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Weight</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->weight}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Unit</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->unit}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Valid From</p>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <?php
                                                                    if ($customer->valid_from == null) {
                                                                        ?>
                                                                        <p class="form-control-static">{{$customer->valid_from}}</p>
                                                                        <?php
                                                                    } else {
                                                                        $v_date = new DateTime($customer->valid_from);

                                                                        $valid_date = $v_date->format('Y-m-d');
                                                                        ?>
                                                                        <p class="form-control-static">{{$valid_date}}</p>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div> <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Valid To</p>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <?php
                                                                    if ($customer->valid_to == null) {
                                                                        ?>
                                                                        <p class="form-control-static">{{$customer->valid_to}}</p>
                                                                        <?php
                                                                    } else {
                                                                        $vto_date = new DateTime($customer->valid_to);

                                                                        $validto_date = $vto_date->format('Y-m-d');
                                                                        ?>
                                                                        <p class="form-control-static">{{$validto_date}}</p>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Invoice number</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->invoice_number}}</p>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Inquiry Text</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->inquiry_text}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Total value</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->total_value}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Net Amount</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->net_amount}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Item</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->item}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Material Number</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->material_number}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Order Quantity</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->order_qty}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->inquiry_description}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Customer Material Number</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->customer_material_number}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Per Unit</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->cost_per_unit}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Total Amount</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->total_amount}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Purchase Order Item</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->po_item}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->project_number}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Task</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->task}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Center</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->cost_center}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Material Group</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->material_group}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Reason For Rejection</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->reason_for_rejection}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Requested by</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->requested_by}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Quotation</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$customer->quotation}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    @if($customer->status=='active')
                                                                    <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                                                    @else
                                                                    <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                                                    @endif    
                                                                </div> 
                                                            </div>
                                                            <!--view-->
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{url('admin/customer_inquiry/'.$customer->id.'/edit')}}" class="btn btn-primary">Edit Customer Inquiry</a>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End  -->
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
