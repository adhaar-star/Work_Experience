@extends('layout.adminlayout')
@section('title','Risk Management | Quantitative Risk')
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

                {!! Form::open([ 'route' => ['quantitativeRisk.update', $quantitative_data->quan_id],'method' => 'put','id' => 'quantitativeContextform']) !!}

                {{ csrf_field() }}

                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here :  <a href="{{url('admin/riskregister')}}">Risk Management</a>
                            </li>
                            <li>
                                <a href = "{{url('admin/riskregister')}}">Risk Register</a>
                            </li>
                            <li>
                                <span>Edit Quantitative Risk Context</span>
                            </li>
                        </ul>
                    </div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger errorMessage">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">
                                Edit Quantitative Risk Context
                                <div class="col-md-6 pull-right">
                                    <label class="pull-right"><span class="text-danger">*</span>Mandatory fields</label>
                                </div>
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">  
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="risk-id">Risk Id :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('quan_risk_id',isset($quantitative_data->quan_risk_id) ? $quantitative_data->quan_risk_id : rand(10000,99999),array('class'=>'risk_input form-control border-radius-0','readonly'))!!}
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-3 col-form-label" for="Risk Desc">Risk Type :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('risk_type',isset($quantitative_data->risk_type) ? $quantitative_data->risk_type : '',array('class'=>'form-control header_note  border-radius-0 no-resize','readonly'))!!}                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="Risk Desc">Risk Description<span class="text-danger">*</span> :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::textarea('quan_risk_desc',isset($quantitative_data->quan_risk_desc) ? $quantitative_data->quan_risk_desc : '',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter risk descripiton','rows' => 2, 'cols' => 40,'id'=>'qualRiskDesc'))!!}                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label text-right line-height-2">Strategic Context :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-10 col-lg-9">
                                            {!!Form::textarea('strategic_context',isset($quantitative_data->strategic_context) ? $quantitative_data->strategic_context : '',array('class'=>'form-control border-radius-0 texteditorSet','rows' => 7, 'cols' => 10,'maxlength'=>300))!!}                                    
                                            <p class="counterText text-center redset">Maximum 300 Characters Only</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label text-right line-height-2">Organisational Context :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-10 col-lg-9">
                                            {!!Form::textarea('organisational_context',isset($quantitative_data->organisational_context) ? $quantitative_data->organisational_context : '',array('class'=>'form-control border-radius-0 texteditorSet','rows' => 7, 'cols' => 10,'maxlength'=>300))!!}                                    
                                            <p class="counterText text-center redset">Maximum 300 Characters Only</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label text-right line-height-2">Riskmanagement Context :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-10 col-lg-9">
                                            {!!Form::textarea('riskmanagement_context',isset($quantitative_data->riskmanagement_context) ? $quantitative_data->riskmanagement_context : '',array('class'=>'form-control border-radius-0 texteditorSet','rows' => 7, 'cols' => 10,'maxlength'=>300))!!}                                    
                                            <p class="counterText text-center redset">Maximum 300 Characters Only</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer card-footer-box text-right">
                        {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn')) !!}  
                        <a href="{{url('admin/riskregister')}}" class="btn btn-danger">Cancel</a>
                    </div>

                    <!-- End Vertical Form -->
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- End Dashboard -->
@endsection

