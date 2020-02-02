@extends('layout.admin')
@section('title', 'Material Master')
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($materialCategory))
                    {!! Form::open([ 'route' => [ $route.'.update', $materialCategory->material_category_id ],  'method' => 'put', 'class' => 'form-horizontal GlobalFormValidation' ]) !!}
                @else
                    {!! Form::open([ 'route' => [ $route.'.store'], 'method' =>'post', 'class'=> 'form-horizontal GlobalFormValidation' ]) !!}
                @endif
                <div class="margin-bottom-50">
                    <div class="row PageTitleGlobal">
                        <div class="col-md-6">
                            <h1>Material Category</h1>
                        </div>
                        <div class="col-md-6 text-right">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route( $route .'.index') }}">Material Categories</a></li>
                                <li><span>@if(!empty($materialCategory))  Update @else Create @endif Material Category</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            @if(empty($materialCategory) )
                                <h4 class="margin-0">Create Material Category</h4>
                            @else
                                <h4 class="margin-0">Update Material Category</h4>
                            @endif
                        </div>
                        <div class="card-block">
                             <div class="row" style="margin: 0;">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Category Name<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('name', !empty($materialCategory) ? $materialCategory->name : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter  Name',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Name Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status :</label>
                                        <div class="col-sm-3">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($materialCategory->status))
                                                    <a class="active-btn btn btn-primary active">{!! Form::radio('status', 1, true)!!}Active</a>
                                                    <a class="inactive-btn btn btn-default">{!! Form::radio('status', 0) !!}Inactive</a>
                                                @else
                                                    @if($materialCategory->status == 1)
                                                        <a class="active-btn btn btn-primary active">{!! Form::radio('status', 1, true)!!}Active</a>
                                                        <a class="inactive-btn btn btn-default">  {!! Form::radio('status', 0)!!}Inactive</a>
                                                    @else
                                                        <a class="active-btn btn btn-primary"> {!! Form::radio('status', 1)!!}Active</a>
                                                        <a class="inactive-btn btn btn-default active">{!! Form::radio('status', 0, true) !!}Inactive</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-lg-offset-1" style="margin-top: 10px;">
                                    @include('layout.admin_layout_include.alert_process')
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{route( $route .'.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
    {!! Html::script('vendors/formValidation/js/formValidation.min.js') !!}
    {!! Html::script('vendors/formValidation/js/framework/bootstrap.min.js') !!}
    {!! Html::script('js/globalValidationCustom.js') !!}
@endsection