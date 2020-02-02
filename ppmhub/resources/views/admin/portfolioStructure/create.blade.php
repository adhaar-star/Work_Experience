@extends('layout.adminlayout')
@section('title','Create Buckets')

@section('body')

<style>
.togle-btn {
  margin-bottom: 30px;
}
.inner-drpdwn {
  border: 1px solid #ddd;
  padding: 8px;
}
</style>
 <section class="panel">
            <!--div class="panel-heading">
                <h3>Basic Form Elements</h3>
            </div-->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
						<div class="togle-btn">
							 <div class="dropdown inner-drpdwn">
								<a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
									<span class="hidden-lg-down">Project Management</span>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="" role="menu">
									<a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
									<a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
									<a class="dropdown-item" href="javascript:void(0)">Portfolio Structure</a>
									<a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
									<a class="dropdown-item" href="javascript:void(0)">Portfolio Resource Plaining</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-cog"></i> Settings</a>
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
							<div class="col-md-12 no-pade">
							<div class="col-xs-12 col-md-6 no-pade">
                            <h4>
							 @if(isset($buckets) && $buckets->id)
                        Edit
                        @else
                        Add
                        @endif 
                        Bucket</h4>
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
							
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label>Status</label>
								
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
							
                            
							
								
							<!--form id="buckets" method="post" action="<?php //if(isset($buckets) && $buckets->id){ echo url('admin/portfolio/'.$buckets->id); }else{ echo url('admin/buckets'); } ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""-->
							
                      {{ csrf_field() }}
                      @if(isset($buckets) && $buckets->id)
                      {{ method_field('PUT') }}
                       @endif 
                                <div class="row">
								
								
							
									 
									 <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="l33">Bucket Name</label>
                                            <div class="form-input-icon">
                                                <input type="text" class="form-control" placeholder="Bucket Name" id="name" name="name" value="<?php if(isset($buckets)){ echo $buckets->name; } ?>">
                                            </div>
                                        </div>
                                    </div>
									 
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Parent </label>
                                            <?php if(isset($buckets)){?>
											{!! Form::select('buckets', $buck, old('buckets', $buckets->buckets), array('class'=>'select2')) !!}
											<?php }else{?>
											{!! Form::select('buckets', $buck, old('buckets'), array('class'=>'select2')) !!}	
											<?php }?>
                                            
                                        </div>
                                    </div>
                                   
                                    <!--div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="l32">Items</label>
                                            <div class="form-input-icon">
                                                <input type="text" class="form-control" placeholder="Items" id="items" name="items" value="<?php //if(isset($buckets)){ echo $buckets->items; } ?>">
                                            </div>
                                        </div>
                                    </div-->
									
									 <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Currency</label>
                                             <?php if(isset($buckets)){?>
												{!! Form::select('currency', $currency, old('currency',$buckets->currency), array('class'=>'select2')) !!}
												<?php }else{?>
												{!! Form::select('currency', $currency, old('currency'), array('class'=>'select2')) !!}	
												<?php }?>
                                        </div>
                                    </div>
									
									<?php
                        if(isset($buckets->created_by) && (!empty($buckets->created_by)))
                           { 
                      ?>  <input type="hidden" id="edited_by" name="edited_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="edited_date" name="edited_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                       <?php }else{?>
                          <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                          
                      <?php }?>
									  
									  <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="l33">Description</label>
                                            <div class="form-input-icon">
											<textarea id="description" name="description"  required="required" class="form-control"><?php if(isset($buckets)){ echo $buckets->description; } ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary width-150">Submit</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
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