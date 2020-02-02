@extends('layout.adminlayout')
@section('title','Edit Activity Rate')

@section('body')
<!--Form Part start-->
<section class="page-content">
  <div class="page-content-inner">
              <!-- Portfolio -->
        <section class="panel">
            <!--div class="panel-heading">
                <h3>Basic Form Elements</h3>
            </div-->
            <div class="panel-body">
            
    <div class="row">
      <div class="col-lg-12">
      
             <!--Right Drop Down List Start-->
      <div class="togle-btn pull-right">
							 <div class="dropdown inner-drpdwn">
								<a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
									<span class="hidden-lg-down">Settings</span>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="" role="menu">
									<li>
										<a class="dropdown-item" href="{{url('admin/portfoliotypes')}}">
											Portfolio Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/projecttype')}}">
											Project Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/phasetype')}}">
											Phase Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/currencies')}}">
											Currency
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/capacityunits')}}">
											Capacity Units
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/periodtype')}}">
											Period Types
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/planningunit')}}">
											Planning Unit
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/planningtype')}}">
											Planning Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/costingtype')}}">
											Costing Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/collectiontype')}}">
											Collection Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/viewtype')}}">
											View Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/personresponsible')}}">
											Person Responsible
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/departmenttype')}}">
											Department Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/costcentretype')}}">
											Cost Centre Type
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/projectlocation')}}">
											Project Location
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/factorycalendar')}}">
											Factory Calendar
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/activityrates')}}">
											Activity Rates 
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/costcentres')}}">
											Cost Centres 
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{url('admin/activitytypes')}}">
											Activity Types 
										</a>
									</li>
								</ul>
							</div> 
						</div>
       <!--Right Drop Down List End-->
       
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
    
            <form id="project" method="post" action="{{url('admin/activityrate_edit_save/'.$activity_rate->activity_rate_id)}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate>
			{!! csrf_field() !!}
            
                        
            <div class="margin-bottom-50 form-width">
            <!--Breadcrum Start-->
            <div class="margin-bottom-50">
				<span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                   
					<li>
						<a href="{{url('admin/dashboard')}}">Settings</a>
					</li>
					<li>
						<a href="{{url('admin/activityrates')}}">Activity Rates</a>
					</li>
					<li>
                        <span>Edit Activity Rate</span>
                    </li>
					
                </ul>
					
                </ul>
            </div>
                        <!--Breadcrum End-->
                        
                 <!--Page Title Start-->       
                        
                <div class="col-md-12 no-pade">
								<div class="col-xs-12 col-md-6 no-pade">
									<h4>
									Edit Activity Rate
									</h4>
									<br />
									<!-- Vertical Form -->
								</div>
							
							</div>
                            
                 <!--Page Title End--> 
              <div class="row">
            
                  <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                    <label for="1">Personnel Number</label>
                    </div>
                   <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
						<select class="form-control" id="7" name="employee_id">
						  <option value="">Select Personnel Number</option>
						 <!-- code for display cost centre data -->
							@foreach($employee_data as $employee)
							{
								<?php
									$employee_select='';
									if($employee->employee_id==$activity_rate->employee_id) 
									{
										$employee_select='selected';
									}
								?>	
								
								<option value="{{$employee->employee_id}}" <?php echo $employee_select; ?>>{{$employee->employee_personnel_number}}
								</option>
							}
							@endforeach       
						</select>
					</div>
                </div>
              </div>
              </div>
              
                   <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                  <label for="1">Activity Type</label>
                  </div>
                   <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
						<select class="form-control" id="7" name="activity_type_id">
						  <option value="">Select Activity Type</option>
						 <!-- code for display cost centre data -->
							@foreach($activity_type as $activity)
							{
								<?php
									$activity_select='';
									if($activity->activity_id==$activity_rate->activity_type_id) 
									{
										$activity_select='selected';
									}
								?>
								
								<option value="{{$activity->activity_id}}" <?php echo $activity_select; ?>>{{$activity->activity_type}}
								</option>
							}
							@endforeach       
						</select>
					</div>
				</div>
                </div>	
              </div>
			  
				 <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                  <label for="1">Cost Centre</label>
                  </div>
                    <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
						<select class="form-control" id="7" name="cost_centre_id">
						  <option value="">Select Cost Centre</option>
						 <!-- code for display cost centre data -->
							@foreach($cost_centre as $cost)
							{
								<?php
									$cost_select='';
									if($cost->cost_id==$activity_rate->cost_centre_id) 
									{
										$cost_select='selected';
									}
								?>
								<option value="{{$cost->cost_id}}" <?php echo $cost_select; ?>>{{$cost->cost_centre}}
								</option>
							}
							@endforeach       
						</select>
					</div>
				</div>	
              </div>
              </div>
              
               <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                    <label for="3">Actual Rate<span class="required">*</span></label>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
                    <input class="form-control" placeholder="Actual Rate" id="activity_actual_rate" name="activity_actual_rate" type="text" value="{{$activity_rate->activity_actual_rate}}">
                  </div>
                </div>
              </div>
              </div>
                  
                  <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                    <label for="3">Billing Rate</label>
                    </div>
                     <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
                    {!!Form::text('billing_rate',$activity_rate->billing_rate,array('class'=>'form-control','placeholder'=>'Billing Rate'))!!}  
                 </div>
                </div>
              </div>
              </div>
			  
			  <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                    <label for="3">Plan Rate<span class="required">*</span></label>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
                    <input class="form-control" placeholder="Plan Rate" id="activity_plan_rate" name="activity_plan_rate" type="text" value="{{$activity_rate->activity_plan_rate}}">
                  </div>
                </div>
              </div>
              </div>
              
              <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                    <label for="4">Activity Rate Desc</label>
                    </div>
                   <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
                    <textarea class="form-control" style="resize:none" rows="3" id="l15" name="activity_rate_description" placeholder="Activity Rate Description...">{{$activity_rate->activity_rate_description}}</textarea>
                  </div>
                </div>
              </div>
              </div>
                            
              <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                    <label for="start-date">Validity Start<span class="required">*</span></label>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
                   <div class='input-group date' id='datetimepicker1'>
                      <input placeholder="Pick your start date" id="start-date" name="activity_validity_start" type="text" class="form-control" value="{{$activity_rate->activity_validity_start}}">
                      <span class="input-group-addon"> <i class="icmn-calendar"></i> </span> </span> </div>
                  </div>
                  </div>
                </div>
                </div>
                
               <div class="col-xs-12">
                  <div class="form-group form-margin-btm">
                    <div class="col-xs-12 col-sm-4">
                    <label for="end-date">Validity End<span class="required">*</span></label>
                    </div>
                   <div class="col-xs-12 col-sm-8">
                    <div class="form-input-icon">
                   <div class='input-group date' id='datetimepicker1'>
                      <input placeholder="Pick your end date" id="end-date" name="activity_validity_end" type="text" class="form-control" value="{{$activity_rate->activity_validity_end}}">
                      <span class="input-group-addon"> <i class="icmn-calendar"></i> </span> </span> </div>
                  </div>
                  </div>
                </div>
                </div>
				
				<div class="col-xs-12">
                    <div class="form-group">
                    <div class="col-xs-12 col-sm-4">
                    <label for="6">Activity Rate Status</label>
                    </div>
                     <div class="col-xs-12 col-sm-8">
					<div class="btn-group" data-toggle="buttons">
					<label class="active-btn btn btn-default {{$activity_rate->status==1 ? 'active' : '' }}">
					<input type="radio" id="status" name="status" value="1" {{$activity_rate->status==1 ? 'checked' : '' }} >
							Active
						</label>
					<label class="inactive-btn btn btn-default {{$activity_rate->status==0 ? 'active' : '' }}">
					<input type="radio" id="status" name="status" value="0" {{$activity_rate->status==0 ? 'checked' : '' }}>
						   Inactive
						</label>
					</div>
					
                  </div>
                </div>
              </div>
				
							  
				<input type="hidden" name="changed_by" value="{{ Auth::user()->name }}">
                
                </div>
                
              <!--Button Form Start-->
                
             <div class="col-xs-12 form-actions">
                    <button type="submit" class="btn btn-primary width-150">Save</button>
                  
                    <a href="{{url('admin/activityrates')}}" class="btn btn-default">Cancel</a>
                 </div>
               <!--Button Form End-->
              </div>
            </form>
 
      </div>
    </div>
    
    
  </div>
  </section>
  </div>
  
  <!-- Page Scripts --> 
  
  <!-- End Page Scripts --> 
  
</section>
@endsection