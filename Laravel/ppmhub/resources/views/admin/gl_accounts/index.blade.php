@extends('layout.admin')
@section('title', 'GL Accounts')
@section('body')
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
{!! Html::style('vendors/jqueryDataTable/datatables.min.css') !!}
@endsection
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>

        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1>GL Accounts</h1>
                @if (RoleAuthHelper::hasAccess('glAccounts.create')!=true)  
                <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
                    @else
                    <a class="btn btn-primary btn-sm" href="/admin/gl-accounts/create">@endif<i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Dashboard</a>
                    </li>
                    <li><span>GL Accounts</span></li>
                </ul>
            </div>
        </div>
        <div class="margin-bottom-50">
            <table class="table table-inverse" id="DateTablePPMHUB" width="100%">
                <thead>
                    <tr>
                        <th>GL Account No.</th>
                        <th>Description</th>
                        <th>Account Type</th>
                        <th>Element Type</th>
                        <th>Tax Type</th>
                        <th>Type Flag</th>
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
          ajax: '{!! route('gl-accounts-data-table') !!}',
          columns: [
              {data: 'number', name: 'number'},
              {data: 'description', name: 'description'},
              {data: 'gl_account_type', name: 'gl_account_type'},
              {data: 'gl_account_element_type', name: 'gl_account_element_type'},
              {data: 'gl_account_tax', name: 'gl_account_tax'},
              {data: 'type_flag', name: 'type_flag'},
              {data: 'action', name: 'action', searchable: false},
          ]
      });
      table.draw();
  });
  //        orderable: false, searchable: false
</script>
@endsection