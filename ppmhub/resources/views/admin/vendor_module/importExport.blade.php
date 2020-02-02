@extends('layout.adminlayout')
@section('title','Vendor')
@section('body')
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/vendor_import_validation.js') !!}
@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}    
</div>
@endif

@if ($message = Session::get('error'))
@if (count(Session::get('error')) > 0)
<div class="alert alert-danger">
    <ul>
        @if(Session::get('error_line'))
        <li>{{ Session::get('error_line') }}</li>
        @endif
        @foreach (Session::get('error')->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endif

<!--TEST-->
@if(count($errors) > 0)
<div class="alert alert-danger">
    <h6 style="margin-bottom: 5px;">Please check below fields in CSV file</h6>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!--TEST END-->

<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            You are here :   <a href="javascript: void(0);">Procurement</a>
                        </li>
                        <li>
                            <a href="{{url('admin/vendor')}}">Vendor Dashboard</a>
                        </li>
                        <li>
                            <span>Import Csv</span>
                        </li>
                    </ul>
                </div>
                <h4>Vendor Master</h4>
                <div class="dashboard-buttons">
                    @if (RoleAuthHelper::hasAccess('vendor.create')!=true)  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        @else
                        <a href="{{url('admin/vendor/create')}}" class="btn btn-primary">
                            @endif
                            <i class="fa fa-send margin-right-5"></i>
                            Create Vendor
                        </a>
                        @if (RoleAuthHelper::hasAccess('vendor.export.csv')!=true)  
                        <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                            @else
                            <a href="{{url('admin/vendor_exportcsv')}}" class="btn btn-primary margin-left-10">
                                @endif
                                <i class="fa fa-send margin-right-5"></i>
                                Export Vendor List
                            </a>
                            @if (RoleAuthHelper::hasAccess('vendor.import.dashboard')!=true)  
                            <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                                @else
                                <a href="{{url('admin/vendor_importcsv')}}" class="btn btn-primary margin-left-10">
                                    @endif
                                    <i class="fa fa-send margin-right-5"></i>
                                    Import
                                </a>
                                </div> 

                                <br />
                                <h5>What would you like to do with the imported data?</h5>

                                {!! Form::open(array('url' => 'admin/importExcel','method'=>'post','files'=>true),array('id'=>'importForm')) !!} 

                                {!!Form::radio('importOption','newRecords',true)!!}
                                {!!Form::label('Create new records only')!!}    
                                <br>
                                {!!Form::radio('importOption','updateRecord')!!}
                                {!!Form::label('Create new records and update existing records')!!}

                                <br>
                                {!! Form::file('import_file') !!}
                                @if($errors->has('import_file')) 
                                <div style='color:red'>
                                    {{ $errors->first('import_file') }}
                                </div> 
                                @endif                                
                                @if(Session::get('msg'))
                                <div style="color:red">
                                    {{ Session::get('msg') }}    
                                </div>
                                @endif


                                <br><br>
                                @if (RoleAuthHelper::hasAccess('vendor.import.excel')!=true)  
                                    {!!Form::button('Import CSV',array('class'=>'btn btn-default','style'=>'cursor:no-drop; color:#97A7A7;'))!!}
                                    @else
                                    {!!Form::submit('Import CSV',array('class'=>'btn btn-primary'))!!}
                                    @endif
                                    {!!Form::close()!!}

                                    </div>
                                    </div>
                                    </div>
                                    </section>


                                    @endsection
