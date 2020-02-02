@extends('layout.adminlayout')
@section('title','Backlogs | Agile Methodology')
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
                            <a class="dropdown-item" href="{{url('admin/backlog')}}">Backlogs</a>
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
                            <a href="{{url('admin/backlog')}}">Agile</a>
                        </li>
                        <li>
                            <span>Backlog</span>
                        </li>
                    </ul>
                </div>
                <h4>Backlogs</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('backlog.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/backlog/create')}}" class="btn btn-primary">
                            @endif<i class="fa fa-send margin-right-5"></i>
                            Create Backlog
                        </a>
                </div>

                <br /> 
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>

                                    <th>Sprint No</th>                                      
                                    <th>Issue No</th>
                                    <th>Description</th>                                          
                                    <th>Component No</th>                                            

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sprint No</th>                                      
                                    <th>Issue No</th>
                                    <th>Description</th>                                          
                                    <th>Component No</th>                                            

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($backlogList->count() > 0)

                                @foreach($backlogList as $backlogList_list)

                                <tr>
                                    <td>@if($backlogList_list->sprint_no) {{$backlogList_list->sprint_no}} @else N/A @endif</td>
                                    <td>{{$backlogList_list->issue_no}}</td>
                                    <td>{{$backlogList_list['issue']->description}}</td>
                                    <td>{{$backlogList_list->component_no}}</td>
                                    <td>{{$backlogList_list->status}}
                                    </td>
                                    <td> 
                                        @if (RoleAuthHelper::hasAccess('backlog.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$backlogList_list->id}}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                            @if (RoleAuthHelper::hasAccess('backlog.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/backlog/edit').'/'.$backlogList_list->id}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>


                                                {{ Form::open(array('url' => url('admin/backlog/delete').'/'.$backlogList_list->id, 'method' => 'post','style'=>'display: none;' ,'id' => 'delform'.$backlogList_list->id)) }}


                                                <input  type="submit" >
                                                {{ Form::close() }}

                                                @if (RoleAuthHelper::hasAccess('backlog.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this backlog?');
                                                      if (res == true) {
                                              document.getElementById('delform{{$backlogList_list->id}}').submit()
                                                        }" class="btn btn-danger btn-xs margin-right-1">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>





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

