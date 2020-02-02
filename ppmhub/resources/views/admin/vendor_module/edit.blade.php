@extends('layout.adminlayout')
@section('title','Edit Vendor')
@section('body')

<!-- Vendor -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('js/vendor_validation.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if(isset($vendor->id))
                {!! Form::open(array('route'=>array('vendor.update',$vendor->id),'method' => 'put','id' => 'Vendorform')) !!}
                @endif

                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">                   
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here :     <a href="javascript: void(0);">Procurement</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/vendor')}}">Vendor</a>
                            </li>
                            <li>
                                <span>Edit Vendor</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">Edit Vendor</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Vendor Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('name',isset($vendor->name) ? $vendor->name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Vendor Name'))!!}
                                            @if($errors->has('name')) 
                                            <span class="text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                            @endif
                                        </div> 
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Vendor ID*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('vendor_id',isset($vendor->vendor_id) ? $vendor->vendor_id : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Vendor Id'))!!}
                                            @if($errors->has('vendor_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('vendor_id') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Website Address*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('website_address',isset($vendor->website_address) ? $vendor->website_address : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Website Address'))!!}
                                            @if($errors->has('website_address')) 
                                            <span class="text-danger">
                                                {{ $errors->first('website_address') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Fax*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('fax',isset($vendor->fax) ? $vendor->fax : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Fax number'))!!}
                                            @if($errors->has('fax')) 
                                            <span class="text-danger">
                                                {{ $errors->first('fax') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Office Phone*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('office_phone',isset($vendor->office_phone) ? $vendor->office_phone : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Office phone'))!!}
                                            @if($errors->has('office_phone')) 
                                            <span class="text-danger">
                                                {{ $errors->first('office_phone') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Email Address*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('email',isset($vendor->email) ? $vendor->email : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Email Address','id'=>'email'))!!}
                                            @if($errors->has('email'))  
                                            <span class="text-danger">
                                                {{ $errors->first('email') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Street*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('street',isset($vendor->street) ? $vendor->street : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Street'))!!}
                                            @if($errors->has('street')) 
                                            <span class="text-danger">
                                                {{ $errors->first('street') }}
                                            </span> 
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">City*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('city',isset($vendor->city) ? $vendor->city : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter City'))!!}
                                            @if($errors->has('city')) 
                                            <span class="text-danger">
                                                {{ $errors->first('city') }}
                                            </span> 
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">State*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('state',['' => 'Please select state']+$state_data,isset($vendor->state) ? $vendor->state : '',array('class'=>'form-control select2','id'=>'state'))!!}  
                                            <!--                                            @if($errors->has('state')) 
                                                                                        <span class="text-danger">
                                                                                            {{ $errors->first('state') }}
                                                                                        </span> 
                                                                                        @endif-->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Postal*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('postal_code',array('1'=>'3000','2'=>'4000','3'=>'6000','4'=>'7000'),$vendor->postal_code,array('class'=>'form-control select2','placeholder'=>'Please select PostalCode'))!!}  
                                            @if($errors->has('postal_code')) 
                                            <span class="text-danger">
                                                {{ $errors->first('postal_code') }}
                                            </span> 
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Country*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('country',$country_data,$vendor->country,array('class'=>'form-control select2','placeholder'=>'Please select country','id'=>'country'))!!}  
                                            @if($errors->has('country')) 
                                            <span class="text-danger">
                                                {{ $errors->first('country') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Tax Number*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('tax_no',isset($vendor->tax_no) ? $vendor->tax_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Tax Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">OneTime Vendor*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 margin-top-9">
                                            @if(isset($vendor->id))
                                            Yes {!! Form::checkbox('onetime_vendor',1,$onetime_vendor) !!}                                        
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Approved Vendor*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 margin-top-9">
                                            @if(isset($vendor->id))
                                            Yes {!! Form::checkbox('approved_vendor',1,$approved_vendor) !!}                                        
                                            @endif
                                        </div>
                                    </div>



                                    <input type="hidden" id="created_date" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control col-md-7 col-xs-12">
                                    <!-- End Vertical Form -->
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Category*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('category',array('Electronic'=>'Electronic','Stationary'=>'Stationary','Food'=>'Food','Equipment'=>'Equipment','Crane'=>'Crane','Manpower supplier'=>'Manpower supplier','Security'=>'Security','Software'=>'Software','Furniture'=>'Furniture'),$vendor->category,array('class'=>'form-control select2','placeholder'=>'Please select category'))!!}  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Payment Terms*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('payment_terms',array('Cash on delivery'=>'Cash on delivery','Net 30 days'=>'Net 30 days','60days& 90 days'=>'60days& 90 days'),$vendor->payment_terms,array('class'=>'form-control select2','placeholder'=>'Please select payment terms'))!!}  
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">ABN Number*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('abn_no',isset($vendor->abn_no) ? $vendor->abn_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter ABN Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">ACN Number*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('acn_no',isset($vendor->acn_no) ? $vendor->acn_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter ACN Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">E-invoice*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 margin-top-9">
                                            @if(isset($vendor->id))
                                            Yes {!! Form::checkbox('e_invoice',1,$e_invoice) !!}                                        
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Bank*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::select('bank_name',$bank_name,$vendor->bank_name,array('class'=>'form-control select2','placeholder'=>'Please select bank'))!!}  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">BSB Number*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('bsb',isset($vendor->bsb) ? $vendor->bsb : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter BSB Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Account Number*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('account_no',isset($vendor->account_no) ? $vendor->account_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Account Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">IFSC Code*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('ifsc_code',isset($vendor->ifsc_code) ? $vendor->ifsc_code : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter IFSC Code'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('contact_name',isset($vendor->contact_name) ? $vendor->contact_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contact Name'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Role*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('contact_role',isset($vendor->contact_role) ? $vendor->contact_role : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contact Role'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Email*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('contact_email',isset($vendor->contact_email) ? $vendor->contact_email : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contact Email'))!!}
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Phone*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            {!!Form::text('contact_phone',isset($vendor->contact_phone) ? $vendor->contact_phone : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contact Phone'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($vendor->status))
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-danger">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @else
                                                @if($status == 'active')
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <a class="active-btn bttn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
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
                            @if(!isset($vendor))
                            {!! Form::submit('Save',array('class'=>'btn btn-primary card-btn')) !!}  
                            @else
                            {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn')) !!}  

                            @endif
                            <a href="{{url('/admin/vendor')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div> 
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
<!-- End Dashboard -->

<!-- Page Scripts -->
<script type="text/javascript">

    $(document).ready(function () {


        $('#state').select2({
        }).on('change', function () {
            $(this).valid();
        });

        $('#country').select2({
        }).on('change', function () {
            $(this).valid();
        });
    });

    $('#country').change(function () {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "/admin/api/state/" + countryID,
                success: function (response) {
                    $("#state").html('');
                    var stateOptions = '<option value="">Please select state</option>';
                    console.log('response', response);
                    if (response.status) {
                        $.each(response.results, function (stateKey, stateVal) {
                            stateOptions += '<option value="' + stateVal.state_name + '">' + stateVal.state_name + '</option>';
                        })
                    }

                    $('#state').html(stateOptions);
                }
            });
        }
    });
</script>
@endsection
