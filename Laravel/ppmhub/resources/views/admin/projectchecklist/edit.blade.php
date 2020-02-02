@extends('layout.adminlayout')
@section('title','Edit Checklist')
@section('body')

<!-- Checklist -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/checklist_validation.js') !!}
<!-- Checklist -->

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
                        <a href="{{url('admin/projectchecklist')}}">Checklist Dashboard</a>
                    </li>
                    <li>
                        <span>Edit Checklist</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12">
                @if(isset($projectchecklist->id))
                {!! Form::open(array('route'=>array('checklist.update',$projectchecklist->id),'method' => 'put','id' => 'ProjectChecklistform')) !!}
                @endif

                <div class="margin-bottom-50">

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">Edit Checklist</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">CheckList Id*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('checklist_id',$projectchecklist->checklist_id,array('class'=>'form-control border-radius-0','placeholder'=>'Please enter CheckList Id','readonly'))!!}
                                            @if($errors->has('checklist_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('checklist_id') }}
                                            </span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">CheckList Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('checklist_name',$projectchecklist->checklist_name,array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Checklist Name'))!!}
                                            @if($errors->has('checklist_name')) 
                                            <span class="text-danger">
                                                {{ $errors->first('checklist_name') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Checklist Text*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('checklist_text',$projectchecklist->checklist_text,array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Checklist Text'))!!}
                                                @if($errors->has('checklist_text')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('checklist_text') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">CheckList Type*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('checklist_type',$checklist_type,$projectchecklist->checklist_type,array('class'=>'form-control select2','placeholder'=>'Please select Checklist Type','id'=>'checklist_type'))!!}  
                                            @if($errors->has('checklist_type')) 
                                            <span class="text-danger">
                                                {{ $errors->first('checklist_type') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Project Id*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('project_id',$project_id,$projectchecklist->project_id,array('class'=>'form-control select2','placeholder'=>'Please select project id','id'=>'projectid'))!!}  
                                            @if($errors->has('project_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('project_id') }}
                                            </span> 
                                            @endif
                                        </div>
                                        <?php if (isset($projectchecklist)) { ?>
                                            <div  id="pname" name='project_name'  class="col-sm-2"></div>
                                        <?php } else { ?>
                                            <div  id="pname" name='project_name c' lass="col-sm-2"></div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Phase Id*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('phase_id',$phase_id,$projectchecklist->phase_id,array('class'=>'form-control select2','placeholder'=>'Please select phase id','id'=>'phaseid'))!!}  
                                            @if($errors->has('phase_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('phase_id') }}
                                            </span> 
                                            @endif
                                        </div>
                                        <?php if (isset($projectchecklist)) { ?>
                                            <div  id="phname" name='phase_name' class="col-sm-2"></div>
                                        <?php } else { ?>
                                            <div  id="phname" name='phase_name' class="col-sm-2"></div>
                                        <?php } ?>
                                    </div>


                                    <!--                                    <div class="form-group row">
                                                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Checklist Status:</label>
                                                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                                                {!!Form::select('checklist_status',array('created'=>'Created','in_progress'=>'In Progress','completed'=>'Completed'),$projectchecklist->checklist_status,array('class'=>'form-control select2','placeholder'=>'Please select checklist status','id'=>'checklist_status'))!!}  
                                                                                @if($errors->has('checklist_status')) 
                                                                                <span class="text-danger">
                                                                                    {{ $errors->first('checklist_status') }}
                                                                                </span> 
                                                                                @endif
                                                                            </div>
                                                                        </div>-->


                                    <div class="col-xs-12 col-sm-2">
                                        <input type="hidden" class="form-control" name="changed_on" value="<?php echo $changed_on; ?>">
                                        <input type="hidden" class="form-control" name="changed_by" value="<?php echo $username; ?>">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Task Id*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('task_id',$task_id,$projectchecklist->task_id,array('class'=>'form-control select2','placeholder'=>'Please select task id','id'=>'taskid'))!!}  
                                            @if($errors->has('task_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('task_id') }}
                                            </span> 
                                            @endif
                                        </div>
                                        <?php if (isset($projectchecklist)) { ?>
                                            <div  id="tname" name='task_name' class="col-sm-2"></div>
                                        <?php } else { ?>
                                            <div  id="tname" name='task_name' class="col-sm-2"></div>
                                        <?php } ?>
                                    </div>  
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <label class="input-group datepicker-only-init">
                                                {!!Form::text('start_date',$projectchecklist->start_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Start date'))!!}
                                                <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                            </label>
                                            @if($errors->has('start_date')) 
                                            <div style='color:red'>
                                                {{ $errors->first('start_date') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">End date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <label class="input-group datepicker-only-init">
                                                {!!Form::text('end_date',$projectchecklist->end_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Finish date'))!!}
                                                <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                            </label>
                                            @if($errors->has('end_date')) 
                                            <div style='color:red'>
                                                {{ $errors->first('end_date') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual Start date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <label class="input-group datepicker-only-init">
                                                {!!Form::text('a_start_date',$projectchecklist->a_start_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Actual start date'))!!}
                                                <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                            </label>
                                            @if($errors->has('a_start_date')) 
                                            <div style='color:red'>
                                                {{ $errors->first('a_start_date') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual Finish date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <label class="input-group datepicker-only-init">
                                                {!!Form::text('a_end_date',$projectchecklist->a_end_date,array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Actual Finish date'))!!}
                                                <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                            </label>
                                            @if($errors->has('a_end_date')) 
                                            <div style='color:red'>
                                                {{ $errors->first('a_end_date') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Duration:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('duration',$capacity,$projectchecklist->duration,array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select duration unit'))!!}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Person Responsible</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('person_responsible',$employeemaster,$projectchecklist->person_responsible,array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Person responsible'))!!}
                                            @if($errors->has('person_responsible')) 
                                            <span class="text-danger">
                                                {{ $errors->first('person_responsible') }}
                                            </span> 
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">CheckList Status:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('checklist_status',array('OK'=>'OK','Not OK'=>'Not OK','Closed'=>'Closed'),$projectchecklist->checklist_status,array('class'=>'form-control select2','placeholder'=>'Please select checklist status','id'=>'checklist_status'))!!}  
                                            @if($errors->has('checklist_status')) 
                                            <div style='color:red'>
                                                {{ $errors->first('checklist_status') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer card-footer-box text-right">
                            {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn')) !!}  


                            <a href="{{url('/admin/projectchecklist')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
</section>
<!-- End Dashboard -->

<script type="text/javascript">
    $(document).ready(function () {

        $('#checklist_type').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#projectid').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#phaseid').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#taskid').select2({
        }).on('change', function () {
            $(this).valid();
        });
    });



 $(document).ready(function () {
        $('#projectid').change(function (e) {
            var data = $(this).val();
//            $.ajax({
//                url: "{{ url('admin/getpname') }}/",
//                type: 'GET',
//                dataType: 'json',
//                data: {'project_Id': data},
//                success: function (data)
//                {
//                  $('#pname').html(data.name.project_desc);
//                  if(data.phase){
//                      $('#phaseid').empty();
//                      $('#phaseid').append('<option value="" disabled selected="selected">Please select phase</option>');
//                      $.each(data.phase, function(key, value){
//                        $('#phaseid').append('<option value='+key+'>'+value+'</option>');
//                      });
//                  }
//                }
//            });
            $.ajax({
                url: "{{ url('admin/getprojectname') }}/",
                type: 'GET',
                dataType: 'json',
                data: {'project_Id': data},
                success: function (data)
                {
//                    $('#pname').html(data.name.project_desc);
//                      $('#pname').html(data.project_desc);
                    if (data.phase) {
                        $('#phaseid').empty();
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
                url: "{{ url('admin/getphasename') }}/",
                type: 'GET',
                dataType: 'json',
                data: {'phase_id': data},
                success: function (data)
                {

//                    $('#phasename').html(data.name.phase_name);
                    if (data.task) {
                        $('#taskid').empty();
                        $('#taskid').append('<option value="" disabled selected="selected">Please select task</option>');
                        $.each(data.task, function (key, value) {
                            $('#taskid').append('<option value=' + key + '>' + value + '</option>');
                        });
                    }
                }
            });
//            $.ajax({
//                url: "{{ url('admin/getphname') }}/",
//                type: 'GET',
//                dataType: 'json',
//                data: {'phase_id': data},
//                success: function (data)
//                {
//                    $('#phasename').html(data.name.phase_name);
//                    if(data.task){
//                        $('#taskid').empty();
//                        $('#taskid').append('<option value="" disabled selected="selected">Please select task</option>');
//                        $.each(data.task, function(key, value){
//                          $('#taskid').append('<option value='+key+'>'+value+'</option>');
//                        });
//                    }
//                }
//            });

        });

        $('#taskid').change(function (e) {
            var data = $(this).val();
            $.ajax({
                url: "{{ url('admin/gettaskname') }}/",
                type: 'GET',
                dataType: 'json',
                data: {'task_id': data},
                success: function (data)
                {

                    $('#taskname').html(data.task_name);
                }
            });

        });
    });
</script>
<script>
    (function () {

        $("#estimated_duration").on('change', function (evt) {
            var unit = $("#duration :selected").val();
            switch (parseInt(unit))
            {
                case 1:
                    if (parseInt(evt.target.value) > 29)
                    {
                        evt.target.value = 29;
                    }
                    break;
                case 2:
                    if (parseInt(evt.target.value) > 11)
                    {
                        evt.target.value = 11;
                    }

                    break;
                case 3:
                    if (parseInt(evt.target.value) > 99)
                    {
                        evt.target.value = 99;
                    }

                    break;
            }
        });
    })();



</script>

@endsection
