@extends('layout.adminlayout')
@section('title','Report | Timesheet Report')
@section('body')
{!! Html::script('/js/Report-pop-up.js') !!}
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/TimeSheetReport.js') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/report_validation.js') !!}
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

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
                                $ProjectTo = $reportProject_to;
                            } else {
                                $ProjectTo = "-";
                            }

                            if (isset($reportProject_from) && !empty($reportProject_from)) {
                                $ProjectForm = $reportProject_from;
                            } else {
                                $ProjectForm = "-";
                            }
                            ?>
                            <a class="dropdown-item" href="{{url('admin/timesheetpdf/'.$ProjectTo.'/'.$ProjectForm)}}">Pdf</a>
                            <a class="dropdown-item" href="{{url('admin/export_timesheet_cs/'.$ProjectTo.'/'.$ProjectForm)}}">Csv</a>
                            <a class="dropdown-item" href="{{url('admin/timesheetht/'.$ProjectTo.'/'.$ProjectForm)}}">Html</a>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">					
                    <div class="col-xl-7">
                        <h3>Project Report: Timesheet Report<h3>
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
                                </div>

                                <div class="col-lg-12">			

                                    <div class="dataTables_wrapper form-inline dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-xl-6">	

                                                {{Form::open(array('method' =>'GET','class'=>'reportClass'))}}
                                                <div class="margin-bottom-50">
                                                    <div class="card form_box">
                                                        <div class="card-header card-header-box bg-lightcyan report_form">
                                                            <h4 class="margin-0">Report</h4>
                                                            <!-- Vertical Form -->
                                                        </div>
                                                        <div class="card-block"><br/>

                                                            <div class="row" style="padding:0 0 8px 0">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project ID : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                                        <div class="form-input-icon">	
                                                                            {!!Form::select('reportProject_from',$projectlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Project','id'=>'reportProject_from'))!!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6">											
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project ID : </label>
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
                                                            <a href="{{url('admin/timesheet')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                                                            Available Budget
                                                        </span>								
                                                        <span class="margin-right-10 nowrap">
                                                            <span class="donut donut-success"></span>
                                                            Actual Cost
                                                        </span>
                                                        <span class="margin-right-10 nowrap">
                                                            <span class="donut donut-primary"></span>
                                                            Annual Budget
                                                        </span>
                                                    </div>-->
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
                                                                <th>Planned Cost</th>
                                                                <th>Actual Cost</th>
                                                                <th>Overall Budget</th>
                                                                <th>Available Budget</th>
                                                                <th>Resource Cost</th>
                                                                <th>Total Time Entered</th>
                                                                <th>% of Total Cost</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--modal-popup-->
                                        <div class="modal fade table-view-popup" id="table-pro-view-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="{{url('admin/dashboard')}}">Report Management</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/costbudget')}}">Check List Dashboard</a>
                                                                </li>

                                                                <li>
                                                                    <span id="breadCrumPId">P00001</span>
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
                                                                    <p class="form-control-static" id="projectId">11</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="projectName">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" >Project Type</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="projectType">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="projectDesc">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="portName">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="portId">5</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio Type</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="portType">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="bucketName">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="bucketId">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Project Location</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="prjLocation">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Center</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="costCentre">1</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Department</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static" id="departmentName">-</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Start Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="pstartDate">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">End Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="pendDate">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Actual Start Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="actualSdate">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Actual End Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="actualEdate">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Forecast Start Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="foreSdata">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Forecast End Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="foreEdata">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Scheduled Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="schedDate"></div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Planned Start Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="plannedSdate">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Planned End Date</p>
                                                                </div>
                                                                <div class="col-sm-5" id="plannedEdate">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created On</p>
                                                                </div>
                                                                <div class="col-sm-5" id="createdOn">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created By</p>
                                                                </div>
                                                                <div class="col-sm-5" id="createdBy">-</div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5" id="statusP">-</div> 
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>

                                </div>
                                </div>
                                </div>
                                </section>

                                <?php
                                if(isset($report)){
                                foreach ($report as $val) {
                                    $budget_orgignal[] = $val->budget_org_overall;
                                    $budget_actual_cost[] = $val->actuall_cost;

                                    if (isset($val->budget_org_overall) && isset($val->budget_return_overall) && isset($val->budget_supplement_overall)) {
                                        $budget_available[] = ($val->budget_org_overall + $val->budget_supplement_overall) - $val->budget_return_overall;
                                    }
                                }
                                }
                                if (isset($budget_orgignal)) {
                                    $budget_org = implode(',', $budget_orgignal);
                                } else {
                                    $budget_org = "";
                                }

                                if (isset($budget_actual_cost)) {
                                    $budget_actual_cost = implode(',', $budget_actual_cost);
                                } else {
                                    $budget_actual_cost = "";
                                }

                                if (isset($budget_available)) {
                                    $budget_available = implode(',', $budget_available);
                                } else {
                                    $budget_available = "";
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
                                        labels: [<?php echo $budget_actual_cost ?>],
                                        series: [
                                            [<?php echo $budget_actual_cost ?>],
                                            [<?php echo $budget_available ?>],
                                            [<?php echo $budget_actual_cost ?>],
                                        ]
                                    },
                                    overlappingOptions = {
                                        seriesBarDistance: 5,
                                        plugins: [
                                            Chartist.plugins.tooltip()
                                        ]
                                    },
                                    overlappingResponsiveOptions = [
                                        ["", {
                                                seriesBarDistance: 5,
                                                axisX: {
                                                    labelInterpolationFnc: function (value) {
                                                        return value[0]
                                                    }
                                                }
                                            }]
                                    ];
                                    new Chartist.Bar(".report_chart", overlappingData, overlappingOptions, overlappingResponsiveOptions);
                                </script>
                                @endsection