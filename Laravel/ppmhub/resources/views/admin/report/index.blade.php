
@extends('layout.adminlayout')
@section('title','Report | Report')

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
                            <span class="hidden-lg-down">Report Management</span>
                            <span class="caret"></span>
                        </a>
						<!--
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfolio')}}">Report</a>
                            <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                            <a class="dropdown-item" href="{{url('admin/portfolioStructure')}}">Report Structure</a>
                            <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Report Financial Planning</a>
                            <a class="dropdown-item" href="{{url('admin/portfolioresourceplanning')}}">Report Resource Planning</a>                          
                        </ul> -->
                    </div>
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Report Management</a>
                        </li> 
						<li>
                            <a href="{{url('admin/report')}}">Cost Budget Report</a>
                        </li>
						<li>
                            <a href="{{url('admin/report/t')}}">Project Procurement Report</a>
                        </li>
                        
                    </ul>
                </div>
                <h4>Report</h4>
              
<!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Project ID</th>
                                    <th>PHASE ID</th>
                                    <th>TASK ID</th>
                                    <th>Start Date</th>
									<th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Project ID</th>
                                    <th>PHASE ID</th>
                                    <th>TASK ID</th>
                                    <th>Start Date</th>
									<th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
			
                                @foreach($project as $val)							
                                <tr>
                                    <td>{{$val->project_Id}}</td>
                                    <td>{{$val->phase_Id}}</td>
                                    <td>{{$val->task_id}}</td>
                                    <?php
										$date = new DateTime($val->p_start_date);
										$first_date = $date->format('Y-m-d');
                                    ?>
                                    <td>{{$first_date }}</td>  
                                    <?php
                                    $date = new DateTime($val->p_end_date);
                                    $end_date = $date->format('Y-m-d');
                                    ?>
                                    <td>{{$end_date }}</td>                                    
                                    <td>
                                        @if($val->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                        @endif
                                    </td>
                                    <td class="action-btn">
									
										  <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$val->id }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
										  
										  
										   <div class="modal fade table-view-popup" id="table-view-popup_{{$val->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="margin-bottom-10">
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">s</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">w</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project Type</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">rr</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">rrr</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">wew</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">rewewr</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio Type</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">werwrew34</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">342erw</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">werew vew</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project Location</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">wercwerw vew w</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Center</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">wcewewcrewr </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Department</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">rew vwe vewwe</p>
                                                                </div>
                                                            </div>


                                                            
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                   
                                                                </div> 
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
														dd
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- End  -->
                                    </td>
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


@endsection