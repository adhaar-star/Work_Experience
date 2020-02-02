@extends('layout.adminlayout')
@section('title','Contract')

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
                            <span>Contracts Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Contract</h4>
                <div class="dashboard-buttons margin-bottom-10">
                    @if (RoleAuthHelper::hasAccess('contract.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/contract/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Contract
                        </a>
                        @if (RoleAuthHelper::hasAccess('contract.create')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/refpurchaseorder')}}" class="btn btn-primary">
                                @endif
                                <i class="fa fa-send margin-right-5"></i>
                                Create Contract With Reference
                            </a>
                            </div>
                            <div class="col-md-12">
                                <div class="margin-bottom-50 display-block padding-top-10">
                                    <table class="table table-inverse" id="example3" width="100%">
                                        <thead> 
                                            <tr>
                                                <th>Contract Number</th>
                                                <th>Description</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>

                                            <tr>
                                                <th>Contract Number</th>
                                                <th>Description</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($contract_data as $contract)
                                            <tr>
                                                <td>
                                                    @if (RoleAuthHelper::hasAccess('contract.view')!=true)  
                                                    {{$contract->agreement_number }}
                                                    @else
                                                    <a data-toggle="modal" data-target="#table-view-popup_{{$contract->id }}">
                                                        {{$contract->agreement_number }}
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>{{$contract->description}}</td>
                                                <td>{{$contract->created_on}}</td>
                                                <td>{{$createdby[$loop->index]}}</td>

                                                <td class="action-btn">
                                                    @if (RoleAuthHelper::hasAccess('contract.view')!=true)  
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                        @else
                                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$contract->id}}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                        @if (RoleAuthHelper::hasAccess('contract.update')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="{{url('admin/contract/'.$contract->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                            {!! Form::open(array('route' => array('contract.delete',$contract->id), 'method' => 'DELETE','id'=>'delform'.$contract->id)) !!}
                                                            @if (RoleAuthHelper::hasAccess('contract.delete')!=true)  
                                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                @else
                                                                <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this contract');
                                                                          if (res == true)document.getElementById('delform{{$contract->id}}').submit()
                                                                                    }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                                {!! Form::close() !!}
                                                                <div class="modal fade table-view-popup" id="table-view-popup_{{$contract->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                                            <a href="{{url('/admin/contract')}}">Contract</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a href="javascript: void(0);">Contract Number</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span>{{$contract->agreement_number}}</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>

                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form class="static-form">

                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Agreement Number</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$contract->agreement_number}}</p>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group popup-brd-btm">
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">Header Note</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$contract->description}}</p>
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
                                                                                            <p class="form-control-static">Created On</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <p class="form-control-static">{{$contract->created_on}}</p>
                                                                                        </div>
                                                                                    </div> 


                                                                                </form>
                                                                            </div>
                                                                            <!--view-->
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="edit-btn"><a href="{{url('admin/contract/'.$contract->id.'/edit')}}" class="btn btn-primary">Edit </a></span>
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