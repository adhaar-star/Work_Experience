@extends('layout.adminlayout')
@section('title','Project | Projects')
@section('headjscss')
@endsection
@section('body')
	<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                        @if(isset($project) && $project->id)
                        Edit
                        @else
                        Add
                        @endif 
                        Project 
					</h2>
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
                    <form id="project" method="post" action="<?php if(isset($project) && $project->id){ echo url('admin/project/'.$project->id); }else{ echo url('admin/project'); } ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                      {{ csrf_field() }}
                      @if(isset($project) && $project->id)
                      {{ method_field('PUT') }}
                       @endif 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
                          <input type="text" id="project_Id" name="project_Id" value="<?php if(isset($project)){ echo $project->project_Id; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <input type="text" id="project_type" name="project_type" value="<?php if(isset($project)){ echo $project->project_type; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea type="text" id="project_desc" name="project_desc" required="required" class="form-control col-md-7 col-xs-12"><?php if(isset($project)){ echo $project->project_desc; } ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">New Template <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea type="text" id="template" name="template" required="required" class="form-control col-md-7 col-xs-12"><?php if(isset($project)){ echo $project->template ; } ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Portfolio <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<?php if(isset($project)){?>
                        {!! Form::select('portfolio_id',$ptype, old('portfolio_id', $project->type), array('class'=>'form-control col-md-7 col-xs-12')) !!}
                        <?php }else{?>
                        {!! Form::select('portfolio_id',$ptype, old('portfolio_id'), array('class'=>'form-control col-md-7 col-xs-12')) !!}	
                        <?php }?>
						
                          <!--input type="text" id="portfolio_id" name="portfolio_id" value="<?php if(isset($project)){ echo $project->portfolio_id; } ?>" required="required" class="form-control col-md-7 col-xs-12"-->
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Bucket <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<?php if(isset($project)){?>
                        {!! Form::select('bucket_id', $buckets, old('bucket_id', $project->bucket_id), array('class'=>'form-control col-md-7 col-xs-12')) !!}
                        <?php }else{?>
                        {!! Form::select('bucket_id', $buckets, old('bucket_id'), array('class'=>'form-control col-md-7 col-xs-12')) !!}	
                        <?php }?>
                          <!--input type="text" id="bucket_id" name="bucket_id" value="<?php if(isset($project)){ echo $project->bucket_id; } ?>" required="required" class="form-control col-md-7 col-xs-12"-->
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="start_date" name="start_date" value="<?php if(isset($project)){ echo $project->start_date; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">End Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="end_date" name="end_date" value="<?php if(isset($project)){ echo $project->end_date; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <?php
                        if(isset($project->created_by) && (!empty($project->created_by)))
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
	$(document).ready(function(){
		var start_date_input=$('input[name="start_date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		start_date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
		
		var end_date_input=$('input[name="end_date"]'); //our date input has the name "date"
		end_date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
	
</script>
    <!-- jQuery validation-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script src="{{asset('js/custom.js')}}"></script>
@endsection