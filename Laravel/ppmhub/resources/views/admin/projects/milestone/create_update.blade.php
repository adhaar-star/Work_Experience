@extends('layout.admin')
@section('title', 'Project Milestone')
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($data))
                    {!! Form::open([ 'route' => [ $route.'.update', $data->project_milestone_id ],  'method' => 'put', 'class' => 'form-horizontal GlobalFormValidation' ]) !!}
                @else
                    {!! Form::open([ 'route' => [ $route.'.store'], 'method' =>'post', 'class'=> 'form-horizontal GlobalFormValidation' ]) !!}
                @endif
                <div class="margin-bottom-50">
                    <div class="row PageTitleGlobal">
                        <div class="col-md-6"><h1>Project Milestone</h1></div>
                        <div class="col-md-6 text-right">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route( $route .'.index') }}">Milestones</a></li>
                                <li><span>@if(!empty($data))  Update @else Create @endif Milestone</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            @if(empty($data) )
                                <h4 class="margin-0">Create Milestone</h4>
                            @else
                                <h4 class="margin-0">Update Milestone</h4>
                            @endif
                        </div>
                        <div class="card-block">
                             <div class="row" style="margin: 0;">

                                <div class="col-md-6">


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Milestone No.<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('milestone_no', !empty($data) ? $data->milestone_no : $milestone_no, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter  Milestone No.',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Milestone No. Is Required',
                                                'readonly' => 'readonly'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Milestone Name<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('milestone_name', !empty($data) ? $data->milestone_name : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter  Name',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Name Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Project<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('project_id',
                                                 $projects
                                                 , !empty($data) ? $data->project_id : null, [
                                                  'data-url' => route('get-project-task-phase'),
                                                'class'=>'form-control border-radius-0 SoProjectOnChange',
                                                'placeholder'=>'Select Project',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Project Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Phase<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('phase_id',  !empty($updatePhases) ? $updatePhases : [], (!empty($data)) ? $data->phase_id : null,
                                                [ 'class'=>'form-control  border-radius-0 no-resize projectPhaseOnChangeProject', 'placeholder' => 'Select Project Phase',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Project Phase is required',
                                                 ] )!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Task:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('task_id',  !empty($updateTasks)? $updateTasks : [], (!empty($data)) ? $data->task_id : null, [
                                                    'class'=>'form-control  border-radius-0 no-resize projectTaskOnChangeProject',
                                                    'placeholder' => 'Select Project Task',
                                                 ] )!!}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Milestone Type<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('milestone_type',
                                                 [ 'billing' => 'Billing' , 'progress' => 'Progress' ]
                                                 , !empty($data) ? $data->milestone_type : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Select Milestone Type',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Milestone Type Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" style="line-height: 16px;">Billing Plan: <span style="color: rgba(255, 0, 0, 0.47);display: block; line-height: 12px; font-size: 10px;">Required if Milestone Type Billing</span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon  input-group mb-2 mb-sm-0">
                                                {!!Form::number('billing_plan', (!empty($data)) ? $data->billing_plan : null, [
                                                    'class'=>'form-control  border-radius-0 no-resize',
                                                    'max' =>100,
                                                    'min' => 1,
                                                    'step' =>'0.50',
                                                    'placeholder'=>'Billing Plan',

                                                 ] )!!}
                                                <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" style="line-height: 16px;">Progress Plan: <span style="color: rgba(255, 0, 0, 0.47);display: block; line-height: 12px; font-size: 10px;">Required if Milestone Type Progress</span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon  input-group mb-2 mb-sm-0">
                                                {!!Form::number('progress', (!empty($data)) ? $data->progress : null, [
                                                    'class'=>'form-control  border-radius-0 no-resize',
                                                    'max' =>100,
                                                    'min' => 1,
                                                    'step' =>'0.50',
                                                    'placeholder'=>'Progress Plan',

                                                 ] )!!}
                                                <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start Date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <label class="input-group datepicker-only-init">
                                                {!!Form::text('start_date',    (!empty($data)) ? $data->start_date : null, [
                                                    'class'=>'form-control  border-radius-0 no-resize datepicker-only-init',
                                                    'placeholder' => 'Select Start Date',
                                                 ] )!!}
                                                <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Finish Date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">

                                            </div>
                                            <label class="input-group datepicker-only-init">
                                                {!!Form::text('finish_date',    (!empty($data)) ? $data->finish_date : null, [
                                                    'class'=>'form-control  border-radius-0 no-resize datepicker-only-init',
                                                    'placeholder' => 'Select End Date',
                                                 ] )!!}

                                                <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                            </label>


                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Fixed date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('fixed_date',isset($data->fixed_date) ? $data->fixed_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select fixed date'))!!}
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
                                                    {!!Form::text('actual_date',isset($data->actual_date) ? $data->actual_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select actual date'))!!}
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
                                                    {!!Form::text('schedule_date',isset($data->schedule_date) ? $data->schedule_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select scheduled date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Event Reminder Date:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('event_date',isset($data->event_date) ? $data->event_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select schedule date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Milestone Status<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('status',
                                                 [ 1 => 'Completed' , 0 => 'In Progress' ]
                                                 , !empty($data) ? $data->status : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Select Milestone Status',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Milestone Status Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-lg-offset-1" style="margin-top: 10px;">
                                    @include('layout.admin_layout_include.alert_process')
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{route( $route .'.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
    {!! Html::script('vendors/formValidation/js/formValidation.min.js') !!}
    {!! Html::script('vendors/formValidation/js/framework/bootstrap.min.js') !!}
    {!! Html::script('js/globalValidationCustom.js') !!}

<script type="text/javascript">
$(document).ready(function () {
    $('.SoProjectOnChange').change( function () {
        var ProjectID = $(this).val();
        var URL = $(this).attr('data-url');
        $.ajax({
            type: "GET",
            cache: false,
            url: URL,
            data: { project_id : ProjectID },
            success: function(json){

                if(json.status == 'success'){

                    $('.projectTaskOnChangeProject').html('<option selected="selected" disabled="disabled" hidden="hidden" value="">Select Task</option>')
                    $('.projectPhaseOnChangeProject').html('<option selected="selected" disabled="disabled" hidden="hidden" value="">Select Phase</option>')

                    if($('.projectTaskOnChangeProject').length > 0){
                        $.each( json.tasks, function( key, value ) {
                            $('.projectTaskOnChangeProject').append('<option value="'+key+'">'+ value+'</option>')
                        });
                    }
                    if($('.projectPhaseOnChangeProject').length > 0) {
                        $.each(json.phase, function (key, value) {
                            $('.projectPhaseOnChangeProject').append('<option value="' + key + '">' + value + '</option>')
                        });
                    }

                } else if(json.status == 'false') {

                } else if(json.status == 'validation'){

                }
            },
            error : function(json){

            },
            dataType: "json"
        });
    });
});
</script>




@endsection