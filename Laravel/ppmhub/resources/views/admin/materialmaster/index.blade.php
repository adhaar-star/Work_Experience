@extends('layout.adminlayout')
@section('title','materialmaster')

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
                            <span>Material Master Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Material Master</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('material_master.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/material_master/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Material Master
                        </a>
                </div>


                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>

                                    <th>Material ID</th>
                                    <th>Material Name</th>                                
                                    <th>Material Category</th>
                                    <th>Material group</th>
                                    <th>Unit of measure</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Material ID</th>
                                    <th>Material Name</th>                                
                                    <th>Material Category</th>
                                    <th>Material group</th>
                                    <th>Unit of measure</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($material_master as $material)
                                <tr>
                                    <td>
                                        @if (RoleAuthHelper::hasAccess('material_master.view')!=true)  
                                        {{$material->material_number}}
                                        @else
                                        <a data-toggle="modal" data-target="#table-view-popup_{{$material->material_number }}">
                                            {{$material->material_number}}
                                            @endif
                                        </a>
                                    </td>
                                    <td>{{$material->material_name}}</td>
                                    <td>{{$material->material_category}}</td>
                                    <td>{{$material->material_group}}</td>
                                    <td>{{$material->unit_of_measure}}</td>
                                    <td>{{$material->name}}</td>

                                    <td>
                                        @if($material->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @endif
                                    </td>
                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('material_master.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$material->material_number }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                            @if (RoleAuthHelper::hasAccess('material_master.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/material_master/'.$material->material_number.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                {!! Form::open(array('route' => array('material_master.delete',$material->material_number), 'method' => 'DELETE','id'=>'delform'.$material->material_number)) !!}
                                                @if (RoleAuthHelper::hasAccess('material_master.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this material master');
                                                              if (res) {
                                                      document.getElementById('delform{{$material->material_number}}').submit()
                                                                }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                    {!! Form::close() !!}
                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$material->material_number }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                                <a href="{{url('/admin/material_master')}}">Material Master</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript: void(0);">Display MaterialMaster</a>
                                                                            </li>
                                                                            <li>
                                                                                <span>{{$material->material_name}}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="static-form">

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Material Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->material_name}}</p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Material Description</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->material_description}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Material Category</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->material_category}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Material Group</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->material_group}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Supplier Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->name}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Unit Of Measure</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->unit_of_measure}}</p>
                                                                            </div> 
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Ordering unit</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->ordering_unit}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Standard Price</p>
                                                                            </div>
                                                                            <div class="col-sm-5">

                                                                                <p class="form-control-static">{{$material->standard_price}}</p>


                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Stock Item</p>
                                                                            </div>
                                                                            <div class="col-sm-5">

                                                                                <p class="form-control-static">{{$material->stock_item}}</p>

                                                                            </div>
                                                                        </div> <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">EAN_UPC_number</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->EAN_UPC_number}}</p>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Tax Classification</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->tax_classification}}</p>
                                                                            </div>
                                                                        </div> 



                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Expiry Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->expiry_date}}</p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Min Stock</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->min_stock}}</p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Reorder Quantity</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->reorder_quantity}}</p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Gross Weight</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->gross_weight}}</p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Nett Weight</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$material->nett_weight}}</p>
                                                                            </div>
                                                                        </div>



                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Status</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                @if($material->status=='active')
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
                                                                    <span class="edit-btn"><a href="{{url('admin/material_master/'.$material->material_number.'/edit')}}" class="btn btn-primary">Edit</a></span>
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