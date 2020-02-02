@extends('layout.adminlayout')

<?php if (isset($unitofmeasure) && $unitofmeasure->id) { ?>
    @section('title','Settings | Edit Unit Of Measure')
<?php } else { ?>
    @section('title','Settings | Create Unit Of Measure')
<?php } ?>

@section('body')

<!-- Material Group -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/mcategory_validation.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(!isset($unitofmeasure->id))
                {!! Form::open(array('url' => 'admin/addUnitOfMeasure','method'=>'post','id' => 'Unitform')) !!} 
                @else
                {!! Form::open(array('route'=>array('unitMeasure.update',$unitofmeasure->id),'method' => 'put','id' => 'Unitform')) !!}
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
                                <a href="{{url('admin/addUnitOfMeasure')}}">Add Unit Of Measure</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($unitofmeasure) && $unitofmeasure->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Unit Of Measure  </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($unitofmeasure) && $unitofmeasure->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Unit Of Measure
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block bg-lightcyan">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Unit Of Measure* :</label>

                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-input-icon">
                                                {!!Form::text('unitofmeasure',isset($unitofmeasure->unitofmeasure) ? $unitofmeasure->unitofmeasure : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter name'])!!}
                                                @if($errors->has('unitofmeasure')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('unitofmeasure') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status :</label>

                                        <div class="col-sm-9">
                                            <div class="btn-group" data-toggle="buttons">

                                                @if(!isset($unitofmeasure->status))

                                                <a class="active-bttn btn btn-default active">

                                                    {!! Form::radio('status','active','active')!!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-default">

                                                    {!! Form::radio('status','inactive') !!}Inactive

                                                </a>
                                                @else
                                                @if($unitofmeasure->status == 'active')
                                                <a class="active-bttn btn btn-default active">

                                                    {!! Form::radio('status','active')!!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-default">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <a class="active-bttn btn btn-default"> {!! Form::radio('status','active')!!}Active</a>
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
                            @if(!isset($unitofmeasure->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <!--<button type="submit" class="btn btn-primary width-150">Submit</button>-->
                            <a href="{{url('admin/addUnitOfMeasure')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
