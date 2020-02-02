@extends('layout.adminlayout')

<?php if (isset($gl) && $gl->id) { ?>
    @section('title','Settings | Edit Gl Account')
<?php } else { ?>
    @section('title','Settings | Create Gl Account')
<?php } ?>

@section('body')

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if(!isset($gl->id))
                {!! Form::open(array('url' => 'admin/GlAccount','method'=>'post','id' => 'Acform')) !!} 
                @else
                {!! Form::open(array('route'=>array('GlAccount.update',$gl->id),'method' => 'put','id' => 'Acform')) !!}
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
                                <a href="{{url('admin/GlAccount')}}">Add Gl Account</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($gl) && $gl->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Gl Account  </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card card-info-custom">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($gl) && $gl->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Gl Account
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row" style="margin: 0;">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Gl Account No.:</label>

                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('gl_account_number',isset($gl->gl_account_number) ? $gl->gl_account_number : $rand_number,array('class'=>'form-control border-radius-0','readonly'))!!}
                                                @if($errors->has('gl_account_number')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('gl_account_number') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Gl Account Description :</label>

                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('gl_account_description',isset($gl->gl_account_description) ? $gl->gl_account_description : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter gl account description','maxlength'=>191])!!}
                                                @if($errors->has('gl_account_description')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('gl_account_description') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Cost Element Type :</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('cost_element_type',isset($gl->cost_element_type) ? $gl->cost_element_type : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter cost element type'])!!}
                                                @if($errors->has('cost_element_type')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('cost_element_type') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Flag Type :</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('type_flag',[ 'EXPR'=>'EXPR','GRIR'=>'GRIR','GSPR'=>'GSPR','FAPR'=>'FAPR','FASA'=>'FASA','GSSA'=>'GSSA' ],isset($gl->type_flag) ? $gl->type_flag :'',['class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Flag Type'])!!}
                                                @if($errors->has('type_flag')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('type_flag') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>



                            </div>
                        </div>

                        <div class="card-footer card-footer-box text-right">
                            @if(!isset($gl->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <a href="{{url('admin/GlAccount')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>             
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
