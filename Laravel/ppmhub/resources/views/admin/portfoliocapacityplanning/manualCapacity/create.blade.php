@extends('layout.adminlayout')
@if(!isset($manualCapacity))
    @section('title','Create Manual Capacity Planning')
@else
    @section('title','Edit Manual Capacity Planning')
@endif
@section('body')
@if(Session::has('flash_error'))
<div class="alert alert-danger">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_error') !!}</em>
</div>
@endif
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/manual_capacity.js') !!}
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
                        <h1>Manual Capacity Planning</h1>
                    </div>
                    <div class="col-md-9 text-right">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li><a href="{{url('admin/dashboard')}}">Portfolio Management</a></li>
                            <li><a href="{{route('manualCapacity.dashboard')}}">Manual Capacity Planning</a></li>
                            <li> <a href="javascript:void(0);">
                                @if(isset($manualCapacity) && $manualCapacity->id)
                                    Edit
                                @else
                                    Create
                                @endif Manual Capacity Planning</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
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
               @if(isset($manualCapacity) && $manualCapacity->id)
                  {!! Form::model($manualCapacity, array('class' => '', 'id' => 'ManualCapacityForm', 'method' => 'PATCH', 'route' => array('manualCapacity.update', $manualCapacity->id))) !!}
                @else
                  {!! Form::open(array('route' => 'manualCapacity.create','method'=>'POST', 'id' => 'ManualCapacityForm')) !!} 
               @endif
                {{ csrf_field() }}
                <div class="margin-bottom-50">
                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($manualCapacity) && $manualCapacity->id)
                                Edit
                                @else
                                Create
                                @endif
                                Manual Capacity Planning 
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
                                                {!! Form::select('portfolio',$portfolio,isset($manualCapacity->portfolio) ? $manualCapacity->portfolio : null, array('class'=>'select2 validRequired','placeholder'=>'Please select portfolio','id'=>'portfolio')) !!}
                                                @if($errors->has('portfolio')) 
                                                <div style="color: #a94442">
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
                                                {!! Form::select('bucket',isset($buckets) ? $buckets : [],isset($manualCapacity->bucket) ? $manualCapacity->bucket : null, array('class'=>'select2 validRequired','placeholder'=>'Please select bucket','id'=>'bucket')) !!}
                                                @if($errors->has('bucket')) 
                                                <div style="color: #a94442">
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
                                                    <label>Category</label><br>
                                                    {!! Form::select('category',isset($categories) ? $categories : [], isset($manualCapacity->category) ? $manualCapacity->category : null, array('class'=>'select2 defaultgreen','placeholder'=>'Please select category','id'=>'category')) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>Group</label><br>
                                                    {!! Form::select('group',isset($groups) ? $groups : [],isset($manualCapacity->group) ? $manualCapacity->group : null, array('class'=>'select2 defaultgreen','placeholder'=>'Please select group','id'=>'group')) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>View</label><br>
                                                    {!! Form::select('view',['Demand'=>'Demand','Assigned'=>'Assigned','Forecast'=>'Forecast','Actual'=>'Actual'],isset($manualCapacity->view) ? $manualCapacity->view : null, array('class'=>'select2 defaultgreen','placeholder'=>'Please select view','id'=>'view')) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>Hours / Day<span class="text-danger">*</span>:</label>
                                                    {!!Form::text('hours_day',isset($manualCapacity->hours_day) ? $manualCapacity->hours_day : '',array('class'=>'form-control border-radius-0 inputRequired','placeholder'=>'Please enter hours/day','id'=>'amount'))!!}
                                                    @if($errors->has('hours_day')) 
                                                    <div style="color: #a94442">
                                                        {{ $errors->first('hours_day') }}
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
                                                    {!!Form::text('start_date',isset($manualCapacity->start_date) ? $manualCapacity->start_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init start inputRequired','placeholder'=>'Please select start date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="start"></p>
                                                @if($errors->has('start_date')) 
                                                <div style="color: #a94442">
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
                                                    {!!Form::text('end_date',isset($manualCapacity->end_date) ? $manualCapacity->end_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init end inputRequired','placeholder'=>'Please select end date','id'=>'end_date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="end"></p>
                                                @if($errors->has('end_date')) 
                                                <div style="color: #a94442">
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
                                                {!! Form::select('planning_unit',['1'=>'Monthly','2'=>'Weekly','3'=>'Quartely','4'=>'Half Yearly','5'=>'Annualy'],isset($manualCapacity->planning_unit) ? $manualCapacity->planning_unit : '', array('class'=>'select2 validRequired','placeholder'=>'Please select planning unit','id'=>'planning_unit')) !!}
                                            </div>
                                            @if($errors->has('planning_unit')) 
                                            <div style="color: #a94442">
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
                            </div>
                        </div>
                        <div class="card-footer card-footer-box  text-right">
                            <button type="submit" class="btn btn-primary card-btn">Submit</button>
                            <a href="{{route('manualCapacity.dashboard')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
</section>
<!-- End Dashboard -->
@endsection
