@extends('layout.admin')
@section('title', 'Company Management | Subscription History')
@section('body')
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

<section class="panel">
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1>Subscription History</h1>
                @if($subscriptionId)
                @if (RoleAuthHelper::hasAccess('subscriptions.cancel')!=true)  
                <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
                    @else
                    <a type="button" class="btn btn-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#CancelModal">@endif<i class="fa fa-times"></i> Cancel subscription</a>
                    @if (RoleAuthHelper::hasAccess('subscriptions.updatesubscription')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a class="btn btn-success btn-sm" href="{{route('subscriptions.updatesubscription')}}">@endif<i class="fa fa-paper-plane"></i> Update subscription</a>
                        @endif
                        </div>
                        <div class="col-md-6 text-right">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Company Management</a>
                                </li>
                                <li><span>Subscription History</span></li>
                            </ul>
                        </div>
                        </div>
                        <div class="margin-bottom-50">
                            <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Company Name</th>
                                        <th>Subscription Plan</th>
                                        <th>Subscription Price</th>
                                        <th>Subscribed Date</th>
                                        <th>Next Billing Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        </div>
                        <!--- Bootstrap Model --->
                        <div id="CancelModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-sm-6"><h6>Cancel subscription</h6></div>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    {!! Form::open(array('route' => array('subscriptions.cancel',$subscriptionId?$subscriptionId:'1'), 'method' => 'DELETE','id'=>'cancelform')) !!}
                                    <div class="modal-body">
                                        <p>Do you want to cancel your subscription?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger delete">Yes</button>
                                    </div>
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                        <!-- Bootstrap Model -->
                        </section>
                        @endsection
                        @section('PageJquery')
                        {!! Html::script('vendors/jqueryDataTable/jquery.dataTables.min.js') !!}
                        <script type="text/javascript">
                          $(document).ready(function () {
                              var table = $("#DateTablePPMHUB").DataTable({
                                  processing: true,
                                  serverSide: true,
                                  ajax: '{!! route('subscriptions.list',auth::user()->company_id) !!}',
                                  createdRow: function (row, data, dataIndex) {
                                      $(row).find('td:eq(4)').attr('class', 'action-btn');
                                  },
                                  columns: [
                                      {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                                      {data: 'company_name', name: 'company_name'},
                                      {data: 'plan_name', name: 'plan_name'},
                                      {data: 'braintree_subscription_price', name: 'braintree_subscription_price'},
                                      {data: 'subscribed_on', name: 'subscribed_on'},
                                      {data: 'next_billing_date', name: 'next_billing_date'},
                                  ]
                              });
                              table.draw();
                          });
                          //        orderable: false, searchable: false
                        </script>
                        @endsection