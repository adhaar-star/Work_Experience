@extends('layout.adminlayout')
@section('title','Project Progress Calculation | Project Progress')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
@if(Session::has('error_message'))
<div class="alert alert-danger">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('error_message') !!}</em>
</div>
@endif
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/project_working_days.js') !!}
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="margin-bottom-50">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <span>Project Progress</span>
                    </li>
                    <li>
                        <span>Project Progress Calculation</span>
                    </li>
                </ul>
            </div>
            <form name="progress_calculation" id="progress_calculation" method="post" action="<?php
            echo url('admin/project_progress/calculation/');
            ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="margin-bottom-50">
                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header bg-lightcyan">
                            <h4 class="margin-0">
                                Project Progress Calculation
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select Project:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('project_id',$projects,'',array('class'=>'form-control select2 ','placeholder'=>'Please select Project','id'=>'project_id'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('project_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Start date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                <label name='start_date' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{isset($start_date)?$start_date:''}}
                                                </label>
                                                @if($errors->has('start_date')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Planned progress %:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon">
                                                <label name='planned_progress' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{isset($planned_progress)?intval($planned_progress):''}}    
                                                </label>
                                            </div>
                                            @if($errors->has('planned_progress')) 
                                            <div class='text-danger'>
                                                {{ $errors->first('planned_progress') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Planned costs (PC):</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='weekends' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($planned_cost)?$planned_cost:''}}
                                                </label>

                                                @if($errors->has('weekends')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('weekends') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">BCWS (PV):</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='BCWS' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($BCWS)?$BCWS:''}}
                                                </label>

                                                @if($errors->has('BCWS')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('BCWS') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">ACWP:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='ACWP' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($ACWP)?$ACWP:''}}
                                                </label>

                                                @if($errors->has('ACWP')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('ACWP') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Schedule Variance:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='schedule_variance' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($schedule_variance)?$schedule_variance:''}}
                                                </label>

                                                @if($errors->has('schedule_variance')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('schedule_variance') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Calculation Method:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('calculation_method',['0'=>'Physical Progress','1'=>'Cost Proportional'],'',array('class'=>'form-control select2 ','placeholder'=>'Select Actual Progress Calculation Method','id'=>'project_id'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('project_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project end date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='end_date' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($end_date)?$end_date:''}}
                                                </label>

                                                @if($errors->has('end_date')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Actual progress %:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='actual_progress' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($actual_progress)?$actual_progress:''}}
                                                </label>

                                                @if($errors->has('actual_progress')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('actual_progress') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Actual costs (AC):</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='total_days' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($actual_cost)?$actual_cost:''}}
                                                </label>

                                                @if($errors->has('weekends')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('weekends') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">BCWP (EV):</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='BCWP' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($BCWP)?$BCWP:''}}
                                                </label>

                                                @if($errors->has('BCWP')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('BCWP') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Cost variance:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='cost_variance' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($cost_variance)?$cost_variance:''}}
                                                </label>

                                                @if($errors->has('cost_variance')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('cost_variance') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Value Index:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='value_index' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($value_index)?$value_index:''}}
                                                </label>

                                                @if($errors->has('value_index')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('value_index') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="card-footer card-footer-box">
        <div class='error-message' style='display:none;'> </div>    
        <div class="text-right">
            @if (RoleAuthHelper::hasAccess('projectprogress.calculations.create')!=true)
            <button type="button" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">Execute</button>
            @else
            <button type="submit" class="btn btn-primary">
                Execute
            </button>
            @endif
            &nbsp;
            <button type="button" onclick="saveCalculation(this)" class="btn btn-warning">
                Save
            </button>
            &nbsp;
            <a href="{{url('/admin/project_progress/calculation')}}" class="btn btn-danger">Cancel</a>
        </div>     


    </div>
</form>           
</div>
</div>
</section>
<script type="text/javascript">

  function saveCalculation(evt) {

      var data = $('#progress_calculation').serialize();
      $.ajax({
          type: "GET",
          url: "/admin/project_progress/calculation/store/",
          data: data,
          success: function (response) {
              if (response.status == 'ok')
              {
                  location.href = '/admin/project_progress/calculation/';
              }
              else {
                  alert('Error occured while saving progress calculation....');
              }
          }
      });
  }
</script>

@endsection