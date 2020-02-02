@extends('layout.adminlayout')
@section('title','Component | Agile Methodology')
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
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down"> Agile Methodology</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/projectissues')}}">Issue List</a>
                            <a class="dropdown-item" href="#">Backlogs</a>
                            <a class="dropdown-item" href="#">Kanban Board</a>
                            <a class="dropdown-item" href="{{url('admin/sprint')}}">Sprint</a>
                            <a class="dropdown-item" href="#">Components</a>
                            <a class="dropdown-item" href="{{url('admin/projectlabels')}}">Labels</a>
                            <a class="dropdown-item" href="#">Configuration</a>

                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/sprint')}}">Agile</a>
                        </li>
                        <li>
                            <span>Component Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Components</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('component.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/component/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Component
                        </a>
                </div>

                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Component No</th>                                      
                                    <th>Component Name</th>
                                    <th>Sprint No</th>
                                    <th>Project Id</th>                                             
                                    <th>Created on</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Component No</th>                                      
                                    <th>Component Name</th>
                                    <th>Sprint No</th>
                                    <th>Project Id</th>                                             
                                    <th>Created on</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($componentList->count() > 0)

                                @foreach($componentList as $component_list)
                                <tr>
                                    <td>{{$component_list->component_number}}</td>
                                    <td>{{$component_list->component_name}}</td>
                                    <td>{{$component_list->sprint_no}}</td>
                                    <td>{{$component_list->project_id}}</td>
                                    <td><?php
                                        $dcovert = strtotime($component_list->created_on);
                                        echo $d_createdon_time = date('Y-m-d', $dcovert);
                                        ?>
                                    </td>
                                    <td>{{isset($component_list['user']->name) ? $component_list['user']->name : ''}}</td>
                                    <td>  {{$component_list->status}}
                                    </td>
                                    <td> 
                                        @if (RoleAuthHelper::hasAccess('component.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$component_list->id}}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                            @if (RoleAuthHelper::hasAccess('component.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/component/edit').'/'.$component_list->id}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>


                                                {{ Form::open(array('url' => url('admin/component/delete').'/'.$component_list->id, 'method' => 'post','style'=>'display: none;' ,'id' => 'delform'.$component_list->id)) }}
                                                <input  type="submit" >
                                                {{ Form::close() }}


                                                @if (RoleAuthHelper::hasAccess('component.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this Component?');
                                                              if (res == true) {
                                                      document.getElementById('delform{{$component_list->id}}').submit()
                                                                }" class="btn btn-danger btn-xs margin-right-1">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                                    <div  class="modal fade table-view-popup in" id="table-view-popup_{{$component_list->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog" role="document" style="text-align:left;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <!--view--> 
                                                                    <div class="margin-bottom-10">
                                                                        <ul class="list-unstyled breadcrumb">
                                                                            <li>
                                                                                <a href="{{url('admin/sprint')}}">Agile Methodology</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript: void(0);">Component</a>
                                                                            </li>
                                                                            <li>
                                                                                <span>{{$component_list->sprint_no}}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="static-form">


                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Component Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$component_list->component_name}}</p>
                                                                            </div>
                                                                        </div> 



                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Component Number</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$component_list->component_number}}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$component_list->project_id}}</p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Sprint Number</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$component_list->sprint_no}}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Created on</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{ $d_createdon_time }}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Created By</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{isset($component_list['user']->name) ? $component_list['user']->name : ''}}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Changed On</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$component_list->changed_on}}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Changed By</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">@if(isset($component_list['user_changed_by']->name)){{$component_list['user_changed_by']->name}}@endif</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Status</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$component_list->status}}</p>
                                                                            </div>
                                                                        </div> 
                                                                        <!--view-->
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <span class="edit-btn"><a href="{{url('admin/sprint/edit').'/'.$component_list->id}}" class="btn btn-primary">Edit</a></span>
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                    </tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </section>
                                                    <!-- End  -->
                                                    @endsection

