@extends('layout.adminlayout')
@section('title','Project | Add Checklist')
@section('body')


<!--
<section class="page-content IssuesEt">
    <div class="page-content-inner">-->

<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                        </li>
                        <li>
                            <a href="{{url('admin/projectissues')}}">Issue List</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"> Edit Issue </a> 
                        </li>
                    </ul>
                </div>


                {{Form::open(array('url' => 'admin/editIssue/'.$SingleIssue[0]->id,'files'=>'true','class'=>'form-horizontal'))}}
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan">
                        <h4 class="margin-0"> Edit Issue</h4>
                    </div>

                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12">   
                                <div class="form-group row">
                                    <label class="col-md-2 control-label text-right line-height-2" for="issue_title">Issue Title*:</label>
                                    <div class="col-md-10">
                                        <input id="issue_title" name="title" placeholder="Issue Title" value="{{ $SingleIssue[0]->title }}" class="form-control border-radius-0 border-alicewhite padding-input" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">   
                                <div class="form-group row">
                                    <label class="col-md-2 control-label text-right line-height-2" for="description">Description*:</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control texteditorSet" rows="7" maxlength="300" cols="10" id="descriptionIssues" name="description" placeholder="Please enter your message here..." rows="3">{{ $SingleIssue[0]->description }}</textarea>
                                        @isset($attachment)
                                        <p>File(s) will be lost on update.</p> 
                                        @foreach($attachment as $key=>$file)
                                        <input type="file" style="display: none;" name="fileToUpload[]" id="editfileToUpload{{$loop->index}}" value="{{$file}}" />
                                        <div id="edit-attachment-{{$loop->index}}">
                                            <span  style="font-size: 16px">
                                                <i class="note fa fa-paperclip"></i>
                                                <a href="{{asset($file)}}" download> {{$key}}</a>
                                                &nbsp;&nbsp;
                                                <i class="note fa fa-times" onclick="{ $(`#edit-fileToUpload-{{$loop->index}}`).remove(); $(`#editattachment{{$loop->index}}`).remove(); }">
                                                </i>
                                            </span>
                                        </div>
                                        @endforeach
                                        @endisset

                                        <p class="counterText text-center redset">Maximum 300 Characters Only</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="issue_list">Issue List Type*:</label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="issueTypeId" data-live-search="true">					 
                                                    @if($isueType->count() > 0)
                                                    <option value=""> Please select </option>
                                                    @foreach($isueType as $isueTypeList)
                                                    <option @if($SingleIssue[0]->issueTypeId==$isueTypeList['id']) {{'selected="selected"'}} @endif value="{{$isueTypeList['id']}}">{{$isueTypeList['name']}}</option>
                                                    @endforeach
                                                    @else

                                                    @endif

                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">            
                                            <div class="col-md-9">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">        
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="project_id">Project ID*:</label>
                                            <div class="col-sm-8">		    
                                                <select class="selectpicker form-control" name="projectId" id="ProjectListGet" data-live-search="true">

                                                    @if($project->count() > 0)
                                                    <option value=""> Please select </option>
                                                    @foreach($project as $projectList)
                                                    <option @if($SingleIssue[0]->projectId==$projectList['id']) {{'selected="selected"'}} @endif value="{{$projectList['id']}}">{{$projectList['project_Id']}} ( {!! \Illuminate\Support\Str::words($projectList['project_desc'], 5,'....')  !!} )</option>
                                                    @endforeach
                                                    @else

                                                    @endif

                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>    	 

                                    <div class="col-md-6">
                                        <div class="form-group">            
                                            <div class="col-md-9">
                                                <span id="project_nameDesc" class="ddplace"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>


                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">   
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="phase_id">Phase ID*:</label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="phaseId" id="PhaseIdSet" data-live-search="true">
                                                    @if($phase->count() > 0)
                                                    <option value="" selected> Please select </option>
                                                    @foreach($phase as $phaseList)
                                                    <option  @if($SingleIssue[0]->phaseId==$phaseList['id']) {{'selected="selected"'}} @endif value="{{$phaseList['id']}}">{{$phaseList['phase_Id']}} ( {!! \Illuminate\Support\Str::words($phaseList['phase_name'], 5,'....')  !!} )</option>
                                                    @endforeach
                                                    @else

                                                    @endif
                                                </select>
                                            </div>
                                        </div></div>

                                    <div class="col-md-6">
                                        <div class="form-group">            
                                            <div class="col-md-9">
                                                <span id="phase_name" class="ddplace"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">   
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="task_id">Task ID*:</label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="taskId" id="TaskIdSet" data-live-search="true">
                                                    @if($task->count() > 0)
                                                    @foreach($task as $taskList)
                                                    <option @if($SingleIssue[0]->taskId==$taskList['id']) {{'selected="selected"'}} @endif value="{{$taskList['id']}}">{{$taskList['task_Id']}} ( {!! \Illuminate\Support\Str::words($taskList['task_name'], 5,'....')  !!} )</option>
                                                    @endforeach
                                                    @else

                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">            
                                            <div class="col-md-9">
                                                <span id="setTaskName" class="ddplace"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="actual_close_date">Close Date*: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control datepicker-only-init-issue border-alicewhite border-radius-0 padding-input" id="actual_close_date" value="{{ $SingleIssue[0]->close_date }}" placeholder="actual close date" name="close_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="due_date"> Due Date*: </label>
                                            <div class="col-sm-8">
                                                <input class="form-control datepicker-only-init-issue border-alicewhite border-radius-0 padding-input" placeholder="Start Date" name="due_date" value="{{ $SingleIssue[0]->due_date }}" required="required" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="priority"> Priority*: </label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="priority" data-live-search="true">
                                                    <option @if($SingleIssue[0]->priority=='Normal') {{'selected="selected"'}} @endif value="Normal">Normal</option>
                                                    <option @if($SingleIssue[0]->priority=='Medium') {{'selected="selected"'}} @endif value="Medium">Medium</option>
                                                    <option @if($SingleIssue[0]->priority=='Urgent') {{'selected="selected"'}} @endif value="Urgent">Urgent</option>
                                                    <option @if($SingleIssue[0]->priority=='Very Urgent') {{'selected="selected"'}} @endif value="Very Urgent">Very Urgent</option>
                                                    <option @if($SingleIssue[0]->priority=='Critical') {{'selected="selected"'}} @endif value="Critical">Critical</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="assignee">Assignee*:</label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="assignee" id="" data-live-search="true">
                                                    @if($user->count() > 0)
                                                    @foreach($user as $userList)
                                                    <option @if($SingleIssue[0]->assignee==$userList['id']) {{'selected="selected"'}} @endif value="{{$userList['id']}}">{{$userList['name']}}</option>
                                                    @endforeach
                                                    @else

                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="estimated_duration"> Duration Unit*: </label>
                                            <div class="col-sm-8">

                                                <select class="selectpicker form-control" name="duration_unit" id="" data-live-search="true">
                                                    @if($capacity_units->count() > 0)
                                                    @foreach($capacity_units as $capacity_unitsList)
                                                    <option @if($SingleIssue[0]->duration_unit==$capacity_unitsList['id']) {{'selected="selected"'}} @endif value="{{$capacity_unitsList['id']}}">{{$capacity_unitsList['name']}}</option>
                                                    @endforeach
                                                    @else

                                                    @endif
                                                </select>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="estimated_duration"> Estimated Duration*: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control border-alicewhite border-radius-0 padding-input" id="estimated_duration" value="{{ $SingleIssue[0]->estimated_duration }}" placeholder="Estimated Duration" name="estimated_duration">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="project_manager"> Project Manager*: </label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="projectManager" data-live-search="true" id="project_manager">

                                                    @if($ProjectManager->count() > 0)
                                                    @foreach($ProjectManager as $ProjectManagerList)
                                                    <option @if($SingleIssue[0]->projectManager==$ProjectManagerList['id']) {{'selected="selected"'}} @endif value="{{$ProjectManagerList['id']}}">{{$ProjectManagerList['name']}}</option>
                                                    @endforeach
                                                    @else

                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="status"> Status*:</label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="status" data-live-search="true" id="status">                        
                                                    <option @if($SingleIssue[0]->status==1) {{'selected="selected"'}} @endif value="1">Not yet assigned</option>
                                                    <option @if($SingleIssue[0]->status==2) {{'selected="selected"'}} @endif value="2">Assigned</option>
                                                    <option @if($SingleIssue[0]->status==3) {{'selected="selected"'}} @endif value="3">In progress</option>
                                                    <option @if($SingleIssue[0]->status==4) {{'selected="selected"'}} @endif value="4">Complete</option>
                                                    <option @if($SingleIssue[0]->status==5) {{'selected="selected"'}} @endif value="5">Closed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="component_id"> Component*: </label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="component_id" data-live-search="true" id="component_id">
 <option value="0"> Please select </option>
                                                    @if($components->count() > 0)
                                                    @foreach($components as $componentsList)
                                                    <option @if(isset($SingleIssue[0]->component_id) and $SingleIssue[0]->component_id==$componentsList['id']) {{'selected="selected"'}} @endif value="{{$componentsList['id']}}">{{$componentsList['component_number']}} ( {{$componentsList['component_name']}} )</option>
                                                    @endforeach
                                                    @else

                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="sprint_id"> Sprint No.: </label>
                                            <div class="col-sm-8">		
                                                <select class="selectpicker form-control" name="sprint_id" data-live-search="true" id="sprint_id">
 <option value="0" > Please select </option>
                                                    @if($sprints->count() > 0)
                                                    @foreach($sprints as $sprintsList)
                                                    <option @if(isset($SingleIssue[0]->sprint_id) and $SingleIssue[0]->sprint_id==$sprintsList['id']) {{'selected="selected"'}} @endif value="{{$sprintsList['id']}}">{{$sprintsList['sprint_number']}}</option>
                                                    @endforeach
                                                    @else

                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group row">
                                            <label class="col-md-4 control-label text-right line-height-2" for="label_id"> Labels*: </label>
                                         
                                            
                                            
                                            
                                            <div class="col-sm-8">
                                                 <select multiple="multiple" class="multiselect-ui form-control border-radius-0" name="label_id[]" data-live-search="true" id="label_id">
                                                   @if($labels->count() > 0)
                                                    @foreach($labels as $labelsList)

                                                    <option style="background: {{$labelsList['label_color']}}; color: white;" 
                                                          
                                                            <?php 
                                                           
                                            $export=$SingleIssue[0]->label_id;
                                           if(count($export) > 0 ){
                                               
                                               foreach($export as $exportConvert){
                                                   
                                                if(isset($exportConvert['id']) and $exportConvert['id']==$labelsList['id']){
                                                    
                                                    echo 'selected="selected"';
                                                }
                                               }
                                           }
                                                         ?>
                                                            value="{{$labelsList['id']}}"> {{$labelsList['label_name']}} </option>

                                                    @endforeach
                                                    @else

                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
    <div class="form-group row">
        <label class="col-md-4 control-label text-right line-height-2" for="issue_list">Story Point:</label>
        <div class="col-sm-8">      
            <select class="storypoint form-control" name="issueStoryPoint" data-live-search="true"> 
                @if(count($storypoints) > 0)
                <option value=""> Please select story point </option>
                @foreach($storypoints as $storypoint)
                <option>{{$storypoint}}</option>                   
                @endforeach
                @else 
                <option value=""> Please select story point </option>
                @endif
            </select>
        </div>
    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>

                    <input type="hidden" value="{{ csrf_token() }}" name="_token">

                    <div class="card-footer card-footer-box text-right">
                        <button type="submit" class="btn btn-info card-btn">Update Issue</button>
                    </div> 


                    {{ Form::close() }}


                </div>
            </div>
        </div>

        <script>
                            (function () {

                            $("#estimated_duration").on('change', function (evt) {
                            var unit = $("#duration_unit :selected").val();
                                    switch (parseInt(unit))
                            {
                            case 1:
                                    if (parseInt(evt.target.value) > 29)
                            {
                            evt.target.value = 29;
                            }
                            break;
                                    case 2:
                                    if (parseInt(evt.target.value) > 11)
                            {
                            evt.target.value = 11;
                            }

                            break;
                                    case 3:
                                    if (parseInt(evt.target.value) > 99)
                            {
                            evt.target.value = 99;
                            }

                            break;
                            }
                            });
                            })();

        </script>
</section> 

@endsection
