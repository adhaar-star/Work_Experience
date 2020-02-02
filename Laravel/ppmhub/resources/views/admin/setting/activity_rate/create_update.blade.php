@extends('layout.admin')
@section('title', 'Activity Rates')
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($data))
                    {!! Form::open([ 'route' => [ $route.'.update', $data->activity_rate_id ],  'method' => 'put', 'class' => 'form-horizontal GlobalFormValidation' ]) !!}
                @else
                    {!! Form::open([ 'route' => [ $route.'.store'], 'method' =>'post', 'class'=> 'form-horizontal GlobalFormValidation' ]) !!}
                @endif
                <div class="margin-bottom-50">
                    <div class="row PageTitleGlobal">
                        <div class="col-md-6">
                            <h1>Activity Rates</h1>
                        </div>
                        <div class="col-md-6 text-right">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route( $route .'.index') }}">Activity Rates</a></li>
                                <li><span>@if(!empty($data))  Update @else Create @endif  Activity Rates</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            @if(empty($data) )
                                <h4 class="margin-0">Create Activity Rate</h4>
                            @else
                                <h4 class="margin-0">Update Activity Rate</h4>
                            @endif
                        </div>
                        <div class="card-block">
                             <div class="row" style="margin: 0;">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Actual Rate<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::number('activity_actual_rate', !empty($data) ? $data->activity_actual_rate : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter  Actual Rate',
                                                    'min' => 0,
                                                    'step' =>'0.5',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Actual Rate is required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Plan Rate<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::number('activity_plan_rate', !empty($data) ? $data->activity_plan_rate : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Plan Rate',

                                                    'min' => 0,
                                                    'step' =>'0.5',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Plan Rate is required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Billing Rate:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::number('billing_rate', !empty($data) ? $data->billing_rate : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Billing Rate',
                                                    'min' => 0,
                                                    'step' =>'0.5',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Description:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('activity_rate_description', !empty($data) ? $data->activity_rate_description : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter  Description',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Description is required',


                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Validity Start<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('activity_validity_start', !empty($data) ? $data->activity_validity_start : null, [
                                                'class'=>'form-control border-radius-0  datepicker-only-init',
                                                'placeholder'=>'Enter Validity Start',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Validity Start is required',

                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Validity End<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('activity_validity_end', !empty($data) ? $data->activity_validity_end : null, [
                                                'class'=>'form-control border-radius-0  datepicker-only-init',
                                                'placeholder'=>'Enter Validity Start',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Validity End is required',

                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Cost Centre:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('cost_centre_id', $cost_centre, !empty($data) ? $data->cost_centre_id : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Select Cost Centre',

                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Cost Centre is required',

                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Activity Type:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('activity_type_id', $activity_type, !empty($data) ? $data->activity_type_id : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Select Activity Type',

                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Activity Type is required',


                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Employee:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('employee_id', $employee_data, !empty($data) ? $data->employee_id : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Select Employee',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Employee is required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">Status :</label>
                                        <div class="col-sm-3">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($data->status))
                                                    <a class="active-btn btn btn-primary active">{!! Form::radio('status', 1, true)!!}Active</a>
                                                    <a class="inactive-btn btn btn-default">{!! Form::radio('status', 0) !!}Inactive</a>
                                                @else
                                                    @if($data->status == 1)
                                                        <a class="active-btn btn btn-primary active">{!! Form::radio('status', 1, true)!!}Active</a>
                                                        <a class="inactive-btn btn btn-default">  {!! Form::radio('status', 0)!!}Inactive</a>
                                                    @else
                                                        <a class="active-btn btn btn-primary"> {!! Form::radio('status', 1)!!}Active</a>
                                                        <a class="inactive-btn btn btn-default active">{!! Form::radio('status', 0, true) !!}Inactive</a>
                                                    @endif
                                                @endif
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
@endsection