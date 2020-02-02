@extends('layout.adminlayout')
@section('title','Portfolio')
@section('headjscss')
@endsection
@section('body')
	<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                        @if(isset($portfolio) && $portfolio->id)
                        Edit
                        @else
                        Add
                        @endif 
                        Portfolio </h2>
                   
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
                    <?php if(isset($portfolio) && $portfolio->id){ //echo url('admin/portfolio/'.$portfolio->id); 
                    ?>
                   	{!! Form::model($portfolio, array('class' => 'form-horizontal', 'id' => 'Portfoliotypeform', 'method' => 'PATCH', 'route' => array('portfolio.update', $portfolio->id))) !!}
                    <?php }else{ ?>
                    {!! Form::open(array('route' => 'portfolio.store', 'id' => 'Portfoliotypeform', 'class' => 'form-horizontal')) !!} 
                        
                      <?php   
                    //    echo url('admin/portfolio'); 
                    
                    } ?>
                    
                   
                    <!--  <form id="Portfoliotypeform" method="post" action="<?php //if(isset($portfolio) && $portfolio->id){ echo url('admin/portfolio/'.$portfolio->id); }else{ echo url('admin/portfolio'); } ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">-->
                      {{ csrf_field() }}
                      @if(isset($buckets) && $buckets->id)
                      {{ method_field('PUT') }}
                       @endif 
					   
					
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php if(isset($portfolio)){ echo $portfolio->name; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Portfolio Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php if(isset($portfolio)){?>
                        {!! Form::select('type',$ptype, old('type', $portfolio->type), array('class'=>'form-control col-md-7 col-xs-12')) !!}
                        <?php }else{?>
                        {!! Form::select('type',$ptype, old('type'), array('class'=>'form-control col-md-7 col-xs-12')) !!}	
                        <?php }?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">buckets <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php if(isset($portfolio)){?>
                        {!! Form::select('buckets', $buck, old('buckets', $portfolio->buckets), array('class'=>'form-control col-md-7 col-xs-12')) !!}
                        <?php }else{?>
                        {!! Form::select('buckets', $buck, old('buckets'), array('class'=>'form-control col-md-7 col-xs-12')) !!}	
                        <?php }?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">initiatives <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="initiatives" name="initiatives" value="<?php if(isset($portfolio)){ echo $portfolio->initiatives; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">items <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="items" name="items" value="<?php if(isset($portfolio)){ echo $portfolio->items; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">projects <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="projects" name="projects" value="<?php if(isset($portfolio)){ echo $portfolio->projects; } ?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">currency <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- <input type="text" id="currency" name="currency" value="<?php if(isset($portfolio)){ echo $portfolio->currency; } ?>" required="required" class="form-control col-md-7 col-xs-12">-->
                      <?php if(isset($portfolio)){?>
                        {!! Form::select('currency', $currency, old('currency',$portfolio->currency), array('class'=>'form-control col-md-7 col-xs-12')) !!}
                        <?php }else{?>
                        {!! Form::select('currency', $currency, old('currency'), array('class'=>'form-control col-md-7 col-xs-12')) !!}	
                        <?php }?>
                        </div>
                      </div>
                      <?php
                        if(isset($portfolio->created_by) && (!empty($portfolio->created_by)))
                           { 
                      ?>  <input type="hidden" id="edited_by" name="edited_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                       <?php }else{?>
                          <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                      <?php }?>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" name="description" value=""  required="required" class="form-control col-md-7 col-xs-12"><?php if(isset($portfolio)){ echo $portfolio->description; } ?></textarea>
                        </div>
                      </div>

                      @if(isset($portfolio) && $portfolio->id)
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio"  name="status" value="active" <?php if(isset($portfolio) && $portfolio->status=='active'){ echo "checked"; } ?>> Active
                          <input type="radio"  name="status" value="inactive" <?php if(isset($portfolio) && $portfolio->status=='inactive'){ echo "checked"; } ?>> Inactive
                        </div>
                      </div>
                      @endif
                  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                     
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    <!-- </form> -->
                    {!! Form::close() !!}
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