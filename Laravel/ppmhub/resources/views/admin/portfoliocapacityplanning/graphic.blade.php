@extends('layout.adminlayout')
@section('title','Portfolio Management | Portfolio Graphics')
@section('body')
{!! Html::style('/css/Treant.css') !!}
{!! Html::style('/css/custom-colored.css') !!}
{!! Html::script('/js/raphael.js') !!}
{!! Html::script('/js/Treant.js') !!}
{!! Html::script('/js/portfolioGraphics.js') !!}
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

<style>
    .tree-struc {text-align: center;}
    .tree-struc .choose-port1 {
        float: none;
        margin-bottom: 25px;
        margin-right: 0;
        text-align: center;
        font-size:22px;
        margin-top:20px;
    }
    .tree-struc select {
        border-radius: 0;
        float: none;
        height: 36px;
        width: 100%;
    }
    .Treant a:hover {color: #fff;}
    .tree li a {
        background-color: #7a2100;
        border: 3px solid #fff;
        border-radius: 0;
        font-family: "Lato", sans;
        padding: 11px 20px;
        text-transform: uppercase;
    }
    .tree li a:hover, 
    .tree li a:hover + ul li a {
        background: #ea6532 none repeat scroll 0 0;
        border: 3px solid #fff;
        color: #fff;
    }
</style>
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 PageTitleGlobal">
                <h1>Portfolio Graphics</h1>
            </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/portfoliocapacityplanning')}}">Portfolio Capacity Planning</a>
                    </li>
                    <li>
                        <span>Portfolio Graphics</span>
                    </li>
                </ul>
            </div> 
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="client-information" class="client-information">
                    <div class="tree-struc row">
                        <form id="getPortfolioFrom" name="getPortfolioFrom" action="<?php echo url('admin/portfolioStructure/edit'); ?>" method="GET">
                            <div class="col-sm-4 margin-bottom-30 font-bold">
                                <div class="row">
                                    <label class="control-label col-sm-12">Portfolio</label>
                                    <div class="col-sm-12">
                                      {{ Form::select('portfolio_id', $portfolioAll, null, ['class' => 'select2 form-control portfolioStructure', 'id' => 'portfolio_id', 'placeholder' => 'Choose your portfolio']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 margin-bottom-30 font-bold">
                                <div class="row">
                                    <label class="control-label col-sm-12">Project Category</label>
                                    <div class="col-sm-12">
                                      {{ Form::select('categories', array_merge(['0' => 'All'], $categories), null, ['class' => 'select2 form-control category', 'id' => 'category', 'placeholder' => 'Select Category']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 margin-bottom-30 font-bold">
                                <div class="row">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <label class="label orange-graph label-chart">&nbsp;</label>
                                        <p class="m-b-0 fw-600">Portfolio</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="label blue-light label-chart">&nbsp;</label>
                                        <p class="m-b-0 fw-600">Bucket</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="label yellow-light-graph label-chart">&nbsp;</label>
                                        <p class="m-b-0 fw-600">Project</p>
                                    </div>
                                </div>
                            </div>
                        </form>	
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="tree-chart"></div>
            </div>
        </div>
    </div>
</section>
@endsection
