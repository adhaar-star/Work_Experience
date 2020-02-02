@extends('layout.adminlayout')
@section('title','Report | Milestone Report')
@section('body')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/report_validation.js') !!}
{!! Html::script('/js/mileStoneReport.js') !!}
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

                            if (isset($project_phase_id) && !empty($project_phase_id)) {
                              $phase_ID = $project_phase_id;
                            } else {
                              $phase_ID = "-";
                            }

                            if (isset($project_task_id) && !empty($project_task_id)) {
                              $task_ID = $project_task_id;
                            } else {
                              $task_ID = "-";
                            }

                            if (isset($project_milestone_Id) && !empty($project_milestone_Id)) {
                              $milestone_Id = $project_milestone_Id;
                            } else {
                              $milestone_Id = "-";
                            }
                            ?>	
                            <a class="dropdown-item" href="{{url('admin/milestoneht/'.$Project_form.'/'.$Project_to.'/'.$phase_ID.'/'.$task_ID.'/'.$milestone_Id)}}">Html</a>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">					
                    <div class="col-xl-7">
                        <h3>Project Report: Milestone Report</h3>
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
                          <strong> Info !</strong> You can not export the<strong> Report <?php echo $type ?> </strong> because record is empty <strong></strong>
                      </div>					
                    <?php } ?>
                </div>	</br>	
            </div>
            <div class="col-lg-12">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-xl-6">	
                            {{Form::open(array('method' =>'GET','class'=>'reportClass', 'id' => 'mileStoneReport'))}}
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
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Id : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">
                                                            {!!Form::select('reportProject_from',$projectlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select project','id' => 'reportProject_from'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6">											
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">To Project Id : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">		
                                                            {!!Form::select('reportProject_to',$projectlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select project','id' => 'reportProject_to'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="form-group row">										
                                            <div class="col-xs-6 col-sm-6">
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Phase Id : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">
                                                            {!!Form::select('project_phase_id',$projectPhaseList,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select phase'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6">											
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Task Id : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">		
                                                            {!!Form::select('project_task_id',$projectTaskList,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select task'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="form-group row">										
                                            <div class="col-xs-6 col-sm-6">
                                                <div class="row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Milestone ID : </label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                                        <div class="form-input-icon">
                                                            {!!Form::select('project_milestone_Id',$projectMilestoneList,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select milestone'))!!}
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
                                        <a href="{{url('admin/milestonereport')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                                            <th>Phase ID</th>
                                            <th>Task ID</th>
                                            <th>Milestone ID</th>
                                            <th>Milestone Name</th>
                                            <th>Scheduled Date</th>
                                            <th>Actual Date</th>								
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
if (isset($report)) {
  foreach ($report as $val) {
//    $thred[] = $val->milestone_Id;
//    $second[] = $val->project_id;
//    $first[] = $val->project_milestone_Id;
  }
  if (isset($thred)) {
    $thred = implode(',', $thred);
  } else {
    $thred = "";
  }
  if (isset($second)) {
    $second = implode(',', $second);
  } else {
    $second = "";
  }
  if (isset($first)) {
    $first = implode(',', $first);
  } else {
    $first = "";
  }
  ?>
  <script type="text/javascript">
    $('#reportProject_from').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#reportProject_to').select2({
    }).on('change', function () {
        $(this).valid();
    });
    var overlappingData = {
        labels: [<?php echo $thred ?>],
        series: [
            [<?php echo $thred ?>],
            [<?php echo $second ?>],
            [<?php echo $first ?>]
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
  <?php
}
?>
@section('PageJquery')
    {!! Html::script('vendors/jqueryDataTable/jquery.dataTables.min.js') !!}
@endsection 
@endsection