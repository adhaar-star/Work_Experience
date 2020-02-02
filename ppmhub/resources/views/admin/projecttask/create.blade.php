@extends('layout.adminlayout')

<?php if (isset($projecttask) && $projecttask->id) { ?>
    @section('title','Project | Edit Task')
<?php } else { ?>
    @section('title','Project | Create Task')
<?php } ?>

@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/task_validation.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                        </li>
                        <li>
                            <a href="{{url('admin/projecttask')}}">Project Task dashboard</a>
                        </li>
                        <li>
                            <span>
                                @if(isset($projecttask) && $projecttask->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Project Task
                            </span>
                        </li>
                    </ul>
                    <div class="togle-btn pull-right">
                        <div class="dropdown inner-drpdwn">
                            <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                                <span class="hidden-lg-down">Project Management</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="" role="menu">
                                <a class="dropdown-item" href="{{url('admin/project')}}">Project</a>
                                <a class="dropdown-item" href="{{url('admin/projectphase')}}">Phase</a>
                                <a class="dropdown-item" href="{{url('admin/projecttask')}}">Task/Subtask</a>
                                <a class="dropdown-item" href="{{url('admin/projectchecklist')}}">Checklist</a>
                                <a class="dropdown-item" href="{{url('admin/projectmilestone')}}">Milestone</a>
                                <a class="dropdown-item" href="{{url('admin/projectcostplan')}}">Project Cost Plan</a>
                                <a class="dropdown-item" href="{{url('admin/projectresourceplan')}}">Project Resource Plan</a>
                                <!--div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                            </ul>
                        </div> 
                    </div>	
                </div>


                <form id="Projecttaskform" method="post" action="<?php
                if (isset($projecttask) && $projecttask->id) {
                    echo url('admin/projecttask/' . $projecttask->id);
                } else {
                    echo url('admin/projecttask');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    @if(isset($projecttask) && $projecttask->id)
                    {{ method_field('PUT') }}
                    @endif 
                    <div class="margin-bottom-50">

                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                    @if(isset($projecttask) && $projecttask->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Task
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task ID*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('task_Id',isset($projecttask->task_Id) ? $projecttask->task_Id : $rand_number,array('class'=>'form-control border-radius-0','readonly'))!!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task Name*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">

                                                    {!!Form::text('task_name',isset($projecttask->task_name) ? $projecttask->task_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter task name'))!!}
                                                    @if($errors->has('task_name')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('task_name') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task Type*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('task_type',array('Type 1'=>'Type 1','Type 2'=>'Type 2','Type 3'=>'Type 3'),isset($projecttask->task_type) ? $projecttask->task_type : '',array('class'=>'form-control select2','placeholder'=>'Please select task type','id'=>'task_type'))!!}  
                                                    @if($errors->has('task_type')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('task_type') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Project Id*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('project_id',$project_id,isset($projecttask->project_id) ? $projecttask->project_id : '',array('class'=>'form-control select2','placeholder'=>'Please select project','id'=>'projectid'))!!}  
                                                    @if($errors->has('project_id')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('project_id') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                            <div id="pname" name='project_desc'  class="col-sm-2"></div>
                                        </div>	
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Phase Id*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
												
                                                    {!!Form::select('phase_id',$phase_id,isset($projecttask->phase_id) ? $projecttask->phase_id : '',array('class'=>'form-control select2','placeholder'=>'Please select phase','id'=>'phaseid'))!!}  
                                                    @if($errors->has('phase_id')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('phase_id') }}
                                                    </div> 
                                                    @endif   
                                                </div>
                                            </div>
                                            <div id="phasename" name='phase_name'  class="col-sm-2"></div>
                                        </div>	
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Superior Task:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('sub_task_id',[],isset($projecttask->sub_task_id) ? $projecttask->sub_task_id : '',array('class'=>'form-control select2','placeholder'=>'Please select task','id'=>'taskid'))!!}  

                                                </div>
                                            </div>
                                            <div id="taskname" name='task_name'  class="col-sm-2"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start date*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <label class="input-group border-radius-0 datepicker-only-init">
                                                        {!!Form::text('start_date',isset($projecttask->start_date) ? $projecttask->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init start','placeholder'=>'Please select  start date'))!!}
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
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">End Date*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        {!!Form::text('end_date',isset($projecttask->end_date) ? $projecttask->end_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init end','placeholder'=>'Please select  end date'))!!}
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
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">

                                                {!!Form::select('status',array('Created'=>'Created','In Progress'=>'In Progress','Completed'=>'Completed'),'',array('class'=>'form-control select2','placeholder'=>'Please select  status','id'=>'status'))!!}  
                                                @if($errors->has('status')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('status') }}
                                                </div> 
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php
                            if (isset($projecttask->created_by) && (!empty($projecttask->created_by))) {
                                ?>  <input type="hidden" id="modified_by" name="modified_by" value="<?php echo Auth::user()->id; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" id="modified_date" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                            <?php } else { ?>
                                <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->id; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">

                            <?php } ?>


                            <div class="card-footer card-footer-box text-right">
                                <button type="submit" class="btn btn-primary card-btn">
                                    @if(isset($projecttask) && $projecttask->id)
                                    Save Changes
                                    @else
                                    Submit
                                    @endif 
                                </button>
                                <a href="{{url('admin/projecttask')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>                        

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</section>
<script type="text/javascript">
    $(document).ready(function () {

        $('#task_type').select2({
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

        $('#status').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#projectid').change(function (e) {
            var data = $(this).val();
            $.ajax({
                url: "{{ url('admin/getpname') }}/",
                type: 'GET',
                dataType: 'json',
                data: {'project_Id': data},
                success: function (data)
                {
                    
                    if (data.phase) {
                        $('#phaseid,#taskid').empty();
                        $('#taskid').append('<option value="" disabled selected="selected">Please select task</option>');
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
                url: "{{ url('admin/getphname') }}/",
                type: 'GET',
                dataType: 'json',
                data: {'phase_id': data},
                success: function (data)
                {
                    
                    if (data.task) {
                        $('#taskid').empty();
                        $('#taskid').append('<option value="" disabled selected="selected">Please select task</option>');
                        $.each(data.task, function (key, value) {
                            $('#taskid').append('<option value=' + key + '>' + value + '</option>');
                        });
                    }
                }
            });

        });

    });

</script>
@endsection