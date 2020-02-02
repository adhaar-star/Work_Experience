@extends('layout.admin')
@section('title','Project | Cost Forecast')

@section('body')
@section('PageCss')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
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
                <div class="row PageTitleGlobal">
                    <div class="col-md-5">
                        <h1 style="padding-top:11px;">Cost Forecast</h1>
                        <div class="dashboard-buttons">
                            @if (RoleAuthHelper::hasAccess('costforcasting.create')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/costforcasting/create')}}" class="btn btn-primary btn-sm">
                                    @endif <i class="fa fa-plus"></i> Create Cost Forecast 
                                </a>
                        </div>
                    </div>
                    <div class="col-md-7 text-right">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Project Management</a>
                            </li>
                            <li>
                                <span>Cost Forecast Dashboard</span>
                            </li>
                        </ul>
                    </div>

                </div>

                <table class="table table-inverse" id="DateTablePPMHUB">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Project ID</th>
                            <th>Forecast</th>
                            <th>Actual cost</th>
                            <th>Difference</th>
                            <th>Changed By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="modal fade table-view-popup" id="table-pro-view-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="text-align:left;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                <div class="margin-bottom-10">
                                    <ul class="list-unstyled breadcrumb">
                                        <li>
                                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                                        </li>
                                        <li>
                                            <a href="{{url('admin/costforcasting')}}">Cost Forecast</a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);">Display Cost Forecast</a>
                                        </li>
                                        <li id="projectId"></li>
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
                                            <p class="form-control-static" id="prj_name">-</p>
                                        </div>
                                    </div>
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Project ID</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="prj_id">-</p>
                                        </div>
                                    </div>
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Forecast</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="forecastTotal">-</p>
                                        </div>
                                    </div>
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Actual Cost</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="actualCost">-</p>
                                        </div>
                                    </div>
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Difference</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="forecastdifference">-</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer text-center">
                                <span><a id ="cost_edit" class="btn btn-primary">Edit</a></span>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
{!! Html::script('vendors/jqueryDataTable/jquery.dataTables.min.js') !!}
<script type="text/javascript">
  $(document).ready(function () {
      var table = $("#DateTablePPMHUB").DataTable({
          processing: true,
          serverSide: true,
          bDestroy: true,
          ajax: {
              url: 'costforecast-data-table?' + $(this).serialize(),
          },
          columns: [
              {data: 'project_name', name: 'project_name'},
              {data: 'pid', name: 'pid'},
              {data: 'forecast', name: 'forecast'},
              {data: 'actual', name: 'actual'},
              {data: 'difference', name: 'difference'},
              {data: 'changed_by', name: 'changed_by', searchable: false},
              {data: 'action', name: 'action', searchable: false, sortable: false},
          ],
          createdRow: function (row, data, dataIndex) {
              $(row).find('td:eq(0)').attr('style', 'padding:10px 18px;');
              $(row).find('td:eq(1)').attr('style', 'padding:10px 18px;');
              $(row).find('td:eq(2)').attr('style', 'text-align:right');
              $(row).find('td:eq(3)').attr('style', 'text-align:right');
              $(row).find('td:eq(4)').attr('style', 'text-align:right');
              $(row).find('td:eq(5)').attr('style', 'padding:10px 18px;');
          },
      });
      table.draw();

      $('#DateTablePPMHUB').on('click', '#del_row', function () {
          var id = $(this).attr('data-id');
          var token = '{{ csrf_token() }}';

          var res = confirm('Are you sure you want to delete this Cost Forecast?');
          if (res) {

              urltype = "/admin/costforcasting/" + id;

              $.ajax({
                  type: "DELETE",
                  url: urltype,
                  data: {'_token': token},
                  success: function (result) {
                      if (result.status == 'msg')
                      {
                          $('.message').show(0).delay(1000).hide(1000);
                          $('#msg').html(result.data);
                      } else
                      {
                          $('.message1').show(0).delay(5000).hide(1000);
                          $('#msg1').html(result.data);
                      }
                      console.log('here result', result);
                      table.draw();
                  }
              });

          }

      });

      $('#DateTablePPMHUB').on('click', '#modal_popup', function () {
          console.log(this);
          var pId = $(this).attr('data-id');
          var token = '{{ csrf_token() }}';
          $.ajax({
              method: 'POST',
              url: 'costData/pop_upData',
              data: {
                  'id': pId,
                  '_token': token
              },
              success: function (response) {
                  $('#prj_name').html(response.data.project_name);
                  $('#projectId').html(response.data.project_Pid);
                  $('#prj_id').html(response.data.project_Pid);
                  $('#forecastTotal').html(response.data.forecast_total);
                  $('#actualTotal').html(response.data.actual_hours);
                  $('#difference').html(response.data.difference);
                  $('#actualCost').html(response.data.actual_hours);
                  $('#forecastdifference').html(response.data.difference);

                  $('#cost_edit').attr("href", "costforcasting/" + response.data.project_id + "/edit");
              },
              error: function (jqXHR, textStatus, errorThrown) { // What to do if we fail
                  console.log(JSON.stringify(jqXHR));
                  console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
              }
          });
      });
  });
</script>
@endsection
