@extends('layout.adminlayout')
@section('title','Sprint | Agile Methodology')
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
                            <span>Sprint Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Sprint</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('sprint.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/sprint/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Sprint
                        </a>
                </div>
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Sprint No</th>                                      
                                    <th>Weeks</th>
                                    <th>Project ID</th>
                                    <th>Sprint Start Date</th>
                                    <th>Sprint End Date</th>
                                    <th>Created on</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sprint No</th>                                      
                                    <th>Weeks</th>
                                    <th>Project ID</th>
                                    <th>Sprint Start Date</th>
                                    <th>Sprint End Date</th>
                                    <th>Created on</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($sprint->count() > 0)

                                @foreach($sprint as $sprintList)

                                <tr>
                                    <td>{{$sprintList->sprint_number}}</td>
                                    <td>{{$sprintList->sprint_period}}</td>
                                    <td>{{$sprintList->project_id}}</td>

                                    <td>{{$sprintList->start_date}}</td>
                                    <td>{{$sprintList->end_date}}</td>

                                    <td><?php
                                        $dcovert = strtotime($sprintList->created_on);
                                        echo $d_createdon_time = date('Y-m-d', $dcovert);
                                        ?>
                                    </td>
                                    <td>{{isset($sprintList['user']->name) ? $sprintList['user']->name : ''}}</td>
                                    <td>  {{$sprintList->status}}
                                    </td>
                                    <td> 
                                        @if (RoleAuthHelper::hasAccess('sprint.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$sprintList->id}}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                            @if (RoleAuthHelper::hasAccess('sprint.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/sprint/edit').'/'.$sprintList->id}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>


                                                {{ Form::open(array('url' => url('admin/sprint/delete').'/'.$sprintList->id, 'method' => 'post','style'=>'display: none;' ,'id' => 'delform'.$sprintList->id)) }}


                                                <input  type="submit" >
                                                {{ Form::close() }}

                                                @if (RoleAuthHelper::hasAccess('sprint.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this Sprint?');
                                                          if (res == true) {
                                                  document.getElementById('delform{{$sprintList->id}}').submit()
                                                            }" class="btn btn-danger btn-xs margin-right-1">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>




                                                    <div  class="modal fade table-view-popup in" id="table-view-popup_{{$sprintList->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
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
                                                                                <a href="javascript: void(0);">Sprint</a>
                                                                            </li>
                                                                            <li>
                                                                                <span>{{$sprintList->sprint_number}}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="static-form">
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$sprintList->project_id}}</p>
                                                                            </div>
                                                                        </div>





                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Sprint Number</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$sprintList->sprint_number}}</p>
                                                                            </div>
                                                                        </div> 


                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Sprint Period</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">@if( 4 >= $sprintList->sprint_period) {{$sprintList->sprint_period}} Week @else Custom @endif</p>
                                                                            </div>
                                                                        </div> 


                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$sprintList->project_id}}</p>
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
                                                                                <p class="form-control-static">{{isset($sprintList['user']->name) ? $sprintList['user']->name : ''}}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Sprint Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$sprintList->start_date}}</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Sprint End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$sprintList->end_date}}</p>
                                                                            </div>
                                                                        </div> 





                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Changed On</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$sprintList->changed_on}}</p>
                                                                            </div>
                                                                        </div> 


                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Changed By</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">@if(isset($sprintList['user_changed_by']->name)){{$sprintList['user_changed_by']->name}}@endif</p>
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Status</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">{{$sprintList->status}}</p>
                                                                            </div>
                                                                        </div> 
                                                                        <!--view-->
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <span class="edit-btn"><a href="{{url('admin/sprint/edit').'/'.$sprintList->id}}" class="btn btn-primary">Edit</a></span>
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

