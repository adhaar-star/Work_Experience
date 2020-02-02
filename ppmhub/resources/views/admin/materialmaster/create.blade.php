@extends('layout.adminlayout')

<?php if (isset($material_master->material_number)) { ?>
    @section('title','Edit Material Master')
<?php } else { ?>
    @section('title','Create Material Master')
<?php } ?>
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
@if(Session::has('flash_error'))
<div class="alert alert-danger">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_error') !!}</em>
</div>
@endif
<!-- Material Master -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/material_validation.js') !!}

<!-- Material Master -->
<section id="create_form" class="panel">
    <!--div class="panel-heading">
        <h3>Basic Form Elements</h3>
    </div-->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Portfolio Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                            <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                            <a class="dropdown-item" href="javascript:void(0)">Portfolio Structure</a>
                            <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
                            <a class="dropdown-item" href="javascript:void(0)">Portfolio Resource Plaining</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>

                @if(!isset($material_master->material_number))
                {!! Form::open(array('route' => 'material_master.create','method'=>'post', 'id' => 'Materialform')) !!} 
                @else
                {!! Form::open(array('route'=>array('material_master.update',$material_master->material_number),'method' => 'put','id' => 'Materialform')) !!}
                @endif
                {{ csrf_field() }}

                <div class="margin-bottom-50">

                    <div class="margin-bottom-50">
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here :    <a href="javascript: void(0);">Procurement</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/material_master')}}">Material Master</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($material_master->material_number))
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Material Master </span>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($material_master->material_number))
                                Edit
                                @else
                                Create
                                @endif 
                                Material Master
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Material Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('material_name',isset($material_master->material_name) ? $material_master->material_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Material Name'))!!}
                                                @if($errors->has('material_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('material_name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Material Description*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('material_description',isset($material_master->material_description) ? $material_master->material_description : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Description'))!!}
                                                @if($errors->has('material_description')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('material_description') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Material Category*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('material_category',$materialcat,isset($material_master->material_category) ? $material_master->material_category : '',array('class'=>'form-control select2','placeholder'=>'Please select Materialcategory','id'=>'material_category'))!!}  
                                            @if($errors->has('material_category')) 
                                            <div style='color:red'>
                                                {{ $errors->first('material_category') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Material Group*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('material_group',$materialgrp,isset($material_master->material_group) ? $material_master->material_group : '',array('class'=>'form-control select2','placeholder'=>'Please select Materialgroup','id'=>'material_group'))!!}  
                                            @if($errors->has('material_group')) 
                                            <div style='color:red'>
                                                {{ $errors->first('material_group') }}
                                            </div> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Supplier*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('supplier_name',$vid,isset($material_master->supplier_name) ? $material_master->supplier_name : '',array('class'=>'form-control select2','id'=>'sname','placeholder'=>'Please select Supplier'))!!}                         
                                                @if($errors->has('supplier_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('supplier_name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Unit Of Measure*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('unit_of_measure',$unitmeasure,isset($material_master->unit_of_measure) ? $material_master->unit_of_measure : '',array('class'=>'form-control select2','placeholder'=>'Please select Unit of user','id'=>'unit_of_measure'))!!}  
                                            @if($errors->has('unit_of_measure')) 
                                            <div style='color:red'>
                                                {{ $errors->first('unit_of_measure') }}
                                            </div> 
                                            @endif  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Currency*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('currency',$currency,isset($material_master->currency) ? $material_master->currency : '',array('class'=>'form-control select2','placeholder'=>'Please select currency','id'=>'currency'))!!}  
                                            @if($errors->has('currency')) 
                                            <div style='color:red'>
                                                {{ $errors->first('currency') }}
                                            </div> 
                                            @endif  
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Ordering Unit*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('ordering_unit',$orderingut,isset($material_master->ordering_unit) ? $material_master->ordering_unit : '',array('class'=>'form-control select2','placeholder'=>'Please select Ordering Unit','id'=>'ordering_unit'))!!}  
                                            @if($errors->has('ordering_unit')) 
                                            <div style='color:red'>
                                                {{ $errors->first('ordering_unit') }}
                                            </div> 
                                            @endif  
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Standard price:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('standard_price',isset($material_master->standard_price) ? $material_master->standard_price : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Standard Price','id'=>'num'))!!}
                                                @if($errors->has('standard_price')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('standard_price') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Stock item:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('stock_item',isset($material_master->stock_item) ? $material_master->stock_item : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Stock item'))!!}
                                                @if($errors->has('stock_item')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('stock_item') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">EAN/UPC number:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('EAN_UPC_number',isset($material_master->EAN_UPC_number) ? $material_master->EAN_UPC_number : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter EAN_UPC_number'))!!}
                                                @if($errors->has('EAN_UPC_number')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('EAN_UPC_number') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Tax classification:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('tax_classification',isset($material_master->tax_classification) ? $material_master->tax_classification : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Tax Classification'))!!}
                                                @if($errors->has('tax_classification')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('tax_classification') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Expiry DATE:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('expiry_date',isset($material_master->expiry_date) ? $material_master->expiry_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select expiry date'))!!}
                                                    <span class="input-group-addon"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                @if($errors->has('expiry_date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('expiry_date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Min stock:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('min_stock',isset($material_master->min_stock) ? $material_master->min_stock : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Min Stock'))!!}
                                                @if($errors->has('min_stock')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('min_stock') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Reorder quantity:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('reorder_quantity',isset($material_master->reorder_quantity) ? $material_master->reorder_quantity : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Recorder Quantity'))!!}
                                                @if($errors->has('reorder_quantity')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('reorder_quantity') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Gross Weight:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('gross_weight',isset($material_master->gross_weight) ? $material_master->gross_weight : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Gross weight'))!!}
                                                @if($errors->has('gross_weight')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('gross_weight') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Nett  Weight:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('nett_weight',isset($material_master->nett_weight) ? $material_master->nett_weight : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Nett weight'))!!}
                                                @if($errors->has('nett_weight')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('nett_weight') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($material_master->status))
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-danger">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @else
                                                @if($material_master->status == 'active')
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <a class="active-bttn btn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
                                                <a class="inactive-btn btn btn-danger active">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            @if(!isset($material_master->material_number))
                            {!! Form::submit('Submit',array('class'=>'btn btn-primary card-btn')) !!}  
                            @else
                            {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn')) !!}  

                            @endif

                            <a href="{{url('/admin/material_master')}}" class="btn btn-danger">Cancel</a> </div>
                    </div>
                </div>

                <!--End Vertical Form--> 
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section><!--
<!-- End Dashboard -->

<!-- Page Scripts -->

<script type="text/javascript">
    $(document).ready(function () {


        $('#sname').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#material_category').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#material_group').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#unit_of_measure').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#ordering_unit').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#currency').select2({
        }).on('change', function () {
            $(this).valid();
        });


        $('#sname').select2().append('<option value=' + $vid + '>' + $vid + '</option>');


    });



</script>
<script>


    $("#num").keyup(function (event) {
        if ((pointPos = this.value.indexOf('.')) >= 0)
            $(this).attr("maxLength", pointPos + 3);
        else
            $(this).removeAttr("maxLength");
    });
</script>

@endsection