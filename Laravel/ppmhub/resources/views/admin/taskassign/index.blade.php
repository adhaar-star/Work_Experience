@extends('layout.adminlayout')
@section('title','Project | Project Resource Planning | Create Role')
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
                            <span> Assign Task To Role Dashboard </span>
                        </li>
                    </ul>
                </div>                
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('taskassign.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/taskassign/create')}}" class="btn btn-primary">                       
                            @endif
                            Assign Task To Role
                        </a>                   
                </div>
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Project Id</th>
                                    <th>Project Description</th>
                                    <th>Task Name</th>
                                    <th>Role Name</th>
                                    <th>Role Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 

                            <tfoot>
                                <tr>
                                    <th>Project Id</th>
                                    <th>Project Description</th>
                                    <th>Task Name</th>
                                    <th>Role Name</th>
                                    <th>Role Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($taskassignement as $assignement)
                                <tr>
                                    <td>{{$project_names[$loop->index]}}</td>
                                    <td>{{$assignement->project_description}}</td>
                                    <td>{{$task_names[$loop->index]}}</td>                                 
                                    <td>{{$role_names[$loop->index]}}</td>
                                    <td>{{$assignement->role_description}}</td>
                                    <td>{{$assignement->start_date}}</td>                                  
                                    <td>{{$assignement->end_date}}</td>
                                    <td class="action-btn">
                                        @if (RoleAuthHelper::hasAccess('taskassign.view')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$assignement->id }}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                            @if (RoleAuthHelper::hasAccess('taskassign.update')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="{{url('admin/taskassign/'.$assignement->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i>  </a>

                                                {!! Form::open(array('route' => array('taskassign.delete',$assignement->id), 'method' => 'DELETE','id'=>'delform'.$assignement->id)) !!}
                                                @if (RoleAuthHelper::hasAccess('taskassign.delete')!=true)  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    @else
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this task assignment?');
                                                     if (res) {
                                                            document.getElementById('delform{{$assignement->id}}').submit()
                                                               }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                    {!! Form::close() !!}
                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$assignement->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                        <div class="modal-dialog" role="document" style="text-align:left;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <div class="margin-bottom-10">
                                                                        <ul class="list-unstyled breadcrumb">
                                                                            <li>
                                                                                <a href="{{url('admin/dashboard')}}">Project Managemnt</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{url('admin/projectresourceplanning')}}">Project Resource Planning</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{url('admin/taskassign/')}}"> Task Assignment </a>
                                                                            </li>
                                                                            <li>
                                                                                <span>{{$assignement->id}}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <form class="static-form">

                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-12">
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">Project Name</p>
                                                                                </div>
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">{{$project_names[$loop->index]}}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-12">
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">Task Name</p>
                                                                                </div>
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">{{$task_names[$loop->index]}}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-12">
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">Role Name</p>
                                                                                </div>
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">{{$role_names[$loop->index]}}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-12">
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">Role Description</p>
                                                                                </div>
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">{{$assignement->role_description }}</p>                                                                    </div>
                                                                            </div>   
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-12">
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">Start Date</p>
                                                                                </div>
                                                                                <div class="col-sm-5">
                                                                                    <?php
                                                                                    $strtdate = strtotime($assignement->start_date);
                                                                                    $start_date = date('d/M/Y', $strtdate);
                                                                                    ?>
                                                                                    <p class="form-control-static">{{$start_date }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-12">
                                                                                <div class="col-sm-5">
                                                                                    <p class="form-control-static">End Date</p>
                                                                                </div>
                                                                                <div class="col-sm-5">
                                                                                    <?php
                                                                                    $enddate = strtotime($assignement->end_date);
                                                                                    $end_date = date('d/M/Y', $enddate);
                                                                                    ?>
                                                                                    <p class="form-control-static">{{$end_date }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>

                                                                </form>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class="edit-btn"> <a href="{{url('admin/taskassign/'.$assignement->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    </div>
                                                    </td>

                                                    </tr>
                                                    @endforeach

                                                    </tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="container container-fluid chart">
                                                        <div class="row" >
                                                            <div class="container-fluid">
                                                                <div class="col-md-12 resource-table">
                                                                    <div id="table_div1"></div>
                                                                </div>    

                                                            </div>
                                                        </div>  
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div id="chart_div"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div id="columnchart_stacked"></div>
                                                            </div>
                                                        </div>
                                                    </div>      
                                                    </section>
                                                    <script type="text/javascript">
                                                                      var result = @php echo json_encode($result); @endphp;
                                                                      google.charts.load('current', {'packages':['table', 'bar', 'corechart']});
                                                                      google.charts.setOnLoadCallback(drawChart);
                                                                      function drawChart() {
                                                                      array_data = []
                                                                              for (var i in result[2].arr)
                                                                              if ('project_id' in result[2].arr[i])
                                                                              array_data.push([result[2].arr[i].project_id, parseInt(result[2].arr[i].assign), parseInt(result[2].arr[i].pending)]);
                                                                              var data = new google.visualization.DataTable();
                                                                              data.addColumn('string', 'Project_id');
                                                                              data.addColumn('number', 'Assigned');
                                                                              data.addColumn('number', 'Pending');
                                                                              data.addRows(array_data);
                                                                              var options = {
                                                                              chart: {
                                                                              title: 'Task Assignment'
                                                                              },
                                                                                      bars: 'vertical',
                                                                                      vAxis: {format: 'decimal'},
                                                                                      height: 400,
                                                                                      width:  500,
                                                                                      colors: ['#1b9e77', '#d95f02', '#7570b3']
                                                                              };
                                                                              var chart = new google.charts.Bar(document.getElementById('chart_div'));
                                                                              chart.draw(data, google.charts.Bar.convertOptions(options));
                                                                              var table1 = new google.visualization.Table(document.getElementById('table_div1'));
                                                                              table1.draw(data, {showRowNumber: true, width: '60%', height: '80%'});
                                                                              //projects are colors 
                                                                              //row id is assigned or pending, project 
                                                                              //data is assigned or pending

                                                                              column = ['Project'];
                                                                              for (i in array_data)
                                                                              column.push(array_data[i][0])

                                                                              pending = ['Remaning'];
                                                                              for (i in array_data)
                                                                              pending.push(array_data[i][2])

                                                                              assigned = ['Assigned'];
                                                                              for (i in array_data)
                                                                              assigned.push(array_data[i][1])
                                                                              var data2 = google.visualization.arrayToDataTable([
                                                                                      column,
                                                                                      assigned,
                                                                                      pending
                                                                              ]);
                                                                              var options2 = {chart: {
                                                                              title: 'Projects Vs Assigned vs Remaining ',
                                                                                      subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                                                                              },
                                                                                      width: 400,
                                                                                      height: 400,
                                                                                      legend: { position: 'bottom', maxLines: 100 },
                                                                                      bar: {groupWidth: '45%'},
                                                                                      isStacked: true,
                                                                              };
                                                                              var chart2 = new google.visualization.ColumnChart(document.getElementById('columnchart_stacked'));
                                                                              chart2.draw(data2, options2);
                                                                      }
                                                    </script>
                                                    @endsection