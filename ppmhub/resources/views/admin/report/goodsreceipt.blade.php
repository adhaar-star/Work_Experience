@extends('layout.adminlayout')
@section('title','Report | Goods Receipt For A Project Report')
@section('body')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/Report-pop-up.js') !!}
{!! Html::script('/js/GoodsReceiptReport.js') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/report_validation.js') !!}
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
                            <a class="dropdown-item" href="{{url('admin/purchaserequisitionpdf/'.$Project_to.'/'.$Project_form)}}">Pdf</a>
                            <a class="dropdown-item" href="{{url('admin/export_purchaserequisition_cs/'.$Project_to.'/'.$Project_form)}}">Csv</a>
                            <a class="dropdown-item" href="{{url('admin/purchaserequisitionht/'.$Project_to.'/'.$Project_form)}}">Html</a>

                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">

                    <div class="col-xl-7">
                        <h3>Project Report: Goods Receipt For A Purchase order</h3>
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
                                    <div class="card-block">
                                        <div class="row" >
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <label class="col-md-3">Purchase order(s) :</label>
                                                <div class="col-md-12">
                                                    <div>	
                                                        <!--{!!Form::select('reportpurchaseorder[]',$purchaseOrder,'',array('class'=>'form-control select2 border-radius-0','multiple'=>true,'placeholder'=>'Please select Project'))!!}-->
                                                        {!!Form::select('reportpurchaseorder[]',$purchaseOrder,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Purchase Order no'))!!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer card-footer-box text-right">
                                        <button type="submit" class="btn btn-primary card-btn">Execute</button>
                                        <a href="{{url('admin/goodsreceiptreport')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                                <div class="widget-body">
                                    <div class="report_chart height-250 chartist"></div>
                                </div>
                            </div>
                        </div>							
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="margin-bottom-50">
                                <table class="table table-inverse table-responsive" id="DateTablePPMHUB" width="100%">
                                    <thead>
                                        <tr class="report_theam">
                                            <th> Goods Receipt ID </th>
                                            <th> Project ID </th>
                                            <th> Purchase Order	</th>
                                            <th> Item number </th>
                                            <th> Total Value	</th>
                                            <th> Goods Receipt Value </th>	
                                            <th> Vendor ID  </th>	
                                            <th> Date </th>	
                                            <th> Dr/Cr Indicator </th>	
                                            <th> Item cost </th>	
                                            <th> Material qty </th>	
                                            <th> G/L account	</th>
                                            <th> cost center posting </th>							
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
//foreach ($report as $val) {
//    $budget_orgignal[] = $val->project_id;
//    $budget_return[] = $val->project_phase_id;
//    $budget_supplement[] = $val->task_Id;
//}
//
//if (isset($budget_orgignal)) {
//
//    $budget_org = implode(',', $budget_orgignal);
//} else {
//    $budget_org = "";
//}
//
//if (isset($budget_return)) {
//
//    $budget_return = implode(',', $budget_return);
//} else {
//    $budget_return = "";
//}
//if (isset($budget_supplement)) {
//    $budget_supplement = implode(',', $budget_supplement);
//} else {
//
//    $budget_supplement = "";
//}
//
?>






<script type="text/javascript">
//
//    $(function () {
//        $('#p_start_date').datetimepicker({format: "YYYY-MM-DD"});
//
//        $("#p_start_date").on("dp.change", function (e) {
//            $('#p_end_date').data("DateTimePicker").minDate(e.date);
//        });
//        $("#p_end_date").on("dp.change", function (e) {
//            $('#p_start_date').data("DateTimePicker").maxDate(e.date);
//        });
//
//    });
//    $(function () {
//        $('#p_end_date').datetimepicker({format: "YYYY-MM-DD"});
//    });
//
//
//    var overlappingData = {
//        labels: [<?php echo'' ?>],
//        series: [
//            [<?php echo '' ?>],
//            [<?php echo '' ?>],
//            [<?php echo '' ?>]
//        ]
//    },
//    overlappingOptions = {
//        seriesBarDistance: 10,
//        plugins: [
//            Chartist.plugins.tooltip()
//        ]
//    },
//    overlappingResponsiveOptions = [
//        ["", {
//                seriesBarDistance: 5,
//                axisX: {
//                    labelInterpolationFnc: function (value) {
//                        return value[0]
//                    }
//                }
//            }]
//    ];
//    new Chartist.Bar(".report_chart", overlappingData, overlappingOptions, overlappingResponsiveOptions);
</script>
@endsection