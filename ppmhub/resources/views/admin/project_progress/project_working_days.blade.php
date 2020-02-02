@extends('layout.adminlayout')
@section('title','Working Days | Project Progress')
@section('body')
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
                        <span>Project Working Days</span>
                    </li>
                </ul>
            </div>
            <form id="working_days_form" method="post" action="<?php
            echo url('admin/project_progress/working_days/');
            ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="margin-bottom-50">
                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header bg-lightcyan">
                            <h4 class="margin-0">
                                Project Working Days 
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Start Date*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('start_date',isset($taskassignment)?$taskassignment['start_date']:date('Y-m-d',strtotime('now')),array('class'=>'form-control border-radius-0 datepicker-only-init start','placeholder'=>'Please select start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="start"></p>
                                                @if($errors->has('start_date')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for='l33'>Select Country*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon" >
                                                {!!Form::select('country',$country,isset($taskassignment['country']) ? $taskassignment['country'] : '',array('class'=>'form-control select2 ','placeholder'=>'Please select Country','id'=>'country'))!!}  
                                                @if($errors->has('country')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('country') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">No of Public Holidays:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                <label name='working_days' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{isset($data['public_holiday'])?$data['public_holiday']:''}}
                                                </label>
                                                @if($errors->has('public_holidays')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('public_holidays') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">No of Working days:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon">
                                                <label name='working_days' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{isset($data['project_duration'])?intval($data['project_duration'] - $data['public_holiday']):''}}    
                                                </label>
                                            </div>
                                            @if($errors->has('working_days')) 
                                            <div class='text-danger'>
                                                {{ $errors->first('woroking_days') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33"> End Date*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('end_date',isset($taskassignment)?$taskassignment['end_date']:date('Y-m-d',strtotime('1 month')),array('class'=>'form-control border-radius-0 datepicker-only-init end','placeholder'=>'Please select end date'))!!}                                               
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="end"></p>
                                                @if($errors->has('end_date')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select State:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('state',$state,isset($taskassignment['state']) ? $taskassignment['state'] : '',array('class'=>'form-control select2 ','placeholder'=>'Please select State','id'=>'state'))!!}  
                                                @if($errors->has('state')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('state') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">No of Weekends:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='weekends' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($data['weekends'])?$data['weekends']:''}}
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
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Total Days:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label name='total_days' class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">
                                                    {{ isset($data['total'])?$data['total']:''}}
                                                </label>

                                                @if($errors->has('weekends')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('weekends') }}
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
    <div class="card-footer card-footer-box text-right">
        <button type="submit" class="btn btn-primary card-btn">
            @if(isset($taskassignment))
            Get Data
            @else
            Submit
            @endif 
        </button>
        <a href="{{url('admin/taskassign')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
    </div>                 
</form>           
</div>
</div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        if (($('#emailError').html() != undefined || $('#emailError').html() != 'undefined') && $('#country').val() != "") {
            //getStateList(parseInt($('#country').val()));
        }
    });
    $('#country').on('change',function () {
        var countryID = $(this).val();
        if (countryID) {
            getStateList(countryID);
        }
    });
    $('#state').select2({
    }).on('change', function () {
        $(this).valid();
    });

    $('#country').select2({
    }).on('change', function () {
        $(this).valid();
    });

    function getStateList(countryId) {
        $.ajax({
            type: "GET",
            url: "/admin/api/state/" + countryId,
            success: function (response) {
                $("#state").html('');
                var stateOptions = '<option value="">Please select state</option>';
                if (response.status) {
                    $.each(response.results, function (stateKey, stateVal) {
                        stateOptions += '<option value="' + stateVal.state_name + '">' + stateVal.state_name + '</option>';
                    })
                }

                $('#state').html(stateOptions);
            }
        });
    }
</script>

@endsection