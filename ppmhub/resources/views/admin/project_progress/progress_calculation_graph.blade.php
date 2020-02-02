@extends('layout.adminlayout')
@section('title','Project Progress Calculation | Project Progress - S Curve')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

{!! Html::script('https://www.gstatic.com/charts/loader.js') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/project_working_days.js') !!}
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="margin-bottom-50">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <span>Project Progress</span>
                    </li>
                    <li>
                        <span>Project Progress S Curve</span>
                    </li>
                </ul>
            </div>
            <form name="progress_graph" id="progress_calculation" method="post" action="<?php
            echo url('admin/project_progress/scurves/');
            ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="margin-bottom-50">
                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header bg-lightcyan">
                            <h4 class="margin-0">
                                Project Progress S Curve
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Select Project:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('project_id',$projects,'',array('class'=>'form-control select2 ','placeholder'=>'Please select Project','id'=>'project_id'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('project_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Calculation Method:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('calculation_method',['0'=>'Physical Progress','1'=>'Cost Proportional'],'',array('class'=>'form-control select2 ','placeholder'=>'Select Actual Progress Calculation Method','id'=>'calculation_method'))!!}  
                                                @if($errors->has('calculation_method')) 
                                                <div class='text-danger'>
                                                    {{ $errors->first('calculation_method') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div id="curve_chart" style=" margin-left:15%;margin-bottom:2% ;"></div>

                </div>
        </div>
    </div>
    <div class="card-footer card-footer-box">
        <div class='error-message' style='display:none;'> </div>    

    </div>
</form>           
</div>
</div>
</section>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    (function () {
        $('#project_id').on('change', function (evt) {
            saveCalculation(evt);
        });

        $('#calculation_method').on('change', function (evt) {
            saveCalculation(evt);
        });

    })();

    function saveCalculation(evt) {

        var data = $('form').serialize();
        if (($('#project_id').val() !== null && $('#calculation_method').val() !== null) && ($('#project_id').val() !== '' && $('#calculation_method').val() !== '')) {
            $.ajax({
                type: "GET",
                url: "/admin/project_progress/scurves/0",
                data: data,
                success: function (response) {
                    console.log(response);
                    if (response.status == 'ok')
                    {
                        var _chartData = [];
                        _chartData.push(['Time(Weeks)', 'PLANNED VALUE (PV)', 'EARNED VALUE (EV)', 'ACTUAL COST (AC)']);

                        var _data = response.data;
                        for (row in _data)
                        {
                            _chartData.push([_data[row].time, parseFloat(_data[row].PV), parseFloat(_data[row].EV), parseFloat(_data[row].AC)])
                        }
                        if (_data.length > 0)
                        {
                            var currency = response.currency != null ? response.currency : 'N/A';
                            newDrawChart(_chartData, currency);

                        } else
                        {
                            drawChart();
                        }
                    }
                    else {
                        alert('Error occured while loading graph....');
                    }
                }
            });
        }
    }


    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Time (Weeks)', 'PLANNED VALUE (PV)', 'EARNED VALUE (EV)', 'ACTUAL COST (AC)'],
            ["0", 0, 0, 0],
        ]);


        var options = {
            title: 'Project S-Curves', //curveType: 'function',             legend: {position: 'top-right'},
            pointSize: 5,
            legend: {position: 'top'},
            series: {
                0: {pointShape: 'circle'},
                1: {pointShape: 'circle'},
                2: {pointShape: 'circle'},
            },
            width: 900,
            height: 400,
            vAxis: {
                title: 'Currency'
            },
            hAxis: {
                title: 'Weekly'
            }
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }

    function newDrawChart(chartData, currency) {
        var data = google.visualization.arrayToDataTable(chartData);


        var options = {
            title: 'Project S-Curves', //curveType: 'function',   
            legend: {position: 'top'},
            pointSize: 5,
            series: {
                0: {pointShape: 'circle'},
                1: {pointShape: 'circle'},
                2: {pointShape: 'circle'},
            },
            width: 900,
            height: 400,
            vAxis: {
                title: 'Currency' + ' ( ' + currency + ' )'
            },
            hAxis: {
                title: 'Weekly'
            }
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }

</script>

@endsection