@extends('layout.adminlayout')
@section('title','Customer Master')

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
                            <span>Customer Dashboard</span>
                        </li>
                    </ul>
                </div>

                <h4>Customer Master</h4>

                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('customer_master.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/customer_master/create')}}"  class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Customer
                        </a>
                        @if (RoleAuthHelper::hasAccess('customer_master.export.csv')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/customer_master_exportcsv')}}" class="btn btn-primary margin-left-10">
                                @endif
                                <i class="fa fa-send margin-right-5"></i>
                                Export Customer List
                            </a>
                            @if (RoleAuthHelper::hasAccess('customer_master.import')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/customer_master_importcsv')}}" class="btn btn-primary margin-left-10">
                                    @endif
                                    <i class="fa fa-send margin-right-5"></i>
                                    Import 
                                </a>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="margin-bottom-50">
                                        <table class="table table-inverse" id="example3" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Customer ID</th>
                                                    <th>Customer Name</th>
                                                    <th>City</th>
                                                    <th>Country</th>
                                                    <th>Contact Name</th>
                                                    <th>Contact Phone</th>
                                                    <th>Contact Email</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>

                                                <tr>
                                                    <th>Customer ID</th>
                                                    <th>Customer Name</th>
                                                    <th>City</th>
                                                    <th>Country</th>
                                                    <th>Contact Name</th>
                                                    <th>Contact Phone</th>
                                                    <th>Contact Email</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($customer_master as $customer)
                                                <tr>
                                                    <td>
                                                        @if (RoleAuthHelper::hasAccess('customer_master.view')!=true)  
                                                        {{$customer->customer_id}}
                                                        @else
                                                        <a data-toggle="modal" data-target="#table-view-popup_{{$customer->id}}">
                                                            {{$customer->customer_id}}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>{{$customer->name}}</td>
                                                    <td>{{$customer->city}}</td>
                                                    <td>{{$customer->country_name}}</td>
                                                    <td>{{$customer->contact_name}}</td>
                                                    <td>{{$customer->office_phone}}</td>
                                                    <td>{{$customer->email}}</td>

                                                    <td>
                                                        @if($customer->status=='active')
                                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                                        @else
                                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                                        @endif
                                                    </td>
                                                    <td class="action-btn">
                                                        @if (RoleAuthHelper::hasAccess('customer_master.view')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$customer->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                            @if (RoleAuthHelper::hasAccess('customer_master.update')!=true)  
                                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                @else
                                                                <a href="{{url('admin/customer_master/'.$customer->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                                {!! Form::open(array('route' => array('customer_master.delete',$customer->id), 'method' => 'DELETE','id'=>'delform'.$customer->id)) !!}
                                                                @if (RoleAuthHelper::hasAccess('customer_master.delete')!=true)  
                                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                    @else
                                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this customer ?');
                                                                              if (res) {
                                                                      document.getElementById('delform{{$customer->id}}').submit()
                                                                                }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
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
                                                                                                <a href="{{url('/admin/customer_master')}}">Customer Master</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="javascript: void(0);">Display Customer Master</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>

                                                                                </div>

                                                                                <div class="modal-body">
                                                                                    <form class="static-form">

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Customer Name</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->name}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Customer Id</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->customer_id }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Website Address</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->website_address}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Fax</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->fax}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Office Phone</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->office_phone}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Street</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->street}}</p>
                                                                                            </div> 
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">City</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->city}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Postal Code</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($customer->postal_code == '3000')
                                                                                                <p class="form-control-static">{{'3000'}}</p>
                                                                                                @elseif($customer->postal_code == '4000' )
                                                                                                <p class="form-control-static">{{'4000'}}</p>
                                                                                                @elseif($customer->postal_code == '5000')
                                                                                                <p class="form-control-static">{{'5000'}}</p>
                                                                                                @elseif($customer->postal_code == '6000')
                                                                                                <p class="form-control-static">{{'6000'}}</p>
                                                                                                @endif

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Country</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @foreach($country_data as $key => $country_value)
                                                                                                @if($customer->country == $key)
                                                                                                <p class="form-control-static">{{$country_value}}</p>
                                                                                                @endif
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">State</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">

                                                                                                <p class="form-control-static">{{$customer->state}}</p>

                                                                                            </div>
                                                                                        </div> <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Email Address</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->email}}</p>
                                                                                            </div>
                                                                                        </div> 
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Tax number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->tax_no}}</p>
                                                                                            </div>
                                                                                        </div> 
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">OneTime Customer</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($customer->onetime_customer == 'yes')
                                                                                                <p class="form-control-static">{{'yes'}}</p>
                                                                                                @else
                                                                                                <p class="form-control-static">{{'no'}}</p>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Approved Customer</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($customer->approved_customer == 'yes')
                                                                                                <p class="form-control-static">{{'yes'}}</p>
                                                                                                @else
                                                                                                <p class="form-control-static">{{'no'}}</p>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Category</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->category}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Payment Terms</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->payment_terms}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">ABN Number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->abn_no}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">ACN Number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->acn_no}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">E-Invoice</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($customer->e_invoice == 'yes')
                                                                                                <p class="form-control-static">{{'yes'}}</p>
                                                                                                @else
                                                                                                <p class="form-control-static">{{'no'}}</p>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Bank Name</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->bank_name}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">BSB Number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->bsb}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Account Number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->account_no}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">IFSC Code</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->ifsc_code}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Contact Name</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->contact_name}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Contact Role</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->contact_role}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Contact Email</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->contact_email}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Contact Phone</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$customer->contact_phone}}</p>
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
                                                                                    <span class="edit-btn"><a href="{{url('admin/customer_master/'.$customer->id.'/edit')}}" class="btn btn-primary">Edit Customer</a></span>
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
