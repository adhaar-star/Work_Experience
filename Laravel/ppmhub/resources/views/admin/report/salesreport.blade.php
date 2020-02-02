@extends('layout.adminlayout')
@section('title','Report | Sales Report')
@section('body')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/SalesOrderReport.js') !!}
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
                            if (isset($sales_order_number_from) && !empty($sales_order_number_from)) {
                                $sales_ord_no_from = $sales_order_number_from;
                            } else {
                                $sales_ord_no_from = "-";
                            }
                            if (isset($sales_order_number_to) && !empty($sales_order_number_to)) {
                                $sales_ord_no_to = $sales_order_number_to;
                            } else {
                                $sales_ord_no_to = "-";
                            }
                            ?>	
                            <?php ?>
                            <a class="dropdown-item" href="{{url('admin/salesorderht/'.$sales_ord_no_from.'/'.$sales_ord_no_to)}}">Html</a>
                          <?php ?>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">					
                    <div class="col-xl-7">
                        <h3>Project Report: Sales Report<h3>
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

                                                {{Form::open(array('method' =>'POST','class'=>'reportClass'))}}
                                                <div class="margin-bottom-50">
                                                    <div class="card form_box">
                                                        <div class="card-header card-header-box bg-lightcyan report_form">
                                                            <h4 class="margin-0">Report</h4>
                                                            <!-- Vertical Form -->
                                                        </div>
                                                        <div class="card-block">
                                                            <div class="form-group row">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-xs-12 col-sm-6 col-md-5 col-form-label" for="l33">Sales Order No: </label>
                                                                        <div class="col-xs-12 col-sm-6 col-md-7">
                                                                            <div class="form-input-icon">	
                                                                                {!!Form::select('sales_orderno_from',$sales_orderlist,'',array('class'=>'form-control select2 border-radius-0','id'=>'sales_orderno_from','placeholder'=>'Please select Sales Order No'))!!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xs-6 col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-xs-12 col-sm-6 col-md-5 col-form-label" for="l33">Sales Order No: </label>
                                                                        <div class="col-xs-12 col-sm-6 col-md-7">
                                                                            <div class="form-input-icon">	
                                                                                {!!Form::select('sales_orderno_to',$sales_orderlist,'',array('class'=>'form-control select2 border-radius-0','id'=>'sales_orderno_to','placeholder'=>'Please select Sales Order No'))!!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input id="created_at" name="created_at" value="2017-08-10 04:41:46" required="required" class="form-control col-md-7 col-xs-12" type="hidden">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer card-footer-box text-right">
                                                            <button type="submit" class="btn btn-primary card-btn">Execute</button>
                                                            <a href="{{url('admin/salesreport')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                                                                <th>Planned Revenue</th>
                                                                <th>Actual Revenue</th>
                                                                <th>Sales Order Number</th>							
                                                                <th>Sales Order Status</th>							
                                                                <th>Customer Number</th>							
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

                                <?php
                                if (isset($report)) {
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

                                            $("#p_start_date").on("dp.change", function (e) {                                             $('#p_end_date').data("DateTimePicker").minDate(e.date);
                                        });
                                            $("#p_end_date").on("dp.change", function (e) {                                             $('#p_start_date').data("DateTimePicker").maxDate(e.date);
                                        });

                                    });
                                    $(function () {
                                        $('#p_end_date').datetimepicker({format: "YYYY-MM-DD"});
                                    });


                                    var overlappingData = {
                                        labels: [<?php echo $budget_actual_cost ?>],
                                                series: [
                                                    [<?php echo $budget_actual_cost ?>],
                                                                [<?php echo $budget_actual_cost ?>],
                                                                            [<?php echo $budget_available ?>]
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
                                {!! Html::script('/js/jquery.validate.min.js') !!}
                                {!! Html::script('/js/report_validation.js') !!}
                                @endsection