@extends('layout.adminlayout')
@section('title','Quotation')

@section('body')

<!-- Quotation-->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/quotation.js') !!}
<!-- Quotation-->

@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

<section id="create_form" class="panel">

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <!--                    <div class="dropdown inner-drpdwn">
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
                                            </ul>
                                        </div> -->
                </div>
                {!! Form::open(array('url' => 'admin/insertRefinquiry','method'=>'post', 'id' => 'Quotationform')) !!} 
                <div class="margin-bottom-50">

                    <div class="margin-bottom-50">
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here : <a href="{{url('/admin/sales_order')}}">Sales Order</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/quotation')}}">Quotation</a>
                            </li>
                            <li>
                                <span>Create Quotation with Ref</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">Create Quotation with Ref</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" hidden="">Quotation Number* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('quotation_number',$quotation_number,array('class'=>'form-control border-radius-0','readonly','hidden'))!!}
                                                @if($errors->has('inquiry_number')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('quotation_number') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Type* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('quotation_type',array('Product Quotation'=>'Product Quotation','Service Quotation'=>'Service Quotation','Support Quotation'=>'Support Quotation','Project Quotation'=>'Project Quotation'),'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Quotation type','id'=>'quotation_type'))!!}
                                                @if($errors->has('quotation_type')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('quotation_type') }}
                                                </div> 
                                                @endif                                        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Number* :</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('inquiry',$inquiry,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Inquiry','id'=>'inquiry'))!!}
                                                @if($errors->has('inquiry')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('inquiry') }}
                                                </div> 
                                                @endif                                    
                                            </div>
                                        </div>
                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{url('/admin/quotation')}}" class="btn btn-danger">Cancel</a>
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
<script type="text/javascript">

    $(document).ready(function () {


        $('#quotation_type').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#inquiry').select2({
        }).on('change', function () {
            $(this).valid();
        });

         $("#inquiry").change(function () {
                            var idPadre = $("#inquiry option:selected").val();
                            var token = '{{ csrf_token() }}';
                            $.ajax({
                                method: "POST",
                                url: "{{url('admin/getInquiryname')}}",
                                data: {id: idPadre, '_token': token}
                            }).done(function (response) {
                                var obj = jQuery.parseJSON(response);                             
                               
                                $('').html('');                              
                            });
                        });



    });


</script>
<!-- Page Scripts -->
@endsection

