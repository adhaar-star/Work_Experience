@extends('layout.adminlayout')
@section('title','Setting | Project Type')
@section('headjscss')
@endsection
@section('body')
	<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                        @if(isset($projecttypes) && $projecttypes->id)
                        Edit
                        @else
                        Add
                        @endif 
                        Project Type</h2>
                   
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
                    <form id="Portfoliotypeform" method="post" action="<?php if(isset($projecttypes) && $projecttypes->id){ echo url('admin/portfoliotypes/'.$projecttypes->id); }else{ echo url('admin/projecttypes'); } ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                      {{ csrf_field() }}
                      @if(isset($projecttypes) && $projecttypes->id)
                      {{ method_field('PUT') }}
                       @endif 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php if(isset($projecttypes)){ echo $projecttypes->name; } ?>"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      @if(isset($projecttypes) && $projecttypes->id)
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio"  name="status" value="yes" <?php if(isset($projecttypes) && $projecttypes->status=='yes'){ echo "checked"; } ?>> Active
                          <input type="radio"  name="status" value="no" <?php if(isset($projecttypes) && $projecttypes->status=='no'){ echo "checked"; } ?>> Inactive
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