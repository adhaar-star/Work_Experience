@extends('layout.adminlayout')
@section('title','Capacity Planning Project| Capacity Planning')
@section('body')
{!! Html::script('/js/capacity-planning.js') !!}
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

<style type="text/css">
    .bucker-header {background-color: #054765;color: #fff;font-size: 20px;}
    .project-header {background-color: #3186ad !important;color: #fff;}
    .project-name {background-color: #6db3d6 !important;color: #fff;}
    .project-category {font-weight: bold;}
    .p-a-0 {padding: 0 !important;}
    .w-100 {width: 100%;}
    .border-none {border: 0 !important;}
    .label {margin-bottom: 2px !important;}
</style>
<div class="alert alert-success message" style="display: none">
    <span class="glyphicon glyphicon-ok"></span>
    <em id="msg"></em>
</div>
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-6 PageTitleGlobal">
                    <h1>Portfolio Capacity Planning-Projects</h1>
                </div>
                <div class="col-md-6 text-right">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/portfoliocapacityplanning')}}">Portfolio Capacity Planning</a>
                        </li>
                        <li>
                            <span>Capacity Planning Projects</span>
                        </li>
                    </ul>
                </div> 
                <div class="col-md-2 col-sm-6 col-xs-12 margin-bottom-20">
                    <label class="control-label">Select Portfolio</label>
                    {{ Form::select('portfolio', $portfolios, isset($id)?$id:null , ['class' => 'select2', 'id' => 'portfolio', 'placeholder' => 'Please Select Portfolio']) }}
                </div>
                <div class="col-md-offset-1 col-md-1 col-sm-6 col-xs-12 margin-bottom-20 text-right">
                    <label class="control-label opacity-0">Refresh</label>
                    <a type="submit" class="btn btn-warning" href="{{route('portfolio-cp.dashboard',isset($id) ? $id : null)}}"><i class="fa fa-refresh"></i></a>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 margin-bottom-20">
                    <label class="control-label">Portfolio list filter</label>
                    {{ Form::select('view', $views, $viewId ,['class' => 'select2', 'id' => 'view', 'placeholder' => 'Please Select View']) }}
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 margin-bottom-20">
                    <label class="control-label">&nbsp;</label>
                    {{ Form::select('group', $groupsAndCategories['groups'], $groupId ,['class' => 'select2', 'id' => 'group', 'placeholder' => 'Please Select Group']) }}
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 margin-bottom-20">
                    <label class="control-label">&nbsp;</label>
                    {{ Form::select('category', $groupsAndCategories['categories'], $categoryId ,['class' => 'select2', 'id' => 'category', 'placeholder' => 'Please Select Category']) }}
                </div>
                <div class="col-md-1 col-sm-6 col-xs-12 margin-bottom-20">
                  <label class="control-label">&nbsp;</label>
                  <button type="button" class="btn btn-warning" id="search">Apply Search</button>
                </div>
                @isset($bucketsProjects)
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="p-a-0 border-none">
                                      @if(count($bucketsProjects) > 0)
                                        @foreach ($bucketsProjects as $bucket)
                                        <table class="table m-b-1">
                                            <tbody>
                                               
                                                @isset($bucket->projects)
                                                <tr>
                                                    <th colspan="6" class="bucker-header text-center text-uppercase">
                                                        {{$bucket->name}}
                                                    </th>
                                                </tr>
                                                @foreach ($bucket->projects as $projects)
                                                <tr>
                                                    <td class="p-a-0 w-100">
                                                        <table class="table table-bordered table-striped m-b-0">
                                                            <tbody>
                                                                <tr class="project-header">
                                                                    <th class="project-name width-200">Project</th>
                                                                    <th class="width-150">View</th>
                                                                    <th class="width-250">Group</th>
                                                                    <th class="width-250">Category</th>
                                                                    <th>Hours</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                                @if($viewId == null || $viewId == 1)
                                                                <tr>
                                                                  <td rowspan="4" class="text-center vertical-middle font-size-18"><strong>{{$projects->projectName}}</strong></td>
                                                                    <td class="project-category">Demand</td>
                                                                    <td>
                                                                        @if($projects->demand->group)
                                                                        @foreach($projects->demand->group as $dgroup)
                                                                        <label class="label label-info">{{ $dgroup }}</label>
                                                                        @endforeach
                                                                        @else
                                                                        --
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($projects->demand->category)
                                                                        @foreach($projects->demand->category as $dcategory)
                                                                        <label class="label label-warning">{{ $dcategory }}</label>
                                                                        @endforeach
                                                                        @else
                                                                        --
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-right">{{$projects->demand->hours}}</td>
                                                                    <td class="text-right">{{$projects->demand->cost}}</td>
                                                                </tr>
                                                                @endif
                                                                @if($viewId == null || $viewId == 2)
                                                                <tr>
                                                                    <td class="project-category">Assigned</td>
                                                                    <td>
                                                                        @if($projects->assigned->group)
                                                                        @foreach($projects->assigned->group as $agroup)
                                                                        <label class="label label-info">{{ $agroup }}</label>
                                                                        @endforeach
                                                                        @else
                                                                        --
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($projects->assigned->category)
                                                                        @foreach($projects->assigned->category as $acategory)
                                                                        <label class="label label-warning">{{ $acategory }}</label>
                                                                        @endforeach
                                                                        @else
                                                                        --
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-right">{{$projects->assigned->hours}}</td>
                                                                    <td class="text-right">{{$projects->assigned->cost}}</td>
                                                                </tr>
                                                                @endif
                                                                @if($viewId == null || $viewId == 3)
                                                                <tr>
                                                                    <td class="project-category">Forecast</td>
                                                                    <td>--</td>
                                                                    <td>--</td>
                                                                    <td class="text-right">--</td>
                                                                    <td class="text-right">--</td>
                                                                </tr>
                                                                @endif
                                                                @if($viewId == null || $viewId == 4)
                                                                <tr>
                                                                    <td class="project-category">Actual</td>
                                                                    <td>
                                                                        @if($projects->actual->group)
                                                                        @foreach($projects->actual->group as $acgroup)
                                                                        <label class="label label-info">{{ $acgroup }}</label>
                                                                        @endforeach
                                                                        @else
                                                                        --
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($projects->actual->category)
                                                                        @foreach($projects->actual->category as $accategory)
                                                                        <label class="label label-warning">{{ $accategory }}</label>
                                                                        @endforeach
                                                                        @else
                                                                        --
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-right">{{$projects->actual->hours}}</td>
                                                                    <td class="text-right">{{$projects->actual->cost}}</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                        @endforeach
                                        @else
                                        <div class="bucker-header text-center text-uppercase">No data found</div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
</section>
@endsection