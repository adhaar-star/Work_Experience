@extends('layout.adminlayout')
@section('title','Report | Cost Budget')
@section('body')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/CostBudgetReport.js') !!}
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
                            @if(isset($reportProject_from) && $reportProject_from != "-" && isset($reportProject_to) && $reportProject_to != "-")
                            <a class="dropdown-item" href="{{url('admin/costbudgetht/'.$Project_form.'/'.$Project_to.'/'.$start_date.'/'.$end_date)}}">Html</a>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">
                    <div class="col-xl-7">
                        <h3>Project Report: Cost Budget Report<h3>
                                </div>	
                                <?php if (isset($request_p) && !empty($request_p)) { ?>					
                                    <div class="col-xl-4 report_info alert alert-danger">
                                        <?php
                                        if ($request_p == "*p-") {
                                            $type = "PDF";
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
                                                        <div class="form-group row" style="margin-bottom: 1rem;">
                                                            <div class="col-xs-6 col-sm-6">
                                                                <div class="row">
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project ID : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                                        <div class="form-input-icon">	
                                                                            {!!Form::select('reportProject_from',$projectlist,'',array('class'=>'form-control select2 border-radius-0','id' => 'reportProject_from','placeholder'=>'Please select Project'))!!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6">											
                                                                <div class="row">
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">To Project ID : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                                        <div class="form-input-icon">		
                                                                            {!!Form::select('reportProject_to',$projectlist,'',array('class'=>'form-control select2 border-radius-0','id' => 'reportProject_to','placeholder'=>'Please select Project'))!!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-xs-6 col-sm-6">
                                                                <div class="row">
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Start Date : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                                        <div class="form-input-icon">	
                                                                            <input type="text" data-validation="[NOTEMPTY]" placeholder="" style="width:100%" id="p_start_date" name="reportStart_date" value="<?php
                                                                            if (isset($reportStart_date)) {
                                                                                echo $reportStart_date;
                                                                            }
                                                                            ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6">											
                                                                <div class="row">
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">End Date : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                                        <div class="form-input-icon">		
                                                                            <input type="text" data-validation="[NOTEMPTY]" placeholder="" style="width:100%" id="p_end_date" name="reportEnd_date" value="<?php
                                                                            if (isset($reportEnd_date)) {
                                                                                echo $reportEnd_date;
                                                                            }
                                                                            ?>" class="form-control">
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
                                                        <a href="{{url('admin/costbudget')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                                                        Project Vs 
                                                    </span>
                                                    <span class="margin-right-10 nowrap">
                                                        <span class="donut donut-default"></span>
                                                        Planned Cost
                                                    </span>								
                                                    <span class="margin-right-10 nowrap">
                                                        <span class="donut donut-success"></span>
                                                        Actual Cost
                                                    </span>
                                                    <span class="margin-right-10 nowrap">
                                                        <span class="donut donut-primary"></span>
                                                        Budget
                                                    </span>
                                                </div>
                                                <div class="widget-body">
                                                    <div class="report_chart height-250 chartist"></div>
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
                                                    <th>Start Date</th>							
                                                    <th>End Date</th>							
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
                                </section>

                                <?php
                                $budget_orgignal = [];
                                $budget_actual_cost = [];
                                $budget_planned_cost = [];
                                $budget_project_id = [];

                                if (isset($originalBudget)):
                                    foreach ($originalBudget as $key => $val) {

                                        $budget_orgignal[$key] = $val->budget_org_overall;
                                        $budget_actual_cost[$key] = $val->actual_cost;
                                        $budget_planned_cost[$key] = $val->planned_cost;
                                        $budget_project_id[$key] = $val->project_PID;
                                    }
                                endif;


                                if (isset($budget_project_id)) {
                                    $budget_project_id = implode(',', $budget_project_id);
                                } else {
                                    $budget_project_id = "";
                                }

                                if (isset($budget_orgignal)) {
                                    $budget_orgignal = implode(',', $budget_orgignal);
                                } else {
                                    $budget_orgignal = "";
                                }

                                if (isset($budget_actual_cost)) {
                                    $budget_actual_cost = implode(',', $budget_actual_cost);
                                } else {
                                    $budget_actual_cost = "";
                                }

                                if (isset($budget_planned_cost)) {
                                    $budget_planned_cost = implode(',', $budget_planned_cost);
                                } else {
                                    $budget_planned_cost = "";
                                }

                                print_r($budget_project_id);
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
                                        labels: [<?php echo "'" . str_replace(',', "','", $budget_project_id) . "'" ?>],
                                        series: [
                                            [<?php echo "'" . str_replace(',', "','", $budget_orgignal) . "'" ?>],
                                            [<?php echo "'" . str_replace(',', "','", $budget_actual_cost) . "'" ?>],
                                            [<?php echo "'" . str_replace(',', "','", $budget_planned_cost) . "'" ?>],
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
                                                        return value
                                                    }
                                                }
                                            }]
                                    ];
                                    new Chartist.Bar(".report_chart", overlappingData, overlappingOptions, overlappingResponsiveOptions);
                                </script>
                                {!! Html::script('/js/jquery.validate.min.js') !!}
                                {!! Html::script('/js/report_validation.js') !!}
                                @endsection