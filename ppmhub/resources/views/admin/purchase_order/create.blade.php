@extends('layout.adminlayout')
@section('title','Create Purchase order')

@section('body')

<!-- Vendor -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/purchase.js') !!}


<!-- Vendor -->
<section id='create_form' class="panel">

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Procurement</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                            <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                            <a class="dropdown-item" href="javascript:void(0)">Portfolio Structure</a>
                            <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
                            <a class="dropdown-item" href="javascript:void(0)">Portfolio Resource Plaining</a>
                        </ul>
                    </div> 
                </div>


                {!! Form::open(array('route' => 'purchase_order.create','method'=>'post', 'id' => 'Purchaseform')) !!} 

                <div class="margin-bottom-50">

                    <div class="margin-bottom-50">
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here :    <a href="javascript: void(0);">Procurement</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/purchase_order')}}">Purchase Order</a>
                            </li>
                            <li>
                                <span>Create Purchase Order</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0"> Create Purchase Order </h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">

                                    <?php
                                    $rand_number = rand(4000000, 499999999);
                                    ?>
                                    <input type="hidden" name="purchase_orderno" value="<?php echo $rand_number; ?> ">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Purchase Requisition* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('purchase_requistion',$purchase_no,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select purchase requisition','id'=>'purchase'))!!}
                                                @if($errors->has('purchase_requistion')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('purchase_requistion') }}
                                                </div> 
                                                @endif                                     
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Copy :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="btn-group" data-toggle="buttons">

                                                <a class="active-bttn btn btn-primary active">
                                                    <!--Active-->
                                                    {!! Form::radio('status','yes','yes') !!}Yes

                                                </a>
                                                <a class="inactive-btn btn btn-default">
                                                    <!--Inactive-->
                                                    {!! Form::radio('status','no') !!}No

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer card-footer-box text-right">
                                {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn','id'=>'create'))!!}
                                <a href="{{url('/admin/purchase_order')}}" class="btn btn-danger">Cancel</a
                            </div>
                        </div>

                    </div>
                    <!--End Vertical Form--> 
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section><!--
<!-- End Dashboard -->

<!-- Page Scripts -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#purchase').select2({
        }).on('change', function () {
            $(this).valid();
        });
    });
    
    $('#create').click(function(){
        $('#mask').show();
    });
    
</script>
@endsection
