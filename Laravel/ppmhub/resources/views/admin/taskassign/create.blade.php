@extends('layout.adminlayout')
@section('title','Project | Create Task Assignment')
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/taskAssignment_validation.js') !!}

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
                        <a href="{{url('admin/taskassign')}}">Assign Task To Role</a>
                    </li>
                    <li>
                        <span> 
                            @if (isset($taskassignment) && $taskassignment->id) 
                            Edit
                            @else
                            Create
                            @endif

                        </span>
                    </li>
                </ul>


            </div>
            <form id="taskform" method="post" action="<?php
            if (isset($taskassignment) && $taskassignment->id) {
                echo url('admin/taskassign/' . $taskassignment->id);
            } else {
                echo url('admin/taskassign');
            }
            ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                {{ csrf_field() }}
                @if(isset($taskassignment) && $taskassignment->id)
                {{ method_field('PUT') }}
                @endif 
                <div class="margin-bottom-50">

                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($taskassignment) && $taskassignment->id)
                                Edit :
                                @else
                                Create 
                                @endif : 
                                Assign Task To Role
                            </h4>
                            <!-- Vertical Form -->
                        </div>



                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for='l33'>Select Project Id*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon" >
                                                {!!Form::select('project_id',$project_id,isset($taskassignment->project_id) ? $taskassignment->project_id : '',array('class'=>'form-control select2 ','placeholder'=>'Please select project id','id'=>'ProjectGet'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('project_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select Task*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                @if(isset($taskassignment) && $taskassignment->id)
                                                {!!Form::select('task',isset($task_id)?$task_id:[],isset($taskassignment->task) ? $taskassignment->task : '',array('class'=>'form-control select2','placeholder'=>'Please select Task','id'=>'TaskSet'))!!}  
                                                @else
                                                @if(Session::has('task_id'))
                                                {!!Form::select('task',session('task_id'),isset($taskassignment->task) ? $taskassignment->task : '',array('class'=>'form-control select2','placeholder'=>'Please select Task','id'=>'TaskSet'))!!}  
                                                @else
                                                {!!Form::select('task',[],isset($taskassignment->task) ? $taskassignment->task : '',array('class'=>'form-control select2','placeholder'=>'Please select Task','id'=>'TaskSet'))!!}  
                                                @endif

                                                @endif 
                                                @if($errors->has('task')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('task') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select Role*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon">
                                                @if(isset($taskassignment) && $taskassignment->id)
                                                {!!Form::select('role',$roles,isset($taskassignment->role) ? $taskassignment->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'RoleSet'))!!}  
                                                @else
                                                @if(Session::has('role_id'))
                                                {!!Form::select('role',session('role_id'),isset($taskassignment->role) ? $taskassignment->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'RoleSet'))!!}  
                                                @else
                                                {!!Form::select('role',[],isset($taskassignment->role) ? $taskassignment->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'RoleSet'))!!}  
                                                @endif

                                                @endif 
                                            </div>
                                            @if($errors->has('role')) 
                                            <div style='color:red'>
                                                {{ $errors->first('role') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Assignment Start Date*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('start_date',isset($taskassignment->start_date) ? $taskassignment->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select  start date'))!!}
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

                                <div class="col-xs-12 col-sm-6">

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Description:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('project_description',isset($taskassignment->project_description) ? $taskassignment->project_description : '',array('class'=>'form-control border-radius-0 no-resize margin-bottom-15','placeholder'=>'Please enter description','rows'=>'2','readonly'=>'true','id'=>'project_nameDesc','maxlength'=>'191'))!!}                                    
                                                @if($errors->has('project_description')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('project_description') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Role Description:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('role_description',isset($taskassignment->role_description) ? $taskassignment->role_description : '',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter description','rows'=>'2','maxlength'=>'255','readonly'=>'true','id'=>'role_nameDesc'))!!}                                    
                                                @if($errors->has('role_description')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role_description') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Assignment End Date*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('end_date',isset($taskassignment->end_date) ? $taskassignment->end_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select  end date'))!!}                                               
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
        </div>
    </div>
    <div class="card-footer card-footer-box text-right">
        <button type="submit" class="btn btn-primary card-btn">
            @if(isset($taskassignment) && $taskassignment->id)
            Save Changes
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

<script>

    $('select.select2').select2({
    }).on('change', function () {
        $(this).valid();
    });

    $("#ProjectGet").change(function () {
        var idPadre = $("#ProjectGet option:selected").val();
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: "POST",
            url: "{{url('admin/getProjectname')}}",
            data: {id: idPadre, '_token': token}
        }).done(function (response) {
            $('#TaskSet').html('<option value="" selected> Please select Task </option>');
            $('#TaskSet').trigger('change');
            var obj = jQuery.parseJSON(response);
            var data = obj.taskList;

            $.each(data, function (index, value) {
                $('#TaskSet').append('<option value="' + value[0] + '">' + value[1] + '</option>');
            });
            $('#project_nameDesc').html(obj.desc[0].substring(0, 191));
            $('#ProjectGet,#TaskSet').selectpicker('refresh');
            $('#role_nameDesc').html('');
        }).fail(function (xhr, err) {
            $('#TaskSet').html('<option value="" selected> Please select Task </option>');

            $('#RoleSet').html('<option value="" selected> Please select Role </option>');

        });


        $.ajax({
            method: "POST",
            url: "{{url('admin/getProjectRoles/')}}/" + idPadre,
            data: {'_token': token}
        }).done(function (response) {
            $('#RoleSet').html('<option value="" selected> Please select Role </option>');
            $('#RoleSet').trigger('change');


            var obj = jQuery.parseJSON(response);
            var data = obj.roleList;


            $.each(data, function (index, value) {
                console.log(value);
                $('#RoleSet').append('<option value="' + value[0] + '">' + value[1] + '</option>');
            });

            $('#RoleSet').selectpicker('refresh');
        }).fail(function (xhr, err) {
            $('#RoleSet').html('<option value="" selected> Please select Role </option>');

        });
    });

    $("#RoleSet").change(function () {
        var idPadre = $("#RoleSet option:selected").val();
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: "POST",
            url: "{{url('admin/getRolesDesc/')}}/" + idPadre,
            data: {'_token': token}
        }).done(function (response) {
            var obj = jQuery.parseJSON(response);
            $('#role_nameDesc').html(obj.desc[0].substring(0, 191));
        });
    });


</script>

@endsection