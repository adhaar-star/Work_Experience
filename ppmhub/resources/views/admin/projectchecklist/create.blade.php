@extends('layout.adminlayout')
@section('title','Create Project CheckList')

@section('body')

<!-- Checklist -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/checklist_validation.js') !!}
<!-- Checklist -->

<section id="create_form" class="panel">

    <div class="panel-body">
        <div class="row">
            <div class="margin-bottom-50">
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        You are here :    <a href="javascript: void(0);">Procurement</a>
                    </li>
                    <li>
                        <a href="{{url('admin/projectchecklist')}}">Checklist Dashboard</a>
                    </li>
                    <li>
                        <span>Checklist</span>
                    </li>
                </ul>
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Portfolio Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                            <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                            <a class="dropdown-item" href="javascript:void(0)">Portfolio Structure</a>
                            <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
                            <a class="dropdown-item" href="javascript:void(0)">Portfolio Resource Plaining</a>
                        </ul>
                    </div> 
                </div>
            </div>      

            <div class="col-lg-12">


                @if(!isset($projectchecklist->id))
                {!! Form::open(array('route' => 'checklist.create','method'=>'post', 'id' => 'Projectchecklistform')) !!} 
                @else
                {!! Form::open(array('route'=>array('checklist.update',$projectchecklist->id),'method' => 'put','id' => 'Projectchecklistform')) !!}
                @endif
                {{ csrf_field() }}

                <div class="margin-bottom-50">

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0"> Create Project Checklist </h4>
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Checklist Id* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('checklist_id',$rand_number,array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Checklist Id','readonly'))!!}
                                                @if($errors->has('checklist_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('checklist_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Checklist Name* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('checklist_name',isset($projectchecklist->checklist_name) ? $projectchecklist->checklist_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Checklist Name'))!!}
                                                @if($errors->has('checklist_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('checklist_name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Checklist Text* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('checklist_text','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Checklist Text'))!!}
                                                @if($errors->has('checklist_text')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('checklist_text') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">CheckList Type* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('checklist_type',$checklist_type,isset($projectchecklist->checklist_type) ? $projectchecklist->checklist_type : '',array('class'=>'form-control border-radius-0  select2','placeholder'=>'Please select checklist type','id'=>'checklist_type'))!!}  
                                            @if($errors->has('checklist_type')) 
                                            <div style='color:red'>
                                                {{ $errors->first('checklist_type') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Project Id* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('project_id',$project_id,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select project id','id'=>'projectid'))!!}  
                                            @if($errors->has('project_id')) 
                                            <div style='color:red'>
                                                {{ $errors->first('project_id') }}
                                            </div> 
                                            @endif
                                        </div>
                                        <div id="pname" name='project_desc'  class="col-sm-2"></div>
                                        <!--<div  id="pname" name='project_desc'  class="col-sm-2 padding-top-10"></div>-->
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" >Select Phase Id* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('phase_id',[],'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select phase id','id'=>'phaseid'))!!}  
                                            @if($errors->has('phase_id')) 
                                            <div style='color:red'>
                                                {{ $errors->first('phase_id') }}
                                            </div> 
                                            @endif                                     
                                        </div>
                                        <div id="phasename" name='phase_name'  class="col-sm-2"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Task Id* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('task_id',[],'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select task id','id'=>'taskid'))!!}  
                                            @if($errors->has('task_id')) 
                                            <div style='color:red'>
                                                {{ $errors->first('task_id') }}
                                            </div> 
                                            @endif
                                        </div>
                                        <div id="taskname" name='task_name'  class="col-sm-2"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('start_date',isset($projectchecklist->start_date) ? $projectchecklist->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please enter start date'))!!}
                                                @if($errors->has('start_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">End date:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('end_date',isset($projectchecklist->end_date) ? $projectchecklist->end_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please enter end date'))!!}
                                            @if($errors->has('end_date')) 
                                            <div style='color:red'>
                                                {{ $errors->first('end_date') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">CheckList Status :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('checklist_status',array('OK'=>'OK','Not OK'=>'Not OK','Closed'=>'Closed'),'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select checklist status','id'=>'checklist_status'))!!}  
                                            @if($errors->has('checklist_status')) 
                                            <div style='color:red'>
                                                {{ $errors->first('checklist_status') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-9">
                                    <input type="hidden" class="form-control" name="created_on" value="<?php echo $created_on; ?>">
                                    <input type="hidden" class="form-control" name="created_by" value="<?php echo $username; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{url('/admin/projectchecklist')}}" class="btn btn-danger">Cancel</a>
                        </div>
                        <!--End Vertical Form--> 
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
</section><!--
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
                    $('#pname').html(data.name.project_desc);
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

                    $('#phasename').html(data.name.phase_name);
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

@endsection
