@extends('layout.adminlayout')
@section('title','Project | Assign Role to Person')
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/assignrole.js') !!}


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
                        <a href="{{url('admin/assignroletoperson')}}">Assign Role To Person </a>
                    </li>   
                    <li>
                        <span>
                            @if(isset($assignrole) && $assignrole->id)
                            Edit
                            @else
                            Create
                            @endif 

                        </span>
                    </li>
                </ul>
            </div>
            <form id="Assignroleform" method="post" action="<?php
            if (isset($assignrole) && $assignrole->id) {
                echo url('admin/assignroletoperson/' . $assignrole->id);
            } else {
                echo url('admin/assignroletoperson');
            }
            ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                {{ csrf_field() }}
                @if(isset($assignrole) && $assignrole->id)
                {{ method_field('PUT') }}
                @endif 
                <div class="">
                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header">
                            <h4 class="margin-0">
                                @if(isset($assignrole) && $assignrole->id)
                                Edit :
                                @else
                                Create : 
                                @endif 
                                Assign Role to Person
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select Project Id*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                {!!Form::select('project_id',$project_id,isset($assignrole->project_id) ? $assignrole->project_id : '',array('class'=>'form-control select2','placeholder'=>'Please select project id','id'=>'project_id'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('project_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Resource Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon">
                                                {!!Form::select('resource_name',$resource_name,isset($assignrole->resource_name) ? $assignrole->resource_name : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select resource name','id'=>'resourcename'))!!}
                                                @if($errors->has('resource_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('resource_name') }}
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
                                                    {!!Form::text('start_date',isset($assignrole->start_date) ? $assignrole->start_date : '',array('class'=>'form-control border-radius-0 start datepicker-only-init','placeholder'=>'Please select  start date','id'=>'start'))!!}                                               
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="end"></p>
                                                @if($errors->has('start_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Role Type*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                {!!Form::text('role_type', isset($assignrole)?$assignrole->role_type:'',array('class'=>'form-control','placeholder'=>'Please select role type','id'=>'role_type','readonly'))!!}  
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select Role*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon">
                                                @if(isset($assignrole) && $assignrole->id)
                                                {!!Form::select('role',$roles,isset($assignrole->role) ? $assignrole->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'role_name'))!!}  
                                                @else
                                                @if(Session::has('role_id'))
                                                {!!Form::select('role',session('role_id'),isset($assignrole->role) ? $assignrole->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'role_name'))!!}  
                                                @else
                                                {!!Form::select('role',[],isset($assignrole->role) ? $assignrole->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'role_name'))!!}  
                                                @endif

                                                @endif 

                                                @if($errors->has('role')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Role Function*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                {!!Form::text('role_fun', isset($assignrole)?$assignrole->role_fun:'',array('class'=>'form-control','placeholder'=>'Please select role function','id'=>'role_fun','readonly'))!!}  
                                                @if($errors->has('role_fun')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role_fun') }}
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
                                                    {!!Form::text('end_date',isset($assignrole->end_date) ? $assignrole->end_date : '',array('class'=>'form-control border-radius-0  end datepicker-only-init','placeholder'=>'Please select  end date' ,'id'=>'end'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="start"></p>
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
                        @if(isset($assignrole) && $assignrole->id)
                        Save Changes
                        @else
                        Submit
                        @endif 
                    </button>
                    <a href="{{url('admin/assignroletoperson')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>                 
            </form>           
        </div>
    </div>
</section> 
<script>
    $(document).ready(function () {
        $('#project_id').change(function (e) {
//            alert('ss');
            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getrole') }}",
                        dataType: 'json',
                        data: {'project_id': data},
                        success: function (data)
                        {
//                   alert(data.name);
                            //console.log(data);
                            //$('#role_name').val(data.role_name);
                            $('#role_type').val('');
                            $('#role_fun').val('');
                            _$('role_name').innerHTML = '';
                            $('#role_name').append('<option selected="selected" disabled="disabled" value="" hidden="hidden">Please select role</option>');
                            $(data.roleList).each(function (i, role) {

                                $('#role_name').append('<option value="' + role[0] + '">' + role[1] + '</option>')

                            });

                        },
                        error: function (xhr, status, errorThrown) {
                            $('#role_type').val('');
                            $('#role_fun').val('');
                            _$('role_name').innerHTML = '';
                            $('#role_name').append('<option selected="selected" disabled="disabled" value="" hidden="hidden">Please select role</option>');

                        }
                    });
        });
    });

    $(document).ready(function () {
        $('#role_name').change(function (e) {

            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getroletype') }}",
                        dataType: 'json',
                        data: {'role_name': data},
                        success: function (data)
                        {
//                   alert(data.name);
                            console.log(data);
                            $('#role_type').val(data.role_type);
                            $('#role_fun').val(data.role_function);
                            $('#Assignroleform').valid();
                        },
                        error: function (xhr, status, errorThrown) {
                            $('#role_type').val('');
                            $('#role_fun').val('');
                            $('#Assignroleform').valid();
                        }
                    });
        });
    });
</script> 
<script>
    $(document).ready(function () {


        $('#project_id').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#role_name').select2({
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


        $('#resourcename').select2({
        }).on('change', function () {
            $(this).valid();
        });


    });
</script>
@endsection