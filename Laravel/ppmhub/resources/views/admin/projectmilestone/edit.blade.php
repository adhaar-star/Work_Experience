@extends('layout.adminlayout')
@section('title','Project | Edit Milestone')
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">                  
                @if(isset($projectmilestone->id))
                {!! Form::open(array('route'=>array('projectmilestone.update',$projectmilestone->id),'method' => 'put','id' => 'projectmilestoneform')) !!}
                @endif

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
                                    Edit Project Milestone
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">  Edit Project Milestone</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Milestone name*: <span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">This is text to display as information about the field here.</span></span><span class="required"></span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <input type="text" placeholder="Milestone name" id="milestone_name" name="milestone_name" value="<?php
                                                if (isset($projectmilestone)) {
                                                    echo $projectmilestone->milestone_name;
                                                }
                                                ?>" required="required" class="form-control border-radius-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Milestone Type: <span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">This is text to display as information about the field here.</span></span></label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('milestone_type',$mile,$projectmilestone->milestone_type,array('class'=>'form-control select2','placeholder'=>'Please select project id','id'=>'milestone_type'))!!}  
                                            @if($errors->has('milestone_type')) 
                                            <span class="text-danger">
                                                {{ $errors->first('milestone_type') }}
                                            </span> 
                                            @endif


                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Id*: <span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">This is text to display as information about the field here.</span></span></label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <select class="form-control select2" name="project_id" id="ProjectListGet" data-live-search="true">
                                                @foreach($project_id as $projectList)
                                                <option value="{{$projectList['id']}}" {{($projectList['id'] == $projectmilestone->project_id) ? 'selected': ''}} class="">{{$projectList['project_Id']}} ( {!! \Illuminate\Support\Str::words($projectList['project_name'], 5,'....')  !!} )</option>
                                                @endforeach
                                            </select>
                                            <!--{!!Form::select('project_id',$project_id,$projectmilestone->project_id,array('class'=>'form-control select2','placeholder'=>'Please select project id','id'=>'projectid'))!!}-->  
                                            @if($errors->has('project_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('project_id') }}
                                            </span> 
                                            @endif

                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-8 pull-right">
                                            <span id="project_nameDesc" > </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phase Id*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">

                                            {!!Form::select('phase_id',$phase_id,$projectmilestone->phase_id,array('class'=>'form-control select2','placeholder'=>'Please select phase id','id'=>'PhaseIdSet'))!!}  
                                            @if($errors->has('phase_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('phase_id') }}
                                            </span> 
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-8 pull-right">
                                            <span id="phase_name" > </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task Id:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">

                                            {!!Form::select('task_id',$task_id,isset($projectmilestone->task_id) ? $projectmilestone->task_id : '',array('class'=>'form-control select2','placeholder'=>'Please select task id','id'=>'TaskIdSet'))!!}  
                                            @if($errors->has('task_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('task_id') }}
                                            </span> 
                                            @endif
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-8 pull-right">
                                            <span id="setTaskName"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('start_date',$projectmilestone->start_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Start date'))!!}
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
                                                    {!!Form::text('finish_date',$projectmilestone->finish_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select finish date'))!!}
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
                                                    {!!Form::text('fixed_date',$projectmilestone->fixed_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select fixed date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('fixed_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('fixed_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('actual_date',$projectmilestone->actual_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select actual date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('actual_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('actual_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Scheduled date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('schedule_date',$projectmilestone->schedule_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Scheduled date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('schedule_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('schedule_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Event Reminder Date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('event_date',$projectmilestone->start_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Event date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('event_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('event_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Billing Plan %:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group">
                                                    {!!Form::text('billingplan_date',$projectmilestone->billingplan_date,array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Billing percent'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="fa fa-percent"></i> </span>
                                                </label>
                                                @if($errors->has('billingplan_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('billingplan_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Progress %:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group">
                                                    {!!Form::text('progress_date',$projectmilestone->progress_date,array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Progress percent'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="fa fa-percent"></i> </span>
                                                </label>
                                                @if($errors->has('progress_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('progress_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">  
                                            <select class="form-control select2" name="status">
                                                <option value="inactive" {{($projectmilestone->status == 'inactive') ? 'selected': ''}}>In Progress</option>
                                                <option value="active" {{($projectmilestone->status == 'active') ? 'selected': ''}}>Complete</option>
                                            </select>
                                            <!--                                            <div class="btn-group" data-toggle="buttons">
                                                                                            @if(!isset($projectmilestone->status))
                                                                                            <a class="active-bttn btn btn-primary active">
                                                                                                {!! Form::radio('status','active','active')!!}Active
                                                                                            </a>
                                                                                            <a class="inactive-btn btn btn-danger">
                                                                                                {!! Form::radio('status','inactive') !!}Inactive
                                                                                            </a>
                                                                                            @else
                                                                                            @if($projectmilestone->status == 'active')
                                                                                            <a class="active-bttn btn btn-primary active">
                                                                                                {!! Form::radio('status','active')!!}Active
                                                                                            </a>
                                                                                            <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                                                            @else
                                                                                            <a class="active-bttn btn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
                                                                                            <a class="inactive-btn btn btn-danger active">
                                                                                                {!! Form::radio('status','inactive') !!}Inactive
                                                                                            </a>
                                                                                            @endif
                                                                                            @endif
                                                                                        </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">

                                <input type="hidden" id="created_date" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>"  class="form-control col-md-7 col-xs-12">
                                {!!Form::hidden('modified_by',$created_by,array('class'=>'form-control'))!!}
                            </div>
                        </div>

                        <div class="card-footer card-footer-box text-right">
                            <button type="submit" class="btn btn-primary card-btn">Submit</button>
                            <a href="{{url('admin/projectmilestone')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div> 
                    </div> 
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
<script  type="text/javascript">
    $(document).ready(function () {

        $('#milestone_type').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#projectid').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#phaseid').select2({
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