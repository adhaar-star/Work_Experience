@extends('layout.adminlayout')
@section('title','Purchase Requisition')

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
                            <span>Purchase Requisition Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Purchase Requisition</h4>
                <div class="dashboard-buttons margin-bottom-10">
                    @if (RoleAuthHelper::hasAccess('purchase_requisition.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/purchase_requisition/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Purchase Requisition
                        </a>
                </div>
                <div class="col-md-12">
                    <div class="margin-bottom-50 display-block padding-top-10">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Requisition Number</th>
                                    <th>Short Description</th>
                                    <th>Created On</th>
                                    <th>Created By</th>
                                    <th>Requested By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Requisition Number</th>
                                    <th>Short Description</th>
                                    <th>Created On</th>
                                    <th>Created By</th>
                                    <th>Requested By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($purchase_requisition_data as $purchase_requisition)
                                <tr>
                                    <td>
                                        @if (RoleAuthHelper::hasAccess('purchase_requisition.view')!=true)  
                                        {{$purchase_requisition->requisition_number }}
                                        @else
                                        <a data-toggle="modal" data-target="#table-view-popup_{{$purchase_requisition->requisition_number }}">
                                            {{$purchase_requisition->requisition_number }}
                                            @endif
                                        </a>
                                    </td>
                                    @if(strlen($purchase_requisition->header_note)>24)
                                    <td>{{substr($purchase_requisition->header_note, 0, 24)}}...</td>
                                    @else
                                    <td>{{$purchase_requisition->header_note}}</td>
                                    @endif
                                    <td>{{$createdon}}</td> 
                                    <td>{{$createdby[$loop->index]}}</td>
                                    <td>{{$createdby[$loop->index]}}</td>
                                    <td>
                                        @if($purchase_requisition->approved_indicator=='approved')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        @elseif($purchase_requisition->approved_indicator=='rejected'||$purchase_requisition->approved_indicator=='') 
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @else 
                                        <img src="{{asset('vendors/common/img/yellow.png')}}" alt="">
                                        @endif

                                    </td>
                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('purchase_requisition.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$purchase_requisition->requisition_number}}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                            @if (RoleAuthHelper::hasAccess('purchase_requisition.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/purchase_requisition/'.$purchase_requisition->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                {!! Form::open(array('route' => array('purchase_requisition.delete',$purchase_requisition->id), 'method' => 'DELETE','id'=>'delform'.$purchase_requisition->id)) !!}
                                                @if (RoleAuthHelper::hasAccess('purchase_requisition.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this purchase requisition');
                                                              if (res == true)document.getElementById('delform{{$purchase_requisition->id}}').submit()
                                                                        }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                    {!! Form::close() !!}
                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$purchase_requisition->requisition_number}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                                <a href="{{url('/admin/purchase_requisition')}}">Purchase Requisition</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript: void(0);">Purchase Requisition ID</a>
                                                                            </li>
                                                                            <li>
                                                                                <span>{{$purchase_requisition->requisition_number}}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="static-form">

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Requisition Number</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$purchase_requisition->requisition_number}}</p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Header Note</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$purchase_requisition->header_note}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Phase ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{isset($purchase_item[$loop->index]->phase_id)?$purchase_item[$loop->index]->phase_id:""}}</p>
                                                                            </div> 
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Task ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{isset($purchase_item[$loop->index]->task_id)?$purchase_item[$loop->index]->task_id:""}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Created By</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$createdby[$loop->index]}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Changed By</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$changedby[$loop->index]}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Created On</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{isset($purchase_item[$loop->index]->created_on)?$purchase_item[$loop->index]->created_on:""}}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Processing Status</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{isset($purchase_item[$loop->index]->processing_status)?$purchase_item[$loop->index]->processing_status:""}}
                                                                                </p>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">G/L Account</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{isset($purchase_item[$loop->index]->g_l_account)?$purchase_item[$loop->index]->g_l_account:""}}
                                                                                </p>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Cost Center</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{isset($purchase_item[$loop->index]->cost_center)?$purchase_item[$loop->index]->cost_center:""}}
                                                                                </p>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Company Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{ $purchase_requisition->title}} {{ $purchase_requisition->name}}
                                                                                </p>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Address</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{isset($purchase_item[$loop->index]->add1)?$purchase_item[$loop->index]->add1:""}}
                                                                                </p>
                                                                                <p class="form-control-static">
                                                                                    {{isset($purchase_item[$loop->index]->add2)?$purchase_item[$loop->index]->add2:""}}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Postal Code</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{isset($purchase_item[$loop->index]->postal_code)?$purchase_item[$loop->index]->postal_code:""}}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Country</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{ $country[$loop->index]}}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Approver 1</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{ isset($approver[$loop->index][0])?$approver[$loop->index][0]:'' }}
                                                                                </p>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Approver 2</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{ isset($approver[$loop->index][1])?$approver[$loop->index][1]:'' }}
                                                                                </p>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Approver 3</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{ isset($approver[$loop->index][2])?$approver[$loop->index][2]:'' }}
                                                                                </p>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Approver 4</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    {{ isset($approver[$loop->index][3])?$approver[$loop->index][3]:'' }}
                                                                                </p>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Approved Indicator</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                @if($purchase_requisition->approved_indicator=='approved')
                                                                                <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                                                                @elseif($purchase_requisition->approved_indicator=='rejected'||$purchase_requisition->approved_indicator=='') 
                                                                                <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                                                                @else 
                                                                                <img src="{{asset('vendors/common/img/yellow.png')}}" alt="">
                                                                                @endif

                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <!--view-->
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class=" purchase-btn"><a href="{{url('admin/purchase_requisition/'.$purchase_requisition->id.'/edit')}}" class="btn btn-primary">Edit Purchase Requisition</a></span>
                                                                <span class=" purchase-btn"><a href="{{url('admin/purchase_requisition/'.$purchase_requisition->id.'/show')}}" class="btn btn-warning">Edit Approval Details</a></span>
                                                                <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
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