@extends('layout.admin')
@section('title', 'Material Master')
@section('PageCss')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
@endsection
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($material))
                    {!! Form::open([ 'route' => [ $route.'.update', $material->material_id ],  'method' => 'put', 'class' => 'form-horizontal GlobalFormValidation' ]) !!}
                @else
                    {!! Form::open([ 'route' => [ $route.'.store'], 'method' =>'post', 'class'=> 'form-horizontal GlobalFormValidation' ]) !!}
                @endif
                <div class="margin-bottom-50">
                    <div class="row PageTitleGlobal">
                        <div class="col-md-6">
                            <h1>Material Master</h1>
                        </div>
                        <div class="col-md-6 text-right">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route( $route .'.index') }}">Material Master</a></li>
                                <li><span>@if(!empty($material))  Update @else Create @endif Material</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                             <h4 class="margin-0">@if(!empty($material))  Update @else Create @endif Material</h4>
                        </div>
                        <div class="card-block">
                             <div class="row" style="margin: 0;">
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Material No<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('material_no', !empty($material) ? $material->material_no : $material_no,
                                                [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Material No',
                                                    'readonly' => 'readonly',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Material No. Is Required'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Material Name<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('name', !empty($material) ? $material->name : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter Material Name',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Name Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Description<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('description', !empty($material) ? $material->description : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter Material Description',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Description Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Currency<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('currency_id',  $currencies,!empty($material) ? $material->currency_id : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Select Material Currency',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Currency Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Unit Price<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::number('price', (!empty($material)) ? $material->price : null,
                                                 ['class'=>'form-control  border-radius-0 no-resize',
                                                    'min' => 0,
                                                    'step' =>'0.50',
                                                    'placeholder'=>'Material Unit Price',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Price is required'
                                                  ] )!!}
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Material Vendor<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('vendor_id', $vendors, (!empty($material)) ? $material->vendor_id : null,
                                                 [
                                                    'class'=>'form-control  border-radius-0 no-resize select2',
                                                    'placeholder'=>'Select Vendor',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Vendor is required'

                                                  ] )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Material Category<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('material_category_id', $material_categories, (!empty($material)) ? $material->material_category_id : null,
                                                 [
                                                    'class'=>'form-control  border-radius-0 no-resize',
                                                    'placeholder'=>'Select Material Category',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Material Category is required'

                                                  ] )!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Material Group<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('material_group_id', $material_groups, (!empty($material)) ? $material->material_group_id : null,
                                                 [
                                                    'class'=>'form-control  border-radius-0 no-resize',
                                                    'placeholder'=>'Select Material Group',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Material Group is required'

                                                  ] )!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Ordering Unit<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('order_unit_id', $ordering_unit, (!empty($material)) ? $material->order_unit_id : null,
                                                 [
                                                    'class'=>'form-control  border-radius-0 no-resize',
                                                    'placeholder'=>'Select Order Unit',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Order Unit is required'

                                                  ] )!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Unit Of Measure<span>*</span>:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('unit_of_measure_id', $unit_of_measure, (!empty($material)) ? $material->unit_of_measure_id : null,
                                                 [
                                                    'class'=>'form-control  border-radius-0 no-resize',
                                                    'placeholder'=>'Select Order Unit',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Order Unit is required'

                                                  ] )!!}
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Stock item:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::number('stock_item', !empty($material) ? $material->stock_item : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter Stock item',

                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Min Stock:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::number('min_stock', !empty($material) ? $material->min_stock : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter Min Stock',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">EAN/UPC Number:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('ean_upc_no', !empty($material) ? $material->ean_upc_no : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Enter EAN/UPC Number',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Tax classification:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('tax_classification', !empty($material) ? $material->tax_classification : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Tax classification',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Expiry Date:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('expiry_date', !empty($material) ? $material->expiry_date : null, [
                                                    'class'=>'form-control border-radius-0 datepicker-only-init',
                                                    'placeholder'=>'Enter Select Expiry Date',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Reorder Quantity:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('reorder_quantity', !empty($material) ? $material->reorder_quantity : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Reorder Quantity',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Gross Weight:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('gross_weight', !empty($material) ? $material->gross_weight : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Gross Weight',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-md-4 col-form-label text-right">Net Weight:</label>
                                        <div class="col-xs-12 col-sm-2 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('net_weight', !empty($material) ? $material->net_weight : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Enter Net Weight',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">Status :</label>
                                        <div class="col-sm-8">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($material->status))
                                                    <a class="active-btn btn btn-primary active">{!! Form::radio('status', 1, true)!!}Active</a>
                                                    <a class="inactive-btn btn btn-default">{!! Form::radio('status', 0) !!}Inactive</a>
                                                @else
                                                    @if($material->status == 1)
                                                        <a class="active-btn btn btn-primary active">{!! Form::radio('status', 1, true)!!}Active</a>
                                                        <a class="inactive-btn btn btn-default">  {!! Form::radio('status', 0)!!}Inactive</a>
                                                    @else
                                                        <a class="active-btn btn btn-primary"> {!! Form::radio('status', 1)!!}Active</a>
                                                        <a class="inactive-btn btn btn-default active">{!! Form::radio('status', 0, true) !!}Inactive</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-lg-offset-1" style="margin-top: 10px;">
                                    @include('layout.admin_layout_include.alert_process')
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{route( $route .'.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</section>
@endsection
@section('PageJquery')
    {!! Html::script('vendors/formValidation/js/formValidation.min.js') !!}
    {!! Html::script('vendors/formValidation/js/framework/bootstrap.min.js') !!}
    {!! Html::script('js/globalValidationCustom.js') !!}
    {!! Html::script('vendors/select2/dist/js/select2.full.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection