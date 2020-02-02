@extends('layout.adminlayout')
@section('title','Portfolio Resource Planning ')
@section('body')
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/portfolioResourcePlanningValidation.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
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
                            <a class="dropdown-item" href="{{url('admin/portfolioresourceplanning')}}">Portfolio Resource Planning</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>                
                @if(!isset($portfolioresourceplanning->id))
                {!! Form::open(array('route' => 'portfolioresourceplanning.store','method'=>'post', 'id' => 'portfolioResourcePlanning')) !!} 
                @else
                {!! Form::open(array('route'=>array('portfolioresourceplanning.update',$portfolioresourceplanning->id),'method' => 'put','id' => 'Serviceform')) !!}
                @endif
                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                            </li>
                            <li>
                                <a href="{{url('admin/portfolioresourceplanning')}}">Portfolio Resource Planning</a>
                            </li>
                            <li>
                                <span>Create Plan </span>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($portfolioresourceplanning) && $portfolioresourceplanning->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Portfolio Resource Planning 
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block bg-lightcyan">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-3">
                                            <label>Portfolio</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon"> 

                                                {!! Form::select('portfolio_id',$portfolio,isset($portfolioresourceplanning->portfolio_id) ? $portfolioresourceplanning->portfolio_id : '', array('class'=>'select2')) !!}	

                                                @if($errors->has('portfolio_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('portfolio_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-3">
                                            <label>Buckets</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon">   
                                                {!! Form::select('bucket', $buckets,isset($portfolioresourceplanning->bucket) ? $portfolioresourceplanning->bucket : '', array('class'=>'select2')) !!}	
                                                @if($errors->has('bucket')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('bucket') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="new-form-section">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="col no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>Planning Type</label><br>
                                                    {!! Form::select('planning_type',$planning_type,isset($portfolioresourceplanning->planning_type) ? $portfolioresourceplanning->planning_type : '',array('class'=>'select2')) !!}
                                                    @if($errors->has('planning_type')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('planning_type') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>Costing Type</label><br>
                                                    {!! Form::select('costing_type',$costing_type,isset($portfolioresourceplanning->costing_type) ? $portfolioresourceplanning->costing_type : '',array('class'=>'select2')) !!}
                                                    @if($errors->has('costing_type')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('costing_type') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>Collection Type</label><br>
                                                    {!! Form::select('collection_type',$collection_type,isset($portfolioresourceplanning->collection_type) ? $portfolioresourceplanning->collection_type : '',array('class'=>'select2')) !!}
                                                    @if($errors->has('collection_type')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('collection_type') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col no-pade">
                                                <div class="form-group new-form-group">
                                                    <label>View Type</label><br>
                                                    {!! Form::select('view_type',$view_type,isset($portfolioresourceplanning->view_type) ? $portfolioresourceplanning->view_type : '',array('class'=>'select2')) !!}
                                                    @if($errors->has('view_type')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('view_type') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>						
                                <?php
                                if (isset($portfolioresourceplanning->created_by) && (!empty($portfolioresourceplanning->created_by))) {
                                    ?>  <input type="hidden" id="edited_by" name="edited_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" id="edited_date" name="edited_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                <?php } else { ?>
                                    <input type="hidden" id="created_by" name="created_by" value="<?php echo Auth::user()->name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">

                                <?php } ?>
                               
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="l33">Total:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">	
                                            <div class="form-input-icon">
                                                {!!Form::text('total_period',isset($portfolioresourceplanning->total_period) ? $portfolioresourceplanning->total_period : '',array('class'=>'form-control border-radius-0','placeholder'=>'Total','id'=>'total_period'))!!}
                                                @if($errors->has('total_period')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('total_period') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="l33">Distribute:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">	
                                            <div class="form-input-icon"> 
                                                {!!Form::select('distribute',['Monthly'=>'Monthly','Quarterly'=>'Quarterly','Half Yearly'=>'Half Yearly','Annual'=>'Annual'],isset($portfolioresourceplanning->distribute) ? $portfolioresourceplanning->distribute : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select distribute','id'=>'distribute'))!!}
                                                @if($errors->has('distribute')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('distribute') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="l33">Start Date:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('planning_start',isset($portfolioresourceplanning->planning_start) ? $portfolioresourceplanning->planning_start : '',array('class'=>'form-control border-radius-0 datepicker-only-init start','placeholder'=>'Please select start date','id'=>'startdate'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="start"></p>
                                                @if($errors->has('planning_start')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('planning_start') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group form-margin-btm">
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="l33">End Date:</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('planning_end',isset($portfolioresourceplanning->planning_end) ? $portfolioresourceplanning->planning_end : '',array('class'=>'form-control border-radius-0 datepicker-only-init end','placeholder'=>'Please select end date'))!!}
                                                    <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="end"></p>
                                                @if($errors->has('planning_end')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('planning_end') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box">
                            <button type="submit" class="btn btn-primary card-btn">Submit</button>
                            <a href="{{url('admin/portfolioresourceplanning')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                        <!-- End Vertical Form -->
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Dashboard -->
@endsection
