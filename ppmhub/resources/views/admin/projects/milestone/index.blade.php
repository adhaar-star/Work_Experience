@extends('layout.admin')
@section('title', 'Project Milestone')
@section('body')
    @include('layout.admin_layout_include.alert_messages')
@section('PageCss')
    {!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
<section class="panel">
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1>Project Milestone</h1>
                <a class="btn btn-primary btn-sm" href="{{ route('milestone.create') }}"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Dashboard</a>
                    </li>
                    <li><span>Project Milestone</span></li>
                </ul>
            </div>
        </div>
        <div class="margin-bottom-50">
            <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Milestone</th>
                        <th>Type</th>
                        <th>Start</th>
                        <th>End</th>
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
                ajax: '{!! route('milestone-data-table') !!}',
                columns: [
                    { data: 'project', name: 'project' },
                    { data: 'full_info', name: 'full_info' },
                    { data: 'milestone_type', name: 'milestone_type' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'finish_date', name: 'finish_date' },
                    { data: 'action', name: 'action',  searchable: false }
                ]
            });
            table.draw();
        });
        //        orderable: false, searchable: false
    </script>
@endsection