@extends('layout.adminlayout')
@section('title','Project | Project Resource Loading | Resource Loading')
@section('body')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
                            <span class="hidden-lg-down">Project Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/project')}}">Project</a>
                            <a class="dropdown-item" href="{{url('admin/projectphase')}}">Phase</a>
                            <a class="dropdown-item" href="{{url('admin/projecttask')}}">Task/Subtask</a>
                            <a class="dropdown-item" href="{{url('admin/projectchecklist')}}">Checklist</a>
                            <a class="dropdown-item" href="{{url('admin/projectmilestone')}}">Milestone</a>
                            <a class="dropdown-item" href="{{url('admin/projectcostplan')}}">Project Cost Plan</a>
                            <a class="dropdown-item" href="{{url('admin/projectresourceplan')}}">Project Resource Plan</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a>
                        </ul>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                        </li>
                        <li>
                            <a href="{{url('admin/projectresourceplanning')}}">Project Resource Planning</a>
                        </li>
                        <li>
                            <span>Resource Loading Dashboard</span>
                        </li>
                    </ul>
                </div>
                <div class="msg alert alert-danger" style="display:none;">

                </div>
                <div class="card card-info-custom">

                    <div class="card-header">
                        <h4 class="margin-bottom-0">Resource Loading</h4>
                        <div id="message" class="col-lg-12  col-lg-offset-2 col-md-12 col-md-offset-2 col-xs-12"></div> 
                    </div>
                    <div class="card-block">

                        <div class="row">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for='l33'>Select Project Id*:</label>
                                <div class="col-sm-3 ">
                                    <div class="form-input-icon" >
                                        {!!Form::select('project_id',$project_ids,isset($taskassignment->project_id) ? $taskassignment->project_id : '',array('class'=>'form-control select2 ','placeholder'=>'Please select project id','id'=>'ProjectFrom'))!!}  
                                        @if($errors->has('project_id')) 
                                        <div style='color:red'>
                                            {{ $errors->first('project_id') }}
                                        </div> 
                                        @endif
                                    </div>
                                </div>

                                <label class="col-sm-1 col-form-label" for='l33'>To</label>

                                <label class="col-sm-2 col-form-label" for='l33'>Select Project Id*:</label>
                                <div class="col-sm-3 ">
                                    <div class="form-input-icon" >
                                        {!!Form::select('project_id',$project_ids,isset($taskassignment->project_id) ? $taskassignment->project_id : '',array('class'=>'form-control select2 ','placeholder'=>'Please select project id','id'=>'ProjectTo'))!!}  
                                        @if($errors->has('project_id')) 
                                        <div style='color:red'>
                                            {{ $errors->first('project_id') }}
                                        </div> 
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div> 
                        <div class="row">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for='l33'>Select From Date*:</label>
                                <div class="col-sm-3 ">
                                    <div class="form-input-icon" >
                                        {!!Form::text('from_date',isset($from_date)?$from_date:'',array('class'=>'form-control datepicker-only-init','placeholder'=>'Please select start date'))!!}  
                                        @if($errors->has('from_date')) 
                                        <div style='color:red'>
                                            {{ $errors->first('from_date') }}
                                        </div> 
                                        @endif
                                    </div>
                                </div>

                                <label class="col-sm-1 col-form-label" for='l33'>To</label>

                                <label class="col-sm-2 col-form-label" for='l33'>Select To Date*:</label>
                                <div class="col-sm-3 ">
                                    <div class="form-input-icon" >
                                        {!!Form::text('to_date',isset($to_date)?$to_date:'',array('class'=>'form-control datepicker-only-init','placeholder'=>'Please select end date'))!!}  
                                        @if($errors->has('to_date')) 
                                        <div style='color:red'>
                                            {{ $errors->first('to_date') }}
                                        </div> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div id="barchart_material" style="width: 700px; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
var table_data = @php echo json_encode($data); @endphp;
        google.charts.load('current', {'packages': ['bar']});

(function () {

    google.charts.setOnLoadCallback(drawChart);

})()



function drawChart() {

    array_data = [];
    for (var i in table_data)
        array_data.push([table_data[i].employee, parseInt(table_data[i].total_days), parseInt(table_data[i].assigned), parseInt(table_data[i].unassigned), parseInt(table_data[i].role_assigned)]);
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Resource');
    data.addColumn('number', 'Total Days');
    data.addColumn('number', 'Task Assigned');
    data.addColumn('number', 'Un-Assigned');
    data.addColumn('number', 'Role Assigned');
    data.addRows(array_data);

    options = {
        chart: {
            title: 'Resource Loading',
            subtitle: 'Resource planning',
        },
        bars: 'horizontal' // Required for Material Bar Charts.
    };
    chart = new google.charts.Bar(document.getElementById('barchart_material'));
    chart.draw(data, google.charts.Bar.convertOptions(options));



}



(function () {
    setTimeout(function () {
        $('#ProjectTo,#ProjectFrom').on('change', function (evt) {
            data = {};
            data[$('[name=from_date]').attr('name')] = $('[name=from_date]').val();

            data[$('[name=to_date]').attr('name')] = $('[name=to_date]').val();

            data[$('#ProjectTo').attr('id')] = $('#ProjectTo').val();

            data[$('#ProjectFrom').attr('id')] = $('#ProjectFrom').val();


            $.ajax({
                method: "GET",
                url: "{{url('admin/resourceloading/0')}}",
                data: data
            }).done(function (response) {
                if (response.status == 'ok')
                {
                    table_data = response.data;
                    drawChart();
                }
                else
                {
                    $('.msg').html('<em>' + response.msg + '</em>');
                    $('.msg').fadeIn(1000);
                    $('.msg').fadeOut(1500);
                }
            });
        });

        $('[name=from_date],[name=to_date]').on('dp.change', function (evt) {
            data = {};
            data[$('[name=from_date]').attr('name')] = $('[name=from_date]').val();

            data[$('[name=to_date]').attr('name')] = $('[name=to_date]').val();

            data[$('#ProjectTo').attr('id')] = $('#ProjectTo').val();

            data[$('#ProjectFrom').attr('id')] = $('#ProjectFrom').val();


            $.ajax({
                method: "GET",
                url: "{{url('admin/resourceloading/0')}}",
                data: data
            }).done(function (response) {
                if (response.status == 'ok')
                {
                    table_data = response.data;
                    drawChart();
                }
                else
                {
                    $('.msg').html('<em>' + response.msg + '</em>');
                    $('.msg').fadeIn(1000);
                    $('.msg').fadeOut(1500);
                }


            });
        });

    }, 1000);

})();
</script>



@endsection