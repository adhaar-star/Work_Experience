@extends('layout.adminlayout')

<?php if(isset($projectchecklist) && $projectchecklist->id){ ?>
@section('title','Project | Edit Checklist')
<?php }else{ ?>
@section('title','Project | Create Checklist')
<?php } ?>

@section('body')

		<section class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
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
						   
							<div class="margin-bottom-50 form-width">
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
											<span>
											@if(isset($projectchecklist) && $projectchecklist->id)
											Edit
											@else
											Create
											@endif 
											Checklist</span>
										</li>
									</ul>
								</div>
								
								<div class="col-md-12 no-pade">
									<div class="col-xs-12 col-md-6 no-pade">
										<h4>
											@if(isset($projectchecklist) && $projectchecklist->id)
											Edit
											@else
											Create
											@endif 
											Checklist
										</h4>
										<br />
										<!-- Vertical Form -->
									</div>
								</div>	
								
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Checklist ID</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Checklist ID" id="checklist_Id" name="checklist_Id" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->checklist_Id; } else { echo $rand = substr(md5(microtime()),rand(0,26),6); } ?>" class="form-control" readonly>
												</div>
											</div>
										</div>	
									</div>
						  
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label for="l33">Checklist name <span class="required">*</span></label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Checklist name" id="checklist_name" name="checklist_name" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->checklist_name; } ?>" required="required" class="form-control">
												</div>
											</div>
										</div>
									</div>
						  
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Check list Type</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<select class="select2" id="checklist_type" name="checklist_type">
														<option value="1">Design</option>
														<option value="2">Procurement</option>
														<option value="3">Installation</option>
														<option value="4">Commissioning</option>
													</select>
													<!--input type="text" id="checklist_type" name="checklist_type" value="<?php //if(isset($projectchecklist)){ echo $projectchecklist->checklist_type; } ?>" required="required" class="form-control"-->
												</div>
											</div>
										</div>	
									</div>
						  
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Select Project Id</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<?php if(isset($projectchecklist)){?>
												{!! Form::select('project_id',$project_id, old('project_id', $projectchecklist->project_id), array('class'=>'select2')) !!}
												<?php }else{?>
												{!! Form::select('project_id',$project_id, old('project_id'), array('class'=>'select2')) !!}	
												<?php }?>
													

													<!--input type="text" id="project_id" name="project_id" value="<?php //if(isset($projectchecklist)){ echo $projectchecklist->project_id; } ?>" required="required" class="form-control"-->
												</div>
											</div>
										</div>	
									</div>
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Project Name</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" value="" required="required" class="form-control">
												</div>
											</div>
										</div>	
									</div>
						  
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Select Phase Type</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													
													<?php if(isset($projectchecklist)){?>
												{!! Form::select('phase_type',$phase_type, old('phase_type', $projectchecklist->phase_type), array('class'=>'select2')) !!}
												<?php }else{?>
												{!! Form::select('phase_type',$phase_type, old('phase_type'), array('class'=>'select2')) !!}	
												<?php }?>
													
													
													<!--input type="text" id="phase_type" name="phase_type" value="<?php //if(isset($projectchecklist)){ echo $projectchecklist->phase_type; } ?>" required="required" class="form-control"-->
												</div>
											</div>
										</div>	
									</div>
									
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Phase Name</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" value="" class="form-control">
												</div>
											</div>
										</div>	
									</div>
									
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label for="l33">Select Task ID</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<select class="select2" name="task_id" id="task_id">
														<option value="1">22</option>
														<option value="2">23</option>
													</select>
													
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Task Name</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" value="" class="form-control">
												</div>
											</div>
										</div>	
									</div>
									
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Start date</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Start Date" id="start_date" name="start_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->start_date; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>
						  
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>End date</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="End Date" id="end_date" name="end_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->end_date; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>	
									
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Status</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<select class="select2" name="status" id="status">
														<option value="created">Created</option>
														<option value="in_progress">In Progress</option>
														<option value="completed">Completed</option>
													</select>
												</div>
											</div>
										</div>
									</div>	
								
								  <?php
									if(isset($projectchecklist->created_by) && (!empty($projectchecklist->created_by)))
									   { 
								  ?>  <input type="hidden" id="modified_by" name="modified_by" value="<?php //echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
									  <input type="hidden" id="modified_date" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
								   <?php }else{?>
									  <input type="hidden" id="created_by" name="created_by" value="<?php //echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
									  <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
									  
								  <?php }?>
									


									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Actual Start Date</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Actual Start Date" id="a_start_date" name="a_start_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->a_start_date; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>	
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Actual End Date</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Actual End Date" id="a_end_date" name="a_end_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->a_end_date; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>	
									
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Earliest Start Date</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Earliest Start Date" id="e_start_date" name="e_start_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->e_start_date; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>	
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Earliest End Date</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Earliest End Date" id="e_end_date" name="e_end_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->e_end_date; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>	
									
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Latest Start Date</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Latest Start Date" id="l_start_date" name="l_start_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->l_start_date; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>	
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Latest End Date</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Latest End Date" id="l_end_date" name="l_end_date" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->l_end_date; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Duration</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Duration" id="duration" name="duration" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->duration; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Person Responsible</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Person Responsible" id="person_responsible" name="person_responsible" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->person_responsible; } ?>" required="required" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Created On</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Person Responsible"  value="<?php if(isset($projectchecklist)){ echo $projectchecklist->created_date; } ?>" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Person Responsible"  value="<?php if(isset($projectchecklist)){ echo $projectchecklist->created_by; } ?>" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Changed On</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Person Responsible" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->modified_date; } ?>"  class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Changed By</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" placeholder="Person Responsible" value="<?php if(isset($projectchecklist)){ echo $projectchecklist->modified_by; } ?>" class="form-control datepicker-only-init">
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 form-actions">
										<button type="submit" class="btn btn-primary width-150">
											@if(isset($projectchecklist) && $projectchecklist->id)
											Save Changes
											@else
											Submit
											@endif 
										</button>
										<a href="{{url('admin/projectchecklist')}}"><button type="button" class="btn btn-default">Cancel</button></a>
									</div> 
								</div>
							</div>
						</form>
					</div>
				</div>
            </div>
        </section> 
@endsection