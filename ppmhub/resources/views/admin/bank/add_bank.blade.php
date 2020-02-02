@extends('layout.adminlayout')

<?php if (isset($bankname) && $bankname->id) { ?>
    @section('title','Settings | Edit Bank Name')
<?php } else { ?>
    @section('title','Settings | Create Bank Name')
<?php } ?>

@section('body')

<!-- Bank Name -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/mcategory_validation.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                <!--                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif-->

                @if(!isset($bankname->id))
                {!! Form::open(array('url' => 'admin/addBank','method'=>'post','id' => 'Bankform')) !!} 
                @else
                {!! Form::open(array('route'=>array('bank.update',$bankname->id),'method' => 'put','id' => 'Bankform')) !!}
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
                                <a href="{{url('admin/addBank')}}">Bank Name</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($bankname) && $bankname->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    BankName </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($bankname) && $bankname->id)
                                Edit
                                @else
                                Create
                                @endif 
                                BankName
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block bg-lightcyan">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Name* :</label>

                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-input-icon">
                                                {!!Form::text('bank_name',isset($bankname->bank_name) ? $bankname->bank_name : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter bank Name'])!!}
                                                @if($errors->has('bank_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('bank_name') }}
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

                                                @if(!isset($bankname->status))

                                                <a class="active-bttn btn btn-primary active">

                                                    {!! Form::radio('status','active','active')!!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-default">

                                                    {!! Form::radio('status','inactive') !!}Inactive

                                                </a>
                                                @else
                                                @if($bankname->status == 'active')
                                                <a class="active-bttn btn btn-primary active">

                                                    {!! Form::radio('status','active')!!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-default">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <a class="active-bttn btn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
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
                            @if(!isset($bankname->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <!--<button type="submit" class="btn btn-primary width-150">Submit</button>-->
                            <a href="{{url('admin/addBank')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
