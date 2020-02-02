@extends('layout.adminlayout')
@section('title','Customer Master')

@section('body')
@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif


<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            You are here :   <a href="javascript: void(0);">Sales Order</a>
                        </li>
                        <li>
                            <a href="{{url('admin/customer_master')}}">Customer Master Dashboard</a>
                        </li>
                        <li>
                            <span>Import Csv</span>
                        </li>
                    </ul>
                </div>
                <h4>Customer Master</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('customer_master.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default width-200 margin-top-10" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/customer_master/create')}}" class="btn btn-primary width-200 margin-top-10">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Customer
                        </a>
                        @if (RoleAuthHelper::hasAccess('customer_master.export.csv')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default width-200 margin-top-10" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/customer_master_exportcsv')}}" class="btn btn-primary width-200 margin-top-10">
                                @endif
                                <i class="fa fa-send margin-right-5"></i>
                                Export Customer List
                            </a>
                            @if (RoleAuthHelper::hasAccess('customer_master.import')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/customer_master_importcsv')}}" class="btn btn-primary width-200 margin-top-10">
                                    @endif
                                    <i class="fa fa-send margin-right-5"></i>
                                    Import
                                </a>
                                </div>


                                <br />
                                <h5>What would you like to do with the imported data?</h5>


                                {!! Form::open(array('url' => 'admin/customer_master_importExcel','method'=>'post','files'=>true)) !!} 

                                {!!Form::radio('new_records')!!}
                                {!!Form::label('Create new records only')!!}    
                                <br>
                                {!!Form::radio('update_records')!!}
                                {!!Form::label('Create new records and update existing records')!!}


                                <br>
                                {!! Form::file('import_file') !!}

                                <br><br>
                                @if (RoleAuthHelper::hasAccess('customermaster.import.csv')!=true)
                                {!!Form::button('Import CSV',array('class'=>'btn btn-default','style'=>"cursor:no-drop; color:#97A7A7;"))!!}
                                @else
                                {!!Form::submit('Import CSV',array('class'=>'btn btn-primary'))!!}
                                @endif

                                {!!Form::close()!!}

                                </div>
                                </div>
                                </div>
                                </section>


                                @endsection
