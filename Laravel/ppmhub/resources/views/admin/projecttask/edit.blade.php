@extends('layout.adminlayout')
@section('title','Project | Edit Task')
@section('body')

<!-- Vendor -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/task_validation.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if(isset($projecttask->id))
                {!! Form::open(array('route'=>array('task.update',$projecttask->id),'method' => 'put','id' => 'Projecttaskform')) !!}
                @endif

                <div class="margin-bottom-50">                   
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                        </li>
                        <li>
                            <a href="{{url('admin/projecttask')}}">Project Task dashboard</a>
                        </li>
                        <li>
                            <span>

                                Edit Project Task
                            </span>
                        </li>
                    </ul>

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
                </div>
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan">
                        <h4 class="margin-0">Edit Project Task</h4>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task ID*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('task_Id',isset($projecttask->task_Id) ? $projecttask->task_Id : $rand_number,array('class'=>'form-control border-radius-0','readonly'))!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>	

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task Name*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">

                                                {!!Form::text('task_name',isset($projecttask->task_name) ? $projecttask->task_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter task name'))!!}
                                                @if($errors->has('task_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('task_name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task Type*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('task_type',array('Type 1'=>'Type 1','Type 2'=>'Type 2','Type 3'=>'Type 3'),isset($projecttask->task_type) ? $projecttask->task_type : '',array('class'=>'form-control select2','placeholder'=>'Please select task type','id'=>'task_type'))!!}  
                                                @if($errors->has('task_type')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('task_type') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Project Id*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('project_id',$project_id,isset($projecttask->project_id) ? $projecttask->project_id : '',array('class'=>'form-control select2','placeholder'=>'Please select project id','id'=>'projectid'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('project_id') }}
                                                </div> 
                                                @endif
                                            </div>                                         
                                        </div>
                                        <?php if (isset($projecttask)) { ?>
                                            <div  id="pname" name='project_name'  class="col-sm-2 padding-top-10"></div>
                                        <?php } else { ?>
                                            <div  id="pname" name='project_name'  class="col-sm-2 padding-top-10"></div>
                                        <?php } ?>
                                    </div>	
                                </div>




                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Phase Id*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('phase_id',$phase_id,isset($projecttask->phase_id) ? $projecttask->phase_id : '',array('class'=>'form-control select2','placeholder'=>'Please select phase id','id'=>'phaseid'))!!}  
                                                @if($errors->has('phase_id')) 

                                                <div style='color:red'>
                                                    {{ $errors->first('phase_id') }}
                                                </div> 
                                                @endif   
                                            </div>
                                        </div>
                                        <?php if (isset($projecttask)) { ?>
                                            <div  id="phname" name='phase_name'  class="col-sm-2 padding-top-10"></div>
                                        <?php } else { ?>
                                            <div  id="phname" name='phase_name'  class="col-sm-2 padding-top-10"></div>
                                        <?php } ?>

                                    </div>	
                                </div>



                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Superior Task:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('sub_task_id',$task_id,isset($projecttask->sub_task_id) ? $projecttask->sub_task_id : '',array('class'=>'form-control select2','placeholder'=>'Please select superior task id','id'=>'taskid'))!!}  
                                                @if($errors->has('sub_task_id')) 

                                                <div style='color:red'>
                                                    {{ $errors->first('sub_task_id') }}
                                                </div> 
                                                @endif  
                                            </div>
                                        </div>
                                        <?php if (isset($projecttask)) { ?>
                                            <div  id="tname" name='task_name'  class="col-sm-2 padding-top-10"></div>
                                        <?php } else { ?>
                                            <div  id="tname" name='task_name'  class="col-sm-2 padding-top-10"></div>
                                        <?php } ?>
                                    </div>
                                </div>



                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start date*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">

                                            <div class="form-input-icon">
                                                <label class="input-group border-radius-0 datepicker-only-init">
                                                    {!!Form::text('start_date',isset($projecttask->start_date) ? $projecttask->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init start','placeholder'=>'Please select  start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="start"></p>
                                                @if($errors->has('start_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('start_date') }}
                                                </div> 
                                                @endif
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">End Date*:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('end_date',isset($projecttask->end_date) ? $projecttask->end_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init end','placeholder'=>'Please select  end date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="end"></p>
                                                @if($errors->has('end_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>	
                                </div>




                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual Start date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('a_start_date',isset($projecttask->a_start_date) ? $projecttask->a_start_date : '',array('class'=>'form-control datepicker-only-init','placeholder'=>'Please select Actual start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('a_start_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('a_start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>	
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual Finish date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('a_end_date',isset($projecttask->a_end_date) ? $projecttask->a_end_date : '',array('class'=>'form-control datepicker-only-init','placeholder'=>'Please select Actual end date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('a_end_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('a_end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>	
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Earliest Start date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('e_start_date',isset($projecttask->e_start_date) ? $projecttask->e_start_date : '',array('class'=>'form-control datepicker-only-init','placeholder'=>'Please select Earliest start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('e_start_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('e_start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>	
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Earliest Finish date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('e_end_date',isset($projecttask->e_end_date) ? $projecttask->e_end_date : '',array('class'=>'form-control datepicker-only-init','placeholder'=>'Please select Earliest end date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('e_end_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('e_end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>	
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Latest Start date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('l_start_date',isset($projecttask->l_start_date) ? $projecttask->l_start_date :'',array('class'=>'form-control datepicker-only-init','placeholder'=>'Please select Latest start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('l_start_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('l_start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>	
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Latest Finish date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('l_end_date',isset($projecttask->l_end_date) ? $projecttask->l_end_date :'',array('class'=>'form-control datepicker-only-init','placeholder'=>'Please select Latest end date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('l_end_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('l_end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>	
                                </div> 

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Predecessor Task:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('pre_task_id',$task_id,isset($projecttask->pre_task_id) ? $projecttask->pre_task_id : '',array('class'=>'form-control select2','placeholder'=>'Please select predecessor task id','id'=>'pre_taskid'))!!}  
                                            </div>
                                        </div>
                                        <div  id="taskname" name='task_name'  class="col-sm-2 padding-top-10"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Successor Task:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('successor_task_id',$task_id,isset($projecttask->successor_task_id) ? $projecttask->successor_task_id : '',array('class'=>'form-control select2','placeholder'=>'Please select successor task id','id'=>'successor_taskid'))!!}  
                                            </div>
                                        </div>
                                        <div  id="task_name" name='task_name'  class="col-sm-2 padding-top-10"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Duration:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('duration',isset($projecttask->duration) ? $projecttask->duration :'',array('class'=>'form-control','placeholder'=>'Please enter duration'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Duration Unit:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('duration_unit',$capacity,$projecttask->duration_unit,array('class'=>'form-control select2','placeholder'=>'Please select duration unit','id'=>'duration'))!!}  
                                                @if($errors->has('duration_unit')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('duration_unit') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Created By:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <input type="text" class="form-control border-radius-0" placeholder="Created By"  value="<?php
                                                if (isset($projecttask)) {
                                                    echo $created_by->name;
                                                }
                                                ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <?php
                                        if (isset($projecttask)) {
                                            $phpdate1 = strtotime($projecttask->created_date);
                                            $created_on = date('d-m-Y', $phpdate1);
                                            $phpdate2 = strtotime($projecttask->modified_date);
                                            if($phpdate2 != null)
                                            {
                                            $changed_on = date('d-m-Y',$phpdate2);
                                            }
                                        }
                                        ?>   
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Created On:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <input type="text" class="form-control border-radius-0" placeholder="Created On" value="<?php
                                                if (isset($projecttask)) {
                                                    echo $created_on;
                                                }
                                                ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Changed On:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('changed_on',isset($changed_on) ? $changed_on : '',array('class'=>'form-control border-radius-0','placeholder'=>'Changed On','readonly'))!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Changed By:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('changed_by',isset($changed_by->name) ? $changed_by->name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Changed By','readonly'))!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>	

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('status',array('Created'=>'Created','In Progress'=>'In Progress','Completed'=>'Completed'),$projecttask->status,array('class'=>'form-control select2','placeholder'=>'Please select  status','id'=>'status'))!!}  
                                            @if($errors->has('status')) 
                                            <div style='color:red'>
                                                {{ $errors->first('status') }}
                                            </div> 
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">% Weighting Factor:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('weighting_factor',isset($projecttask->weighting_factor) ?  $projecttask->weighting_factor :'',array('class'=>'form-control','placeholder'=>'Please enter Weighting Factor','id'=>'weighting_factor' ))!!}  
                                            </div>
                                            @if($errors->has('weighting_factor')) 
                                            <div style='color:red'>
                                                {{ $errors->first('weighting_factor') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">% Completion:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('completion',isset($projecttask->completion) ?  $projecttask->completion :'',array('class'=>'form-control','placeholder'=>'Please enter completion','id'=>'completion'))!!}  
                                            </div>
                                            @if($errors->has('completion')) 
                                            <div style='color:red'>
                                                {{ $errors->first('completion') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Total Demand:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('total_demand',isset($projecttask->total_demand) ? $projecttask->total_demand :'',array('class'=>'form-control','placeholder'=>'please enter total demand'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Confirmed Work:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('confirmed_work',isset($projecttask->confirmed_work) ? $projecttask->confirmed_work :'',array('class'=>'form-control','placeholder'=>'please enter confirmed work'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Remaining Work:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('remaining_work',isset($projecttask->remaining_work) ? $projecttask->remaining_work :'',array('class'=>'form-control','placeholder'=>'please enter remaining work'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Planned Cost:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('planned_cost',isset($Net_Total) ? $Net_Total :'',array('class'=>'form-control','placeholder'=>'Planned Cost','readonly'=>'true'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Actual Cost:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('actual_cost',isset($actual_cost) ? $actual_cost :'' ,array('class'=>'form-control','placeholder'=>'Actual Cost','readonly'=>'true'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Role Assignment:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('role_assignment',isset($projecttask->role_assignment) ? $projecttask->role_assignment :'',array('class'=>'form-control','placeholder'=>'role assignment','readonly'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Resource Name:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('resource_name',isset($projecttask->resource_name) ? $projecttask->resource_name :'',array('class'=>'form-control','placeholder'=>'resource name','readonly'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Role Start Date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('r_start_date',isset($projecttask->r_start_date) ? $projecttask->r_start_date :'',array('class'=>'form-control','placeholder'=>'role start date','readonly'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Role End Date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('r_end_date',isset($projecttask->r_end_date) ? $projecttask->r_end_date :'',array('class'=>'form-control','placeholder'=>'role end date','readonly'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Worked Assigned:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('work_assigned',isset($projecttask->work_assigned) ? $projecttask->work_assigned :'',array('class'=>'form-control','placeholder'=>'work assigned','readonly'))!!}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Person Responsible:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('persion_responsible',$responsible_person,isset($projecttask->persion_responsible) ? $projecttask->persion_responsible : '',array('class'=>'form-control select2','placeholder'=>'Please select person responsible','id'=>'person_responsible'))!!}  
                                                @if($errors->has('person_responsible')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('persion_responsible') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($projecttask->created_by) && (!empty($projecttask->created_by))) {
                        ?>  <input type="hidden" id="modified_by" name="modified_by" value="<?php echo Auth::user()->id; ?>" required="required" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="modified_date" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <?php } else { ?>
                        <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->id; ?>" required="required" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">

                    <?php } ?>

                    <div class="card-footer card-footer-box text-right">
                        @if(!isset($vendor))
                        {!! Form::submit('Save',array('class'=>'btn btn-primary card-btn')) !!}  
                        @else
                        {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn')) !!}  

                        @endif
                        <a href="{{url('/admin/projecttask')}}" class="btn btn-danger">Cancel</a>
                    </div>
                </div> 
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</section>
<script type="text/javascript">
    $('#mask').show();
    $(document).ready(function () {

        $('#task_type').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#project_id').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#phase_id').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#task_id').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#status').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#projectid').change(function (e) {
            var data = $(this).val();
            $.ajax({
                url: "{{ url('admin/getpname') }}/",
                type: 'GET',
                dataType: 'json',
                data: {'project_Id': data},
                success: function (data)
                {

                    if (data.phase) {
                        $('#phaseid,#taskid').empty();
                        $('#taskid').append('<option value="" disabled selected="selected">Please select task</option>');
                        $('#phaseid').append('<option value="" disabled selected="selected">Please select phase</option>');

                        $.each(data.phase, function (key, value) {
                            $('#phaseid').append('<option value=' + key + '>' + value + '</option>');
                        });
                    }
                }
            });
        });

        $('#phaseid').change(function (e) {
            var data = $(this).val();
            $.ajax({
                url: "{{ url('admin/getphname') }}/",
                type: 'GET',
                dataType: 'json',
                data: {'phase_id': data},
                success: function (data)
                {
                    if (data.task) {
                        $('#taskid').empty();
                        $('#taskid').append('<option value="" disabled selected="selected">Please select task</option>');
                        $.each(data.task, function (key, value) {
                            $('#taskid').append('<option value=' + key + '>' + value + '</option>');
                        });
                    }
                }
            });

        });


    });
</script>
<script>

</script>
@endsection

