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
                            <span>Resource Availability Dashboard</span>
                        </li>
                    </ul>
                </div>
                <div class="msg alert alert-danger" style="display:none;">

                </div>
                <div class="card card-info-custom">

                    <div class="card-header">
                        <h4 class="margin-bottom-0">Resource Availability</h4>
                        <div id="message" class="col-lg-12  col-lg-offset-2 col-md-12 col-md-offset-2 col-xs-12"></div> 
                    </div>
                    <div class="card-block">

                        <div class="row">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for='l33'>Select Resource*:</label>
                                <div class="col-sm-3 ">
                                    <div class="form-input-icon" >
                                        {!!Form::select('resource_id',$resource_ids,isset($resource_name) ? $resource_name : '',array('class'=>'form-control select2 ','placeholder'=>'Please select resource ','id'=>'ResourceTo'))!!}  
                                        @if($errors->has('resource_id')) 
                                        <div style='color:red'>
                                            {{ $errors->first('resource_id') }}
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
                        <div id="table_div" style="width:100%; height: auto; margin: 0 auto; text-align: center;"></div>
                        <div id="barchart_material" style="width: 700px; height: 400px; margin: 0 auto;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">



var table_data = @php echo json_encode($result); @endphp;
        google.charts.load('current', {'packages': ['table', 'corechart']});

(function () {
    console.log(table_data);
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawTable);
})()


function drawTable() {
    var tabdata = new google.visualization.DataTable();

    data = [];
    tabdata.addColumn('string', 'Resource Name')
    data.push(table_data['employee']);
    for (k in table_data)
    {
        if (k !== 'resource_name' && k != 'employee')
        {
            data.push(table_data[k]);
            tabdata.addColumn('number', k)
            console.log(k, table_data[k]);
        }

    }
    tabdata.addRows([data]);

    var table = new google.visualization.Table(document.getElementById('table_div'));
    table.draw(tabdata, {showRowNumber: true});
}


function drawChart() {

    var chartdata = new google.visualization.DataTable();

    chartdata.addColumn('string', 'Resource Name')
    chartdata.addColumn('number', 'Hour(s)');
    chartdata.addColumn({type: 'string', role: 'style'});

    columndata = [];

    for (k in table_data)
    {
        if (k !== 'resource_name' && k != 'employee')
        {
            columndata.push([k, table_data[k], "color:" + rgbaToHex(table_data[k])]);
        }

    }
    console.log(columndata);
    chartdata.addRows(columndata);
    var view = new google.visualization.DataView(chartdata);
    view.setColumns([0, 1,
        {calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"},
        2]);

    var options = {
        title: table_data.employee,
        width: 600,
        height: 400,
        bar: {groupWidth: "75%"},
        legend: {position: "bottom "},
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("barchart_material"));
    chart.draw(view, options);
}

function rgbaToHex(r) {
    if (r >= 8)
    {
        r = 7;
    }
   
    g = parseInt(256-(r * 32), 10);
    r = parseInt(r * 32, 10);
    return ('#' + r.toString(16) + g.toString(16) + '00');
}

(function () {
    setTimeout(function () {
        $('#ResourceTo').on('change', function (evt) {
            data = {};
            data[$('[name=from_date]').attr('name')] = $('[name=from_date]').val();

            data[$('[name=to_date]').attr('name')] = $('[name=to_date]').val();

            data[$('#ResourceTo').attr('name')] = $('#ResourceTo').val();


            $.ajax({
                method: "GET",
                url: "{{url('admin/resourceavailability/0')}}",
                data: data
            }).done(function (response) {
                if (response.status == 'ok')
                {
                    console.log(response);
                    table_data = response.data;
                    drawTable();
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

            data[$('#ResourceTo').attr('name')] = $('#ResourceTo').val();



            $.ajax({
                method: "GET",
                url: "{{url('admin/resourceavailability/0')}}",
                data: data
            }).done(function (response) {
                if (response.status == 'ok')
                {

                    console.log(response);
                    table_data = response.data;
                    drawTable();
                    drawChart();
//                    table_data = response.data;
//                    drawChart();
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