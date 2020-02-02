@extends('layout.adminlayout')
@section('title','servicemaster')

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
                            <span>ServiceMaster Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Service Master</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('service_master.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/service_master/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Service Master
                        </a>
                </div>


                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>

                                    <th>Service ID</th>
                                    <th>Service Name</th>                                
                                    <th>Service Category</th>
                                    <th>Service group</th>
                                    <th>Unit of measure</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Service ID</th>
                                    <th>Service Name</th>                                
                                    <th>Service Category</th>
                                    <th>Service group</th>
                                    <th>Unit of measure</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($service_master as $service)
                                <tr>
                                    <td> @if (RoleAuthHelper::hasAccess('service_master.view')!=true)  
                                        {{$service->service_id}}
                                        @else
                                        <a data-toggle="modal" data-target="#table-view-popup_{{$service->service_id}}">
                                            {{$service->service_id}}
                                            @endif
                                        </a>
                                    </td>

                                    <td>{{$service->service_name}}</td>
                                    <td>{{$service->service_category}}</td>
                                    <td>{{$service->service_group}}</td>
                                    <td>{{$service->unit_of_measure}}</td>
                                    <td>{{$service->name}}</td>

                                    <td>
                                        @if($service->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @endif
                                    </td>
                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('service_master.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$service->service_id}}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                            @if (RoleAuthHelper::hasAccess('service_master.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/service_master/'.$service->service_id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                {!! Form::open(array('route' => array('service_master.delete',$service->service_id), 'method' => 'DELETE','id'=>'delform'.$service->service_id)) !!}
                                                @if (RoleAuthHelper::hasAccess('service_master.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this service master');
                                                              if (res) {
                                                      document.getElementById('delform{{$service->service_id}}').submit()
                                                                }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                    {!! Form::close() !!}
                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$service->service_id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                                <a href="{{url('/admin/service_master')}}">Material Master</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript: void(0);">Display ServiceMaster</a>
                                                                            </li>
                                                                            <li>
                                                                                <span>{{$service->service_name}}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="static-form">

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Service Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->service_name}}</p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Service Description</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static" style="white-space:normal;">{{$service->service_description}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Service Category</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->service_category}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Service Group</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->service_group}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Supplier Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->name}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Unit Of Measure</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->unit_of_measure}}</p>
                                                                            </div> 
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Ordering unit</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->ordering_unit}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Standard Price</p>
                                                                            </div>
                                                                            <div class="col-sm-5">

                                                                                <p class="form-control-static">{{$service->standard_rate}}</p>


                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Contractor Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">

                                                                                <p class="form-control-static">{{$service->contractor_name}}</p>

                                                                            </div>
                                                                        </div> <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Tax Classification</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->tax_classification}}</p>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Validity Start</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->validity_start}}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Validity End</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->validity_end}}</p>
                                                                            </div>
                                                                        </div>



                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Currency</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$service->currency}}</p>
                                                                            </div>
                                                                        </div>



                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Status</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                @if($service->status=='active')
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
                                                                    <span class="edit-btn"><a href="{{url('admin/service_master/'.$service->service_id.'/edit')}}" class="btn btn-primary">Edit</a></span>
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