@extends('layout.adminlayout')
@section('title','Risk Management | Quantitative Risk')
@section('body')
<div class="alert alert-danger message" style="display: none">
    <span class="glyphicon glyphicon-ok"></span>
    <em id="msg"></em>
</div>
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/risk_analysis.js') !!}
{!! Html::script('/js/quantitaive.js') !!}


<!-- Quantitative Risk -->
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach                   
                </div>
                @endif
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="{{url('admin/riskregister')}}" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Risk Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/riskregister')}}">Risk Register</a>
                            <a class="dropdown-item" href="{{url('admin/quantitative_risk')}}">Quantitaive Risk</a>
                            <a class="dropdown-item" href="{{url('admin/qualitative_risk')}}">Qualitative Risk</a>
                        </ul>
                    </div> 
                </div>
                @if(!isset($quantitativeData->quan_id))
                <form action="{{URL('admin/quantitative_risk/store')}}" method="post" id="quantitative_form">
                    @else
                    {!! Form::open(array('url'=>array('admin/quantitative_risk',$quantitativeData->quan_id),'method' => 'put','id' => 'quantitative_form')) !!}
                    @endif
                    {{ csrf_field() }}

                    <div class="margin-bottom-50">

                        <div class="margin-bottom-50">

                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    You are here :  <a href="{{url('admin/riskregister')}}">Risk Management</a>
                                </li>
                                <li>
                                    <span>Quantitative Risk</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                    @if(isset($quantitativeData->quan_id))
                                    Edit 
                                    @else
                                    Create
                                    @endif 
                                    Quantitative Risk
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project ID* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('project_id',$project_id,isset($quantitativeData->project_id) ? $quantitativeData->project_id : '',array('class'=>'form-control select2','placeholder'=>'Please select project','id'=>'projectid'))!!}  
                                                </div>
                                            </div>
                                            <label id="pname" name='project_desc'  class="col-sm-1"></label>
                                        </div>
                                    </div>
                                     <div class="col-xs-12 col-sm-6">
                                        <div class="row test_div_set">
                                            <div class="col-xs-12 col-sm-6">
                                                <span id="portfolioname" class="first_lab"></span>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <span id="bucketname" class="second_lab"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="risk-id">Risk Id* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                {!!Form::text('quan_risk_id',isset($quantitativeData->quan_risk_id) ? $quantitativeData->quan_risk_id : rand(10000,99999),array('class'=>'risk_input form-control border-radius-0 quan_risk_id_create','readonly'))!!}
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="Category">Risk Category* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7"> 
                                                {!!Form::select('quan_category',array('1'=>'Supplier risk','2'=>'Technology risk','3'=>'Infrastructure risk','4'=>'Govt. Policy risk','5'=>'Resource risk'),isset($quantitativeData->quan_category) ? $quantitativeData->quan_category : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select risk category','id'=>'quanCategory'))!!}  
                                            </div>
                                        </div>                               
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="Risk Desc">Risk Description* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::textarea('quan_risk_desc',isset($quantitativeData->quan_risk_desc) ? $quantitativeData->quan_risk_desc : '',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter risk descripiton','rows' => 2, 'cols' => 40,'id'=>'quanRiskDesc'))!!}                                    
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                     <div class="col-xs-12 col-sm-6">
                                        <div class="row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" >&nbsp;</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div id="piechart_3d"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="Category">Currency* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('quan_currency',$currency,isset($quantitativeData->quan_currency) ? $quantitativeData->quan_currency : '',array('class'=>'form-control select2','placeholder'=>'Please select currency','id'=>'currency'))!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="total-loss">Total Loss* :</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('quan_total_loss',isset($quantitativeData->quan_total_loss) ? $quantitativeData->quan_total_loss : '',array('class'=>'form-control border-radius-0 expected_loss','placeholder'=>'Please enter total loss','id'=>'quanTotalLoss'))!!}                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="Quan-probability">Probability* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('quan_probability',isset($quantitativeData->quan_probability) ? $quantitativeData->quan_probability : '',array('class'=>'form-control border-radius-0 expected_loss','placeholder'=>'Please enter probability','id'=>'quanProb'))!!}                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="expected-loss">Expected Loss :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('quan_expected_loss',isset($quantitativeData->quan_expected_loss) ? round($quantitativeData->quan_expected_loss) : '',array('class'=>'form-control border-radius-0','placeholder'=>'Expected loss','id'=>'quanExpLoss','readonly','id'=>'expectedloss'))!!}                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Risk Score* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('quan_risk_score',isset($quantitativeData->quan_risk_score) ? $quantitativeData->quan_risk_score : '',array('class'=>'form-control border-radius-0','placeholder'=>'Risk score','readonly','id'=>'quan_riskscore'))!!}                                                   
                                                </div>
                                             </div>
                                             <label id="risk_status" class="col-sm-1"></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label p-l-3 line-n word-break wspace-n">Risk Mitigation Action* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::textarea('risk_mitigation_action',isset($quantitativeData->risk_mitigation_action) ? $quantitativeData->risk_mitigation_action : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter risk mitigation action','id'=>'risk_mitigation_action','rows' => 2, 'cols' => 40))!!}                                                   
                                                    @if($errors->has('risk_mitigation_action')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('risk_mitigation_action') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                             <label id="risk_status" class="col-sm-1"></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                {!!Form::select('status',['Created'=>'Created','In Progress'=>'In Progress','Closed'=>'Closed'],isset($quantitativeData->status) ? $quantitativeData->status : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select status','id'=>'status'))!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                @if(isset($quantitativeData->quan_id))
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Created On :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('created_on',$createdon,array('class'=>'form-control border-radius-0','readonly'))!!}                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Created By:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                {!!Form::text('created_by',$createdby,array('class'=>'form-control border-radius-0','readonly'))!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Changed On :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('updated_at',$updatedon,array('class'=>'form-control border-radius-0','readonly'))!!}                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Changed By:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                {!!Form::text('quan_changed_by',$changedby,array('class'=>'form-control border-radius-0','readonly'))!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>  
                            <div class="card-footer card-footer-box text-right">
                                @if(!isset($quantitativeData->quan_id))
                                {!! Form::submit('Submit',array('class'=>'btn btn-primary card-btn')) !!}  
                                @else
                                {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn')) !!}  
                                @endif
                                <a href="{{url('admin/riskregister')}}" class="btn btn-danger">Cancel</a>
                            </div>
                            <!-- End Vertical Form -->
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div> 
</section>
<!-- End Dashboard -->
@if(isset($quantitativeData->quan_id))
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Risk', 'Expected Loss'],
          ['Total of current project risks', {{$all_projectloss}}],
          ['Current project risk', {{$quantitativeData->quan_expected_loss}}],
         
        ]);

        var options = {
          title: 'Quantitative Risk',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
@endif
@endsection

