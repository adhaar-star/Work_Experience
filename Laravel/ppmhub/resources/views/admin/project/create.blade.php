@extends('layout.adminlayout')

<?php if (isset($project) && $project->id) { ?>
    @section('title','Project | Edit Project')
<?php } else { ?>
    @section('title','Project | Create Project')
<?php } ?>
@section('body')
@if(Session::has('limit_exceed'))
<div class="alert alert-danger mesg">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('limit_exceed') !!}</em>
</div>
@endif
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/project.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">
                    <div class="row PageTitleGlobal margin-bottom-50">
                        <div class="col-md-3">
                            <h1>Project</h1>
                        </div>
                        <div class="col-md-9 text-right">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li><a href="{{url('admin/dashboard')}}">Project Management</a></li>
                                <li><a href="{{url('admin/project')}}">Project dashboard</a></li>
                                <li><span>
                                        @if(isset($project) && $project->id)
                                        Edit
                                        @else
                                        Create
                                        @endif 
                                        Project 
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>


                @if(isset($project) && $project->id) 
                {!! Form::model($project, array('class' => 'form-horizontal form-label-left', 'id' => 'projectstypeform', 'method' => 'PATCH', 'route' => array('project.update', $project->id))) !!}
                @else 
                {!! Form::open(array('route' => 'project.create', 'id' => 'projectstypeform', 'class' => 'form-horizontal form-label-left')) !!} 
                @endif   

                {{ csrf_field() }}
                @if(isset($project) && $project->id)
                {{ method_field('PUT') }}
                @endif 
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan">
                        <h4 class="margin-0">
                            @if(isset($project) && $project->id)
                            Edit
                            @else
                            Create
                            @endif 
                            Project                             
                            <small class="pull-right"><span class="text-danger">*</span>Mandatory fields</small>
                        </h4>
                        <!-- Vertical Form -->
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Portfolio ID<span class="text-danger">*</span>:<span class="required"></span></label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <?php if (isset($project)) { ?>
                                            {!! Form::select('portfolio_id',$ptype, old('portfolio_id', $project->portfolio_id), array('class'=>'select2','placeholder'=>'Please select portfolio','id'=>'port_id')) !!}
                                        <?php } else { ?>
                                            {!! Form::select('portfolio_id',$ptype, old('portfolio_id'), array('class'=>'select2','placeholder'=>'Please select portfolio','id'=>'port_id')) !!}	
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Bucket ID<span class="text-danger">*</span>: <span class="required"></span></label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <?php if (isset($project)) { ?>
                                            {!! Form::select('bucket_id',$lower_bucket,$project->bucket_id, array('class'=>'select2','id'=>'bucket_id','placeholder'=>'Please select bucket')) !!}
                                        <?php } else { ?>
                                            {!! Form::select('bucket_id',[],'', array('class'=>'select2','id'=>'bucket_id')) !!}	
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project ID: </label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <input type="text" data-validation="[NOTEMPTY]" placeholder="Project Id" id="project_Id" name="project_Id"  readonly="true" value="<?php
                                            if (isset($project)) {
                                                echo $project->project_Id;
                                            } else {
                                                echo $prjId;
                                            }
                                            ?>" class="form-control border-radius-0" <?php
                                                   if (isset($project)) {
                                                       "readonly";
                                                   }
                                                   ?> maxlenght="6" >
                                        </div>
                                    </div>
                                </div>
                                @if(isset($project->start_date)) 
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Category: <span class="required"></span></label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            {!!Form::select('category',$category,isset($project->category) ? $project->category : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select category','id'=>'category'))!!}  
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Description<span class="text-danger">*</span>:</label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            {!!Form::textarea('project_desc',isset($project->project_desc) ? $project->project_desc : '',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter project description','maxlength'=>'255','rows'=>'4'))!!}                                    
                                            @if($errors->has('project_desc')) 
                                            <div class="text-danger">
                                                {{ $errors->first('project_desc') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (isset($project->start_date) && (!empty($project->start_date))) {
                                    ?> 
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Commentary:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('project_commentary',isset($project->project_commentary) ? $project->project_commentary : '',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter project commentary','maxlength'=>'255'))!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Location<span class="text-danger">*</span>:<span class="required"></span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($project)) { ?>
                                                {!! Form::select('location_id', $location, old('location_id', $project->location_id), array('class'=>'select2','id'=>'location')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('location_id', $location, old('location_id'), array('class'=>'select2','id'=>'location')) !!}	
                                            <?php } ?>
                                            @if($errors->has('location_id')) 
                                            <div class="text-danger">
                                                {{ $errors->first('location_id') }}
                                            </div> 
                                            @endif
                                        </div>			
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Cost Centre<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($project)) { ?>
                                                {!! Form::select('cost_centre',$cost_centre, old('cost_centre', $project->cost_centre), array('class'=>'select2','id'=>'cost_centre')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('cost_centre',$cost_centre, old('cost_centre'), array('class'=>'select2','id'=>'cost_centre')) !!}	
                                            <?php } ?>  
                                            @if($errors->has('cost_centre')) 
                                            <div class="text-danger">
                                                {{ $errors->first('cost_centre') }}
                                            </div> 
                                            @endif
                                        </div>			
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Factory Calendar:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <?php if (isset($project)) { ?>
                                                    {!! Form::select('factory_calendar',$factorycalendar, old('factory_calendar', $project->factory_calendar), array('class'=>'select2')) !!}
                                                <?php } else { ?>
                                                    {!! Form::select('factory_calendar',$factorycalendar, old('factory_calendar'), array('class'=>'select2')) !!}	
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Department<span class="text-danger">*</span>: </label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($project)) { ?>
                                                {!! Form::select('department',$department, old('department', $project->department), array('class'=>'select2','id'=>'department')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('department',$department, old('department'), array('class'=>'select2','id'=>'department')) !!}	
                                            <?php } ?> 
                                            @if($errors->has('department')) 
                                            <div class="text-danger">
                                                {{ $errors->first('department') }}
                                            </div> 
                                            @endif                                                    
                                        </div>			
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Person Responsible:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <?php if (isset($project)) { ?>
                                                    {!! Form::select('person_responsible',$personresponsible, old('person_responsible', $project->person_responsible), array('class'=>'select2')) !!}
                                                <?php } else { ?>
                                                    {!! Form::select('person_responsible',$personresponsible, old('person_responsible'), array('class'=>'select2')) !!}	
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Currency:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($project)) { ?>
                                                {!! Form::select('currency', $currency, old('currency',$project->currency), array('class'=>'select2 form-control')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('currency', $currency, old('currency'), array('class'=>'select2')) !!}	
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Quality:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!! Form::select('quality', ['0'=>'Red','1'=>'Green','2'=>'Yellow'],isset($project->quality) ? $project->quality : '', array('class'=>'select2 form-control','placeholder'=>'Please select quality')) !!}
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-12 col-sm-6"  id='set-width-planned'>
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Portfolio Type:</label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <?php if (isset($project)) { ?>
                                            {!! Form::text('portfolio_type',$project->portfolio_type, array('class'=>'form-control border-radius-0','id'=>'portfoliotype','readonly')) !!}
                                        <?php } else { ?>
                                            {!! Form::text('portfolio_type','', array('class'=>'form-control border-radius-0','id'=>'portfoliotype','readonly')) !!}	
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Type<span class="text-danger">*</span>: <span class="required"></span></label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <?php if (isset($project)) { ?>
                                                {!! Form::select('project_type',$projectType, old('project_type', $project->project_type), array('class'=>'select2','id'=>'ptype')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('project_type',$projectType, old('project_type'), array('class'=>'select2','id'=>'ptype')) !!}	
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Name<span class="text-danger">*</span>:</label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <input type="text" data-validation="[NOTEMPTY]" placeholder="Please enter project name" id="project_name" name="project_name" value="<?php
                                            if (isset($project)) {
                                                echo $project->project_name;
                                            }
                                            ?>" class="form-control border-radius-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start date<span class="text-danger">*</span>:</label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <label class="input-group datepicker-only-init"> 
                                                {!!Form::text('start_date',isset($project->start_date) ? $project->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init start','placeholder'=>'Please select  start date'))!!}
                                                <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                            </label>
                                            <p id="start"></p>
                                            @if($errors->has('start_date')) 
                                            <div class="text-danger">
                                                {{ $errors->first('start_date') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($project->start_date) && (!empty($project->start_date))) {
                                    ?> 
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">End date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon border-radius-0">
                                                <label class="input-group datepicker-only-init">
                                                    <input type="text" placeholder="End Date" id="end_date" name="end_date" value="<?php
                                                    if (isset($project)) {
                                                        echo $project->end_date;
                                                    }
                                                    ?>" required="required" class="form-control datepicker-only-init end">
                                                    <span class="input-group-addon"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="end"></p>
                                                @if($errors->has('end_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual Start date<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    <input type="text" placeholder="Actual Start Date" id="a_start_date" name="a_start_date" value="<?php
                                                    if (isset($project)) {
                                                        echo $project->a_start_date;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0 datepicker-only-init a_start">
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="a_start"></p>
                                                @if($errors->has('a_start_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('a_start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual End date<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    <input type="text" placeholder="Actual End Date" id="a_end_date" name="a_end_date" value="<?php
                                                    if (isset($project)) {
                                                        echo $project->a_end_date;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0 datepicker-only-init a_end">
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="a_end"></p>
                                                @if($errors->has('a_end_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('a_end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Forecast Start date<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    <input type="text" placeholder="Forecast Start Date" id="f_start_date" name="f_start_date" value="<?php
                                                    if (isset($project)) {
                                                        echo $project->f_start_date;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0 datepicker-only-init f_start">
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="f_start"></p>
                                                @if($errors->has('f_start_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('f_start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Forecast End date<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    <input type="text" placeholder="Forecast End Date" id="f_end_date" name="f_end_date" value="<?php
                                                    if (isset($project)) {
                                                        echo $project->f_end_date;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0 datepicker-only-init f_end">
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="f_end"></p>
                                                @if($errors->has('f_end_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('f_end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Planned Start Date<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    <input type="text" placeholder="Planned Start Date" id="p_start_date" name="p_start_date" value="<?php
                                                    if (isset($project)) {
                                                        echo $project->p_start_date;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0 datepicker-only-init p_start">
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="p_start"></p>
                                                @if($errors->has('p_start_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('p_start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Planned Finish Date<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    <input type="text" placeholder="Planned End Date" id="p_end_date" name="p_end_date" value="<?php
                                                    if (isset($project)) {
                                                        echo $project->p_end_date;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0 datepicker-only-init p_end">
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="p_end"></p>
                                                @if($errors->has('p_end_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('p_end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Schedule Date<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    <input type="text" placeholder="Schedule Date" id="sch_date" name="sch_date" value="<?php
                                                    if (isset($project)) {
                                                        echo $project->sch_date;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0 datepicker-only-init sche_date">
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="sche_date"></p>
                                                @if($errors->has('sch_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('sch_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Planned Cost (Live):</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group ">
                                                    <input type="text" placeholder="planned_cost" id="planned_cost" name="planned_cost" value="<?php
                                                    if (isset($Net_Total)) {
                                                        echo $Net_Total;
                                                    }
                                                    ?>" readonly="true" required="required" class="form-control border-radius-0">

                                                </label>
                                                <p id="p_cost"></p>
                                                @if($errors->has('planned_costal')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('planned_cost') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Estimated Cost<span class="text-danger">*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <input type="text" placeholder="Estimated Cost" id="estimated_cost" name="estimated_cost" value="<?php
                                                if (isset($project->estimated_cost)) {
                                                    echo $project->estimated_cost;
                                                }
                                                ?>" class="form-control border-radius-0 ">
                                            </div>
                                        </div>
                                        @if($errors->has('estimated_cost')) 
                                        <div class="text-danger">
                                            {{ $errors->first('estimated_cost') }}
                                        </div> 
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> % - Physical Progress:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group ">
                                                    <input type="text" placeholder="Physical Progress" id="physical_progress" name="physical_progress" value="<?php
                                                    if (isset($phy_progress)) {
                                                        echo $phy_progress;
                                                    }
                                                    ?>" readonly="true"  class="form-control border-radius-0 ">

                                                </label>
                                                <p id="phy_progress"></p>
                                                @if($errors->has('physical_progress')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('physical_progress') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id='remove-line-height'>
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label word-break wspace-n"> % - Cost Proportional Progress:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group ">
                                                    <input type="text" placeholder="Cost Proportional Progress" id="cost_progress" name="cost_progress" value="<?php
                                                    if (isset($cost_prop_progress)) {
                                                        echo $cost_prop_progress;
                                                    }
                                                    ?>" readonly="true"  class="form-control border-radius-0 ">

                                                </label>
                                                <p id="cost_progress"></p>
                                                @if($errors->has('cost_progress')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('cost_progress') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> % - Planned Progress:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group ">
                                                    <input type="text" placeholder="Planned Progress" id="Planned_progress" name="Planned_progress" value="<?php
                                                    if (isset($planned_progress)) {
                                                        echo $planned_progress['progress'];
                                                    }
                                                    ?>" readonly="true"  class="form-control border-radius-0 ">

                                                </label>
                                                <p id="cost_progress"></p>
                                                @if($errors->has('$planned_progress')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('$planned_progress') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> % - Actual Progress:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group ">
                                                    <input type="text" placeholder="Actual Progress" id="Actual_progress" name="Actual_progress" value="<?php
                                                    if (isset($actual_progress)) {
                                                        echo $actual_progress;
                                                    }
                                                    ?>" readonly="true"  class="form-control border-radius-0 ">

                                                </label>
                                                <p id="cost_progress"></p>
                                                @if($errors->has('actual_progress')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('actual_progress') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"> Scope:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!! Form::select('scope', ['0'=>'Red','1'=>'Green','2'=>'Yellow'],isset($project->scope) ? $project->scope : '', array('class'=>'select2 form-control','placeholder'=>'Please select scope')) !!}
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>  
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="btn-group" data-toggle="buttons">
                                            @if(!isset($project->status))
                                            <a class="active-bttn btn btn-primary active ">
                                                <input type="radio" id="status" name="status" value="active" checked="">
                                                Active
                                            </a>
                                            <a class="inactive-btn btn btn-danger ">
                                                <input type="radio" id="status" name="status" value="inactive" >
                                                Inactive
                                            </a>
                                            @else
                                            <a class="active-bttn btn btn-danger <?php
                                            if (isset($project) && $project->status == 'active') {
                                                echo "active";
                                            }
                                            ?>">
                                                <input type="radio" id="status" name="status" value="active" <?php
                                                if (isset($project) && $project->status == 'active') {
                                                    echo "checked";
                                                }
                                                ?>>
                                                Active
                                            </a>
                                            <a class="inactive-btn btn btn-danger <?php
                                            if (isset($project) && $project->status == 'inactive') {
                                                echo "active";
                                            }
                                            ?>">
                                                <input type="radio" id="status" name="status" value="inactive" <?php
                                                if (isset($project) && $project->status == 'inactive') {
                                                    echo "checked";
                                                }
                                                ?>>
                                                Inactive
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0;">
                            <?php
                            if (isset($project->start_date) && (!empty($project->start_date))) {
                                ?> 
                            </div>
                            <div class="row" style="margin: 0;">
                            <?php } ?>

                            <?php
                            if (isset($project->start_date) && (!empty($project->start_date))) {
                                ?>  <input type="hidden" id="modified_by" name="modified_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                            <?php } else { ?>
                                <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" id="created_at" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">

                            <?php } ?>	
                        </div>
                    </div>
                    <div class="card-footer card-footer-box text-right">
                  @if(!PlanFeatureAccessHelper::canCreateProject() && !isset($project->id))
                  <button type="button" class="btn btn-primary card-btn" data-toggle="modal" data-target="#upgradePlanModal">
                     Submit
                  </button>
                  @else
                  <button type="submit" class="btn btn-primary card-btn">
                     @if(isset($project) && $project->id)
                     Save Changes
                     @else
                     Submit
                     @endif 
                  </button>
                  @endif
                  <a href="{{url('admin/project')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
               </div>                     
               </form>
            </div>
         </div>
      </div>
   </div>
   <!--- Bootstrap Model --->
   <div id="upgradePlanModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="col-sm-6"><h5>Update subscription</h5></div>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               @php $userPlan = PlanFeatureAccessHelper::getCurrentPlan() @endphp
               @if($userPlan !== NULL)
               <p>Your current subscription is <b>{{ $userPlan->braintree_subscription_plan }}</b>. 
               <p>You have reached the project limit for this plan.</p>
               <p>Only {{$userPlan->project}} projects are allowed.</p>
               @else
               <p>Please subscribe one of the plan to create project.</p>
               @endif
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">No Thanks</button>
               <a class="btn btn-success" href="{{route('subscriptions.updatesubscription')}}">Go to Update</a>
            </div>
         </div>
      </div>
   </div>
   <!-- Bootstrap Model -->
</section>	
<script>
    $('#project').validate({
        submit: {
            settings: {
                inputContainer: '.form-group',
                errorListClass: 'form-control-error-list',
                errorClass: 'text-danger'
            }
        }
    });
    $('#ptype').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#bucket_id').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#port_id').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#location').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#cost_centre').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#department').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $(document).ready(function () {
        $('#port_id').change(function (e) {
            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getportname') }}",
                        dataType: 'json',
                        data: {'port_id': data},
                        success: function (data)
                        {
                            $('#portfolio_name').val(data.name);
                        }
                    });
        });
    });
<?php if (isset($project)) { ?>
        $(document).ready(function () {
            $('#port_id').ready(function (e) {
                var data = "<?php
    if (isset($project)) {
        echo $project->port_id;
    }
    ?>";
                $.ajax
                        ({
                            url: "{{ url('admin/getportname') }}/",
                            type: 'GET',
                            dataType: 'json',
                            data: {'port_id': data},
                            success: function (data)
                            {
                                $('#portfolio_name').val(data.name);
                            }
                        });
            });
        });
<?php } ?>
    $(document).ready(function () {
        $('#bucket_id').change(function (e) {
            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getbucket') }}",
                        dataType: 'json',
                        data: {'bucket_id': data},
                        success: function (data)
                        {
                            $('#bucket_name').val(data.name);
                        }
                    });
        });
    });
<?php if (isset($project)) { ?>
        $(document).ready(function () {

            $('#bucket_id').ready(function (e) {
                var data = "<?php
    if (isset($project)) {
        echo $project->port_id;
    }
    ?>";
                $.ajax
                        ({
                            url: "{{ url('admin/getbucket') }}/",
                            type: 'GET',
                            dataType: 'json',
                            data: {'bucket_id': data},
                            success: function (data)
                            {
                                $('#bucket_name').val(data.name);
                            }
                        });
            });
        });
<?php } ?>
</script>
<script>
    $(document).ready(function () {
        $('#port_id').change(function (e) {
            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getpdesc') }}",
                        dataType: 'json',
                        data: {'port_id': data},
                        success: function (data)
                        {
                            $('#pdesc').html('');
                            $('#portfoliotype').html('');
                            $('#pdesc').html(data.description);
                        }
                    });
        });
    });
<?php if (isset($project)) { ?>
        $(document).ready(function () {

            $('#port_id').ready(function (e) {
                var data = "<?php
    if (isset($project)) {
        echo $project->port_id;
    }
    ?>";
                $.ajax
                        ({
                            url: "{{ url('admin/getpdesc') }}/",
                            type: 'GET',
                            dataType: 'json',
                            data: {'port_id': data},
                            success: function (data)
                            {
                                $('#pdesc').html(data.description);
                            }
                        });
            });
        });
<?php } ?>
    $(document).ready(function () {
        $('#bucket_id').change(function (e) {
            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getbdesc') }}",
                        dataType: 'json',
                        data: {'bucket_id': data},
                        success: function (data)
                        {
                            $('#bdesc').html(data.description);
                        }
                    });
        });
    });
<?php if (isset($project)) { ?>
        $(document).ready(function () {
            $('#bucket_id').ready(function (e) {
                var data = "<?php
    if (isset($project)) {
        echo $project->bucket_id;
    }
    ?>";
                $.ajax
                        ({
                            url: "{{ url('admin/getbdesc') }}/",
                            type: 'GET',
                            dataType: 'json',
                            data: {'bucket_id': data},
                            success: function (data)
                            {
                                $('#bdesc').html(data.description);
                            }
                        });
            });
        });
<?php } ?>

    //get lower bucket on selection of portfolioId
    $('#port_id').change(function () {
        var id = $('#port_id').val();
        if (id != '') {
            $.ajax({
                type: 'GET',
                url: '/admin/getlowerbuckets/' + id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    //set bucket 
                    $("#bucket_id").html('');
                    var bucketOptions = '<option value="">Please select bucket</option>';
                    if (response.data) {
                        $.each(response.data, function (bucketKey, bucketVal) {
                            bucketOptions += '<option value="' + bucketVal.id + '" >' + bucketVal.name + '</option>';
                        });
                    }
                    $('#bucket_id').html(bucketOptions);
                }
            });
        }
    });
</script>
@endsection