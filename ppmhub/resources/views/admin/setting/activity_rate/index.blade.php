@extends('layout.admin')
@section('title', 'Activity Rates')
@section('body')
    @include('layout.admin_layout_include.alert_messages')
@section('PageCss')
    {!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
<section class="panel">
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1>Activity Rates</h1>
                <a class="btn btn-primary btn-sm" href="{{ route('activity-rates.create') }}"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li><span>Activity Rate</span></li>
                </ul>
            </div>
        </div>
        <div class="margin-bottom-50">
            <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Activity Rate</th>
                    <th>Billing Rate</th>
                    <th>Plan Rate</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
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
                ajax: '{!! route('activity-rates-data-table') !!}',
                columns: [
                    { data: 'activity_rate_description', name: 'activity_rate_description' },
                    { data: 'activity_actual_rate', name: 'activity_actual_rate' },
                    { data: 'billing_rate', name: 'billing_rate' },
                    { data: 'activity_plan_rate', name: 'activity_plan_rate' },
                    { data: 'action', name: 'action',  searchable: false },
                ]
            });
            table.draw();
        });
        //        orderable: false, searchable: false
    </script>
@endsection