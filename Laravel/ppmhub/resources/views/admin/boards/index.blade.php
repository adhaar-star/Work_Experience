@extends('layout.adminlayout')
@section('title','Backlogs | Agile Methodology')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
<link href="{{asset('vendors/kanban')}}/css/theme.css" rel="stylesheet">    
<script src="{{asset('vendors/kanban')}}/js/jquery-ui.min.js"></script>
<style>
    
    <?php 
$co=0;
 foreach($config_check as $dataCheck_count)
 {
     if($dataCheck_count['status']=='show'){
          $co++;
          
     }

}

 
?>
    
    .columnFields {
    width: <?php
    $fnl=$co * 372;
    
    
   // $o=1870;  
     $o=$fnl; 
  $newLabel=count($labels) * '372'; 
  //$less= $config_count * 370; 
  echo $o+$newLabel;
  
  
    ?>px;
 
}

  @if(count($labels) > 0)
@php $nth=$co; @endphp    
    @foreach($labels as $labelsList)
    @php $nth++; @endphp   
.columnFields .column.col-md-3:nth-child({{$nth}}) .label_backlogs { 
   background: {{$labelsList->label_color}}!important;
}
@endforeach

@endif
.backlogs .label_backlogs{
display:none!important;    
    
}
</style>


<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">               
<h4>Boards</h4>              
                <div class="col-md-12 setboxsize">
<div class="columnFields" role="main">
                       
      @if($config_check[0]['status']=='show')
                            <div class="column col-md-3 backlogs" rel="1" rel_name="backlogs" data-name="{{$config_check[0]['name']}}"  >
                                <div class="column-header nodrag">{{$config_check[0]['name']}}               <img src="{{asset('vendors/kanban')}}/images/plus_icon.png" class="plus_button"
                                                                                               data-toggle="modal"
                                                                                               data-target="#addTaskModal"
                                                                                               data-container_name="TO DO LIST"
                                                                                               data-container_id="1"/>
                                </div>

                                
                                @if($backlogList->count() > 0)

                                @foreach($backlogList as $backlogList_list)

                                <div class="portlet"
                                    
                                     id="{{$backlogList_list->id}}"
                                     data-toggle="modal" data-target="#editTaskModal"
                                     data-task_id="{{$backlogList_list->id}}">
                                    <div class="portlet-border"></div>
                                    <div class="portlet-header">
                                        <span class="task_title">{!! str_limit($backlogList_list['issue']->title, 20) !!} </span>

  </div>
                        
                                </div>


                                @endforeach

                                @endif
 





                            </div>
    
    @endif
    
       @if($config_check[1]['status']=='show')
                            <div class="column col-md-3" rel="2" rel_name="todo" data-name="{{$config_check[1]['name']}}" >
                                <div class="column-header nodrag" >{{$config_check[1]['name']}}             <img src="{{asset('vendors/kanban')}}/images/plus_icon.png" class="plus_button"
                                                                                         data-toggle="modal"
                                                                                         data-target="#addTaskModal"
                                                                                         data-container_name="DO TODAY"
                                                                                         data-container_id="2"/>
                                </div>


 
                                @if($projectIssue_todo->count() > 0)

                                @foreach($projectIssue_todo as $projectIssue_list_todo)

                                <div class="portlet"
                                    
                                     id="{{$projectIssue_list_todo->id}}"
                                     data-toggle="modal" data-target="#editTaskModal"
                                     data-task_id="{{$projectIssue_list_todo->id}}">
                                    <div class="portlet-border"></div>
                                    <div class="portlet-header">
                                        <span class="task_title">{!! str_limit($projectIssue_list_todo->description, 20) !!}</span>
<br>   <br> <span class="label_backlogs">{{$config_check[1]['name']}}</span> <?php 
                                                            if(count($projectIssue_list_todo['label_id']) > 0){
                                                                
                                                                foreach($projectIssue_list_todo['label_id'] as $issue_print)
                                                                {
                                                                
                                                                  echo '<span class="label_backlogs" style=" background: '.$issue_print['label_color'].' ;">'.$issue_print['label_name'].'</span>';
                                                                }
                                                            } 
                                                         ?>    </div>
                                   


                                </div>


                                @endforeach

                                @endif
 


                            </div>
    @endif
    
    
     @if($config_check[2]['status']=='show')
                            <div class="column col-md-3" rel="3" rel_name="doing"  data-name="{{$config_check[2]['name']}}" >
                                <div class="column-header nodrag" >{{$config_check[2]['name']}}               <img src="{{asset('vendors/kanban')}}/images/plus_icon.png" class="plus_button"
                                                                                           data-toggle="modal"
                                                                                           data-target="#addTaskModal"
                                                                                           data-container_name="IN PROGRESS"
                                                                                           data-container_id="3"/>
                                </div>


 
                                @if($projectIssue_doing->count() > 0)

                                @foreach($projectIssue_doing as $projectIssue_list_doing)

                                <div class="portlet"
                                    
                                     id="{{$projectIssue_list_doing->id}}"
                                     data-toggle="modal" data-target="#editTaskModal"
                                     data-task_id="{{$projectIssue_list_doing->id}}">
                                    <div class="portlet-border"></div>
                                    <div class="portlet-header">
                                        <span class="task_title">{!! str_limit($projectIssue_list_doing->description, 20) !!}</span>
                                        
                                           <br> <span class="label_backlogs">{{$config_check[2]['name']}}</span>
                                      
<?php 
                                                            if(count($projectIssue_list_doing['label_id']) > 0){
                                                                
                                                                foreach($projectIssue_list_doing['label_id'] as $issue_print)
                                                                {
                                                                
                                                                  echo '<span class="label_backlogs" style=" background: '.$issue_print['label_color'].' ;">'.$issue_print['label_name'].'</span>';
                                                                }
                                                            } 
                                                         ?>


                                    </div>
                                    


                                </div>


                                @endforeach

                                @endif        
 





                            </div>
    @endif    
    
    
 @if($config_check[3]['status']=='show')
    <div class="column col-md-3" rel="7" rel_name="review" data-name="{{$config_check[3]['name']}}" >
                                <div class="column-header nodrag" >{{$config_check[3]['name']}} 
                                    <img src="{{asset('vendors/kanban')}}/images/plus_icon.png" class="plus_button"
                                                                                             data-toggle="modal"
                                                                                             data-target="#addTaskModal"
                                                                                             data-container_name="DONE"
                                                                                             data-container_id="4"/>
                                </div>

 
                                @if($projectIssue_closed->count() > 0)

                                @foreach($projectIssue_closed as $projectIssue_list_closed)

                                <div class="portlet"
                                    
                                     id="{{$projectIssue_list_closed->id}}"
                                     data-toggle="modal" data-target="#editTaskModal"
                                     data-task_id="{{$projectIssue_list_closed->id}}">
                                    <div class="portlet-border"></div>
                                    <div class="portlet-header">
                                        <span class="task_title">{!! str_limit($projectIssue_list_closed->description, 20) !!}</span>
                                        <br> <span class="label_backlogs">{{$config_check[3]['name']}}</span>

<?php 
                                                            if(count($projectIssue_list_closed['label_id']) > 0){
                                                                
                                                                foreach($projectIssue_list_closed['label_id'] as $issue_print)
                                                                {
                                                                
                                                                  echo '<span class="label_backlogs" style=" background: '.$issue_print['label_color'].' ;">'.$issue_print['label_name'].'</span>';
                                                                }
                                                            } 
                                                         ?>


                                    </div>
                                

                                </div>


                                @endforeach

                                @endif              
 


                         

                        </div>
      @endif   
    
      
       @if($config_check[4]['status']=='show')
                            <div class="column col-md-3" rel="5" rel_name="closed" data-name="{{$config_check[4]['name']}}" >
                                <div class="column-header nodrag" >{{$config_check[4]['name']}} 
                                    <img src="{{asset('vendors/kanban')}}/images/plus_icon.png" class="plus_button"
                                                                                             data-toggle="modal"
                                                                                             data-target="#addTaskModal"
                                                                                             data-container_name="DONE"
                                                                                             data-container_id="4"/>
                                </div>

 
                                @if($projectIssue_closed->count() > 0)

                                @foreach($projectIssue_closed as $projectIssue_list_closed)

                                <div class="portlet"
                                    
                                     id="{{$projectIssue_list_closed->id}}"
                                     data-toggle="modal" data-target="#editTaskModal"
                                     data-task_id="{{$projectIssue_list_closed->id}}">
                                    <div class="portlet-border"></div>
                                    <div class="portlet-header">
                                        <span class="task_title">{!! str_limit($projectIssue_list_closed->description, 20) !!}</span>
                                        <br> <span class="label_backlogs">{{$config_check[4]['name']}}</span>
<?php 
                                                            if(count($projectIssue_list_closed['label_id']) > 0){
                                                                
                                                                foreach($projectIssue_list_closed['label_id'] as $issue_print)
                                                                {
                                                                
                                                                  echo '<span class="label_backlogs" style=" background: '.$issue_print['label_color'].' ;">'.$issue_print['label_name'].'</span>';
                                                                }
                                                            } 
                                                         ?>
 </div>
                                   


                                </div>


                                @endforeach

                                @endif              
 


                         

                        </div>
        @endif
    
    
    @if(count($labels) > 0)
    
    @foreach($labels as $labelsList)

    
    


    <div class="column col-md-3" rel="6" rel_name="{{$labelsList->id}}" data-name="{{$labelsList->label_name}}" >
        <div class="column-header nodrag" style="border-top: 4px solid {{$labelsList->label_color}};"> {{$labelsList->label_name}}
                                    <img src="{{asset('vendors/kanban')}}/images/plus_icon.png" class="plus_button"
                                                                                               data-toggle="modal"
                                                                                               data-target="#addTaskModal"
                                                                                               data-container_name="TO DO LIST"
                                                                                               data-container_id="1"/>
                                </div>
                                @if($labelsList['issues_list'])

                                @foreach($labelsList['issues_list'] as $backlog_issue_List)

                               
<div class="portlet"
                                    
                                     id="{{$backlog_issue_List->id}}"
                                     data-toggle="modal" data-target="#editTaskModal"
                                     data-task_id="{{$backlog_issue_List['id']}}">
                                    <div class="portlet-border"></div>
                                    <div class="portlet-header">
                                        <span class="task_title">{!! str_limit($backlog_issue_List['description'], 20) !!}</span>
                                        <br>
                                        {{$backlog_issue_List['id']}}    {{$backlog_issue_List['label_id']}}
                                        <span class="label_backlogs" style="background: {{$labelsList->label_color}};">{{$labelsList->label_name}}</span>



                                    </div>
                              


                                </div>
                                
                                

                                @endforeach

                                @endif





                            </div>
    @endforeach    
    @endif


                        <!--div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="exampleModalLabel">Add Task</h4>
                                    </div>
                                    <form class="formAjax" action="{{asset('vendors/kanban')}}/ajax/save_task" method="post">
                                        <div class="modal-body">
                                            <input id="task_container" name="task_container" type="hidden" value=""/>
                                            <div class="form-group">
                                                <label for="task_title" class="form-control-label">Title:</label>
                                                <input id="task_title" name="task_title" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="task_description" class="form-control-label">Description:</label>
                                                <textarea id="task_description" name="task_description" class="form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="task_time_estimate" class="form-control-label">Time estimate (hh:mm):</label>
                                                <input id="task_title" name="task_time_estimate" type="text" class="form-control" value="00:00">
                                            </div>

                                            <div class="form-group">
                                                <label for="task_time_spent" class="form-control-label">Time spent (hh:mm):</label>
                                                <input id="task_time_spent" name="task_time_spent" type="text" class="form-control"
                                                       value="00:00">
                                            </div>

                                            <div class="form-group">
                                                <label for="task_time_spent" class="form-control-label">Due date:</label>
                                                <div class='input-group date datetimepicker'>
                                                    <input id="task_due_date" name="task_due_date" type='text' class="form-control"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close_button" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div-->



 


                    </div>
<script>  var base_url = '{{url("/admin")}}/';
var token ='{{csrf_token()}}';
</script>
<script src="{{asset('vendors/kanban')}}/js/kanban.js"></script>
                    </body>
                    
 

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End  -->
@endsection

