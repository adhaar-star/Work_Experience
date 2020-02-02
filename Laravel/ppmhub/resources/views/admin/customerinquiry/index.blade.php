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
                    @if (RoleAuthHelper::hasAccess('customer_inquiry.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/customer_inquiry/create')}}"  class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Customer Inquiry
                        </a>
                        @if (RoleAuthHelper::hasAccess('customer_inquiry.export.csv')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/customer_inquiry_exportcsv')}}" class="btn btn-primary margin-left-10">
                                @endif
                                Export to CSV file
                            </a>
                            @if (RoleAuthHelper::hasAccess('customer_inquiry.export.pdf')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{ route('customer_inquiry.export.pdf',['download'=>'pdf']) }}" class="btn btn-primary margin-left-10">
                                    @endif
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
                                                @foreach($customer_inquiry as $customer)
                                                <tr>
                                                    {!! Form::open(array('route' => array('customer_inquiry.delete',$customer->id), 'method' => 'DELETE','id'=>'delform'.$customer->id,'name'=>'delform'.$customer->id)) !!}
                                                    <td>
                                                        @if (RoleAuthHelper::hasAccess('customer_inquiry.view')!=true)  
                                                        {{$customer->inquiry_number}}
                                                        @else
                                                        <a data-toggle="modal" data-target="#table-view-popup_{{$customer->id}}">
                                                            {{$customer->inquiry_number}}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>{{isset($customer->inquiry_description) ? $customer->inquiry_description : ''}}</td>
                                                    <td>
                                                        @if (RoleAuthHelper::hasAccess('quotation.view')!=true)  
                                                        {{$customer->quotation}}
                                                        @else
                                                        <a href="{{url('admin/quotation/'.$customer->quotation)}}">
                                                            {{$customer->quotation}}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td><a href="{{url('admin/sales_order/'.$customer->sales_order)}}">{{$customer->sales_order}}</a></td>
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
                                                    <td>{{$customer->name}}</td>
                                                    <td>{{$customer->employee_first_name}}</td>
                                                    <td class="action-btn">
                                                        @if (RoleAuthHelper::hasAccess('customer_inquiry.view')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$customer->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                            @if (RoleAuthHelper::hasAccess('customer_inquiry.update')!=true)  
                                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                @else
                                                                <a href="{{url('admin/customer_inquiry/'.$customer->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                                @if (RoleAuthHelper::hasAccess('customer_inquiry.delete')!=true)  
                                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                    @else
                                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this customer inquiry?');
                                                                              if (res == true) {
                                                                      document.getElementById('delform{{$customer->id}}').submit()
                                                                                }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                                    <!--                                        {!! Form::close() !!}-->
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
                                                                                            <p class="form-control-static">Inquiry Description</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_description}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Gross price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_gross_price}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Discount</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_discount}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Discount Amount</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_discount_amt}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Discount Gross Price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_discount_gross_price}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Sales Tax Amount</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_sales_taxamt}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Net Price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_net_price}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Freight Charges</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_freight_charges}}</p>
                                                                                        </div>
                                                                                    </div> 

                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Total price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_total_price}}</p>
                                                                                        </div>
                                                                                    </div> 
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Customer</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->customer_id}}</p>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Customer Name</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->customer_name}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Sales Organization</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->sales_organization}}</p>
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
                                                                                            <p class="form-control-static">Inquiry Type</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->inquiry_type}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Requested by</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$customer->employee_first_name}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--                                                        <div class="form-group popup-brd-btm">
                                                                                                                                                <div class="col-sm-5">
                                                                                                                                                    <p class="form-control-static">Status</p>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-5">
                                                                                                                                                    <p class="form-control-static"> {{isset($customer_item[$loop->index]->processing_status) ? $customer_item[$loop->index]->processing_status : ''}}</p>
                                                                                                                                                </div>
                                                                                                                                            </div>-->
                                                                                    <!--view-->
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <span class="edit-btn" id="ab"><a href="{{url('admin/customer_inquiry/'.$customer->id.'/edit')}}" class="btn btn-primary">Edit Customer Inquiry</a></span>
                                                                                    <span class="model-footer-btn" id="back" style="display: none;"><a href="{{url('admin/quotation')}}"  class="btn btn-danger">Back</a></span>
                                                                                    <button type="button" id="ba" class="btn btn-danger set_close_btn" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End  -->
                                                                    </td>
                                                                    {!! Form::close() !!}
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
                                                                    <script>
                                                                              @isset($id)
                                                                              $(document).ready(function() {
                                                                      $('#table-view-popup_{{$id}}').modal('show');
                                                                              $('#back').show();
                                                                              $('#ab').hide();
                                                                              $('#ba').hide();
                                                                              //    $('#table-view-popup_{{$id}}').append('<a href="' + document.referrer + '"></a>');
                                                                      });
                                                                              @endisset
                                                                    </script>
                                                                    @endsection
