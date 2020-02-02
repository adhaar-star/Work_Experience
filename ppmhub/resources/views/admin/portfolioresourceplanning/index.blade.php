@extends('layout.adminlayout')
@section('title','Portfolio Resource Planning')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
<section class="panel">
    <div class="panel-body">
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
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                        </li>
                        <li>
                            <span>Portfolio Resource Planning Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Portfolio Resource Planning</h4>
                <div class="dashboard-buttons">
                    <a href="{{url('admin/portfolioresourceplanning/create')}}" class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create Portfolio Resource Planning
                    </a>
                </div>
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Portfolio</th>
                                    <th>Total</th>
                                    <th>Distribute</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Portfolio</th>
                                    <th>Total</th>
                                    <th>Distribute</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($portfolioresourceplanning as $buck)
                                <tr>
                                    <td>{{$buck->portfolio_name}}</td>
                                    <td>{{$buck->total_period }}</td>
                                    <td>{{$buck->distribute }}</td>
                                    <td>{{$buck->planning_start }}</td>
                                    <td>{{$buck->planning_end }}</td>
                                    <td>
                                        @if($buck->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        <!--button type="button" class="btn btn-success btn-xs">Active</button-->
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        <!--button type="button" class="btn btn-danger btn-xs">Inactive</button-->
                                        @endif
                                    </td>
                                    <td class="action-btn">
                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$buck->id}}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                        <a href="{{url('admin/portfolioresourceplanning/'.$buck->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>                                        
                                        <!--<a href="javascript:void(0)" onclick="deleteData({{$buck->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>-->
                                        {!! Form::open(array('action' => array('Admin\PortfolioresourceplanningController@destroy', $buck->id),'method'=>'DELETE')) !!}
                                        <!--{!! Form::submit('Delete',array('class'=>'btn btn-danger btn-xs')) !!}-->
                                        <button type="submit" class="btn btn-danger btn-xs" style="display: inherit;"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                        <div class="modal fade table-view-popup" id="table-view-popup_{{$buck->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/portfolioresourceplanning')}}">Portfolio Capacity Planning</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/portfolioresourceplanning/create')}}">Display Portfolio Capacity Plan</a>
                                                                </li>
                                                                <li>
                                                                    <span>{{$buck->name}}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$buck->name}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created At</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$buck->created_at}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Updated By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$buck->edited_by}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Updated At</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$buck->updated_at}}</p>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="edit-btn"><a href="{{url('admin/portfolioresourceplanning/'.$buck->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End  -->
                                    </td>
                                    <!--td style="text-align: center;">
                                            <a href="{{url('admin/portfolioresourceplanning/'.$buck->id.'/edit')}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                            <form action="{{url('admin/portfolioresourceplanning/'.$buck->id)}}" method="post" id="delform">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a href="javascript:void(0)" onclick="var res=confirm('Are you sure you want to delete this Bucket'); if(res){document.getElementById('delform').submit()}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                            </form>
                                    </td-->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End  -->
@endsection

