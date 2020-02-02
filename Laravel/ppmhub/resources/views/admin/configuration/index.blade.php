@extends('layout.adminlayout')
@section('title','Configuration | Agile Methodology')
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
                            <a class="dropdown-item" href="{{url('admin/configuration')}}">Configuration</a>

                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/configuration')}}">Agile</a>
                        </li>
                        <li>
                            <span>Configuration</span>
                        </li>
                    </ul>
                </div>
                <h4>Configuration</h4>
                <br /> 

                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
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
                                @if(count($lists_convert) > 0)

                                @foreach($lists_convert as $configuration_list)

                                <tr>
                                    <td><?php print_r($configuration_list['name']); ?></td>
                                    <td><img src="<?php
                                        if (isset($configuration_list['status'])
                                          and $configuration_list['status'] == 'show'
                                        ) {
                                          echo asset('vendors/common/img/green.png');
                                        } else {
                                          echo asset('vendors/common/img/red.png');
                                        }
                                        ?>" 
                                             alt="">
                                    </td>
                                    <td> 
                                        @if (RoleAuthHelper::hasAccess('configuration.update')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="<?php echo url('admin/configuration/edit') . '/' . $configuration_list['id']; ?>" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>

                                            {{ Form::close() }}

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

