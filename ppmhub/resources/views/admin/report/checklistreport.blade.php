@extends('layout.adminlayout')
@section('title','Report | Check List Report')
@section('body')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/Report-pop-up.js') !!}
{!! Html::script('/js/CheckListReport.js') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/report_validation.js') !!}
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
                           if (isset($reportProject_from) && !empty($reportProject_from)) {
                                $Project_from = $reportProject_from;
                            } else {
                                $Project_from = NULL;
                            }
                            if (isset($reportProject_to) && !empty($reportProject_to)) {
                                $Project_to = $reportProject_to;
                            } else {
                                $Project_to = NULL;
                            }
                            if (isset($reportName) && !empty($reportName)) {
                                $managerName = $reportName;
                            } else {
                                $managerName = "-";
                            }
                            if (isset($reportChecklist_id) && !empty($reportChecklist_id)) {
                                $checklist_id = $reportChecklist_id;
                            } else {
                                $checklist_id = "-";
                            }
                            ?>						
                           <?php if (isset($reportProject_from) && isset($reportProject_to) && !empty($reportProject_from) && !empty($reportProject_to)){ ?>
                            <a class="dropdown-item" href="{{url('admin/checklistht/'.$Project_from.'/'.$Project_to.'/'.$managerName.'/'.$checklist_id)}}">Html</a>
                           <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">					
                    <div class="col-xl-7">
                        <h3>Project Report: Check List Report</h3>
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

            <div class="col-lg-12">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-xl-6">	

                            {{Form::open(array('method' =>'POST','id'=>'checklistreport','class'=>'reportClass'))}}
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
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project ID : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">	
                                                            {!!Form::select('reportProject_from',$projectlist,'',array('class'=>'form-control select2 border-radius-0', 'id' => 'reportProject_from', 'placeholder'=>'Please select Project'))!!}
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
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Manager : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">	
                                                            {!!Form::select('name',$userlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Manager'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6">											
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Checklist ID : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">		
                                                            {!!Form::select('checklist_id',$checklist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Checklist'))!!}
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
                                        <a href="{{url('admin/checklistreport')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                    </div>                     
                                </div>
                            </div>
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            {{ Form::close() }}
                        </div>		
                       <!-- <div class="col-xl-6">
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
                        </div>-->	
						<div class="col-xl-6">
							<div class="widget widget-six">
								<div class="widget-body">
									<!--<div class="report_chart height-250 chartist"></div>-->
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
                                            <th>Person Responsible</th>
                                            <th>Checklist ID</th>
                                            <th>Check List Description</th>
                                            <th>Checklist Status</th>
                                            <th>Checklist Date</th>							
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
if (isset($report)):
    foreach ($report as $val) {
        $budget_orgignal[] = $val->checklist_id;
        $budget_return[] = $val->project_id;
        $budget_supplement[] = $val->project_id;
    }
endif;
if (isset($budget_orgignal)) {

    $budget_org = implode(',', $budget_orgignal);
} else {
    $budget_org = "";
}

if (isset($budget_return)) {

    $budget_return = implode(',', $budget_return);
} else {
    $budget_return = "";
}
if (isset($budget_supplement)) {
    $budget_supplement = implode(',', $budget_supplement);
} else {

    $budget_supplement = "";
}
?>


<script type="text/javascript">

    $(function () {
        $('#p_start_date').datetimepicker({format: "YYYY-MM-DD"});
    });
    $(function () {
        $('#p_end_date').datetimepicker({format: "YYYY-MM-DD"});
    });


    var overlappingData = {
        labels: [<?php echo $budget_org ?>],
        series: [
            [<?php echo $budget_org ?>],
            [<?php echo $budget_return ?>],
            [<?php echo $budget_supplement ?>]
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
                        return value[0]
                    }
                }
            }]
    ];
    new Chartist.Bar(".report_chart", overlappingData, overlappingOptions, overlappingResponsiveOptions);
</script>
@endsection