@extends('layout.adminlayout')
@section('title','Quotation')
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
                            <span>Quotation Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Quotation</h4>

                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('quotation.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/quotation/create')}}"  class="btn btn-primary margin-left-10">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Quotation
                        </a>
                        @if (RoleAuthHelper::hasAccess('quotation.create')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/refinquiry')}}"  class="btn btn-primary">
                                @endif
                                <i class="fa fa-send margin-right-5"></i>
                                Create Quotation with Ref
                            </a>

                            </div>
                            <br/>
                            <div class="col-md-12">
                                <div class="margin-bottom-50">
                                    <table class="table table-inverse" id="example3" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Quotation Number</th>
                                                <th>Quotation Description</th>
                                                <th>Inquiry</th>
                                                <th>Sales Order</th>
                                                <th>Created On</th>
                                                <th>Created by</th>
                                                <th>Requested by</th>
            <!--                                    <th>Status</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Quotation Number</th>
                                                <th>Quotation Description</th>
                                                <th>Inquiry</th>
                                                <th>Sales Order</th>
                                                <th>Created On</th>
                                                <th>Created by</th>
                                                <th>Requested by</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($quotation_data as $quotation)
                                            <tr>
                                                {!! Form::open(array('route' => array('quotation.delete',$quotation->id), 'method' => 'DELETE','id'=>'delform'.$quotation->id,'name'=>'delform'.$quotation->id)) !!}
                                                <td>
                                                    @if (RoleAuthHelper::hasAccess('quotation.view')!=true)  
                                                    {{$quotation->quotation_number}}
                                                    @else
                                                    <a data-toggle="modal" data-target="#table-view-popup_{{$quotation->id}}">
                                                        {{$quotation->quotation_number}}
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>{{isset($quotation->quotation_description) ? $quotation->quotation_description : ''}}</td>
                                                <td>
                                                    @if (RoleAuthHelper::hasAccess('customer_inquiry.view')!=true)  
                                                    {{$quotation->inquiry}}
                                                    @else
                                                    <a href="{{url('admin/customer_inquiry/'.$quotation->inquiry)}}">
                                                        {{$quotation->inquiry}}
                                                        @endif
                                                    </a>
                                                </td>
                                                <td><a href="{{url('admin/sales_order/'.$quotation->sales_order)}}">{{$quotation->sales_order}}</a></td>
                                                <?php
                                                if ($quotation->created_on == null) {
                                                  ?>
                                                  <td>{{$quotation->created_on}}</td>  
                                                  <?php
                                                } else {
                                                  $createDate = new DateTime($quotation->created_on);

                                                  $created_date = $createDate->format('Y-m-d');
                                                  ?>
                                                  <td>{{$created_date}}</td>
                                                  <?php
                                                }
                                                ?>   
                                                <td>{{$quotation->name}}</td>
                                                <td>{{$quotation->employee_first_name}}</td>
                                                <td class="action-btn">
                                                    @if (RoleAuthHelper::hasAccess('quotation.view')!=true)  
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                        @else
                                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$quotation->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                        @if (RoleAuthHelper::hasAccess('quotation.update')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="{{url('admin/quotation/'.$quotation->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                            @if (RoleAuthHelper::hasAccess('quotation.delete')!=true)  
                                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                @else
                                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this quotation?');
                                                                          if (res == true) {
                                                                  document.getElementById('delform{{$quotation->id}}').submit()
                                                                            }" class="btn btn-danger btn-xs margin-right-1">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                                @if (RoleAuthHelper::hasAccess('quotation.export.pdf')!=true)  
                                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                    @else
                                                                    <a href="{{url('admin/viewQuotation',$quotation->quotation_number)}}" class="btn btn-info btn-xs margin-top-3">@endif PDF/Email</a>

                                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$quotation->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                                                <a href="{{url('/admin/quotation')}}">Quotation</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="javascript: void(0);">Display Quotation</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span>{{$quotation->quotation_number}}</span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Quotation Number</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_number}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Quotation Description</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_description}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Gross price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_gross_price}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Profit Margin</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_profit_margin}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Profit Margin Amount</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_profit_amt}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Profit Margin Gross Price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_profit_margin_grossprice}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Discount</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_discount}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Discount Amount</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_discount_amt}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Discount Gross Price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_discount_gross_price}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Sales Tax Amount</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_sales_taxamt}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Net Price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_net_price}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Freight Charges</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_freight_charges}}</p>
                                                                                        </div>
                                                                                    </div> 

                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Total price</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_total_price}}</p>
                                                                                        </div>
                                                                                    </div> 
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Customer</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->customer_id}}</p>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Customer Name</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->customer_name}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Sales Organization</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->sales_organization}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Sales Region</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->sales_region}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Quotation Type</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->quotation_type}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Requested by</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$quotation->employee_first_name}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--                                                        <div class="form-group popup-brd-btm">
                                                                                                                                                <div class="col-sm-5">
                                                                                                                                                    <p class="form-control-static">Status</p>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-5">
                                                                                                                                                    <p class="form-control-static"> {{isset($quotation_item[$loop->index]->processing_status) ? $quotation_item[$loop->index]->processing_status : ''}}</p>
                                                                                                                                                </div>
                                                                                                                                            </div>-->
                                                                                    <!--view-->
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <span class="edit-btn" id="ab"><a href="{{url('admin/quotation/'.$quotation->id.'/edit')}}" class="btn btn-primary">Edit Quotation</a></span>
                                                                                    <span class="model-footer-btn" id="back" style="display: none;"><a href="{{url('admin/customer_inquiry')}}"  class="btn btn-danger">Back</a></span>
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
