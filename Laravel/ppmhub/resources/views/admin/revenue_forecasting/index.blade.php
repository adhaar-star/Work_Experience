@extends('layout.adminlayout')
@section('title','Sales | Revenue Forecast')

@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
<div class="alert alert-success message" style="display: none">
    <span class="glyphicon glyphicon-ok"></span>
    <em id="msg"></em>
</div>
<section class="panel">
    <div class="panel-body">     
        <!--- Bootstrap Model --->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this original budget?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-default delete" data-dismiss="modal">OK</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap Model -->

        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Sales Order</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <!--<a class="dropdown-item" href="{{url('admin/revenueforcasting/create')}}">Create Revenue Forecast</a>-->
                            <a class="dropdown-item" href="{{url('admin/revenueforcasting/create')}}">Create Revenue Forecast</a>
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Sales Order</a>
                        </li>
                        <li>
                            <span>Revenue Forecast Dashboard</span>
                        </li>
                    </ul>
                </div>
                <!--<h4>Current Budget</h4>-->
                <h4>Revenue Forecast</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('revenueforcasting.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/revenueforcasting/create')}}" class="btn btn-primary margin-left-10 active">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Revenue Forecast
                        </a>
                </div>
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Project ID</th>
                                    <th>Forecast</th>
                                    <th>Actual Revenue</th>
                                    <th>Difference</th>
                                    <th>Changed By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- -->
                            @foreach($returnProject as $cost)
                            <tr>
                                <td>{{$cost->project_name}}</td>
                                <td>{{$cost->pid}}</td>
                                <td>{{$cost->forecast}}</td>
                                <td>{{$cost->actual}}</td>
                                <td>{{$cost->difference}}</td>
                                <td>{{$cost->changed_by}}</td>
                                <td class="action-btn">
                                    @if (RoleAuthHelper::hasAccess('revenueforcasting.view')!=true)  
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                        @else
                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$cost->id}}">@endif<i class="fa fa-eye" aria-hidden="true"></i></a>
                                        @if (RoleAuthHelper::hasAccess('revenueforcasting.update')!=true)  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            @else
                                            <a href="{{url('admin/revenueforcasting/'.$cost->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> </a>
                                            {!! Form::open(array('route' => array('revenueforcasting.delete',$cost->costId), 'method' => 'DELETE','id'=>'delform'.$cost->costId)) !!}
                                            @if (RoleAuthHelper::hasAccess('revenueforcasting.delete')!=true)  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                @else
                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this  ?');
                                                      if (res) {
                                              document.getElementById('delform{{$cost->costId}}').submit()
                                                        }" class="btn btn-danger btn-xs">@endif<i class="fa fa-trash-o"></i></a>
                                                {!! Form::close() !!}

                                                <!-- Display Single Record -->
                                                <div class="modal fade table-view-popup" id="table-view-popup_{{$cost->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document" style="text-align:left;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                                                <div class="margin-bottom-10">
                                                                    <ul class="list-unstyled breadcrumb">
                                                                        <li>
                                                                            <a href="javascript: void(0);">Project Management</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript: void(0);">Cost Forecasting Budget</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript: void(0);">Display</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <h4 class="modal-title" id="myModalLabel"></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="static-form">
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Project Name</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$cost->project_name}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Project ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$cost->pid}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Forecast</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">{{$cost->current}}</p>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class="edit-btn"><a href="{{url('admin/revenueforcasting/'.$cost->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- -->

                                                </td>
                                                </tr>
                                                @endforeach
                                                <!-- -->
                                                <tfoot>
                                                    <tr>
                                                        <th>Project Name</th>
                                                        <th>Project ID</th>
                                                        <th>Forecast</th>
                                                        <th>Actual Revenue</th>
                                                        <th>Difference</th>
                                                        <th>Changed By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>

                                                </tbody>
                                                </table>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </section>

                                                <script>
                                                          var id = "";
                                                          $(document).on("click", ".deleteOriginal", function () {
                                                  $('#myModal').modal('show');
                                                          id = $(this).attr('data-id');
                                                  });
                                                          $(document).on("click", ".delete", function () {
                                                  var token = '{{ csrf_token() }}';
                                                          $.ajax({
                                                          type: 'POST',
                                                                  url: '/admin/projectbudget/original/delete/' + id,
                                                                  data: {
                                                                  '_token': token
                                                                  },
                                                                  dataType: "JSON",
                                                                  success: function (response) {
                                                                  location.reload();
                                                                          $('.message').show();
                                                                          $('#msg').html(response.status);
                                                                  }

                                                          });
                                                  });

                                                </script>
                                                @endsection