@extends('layout.admin')
@section('title','Invoice Verification')

@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
@section('PageCss')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection


<section class="panel">
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-lg-12">
                <h1 style="padding-top: 10px;">Invoice Verification</h1>

                <div class="margin-bottom-50" style="float: right;">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            You are here :   <a href="javascript: void(0);">Procurement</a>
                        </li>
                        <li>
                            <span>Invoice Verification</span>
                        </li>
                    </ul>
                </div>

                <div class="dashboard-buttons" style="padding: 2px 0px;">
                    @if (RoleAuthHelper::hasAccess('invoice_verification.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/invoice_verification/create')}}" class="btn btn-primary" style="padding: 5px 16px;">
                            @endif
                            <i class="fa fa-plus margin-right-5"></i>
                            Create Invoice Verification
                        </a>
                </div>

                <table class="table table-inverse" id="DateTablePPMHUB">
                    <thead>
                        <tr>
                            <th>Material Document No</th>
                            <th>Purchase Order No</th>                                                                    
                            <th>Created On</th>                                    
                            <th>Created By</th>
                            <th>Active State</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="modal fade table-view-popup" id="table-pro-view-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="text-align:left;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!--view--> 
                                <div class="margin-bottom-10">
                                    <ul class="list-unstyled breadcrumb">
                                        <li>
                                            <a href="admin/dashboard">Procurement</a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);">Invoice Receipt</a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);">Receipt Number</a>
                                        </li>
                                        <li>
                                            <span id="invoice_no_st"></span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="modal-body">
                                <form class="static-form">
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Invoice Verification Number</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="inv_number"></p>
                                        </div>
                                    </div>
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Purchase Order Number</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="po_no"></p>
                                        </div>
                                    </div>


                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Document Date</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="doc_date"></p>
                                        </div>
                                    </div>
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Posting Date</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="post_date"></p>
                                        </div>
                                    </div>
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Created By</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="created_by"></p>
                                        </div>
                                    </div>

                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Created On</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="created_at"></p>
                                        </div>
                                    </div> 
                                    <div class="form-group popup-brd-btm">
                                        <div class="col-sm-5">
                                            <p class="form-control-static">Active State</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static" id="act_state">


                                            </p>
                                        </div>
                                    </div> 

                                </form>
                            </div>
                            <!--view-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
        {!! Form::open(array('route' => array('invoice_verification.reversal',0), 'method' => 'DELETE','id'=>'delform')) !!}

        {!! Form::close() !!}
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
                      url: 'invoiceverificaton-data-table?' + $(this).serialize(),
                  },
                  columns: [
                      {data: 'id', name: 'id'},
                      {data: 'po_order_number', name: 'po_order_number'},
                      {data: 'created_at', name: 'created_at'},
                      {data: 'created_by', name: 'created_by'},
                      {data: 'active_state', name: 'active_state', searchable: false, sortable: false},
                      {data: 'action', name: 'action', searchable: false, sortable: false},
                  ],
                  createdRow: function (row, data, dataIndex) {
                      $(row).find('td:eq(0)').attr('style', 'padding:10px 18px;');
                      $(row).find('td:eq(1)').attr('style', 'padding:10px 18px;');
                      $(row).find('td:eq(2)').attr('style', 'padding:10px 18px;');
                      $(row).find('td:eq(3)').attr('style', 'padding:10px 18px;');
                      $(row).find('td:eq(4)').attr('style', 'padding:10px 18px;');
                  },
              });
              table.draw();

              $('#DateTablePPMHUB').on('click', '#modal_popup', function () {
                  console.log(this);
                  var pId = $(this).attr('data-id');
                  var _token = $('input[name="_token"]').val();
                  $.ajax({
                      method: 'POST',
                      url: 'invoiceData/ajaxrequest',
                      data: {
                          'id': pId,
                          '_token': _token
                      },
                      success: function (response) {
                          $('#invoice_no_st').html(response.data.invoice_number);
                          $('#inv_number').html(response.data.invoice_number);
                          $('#po_no').html(response.data.po_order_number);
                          $('#doc_date').html(response.data.invoice_ddate);
                          $('#post_date').html(response.data.posting_pdate);
                          $('#created_by').html(response.data.created_by);
                          $('#created_at').html(response.data.created_on);
                          if (response.data.reversed == '' || response.data.reversed == null) {
                              $('#act_state').html('Active');
                          } else {
                              $('#act_state').html('Reversed');
                          }
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