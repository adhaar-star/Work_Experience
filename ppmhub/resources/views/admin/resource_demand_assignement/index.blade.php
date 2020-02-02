@extends('layout.adminlayout')
@section('title','Project | Project Resource Planning | Resource Demand Vs Resource Assignment')
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
                            <span>Resource Comparison Dashboard</span>
                        </li>
                    </ul>
                </div>
                <div class="msg alert alert-danger" style="display:none;">

                </div>
                <div class="card card-info-custom">

                    <div class="card-header">
                        <h4 class="margin-bottom-0">Resource Demand Vs Resource Assigned</h4>
                        <div id="message" class="col-lg-12  col-lg-offset-2 col-md-12 col-md-offset-2 col-xs-12"></div> 
                    </div>
                    <div class="card-block">

                        <div class="row">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for='l33'>Select Project*:</label>
                                <div class="col-sm-3 ">
                                    <div class="form-input-icon" >
                                        {!!Form::select('project_id',$project_ids,isset($project_name) ? $project_name : '',array('class'=>'form-control select2 ','placeholder'=>'Please select resource ','id'=>'Project_id'))!!}  
                                        @if($errors->has('project_id')) 
                                        <div style='color:red'>
                                            {{ $errors->first('project_id') }}
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
        var table_total_demand = @php echo json_encode($result1); @endphp;
        google.charts.load('current', {'packages': ['bar', 'table']});
(function () {
    console.log(table_data);
    google.charts.setOnLoadCallback(drawChart);
   
})()


function drawChart() {
    console.log(table_data);
    alt_table = {};
    alt_table2 = {};

    var chartdata = new google.visualization.DataTable();
    chartdata.addColumn('string', 'Period');
    chartdata.addColumn('number', 'Assigned Hour(s)');
    chartdata.addColumn('number', 'Total Demand Hour(s)');

    columndata = [];
    for (k in table_total_demand)
    {
        if (k !== 'id')
        {
            console.log(k.split('-')[1] + '-' + k.split('-')[0]);
            console.log(table_total_demand[k]);
            if (moment(k.split('-')[1] + '-' + k.split('-')[0], 'MM-YYYY').format('MMM-YYYY') in alt_table2)
                alt_table2[moment(k.split('-')[1] + '-' + k.split('-')[0], 'MM-YYYY').format('MMM-YYYY')] += table_total_demand[k];
            else
                alt_table2[moment(k.split('-')[1] + '-' + k.split('-')[0], 'MM-YYYY').format('MMM-YYYY')] = table_total_demand[k];

        }

    }

    for (k in table_data)
    {
        if (k !== 'id')
        {
            console.log(k.split('-')[1] + '-' + k.split('-')[0]);
            console.log(table_data[k]);
            if (moment(k.split('-')[1] + '-' + k.split('-')[0], 'MM-YYYY').format('MMM-YYYY') in alt_table)
                alt_table[moment(k.split('-')[1] + '-' + k.split('-')[0], 'MM-YYYY').format('MMM-YYYY')] += table_data[k]
            else
                alt_table[moment(k.split('-')[1] + '-' + k.split('-')[0], 'MM-YYYY').format('MMM-YYYY')] = table_data[k]

        }

    }

    for (k in alt_table2)
    {
        if ((k in alt_table) && (k in alt_table2))
        {
            columndata.push([k, alt_table[k], alt_table2[k]]);
        }
        else if (!(k in alt_table) && (k in alt_table2))
        {
            columndata.push([k, 0, alt_table2[k]]);
        }
    }
    for (k in alt_table)
    {
        if (!(k in alt_table2) && (k in alt_table))
        {
            columndata.push([k, alt_table[k], 0]);
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



    options = {
        chart: {
            title: 'Resource Loading',
            subtitle: 'Resource planning',
        },
        bars: 'horizontal' // Required for Material Bar Charts.
    };
    chart = new google.charts.Bar(document.getElementById('barchart_material'));
    chart.draw(chartdata, google.charts.Bar.convertOptions(options));



    
    var table = new google.visualization.Table(document.getElementById('table_div'));
    table.draw(chartdata, {showRowNumber: true});

}



(function () {
    setTimeout(function () {
        $('#Project_id').on('change', function (evt) {
            data = {};
            data[$('[name=project_id]').attr('name')] = $('[name=project_id]').val();

            $.ajax({
                method: "GET",
                url: "{{url('admin/resourcedemandvsasssigned/0')}}",
                data: data
            }).done(function (response) {
                if (response.status == 'ok')
                {
                    console.log(response);
                    table_data = response.data;
                    table_total_demand = response.data1;
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