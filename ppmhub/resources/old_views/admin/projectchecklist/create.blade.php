@extends('layout.adminlayout')
@section('title','Project | Add Checklist')
@section('headjscss')
@endsection
@section('body')
	<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                        @if(isset($projectchecklist) && $projectchecklist->id)
                        Edit
                        @else
                        Add
                        @endif 
                        Checklist </h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                     @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="Projectphaseform" method="post" action="<?php if(isset($projectchecklist) && $projectchecklist->id){ echo url('admin/projectchecklist/'.$projectchecklist->id); }else{ echo url('admin/projectchecklist'); } ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                      {{ csrf_field() }}
                      @if(isset($projectchecklist) && $projectchecklist->id)
                      {{ method_field('PUT') }}
                       @endif 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Checklist ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="checklist_Id" name="checklist_Id" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->checklist_Id; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Checklist name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="checklist_name" name="checklist_name" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->checklist_name; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Check list Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="checklist_type" name="checklist_type" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->checklist_type; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Project Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="project_id" name="project_id" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->project_id; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Phase Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="phase_type" name="phase_type" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->phase_type; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
					   </div>
					   
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Task ID<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="phase_type" name="phase_type" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->phase_type; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="start_date" name="start_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->start_date; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">End Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="end_date" name="end_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->end_date; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                     
                      </div>
                      <?php
                        if(isset($projectchecklist->created_by) && (!empty($projectchecklist->created_by)))
                           { 
                      ?>  <input type="hidden" id="modified_by" name="modified_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="modified_date" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                       <?php }else{?>
                          <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                          
                      <?php }?>
                                          
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                     
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div> 
@endsection

@section('footerjscss')
    <!-- jQuery validation-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script src="{{asset('js/custom.js')}}"></script>
@endsection