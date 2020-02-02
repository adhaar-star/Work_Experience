@extends('layout.adminlayout')
@section('title','Create Contract with Ref.')

@section('body')

<!-- Vendor -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/contract.js') !!}


<!-- Vendor -->
<section id='create_form' class="panel">

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
<!--                <div class="togle-btn pull-right">
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
                </div>-->


                {!! Form::open(array('url' => 'admin/insertRefPurchaseOrder','method'=>'post', 'id' => 'contractform')) !!} 

                <div class="margin-bottom-50">

                    <div class="margin-bottom-50">
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here :    <a href="javascript: void(0);">Procurement</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/contract')}}"> Contract </a>
                            </li>
                            <li>
                                <span>Create Contract with Ref.</span>
                            </li>
                            
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">Create Contract with Ref. </h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">

                                    <?php
                                    $rand_number = rand(5000000, 499999999);
                                    ?>
                                    <input type="hidden" name="agreement_number" value="<?php echo $rand_number; ?> ">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contract Number :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('super_contract_no',$contract_no,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select super contract no.','id'=>'purchase'))!!}
                                                @if($errors->has('super_contract_no')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('super_contract_no') }}
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
                        </div>
                            <div class="card-footer card-footer-box text-right">
                                {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn','id'=>'create'))!!}
                                <a href="{{url('/admin/contract')}}" class="btn btn-danger">Cancel</a
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
//    
//    $('#create').click(function(){
//        $('#mask').show();
//    });
//    
</script>
@endsection
