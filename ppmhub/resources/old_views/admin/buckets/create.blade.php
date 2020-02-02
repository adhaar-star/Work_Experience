@extends('layout.adminlayout')
@section('title','Buckets')
@section('headjscss')
@endsection
@section('body')
	<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                        @if(isset($buckets) && $buckets->id)
                        Edit
                        @else
                        Add
                        @endif 
                        Bucket </h2>
                   
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
                    <form id="buckets" method="post" action="<?php if(isset($buckets) && $buckets->id){ echo url('admin/portfolio/'.$buckets->id); }else{ echo url('admin/buckets'); } ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                      {{ csrf_field() }}
                      @if(isset($buckets) && $buckets->id)
                      {{ method_field('PUT') }}
                       @endif 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php if(isset($buckets)){ echo $buckets->name; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">buckets <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<?php if(isset($buckets)){?>
                        {!! Form::select('buckets', $buck, old('buckets', $buckets->buckets), array('class'=>'form-control col-md-7 col-xs-12')) !!}
                        <?php }else{?>
                        {!! Form::select('buckets', $buck, old('buckets'), array('class'=>'form-control col-md-7 col-xs-12')) !!}	
                        <?php }?>
							
                          <!--input type="text" id="buckets" name="buckets" value="<?php //if(isset($buckets)){ echo $buckets->buckets; } ?>" required="required" class="form-control col-md-7 col-xs-12"-->
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">initiatives <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="initiatives" name="initiatives" value="<?php if(isset($buckets)){ echo $buckets->initiatives; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">items <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="items" name="items" value="<?php if(isset($buckets)){ echo $buckets->items; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">currency <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							 <?php if(isset($buckets)){?>
                        {!! Form::select('currency', $currency, old('currency',$buckets->currency), array('class'=>'form-control col-md-7 col-xs-12')) !!}
                        <?php }else{?>
                        {!! Form::select('currency', $currency, old('currency'), array('class'=>'form-control col-md-7 col-xs-12')) !!}	
                        <?php }?>
                          <!--input type="text" id="currency" name="currency" value="<?php //if(isset($buckets)){ echo $buckets->currency; } ?>" required="required" class="form-control col-md-7 col-xs-12"-->
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
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" name="description" value=""  required="required" class="form-control col-md-7 col-xs-12"><?php if(isset($buckets)){ echo $buckets->description; } ?></textarea>
                        </div>
                      </div>

                      @if(isset($buckets) && $buckets->id)
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio"  name="status" value="1" <?php if(isset($buckets) && $buckets->status==1){ echo "checked"; } ?>> Active
                          <input type="radio"  name="status" value="0" <?php if(isset($buckets) && $buckets->status==0){ echo "checked"; } ?>> Inactive
                        </div>
                      </div>
                      @endif
                  
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