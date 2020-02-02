@extends('layout.admin')
@section('title', 'Material Master')
@section('body')
    @include('layout.admin_layout_include.alert_messages')
@section('PageCss')
    {!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
<section class="panel">
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1>Material Groups</h1>
                <a class="btn btn-primary btn-sm" href="{{ route('material-group.create') }}"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Dashboard</a>
                    </li>
                    <li><span>Material Master</span></li>
                </ul>
            </div>
        </div>
        <div class="margin-bottom-50">
            <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                <thead>
                <tr>
                    <th>Name</th>
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
                ajax: '{!! route('material-group-data-table') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action',  searchable: false},
                ]
            });
            table.draw();
        });
        //        orderable: false, searchable: false
    </script>
@endsection