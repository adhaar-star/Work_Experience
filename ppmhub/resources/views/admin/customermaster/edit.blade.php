@extends('layout.adminlayout')
@section('title','Edit Customer')
@section('body')

<!-- Customer -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/customer_validation.js') !!}
<!-- Customer -->

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                @if(isset($customer->id))
                {!! Form::open(array('route'=>array('customer_master.update',$customer->id),'method' => 'put','id' => 'CustomerMasterform')) !!}
                @endif

                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                You are here : <a href="javascript: void(0);">Sales Order</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/customer_master')}}">Customer</a>
                            </li>
                            <li>
                                <span>Edit Customer</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">Edit Customer</h4>
                        </div>
                        <div class="card-block bg-lightcyan">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Customer Name*:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('name',isset($customer->name) ? $customer->name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Customer Name'))!!}
                                            @if($errors->has('name')) 
                                            <span class="text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                            @endif
                                        </div> 
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Customer ID*:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('customer_id',isset($customer->customer_id) ? $customer->customer_id : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Customer Id'))!!}
                                            @if($errors->has('customer_id')) 
                                            <span class="text-danger">
                                                {{ $errors->first('customer_id') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Website Address*:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('website_address',isset($customer->website_address) ? $customer->website_address : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Website Address'))!!}
                                            @if($errors->has('website_address')) 
                                            <span class="text-danger">
                                                {{ $errors->first('website_address') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Fax*:</label>
                                        <div class="col-sm-2">
                                            {!!Form::text('fax',isset($customer->fax) ? $customer->fax : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Fax number'))!!}
                                            @if($errors->has('fax')) 
                                            <span class="text-danger">
                                                {{ $errors->first('fax') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Office Phone*:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('office_phone',isset($customer->office_phone) ? $customer->office_phone : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Office phone'))!!}
                                            @if($errors->has('office_phone')) 
                                            <span class="text-danger">
                                                {{ $errors->first('office_phone') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Street*:</label>
                                        <div class="col-sm-2">
                                            {!!Form::text('street',isset($customer->street) ? $customer->street : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Street'))!!}
                                            @if($errors->has('street')) 
                                            <span class="text-danger">
                                                {{ $errors->first('street') }}
                                            </span> 
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">City*:</label>
                                        <div class="col-sm-2">
                                            {!!Form::text('city',isset($customer->city) ? $customer->city : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter City'))!!}
                                            @if($errors->has('city')) 
                                            <span class="text-danger">
                                                {{ $errors->first('city') }}
                                            </span> 
                                            @endif 
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Postal*:</label>
                                        <div class="col-sm-3">
                                            {!!Form::select('postal_code',array('3000'=>'3000','4000'=>'4000','5000'=>'5000','6000'=>'6000'),$customer->postal_code,array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select PostalCode'))!!}  
                                            @if($errors->has('postal_code')) 
                                            <span class="text-danger">
                                                {{ $errors->first('postal_code') }}
                                            </span> 
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Country*:</label>
                                        <div class="col-sm-3">
                                            {!!Form::select('country',$country_data,$customer->country,array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select country','id'=>'country'))!!}  
                                            @if($errors->has('country')) 
                                            <span class="text-danger">
                                                {{ $errors->first('country') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">State*:</label>
                                        <div class="col-sm-3">
                                            {!!Form::select('state',['' => 'Please select state']+$state_data,isset($customer->state) ? $customer->state : '',array('class'=>'form-control border-radius-0 select2','id'=>'state'))!!}                                         
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Email Address*:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('email',isset($customer->email) ? $customer->email : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Email Address','id'=>'email'))!!}
                                            @if($errors->has('email'))  
                                            <span class="text-danger">
                                                {{ $errors->first('email') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Tax Number:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('tax_no',isset($customer->tax_no) ? $customer->tax_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Tax Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">OneTime Customer:</label>
                                        <div class="col-sm-3">
                                            @if(isset($customer->id))
                                            Yes {!! Form::checkbox('onetime_customer','yes',$onetime_customer) !!}                                        
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Approved Customer:</label>
                                        <div class="col-sm-3">
                                            @if(isset($customer->id))
                                            Yes {!! Form::checkbox('approved_customer','yes',$approved_customer) !!}                                        
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Category:</label>
                                        <div class="col-sm-3">
                                            {!!Form::select('category',array('Electronic'=>'Electronic','Stationary'=>'Stationary','Food'=>'Food','Equipment'=>'Equipment','Crane'=>'Crane','Manpower supplier'=>'Manpower supplier','Security'=>'Security','Software'=>'Software','Furniture'=>'Furniture'),$customer->category,array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select category'))!!}  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Payment Terms:</label>
                                        <div class="col-sm-3">
                                            {!!Form::select('payment_terms',array('Cash on delivery'=>'Cash on delivery','Net 30 days'=>'Net 30 days','60days& 90 days'=>'60days& 90 days'),$customer->payment_terms,array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select payment terms'))!!}  
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">ABN Number:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('abn_no',isset($customer->abn_no) ? $customer->abn_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter ABN Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">ACN Number:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('acn_no',isset($customer->acn_no) ? $customer->acn_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter ACN Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">E-invoice:</label>
                                        <div class="col-sm-3">
                                            @if(isset($customer->id))
                                        Yes {!! Form::checkbox('e_invoice','yes',$e_invoice) !!}                                        
                                            @endif
                                        </div>
                                    </div>
                                    <?php if (isset($bank_name)) {?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Select Bank:</label>
                                        <div class="col-sm-2">
                                            {!!Form::select('bank_name',$bank_name,$customer->bank_name,array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select bank'))!!}  
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Select Bank:</label>
                                        <div class="col-sm-2">
                                            {!!Form::select('bank_name',[],'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select bank'))!!}  
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">BSB Number:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('bsb',isset($customer->bsb) ? $customer->bsb : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter BSB Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Account Number:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('account_no',isset($customer->account_no) ? $customer->account_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Account Number'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">IFSC Code:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('ifsc_code',isset($customer->ifsc_code) ? $customer->ifsc_code : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter IFSC Code'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Contact Name:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('contact_name',isset($customer->contact_name) ? $customer->contact_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contact Name'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Contact Role:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('contact_role',isset($customer->contact_role) ? $customer->contact_role : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contact Role'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Contact Email*:</label>
                                        <div class="col-sm-2">
                                            {!!Form::text('contact_email',isset($customer->contact_email) ? $customer->contact_email : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contact Email'))!!}
                                            @if($errors->has('contact_email')) 
                                            <span class="text-danger">
                                                {{ $errors->first('contact_email') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Contact Phone:</label>
                                        <div class="col-sm-3">
                                            {!!Form::text('contact_phone',isset($customer->contact_phone) ? $customer->contact_phone : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Contact Phone'))!!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status</label>
                                        <div class="col-sm-3">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($customer->status))
                                                <label class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </label>
                                                <label class="inactive-btn btn btn-default">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </label>
                                                @else
                                                @if($status == 'active')
                                                <a class="active-bttn card-btn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <label class="active-bttn btn btn-primary"> {!! Form::radio('status','active')!!}Active</label>
                                                <label class="inactive-btn btn btn-danger active">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </label>
                                                @endif
                                                @endif
                                            </div>
                                        </div>    
                                    </div>

                                  <!-- End Vertical Form -->
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box">
                         {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn ')) !!}  
                            <a href="{{url('/admin/customer_master')}}" class="btn btn-danger">Cancel</a>
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
    
     $("#postal_code").select2({
        }).on('change', function() {
            $(this).valid();
        });
        
          $("#country").select2({
        }).on('change', function() {
            $(this).valid();
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