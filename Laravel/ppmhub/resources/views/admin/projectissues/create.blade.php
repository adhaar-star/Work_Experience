@extends('layout.adminlayout')
@section('title','Agile Methodology | Add Issue')
@section('body')

<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12"> @if (count($errors) > 0)
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
                            <a href="javascript:void(0)"> Add Issue </a> 
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan">
                        <h4 class="margin-0"> New Issue</h4>
                    </div>

                    
                    
                    {{Form::open(array('url' => 'admin/insertIssue','files'=>'true' ,'class'=>'form-horizontal'))}}


                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-2 col-form-label line-height-2" for="issue_title">Issue Title*:</label>
                                    <div class="col-xs-12 col-sm-6 col-md-10 col-lg-9">
                                        <input id="issue_title" name="title" placeholder="Issue Title" class="form-control border-radius-0 padding-input border-alicewhite" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-md-2 control-label text-right line-height-2" for="description">Description*:</label>
                                    <div class="col-xs-12 col-sm-6 col-md-10 col-lg-9">
                                        <textarea class="form-control border-radius-0 texteditorSet" rows="7" maxlength="300" cols="10" id="descriptionIssues" name="description" placeholder="Please enter your message here..." rows="3">
                                        </textarea>
                                        <p class="counterText text-center redset">Maximum 300 Characters Only</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="issue_list">Issue List Type*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="issueTypeId" data-live-search="true">

                                                    @if($isueType->count() > 0)

                                                    <option value="" selected> Please select </option>

                                                    @foreach($isueType as $isueTypeList)

                                                    <option value="{{$isueTypeList['id']}}">{{$isueTypeList['name']}}</option>

                                                    @endforeach
                                                    @else

                                                    <option value="" selected>Issue List Not Avaliable</option>

                                                    @endif


                                                </select> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="project_id">Project ID*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="projectId" id="ProjectListGet" data-live-search="true">

                                                    @if($project->count() > 0)

                                                    <option value="" selected> Please select </option>

                                                    @foreach($project as $projectList)

                                                    <option value="{{$projectList['id']}}">{{$projectList['project_Id']}} ( {!! \Illuminate\Support\Str::words($projectList['project_desc'], 5,'....')  !!} )
                                                    </option>

                                                    @endforeach
                                                    @else
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <span id="project_nameDesc" class="ddplace" > </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="phase_id">Phase ID*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="phaseId" id="PhaseIdSet" data-live-search="true">

                                                    @if($phase->count() > 0)

                                                    <option value="" selected> Please select </option>

                                                    @foreach($phase as $phaseList)

                                                    <option value="{{$phaseList['id']}}">{{$phaseList['phase_Id']}} ( {!! \Illuminate\Support\Str::words($phaseList['phase_name'], 5,'....')  !!} )</option>

                                                    @endforeach
                                                    @else
                                                    @endif

                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <span id="phase_name" class="ddplace" > </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="task_id">Task ID*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="taskId" id="TaskIdSet" data-live-search="true">

                                                    @if($task->count() > 0)
                                                    @foreach($task as $taskList)

                                                    <option value="{{$taskList['id']}}">{{$taskList['task_Id']}} ( {!! \Illuminate\Support\Str::words($taskList['task_name'], 5,'....')  !!} )</option>

                                                    @endforeach
                                                    @else
                                                    @endif

                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <span id="setTaskName" class="ddplace"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label line-height-2" for="actual_close_date">Close Date*: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        {!!Form::text('close_date',isset($taskList->close_date) ? $taskList->closer_date : '',array('class'=>'form-control border-radius-0 padding-input border-alicewhite datepicker-only-init','placeholder'=>'Please select  start date'))!!}
                                                        <span class="input-group-addon border-radius-0 border-alicewhite"> <i class="icmn-calendar"></i> </span>
                                                    </label>
                                                    @if($errors->has('close_date')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('close_date') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label line-height-2" for="due_date"> Due Date*: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        {!!Form::text('due_date',isset($taskList->due_date) ? $taskList->due_date : '',array('class'=>'form-control border-radius-0 padding-input border-alicewhite datepicker-only-init','placeholder'=>'Please select  start date'))!!}
                                                        <span class="input-group-addon border-radius-0 border-alicewhite"> <i class="icmn-calendar"></i> </span>
                                                    </label>
                                                    @if($errors->has('due_date')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('due_date') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="component_id"> Component*: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="component_id" data-live-search="true" id="component_id">
                                                    <option value="0" selected> Please select </option>
                                                    @if($components->count() > 0)
                                                    @foreach($components as $componentsList)

                                                    <option value="{{$componentsList['id']}}">{{$componentsList['component_number']}} ( {{$componentsList['component_name']}} )</option>

                                                    @endforeach
                                                    @else

                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        
                       
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="label_id"> Labels*: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select multiple="multiple" class="multiselect-ui form-control border-radius-0" name="label_id[]" data-live-search="true" id="label_id">
 <option value="0" selected> Please select </option>                          
                                                    @if($labels->count() > 0)
                                                    @foreach($labels as $labelsList)

                                                    <option style="background: {{$labelsList['label_color']}};color:white;" value="{{$labelsList['id']}}" data-color="{{$labelsList['label_color']}}">{{$labelsList['label_name']}} </option>

                                                    @endforeach
                                                    @else

                                                    @endif

                                                </select>
                                            </div>
                                        </div>
 
                                        
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="priority"> Priority* </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="priority" data-live-search="true">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="Urgent">Urgent</option>
                                                    <option value="Very Urgent">Very Urgent</option>
                                                    <option value="Critical">Critical</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="assignee">Assignee*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="assignee" id="" data-live-search="true">

                                                    <?php /* @if($user->count() > 0)
                                                      @foreach($user as $userList)

                                                      <option value="{{$userList['id']}}">{{$userList['name']}}</option>

                                                      @endforeach
                                                      @else

                                                      <option value="" selected>Assignee Not Avaliable</option>

                                                      @endif */ ?>

                                                    @if($ProjectManager->count() > 0)
                                                    @foreach($ProjectManager as $ProjectManagerList)

                                                    <option value="{{$ProjectManagerList['id']}}">{{$ProjectManagerList['name']}}</option>

                                                    @endforeach
                                                    @else

                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label line-height-2" for="estimated_duration"> Estimated Duration*: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <input type="text" class="form-control border-radius-0 padding-input border-alicewhite" id="estimated_duration" placeholder="Estimated Duration" name="estimated_duration">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="estimated_duration"> Duration Unit*: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="duration_unit" id="duration_unit" data-live-search="true">

                                                    @if($capacity_units->count() > 0)
                                                    @foreach($capacity_units as $capacity_unitsList)

                                                    <option value="{{$capacity_unitsList['id']}}">{{$capacity_unitsList['name']}}</option>

                                                    @endforeach
                                                    @else

                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="project_manager"> Project Manager*: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="projectManager" data-live-search="true" id="project_manager">

                                                    @if($ProjectManager->count() > 0)
                                                    @foreach($ProjectManager as $ProjectManagerList)

                                                    <option value="{{$ProjectManagerList['id']}}">{{$ProjectManagerList['name']}}</option>

                                                    @endforeach
                                                    @else

                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="status"> Status*: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="status" data-live-search="true" id="status">
                                                    <option value="1">Not yet assigned</option>
                                                    <option value="2">Assigned</option>
                                                    <option value="3">In progress</option>
                                                    <option value="4">Complete</option>
                                                    <option value="5">Closed</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                              <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="sprint_id"> Sprint No.: </label>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                <select class="selectpicker form-control border-radius-0" name="sprint_id" data-live-search="true" id="sprint_id">
 <option value="0" selected> Please select </option>
                                                    @if($sprints->count() > 0)
                                                    @foreach($sprints as $sprintsList)

                                                    <option value="{{$sprintsList['id']}}">{{$sprintsList['sprint_number']}}</option>

                                                    @endforeach
                                                    @else

                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <input type="hidden" value="{{Auth::user()->id}}" name="created_by">

                        </div>
                    </div>

                    <div class="card-footer card-footer-box text-right">
                        <button type="submit" class="btn btn-info card-btn">Add Issue</button>
                    </div>
                    <!--                        </form>-->
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