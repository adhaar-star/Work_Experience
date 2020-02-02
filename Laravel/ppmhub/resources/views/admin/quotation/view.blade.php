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
                <h4 style="text-align: center">Quotation</h4>
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse " id="example3" width="100%">
                            <tbody>
                                @foreach($quotation_data as $quotation)
                                <tr>
                                    <td>                              
                                        <div id="table-view_{{$quotation->id }}"  aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div >
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
                                                    <div>
                                                        
                                                   

                                                        <form class="static-form">
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">

                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Quotation Number</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->quotation_number }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Customer* </p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->customer }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Sales Region*</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->sales_region }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Purchase Order Number* </p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->purchase_order_number }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>   
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Purchase Order Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->purchase_order_date }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Requested delivery date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->req_delivery_date }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Weight</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->weight }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Unit</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->unit }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Valid From</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->valid_from }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>

                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Inquiry Number</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->inquiry}}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Total value</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->total_value }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Net Amount</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->net_amount }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Item</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->item }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>

                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Material Number</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->material_number }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Order Quantity</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->order_qty }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Quotation Text</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->quotation_short_description }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Customer Material Number</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->customer_material_number }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Cost Per Unit</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->cost_per_unit }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Total Amount</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->total_amount }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Purchase Order Item </p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->po_item }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Project Number</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->project_number }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Task</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->task }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Cost Center</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->cost_center }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Material Group</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->material_group }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Reason For Rejection</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->reason_for_rejection }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Requested by </p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->requested_by }}</p>
                                                                    </div>
                                                                </div>   
                                                            </div>

                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Valid To</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->valid_to }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Invoice number</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->invoice_number }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Created By</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">{{$quotation->created_by}}</p>
                                                                    </div>
                                                                </div>     
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Status</p>
                                                                    </div>

                                                                    <div class="col-sm-5">
                                                                        @if($quotation->status=='active')
                                                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                                                        @else
                                                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                                                        @endif    
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <span class="edit-btn">
                                                            <a href="{{url('admin/customer_inquiry/')}}" class="btn btn-danger">Back</a></span>
                                                        
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
