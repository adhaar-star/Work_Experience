@extends('layout.adminlayout')
@section('title','View Types')

@section('body')



<section class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
						<div class="togle-btn pull-right">
							 <div class="dropdown inner-drpdwn">
								<a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
									<span class="hidden-lg-down">Settings</span>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="" role="menu">
									<a class="dropdown-item" href="{{url('admin/portfoliotypes')}}">Portfolio Type</a>
									<a class="dropdown-item" href="{{url('admin/projecttype')}}">Project Type</a>
									<a class="dropdown-item" href="{{url('admin/phasetype')}}">Phase Type</a>
									<a class="dropdown-item" href="{{url('admin/currencies')}}">Currency</a>
									<a class="dropdown-item" href="{{url('admin/capacityunits')}}">Capacity Units</a>
									<a class="dropdown-item" href="{{url('admin/periodtype')}}">Period Types</a>
									<a class="dropdown-item" href="{{url('admin/planningunit')}}">Planning Unit</a>
									<a class="dropdown-item" href="{{url('admin/planningtype')}}">Planning Type</a>
									<a class="dropdown-item" href="{{url('admin/costingtype')}}">Costing Type</a>
									<a class="dropdown-item" href="{{url('admin/collectiontype')}}">Collection Type</a>
									<a class="dropdown-item" href="{{url('admin/viewtype')}}">View Type</a>
									<a class="dropdown-item" href="{{url('admin/projectlocation')}}">Project Location</a>
									<a class="dropdown-item" href="{{url('admin/costcentretype')}}">Cost Center</a>
									<a class="dropdown-item" href="{{url('admin/departmenttype')}}">Department Type</a>
									<a class="dropdown-item" href="{{url('admin/personresponsible')}}">Person Responsible</a>
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
						
                    <form id="viewtype" method="post" action="<?php if(isset($viewtype) && $viewtype->id){ echo url('admin/viewtype/'.$viewtype->id); }else{ echo url('admin/viewtype'); } ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                      {{ csrf_field() }}
                      @if(isset($viewtype) && $viewtype->id)
                      {{ method_field('PUT') }}
                       @endif 
					   
						<div class="margin-bottom-50 form-width">
							<div class="margin-bottom-50">
								<span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
								<ul class="list-unstyled breadcrumb breadcrumb-custom">
									<li>
										<a href="{{url('admin/dashboard')}}">Settings</a>
									</li>
									<li>
										<a href="{{url('admin/viewtype')}}">View Type</a>
									</li>
									<li>
										<span>
											@if(isset($viewtype) && $viewtype->id)
											Edit
											@else
											Create
											@endif 
											View Types
										</span>
									</li>
								</ul>
							</div>
							
							<div class="col-md-12 no-pade">
								<div class="col-xs-12 col-md-6 no-pade">
									<h4>
										@if(isset($viewtype) && $viewtype->id)
										Edit
										@else
										Create
										@endif 
										View Types
									</h4>
									<br />
									<!-- Vertical Form -->
								</div>
							</div>	
							
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group form-margin-btm">
										<div class="col-xs-12 col-sm-3">
											<label>Name</label>
										</div>
										<div class="col-xs-12 col-sm-9">
											<div class="form-input-icon">
												<input type="text" placeholder="Name" id="name" name="name" value="<?php if(isset($viewtype)){ echo $viewtype->name; } ?>" required="required" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12">
									<div class="form-group form-margin-btm">
										<div class="col-xs-12 col-sm-3">
											<label>Description</label>
										</div>
										<div class="col-xs-12 col-sm-9">
											<div class="form-input-icon">
												<input type="text" placeholder="Description" id="description" name="description" value="<?php if(isset($viewtype)){ echo $viewtype->description; } ?>" required="required" class="form-control">
											</div>
										</div>
									</div>
								</div>
						
						<?php
                                        if(isset($viewtype->created_at) && (!empty($viewtype->created_at)))
                                           {
                                      ?>   <input type="hidden" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                       <?php }else{?>
                                          <input type="hidden" id="created_at" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                      <?php }?>
								
								<div class="col-xs-12">
									<div class="form-group form-margin-btm">
										<div class="col-xs-12 col-sm-3">
											<label>Status</label>
										</div>
										<div class="col-xs-12 col-sm-9">
											<div class="btn-group" data-toggle="buttons">
												<label class="active-btn btn btn-default active">
													<input type="radio" name="status" value="active" <?php if(isset($viewtype) && $viewtype->status=='active'){ echo "checked"; } ?>>
													Active
												</label>
												<label class="inactive-btn btn btn-default">
													<input type="radio" name="status" value="inactive" <?php if(isset($viewtype) && $viewtype->status=='inactive'){ echo "checked"; } ?>>
												   Inactive
												</label>
											</div>
										</div>
									</div>
								</div>
								
					
                      <!--<div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                                <div class="col-xs-12 form-actions">
                                    <button type="submit" class="btn btn-primary width-150">Submit</button>
									<a href="{{url('admin/viewtype')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                                </div>                       
                          <!--<button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>-->

                    </form>
                  </div>
                </div>
			  </div>
            </div>
          </div> 
@endsection
