@extends('layout.adminlayout')
@section('title','Settings | Gl Account')
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
                            <span>Gl Account</span>
                        </li>
                    </ul>
                </div>
                <h4>Gl Account</h4>
                <div class="dashboard-buttons">
                    <a href="{{url('admin/GlAccount/create')}}" class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create Gl Account
                    </a>
                </div>
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Gl Account No.</th>
                                    <th>Gl Type.</th>
                                    <th>Gl Account Desc.</th>
                                    <th>Cost Element Type.</th>
                                    <th>Balance</th>
                                    <th>Year</th>
                                    <th>Period</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Gl Account No.</th>
                                    <th>Gl Type.</th>
                                    <th>Gl Account Desc.</th>
                                    <th>Cost Element Type.</th>
                                    <th>Balance</th>
                                    <th>Year</th>
                                    <th>Period</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($gl as $gl)
                                <tr>
                                    <td>{{$gl->gl_account_number}}</td>
                                    <td>{{$gl->type_flag}}</td>
                                    <td>{{$gl->gl_account_description}}</td>
                                    <td>{{$gl->cost_element_type}}</td>
                                    <td>{{$gl->balance}}</td>
                                    <td>{{$gl->year}}</td>
                                    <td>{{$gl->Period}}</td>
                                    <td>
                                        @if($gl->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        <!--button type="button" class="btn btn-success btn-xs">Active</button-->
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @endif
                                    </td>
                                    <td class="action-btn">
                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$gl->id }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                        <a href="{{url('admin/GlAccount/'.$gl->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i>  </a>
                                        {!! Form::open(array('route' => array('GlAccount.destroy',$gl->id), 'method' => 'DELETE','id'=>'delform'.$gl->id)) !!}
                                        <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this gl account');
                                                    if (res) {
                                            document.getElementById('delform{{$gl->id}}').submit()
                                                        }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        {!! Form::close() !!}

                                        <div class="modal fade table-view-popup" id="table-view-popup_{{$gl->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                    <a href="{{url('admin/GlAccount')}}">Add Gl Account</a>
                                                                </li>
                                                                <li>
                                                                    <a href="">Display Gl Account</a>
                                                                </li>
                                                                <li>
                                                                    <span>{{ $gl->gl_account_number }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Gl Account No</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $gl->gl_account_number}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Gl Account Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $gl->gl_account_description}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Element Type</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $gl->cost_element_type}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Debit</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $gl->debit}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Credit</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $gl->credit}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Balance</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $gl->balance}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Year</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $gl->year}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Period</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $gl->Period}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        @if($gl->status=='active')
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
                                                        <span class="edit-btn"><a href="{{url('admin/GlAccount/'.$gl->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
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
