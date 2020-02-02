@extends('layout.adminlayout')
@section('title','Project | Add Milestone')
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/projectmilestone.js') !!}

<section id="create_form" class="panel">
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
                            <a class="dropdown-item" href="{{url('admin/projectmilestone')}}">Milestone</a>
                            <a class="dropdown-item" href="{{url('admin/projectcostplan')}}">Project Cost Plan</a>
                            <a class="dropdown-item" href="{{url('admin/projectresourceplan')}}">Project Resource Plan</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>	
                {!! Form::open(array('route'=>array('projectmilestone.create'),'method'=>'post', 'id' => 'projectmilestoneform')) !!} 

                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Project Management</a>
                            </li>
                            <li>
                                <a href="{{url('admin/projectmilestone')}}">Milestone Dashboard</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($projectmilestone) && $projectmilestone->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Milestone
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($projectmilestone) && $projectmilestone->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Milestone
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Milestone ID:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('milestone_Id',$rand_number,array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Milestone Id','readonly'))!!}
                                                @if($errors->has('milestone_Id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('milestone_Id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Milestone name <span class="required">*:</span></label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <input type="text" placeholder="Milestone name" id="milestone_name" name="milestone_name" value="<?php
                                                if (isset($projectmilestone)) {
                                                    echo $projectmilestone->milestone_name;
                                                }
                                                ?>"  class="form-control border-radius-0">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Milestone Type:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('milestone_type',$mile,isset($projectmilestone->milestone_type) ? $projectmilestone->milestone_type : '',array('class'=>'form-control select2','placeholder'=>'Please select milestonetype','id'=>'milestone_type'))!!}  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Id*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <select class="form-control select2" name="project_id" id="ProjectListGet"  data-live-search="true">
                                                <option value="" selected> Please select </option>
                                                @foreach($project_id as $projectList)
                                                <option value="{{$projectList['id']}}" class="">{{$projectList['project_Id']}} ( {!! \Illuminate\Support\Str::words($projectList['project_name'], 5,'....')  !!} )
                                                </option>
                                                @endforeach
                                            </select>
                                            <!--{!!Form::select('project_id',$project_id,'',array('class'=>'form-control select2','placeholder'=>'Please select project id','id'=>'projectid'))!!}-->  
                                            @if($errors->has('project_id')) 
                                            <div style='color:red'>
                                                {{ $errors->first('project_id') }}
                                            </div> 
                                            @endif

                                        </div>
                                        <span id="project_nameDesc" class="col-sm-1 ddplace" > </span>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phase Id*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <select class="form-control select2" name="phase_id" id="PhaseIdSet" data-live-search="true">
                                                <option value="" selected> Please select </option>
                                                <!--                                                @foreach($phase_id as $phaseList)
                                                                                                <option value="{{$phaseList['id']}}">{{$phaseList['phase_Id']}} ( {!! \Illuminate\Support\Str::words($phaseList['phase_name'], 5,'....')  !!} )</option>
                                                                                                @endforeach-->
                                            </select>
                                            <!--{!!Form::select('phase_id',$phase_id,'',array('class'=>'form-control select2','placeholder'=>'Please select phase id','id'=>'phaseid'))!!}-->  
                                            <!--                                            @if($errors->has('phase_id')) 
                                                                                        <div style='color:red'>
                                                                                            {{ $errors->first('phase_id') }}
                                                                                        </div> 
                                                                                        @endif-->
                                        </div>
                                        <span id="phase_name" class="col-sm-1 ddplace" > </span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task Id:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <select class="form-control select2" name="task_id" id="TaskIdSet" data-live-search="true">
                                                <option value="" selected> Please select </option>
                                                <!--                                                @foreach($task_id as $taskList)
                                                                                                <option value="{{$taskList['id']}}">{{$taskList['task_Id']}} ( {!! \Illuminate\Support\Str::words($taskList['task_name'], 5,'....')  !!} )</option>
                                                                                                @endforeach-->
                                            </select>
                                            <!--{!!Form::select('task_id',$task_id,'',array('class'=>'form-control select2','placeholder'=>'Please select task id','id'=>'taskid'))!!}-->  
                                            @if($errors->has('task_id')) 
                                            <div style='color:red'>
                                                {{ $errors->first('task_id') }}
                                            </div> 
                                            @endif
                                        </div>
                                        <span id="setTaskName" class="col-sm-1 ddplace"></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('start_date',isset($milestone->start_date) ? $milestone->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('start_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Finish date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('finish_date',isset($milestone->finish_date) ? $milestone->finish_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select finish date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('finish_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('finish_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Fixed date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('fixed_date',isset($milestone->fixed_date) ? $milestone->fixed_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select fixed date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('actual_date',isset($milestone->actual_date) ? $milestone->actual_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select actual date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Scheduled date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('schedule_date',isset($milestone->schedule_date) ? $milestone->schedule_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select scheduled date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Billing Plan %:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group">
                                                    {!!Form::text('billingplan_date',isset($milestone->billingplan_date) ? $milestone->billingplan_date : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter billing percentage'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="fa fa-percent"></i> </span>
                                                </label>  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Progress %:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group">
                                                    {!!Form::text('progress_date',isset($milestone->progress_date) ? $milestone->progress_date : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter progress percentage'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="fa fa-percent"></i> </span>
                                                </label>  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Event Reminder Date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('event_date',isset($milestone->event_date) ? $milestone->event_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select schedule date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">     
                                            <select class="form-control select2">
                                                <option value="inactive">In Progress</option>
                                                <option value="active">Complete</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!!Form::hidden('created_by',$created_by,array('class'=>'form-control'))!!}
                        <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">

                        <div class="card-footer card-footer-box text-right">
                            <button type="submit" class="btn btn-primary card-btn">Submit</button>
                            <a href="{{url('admin/projectmilestone')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div> 
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section> 
<script  type="text/javascript">
    $(document).ready(function () {

        $('#milestone_type').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#ProjectListGet').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#PhaseIdSet').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#taskid').select2({
        }).on('change', function () {
            $(this).valid();
        });

    });
</script>

@endsection