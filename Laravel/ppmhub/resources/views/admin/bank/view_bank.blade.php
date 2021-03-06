@extends('layout.adminlayout')
@section('title','Settings | BankName')
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
                @include('include.admin_sidebar')
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Settings</a>
                        </li>
                        <li>
                            <span>Bank Name</span>
                        </li>
                    </ul>
                </div>
                <h4>Bank Name</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('bank.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/addBank/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create BankName
                        </a>
                </div>
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse nowrap" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($bankname as $bank)
                                <tr>
                                    <td>{{$bank->bank_name}}</td>
                                    <td>
                                        @if($bank->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        <!--button type="button" class="btn btn-success btn-xs">Active</button-->
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @endif
                                    </td>
                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('bank.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$bank->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                            @if (RoleAuthHelper::hasAccess('bank.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/addBank/'.$bank->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i>  </a>
                                                {!! Form::open(array('route' => array('bank.delete',$bank->id), 'method' => 'DELETE','id'=>'delform'.$bank->id)) !!}
                                                @if (RoleAuthHelper::hasAccess('bank.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this bankname');
                                                              if (res) {
                                                      document.getElementById('delform{{$bank->id}}').submit()
                                                                }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                    {!! Form::close() !!}

                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$bank->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                        <div class="modal-dialog" role="document" style="text-align:left;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <div class="margin-bottom-10">
                                                                        <ul class="list-unstyled breadcrumb">
                                                                            <li>
                                                                                <a href="{{url('admin/dashboard')}}">Settings</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{url('admin/addBank')}}">Add BankName</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="">Display BankName</a>
                                                                            </li>
                                                                            <li>
                                                                                <span>{{ $bank->bank_name }}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="static-form">
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Bank Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{ $bank->bank_name }}</p>
                                                                            </div>
                                                                        </div>



                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Status</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">
                                                                                    @if($bank->status=='active')
                                                                                    <img src="{{asset('vendors/common/img/green.png')}}" alt="">

                                                                                    @else
                                                                                    <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <span class="edit-btn"> <a href="{{url('admin/addBank/'.$bank->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
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
