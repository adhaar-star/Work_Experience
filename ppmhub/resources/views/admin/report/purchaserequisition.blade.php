@extends('layout.adminlayout')
@section('title','Report | Purchase Requisitions For A Project Report')
@section('body')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/report_validation.js') !!}
{!! Html::script('/js/purchaseReport.js') !!}
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
                            if (isset($reportProject_to) && !empty($reportProject_to)) {
                                $Project_to = $reportProject_to;
                            } else {
                                $Project_to = "-";
                            }

                            if (isset($reportProject_from) && !empty($reportProject_from)) {
                                $Project_form = $reportProject_from;
                            } else {
                                $Project_form = "-";
                            }

                            if (isset($reportStart_date) && !empty($reportStart_date)) {
                                $start_date = $reportStart_date;
                            } else {
                                $start_date = "-";
                            }

                            if (isset($reportEnd_date) && !empty($reportEnd_date)) {
                                $end_date = $reportEnd_date;
                            } else {
                                $end_date = "-";
                            }
                            ?>
                            <a class="dropdown-item" href="{{url('admin/purchaserequisitionpdf/'.$Project_to.'/'.$Project_form)}}">Pdf</a>
                            <a class="dropdown-item" href="{{url('admin/export_purchaserequisition_cs/'.$Project_to.'/'.$Project_form)}}">Csv</a>
                            <a class="dropdown-item" href="{{url('admin/purchaserequisitionht/'.$Project_to.'/'.$Project_form)}}">Html</a>

                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">

                    <div class="col-xl-7">
                        <h3>Project Report: Purchase Requisitions For A Project</h3>
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

                            <strong> Info !</strong> You can not export the<strong> Report <?php echo $type ?> </strong> becouse record is empty <strong></strong>
                        </div>					
                    <?php } ?>


                </div>	</br>		
                <div class="dataTables_wrapper form-inline dt-bootstrap4">
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
                                        <div class="row" style="padding:0 0 8px 0">
                                            <div class="col-xs-6 col-sm-6">
                                                <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project ID :</label>
                                                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                    <div class="form-input-icon report-custom-select">	
                                                        {!!Form::select('reportProject_from',$projectlist,'',array('class'=>'form-control select2','placeholder'=>'Please select Project','id'=>'reportProject_from'))!!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6">											
                                                <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">To Project ID : </label>
                                                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                    <div class="form-input-icon">		
                                                        {!!Form::select('reportProject_to',$projectlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Project','id'=>'reportProject_to'))!!}
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
                                        <a href="{{url('admin/purchaserequisition')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                    </div>                     
                                </div>
                            </div>
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            {{ Form::close() }}
                        </div>		
                        <div class="col-xl-6">
                            <div class="widget widget-six">
                                <div class="widget-header">
                                    <span class="margin-right-10 nowrap">
                                        Project ID Vs Purchase Requisition Cost
                                    </span>								
                                </div>
                                <div class="widget-body">
                                   <div id="graph_container" style="min-width: 200px; height: 250px; margin: 0 auto"></div>
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
                                            <th>Project Description</th>
                                            <th>Purchase Requisition</th>
                                            <th>Purchase Requisition Item</th>
                                            <th>Total Price</th>
                                            <th>Person Responsible</th>
                                            <th>Vendor Name</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>							
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<?php
//if (count($graph) > 0) {
//    $graph = $graph->toArray();
//    $array_keys_pr_cost = array_keys($graph);
//    $array_values_project_id = array_values($graph);
//}

if (isset($array_keys_pr_cost)) {
    $costs = implode(',', $array_keys_pr_cost);
} else {
    $costs = "";
}

if (isset($array_values_project_id)) {
    $projects = implode(',', $array_values_project_id);
} else {
    $projects = "";
}
?>
<script type="text/javascript">

    $(function () {
        $('#p_start_date').datetimepicker({format: "YYYY-MM-DD"});

        $("#p_start_date").on("dp.change", function (e) {
            $('#p_end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#p_end_date").on("dp.change", function (e) {
            $('#p_start_date').data("DateTimePicker").maxDate(e.date);
        });

    });
    $(function () {
        $('#p_end_date').datetimepicker({format: "YYYY-MM-DD"});
    });

    var overlappingData = {
        labels: [<?php echo "'" . str_replace(',', "','", $projects) . "'" ?>],
        series: [
            [<?php echo "'" . str_replace(',', "','", $costs) . "'" ?>],
          ]
    },
    overlappingOptions = {
        seriesBarDistance: 10,
        plugins: [
            Chartist.plugins.tooltip()
        ]
    },
    overlappingResponsiveOptions = [
        ["", {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value
                    }
                }
            }]
    ];
    new Chartist.Bar(".report_chart", overlappingData, overlappingOptions, overlappingResponsiveOptions);
</script>
@endsection