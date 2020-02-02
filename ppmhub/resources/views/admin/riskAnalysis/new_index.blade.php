@extends('layout.admin')
@section('title', 'Risk Management')
@section('body')
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
<meta name="csrf-token" content="{{ csrf_token() }}" /> 
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
<style>
  .mybtn
  {

    min-width: 100px;
    text-align: center;
  }
  .label-warning{
    background-color: #F6A63F !important;
  }
  

</style>
@endsection
<div class="alert alert-success message" style="display: none">
  <span class="glyphicon glyphicon-ok"></span>
  <em id="msg"></em>
</div>
<div class="alert alert-danger message1 " style="display: none">
  <span class="glyphicon glyphicon-ok"></span>
  <em id="msg1"></em>
</div>
@if(Session::has('flash_message'))
<div class="alert alert-success myalert">
  <span class="glyphicon glyphicon-ok"></span>
  <em> {!! session('flash_message') !!}</em>
</div>
@endif

<section class="panel">
  <div class="panel-body">
    <div class="row PageTitleGlobal">
      <div class="col-md-6">
        <h1>Risk Register</h1>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
               
          @if(RoleAuthHelper::hasAccess('qualitative_risk.create')!=true)  
            <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
          @else
            <a href="{{url('admin/qualitative_risk')}}" class="btn btn-success btn-sm">
          @endif 
          <i class="fa fa-plus margin-right-5"></i>
          Create  Qualitative Risk 
        </a>
        
         @if(RoleAuthHelper::hasAccess('quantitative_risk.create')!=true)
            <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
         @else
            <a href="{{url('admin/quantitative_risk')}}" class="btn btn-info  btn-sm">
         @endif
          <i class="fa fa-plus margin-right-5"></i>
          Create  Quantitative Risk 
        </a>

        <br/>
      </div>
      <div class="col-md-6 text-right">
        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
        <ul class="list-unstyled breadcrumb breadcrumb-custom">
          <li>
            <a href="{{url('admin/riskregister')}}">Risk Management</a>
          </li>
          <li><span>Risk Register Dashboard</span></li>
        </ul>
      </div>
    </div>
    <div class="margin-bottom-50">
      <table class="table table-inverse register-table" id="DateTablePPMHUB" width="100%">
        <thead>
          <tr>
            <th>Project id</th>
            <th>Risk ID</th>
            <th>Risk Type</th>
            <th>Risk Category</th>
            <th>Status</th>
            <th>Risk Score</th>
            <th>Risk Score Status</th>
            <th>Action</th>
            <th>Context</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

    <div class="modal fade table-view-popup" id="table-view-popup_quan" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                  <a href="{{url('admin/riskregister')}}">Risk Management</a>
                </li>
                <li>
                  <span>Quantitative Risk</span>
                </li>

                <li>
                  <span id="brquan_risk_id"></span>
                </li>
              </ul>
            </div>

          </div>
          <div class="modal-body ">
            <form class="static-form">
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Project ID</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="project_id"></p>
                </div>
              </div>

              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Risk ID</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="quan_risk_id"></p>
                </div>
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Quantitative Category</p>
                </div>
                <div class="col-sm-5" >
                  <p  class="form-control-static" id="quan_category"></p>
                </div>
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Risk Description</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="quan_risk_desc"></p>
                </div>
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Currency</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="short_code"></p>
                </div>
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Quantitative Total Loss</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="quan_total_loss"></p>
                </div>
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Quantitative Probability</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="quan_probability"></p>
                </div> 
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Expected Loss</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="quan_expected_loss"></p>
                </div>
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Risk Score</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="quan_risk_score"></p>
                </div>
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Risk Mitigation Action</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="risk_mitigation_action"></p>
                </div>
              </div>
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Created On</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="createdOn"></p>
                </div>
              </div>

              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static" >Created by</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="createdBy"></p>
                </div>
              </div> <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Changed On</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="changeOn"></p>
                </div>
              </div> 
              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Changed By</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="changeBy"></p>
                </div>
              </div> 

              <div class="form-group popup-brd-btm">
                <div class="col-sm-5">
                  <p class="form-control-static">Status</p>
                </div>
                <div class="col-sm-5">
                  <p class="form-control-static" id="status"></p>
                </div>
              </div> 
              <!--view-->
            </form>
          </div>
          <div class="modal-footer text-center">
            <a href="#" class="btn btn-primary" id="popupEdit">Edit</a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
  </div>


</section>
<div class="modal fade table-view-popup" id="table-view-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
              <a href="{{url('admin/riskregister')}}">Risk Management</a>
            </li>
            <li>
              <span> Qualitative Risk</span>
            </li>
            <li>
              <span id="brqual_risk_id"></span>
            </li>
          </ul>
        </div>
      </div>
      <div class="modal-body ">
        <form class="static-form">
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Project ID</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_project_id"></p>
            </div>
          </div>

          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Risk ID</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_risk_id"></p>
            </div>
          </div>
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Qualitative Category</p>
            </div>
            <div class="col-sm-5">

              <p  class="form-control-static" id="qual_category">Supplier risk</p>

            </div>
          </div>
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Risk Description</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_risk_desc"></p>
            </div>
          </div>
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Qualitative Likelihood</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_likelihood"></p>
            </div>
          </div>
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Qualitative Consequence</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_consequence"></p>
            </div> 
          </div>
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Risk Score</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="risk_score"></p>
            </div>
          </div>
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Risk Mitigation Action</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_risk_mitigation_action"></p>
            </div>
          </div>
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Created On</p>
            </div>
            <div class="col-sm-5">

              <p class="form-control-static" id="qual_createdOn"></p>


            </div>
          </div>

          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Created by</p>
            </div>
            <div class="col-sm-5">

              <p class="form-control-static" id="qual_createdBy"></p>

            </div>
          </div> <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Changed On</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_changedOn"></p>
            </div>
          </div> 
          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Changed By</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_changedBy"></p>
            </div>
          </div> 

          <div class="form-group popup-brd-btm">
            <div class="col-sm-5">
              <p class="form-control-static">Status</p>
            </div>
            <div class="col-sm-5">
              <p class="form-control-static" id="qual_status"></p>
            </div>
          </div> 
          <!--view-->
        </form>
      </div>
      <div class="modal-footer text-center">
        <!--admin/qualitative_risk/'.$risk->id.'/edit-->
        <a href="#" class="btn btn-primary" id="qual_popupEdit">Edit</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('PageJquery')

{!! Html::script('vendors/jqueryDataTable/jquery.dataTables.min.js') !!}
{!! Html::script('/js/risk_analysis_dataTable.js') !!}
@endsection