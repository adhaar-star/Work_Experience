@extends('layout.adminlayout')
@section('title','Project | Person Assignment to Task')
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/personassignment.js') !!}



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
                        <a href="{{url('admin/personassignmenttotask')}}">Person Assignment To Task</a>
                    </li>
                    <li>
                        <span>
                            @if(isset($personassignment) && $personassignment->id)
                            Edit
                            @else
                            Create
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
            <form id="Personassignmentform" method="post" action="<?php
            if (isset($personassignment) && $personassignment->id) {
                echo url('admin/personassignmenttotask/' . $personassignment->id);
            } else {
                echo url('admin/personassignmenttotask');
            }
            ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                {{ csrf_field() }}
                @if(isset($personassignment) && $personassignment->id)
                {{ method_field('PUT') }}
                @endif 
                <div class="">
                    <div class="card card-info-custom margin-bottom-0">
                        <div class="alert alert-danger" style="display: none;">
                            <span class="glyphicon glyphicon-notification"></span>
                            <em> </em>
                        </div>
                        <div class="card-header">
                            <h4 class="margin-0">
                                @if(isset($personassignment) && $personassignment->id)
                                Edit
                                @else
                                Create  Person 
                                @endif 
                                Assignment  to Task
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
                                                {!!Form::select('project_id',$project_id,isset($personassignment->project_id) ? $personassignment->project_id : '',array('class'=>'form-control select2','placeholder'=>'Please select project id','id'=>'project_id'))!!}  
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
                                                {!!Form::select('resource_name',$resource_name,isset($personassignment->resource_name) ? $personassignment->resource_name : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select resource name','id'=>'resourcename'))!!}
                                                @if($errors->has('resource_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('resource_name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select Task*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon"> 
                                                @if(isset($personassignment) && $personassignment->id)
                                                {!!Form::select('task',$task_id,isset($personassignment->task) ? $personassignment->task : '',array('class'=>'form-control select2','placeholder'=>'Please select task id','id'=>'task_id'))!!}  
                                                @else
                                                @if(Session::has('task_id'))
                                                {!!Form::select('task',session('task_id'),isset($personassignment->task) ? $personassignment->task : '',array('class'=>'form-control select2','placeholder'=>'Please select task id','id'=>'task_id'))!!}  
                                                @else
                                                {!!Form::select('task',[],isset($personassignment->task) ? $personassignment->task : '',array('class'=>'form-control select2','placeholder'=>'Please select task id','id'=>'task_id'))!!}  
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
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Start Date*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">                                                
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('start_date',isset($personassignment->start_date) ? $personassignment->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init start','placeholder'=>'Please select  start date'))!!}
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
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select Role*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon"> 
                                                @if(isset($personassignment) && $personassignment->id)
                                                {!!Form::select('role',$roles,isset($personassignment->role) ? $personassignment->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'role_name'))!!}  
                                                @else
                                                @if(Session::has('role_id'))
                                                {!!Form::select('role',session('role_id'),isset($personassignment->role) ? $personassignment->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'role_name'))!!}  
                                                @else
                                                {!!Form::select('role',[],isset($personassignment->role) ? $personassignment->role : '',array('class'=>'form-control select2','placeholder'=>'Please select role','id'=>'role_name'))!!}  
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
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33"> Role Description:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon">                                                   
                                                {!!Form::text('role_desc',isset($personassignment->role_desc) ? $personassignment->role_desc : '',array('class'=>'form-control','id'=>'role_desc','readonly'))!!}  
                                                @if($errors->has('role_desc')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role_desc') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33"> Task Description:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <div class="form-input-icon">                                                   
                                                {!!Form::text('task_desc',isset($personassignment->task_desc) ? $personassignment->task_desc : '',array('class'=>'form-control','id'=>'task_desc','readonly'))!!}  
                                                @if($errors->has('task_desc')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('task_desc') }}
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
                                                    {!!Form::text('end_date',isset($personassignment->end_date) ? $personassignment->end_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init end','placeholder'=>'Please select  end date'))!!}                                               
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
                                    <div class="add-form" style="display: none;">
                                        <div class="form-group row" >
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Day*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('day','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Hours'))!!}                                               
                                                    <span class=" border-radius-0"> </i> </span>
                                                    <p id="end"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row super">
                                <div class="col-sm-12">
                                    <div class="form-group row" >
                                        @if (isset($personassignment) && $personassignment->id)
                                        @php
                                        $date1 =  date_create($personassignment->end_date);
                                        $date2 =  date_create($personassignment->start_date);
                                        
                                        $diff = date_diff($date1,$date2);
                                        $diff = $diff->days +1;
                                        $data = json_decode(json_encode($personassignment,true),true);
                                        @endphp 
                                        @for($i=1;$i<=$diff;$i++)
                                        <div class="col-sm-6" >
                                            <div class="form-group row">
                                                <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Day{{$i}} ({{date('Y-m-d',strtotime(($i-1).' day',strtotime($personassignment->start_date)))}})*:</label>
                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-7">
                                                    <div class="form-input-icon">
                                                        {!!Form::text('day'.$i,$data['day'.$i],array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Hours'))!!}                                               
                                                        <span class=" border-radius-0"> </i> </span>
                                                        <p id="end"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer card-footer-box text-right">
                    <button type="submit" class="btn btn-primary card-btn">
                        @if(isset($personassignment) && $personassignment->id)
                        Save Changes
                        @else
                        Submit
                        @endif 
                    </button>
                    <a href="{{url('admin/personassignmenttotask')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>                 
            </form>           
        </div>
    </div>
</section> 

<script>


    $(document).ready(function () {
        // forceNumeric() plug-in implementation
        jQuery.fn.forceNumeric = function () {

            return this.each(function () {
                $(this).keydown(function (e) {
                    var key = e.which || e.keyCode;

                    if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                            // numbers   
                            key >= 48 && key <= 57 ||
                            // Numeric keypad
                            key >= 96 && key <= 105 ||
                            //. on keypad
                            key == 110 ||
                            // Backspace and Tab and Enter
                            key == 8 || key == 9 || key == 13 ||
                            // Home and End
                            key == 35 || key == 36 ||
                            // left and right arrows
                            key == 37 || key == 39 ||
                            // Del and Ins
                            key == 46 || key == 45)
                        return true;

                    return false;
                });
            });
        }



        $('[name*=day]').forceNumeric();


        $('[name=start_date]').on('dp.change', function () {
            var period_from = $('[name=start_date]').val();
            var period_to = $('[name=end_date]').val();
            if (period_to != '' && period_to != null) {
                var start = $('[name=start_date]').val();
                var end = $('[name=end_date]').val();
                var to = moment(end);
                var from = moment(start);
                var diff = to.diff(from, 'days');
                $('.super').html('');
                if (diff > 90)
                {
                    $('.alert-danger em').html('The date range cannot be greater than 90 days !!!');
                    $('.alert-danger').fadeIn(500);
                    $('.alert-danger').fadeOut(2500);

                    return 0;
                }

                var html = $('.add-form').html();
                add = from.add(0, 'd');

                for (i = 1; i <= diff + 1; i++)
                {

                    $('.super').append(' <div class="col-sm-6" >' + html + '</div>').show();
                    $('.super label').eq(i - 1).text('Day' + i + '  (' + add.format('YYYY-MM-DD') + ') *');
                    $('.super input').eq(i - 1).attr('name', 'day' + i);
                    $('.super input').eq(i - 1).keydown(function (e) {
                        var key = e.which || e.keyCode;

                        if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                                // numbers   
                                key >= 48 && key <= 57 ||
                                // Numeric keypad
                                key >= 96 && key <= 105 ||
                                //. on keypad
                                key == 110 ||
                                // Backspace and Tab and Enter
                                key == 8 || key == 9 || key == 13 ||
                                // Home and End
                                key == 35 || key == 36 ||
                                // left and right arrows
                                key == 37 || key == 39 ||
                                // Del and Ins
                                key == 46 || key == 45)
                            return true;

                        return false;
                    });
                    add = from.add(1, 'd');

                }

            }

        });
        $('[name=end_date]').on('dp.change', function () {
            var period_from = $('[name=start_date]').val();
            var period_to = $('[name=end_date]').val();
            if (period_to != '' && period_to != null) {
                var start = $('[name=start_date]').val();
                var end = $('[name=end_date]').val();
                var to = moment(end);
                var from = moment(start);
                var diff = to.diff(from, 'days');
                $('.super').html('');
                if (diff > 90)
                {
                    $('.alert-danger em').html('The date range cannot be greater than 90 days !!!');
                    $('.alert-danger').fadeIn(500);
                    $('.alert-danger').fadeOut('slow', 1500);

                    return 0;
                }
                var html = $('.add-form').html();
                add = from.add(0, 'd');

                for (i = 1; i <= diff + 1; i++)
                {

                    $('.super').append(' <div class="col-sm-6" >' + html + '</div>').show();
                    $('.super label').eq(i - 1).text('Day' + i + '  (' + add.format('YYYY-MM-DD') + ') *');
                    $('.super input').eq(i - 1).attr('name', 'day' + i);
                    $('.super input').eq(i - 1).keydown(function (e) {
                        var key = e.which || e.keyCode;

                        if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                                // numbers   
                                key >= 48 && key <= 57 ||
                                // Numeric keypad
                                key >= 96 && key <= 105 ||
                                //. on keypad
                                key == 110 ||
                                // Backspace and Tab and Enter
                                key == 8 || key == 9 || key == 13 ||
                                // Home and End
                                key == 35 || key == 36 ||
                                // left and right arrows
                                key == 37 || key == 39 ||
                                // Del and Ins
                                key == 46 || key == 45)
                            return true;

                        return false;
                    });
                    add = from.add(1, 'd');
                }

            }

        });







        $('#project_id').change(function (e) {
            _$('role_name').innerHTML = '';
            $('#role_name').append('<option selected="selected" disabled="disabled" value="" hidden="hidden">Please select role</option>');


            $('#role_desc').val('');
            $('#task_desc').val('');
            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getPRole') }}",
                        dataType: 'json',
                        data: {'project_id': data},
                        success: function (data)
                        {
                            //                   alert(data.name);
                            //console.log(data);
                            //$('#role_name').val(data.role_name);
                            $(data.roleList).each(function (i, role) {

                                $('#role_name').append('<option value="' + role[0] + '">' + role[1] + '</option>')

                            });

                        }
                    });
        });
    });

    $(document).ready(function () {
        $('#project_id').change(function (e) {

            $('#task_id').html('');
            $('#task_id').append('<option selected="selected" disabled="disabled" value="" hidden="hidden">Please select task</option>');

            _$('resourcename').innerHTML = '';
            $('#resourcename').append('<option selected="selected" disabled="disabled" value="" hidden="hidden">Please select resource</option>');

            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getPtask') }}",
                        dataType: 'json',
                        data: {'project_id': data},
                        success: function (data)
                        {
                            //                   alert(data.name);
                            console.log(data);
                            //$('#role_name').val(data.role_name);
                            $(data.taskList).each(function (i, role) {
                                $('#task_id').append('<option value="' + role[0] + '">' + role[1] + '</option>')
                            });
                            $(data.resourceList).each(function (i, role) {

                                $('#resourcename').append('<option value="' + role[0] + '">' + role[1] + '</option>')

                            });
                        }
                    });
        });
    });

    $(document).ready(function () {
        $('#role_name').change(function (e) {
            $('#resourcename').html('');
            $('#task_id').html('');
            $('#role_desc').val('');
            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getRoledesc') }}",
                        dataType: 'json',
                        data: {'role_desc': data},
                        success: function (data)
                        {

                            $('#role_desc').val(data.role_desc);

                            if (data.taskandresource.length > 0)
                            {
                                var x = [];
                                var y = [];
                                x.push(data.taskandresource[0].resource_name[0]);
                                y.push(data.taskandresource[0].task_name[0]);

                                $('#resourcename').append('<option selected="selected"  value="' + data.taskandresource[0].resource_name[0] + '" hidden="hidden">' + data.taskandresource[0].resource_name[1] + '</option>');
                                $('#task_id').append('<option selected="selected" value="' + data.taskandresource[0].task_name[0] + '" hidden="hidden">' + data.taskandresource[0].task_name[1] + '</option>');
                                $('#task_desc').val(data.taskandresource[0].task_name[1]);

                                $(data.taskandresource).each(function (i, j) {
                                    if (i > 0)
                                    {
                                        if (x.indexOf(j.resource_name[0]) == -1)
                                        {
                                            $('#resourcename').append('<option  value="' + j.resource_name[0] + '" hidden="hidden">' + j.resource_name[1] + '</option>');
                                            x.push(j.resource_name[0]);
                                        }

                                        if (y.indexOf(j.task_name[0]) == -1)
                                        {
                                            $('#task_id').append('<option value="' + j.task_name[0] + '" hidden="hidden">' + j.task_name[1] + '</option>');
                                            y.push(j.task_name[0]);
                                        }
                                    }
                                });
                            }

                        }
                    });
        });
    });

    $(document).ready(function () {
        $('#task_id').change(function (e) {
            $('#task_desc').val('');

            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getname') }}",
                        dataType: 'json',
                        data: {'task_id': data},
                        success: function (data)
                        {
                            //                   alert(data.name);
                            //                            console.log(data);
                            $('#task_desc').val(data.task_name);

                        }
                    });
        });
    });

    $(document).ready(function () {
        $('#task_id').change(function (e) {
            _$('role_name').innerHTML = '';
            $('#role_name').append('<option selected="selected" disabled="disabled" value="" hidden="hidden">Please select role</option>');
            var data = $(this).val();
            $.ajax
                    ({
                        url: "{{ url('admin/getPRole') }}",
                        dataType: 'json',
                        data: {'task_id': data},
                        success: function (data)
                        {
                            _$('role_name').innerHTML = '';
                            $('#role_name').append('<option selected="selected" disabled="disabled" value="" hidden="hidden">Please select role</option>');
                            $(data.roleList).each(function (i, role) {

                                $('#role_name').append('<option value="' + role[0] + '">' + role[1] + '</option>')

                            });

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

        $('#task_id').select2({
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