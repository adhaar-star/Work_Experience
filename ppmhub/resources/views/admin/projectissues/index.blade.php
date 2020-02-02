@extends('layout.adminlayout')
@section('title','Agile Methodology | Issue List')
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
                            <span class="hidden-lg-down">Project Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/project')}}">Project</a>
                            <a class="dropdown-item" href="{{url('admin/projectphase')}}">Phase</a>
                            <a class="dropdown-item" href="{{url('admin/projecttask')}}">Task/Subtask</a>
                            <a class="dropdown-item" href="{{url('admin/projectchecklist')}}">Checklist</a>
                            <a class="dropdown-item" href="{{url('admin/projectissues')}}">Issue List</a>
                            <a class="dropdown-item" href="javascript:void(0)">Milestone</a>
                            <a class="dropdown-item" href="javascript:void(0)">Project Cost Plan</a>
                            <a class="dropdown-item" href="javascript:void(0)">Project Resource Plan</a>
                        </ul>
                    </div> 
                </div>
                <div class="breadcrumb margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                        </li>
                        <li>
                            <span>Project Issue List Dashboard</span>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-header card-header-box">
                        <h4 class="margin-0">Issue List</h4>
                    </div>

                    <br />

                    <div class="container">
                        <div class="row card">
                            <div class="col-md-8">
                                <!-- Nav tabs-->
                                <div class="tabs_main">
                                    <ul class="nav nav-tabs" role="tablist">


                                        <li class="
                                            @if(isset($_GET['list']) and $_GET['list']=='inprogress')
                                            active                            
                                            @endif 

                                            "><a href="{{url('admin/projectissues?list=inprogress')}}" >In progress <span> {{$status['inprogress']}} </span></a>
                                        </li>
                                        <li class="@if(isset($_GET['list']) and $_GET['list']=='complete') active @endif"><a href="{{url('admin/projectissues?list=complete')}}" >Complete<span>  {{$status['complete']}} </span></a>
                                        </li>
                                        <li class="@if(isset($_GET['list']) and $_GET['list']=='closed') active @endif"><a href="{{url('admin/projectissues?list=closed')}}" >Closed<span>  {{$status['closed']}} </span></a>
                                        </li>

                                        <li class="@if(isset($_GET['list']) and $_GET['list']=='all') active @endif"><a href=" {{url('admin/projectissues?list=all')}}" >All<span>  {{$status['all']}} </span></a>
                                        </li>

                                    </ul>
                                    <!-- Tab panes -->

                                </div>

                            </div><!--end---col-md-12--->


                            <div class="col-md-4 text-right">
                                <!-- Nav tabs-->
                                <div class="top_right_sub_down_btn">
                                    <ul>

                                        <li>
                                            
                                            <button type="button" class="btn btn-default btn-sm"><span class="fa fa-rss" aria-hidden="true"></span> </button>

                                        </li>

                                        <li> 

                                            <button type="button" class="btn btn-default btn-sm"><span class="fa fa-download" aria-hidden="true"></span> </button>

                                        </li> 

                                        <li>
                                            @if (RoleAuthHelper::hasAccess('project.issues.create')!=true)  
                                                <button onclick="javascript:void(0)" type="button" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;"> New Issue</button>

                                                @else  
                                                <button onclick="window.location.href ='{{url('admin/addIssue')}}';" type="button" class="btn btn-primary btn-sm"> New Issue</button>
                                                @endif 
                                        </li>

                                    </ul>
                                    <!-- Tab panes -->

                                </div>

                            </div><!--end---col-md-12---> 
                        </div>
                        <!---start---search---with---filter------->
                        <div class="container">
                            <div class="row top_margin serach_filter_top_main">
                                <ul>
                                    <li>
                                        <input id="checkbox1" type="checkbox">
                                        </span></li>
                                    <li style="width:940px;">
                                        <div class="col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-btn search-panel">
                                                    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown"> <span id="search_concept"><i class="fa fa-refresh" aria-hidden="true"></i> </span> <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu setBoxWidth__Recent" role="menu">
                                                        <h5 class="text-center">Recent Search</h5>
                                                        <li class="paddingSet__History"><a href="#contains">Contains</a></li>

                                                        <li class="divider"></li>
                                                        <li class="text-center"><a href="#all">Clear recent searches</a></li>
                                                    </ul>
                                                </div>

                                                <form action="{{url('admin/issueSearch')}}" method="post" id="targetSearch">



                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="list" value="@if(isset($_GET['list']) and !empty($_GET['list'])) {{$_GET['list']}} @endif">

                                                    <i class="fa fa-filter setratio" aria-hidden="true"></i> <input autocomplete="off"  data-toggle="dropdown" aria-expanded="false" type="text" class="dropdown-toggle dropdown-inline-button form-control searchbarset" name="filter"  placeholder="Search issue...">

                                                    <div class="filterlayer"></div>

                                                    <ul class="dropdown-menu FilterSearch" aria-labelledby="" role="menu">
                                                        <li id="searchpress"><i class="fa fa-search" aria-hidden="true"></i> Press Enter or Click to Search</li>
                                                        <li id="OpenPhaseIdSet_Filter"> <i class="fa fa-pencil"></i> author <@author></li>
                                                        <li id="assigneeSE"><i class="fa fa-user"></i> assignee <@assignee></li>
                                                        <li id="ProjectIdSe"><i class="fa fa-clock-o"></i> Project ID <%projectID%></li>
                                                        <li id="prioritySe"><i class="fa fa-tag"></i> Priority</li>
                                                    </ul>

                                                    <div id="PhaseIdSet_Filter" style="display: none;">
                                                        <select class="selectpicker col-sm-6" id="authorSelectFilter" name="author"  data-live-search="true">

                                                            @if($authorList->count() > 0)
                                                            @foreach($authorList as $userList)
                                                            <option value="{{$userList['id']}}">{{$userList['name']}}</option>
                                                            @endforeach

                                                            @endif

                                                        </select>
                                                    </div>


                                                    <div id="PhaseIdSet_FilterAssignee" style="display: none;">
                                                        <select class="selectpicker col-sm-6" id="FilterAssignee" name="assignee"  data-live-search="true">

                                                            @if($authorList->count() > 0)
                                                            @foreach($authorList as $userList)
                                                            <option value="{{$userList['id']}}">{{$userList['name']}}</option>
                                                            @endforeach

                                                            @endif

                                                        </select>
                                                    </div>


                                                    <div id="PhaseIdSet_FilterprojectId" style="display: none;">
                                                        <select class="selectpicker col-sm-6" id="FilterProjectId" name="projectId"  data-live-search="true">

                                                            @if($projectId->count() > 0)
                                                            @foreach($projectId as $userList)
                                                            <option value="{{$userList['id']}}">{{$userList['project_Id']}}</option>
                                                            @endforeach

                                                            @endif

                                                        </select>
                                                    </div>

                                                    <div id="PhaseIdSet_FilterPriority" style="display: none;">
                                                        <select class="selectpicker col-sm-6" id="FilterPriority" name="priority"  data-live-search="true">

                                                            <option value="Normal">Normal</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="Urgent">Urgent</option>
                                                            <option value="Very Urgent">Very Urgent</option>
                                                            <option value="Critical">Critical</option>

                                                        </select>
                                                    </div>

                                                </form>
                                                <span class="input-group-btn"> 

                                                </span> </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-12">
                                            <div class="btn-group">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Last Created <span class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">prority</a></li>
                                                    <li><a href="#">Label prority</a></li>
                                                    <li><a href="#">Last Created</a></li>
                                                    <!--li class="divider"></li-->
                                                    <li><a href="#">Oldest Created</a></li>
                                                    <li><a href="#">Last Updated</a></li>
                                                    <li><a href="#">More Weight</a></li>
                                                    <li><a href="#">Less Weight</a></li>
                                                    <li><a href="#">Due Soon</a></li>
                                                    <li><a href="#">Due Later</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!----end----search---with---filter------->
                        <div class="row">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active col-sm-12 row_content" id="open">

                                    <?php
                                    if (isset($projectIssues) and ! empty($projectIssues)) {
                                      foreach ($projectIssues as $projectIssuesList) {
                                        //  print_r($projectIssuesList);
                                        //   \Carbon\Carbon::createFromTimeStamp(strtotime($projectIssuesListName['created_at']))->diffForHumans()
                                        ?>        
                                        <div class="row green_bg b_b_border">
                                            <div class="col-sm-8">
                                                <h5 class="checkboxSetup"> <span>
                                                        <input id="checkbox1" type="checkbox">
                                                    </span> <a href="<?php echo url('admin/viewIssue') . '/' . $projectIssuesList['id']; ?>"><?php echo $projectIssuesList['title']; ?></a></h5>
                                                <p>#<?php print_r($projectIssuesList['id']); ?> · opened about <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($projectIssuesList['created_at']))->diffForHumans(); ?> by <?php echo $projectIssuesList['created_by']; ?>   <span class="@if(isset($_GET['list']) and $_GET['list']=='closed') text-danger @endif"><i class="fa fa-calendar" aria-hidden="true"></i> <?php
                                                        $times = strtotime($projectIssuesList['created_at']);
                                                        echo date('F d, Y', $times);
                                                        ?></span> <?php
                                                    if (count($projectIssuesList['labels']) > 0) {

                                                      foreach ($projectIssuesList['labels'] as $issue_print) {
                                                        //echo $issue_print['id'];
                                                        //  echo $issue_print['label_name'];
                                                        //echo $issue_print['label_color'];
                                                        echo '<span class="label_backlogs" style="color: white;border-radius: 5px;padding: 1px 9px;margin: 0px 8px; background: ' . $issue_print['label_color'] . ' ;">' . $issue_print['label_name'] . '</span>';
                                                      }
                                                    }
                                                    ?></p>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <h5 class="checkboxSetup"><i class="fa fa-comments" aria-hidden="true"></i> {{$projectIssuesList['comments']}} </h5>
                                                <p> updated <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($projectIssuesList['updated_at']))->diffForHumans(); ?>  </p>

                                            </div>
                                        </div>
                                        <?php
                                      }
                                    }
                                    ?>


                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
