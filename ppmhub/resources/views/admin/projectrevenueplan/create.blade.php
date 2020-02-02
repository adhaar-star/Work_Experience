@extends('layout.adminlayout')
@section('title','Project | Project Cost Plan')
@section('body')

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="margin-bottom-50">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Project Management</a>
                    </li>
                    <li>
                        <a href="{{url('admin/projectcostplan')}}">Project Cost Plan Dashboard</a>
                    </li>
                    <li>
                        <span>Create Project Cost Plan</span>
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

            <div class="col-lg-12">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="Projectphaseform" method="post" action="<?php
                if (isset($projectcostplan) && $projectcostplan->id) {
                    echo url('admin/projectcostplan/' . $projectcostplan->id);
                } else {
                    echo url('admin/projectcostplan');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    @if(isset($projectcostplan) && $projectcostplan->id)
                    {{ method_field('PUT') }}
                    @endif 

                    <div class="margin-bottom-50">
                        <div class="card">
                            <div class="card-header card-header-box">
                                <h4 class="margin-0">
                                    @if(isset($projectcostplan) && $projectcostplan->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Project Cost Plan
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block bg-lightcyan">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Checklist ID:</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="Checklist ID" id="checklist_Id" name="checklist_Id" value="<?php
                                                    if (isset($projectcostplan)) {
                                                        echo $projectcostplan->checklist_Id;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                </div>
                                            </div>
                                        </div>	
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="l33">Checklist name*: <span class="required"></span></label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="Checklist name" id="checklist_name" name="checklist_name" value="<?php
                                                    if (isset($projectcostplan)) {
                                                        echo $projectcostplan->checklist_name;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Check list Type:</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" id="checklist_type" name="checklist_type" value="<?php
                                                    if (isset($projectcostplan)) {
                                                        echo $projectcostplan->checklist_type;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                </div>
                                            </div>
                                        </div>	
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Select Project Id:</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" id="project_id" name="project_id" value="<?php
                                                    if (isset($projectcostplan)) {
                                                        echo $projectcostplan->project_id;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                </div>
                                            </div>
                                        </div>	
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Select Phase Id:</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" id="phase_type" name="phase_type" value="<?php
                                                    if (isset($projectcostplan)) {
                                                        echo $projectcostplan->phase_type;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                </div>
                                            </div>
                                        </div>	
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right" for="l33">Select Task ID:</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" id="phase_type" name="phase_type" value="<?php
                                                    if (isset($projectcostplan)) {
                                                        echo $projectcostplan->phase_type;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Start date:</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        <input type="text" placeholder="Start Date" id="start_date" name="start_date" value="<?php
                                                        if (isset($projectcostplan)) {
                                                            echo $projectcostplan->start_date;
                                                        }
                                                        ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                                                        <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">End date:</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        <input type="text" placeholder="End Date" id="end_date" name="end_date" value="<?php
                                                        if (isset($projectcostplan)) {
                                                            echo $projectcostplan->end_date;
                                                        }
                                                        ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                                                        <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (isset($projectcostplan->created_by) && (!empty($projectcostplan->created_by))) {
                                ?>  <input type="hidden" id="modified_by" name="modified_by" value="<?php //echo Auth::user()->name;   ?>" required="required" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" id="modified_date" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                            <?php } else { ?>
                                <input type="hidden" id="created_by" name="created_by" value="<?php //echo Auth::user()->name;            ?>" required="required" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">

                            <?php } ?>

                            <div class="card-footer card-footer-box">
                                <button type="submit" class="btn btn-primary card-btn">Submit</button>
                                <a href="{{url('admin/projectcostplan')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> 
@endsection