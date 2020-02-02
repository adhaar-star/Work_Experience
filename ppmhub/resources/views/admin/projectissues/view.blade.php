@extends('layout.adminlayout')
@section('title','Agile Methodology | Issue List')
@section('body')

@if(Session::has('flash_message'))
<div class="alert alert-success"> <span class="glyphicon glyphicon-ok"></span> <em> {!! session('flash_message') !!}</em> </div>
@endif

<section class="page-content">
    <div class="page-content-inner">
        <div class="breadcrumb" style="background-color:#fff;padding:30px 50px">		
12.	            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>		
13.	            <ul class="list-unstyled breadcrumb breadcrumb-custom">		
14.	                <li>		
15.	                    <a href="{{url('admin/dashboard')}}">Project Management</a>		
16.	                </li>		
17.	                <li><a href="{{url('admin/projectissues')}}" ><span>Project Issue List Dashboard</span></a></li>		
18.	                <li><span>{{$SingleIssue[0]['title']}}</span></li>		
19.	            </ul>		
20.	        </div>
        <section class="panel">
            <div class="panel-body">
                <div class="row change_sidebars">

                    <div class="col-lg-10 full_side">
                        <div class="container edit_bucket_main">
                            <div class="row closed_btn_top_bar_main">
                                <div class="col-sm-8">
                                    <ul>
                                        <li>
                                            <button type="button"

                                                    @if($SingleIssue[0]['status']==1)     class="btn btn-danger btn-sm"> Not yet assigned
                                                    @elseif($SingleIssue[0]['status']==2) class="btn btn-primary btn-sm">Assigned
                                                    @elseif($SingleIssue[0]['status']==3) class="btn btn-warning btn-sm">In progress 
                                                    @elseif($SingleIssue[0]['status']==4)  class="btn btn-info btn-sm">Complete           
                                                    @else($SingleIssue[0]['status']==5) class="btn btn-success btn-sm"> Closed @endif </button>
                                        </li>
                                        <li> Issue<a href="#"><b> #{{$SingleIssue[0]['id']}} </b></a> opened <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($SingleIssue[0]['created_at']))->diffForHumans(); ?> by </li>
                                        <li> <img class="img-responsive img-circle setcommentImg" src="{{asset('vendors/common/img/temp/avatars/1.jpg')}}"> <b>{{$SingleIssue[0]['created_by']}}</b> </li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul>
                                        <li>   @if (RoleAuthHelper::hasAccess('project.issues.create')!=true)  
                                            <a onclick="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                                @else <a onclick="window.location.href ='{{url('admin/addIssue')}}';" class="btn btn-primary">@endif New Issue</a> </li>
                                        <li>
                                            <form method="post" action="{{url('admin/viewIssue/'.$SingleIssue[0]['id'].'')}}" >
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                <input type="hidden" name="status" value="5" >
                                                @if (RoleAuthHelper::hasAccess('project.issues.view')!=true)
                                                <button type="button" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">Close Issue</button>
                                                @else
                                                <button type="submit" class="btn btn-success">Close Issue</button>@endif
                                            </form>
                                        <li> 
                                            @if (RoleAuthHelper::hasAccess('project.issues.update')!=true)  
                                            <a onclick="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a onclick="window.location.href ='{{url('admin/editIssue').'/'.$SingleIssue[0]['id']}}';" class="btn btn-warning">@endif Edit</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <h3>{{$SingleIssue[0]['title']}} </h3>
                                <p> <?php print_r($SingleIssue[0]['description']); ?> </p>
                                @isset($SingleIssue[0]['attachment'])
                                @foreach ($SingleIssue[0]['attachment'] as $key=>$file)
                                <div >
                                    <span  style="font-size: 13px">
                                        <i class="note fa fa-paperclip">
                                            <a download="{{$key}}" href="{{asset($file)}}">{{$key}}</a>
                                        </i>

                                    </span>
                                </div>
                                @endforeach
                                @endisset

                            </div>
                            <div class="row">
                                <div class="col-sm-12 setLikeUnlike" style="">
                                    <button data-like="1" data-issue="{{$SingleIssue[0]['id']}}" class="btn like   @if(isset($SingleIssue[0]['melike']) and $SingleIssue[0]['melike']==1) btn-success @endif"><span class="fa fa-thumbs-o-up" aria-hidden="true"></span> <span class="likes">{{$SingleIssue[0]['likeClount']}}</span></button>
                                    <button data-like="2" data-issue="{{$SingleIssue[0]['id']}}" class="btn dislike   @if(isset($SingleIssue[0]['melike']) and $SingleIssue[0]['melike']==2) btn-danger @endif"><span class="fa fa-thumbs-o-down" aria-hidden="true"></span> <span class="dislikes">{{$SingleIssue[0]['unlikeClount']}}</span></button>
                                </div>
                            </div>
                            <div class="clearfix"></div> 
                            <?php
                            if (isset($Comment) and count($Comment)) {
                              $cdcount = 0;
                              foreach ($Comment as $CommentList) {
                                $cdcount++;
                                ?>
                                <div class="row" style=" padding: 15px;<?php
                                if ($cdcount == count($Comment))
                                  echo 'border-bottom:1px solid #e9e9e9"';
                                else
                                  echo'"';
                                ?> >
                                     <div class="col-lg-1"> <img class="img-responsive img-circle" width="50" src="{{asset('vendors/common/img/temp/avatars/1.jpg')}}"> </div>
                                <div class="col-lg-11 " > {{$CommentList['userId']}} commented <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($CommentList['created_at']))->diffForHumans(); ?> <br>
                                    <?php print_r($CommentList['description']); ?></div>
                                @isset($CommentList['attachment'])
                                @foreach ($CommentList['attachment'] as $key=>$file)
                                <div >
                                    <span  style="font-size: 13px">
                                        <i class="note fa fa-paperclip">
                                            <a download="{{$key}}" href="{{asset($file)}}">{{$key}}</a>
                                        </i>

                                    </span>
                                </div>
                                @endforeach
                                @endisset

                            </div>
                            <?php
                          }
                        }
                        ?>
                        <div class="clearfix"></div>
                        {{Form::open(array('url' => 'admin/issueComment','files'=>'true'))}}
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <input type="hidden" value="{{Auth::user()->id}}" name="userId">
                        <input type="hidden" value="{{$SingleIssue[0]['id']}}" name="ProjectissueId">
                        <div class="row top_margin">
                            <div class="col-sm-1"> <img class="img-responsive img-circle setcommentImg" src="{{asset('vendors/common/img/temp/avatars/1.jpg')}}"> </div>
                            <div class="col-sm-11">
                                <textarea class="form-control texteditorSet" rows="7" maxlength="300" cols="10" id="descriptionIssues" name="description" placeholder="Write a comment here..." rows="3">
                                </textarea>
                                <p class="counterText text-center redset">Maximum 300 Characters Only</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1 ">
                                @if (RoleAuthHelper::hasAccess('project.issues.view')!=true)
                                <button type="button" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">Comment</button>
                                @else
                                <button type="submit" class="btn btn-info">Comment</button>
                                @endif
                                <form method="post" action="{{url('admin/viewIssue/'.$SingleIssue[0]['id'].'')}}" >
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                    <input type="hidden" name="status" value="5" >
                                    @if (RoleAuthHelper::hasAccess('project.issues.view')!=true)
                                    <button type="button" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">Close Issue</button>
                                    @else
                                    <button type="submit" class="btn btn-success">Close Issue</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>


                </div>

                <div class="sidebar_arrows">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>

                </div>

                <div class="col-lg-2 open_panel" style="padding: 0;">


                    <div class="list-group">
                        <span href="#" class="list-group-item">
                            <span class="names"> Assignee</span> 
                            <div class="bottomLine"><img class="img-responsive img-circle" height="20" width="20" src="{{asset('vendors/common/img/temp/avatars/1.jpg')}}"> {{Auth::user()->name}}</div>
                            <span class="pull-right" id="slide-submenu">

                            </span>
                        </span>



                        <span href="#" class="list-group-item">
                            <span class="names">Priority</span> <i class="fa fa-eye icons"></i>
                            <div class="bottomLine"><?php print_r($projectIssues_sidebar[0]['priority']); ?></div>
                            <span class="pull-right" id="slide-submenu">

                            </span>
                        </span>

                        <span href="#" class="list-group-item">
                            <span class="names">Due Date</span> <i class="fa fa-clock-o icons"></i>
                            <div class="bottomLine"><?php
                                if ($projectIssues_sidebar[0]['due_date']) {
                                  $convert = strtotime($projectIssues_sidebar[0]['due_date']);
                                  print_r(date('Y-m-d', $convert));
                                } else {
                                  echo 'No Due Date';
                                }
                                ?></div>
                            <span class="pull-right" id="slide-submenu">

                            </span>
                        </span>



                        <span href="#" class="list-group-item">
                            <span class="names"> Status</span> <i class="fa fa-question icons"></i>
                            <div class="bottomLine"><button type="button" @if($SingleIssue[0]['status']==1)     class="btn btn-danger btn-sm"> Not yet assigned
                                                            @elseif($SingleIssue[0]['status']==2) class="btn btn-primary btn-sm">Assigned
                                                            @elseif($SingleIssue[0]['status']==3) class="btn btn-warning btn-sm">In progress 
                                                            @elseif($SingleIssue[0]['status']==4)  class="btn btn-info btn-sm">Complete           
                                                            @else($SingleIssue[0]['status']==5) class="btn btn-success btn-sm"> Closed @endif </button></div>
                            <span class="pull-right" id="slide-submenu">

                            </span>
                        </span>

                        <span href="#" class="list-group-item">
                            <span class="names"> Labels</span> <i class="fa fa-tags icons"></i>
                            <div class="bottomLine"><?php
                                if (count($projectIssues_sidebar[0]['label_id']) > 0) {

                                  foreach ($projectIssues_sidebar[0]['label_id'] as $issue_print) {

                                    echo '<span class="label_backlogs" style="display: block; width: -moz-fit-content !important;color: white;border-radius: 5px;padding: 1px 9px;margin: 4px 0px; text-align:center; background: ' . $issue_print['label_color'] . ' ;">' . $issue_print['label_name'] . '</span>';
                                  }
                                } else {

                                  echo 'None';
                                }
                                ?>
                            </div>
                            <span class="pull-right" id="slide-submenu">

                            </span>
                        </span>


                        <span href="#" class="list-group-item">
                            <span class="names"> Component</span> <i class="fa fa-list-alt icons"></i>
                            <div class="bottomLine"><?php
                                if ($projectIssues_sidebar[0]['component']) {
                                  print_r($projectIssues_sidebar[0]['component']['component_name']);
                                } else {
                                  echo 'None';
                                }
                                ?></div>
                            <span class="pull-right" id="slide-submenu">

                            </span>
                        </span>



                        <span href="#" class="list-group-item">
                            <span class="names"> Sprint No.</span> <i class="fa fa-bug icons"></i>
                            </a>  
                            <div class="bottomLine"><?php
                                if ($projectIssues_sidebar[0]['sprint_id']) {
                                  print_r($projectIssues_sidebar[0]['sprint_id']);
                                } else {
                                  echo 'None';
                                }
                                ?></div>
                            <span class="pull-right" id="slide-submenu">

                            </span>
                        </span>




                    </div>        

                </div>
            </div>
        </section>
        <!--script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.2/jquery.cookie.min.js"></script-->
        <script>
                  $(document).ready(function(){
          /*  cookVal = $.cookie('issues_details');
           if(cookVal=='fa-angle-double-left'){           
           //  $('.sidebar_arrows i').removeClass('fa-angle-double-right').addClass('fa-angle-double-left');
           $('.sidebar_arrows i').trigger('click');
           $( ".sidebar_arrows i" ).click();
           } */

          $('body').on('click', '.sidebar_arrows i.fa-angle-double-right', function (){
          // $.cookie('issues_details','fa-angle-double-left');
          $('.full_side').removeClass('col-lg-10').addClass('col-lg-11');
                  $('.open_panel').removeClass('col-lg-2').addClass('col-lg-1');
                  $('.list-group').css('text-align', 'center');
                  $('.names').hide();
                  $('.icons').show();
                  $('.sidebar_arrows i').removeClass('fa-angle-double-right').addClass('fa-angle-double-left');
                  $('.open_panel button').css('padding', '5');
          });
                  $('body').on('click', '.sidebar_arrows i.fa-angle-double-left', function (){
          //$.cookie('issues_details','fa-angle-double-right');
          $('.full_side').removeClass('col-lg-11').addClass('col-lg-10');
                  $('.open_panel').removeClass('col-lg-1').addClass('col-lg-2');
                  $('.list-group').css('text-align', 'left');
                  $('.names').show();
                  $('.icons').hide();
                  $('.sidebar_arrows i').removeClass('fa-angle-double-left').addClass('fa-angle-double-right');
          });
          });

        </script>
        @endsection    
