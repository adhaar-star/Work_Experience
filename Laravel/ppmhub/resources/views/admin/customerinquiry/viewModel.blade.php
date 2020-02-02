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

                        Export to CSV file
                    </a>

                    <a href="{{ route('pdfview',['download'=>'pdf']) }}" class="btn btn-primary margin-left-10">

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
                                    <th>Inquiry Description</th>
                                    <th>Quotation</th>
                                    <th>Sales Order</th>
                                    <th>Created On</th>
                                    <th>Created by</th>
                                    <th>Requested by</th>
                                    <!--<th>Status</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Inquiry Number</th>
                                    <th>Inquiry Short Description</th>
                                    <th>Quotation</th>
                                    <th>Sales Order</th>
                                    <th>Created On</th>
                                    <th>Created by</th>
                                    <th>Requested by</th>
                                    <!--<th>Status</th>-->
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td><a data-toggle="modal" data-target="#table-view-popup_{{$customer_inquiry->inquiry_number}}">{{$customer_inquiry->inquiry_number}}</a></td>
                                    <td>{{isset($customer_inquiry->inquiry_description) ? $customer_inquiry->inquiry_description : ''}}</td>
                                    <td><a href="{{url('admin/quotation/'.$customer_inquiry->quotation)}}">{{$customer_inquiry->quotation}}</a></td>
                                    <td><a href="{{url('admin/sales_order/'.$customer_inquiry->sales_order)}}">{{$customer_inquiry->sales_order}}</a></td>
                                    <?php
                                    if ($customer_inquiry->created_on == null) {
                                        ?>
                                        <td>{{$customer_inquiry->created_on}}</td>  
                                        <?php
                                    } else {
                                        $createDate = new DateTime($customer_inquiry->created_on);

                                        $created_date = $createDate->format('Y-m-d');
                                        ?>
                                        <td>{{$created_date}}</td>
                                        <?php
                                    }
                                    ?>   
                                    <td>{{$customer_inquiry->name}}</td>
                                    <td>{{$customer_inquiry->employee_first_name}}</td>

                                    <td class="action-btn">
                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$customer_inquiry->inquiry_number }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                        <a href="{{url('admin/customer_inquiry/'.$customer_inquiry->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>
                                        <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this customer inquiry?');
                                                    if (res == true) {
                                            document.getElementById('delform{{$customer_inquiry->id}}').submit()
                                                        }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        <div class="modal fade table-view-popup" id="table-view-popup_{{$customer_inquiry->inquiry_number }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                    <span>{{$customer_inquiry->inquiry_number}}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Inquiry Number</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_number}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Inquiry Description</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_description}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Gross price</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_gross_price}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Discount</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_discount}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Discount Amount</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_discount_amt}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Discount Gross Price</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_discount_gross_price}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Sales Tax Amount</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_sales_taxamt}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Net Price</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_net_price}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Freight Charges</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_freight_charges}}</p>
                                                            </div>
                                                        </div> 

                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Total price</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_total_price}}</p>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Customer</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->customer_id}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Customer Name</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->customer_name}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Sales Organization</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->sales_organization}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Sales Region</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->sales_region}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Inquiry Type</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->inquiry_type}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group popup-brd-btm">
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">Requested by</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <p class="form-control-static">{{$customer_inquiry->employee_first_name}}</p>
                                                            </div>
                                                        </div>
                                                        <!--view-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="edit-btn" id="ab"><a href="{{url('admin/customer_inquiry/'.$customer_inquiry->id.'/edit')}}" class="btn btn-primary">Edit Customer Inquiry</a></span>
                                                        <span class="model-footer-btn btn-back" id="back" style="display: none;"><a href="{{url('admin/quotation')}}"  class="btn btn-danger">Back</a></span>
                                                        <button type="button" id="ba" class="btn btn-danger set_close_btn" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End  -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
            @isset($id)
            $(document).ready(function() {
    $('#table-view-popup_{{$id}}').modal('show');
            $('#back').show();
            $('#ab').hide();
            $('#ba').hide();
            });
            @endisset
</script>
@endsection
