@extends('layout.adminlayout')
@section('title','Vendor')

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
                            You are here :   <a href="javascript: void(0);">Procurement</a>
                        </li>
                        <li>
                            <span>Vendor Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Vendor Master</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('vendor.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/vendor/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Vendor
                        </a>
                        @if (RoleAuthHelper::hasAccess('vendor.export.csv')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/vendor_exportcsv')}}" class="btn btn-primary margin-left-10">
                                @endif
                                <i class="fa fa-send margin-right-5"></i>
                                Export Vendor List
                            </a>
                            @if (RoleAuthHelper::hasAccess('vendor.import.dashboard')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/vendor_importcsv')}}" class="btn btn-primary margin-left-10">
                                    @endif
                                    <i class="fa fa-send margin-right-5"></i>
                                    Import
                                </a>
                                </div>

                                <br />
                                <div class="col-md-12">
                                    <div class="margin-bottom-50">
                                        <table class="table table-inverse" id="example3" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Vendor Name</th>
                                                    <th>Vendor ID</th>
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
                                                    <th>Vendor Name</th>
                                                    <th>Vendor ID</th>
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
                                                @foreach($vendor_data as $vendor)
                                                <tr>
                                                    <td>
                                                        @if (RoleAuthHelper::hasAccess('vendor.view')!=true)  
                                                        {{$vendor->name }}                                                            @else
                                                        <a data-toggle="modal" data-target="#table-view-popup_{{$vendor->id }}">
                                                            {{$vendor->name }}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>{{$vendor->vendor_id}}</td>

                                                    <td>{{$vendor->city}}</td>
                                                    <td>{{$vendor->country_name}}</td>
                                                    <td>{{$vendor->contact_name}}</td>
                                                    <td>{{$vendor->contact_phone}}</td>
                                                    <td>{{$vendor->contact_email}}</td>

                                                    <td>
                                                        @if($vendor->status=='active')
                                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                                        @else
                                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                                        @endif
                                                    </td>
                                                    <td class="action-btn">
                                                        @if (RoleAuthHelper::hasAccess('vendor.view')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$vendor->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                            @if (RoleAuthHelper::hasAccess('vendor.update')!=true)  
                                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                @else
                                                                <a href="{{url('admin/vendor/'.$vendor->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                                {!! Form::open(array('route' => array('vendor.delete',$vendor->id), 'method' => 'DELETE','id'=>'delform'.$vendor->id)) !!}
                                                                @if (RoleAuthHelper::hasAccess('vendor.delete')!=true)  
                                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                    @else
                                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this vendor');
                                                                              if (res) {
                                                                      document.getElementById('delform{{$vendor->id}}').submit()
                                                                                }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                                    {!! Form::close() !!}
                                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$vendor->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                                                <a href="javascript: void(0);">Procurement</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="{{url('/admin/vendor')}}">Vendor</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="javascript: void(0);">Display Vendor</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span>{{$vendor->name}}</span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form class="static-form">

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Vendor Name</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->name}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Vendor Id</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->vendor_id }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Website Address</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->website_address}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Fax</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->fax}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Office Phone</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->office_phone}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Street</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->street}}</p>
                                                                                            </div> 
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">City</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->city}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Postal Code</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($vendor->postal_code == 1)
                                                                                                <p class="form-control-static">{{'3000'}}</p>
                                                                                                @elseif($vendor->postal_code == 2)
                                                                                                <p class="form-control-static">{{'4000'}}</p>
                                                                                                @elseif($vendor->postal_code == 3)
                                                                                                <p class="form-control-static">{{'6000'}}</p>
                                                                                                @elseif($vendor->postal_code == 4)
                                                                                                <p class="form-control-static">{{'7000'}}</p>
                                                                                                @endif

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Country</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @foreach($country_data as $key => $country_value)
                                                                                                @if($vendor->country == $key)
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

                                                                                                <p class="form-control-static">{{$vendor->state}}</p>

                                                                                            </div>
                                                                                        </div> <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Email Address</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->email}}</p>
                                                                                            </div>
                                                                                        </div> 
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Tax number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->tax_no}}</p>
                                                                                            </div>
                                                                                        </div> 
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">OneTime Vendor</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($vendor->onetime_vendor == 1)
                                                                                                <p class="form-control-static">{{'Yes'}}</p>
                                                                                                @else
                                                                                                <p class="form-control-static">{{'No'}}</p>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Approved Vendor</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($vendor->approved_vendor == 1)
                                                                                                <p class="form-control-static">{{'Yes'}}</p>
                                                                                                @else
                                                                                                <p class="form-control-static">{{'No'}}</p>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Category</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->category}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Payment Terms</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->payment_terms}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">ABN Number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->abn_no}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">ACN Number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->acn_no}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">E-Invoice</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($vendor->e_invoice == 1)
                                                                                                <p class="form-control-static">{{'Yes'}}</p>
                                                                                                @else
                                                                                                <p class="form-control-static">{{'No'}}</p>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Bank Name</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @foreach($bank_name as $key => $bank_value)
                                                                                                @if($vendor->bank_name == $key)
                                                                                                <p class="form-control-static">{{$bank_value}}</p>
                                                                                                @endif
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">BSB Number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->bsb}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Account Number</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->account_no}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">IFSC Code</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->ifsc_code}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Contact Name</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->contact_name}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Contact Role</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->contact_role}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Contact Email</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->contact_email}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Contact Phone</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$vendor->contact_phone}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Status</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                @if($vendor->status=='active')
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
                                                                                    <span class="edit-btn"><a href="{{url('admin/vendor/'.$vendor->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
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
