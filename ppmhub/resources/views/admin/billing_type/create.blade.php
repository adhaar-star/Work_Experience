@extends('layout.adminlayout')
@if(isset($billing->id))
@section('title','Settings | Edit Billing Type')
@else
@section('title','Settings | Create Billing Type')
@endif
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/billing_type.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')
                @if(!isset($billing->id))
                {!! Form::open(array('url' => 'admin/billing_type','method'=>'post','id' => 'billingform')) !!} 
                @else
                {!! Form::open(array('route'=>array('billingType.update',$billing->id),'method' => 'put','id' => 'billingform')) !!}
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
                                <a href="{{url('admin/billing_type')}}">Billing Type</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($billing) && $billing->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Billing Type
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header">
                            <h4 class="margin-0">
                                @if(isset($billing) && $billing->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Billing Type
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label text-right">Billing Name* :</label>

                                        <div class="col-xs-12 col-sm-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('name',isset($billing->name) ? $billing->name : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter billing name'])!!}
                                                @if($errors->has('name')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status :</label>

                                        <div class="col-sm-10">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($billing->status))
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @else
                                                @if($billing->status == 'active')
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">  
                                                    {!! Form::radio('status','inactive')!!}Inactive
                                                </a>
                                                @else
                                                <a class="active-bttn btn btn-primary"> 
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
                        <div class="card-footer card-footer-box">
                            @if(!isset($billing->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <a href="{{url('admin/billing_type')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>                      
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
