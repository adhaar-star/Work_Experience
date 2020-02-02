@extends('layout.adminlayout')

<?php if (isset($projectphase) && $projectphase->id) { ?>
  @section('title','Project | Edit Phase')
<?php } else { ?>
  @section('title','Project | Create Phase')
<?php } ?>

@section('body')
{!! Html::script('/js/jquery.validate.min.js') !!}
<!--{!! Html::script('/js/phase_validation.js') !!}-->

<section id="create_form" class="panel">
  <div class="panel-body">
    <div class="margin-bottom-50">
      <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
      <ul class="list-unstyled breadcrumb breadcrumb-custom">
        <li>
          <a href="{{url('admin/dashboard')}}">Project Management</a>
        </li>
        <li>
          <a href="{{url('admin/projectphase')}}">Project Phase dashboard</a>
        </li>
        <li>
          <span>
            @if(isset($projectphase) && $projectphase->id)
            Edit
            @else
            Create
            @endif 
            Phase
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

    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="row">
      <div class="col-lg-12">


        <form id="Projectphaseform" method="post" action="<?php
        if (isset($projectphase) && $projectphase->id) {
          echo url('admin/projectphase/' . $projectphase->id);
        } else {
          echo url('admin/projectphase');
        }
        ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
          {{ csrf_field() }}
          @if(isset($projectphase) && $projectphase->id)
          {{ method_field('PUT') }}
          @endif
          <div class="margin-bottom-50">


            <div class="card">
              <div class="card-header card-header-box bg-lightcyan">
                <h4 class="margin-0">
                  @if(isset($projectphase) && $projectphase->id)
                  Edit
                  @else
                  Create
                  @endif 
                  Phase
                </h4>
                <!-- Vertical Form -->
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group row">
                      <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phase Id*:</label>
                      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                        <div class="form-input-icon">
                          <?php if (isset($projectphase)) { ?>

                            <input type="text" placeholder="Phase ID" id="phase_Id" name="phase_Id" value="<?php
                            if (isset($projectphase)) {
                              echo $projectphase->phase_Id;
                            }
                            ?>" class="form-control border-radius-0" readonly>
                                 <?php } else { ?>
                            <input type="text" placeholder="Phase ID" id="phase_Id" name="phase_Id" value="<?php echo $rand = substr(md5(microtime()), rand(0, 26), 6); ?>" class="form-control border-radius-0" >							
                          <?php } ?>

                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phase Name*:</label>
                      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                        <div class="form-input-icon">
                          <input type="text" placeholder="Phase Name" id="phase_name" name="phase_name" value="<?php
                          if (isset($projectphase)) {
                            echo $projectphase->phase_name;
                          }
                          ?>" required="required" class="form-control border-radius-0">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phase Type*:</label>
                      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                        <div class="form-input-icon">

                          <?php if (isset($projectphase)) { ?>
                            {!! Form::select('phase_type',$phasetype, old('phase_type', $projectphase->phase_type), array('class'=>'select2')) !!}
                          <?php } else { ?>
                            {!! Form::select('phase_type',$phasetype, old('phase_type'), array('class'=>'select2')) !!}	
                          <?php } ?>


                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Project Id*:</label>
                      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                        <div class="form-input-icon">

                          <?php if (isset($projectphase)) { ?>
                            {!! Form::select('project_id',$project_id, old('project_id', $projectphase->project_id), array('class'=>'select2','id'=>'project_id')) !!}
                          <?php } else { ?>
                            {!! Form::select('project_id',$project_id, old('project_id'), array('class'=>'select2','id'=>'project_id')) !!}	
                          <?php } ?>


                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group row">
                      <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Name*:</label>
                      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                        <div class="form-input-icon">
                          <input type="text" placeholder="Project Name" id="project_name" class="form-control border-radius-0" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start date*:</label>
                      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                        <div class="form-input-icon">
                          <label class="input-group datepicker-only-init">
                            <input type="text" placeholder="Start Date" id="start_date" name="start_date" value="<?php
                            if (isset($projectphase)) {
                              echo $projectphase->start_date;
                            }
                            ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                            <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                          </label>
                        </div>
                      </div>			
                    </div>
                    <div class="form-group row">
                      <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">End date*:</label>
                      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                        <div class="form-input-icon">
                          <label class="input-group datepicker-only-init">
                            <input type="text" placeholder="End Date" id="end_date" name="end_date" value="<?php
                            if (isset($projectphase)) {
                              echo $projectphase->end_date;
                            }
                            ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                            <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quality gate approval Req.?</label>
                      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                        <div class="form-input-icon">
                          <select class="select2" id="quality_approval" name="quality_approval">
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <?php
                    if (isset($projectphase->quality_approval) && (!empty($projectphase->quality_approval))) {
                      ?>  
                      <input type="hidden" id="modified_by" name="modified_by" value="<?php echo Auth::user()->id; ?>" required="required">
                      <input type="hidden" id="modified_date" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required">
                    <?php } else { ?>
                      <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->id; ?>" required="required">
                      <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required">

                    <?php } ?>

                    <?php
                    if (isset($projectphase->quality_approval) && (!empty($projectphase->quality_approval))) {
                      ?> 

                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Predecessor Phase ID:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <input type="text" class="form-control border-radius-0" value="<?php
                            if (isset($projectphase)) {
                              echo $projectphase->phase_Id;
                            }
                            ?>" readonly/>										
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Predecessor Phase Name:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <input type="text" placeholder="<?php
                            if (isset($projectphase)) {
                              echo $projectphase->predecessor_name;
                            }
                            ?>" value="" class="form-control border-radius-0" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual Start date:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <label class="input-group datepicker-only-init">
                              <input type="text" placeholder="Actual Start Date" id="a_start_date" name="a_start_date" value="<?php
                              if (isset($projectphase)) {
                                echo $projectphase->a_start_date;
                              }
                              ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                              <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                            </label>
                          </div>
                        </div>			
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Actual End date:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <label class="input-group datepicker-only-init">
                              <input type="text" placeholder="Actual End Date" id="a_end_date" name="a_end_date" value="<?php
                              if (isset($projectphase)) {
                                echo $projectphase->a_end_date;
                              }
                              ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                              <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Earliest Start date:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <label class="input-group datepicker-only-init">
                              <input type="text" placeholder="Earliest Start Date" id="e_start_date" name="e_start_date" value="<?php
                              if (isset($projectphase)) {
                                echo $projectphase->e_start_date;
                              }
                              ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                              <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                            </label>
                          </div>
                        </div>			
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Earliest End date:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <label class="input-group datepicker-only-init">
                              <input type="text" placeholder="Earliest End Date" id="e_end_date" name="e_end_date" value="<?php
                              if (isset($projectphase)) {
                                echo $projectphase->e_end_date;
                              }
                              ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                              <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Latest Start date:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <label class="input-group datepicker-only-init">
                              <input type="text" placeholder="Latest Start Date" id="l_start_date" name="l_start_date" value="<?php
                              if (isset($projectphase)) {
                                echo $projectphase->l_start_date;
                              }
                              ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                              <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                            </label>
                          </div>
                        </div>			
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Latest End date:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <label class="input-group datepicker-only-init">
                              <input type="text" placeholder="Latest End Date" id="l_end_date" name="l_end_date" value="<?php
                              if (isset($projectphase)) {
                                echo $projectphase->l_end_date;
                              }
                              ?>" required="required" class="form-control border-radius-0 datepicker-only-init">
                              <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                            </label>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <?php
                    if (isset($projectphase->quality_approval) && (!empty($projectphase->quality_approval))) {
                      ?>  
                      <input type="hidden" id="modified_by" name="modified_by" value="<?php echo Auth::user()->id; ?>" required="required">
                      <input type="hidden" id="modified_date" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required">
                    <?php } else { ?>
                      <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->id; ?>" required="required">
                                            <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required">

                    <?php } ?>

                    <?php
                    if (isset($projectphase->quality_approval) && (!empty($projectphase->quality_approval))) {
                      ?> 

                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Duration:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <input type="text" placeholder="Duration" id="duration" name="duration" value="<?php
                            if (isset($projectphase)) {
                              echo $projectphase->duration;
                            }
                                                        ?>" required="required" class="form-control border-radius-0">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Person Responsible:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <?php if (isset($projectphase)) { ?>
                              {!! Form::select('persion_responsible',$personResponsible, old('person_responsible', $projectphase->person_responsible), array('class'=>'select2')) !!}
                            <?php } else { ?>
                              {!! Form::select('persion_responsible',$personResponsible, old('person_responsible'), array('class'=>'select2')) !!}	
                            <?php } ?>

                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phase Approval:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <select class="select2" id="phase_approval" name="phase_approval">
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Created On:</label>
                        <?php
                        $phpdate1 = strtotime($projectphase->created_date);
                        $created_date = date('d/M/Y', $phpdate1);
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <input type="text" value="<?php
                            if (isset($projectphase)) {
                              echo $created_date;
                            }
                            ?>" class="form-control border-radius-0" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Created By:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <input type="text" value="<?php
                            if (isset($projectphase)) {
                              echo $projectphase->created_by;
                            }
                            ?>" class="form-control border-radius-0" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Changed On:</label>
                        <?php
                        $phpdate = strtotime($projectphase->updated_at);
                        $updated_at = date('d/M/Y', $phpdate);
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <input type="text" value="<?php
                            if (isset($projectphase)) {
                              echo $updated_at;
                            }
                            ?>" class="form-control border-radius-0" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Changed By:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="form-input-icon">
                            <input type="text" value="<?php
                            if (isset($projectphase)) {
                              echo $projectphase->modified_by;
                            }
                            ?>" class="form-control border-radius-0" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                          <div class="btn-group" data-toggle="buttons">
                            @if(!isset($phase->status))
                            <a class="active-bttn btn btn-primary active ">
                              <input type="radio" id="status" name="status" value="active" checked="">
                              Active
                            </a>
                            <a class="inactive-btn btn btn-danger ">
                              <input type="radio" id="status" name="status" value="inactive" >
                              Inactive
                            </a>
                            @else
                            <a class="active-bttn btn btn-primary <?php
                            if (isset($phase) && $phase->status == 'active') {
                              echo "active";
                            }
                            ?>">
                              <input type="radio" id="status" name="status" value="active" <?php
                              if (isset($phase) && $phase->status == 'active') {
                                echo "checked";
                              }
                              ?>>
                              Active
                            </a>
                            <a class="inactive-btn btn btn-danger <?php
                            if (isset($phase) && $phase->status == 'inactive') {
                              echo "active";
                            }
                            ?>">
                              <input type="radio" id="status" name="status" value="inactive" <?php
                              if (isset($phase) && $phsae->status == 'inactive') {
                                echo "checked";
                              }
                              ?>>
                              Inactive
                            </a>
                            @endif
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="card-footer card-footer-box text-right">
                <button type="submit" class="btn btn-primary card-btn">
                  @if(isset($projectphase) && $projectphase->id)
                  Save Changes
                  @else
                  Submit
                  @endif 
                </button>
                <a href="{{url('admin/projectphase')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
              </div>
            </div>

          </div>
      </div>
    </div>
  </div>
</section>


<script>
  $(function () {
    $('#project_id').change(function (e) {

      var data = $(this).val();
      //alert(data);
      $.ajax
              ({
                url: "{{ url('admin/projectphase/getprojectname') }}/" + data,
                type: 'GET',
                dataType: 'json',
                success: function (result)
                {

                  //console.log(data);
                  $('#project_name').val(result);

                }
              });

    });

<?php if (isset($projectphase)) { ?>

      $('#project_id').ready(function (e) {

        var data = '<?php
  if (isset($projectphase)) {
    echo $projectphase->project_id;
  }
  ?>';
        //lert(data);
        $.ajax
                ({
                  url: "{{ url('admin/projectphase/getprojectname') }}/" + data,
                  type: 'GET',
                  dataType: 'json',
                  success: function (result)
                  {

                    //console.log(data);
                    $('#project_name').val(result);

                  }
                });

      });

<?php } ?>

  });


</script>	
@endsection