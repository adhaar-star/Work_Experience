@extends('layout.adminlayout')
@section('title','Report | Risk Analysis Report')
@section('body')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/report_validation.js') !!}
{!! Html::script('/js/reportRisk_analysis.js') !!}
 <style>
.highcharts-legend-box{
	display:none
	}
.highcharts-legend-item rect{
	display:none
}
.highcharts-button-symbol{
	display:none
}

</style>

 <script src="{{asset('vendors/jquery/graph/highcharts.js')}}"></script>
 <script src="{{asset('vendors/jquery/graph/exporting.js')}}"></script>
@if(Session::has('flash_message'))
<div class="alert alert-danger">
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
                            <span class="hidden-lg-down">Export</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <?php
                            if (isset($projectsFrom) && !empty($projectsFrom)) {
                              $ProjectFrom = $projectsFrom;
                            } else {
                              $ProjectFrom = "-";
                            }

                            if (isset($projectsTo) && !empty($projectsTo)) {
                              $ProjectTo = $projectsTo;
                            } else {
                              $ProjectTo = "-";
                            }

                            if (isset($risktype) && !empty($risktype)) {
                              $riskType = $risktype;
                            } else {
                              $riskType = "-";
                            }

                            if (isset($status) && !empty($status)) {
                              $status = $status;
                            } else {
                              $status = "-";
                            }
                            ?>
                            <a class="dropdown-item" href="{{url('admin/riskanalysisht/'.$ProjectFrom.'/'.$ProjectTo.'/'.$riskType.'/'.$status)}}">Html</a>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">					
                    <div class="col-xl-7">
                        <h3>Project Report: Risk Analysis Report</h3>
                    </div>	
                    <?php if (isset($request_p) && !empty($request_p)) { ?>					
                      <div class="col-xl-4 report_info alert alert-danger">
                          <?php
                          if ($request_p == "*p-") {
                            $type = "PHF";
                          }
                          if ($request_p == "*h-") {
                            $type = "HTML";
                          }
                          if ($request_p == "*c-") {
                            $type = "CSV";
                          }
                          ?>					
                          <strong> Info !</strong> You can not export the<strong> Report <?php echo $type ?> </strong> because record is empty <strong></strong>
                      </div>					
                    <?php } ?>
                </div>	
            </div>
            <div class="col-lg-12">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-xl-6">	
                            {{Form::open(array('method' =>'POST','class'=>'reportClass'))}}
                            <div class="margin-bottom-50">
                                <div class="card form_box">
                                    <div class="card-header card-header-box bg-lightcyan report_form">
                                        <h4 class="margin-0">Report</h4>
                                        <!-- Vertical Form -->
                                    </div>
                                    <div class="card-block"><br/>
                                        <div class="form-group row">										
                                            <div class="col-xs-6 col-sm-6">
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Id : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">
                                                            {!!Form::select('reportProject_from',$projectlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select project','id'=>'reportProject_from'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6">											
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">To Project Id : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">		
                                                            {!!Form::select('reportProject_to',$projectlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select project','id'=>'reportProject_to'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="form-group row">										
                                            <div class="col-xs-6 col-sm-6">
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Risk Type : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">
                                                            {!!Form::select('riskType',array('Qualitative'=>'Qualitative Risk','Quantitative'=>'Quantitative Risk'),'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select risk type'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6">											
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Status : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">		
                                                            {!!Form::select('status',array('Created'=>'Created','In Progress'=>'In Progress','Closed'=>'Closed'),'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select status'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="row" style="margin: 0;">
                                            <input id="created_at" name="created_at" value="2017-08-10 04:41:46" required="required" class="form-control col-md-7 col-xs-12" type="hidden">
                                        </div>
                                    </div>
                                    <div class="card-footer card-footer-box text-right">
                                        <button type="submit" class="btn btn-primary card-btn">Execute</button>
                                        <a href="{{url('admin/riskanalysis')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                    </div>                     
                                </div>
                            </div>
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            {{ Form::close() }}
                        </div>		
						<div class="col-xl-6">
                            <div class="widget widget-six">
								<!--
                                <div class="widget-header">
                                    <span class="margin-right-10 nowrap">
                                        <span class="donut donut-default"></span>
                                        Project
                                    </span>								
                                    <span class="margin-right-10 nowrap">
                                        <span class="donut donut-success"></span>
                                        Risk Type
                                    </span>
                                    <span class="margin-right-10 nowrap">
                                        <span class="donut donut-primary"></span>
                                        Risk Score
                                    </span>
                                </div>
								-->
                                <div class="widget-body">
                                    <!--<div class="report_chart height-250 chartist"></div>-->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!--<div id="piechart_3d"></div>-->
											<div id="qualitative_graph_container" style="min-width: 200px; height: 250px; margin: 0 auto"></div>
                                        </div>
                                    </div>
									 <div class="row">
                                        <div class="col-sm-12">
											<div id="quantitative_graph_container" style="min-width: 200px; height: 250px; margin: 0 auto"></div>
                                           <!--<div id="piechart_3d1"></div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>			
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="margin-bottom-50">
                                <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                                    <thead>
                                        <tr class="report_theam">
                                            <th>Project ID</th>
                                            <th>Project Name</th>
                                            <th>Risk ID</th>
                                            <th>Risk Type</th>
                                            <th>Risk Score</th>
                                            <th>Status</th>							
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
$('#projectfrom').select2({
}).on('change', function () {
    $(this).valid();
});
$('#projectto').select2({
}).on('change', function () {
    $(this).valid();
});
var result = <?php echo json_encode($result); ?>;

var result1 = <?php echo json_encode($result1); ?>;

var resultData = [];
var resultData1 = [];

resultData.push(['Project', 'Risk Score']);

resultData1.push(['Project', 'Risk Score']);


for (x in result)
{
    resultData.push([x, parseInt(result[x])]);
}

for (x1 in result1)
{
    resultData1.push([x1, parseInt(result1[x1])]);
}

google.charts.load("current", {packages: ["corechart"]});
google.charts.setOnLoadCallback(drawChart);


function drawChart() {
    var data = google.visualization.arrayToDataTable(resultData);
    var options = {
        title: 'Qualitative Risk',
        is3D: true,
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
    drawChart1();
}

function drawChart1() {
    var data1 = google.visualization.arrayToDataTable(resultData1);
    var options1 = {
        title: 'Quantitative Risk',
        is3D: true,
    };
    var chart1 = new google.visualization.PieChart(document.getElementById('piechart_3d1'));
    chart1.draw(data1, options1);

}
</script>
@endsection