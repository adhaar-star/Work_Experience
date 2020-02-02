@extends('layout.adminlayout')
@section('title','Project | Create Role')
@section('body')



@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
@if(Session::has('flash_error'))
<div class="alert alert-danger">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_error') !!}</em>
</div>
@endif

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/createrole.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="margin-bottom-50">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Project Management</a>
                    </li>
                    <li>
                        <a href="{{url('admin/projectresourceplanning')}}">Project Resource Planning</a>
                    </li>
                    <li>
                        <a href="{{url('admin/createrole')}}">Create Roles </a>
                    </li>
                    <li>
                        <span>
                            @if(isset($createrole) && $createrole->id)
                            Edit
                            @else
                            Create
                            @endif 
                        </span>
                    </li>
                </ul>
            </div>
            <form id="Createroleform" method="post" action="<?php
            if (isset($createrole) && $createrole->id) {
                echo url('admin/createrole/' . $createrole->id);
            } else {
                echo url('admin/createrole');
            }
            ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                {{ csrf_field() }}
                @if(isset($createrole) && $createrole->id)
                {{ method_field('PUT') }}
                @endif 
                <div class="margin-bottom-0">
                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header">
                            <h4 class="margin-0">
                                @if(isset($createrole) && $createrole->id)
                                Edit
                                @else
                                Create 
                                @endif 
                                Role
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for='l33'>Select Project Id*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('project_id',$project_id,isset($createrole->project_id) ? $createrole->project_id : '',array('class'=>'form-control select2','placeholder'=>'Please select project id','id'=>'project_id'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('project_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Role Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon">
                                                {!!Form::text('role_name',isset($createrole->role_name) ? $createrole->role_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter role name'))!!}
                                                @if($errors->has('role_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role_name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Role Type*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                {!!Form::select('role_type',array('Project Manager'=>'Project Manager','Team Member'=>'Team Member','Planer'=>'Planer','Co-ordinator'=>'Co-ordinator','Accountant'=>'Accountant','Administrator'=>'Administrator','Procurement Officer'=>'Procurement Officer'),isset($createrole->role_type) ? $createrole->role_type : '',array('class'=>'form-control select2','placeholder'=>'Please select role type','id'=>'roletype'))!!}  
                                                @if($errors->has('role_type')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role_type') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Role Function*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                {!!Form::select('role_fun',array('Management'=>'Management','Developer'=>'Developer','Marketing'=>'Marketing','Procurement'=>'Procurement'),isset($createrole->role_fun) ? $createrole->role_fun : '',array('class'=>'form-control select2','placeholder'=>'Please select role function','id'=>'rolefun'))!!}  
                                                @if($errors->has('role_fun')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role_fun') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Role Description*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('description',isset($createrole->description) ? $createrole->description : '',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter role description','rows' => 3, 'cols' => 40))!!}                                    
                                                @if($errors->has('description')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('description') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Start Date*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('start_date',isset($createrole->start_date) ? $createrole->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init start','placeholder'=>'Please select  start date'))!!}
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
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">End Date*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('end_date',isset($createrole->end_date) ? $createrole->end_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init end','placeholder'=>'Please select  end date'))!!}                                               
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer card-footer-box text-right">
                    <button type="submit" class="btn btn-primary card-btn">
                        @if(isset($createrole) && $createrole->id)
                        Save Changes
                        @else
                        Submit
                        @endif 
                    </button>
                    <a href="{{url('admin/createrole')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>                 
            </form>           
        </div>
    </div>
</section> 
<script>

    $(document).ready(function () {


        $('#project_id').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#rolefun').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#roletype').select2({
        }).on('change', function () {
            $(this).valid();
        });


    });

</script>
@endsection