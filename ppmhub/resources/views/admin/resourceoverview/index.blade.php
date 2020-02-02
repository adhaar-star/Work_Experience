@extends('layout.adminlayout')
@section('title','Project | Project Resource Planning | Resource Overview')
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
                            <span>Resource Overview Dashboard</span>
                        </li>
                    </ul>
                </div>

                <div class="card card-info-custom">
                    <div class="card-header">
                        <h4 class="margin-bottom-0">Resource Overview</h4>
                        <div id="message" class="col-lg-12  col-lg-offset-2 col-md-12 col-md-offset-2 col-xs-12"></div> 
                    </div>
                    <div class="card-block">
                        <div class="ppm-tabpane tab-view"> 

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-radio-btm">
                                        <div class="col-xs-12">
                                            <div class="row">

                                                @if($id=='resource')
                                                <div class="col-xs-12 col-sm-6">
                                                    <label style="color: #000">
                                                        <input type="radio" name="overviewRadio" value="project" > Select Project Id
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <label  style="color: #000">  
                                                        <input type="radio" name="overviewRadio" value="resource" checked="checked">Select Resource Name
                                                    </label>
                                                </div>
                                                @else
                                                <div class="col-xs-12 col-sm-6">
                                                    <label style="color: #000">
                                                        <input type="radio" name="overviewRadio" value="project" checked="checked"> Select Project Id
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <label  style="color: #000">  
                                                        <input type="radio" name="overviewRadio" value="resource" >Select Resource Name
                                                    </label>
                                                </div>

                                                @endif
                                                <div class="form-input-icon col-xs-12 col-sm-6" >
                                                    @if($id!='resource') 
                                                    {!!Form::select('project',$project_id,'',array('class'=>'form-control select2 ','placeholder'=>'Please select project id','id'=>'ProjectGet'))!!}  

                                                    @else

                                                    {!!Form::select('resource',$resource_id,'',array('class'=>'form-control select2 ','placeholder'=>'Please select Resource','id'=>'ProjectGet'))!!}  

                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>						
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="margin-bottom-50">
                                        <table class="table table-inverse" id="chartTable" width="100%">
                                            <thead>
                                                <tr>
                                                    @if($id=='resource')
                                                    <th>Resource Name</th>
                                                    <th>Phase ID</th>
                                                    <th>Task ID</th>
                                                    <th>Role Name</th>
                                                    <th>Project Id</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Total Demand</th>
                                                    <th>Assigned Work</th>
                                                    <th>Remaining Work</th>

                                                    @else
                                                    <th>Project Id</th>
                                                    <th>Phase ID</th>
                                                    <th>Task ID</th>
                                                    <th>Role Name</th>
                                                    <th>Resource Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Total Demand</th>
                                                    <th>Assigned Work</th>
                                                    <th>Remaining Work</th>
                                                    @endif

                                                </tr>
                                            </thead> 

                                            <tfoot>
                                                @if($id=='resource')
                                            <th>Resource Name</th>
                                            <th>Phase ID</th>
                                            <th>Task ID</th>
                                            <th>Role Name</th>
                                            <th>Project Id</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Demand</th>
                                            <th>Assigned Work</th>
                                            <th>Remaining Work</th>

                                            @else
                                            <th>Project Id</th>
                                            <th>Phase ID</th>
                                            <th>Task ID</th>
                                            <th>Role Name</th>
                                            <th>Resource Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Demand</th>
                                            <th>Assigned Work</th>
                                            <th>Remaining Work</th>
                                            @endif

                                            </tfoot>

                                            <tbody>
                                                @foreach($project_data as $data)
                                                <tr>

                                                    @if($id=='resource')
                                                    <td>{{$data->resource_name}}</td>
                                                    @else
                                                    <td>{{$data->project_Id}}</td>
                                                    @endif

                                                    <td>{{$data->phase_id}}</td>
                                                    <td>{{$data->task_Id}}</td>
                                                    <td>{{$data->role_name}}</td>

                                                    @if($id=='resource')
                                                    <td>{{$data->project_Id}}</td>
                                                    @else
                                                    <td>{{$data->resource_name}}</td>
                                                    @endif

                                                    <td>{{$data->start_date}}</td>
                                                    <td>{{$data->end_date}}</td>
                                                    <td>{{$data->total_demand}}</td>
                                                    <td>{{$data->assigned}}</td>
                                                    <td>{{$data->remaining}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>     
                            <div class="row" >
                                <div class="container-fluid">
                                    <div class="col-md-12 resource-table">
                                        <div id="table_div1"></div>
                                    </div>    

                                </div>
                            </div>  
                            <div class="row" >
                                <div class="container-fluid">
                                    <div class="col-md-6 resource-table">
                                        <div id="column_div"></div>
                                    </div>    
                                    <div class="col-md-6 resource-table">
                                        <div id="pie_div"></div>
                                    </div>    
                                </div>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
        google.charts.load('current', {'packages': ['table', 'bar', 'corechart']});
        function rgbaToHex(r) {
        if (r % 1000 > 100)
        {
        r = r / 255;
        }
        if (r > 255)
        {
        r = 200;
        }

                r = parseInt((255 - r), 10);
                g = parseInt(150, 10);
                return ('#' + r.toString(16) + g.toString(16) + '00');
        }

var project_data = @php echo json_encode($project_data); @endphp;
        console.log(project_data);
        function getRandomColor() {
        var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
        }

</script>


<script type="text/javascript">

    function drawChart() {

    table_data = @php echo json_encode($arr); @endphp;
            array_data = [];
            for (var i in table_data)
            if ('project_id' in table_data[i])
            array_data.push([table_data[i].project_id, table_data[i].assign]);
            var data = new google.visualization.DataTable();
            //php code
            @if ($id == 'resource')
            data.addColumn('string', 'Resource_Name');
            @else
            data.addColumn('string', 'Project_id');
            @endif
            //end of php code


            data.addColumn('string', 'Hours');
            data.addRows(array_data);
            var options = {
            title: '@php echo $id =='resource' ? 'Resource Assignment Overview':'Project Assignment Overview'; @endphp',
                    bars: 'vertical',
                    vAxis: {format: 'decimal'},
                    height: 400,
                    width: 500,
                    colors: ['#1b9e77', '#d95f02', '#7570b3']
            }; //        var chart = new google.charts.Bar(document.getElementById('chart_div'));
            //        chart.draw(data, google.charts.Bar.convertOptions(options));
            var table1 = new google.visualization.Table(document.getElementById('table_div1'));
            table1.draw(data, {chart: {
            title: 'Project Resource Overview'
            },
                    showRowNumber: true, width: '50%', height: '80%'});
            var data1 = new google.visualization.DataTable();
            data1.addColumn('string', 'Project');
            data1.addColumn('number', 'Assigned');
            data1.addColumn({type: 'string', role: 'style'});
            array_data1 = [];
            for (var i in table_data)
            if ('project_id' in table_data[i])
            array_data1.push([table_data[i].project_id, parseInt(table_data[i].assign), 'color:' + rgbaToHex(parseInt(table_data[i].assign)) + ';']);
            data1.addRows(array_data1);
            var options = {
            title: '@php echo ($id =='resource') ? 'Resource Assignment Overview':'Project Assignment Overview';  @endphp',
                    width: 600,
                    height: 400,
                    bar: {groupWidth: "55%"},
                    legend: {position: "right"}, is3D: true,
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("column_div"));
            chart.draw(data1, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('pie_div'));
            chart2.draw(data1, options);
    }


    $(document).ready(function () {
    var table = $('#chartTable').DataTable();
            google.charts.setOnLoadCallback(drawChart);
            $('input[type="radio"]').click(function () {
    window.location.href = window.location.origin + "/admin/resourceoverview/" + $(this).val();
    });
            $('#ProjectGet').change(function () {
    var inputValue = $(this).val();
            table.search(inputValue).draw();
    });
    });
</script>


@endsection