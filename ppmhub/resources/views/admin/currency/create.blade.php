@extends('layout.adminlayout')
@section('title','Currencies')
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/currency_validation.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Settings</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfoliotypes')}}">Portfolio Type</a>
                            <a class="dropdown-item" href="{{url('admin/projecttype')}}">Project Type</a>
                            <a class="dropdown-item" href="{{url('admin/phasetype')}}">Phase Type</a>
                            <a class="dropdown-item" href="{{url('admin/currencies')}}">Currency</a>
                            <a class="dropdown-item" href="{{url('admin/capacityunits')}}">Capacity Units</a>
                            <a class="dropdown-item" href="{{url('admin/periodtype')}}">Period Types</a>
                            <a class="dropdown-item" href="{{url('admin/planningunit')}}">Planning Unit</a>
                            <a class="dropdown-item" href="{{url('admin/planningtype')}}">Planning Type</a>
                            <a class="dropdown-item" href="{{url('admin/costingtype')}}">Costing Type</a>
                            <a class="dropdown-item" href="{{url('admin/collectiontype')}}">Collection Type</a>
                            <a class="dropdown-item" href="{{url('admin/viewtype')}}">View Type</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>  
                    </div> 
                </div>

                <form id="currencies" method="post" action="<?php
                if (isset($currency) && $currency->id) {
                    echo url('admin/currencies/' . $currency->id);
                } else {
                    echo url('admin/currencies');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    @if(isset($currency) && $currency->id)
                    {{ method_field('PUT') }}
                    @endif 

                    <div class="margin-bottom-50">
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Settings</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/currencies')}}">Currency</a>
                                </li>
                                <li>
                                    <span>Edit Currency </span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-12 no-pade">
                            <!--                            <div class="col-xs-12 col-md-6 no-pade">
                                                            <h4> Create Currency </h4>
                                                            <br />
                                                             Vertical Form 
                                                        </div>-->

                        </div>		


                        <div class="card">
                            <div class="card-header card-header-box">
                                <h4 class="margin-0">
                                    @if(isset($currency) && $currency->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Currencies
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block bg-lightcyan">
                                <div class="row">
                                     <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right" for="l33">Currency* :<span class="required"></span></label>
                                        
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    {!!Form::text('short_code',isset($currency-> short_code) ? $currency->short_code : '',['class'=>'form-control border-radius-0'])!!}

                                                    @if($errors->has('short_code')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('short_code') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>	
                                     <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Currency Description* :</label>
                                            
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    {!!Form::text('fullname',isset($currency-> fullname) ? $currency->fullname : '',['class'=>'form-control border-radius-0'])!!}

                                                    @if($errors->has('fullname')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('fullname') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($currency->created_at) && (!empty($currency->created_at))) {
                                        ?>   <input type="hidden" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <?php } else { ?>
                                        <input type="hidden" id="created_at" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <?php } ?>
                                     <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status* :</label>
                                        
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="btn-group" data-toggle="buttons">

                                                    @if(!isset($currency->status))

                                                    <a class="active-bttn btn btn-primary active">

                                                        {!! Form::radio('status','active','active')!!}Active

                                                    </a>
                                                    <a class="inactive-btn btn btn-danger">

                                                        {!! Form::radio('status','inactive') !!}Inactive

                                                    </a>
                                                    @else
                                                    @if($currency->status == 'active')
                                                    <a class="active-bttn btn btn-primary active">

                                                        {!! Form::radio('status','active')!!}Active

                                                    </a>
                                                    <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                    @else
                                                    <a class="active-bttn btn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
                                                    <a class="inactive-btn btn btn-danger active">

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
                                        @if(!isset($currency))
                                        {!! Form::submit('Save',array('class'=>'btn btn-primary card-btn')) !!}  
                                        @else
                                        {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn')) !!}  

                                        @endif
                                        <a href="{{url('/admin/currencies')}}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
            </div>
            </section> 
            @endsection