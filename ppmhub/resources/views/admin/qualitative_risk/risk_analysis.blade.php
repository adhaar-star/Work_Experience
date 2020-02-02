@extends('layout.adminlayout')
@section('title','Risk Management | Qualitative Risk')
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/risk_analysis.js') !!}

<!-- Qualitative Risk -->
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="{{url('admin/riskregister')}}" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Risk Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/riskregister')}}">Risk Registry</a>
                            <a class="dropdown-item" href="{{url('admin/quantitative_risk')}}">Quantitaive Risk</a>
                            <a class="dropdown-item" href="{{url('admin/qualitative_risk')}}">Qualitative Risk</a>       
                        </ul>
                    </div> 
                </div>
                @if(!isset($qualitative_data->id))
                <form action="{{URL('/admin/riskregister/')}}" method="post" id="qualitative_form"> 
                    @else
                    {!! Form::open(array('url'=>array('admin/qualitative_risk',$qualitative_data->id),'method' => 'put','id' => 'qualitative_form')) !!}
                    @endif
                    {{ csrf_field() }}

                    <div class="margin-bottom-50">
                        <div class="margin-bottom-50">
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    You are here :  <a href="{{url('admin/riskregister')}}">Risk Management</a>
                                </li>
                                <li>
                                    <span>Qualitative Risk</span>
                                </li>
                            </ul>
                        </div>

                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                    @if(isset($qualitative_data->id))
                                    Edit 
                                    @else
                                    Create
                                    @endif 
                                    Qualitative Risk
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
                                                    {!!Form::select('project_id',$project_id,isset($qualitative_data->project_id) ? $qualitative_data->project_id : '',array('class'=>'form-control select2','placeholder'=>'Please select project','id'=>'projectid'))!!}  
                                                    @if($errors->has('project_id')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('project_id') }}
                                                    </div> 
                                                    @endif
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
                                                {!!Form::text('qual_risk_id',isset($qualitative_data->qual_risk_id) ? $qualitative_data->qual_risk_id : rand(10000,99999),array('class'=>'risk_input form-control border-radius-0','readonly'))!!}
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="Category">Risk Category* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                {!!Form::select('qual_category',array('1'=>'Supplier risk','2'=>'Technology risk','3'=>'Infrastructure risk','4'=>'Government Policy risk','5'=>'Resource risk'),isset($qualitative_data->qual_category) ? $qualitative_data->qual_category : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select risk category','id'=>'qualCategory'))!!}  
                                                @if($errors->has('qual_category')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('qual_category') }}
                                                </div> 
                                                @endif
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
                                                    {!!Form::textarea('qual_risk_desc',isset($qualitative_data->qual_risk_desc) ? $qualitative_data->qual_risk_desc : '',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter risk descripiton','rows' => 2, 'cols' => 40,'id'=>'qualRiskDesc'))!!}                                    
                                                </div>
                                                @if($errors->has('qual_risk_desc')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('qual_risk_desc') }}
                                                </div> 
                                                @endif
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
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="qualitative-likelihood">Qualitative Likelihood* :</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::select('qual_likelihood',array('Rare'=>'Rare','Unlikely'=>'Unlikely','Possible'=>'Possible','Likely'=>'Likely','Almost Certain'=>'Almost Certain'),isset($qualitative_data->qual_likelihood) ? $qualitative_data->qual_likelihood : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select qualitative likelihood','id'=>'qualImpact'))!!}  
                                                    @if($errors->has('qual_likelihood')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('qual_likelihood') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="Category">Qualitative Consequence* :</label>

                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon"> 
                                                    {!!Form::select('qual_consequence',array('Catastrophic'=>'Catastrophic','Major'=>'Major','Moderate'=>'Moderate','Minor'=>'Minor','Negligible'=>'Negligible'),isset($qualitative_data->qual_consequence) ? $qualitative_data->qual_consequence : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select qualitative consequence','id'=>'qualprobability'))!!}  
                                                    @if($errors->has('qual_consequence')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('qual_consequence') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Risk Score :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::text('risk_score',isset($qualitative_data->risk_score) ? $qualitative_data->risk_score : '',array('class'=>'form-control border-radius-0','placeholder'=>'Risk score','readonly','id'=>'riskscore'))!!}                                                   
                                                </div>
                                            </div>
                                            <label id="risk" class="col-sm-1"></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Risk Mitigation Action* :</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    {!!Form::textarea('risk_mitigation_action',isset($qualitative_data->risk_mitigation_action) ? $qualitative_data->risk_mitigation_action : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter risk mitigation action','rows' => 2, 'cols' => 40,'id'=>'risk_mitigation_action'))!!}                                                   
                                                    @if($errors->has('risk_mitigation_action')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('risk_mitigation_action') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                            <label id="risk" class="col-sm-1"></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                {!!Form::select('qual_status',['Created'=>'Created','In Progress'=>'In Progress','Closed'=>'Closed'],isset($qualitative_data->qual_status) ? $qualitative_data->qual_status : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select status','id'=>'status'))!!}
                                                @if($errors->has('qual_status')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('qual_status') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($qualitative_data->id))
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
                                                    {!!Form::text('changed_on',$updatedon,array('class'=>'form-control border-radius-0','readonly'))!!}                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Changed By:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                {!!Form::text('changed_by',$changedby,array('class'=>'form-control border-radius-0','readonly'))!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="card-footer card-footer-box text-right">
                                @if(!isset($qualitative_data->id))
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
@if(isset($qualitative_data->id))
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
                ['Risk', 'Risk Score'],
                ['Total of current project risks', {{$current_riskscore}}],
          ['Current project risk', {{$qualitative_data->risk_score}}],
         
        ]);
        var options = {
                    title: 'Qualitative Risk',
                        is3D: true,
                };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
        }
</script>
@endif
@endsection

