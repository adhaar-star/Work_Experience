@extends('layout.adminlayout')
<?php if(isset($buckets) && $buckets->id){ ?>
@section('title','Edit Bucket')
<?php }else{ ?>
@section('title','Create Bucket')
<?php } ?>


@section('body')
 <section class="panel">
            <!--div class="panel-heading">
                <h3>Basic Form Elements</h3>
            </div-->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
						<div class="togle-btn pull-right">
							 <div class="dropdown inner-drpdwn">
								<a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
									<span class="hidden-lg-down">Portfolio Management</span>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="" role="menu">
									<a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
									<a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
									<a class="dropdown-item" href="{{url('admin/portfolioStructure')}}">Portfolio Structure</a>
									<a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
									<a class="dropdown-item" href="{{url('admin/portfolioresourceplanning')}}">Portfolio Resource Planning</a>
									<!--div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
								</ul>
							</div> 
						</div>	
						<?php if(isset($buckets) && $buckets->id){ 
							?>
							{!! Form::model($buckets, array('class' => '', 'id' => 'bucketstypeform', 'method' => 'PATCH', 'route' => array('buckets.update', $buckets->id))) !!}
							<?php }else{ ?>
							{!! Form::open(array('route' => 'buckets.store', 'id' => 'bucketstypeform', 'class' => '')) !!} 
							  <?php   
								} ?>
					
                        <div class="margin-bottom-50 form-width">
                            <!--<div class="dashboard-buttons">
                                <a href="{{url('admin/buckets')}}" class="btn btn-primary width-200 margin-top-10">
                                    <i class="fa fa-long-arrow-left margin-right-5"></i>
                                    Back
                                </a>
                            </div>-->
							<div class="margin-bottom-50">
								<span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
								<ul class="list-unstyled breadcrumb breadcrumb-custom">
									<li>
										<a href="{{url('admin/dashboard')}}">Portfolio Management</a>
									</li>
									<li>
										<a href="{{url('admin/buckets')}}">Bucket</a>
									</li>
									<li>
										<span>
											@if(isset($buckets) && $buckets->id)
											Edit
											@else
											Create
											@endif 
											Bucket
										</span>
									</li>
								</ul>
							</div>
							<div class="col-md-12 no-pade">
								<div class="col-xs-12 col-md-6 no-pade">
									<h4>
									 @if(isset($buckets) && $buckets->id)
										Edit
										@else
										Create
										@endif 
										Bucket
									</h4>
									<br />
									<!-- Vertical Form -->
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
							</div>	
								
                      {{ csrf_field() }}
                      @if(isset($buckets) && $buckets->id)
                      {{ method_field('PUT') }}
                       @endif 
                                <div class="row">
									<div class="col-xs-12">
                                        <div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label for="l33">Bucket Name</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" class="form-control" placeholder="Bucket Name" id="name" name="name" value="<?php if(isset($buckets)){ echo $buckets->name; } ?>">
												</div>
											</div>
                                        </div>
                                    </div>
									
									<div class="col-xs-12">
                                        <div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label for="l33">Bucket ID</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<input type="text" class="form-control" placeholder="Bucket ID" id="bucket_id" name="bucket_id" value="<?php if(isset($buckets)){ echo $buckets->bucket_id; } else { echo $rand = substr(md5(microtime()),rand(0,26),3); } ?>" readonly >
												</div>
											</div>
                                        </div>
                                    </div>
									
									
									
                                    <div class="col-xs-12">
                                        <div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Parent </label>
											</div>
                                            <?php 
												//echo "<pre>";
//print_r($buck);
												?>
											<div class="col-xs-12 col-sm-9">	
												<select name="buckets" id="buckets" class="select2">
													@foreach($buck as $buck)
													@if($buck->children->count() > 0)
														<option value="{{ $buck->id }}">{{ $buck->name }}</option> 
													@foreach($buck->children as $submenu)
														<option value="{{ $submenu->id }}" selected>&nbsp;|_{{ $submenu->name }}</option> 
													@endforeach
													@else
														<option value="{{ $buck->id }}">{{ $buck->name }}</option>
													@endif
													
													@endforeach
												</select>
											</div>
                                        </div>
                                    </div>
									<?php
                        if(isset($buckets->created_by) && (!empty($buckets->created_by)))
                           { 
                      ?>  <input type="hidden" id="edited_by" name="edited_by" value="<?php //echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                       <?php }else{?>
                          <input type="hidden" id="created_by" name="created_by" value="<?php //echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                          
                      <?php }?>
									  
									<div class="col-xs-12">
										<div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label for="l33">Description</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="form-input-icon">
													<textarea id="description" name="description"  required="required" class="form-control"><?php if(isset($buckets)){ echo $buckets->description; } ?></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
                                        <div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label for="l33">Cost Center</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<?php if(isset($buckets)){?>
												{!! Form::select('costcentretype',$costcentretype, old('costcentretype', $buckets->costcentretype), array('class'=>'select2')) !!}
												<?php }else{?>
												{!! Form::select('costcentretype',$costcentretype, old('costcentretype'), array('class'=>'select2')) !!}	
												<?php }?>
												
												
											</div>
                                        </div>
                                    </div>
									<div class="col-xs-12">
                                        <div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label for="l33">Department</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<?php if(isset($buckets)){?>
												{!! Form::select('department',$department, old('department', $buckets->department), array('class'=>'select2')) !!}
												<?php }else{?>
												{!! Form::select('department',$department, old('department'), array('class'=>'select2')) !!}	
												<?php }?>
												
												
											</div>
                                        </div>
                                    </div>
									<div class="col-xs-12">
                                        <div class="form-group form-margin-btm">
											<div class="col-xs-12 col-sm-3">
												<label>Currency</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<?php if(isset($buckets)){?>
												{!! Form::select('currency', $currency, old('currency',$buckets->currency), array('class'=>'select2')) !!}
												<?php }else{?>
												{!! Form::select('currency', $currency, old('currency'), array('class'=>'select2')) !!}	
												<?php }?>
											</div>
                                        </div>
                                    </div>
                                
									<div class="col-xs-12">
										<div class="form-group">
											<div class="col-xs-12 col-sm-3">
												<label>Status</label>
											</div>
											<div class="col-xs-12 col-sm-9">
												<div class="btn-group" data-toggle="buttons">
													<label class="active-btn btn btn-default active">
														<input type="radio" id="status" name="status" value="active" <?php if(isset($buckets) && $buckets->status=='active'){ echo "checked"; } ?>>
														Active
													</label>
													<label class="inactive-btn btn btn-default">
														<input type="radio" id="status" name="status" value="inactive" <?php if(isset($buckets) && $buckets->status=='inactive'){ echo "checked"; } ?>>
													   Inactive
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
                                <div class="col-xs-12 form-actions">
                                    <button type="submit" class="btn btn-primary width-150">
										@if(isset($buckets) && $buckets->id)
											Save Changes
											@else
											Submit
											@endif 
											
									</button>
									<a href="{{url('admin/buckets')}}"><button type="button" class="btn btn-default width-150">Cancel</button></a>
                                </div>
                            
                            <!-- End Vertical Form -->
                        </div>
						 </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Dashboard -->

        <!-- Page Scripts -->
	
@endsection