@extends('layout.adminlayout')
@section('title','Create Manual Financial Planning')
@section('body')
@if(Session::has('flash_error'))
<div class="alert alert-danger">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_error') !!}</em>
</div>
@endif
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/manual_financial.js') !!}
<style>
    .new-form-section {
        background: #e5e5e5 none repeat scroll 0 0;
        float: left;
        margin-bottom: 5%;
        margin-top: 3%;
        position: relative;
        width: 100%;
    }
    .new-form-group {
        border-right: 2px solid #fff;
        margin: 0;
        padding: 30px 15px;
    }
    .col {
        position:relative;
        width:14.283%;
        float:left;
    }
</style>
<section id="create_form" class="panel">
    <!--- Bootstrap Model --->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>End Date can`t be less than Start Date.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Model -->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="row PageTitleGlobal">
                    <div class="col-md-3">
                        <h1>Manual Financial Planning</h1>
                    </div>
                    <div class="col-md-9 text-right">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                            </li>
                            <li>
                                <a href="{{url('admin/bucketfp')}}">Portfolio Financial Planning</a>
                            </li>
                            <li>
                                <a href="">Create Manual Financial Planning</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-12 togle-btn text-right">
                        <div class="dropdown inner-drpdwn">
                            <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                                <span class="hidden-lg-down">Portfolio Management</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="" role="menu">
                                <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                                <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                                <a class="dropdown-item" href="{{url('admin/portfolioStructure')}}">Portfolio Structure</a>
                                <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Planning</a>
                                <a class="dropdown-item" href="{{url('admin/portfoliocapacityplanning')}}">Portfolio Capacity Planning</a>
                            </ul>
                        </div> 
                    </div>
                </div>
                {!! Form::open(array('route' => 'manual-financial.store','method'=>'post', 'id' => 'ManualFinancialForm')) !!} 
                {{ csrf_field() }}
                <div class="margin-bottom-50">
                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                Create Manual Financial Planning 
                                <div class="col-md-6 pull-right">
                                    <label class="pull-right"><span class="text-danger">*</span>Mandatory fields</label>
                                </div>
                            </h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-3">
                                            <label>Portfolio<span class="text-danger">*</span>:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon"> 
                                                {!! Form::select('portfolio',$portfolio,'', array('class'=>'select2 validRequired','placeholder'=>'Please select portfolio','id'=>'portfolio')) !!}
                                                @if($errors->has('portfolio')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('portfolio') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-3">
                                            <label>Bucket<span class="text-danger">*</span>:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon">   
                                                {!! Form::select('bucket',[],'', array('class'=>'select2 validRequired','placeholder'=>'Please select bucket','id'=>'bucket')) !!}
                                                @if($errors->has('bucket')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('bucket') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="new-form-section">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="col-sm-3 no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>Category<span class="text-danger">*</span>:</label><br>
                                                    {!! Form::select('category',$category,'', array('class'=>'select2 validRequired','placeholder'=>'Please select category','id'=>'category')) !!}
                                                    @if($errors->has('category')) 
                                                    <div class="text-danger">
                                                        {{ $errors->first('category') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>Group<span class="text-danger">*</span>:</label><br>
                                                    {!! Form::select('group',$group,'', array('class'=>'select2 validRequired','placeholder'=>'Please select group','id'=>'group')) !!}
                                                    @if($errors->has('group')) 
                                                    <div class="text-danger">
                                                        {{ $errors->first('group') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>View<span class="text-danger">*</span>:</label><br>
                                                    {!! Form::select('view',$view,'', array('class'=>'select2 validRequired','placeholder'=>'Please select view','id'=>'view')) !!}
                                                    @if($errors->has('view')) 
                                                    <div class="text-danger">
                                                        {{ $errors->first('view') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>Hours / Day<span class="text-danger">*</span>:</label><br>
                                                    {!!Form::text('amount','',array('class'=>'form-control border-radius-0 inputRequired','placeholder'=>'Please enter hours/day','id'=>'amount'))!!}
                                                    @if($errors->has('amount')) 
                                                    <div class="text-danger">
                                                        {{ $errors->first('amount') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>						
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="l33">Start Date<span class="text-danger">*</span>:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init"> 
                                                    {!!Form::text('start_date','',array('class'=>'form-control border-radius-0 datepicker-only-init start inputRequired','placeholder'=>'Please select start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="start"></p>
                                                @if($errors->has('start_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('start_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="l33">End Date<span class="text-danger">*</span>:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init"> 
                                                    {!!Form::text('end_date','',array('class'=>'form-control border-radius-0 datepicker-only-init end inputRequired','placeholder'=>'Please select end date','id'=>'end_date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="end"></p>
                                                @if($errors->has('end_date')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('end_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="l33">Planning Unit<span class="text-danger">*</span>:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon">
                                                {!! Form::select('planning_unit',['1'=>'Monthly','2'=>'Weekly','3'=>'Quartely','4'=>'Half Yearly','5'=>'Annualy'],'', array('class'=>'select2 validRequired','placeholder'=>'Please select planning unit','id'=>'planning_unit')) !!}
                                            </div>
                                            @if($errors->has('planning_unit')) 
                                            <div class="text-danger">
                                                {{ $errors->first('planning_unit') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <div class="col-xs-12 col-sm-3">
                                            <label>Status:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="btn-group" data-toggle="buttons">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <a class="active-bttn btn btn-primary active">
                                                        <!--Active-->
                                                        {!! Form::radio('status','active',true) !!}Active
                                                    </a>
                                                    <a class="inactive-btn btn btn-danger">
                                                        <!--Inactive-->
                                                        {!! Form::radio('status','inactive') !!}Inactive
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-form col-xs-12 col-sm-6" style="display: none;">
                                    <div class="form-group row" >
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="l33"></label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon">
                                                <input type="text" disabled="true" readonly="true" class="form-control">
                                                <span class=" border-radius-0"> </i> </span>
                                                <p id="end"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="super">
                                        <div class="col-sm-12">
                                            <div class="form-group row" >
                                                <div class="col-sm-12">
                                                    <div class="col-xs-12 col-sm-3">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-9">
                                                        <div class="form-input-icon">
                                                            <span class=" border-radius-0"> </i> </span>
                                                            <p id="end"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            <button type="submit" class="btn btn-primary card-btn">Submit</button>
                            <a href="{{url('admin/bucketfp')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Dashboard -->
@endsection
