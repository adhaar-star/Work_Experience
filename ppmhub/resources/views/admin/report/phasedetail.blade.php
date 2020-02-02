@extends('layout.adminlayout')
@section('title','Report | Phase Detail Report')
@section('body')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/PhaseDetailReport.js') !!}
{!! Html::script('/js/report_validation.js') !!}
@if(Session::has('flash_message'))
<div class="alert alert-danger">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach
    </ul>
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
                              $ProjectTo = $reportProject_to;
                            } else {
                              $ProjectTo = "-";
                            }

                            if (isset($reportProject_from) && !empty($reportProject_from)) {
                              $ProjectForm = $reportProject_from;
                            } else {
                              $ProjectForm = "-";
                            }

                            if (isset($phase_id) && !empty($phase_id)) {
                              $phaseId = $phase_id;
                            } else {
                              $phaseId = "-";
                            }

                            if (isset($portfolio_id) && !empty($portfolio_id)) {
                              $portfolioId = $portfolio_id;
                            } else {
                              $portfolioId = "-";
                            }

                            if (isset($bucket_id) && !empty($bucket_id)) {
                              $bucketId = $bucket_id;
                            } else {
                              $bucketId = "-";
                            }
                            ?>
                            <a class="dropdown-item" href="{{url('admin/phasedetailpdf/'.$ProjectTo.'/'.$ProjectForm.'/'.$phaseId.'/'.$portfolioId.'/'.$bucketId)}}">Pdf</a>
                            <a class="dropdown-item" href="{{url('admin/export_phasedetail_cs/'.$ProjectTo.'/'.$ProjectForm.'/'.$phaseId.'/'.$portfolioId.'/'.$bucketId)}}">Csv</a>
                            <a class="dropdown-item" href="{{url('admin/phasedetailht/'.$ProjectTo.'/'.$ProjectForm.'/'.$phaseId.'/'.$portfolioId.'/'.$bucketId)}}">Html</a>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">					
                    <div class="col-xl-7">
                        <h3>Project Report: Phase Detail Report<h3>
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
                                                        <div class="card-block"><br/>

                                                            <div class="row" style="padding:0 0 8px 0">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project ID : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                                        <div class="form-input-icon">	
                                                                            {!!Form::select('reportProject_from',$projectlist,'',array('class'=>'form-control select2 border-radius-0','id'=>'reportProject_from','placeholder'=>'Please select Project'))!!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6">											
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">To Project ID : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                                        <div class="form-input-icon">		
                                                                            {!!Form::select('reportProject_to',$projectlist,'',array('class'=>'form-control select2 border-radius-0','id'=>'reportProject_to','placeholder'=>'Please select Project'))!!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding:0 0 8px 0">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Phase ID : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                                        <div class="form-input-icon">	
                                                                            {!!Form::select('project_phase_id',$projectPhaseList,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Phase'))!!}
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
                                                            <a href="{{url('admin/phasedetail')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                                        </div>                     
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                {{ Form::close() }}
                                            </div>		
                                            <!--<div class="col-xl-6">
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
                                            </div>	-->							
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="margin-bottom-50">
                                                    <table class="table table-inverse table-responsive" id="DateTablePPMHUB" width="100%">
                                                        <thead>
                                                            <tr class="report_theam">
                                                                <th>Project ID</th>
                                                                <th>Project Description</th>
                                                                <th>Phase ID</th>
                                                                <th>Phase Name</th>
                                                                <th>Portfolio ID</th>
                                                                <th>Portfolio Name</th>
                                                                <th>Bucket ID</th>
                                                                <th>Bucket Name</th>
                                                                <th>Cost Center</th>
                                                                <th>Person Responsible</th>
                                                                <th>Department</th>
                                                                <th>Created On</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
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
                                if(isset($report)){
                                foreach ($report as $val) {
                                  $first[] = $val->phase_Id;
                                  $second[] = $val->project_Id;
                                }
                                }
                                if (isset($first)) {
                                  $first = implode(',', $first);
                                } else {
                                  $first = "";
                                }

                                if (isset($second)) {
                                  $second = implode(',', $second);
                                } else {
                                  $second = "";
                                }

                                if (isset($budget_available)) {
                                  $budget_available = implode(',', $budget_available);
                                } else {
                                  $budget_available = "";
                                }
                                ?>

                                <script type="text/javascript">
                                  $('#projectfrom').select2({
                                  }).on('change', function () {
                                      $(this).valid();
                                  });
                                  $('#projectto').select2({
                                  }).on('change', function () {
                                      $(this).valid();
                                  });
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
                                      labels: [<?php echo $first ?>],
                                      series: [
                                          [<?php echo $first ?>],
                                          [<?php echo $second ?>]

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