@extends('layout.adminlayout')
@section('title','Budget | Original Budget')

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
                            <span class="hidden-lg-down">Budget Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/originalbudget')}}">Original Budget</a>
                            <a class="dropdown-item" href="{{url('admin/supplementbudget')}}">Supplement Budget</a>
                            <a class="dropdown-item" href="{{url('admin/returnbudget')}}">Return Budget</a>
                            <a class="dropdown-item" href="{{url('admin/currentbudget')}}">Current Budget</a>

                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/originalbudget')}}">Budget Management</a>
                        </li>
                        <li>
                            <span>Budget Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Budget Overview</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('budget.overview.dashboard')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/originalbudget')}}" class="btn btn-primary margin-left-10">
                            @endif<i class="fa fa-send margin-right-5"></i>
                            Original Budget
                        </a>
                        @if (RoleAuthHelper::hasAccess('budget.supplement.dashboard')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/supplementbudget')}}" class="btn btn-primary margin-left-10">
                                @endif<i class="fa fa-send margin-right-5"></i>
                                Supplement Budget
                            </a>
                            @if (RoleAuthHelper::hasAccess('budget.return.dashboard')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/returnbudget')}}" class="btn btn-primary margin-left-10">
                                    @endif<i class="fa fa-send margin-right-5"></i>
                                    Return Budget
                                </a>
                                @if (RoleAuthHelper::hasAccess('budget.current.dashboard')!=true)  
                                <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                    @else
                                    <a href="{{url('admin/currentbudget')}}" class="btn btn-primary margin-left-10">
                                        @endif<i class="fa fa-send margin-right-5"></i>
                                        Current Budget
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
                                                        <th>Original Budget</th>
                                                        <th>Supplement Budget</th>
                                                        <th>Return Budget</th>
                                                        <th>Current Budget</th>
                                                        <th>Changed By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @foreach($originalBudget as $budget)
                                                <tr>
                                                    <td>{{$budget->project_name}}</td>
                                                    <td>{{$budget->pid}}</td>
                                                    <td>{{round($budget->overall)}}</td>
                                                    <td>{{round($budget->supplement)}}</td>
                                                    <td>{{round($budget->return)}}</td>
                                                    <td>{{round($budget->current)}}</td>
                                                    <td>{{$budget->name}}</td>
                                                    <td class="action-btn">
                                                        @if (RoleAuthHelper::hasAccess('budget.view')!=true)  
                                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                            @else
                                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$budget->id}}">@endif<i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                                            @if (RoleAuthHelper::hasAccess('budget.update')!=true)  
                                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                @else
                                                                <a href="{{url('admin/projectbudget/original/edit/'.$budget->id)}}" class="btn btn-info btn-xs margin-right-1">@endif<i class="fa fa-pencil"></i> <!--Edit--> </a>
                                                                @if (RoleAuthHelper::hasAccess('budget.delete')!=true)  
                                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                                    @else
                                                                    <a href="javascript:void(0)" class="btn btn-danger btn-xs deleteOriginal" data-id="{{$budget->id}}">@endif<i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                                    <div class="modal fade table-view-popup" id="table-view-popup_{{$budget->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document" style="text-align:left;">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                                                                    <div class="margin-bottom-10">
                                                                                        <ul class="list-unstyled breadcrumb">
                                                                                            <li>
                                                                                                <a href="javascript: void(0);">Budget Management</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="javascript: void(0);">Original Budget</a>
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
                                                                                                <p class="form-control-static">{{$budget->project_name}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Period From</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$budget->period_from}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Period To</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$budget->period_to}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Overall</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{round($budget->overall)}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <?php $j = 1; ?>
                                                                                        @for($i = $budget->period_from; $i <= $budget->period_to; $i++)
                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$i}}</p>
                                                                                            </div>
                                                                                            @if($budget->{'year'.$j} != '')
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{round(($budget->{'year'.$j}))}}</p>
                                                                                            </div>
                                                                                            <input type="hidden" value="{{$j++}}">  
                                                                                            @else
                                                                                            @endif 
                                                                                        </div>
                                                                                        @endfor                         

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Current Budget</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{round($budget->current)}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Created By</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$budget->name}}</p>
                                                                                            </div>
                                                                                        </div>    

                                                                                        <div class="form-group popup-brd-btm">
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">Status</p>
                                                                                            </div>
                                                                                            <div class="col-sm-5">
                                                                                                <p class="form-control-static">{{$budget->status}}</p>
                                                                                            </div>
                                                                                        </div>

                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <span class="edit-btn"><a href="{{url('admin/projectbudget/original/edit/'.$budget->id)}}" class="btn btn-primary">Edit</a></span>
                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </td>                                                                        
                                                                    </tr>
                                                                    @endforeach
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>Project Name</th>
                                                                            <th>Project ID</th>
                                                                            <th>Original Budget</th>
                                                                            <th>Return Budget</th>
                                                                            <th>Current Budget</th>
                                                                            <th>Current Budget</th>
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