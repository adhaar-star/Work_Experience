@extends('layout.adminlayout')
@section('title','Risk Management')
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
                            <span class="hidden-lg-down">Risk Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/quantitative_risk')}}">Quantitaive Risk</a>
                            <a class="dropdown-item" href="{{url('admin/qualitative_risk')}}">Qualitative Risk</a>
                            <a class="dropdown-item" href="{{url('admin/riskAnalysis')}}">Risk Register</a>
                        </ul>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here :</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/riskAnalysis')}}">Risk Management</a>
                        </li>
                        <li>
                            <span>Risk Register Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Risk Register</h4>
                <div class="dashboard-buttons">
                    <a href="{{url('admin/qualitative_risk')}}" class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create  Qualitative Risk 
                    </a>
                    <a href="{{url('admin/quantitative_risk')}}" class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create  Quantitative Risk 
                    </a>


                </div>

                <br/>
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Project ID</th>
                                    <th>Risk ID</th>
                                    <th>Risk Type</th>
                                    <th>Risk Description</th>
                                    <th>Risk Category</th>
                                    <th>Status</th>
                                    <th>Risk Score</th>
                                    <th>Risk Score Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Project ID</th>
                                    <th>Risk ID</th>
                                    <th>Risk Type</th>
                                    <th>Risk Description</th>
                                    <th>Risk Category</th>
                                    <th>Status</th>
                                    <th>Risk Score</th>
                                    <th>Risk Score Status</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($qualitativeData as $risk)
                                <tr>
                                    <td>{{$risk->project_id}}</td>
                                    <td><a data-toggle="modal" data-target="#table-view-popup_{{$risk->id}}">{{$risk->qual_risk_id}}</a></td>
                                    <td><span class="label label-success">{{$risk->risk_type}}</span></td>
                                    <td>{{$risk->qual_risk_desc}}</td>
                                    @if($risk->qual_category == 1)
                                    <td>Supplier risk</td>
                                    @elseif($risk->qual_category == 2)
                                    <td>Technology risk</td>
                                    @elseif($risk->qual_category == 3)
                                    <td>Infrastructure risk</td>
                                    @elseif($risk->qual_category == 4)
                                    <td>Government Policy risk</td>
                                    @else
                                    <td>Resource risk</td>
                                    @endif
                                    <td>{{$risk->qual_status}}</td>
                                    <td>{{$risk->risk_score}}</td>
                                    @if(count($score)>0)    
                                    @if($score[$loop->index] == 'Low')
                                    <td><img src="{{asset('vendors/common/img/green.png')}}" alt=""></td>
                                    @elseif($score[$loop->index] == 'Medium')
                                    <td><img src="{{asset('vendors/common/img/yellow.png')}}" alt=""></td>
                                    @elseif($score[$loop->index] == 'High')
                                    <td><img src="{{asset('vendors/common/img/red.png')}}" alt=""></td>
                                    @endif
                                    @else
                                    <td><img src="" alt=""></td>
                                    @endif
                                    <td class="action-btn">
                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$risk->id }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                        <a href="{{url('admin/qualitative_risk/'.$risk->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>
                                        {!! Form::open(array('url' => array('admin/qualitative_risk',$risk->id), 'method' => 'DELETE','id'=>'delform'.$risk->id)) !!}
                                        <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this qualitative risk?');
                                                    if (res) {
                                            document.getElementById('delform{{$risk->id}}').submit()
                                                        }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        {!! Form::close() !!}
                                        <div class="modal fade table-view-popup" id="table-view-popup_{{$risk->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <!--view--> 
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="{{url('admin/riskAnalysis')}}">Risk Management</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/qualitative_risk')}}">Qualitative Risk</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript: void(0);">Display Qualitative Risk</a>
                                                                </li>
                                                                <li>
                                                                    <span>{{$risk->qual_risk_id}}</span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk->project_id}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Risk ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk->qual_risk_id}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Qualitative Category</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    @if($risk->qual_category == 1)
                                                                    <p  class="form-control-static">Supplier risk</p>
                                                                    @elseif($risk->qual_category == 2)
                                                                    <p  class="form-control-static">Technology risk<p>
                                                                        @elseif($risk->qual_category == 3)
                                                                    <p  class="form-control-static">Infrastructure risk</p>
                                                                    @elseif($risk->qual_category == 4)
                                                                    <p  class="form-control-static">Government Policy risk</p>
                                                                    @else
                                                                    <p  class="form-control-static">Resource risk</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Risk Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk->qual_risk_desc}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Qualitative Likelihood</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk->qual_likelihood}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Qualitative Consequence</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk->qual_consequence}}</p>
                                                                </div> 
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Risk Score</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk->risk_score}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Risk Mitigation Action</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk->risk_mitigation_action}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created On</p>
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <p class="form-control-static">{{$qual_createdon[$loop->index]}}</p>


                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created by</p>
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <p class="form-control-static">{{$qual_createdby[$loop->index]}}</p>

                                                                </div>
                                                            </div> <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed On</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$qual_updatedon[$loop->index]}}</p>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$qual_changedby[$loop->index]}}</p>
                                                                </div>
                                                            </div> 

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk->qual_status}}</p>
                                                                </div>
                                                            </div> 
                                                            <!--view-->
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="edit-btn"><a href="{{url('admin/qualitative_risk/'.$risk->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                <!--For Quantitative -->
                                @foreach($quantitativeData as $risk1)
                                <tr>
                                    <td>{{$risk1->project_id}}</td>
                                    <td><a data-toggle="modal" data-target="#table-view-popup_quan_{{$risk1->quan_id}}">{{$risk1->quan_risk_id}}</a></td>
                                    <td><span class="label label-info">{{$risk1->risk_type}}</span></td>
                                    <td>{{$risk1->quan_risk_desc}}</td>
                                    @if($risk1->quan_category == 1)
                                    <td>Supplier risk</td>
                                    @elseif($risk1->quan_category == 2)
                                    <td>Technology risk</td>
                                    @elseif($risk1->quan_category == 3)
                                    <td>Infrastructure risk</td>
                                    @elseif($risk1->quan_category == 4)
                                    <td>Government Policy risk</td>
                                    @else
                                    <td>Resource risk</td>
                                    @endif
                                    <td>{{$risk1->status}}</td>
                                    <td>{{$risk1->quan_risk_score}}</td>

                                    @if($risk1->quan_risk_score <= 2)
                                    <td><img src="{{asset('vendors/common/img/green.png')}}" alt=""></td>
                                    @elseif($risk1->quan_risk_score == 3)
                                    <td><img src="{{asset('vendors/common/img/yellow.png')}}" alt=""></td>
                                    @elseif($risk1->quan_risk_score >= 4)
                                    <td><img src="{{asset('vendors/common/img/red.png')}}" alt=""></td>
                                    @endif
                                    <td class="action-btn">
                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_quan_{{$risk1->quan_id}}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                        <a href="{{url('admin/quantitative_risk/'.$risk1->quan_id.'/edit')}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>
                                        {!! Form::open(array('url' => array('admin/quantitative_risk',$risk1->quan_id), 'method' => 'DELETE','id'=>'delform'.$risk1->quan_id)) !!}
                                        <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this quantitative risk?');
                                                            if (res) {
                                                    document.getElementById('delform{{$risk1->quan_id}}').submit()
                                                                        }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        {!! Form::close() !!}
                                        <div class="modal fade table-view-popup" id="table-view-popup_quan_{{$risk1->quan_id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <!--view--> 
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="{{url('admin/riskAnalysis')}}">Risk Management</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/quantitative_risk')}}">Quantitative Risk</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript: void(0);">Display Quantitative Risk</a>
                                                                </li>
                                                                <li>
                                                                    <span>{{$risk1->quan_risk_id}}</span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->project_id}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Risk ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->quan_risk_id}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Quantitative Category</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    @if($risk1->quan_category == 1)
                                                                    <p  class="form-control-static">Supplier risk</p>
                                                                    @elseif($risk1->quan_category == 2)
                                                                    <p  class="form-control-static">Technology risk<p>
                                                                        @elseif($risk1->quan_category == 3)
                                                                    <p  class="form-control-static">Infrastructure risk</p>
                                                                    @elseif($risk1->quan_category == 4)
                                                                    <p  class="form-control-static">Government Policy risk</p>
                                                                    @else
                                                                    <p  class="form-control-static">Resource risk</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Risk Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->quan_risk_desc}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Currency</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->short_code}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Quantitative Total Loss</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->quan_total_loss}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Quantitative Probability</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->quan_probability}}</p>
                                                                </div> 
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Expected Loss</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{round($risk1->quan_expected_loss)}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Risk Score</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->quan_risk_score}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Risk Mitigation Action</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->risk_mitigation_action}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created On</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$quan_createdon[$loop->index]}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created by</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$quan_createdby[$loop->index]}}</p>
                                                                </div>
                                                            </div> <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed On</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$quan_updatedon[$loop->index]}}</p>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$quan_changedby[$loop->index]}}</p>
                                                                </div>
                                                            </div> 

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$risk1->status}}</p>
                                                                </div>
                                                            </div> 
                                                            <!--view-->
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="edit-btn"><a href="{{url('admin/quantitative_risk/'.$risk1->quan_id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- For Quantitative -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
