@extends('layout.adminlayout')
@section('title','Report |Projects in Portfolio Report')
@section('body')
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/report_validation.js') !!}
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
{!! Html::script('/js/PortfolioReport.js') !!}
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

                            if (isset($reportbucket_id) && !empty($reportbucket_id)) {
                                $bucket_id = $reportbucket_id;
                            } else {
                                $bucket_id = "-";
                            }

                            if (isset($reportportfolio_id) && !empty($reportportfolio_id)) {
                                $portfolio_id = $reportportfolio_id;
                            } else {
                                $portfolio_id = "-";
                            }
                            ?>						
                            <a class="dropdown-item" href="{{url('admin/projectportfolioht/'.$Project_to.'/'.$Project_form.'/'.$bucket_id.'/'.$portfolio_id)}}">Html</a>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50 box_h2">					
                    <div class="col-xl-7">
                        <h3>Portfolio Report: Projects in Portfolio<h3>
                                </div>	
                                <?php if (isset($request_p) && !empty($request_p)) { ?>					
                                    <div class="col-xl-4 report_info alert alert-danger">
                                        <?php
                                        if ($request_p == "*h-") {
                                            $type = "HTML";
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
                                                                            {!!Form::select('reportProject_from',$projectlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Project','id'=>'reportProject_from'))!!}
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
                                                            <div class="row" style="padding:0 0 8px 0">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Bucket ID : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                                        <div class="form-input-icon">	
                                                                            {!!Form::select('bucket_id',$bucketlist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Bucket'))!!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6">											
                                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Portfolio ID : </label>
                                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                                        <div class="form-input-icon">		
                                                                            {!!Form::select('portfolio_id',$portfoliolist,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Portfolio'))!!}
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
                                                            <a href="{{url('admin/projectportfolio')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                                                            Portfolio vs Project(s)
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
                                                                <th>Bucket Id</th>
                                                                <th>Bucket Name</th>
                                                                <th>Portfolio Id</th>
                                                                <th>Portfolio Name</th>
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
                                if(isset($graph)){
                                if (count($graph) > 0) {
                                    $graph = $graph->toArray();
                                    $array_keys_prj_count = array_keys($graph);
                                    $array_values_portfolio_name = array_values($graph);
                                }
                                }   
                                if (isset($array_keys_prj_count)) {
                                    $projects = implode(',', $array_keys_prj_count);
                                } else {
                                    $projects = "";
                                }

                                if (isset($array_values_portfolio_name)) {
                                    $portfolios = implode(',', $array_values_portfolio_name);
                                } else {
                                    $portfolios = "";
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
                                        labels: [<?php echo "'" . str_replace(',', "','", $portfolios) . "'" ?>],
                                        series: [
                                            [<?php echo "'" . str_replace(',', "','", $projects) . "'" ?>],
                                           
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
                                @endsection