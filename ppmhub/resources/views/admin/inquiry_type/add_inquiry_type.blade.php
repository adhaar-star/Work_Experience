@extends('layout.adminlayout')

<?php if (isset($inquirytype) && $inquirytype->id) { ?>
    @section('title','Settings | Edit Inquiry Type')
<?php } else { ?>
    @section('title','Settings | Create Inquiry Type')
<?php } ?>

@section('body')

<!-- Material Group -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/customer_inquiry.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if(!isset($inquirytype->id))
                {!! Form::open(array('url' => 'admin/inquiry_type','method'=>'post','id' => 'Typeform')) !!} 
                @else
                {!! Form::open(array('route'=>array('inquiry_type.update',$inquirytype->id),'method' => 'put','id' => 'Typeform')) !!}
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
                                <a href="{{url('admin/inquiry_type')}}">Inquiry Type</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($inquirytype) && $inquirytype->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Inquiry Type  </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($inquirytype) && $inquirytype->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Inquiry Type
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block bg-lightcyan">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Type* :</label>

                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-input-icon">
                                                {!!Form::text('inquiry_type',isset($inquirytype->inquiry_type) ? $inquirytype->inquiry_type : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter inquiry type name'])!!}
                                                @if($errors->has('inquiry_type')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('inquiry_type') }}
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
                                                @if(!isset($inquirytype->status))
                                                    <a class="active-bttn btn btn-primary active">
                                                        {!! Form::radio('status','active','active')!!}Active
                                                    </a>
                                                    <a class="inactive-btn btn btn-default">
                                                        {!! Form::radio('status','inactive') !!}Inactive
                                                    </a>
                                                @else
                                                    @if($inquirytype->status == 'active')
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
                            @if(!isset($inquirytype->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <!--<button type="submit" class="btn btn-primary width-150">Submit</button>-->
                            <a href="{{url('admin/inquiry_type')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
