@extends('layout.adminlayout')
@section('title','Approvers Form')
@section('body')
	<section class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
						<div class="togle-btn pull-right">
							<div class="dropdown inner-drpdwn">
								<a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
									<span class="hidden-lg-down">Time Management</span>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="" role="menu">
									<a class="dropdown-item" href="{{url('admin/employees')}}"> 
											Employee Personnel Records
										</a> 
									
									
										<a class="dropdown-item" href="{{url('admin/timesheetapprovals')}}">
											Time Approval settings
										</a>
									
									
										<a class="dropdown-item" href="{{url('admin/timesheetprofiles')}}"> 	
											Time Sheet Profiles
										</a> 			
																		
									
										<a class="dropdown-item" href=""> 
											Time Sheet Management 
										</a>
									
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
						
                    <form id="approver_form" method="post" action="{{url('admin/timesheetapprover_save')}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                      {{ csrf_field() }}
                      					   
						<div class="margin-bottom-50 form-width">
							<div class="margin-bottom-50">
								<span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
								<ul class="list-unstyled breadcrumb breadcrumb-custom">
									<li>
										<a href="{{url('admin/dashboard')}}">Time Management</a>
									</li>
									<li>
										<a href="{{url('admin/timesheetapprovals')}}">
											Time Approval settings
										</a>
									</li>
									<li>
										<span>
											Approvers Form
										</span>
									</li>
								</ul>
							</div>
							
							<div class="col-md-12 no-pade">
								<div class="col-xs-12 col-md-6 no-pade">
									<h4>
										Approvers Form
									</h4>
									<br />
									<!-- Vertical Form -->
								</div>
							</div>	
							
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group form-margin-btm">
										<div class="col-xs-12 col-sm-3">	
											<label>Employee Name<span class="required">*</span></label>
										</div>
										<div class="col-xs-12 col-sm-9">
											<select class="form-control" id="time_sheet_user_id" name="time_sheet_user_id">
											  <option value="" selected>Select User</option>
											  @foreach($employees_list as $employee)
											  {
												<option value="{{$employee->employee_id}}">{{$employee->employee_first_name}} {{$employee->employee_middle_name}} {{$employee->employee_last_name}}</option>
											  }	
											  @endforeach
											</select>
										</div>
									</div>	
								</div>
								
								<div class="col-xs-12">
									<div class="form-group form-margin-btm">
										<div class="col-xs-12 col-sm-3">	
											<label>Approver Name<span class="required">*</span></label>
										</div>
										<div class="col-xs-12 col-sm-9">
											<select class="form-control" id="time_sheet_approver_id" name="time_sheet_approver_id">
											  <option value="" selected>Select Approver</option>
											  @foreach($employees_list as $employee)
											  {
												<option value="{{$employee->employee_id}}">{{$employee->employee_first_name}} {{$employee->employee_middle_name}} {{$employee->employee_last_name}}</option>
											  }	
											  @endforeach
											</select>
										</div>
									</div>	
								</div>
								
                      <!--<div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                                <div class="col-xs-12 form-actions">
                                    <button type="submit" class="btn btn-primary width-150">Submit</button>
                                    <a href="{{url('admin/timesheetapprovals')}}"><button type="button" class="btn btn-default">Cancel</button></a>	
                                </div>                     
                          <!--<button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>-->
							</div>
						</div>
					</form>
                  </div>
                </div>
			</div>
	</section>
	@endsection
