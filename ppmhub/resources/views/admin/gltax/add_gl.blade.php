@extends('layout.adminlayout')

<?php if (isset($gl) && $gl->id) { ?>
    @section('title','Settings | Edit Gl Account Tax')
<?php } else { ?>
    @section('title','Settings | Create Gl Account Tax')
<?php } ?>

@section('body')

<!-- Material Group -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/gltax.js') !!}


<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if(!isset($gl->id))
                {!! Form::open(array('url' => 'admin/GlAccountTax','method'=>'post','id' => 'Actaxform')) !!} 
                @else
                {!! Form::open(array('route'=>array('GlAccountTax.update',$gl->id),'method' => 'put','id' => 'Actaxform')) !!}
                @endif
                {{ csrf_field() }}


                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Settings</a>
                            </li>
                            <li>
                                <a href="{{url('admin/GlAccountTax')}}">Add Gl Account Tax</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($gl) && $gl->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Gl Account Tax  </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($gl) && $gl->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Gl Account Tax
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block bg-lightcyan">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Gl Account Tax No.:</label>

                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-input-icon">
                                                {!!Form::text('glaccount_tax',isset($gl->glaccount_tax) ? $gl->glaccount_tax : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter gl tax number'])!!}                                                
                                                @if($errors->has('glaccount_tax')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('glaccount_tax') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status :</label>

                                        <div class="col-sm-3">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($gl->status))
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @else
                                                @if($gl->status == 'active')
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">  
                                                    {!! Form::radio('status','inactive')!!}Inactive
                                                </a>
                                                @else
                                                <a class="active-btn btn btn-primary"> 
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default active">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        <!--<div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                        <div class="card-footer card-footer-box">
                            @if(!isset($gl->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <!--<button type="submit" class="btn btn-primary width-150">Submit</button>-->
                            <a href="{{url('admin/GlAccountTax')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>                      
                        <!--<button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>-->
                        {!!Form::close()!!}
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
