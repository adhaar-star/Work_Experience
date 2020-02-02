@extends('layout.adminlayout')
@section('title','Edit Customer Inquiry')
@section('body')
<!-- Customer Inquiry-->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/customer_inquiry.js') !!}
<!-- Customer Inquiry-->
<section id="create_form" class="panel">
    <!--- Bootstrap Model --->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>No discount above 100%</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Model -->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">

                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            You are here : <a href="javascript: void(0);" style="margin-left: 10px;">Sales Order</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/customer_inquiry')}}">Customer Inquiry</a>
                        </li>
                        <li>
                            <span>Edit Customer Inquiry</span>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan">
                        <h4 class="margin-0">Edit Customer Inquiry</h4>
                    </div>
                    <div class="card-block">
                        <div class="ppm-tabpane">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#inquiry-desc" role="tab">Header Note</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#header_item" role="tab">Header Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#header_pricing" role="tab">Header Pricing Conditions</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <form id="cutomer_inquiry">
                                {!!Form::hidden('inquiry_number',$customer_inquiry->inquiry_number,array('class'=>'form-control border-radius-0'))!!}
                                {{ csrf_field() }}  
                                <div class="tab-content">
                                    <div class="tab-pane active" id="inquiry-desc" role="tabpanel">
                                        <div class="tab-header-title">
                                            Inquiry Detailed Description
                                        </div>
                                        <div class="tab-block">
                                            <div class="form-group row">
                                                {!!Form::textarea('inquiry_description',isset($customer_inquiry->inquiry_description) ? $customer_inquiry->inquiry_description : '',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter inquiry detailed description','maxlength'=>255))!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="header_item" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Number*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('inquiry_number',$customer_inquiry->inquiry_number,array('class'=>'form-control border-radius-0','readonly'))!!}
                                                                @if($errors->has('inquiry_number')) 
                                                                <div style='color:red'>
                                                                    {{ $errors->first('inquiry_number') }}
                                                                </div> 
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Customer*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::select('customer',$customer_id,isset($customer_inquiry->customer) ? $customer_inquiry->customer : '',array('class'=>'form-control border-radius-0 select2 customer','placeholder'=>'Please select customer','id'=>'customer'))!!}
                                                                @if($errors->has('customer')) 
                                                                <div style='color:red'>
                                                                    {{ $errors->first('customer') }}
                                                                </div> 
                                                                @endif   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales organization*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('sales_organization',$salesorg,isset($customer_inquiry->sales_organization) ? $customer_inquiry->sales_organization : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select sales organization','id'=>'sales_organization'))!!}  
                                                            @if($errors->has('sales_organization')) 
                                                            <div style='color:red'>
                                                                {{ $errors->first('sales_organization') }}
                                                            </div> 
                                                            @endif 
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Requested by:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('requested_by',$requestedby,isset($customer_inquiry->requested_by) ? $customer_inquiry->requested_by : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select requested by','id'=>'requested_by'))!!}  
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Type*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">                                               
                                                                {!!Form::select('inquiry_type',$inquirytype,isset($customer_inquiry->inquiry_type) ? $customer_inquiry->inquiry_type : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select inquiry type','id'=>'inquiry_type'))!!}
                                                                @if($errors->has('inquiry_type')) 
                                                                <div style='color:red'>
                                                                    {{ $errors->first('inquiry_type') }}
                                                                </div> 
                                                                @endif                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Customer Name* :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('customer_name',isset($customer_inquiry->customer_name) ? $customer_inquiry->customer_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Customer name','readonly'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Region*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('sales_region',$salesregion,isset($customer_inquiry->sales_region) ? $customer_inquiry->sales_region : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select sales region','id'=>'sales_region'))!!}  
                                                            @if($errors->has('sales_region')) 
                                                            <div style='color:red' class="postal">
                                                                {{ $errors->first('sales_region') }}
                                                            </div> 
                                                            @endif 
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="header_pricing" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Gross price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('inquiry_gross_price',isset($customer_inquiry->inquiry_gross_price) ? $customer_inquiry->inquiry_gross_price : '',array('class'=>'form-control border-radius-0','readonly','placeholder'=>'Gross Price'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('inquiry_discount_amt',isset($customer_inquiry->inquiry_discount_amt) ? $customer_inquiry->inquiry_discount_amt : '',array('class'=>'form-control border-radius-0','placeholder'=>'Discount amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Tax Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('inquiry_sales_taxamt',isset($customer_inquiry->inquiry_sales_taxamt) ? $customer_inquiry->inquiry_sales_taxamt : '',array('class'=>'form-control border-radius-0','placeholder'=>'Sales tax amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Freight charges:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('inquiry_freight_charges',isset($customer_inquiry->inquiry_freight_charges) ? $customer_inquiry->inquiry_freight_charges : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter freight charges'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('inquiry_discount',isset($customer_inquiry->inquiry_discount) ? $customer_inquiry->inquiry_discount : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter discount'))!!}
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount Gross Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('inquiry_discount_gross_price',isset($customer_inquiry->inquiry_discount_gross_price) ? $customer_inquiry->inquiry_discount_gross_price : '',array('class'=>'form-control border-radius-0','placeholder'=>'Discount gross price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Net Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('inquiry_net_price',isset($customer_inquiry->inquiry_net_price) ? $customer_inquiry->inquiry_net_price : '',array('class'=>'form-control border-radius-0','placeholder'=>'Net price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Total price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('inquiry_total_price',isset($customer_inquiry->inquiry_total_price) ? $customer_inquiry->inquiry_total_price : '',array('class'=>'form-control border-radius-0','placeholder'=>'Total price','readonly'))!!}  
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-list table-responsive margin-top-15 margin-bottom-40">
                            <thead>
                                <tr> 
                                    <th>Select</th>
                                    <th>Delete</th>
                                    <th>Status</th>
                                    <th>Item No.</th>                                    
                                    <th>Material</th>
                                    <th>Material Description</th>
                                    <th>Customer Material NO.</th>
                                    <th>Order Quantity*</th>
                                    <th>Cost per unit*</th>
                                    <th>Total Amount*</th>
                                    <th>Material Group</th>
                                    <th>Reason For Rejection</th>
                                </tr>
                            </thead>
                            <tbody id='purchase_item_form'>
                                {!! Form::button('Add Item',array('class'=>'btn btn-warning width-100','id'=>'add_row')) !!}  
                                @if (count($customer_item_data)<1)
                                <tr id='purchase_item_0' class = "form">
                                    <td class="text-center line-height-2">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" id='0' value='#purchase_item_0' class='special-radio' checked=""/></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this item ?');
                                                    if (res)$('table #purchase_item_0').remove();
                                            }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                    </td> 
                                    <td>                                        
                                        @if(isset($itemData->status))
                                        <input type="image" src="{{asset('vendors/common/img/green.png')}}" alt="" value="active"  onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>

                                        @else
                                        <input type="image" src="{{asset('vendors/common/img/red.png')}}" alt="" value="inactive" onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>
                                        @endif    
                                    </td>
                                    <td>
                                        {!!Form::text('item_no','10',array('class'=>'form-control padding-input border-radius-0 width-70','min'=>0))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material',$material,isset($itemData->material) ? $itemData->material : '',array('class'=>'form-control material select2 border-radius-0','placeholder'=>'Please select Material','id'=>'material'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('material_description',isset($itemData->material_description) ? $itemData->material_description : '',array('class'=>'form-control border-radius-0 no-resize','placeholder'=>'Enter Description','maxlength'=>50))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('customer_material_no',isset($itemData->customer_material_no) ? $itemData->customer_material_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please select customer material no.'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('order_qty',isset($itemData->order_qty) ? $itemData->order_qty : '',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter Quantity','id'=>'order_qty'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('cost_unit',isset($itemData->cost_unit) ? $itemData->cost_unit : '',array('class'=>'form-control border-radius-0 padding-input totalamt','placeholder'=>'Please enter cost per unit','id'=>'cost_unit'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('tota_amt',isset($itemData->tota_amt) ? $itemData->tota_amt : '',array('class'=>'form-control  border-radius-0 padding-input','placeholder'=>'Please enter total amount','readonly'))!!}                                   
                                    </td>
                                    <td>
                                        {!!Form::select('material_group',['Raw Material'=>'Raw Material','Service Material'=>'Service Material'],isset($itemData->material_group) ? $itemData->material_group : '',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Material Group'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('reason',$reasonRejection,isset($itemData->reason) ? $itemData->reason : '',array('class'=>'form-control select2  border-radius-0','placeholder'=>'Please select Reason for Rejection'))!!}
                                    </td>
                                    {!!Form::hidden('project_id')!!}
                                    {!!Form::hidden('phaseid')!!}
                                    {!!Form::hidden('task')!!}
                                    {!!Form::hidden('cost_center')!!}
                                    {!!Form::hidden('processing_status')!!}
                                    {!!Form::hidden('company_name')!!}
                                    {!!Form::hidden('contact_person_name')!!}
                                    {!!Form::hidden('phone_no')!!}
                                    {!!Form::hidden('inquiry_number',$customer_inquiry->inquiry_number)!!}
                                    {!!Form::hidden('short_description')!!}
                                    {!!Form::hidden('requested_by')!!}
                                    {!!Form::hidden('gross_price')!!}
                                    {!!Form::hidden('discount')!!}
                                    {!!Form::hidden('discount_amt')!!}
                                    {!!Form::hidden('discount_gross_price')!!}
                                    {!!Form::hidden('sales_tax')!!}
                                    {!!Form::hidden('sales_taxamt')!!}
                                    {!!Form::hidden('net_price')!!}
                                    {!!Form::hidden('freight_charges')!!}
                                    {!!Form::hidden('total_price')!!}
                                </tr>
                                @endif
                                @if(count($customer_item_data)>0)
                                @foreach($customer_item_data as $customer_item)   
                                <tr id="purchase_item_{{isset($loop->index)?$loop->index:''}}" class = "form">
                                    <td class="text-center line-height-2">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" id='{{$loop->index}}' value='#purchase_item_{{$loop->index}}' class='special-radio'  checked="" /></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open(array('url' => array('admin/customer_item/delete_item',$customer_item->id), 'method' => 'DELETE','id'=>'delform'.$customer_item->id)) !!}
                                        <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this item ?');
                                                                            if (res == true){document.getElementById('delform{{$customer_item->id}}').submit();
                                                                                                                        settimeout(function(){$('table #customer_item{{$loop->index}}').remove(); }, 1000); }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>                                        
                                        @if(isset($customer_item->status))
                                        @if($customer_item->status == 'active')
                                        <input type="image" src="{{asset('vendors/common/img/green.png')}}" alt="" value="active"  onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>

                                        @else
                                        <input type="image" src="{{asset('vendors/common/img/red.png')}}" alt="" value="inactive" onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>
                                        @endif
                                        @endif    
                                    </td>
                                    <td>
                                        {!!Form::text('item_no',isset($customer_item->item_no) ? $customer_item->item_no : 10,array('class'=>'form-control padding-input border-radius-0 width-70','min'=>0))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material',$material,isset($customer_item->material)? $customer_item->material:'',array('class'=>'form-control material select2 border-radius-0','placeholder'=>'Please select Material','id'=>'material'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('material_description',isset($customer_item->material_description)? $customer_item->material_description:'',array('class'=>'form-control border-radius-0 no-resize','placeholder'=>'Enter Description','maxlength'=>50))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('customer_material_no',isset($customer_item->customer_material_no)? $customer_item->customer_material_no:'',array('class'=>'form-control border-radius-0','placeholder'=>'Please select customer material no.'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('order_qty',isset($customer_item->order_qty)? $customer_item->order_qty:'',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter Quantity','id'=>'order_qty'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('cost_unit',isset($customer_item->cost_unit)? $customer_item->cost_unit:'',array('class'=>'form-control border-radius-0 padding-input totalamt','placeholder'=>'Please enter cost per unit','id'=>'cost_unit'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('tota_amt',isset($customer_item->tota_amt)? $customer_item->tota_amt:'',array('class'=>'form-control  border-radius-0 padding-input','placeholder'=>'Please enter total amount','readonly'))!!}                                   
                                    </td>
                                    <td>
                                        {!!Form::select('material_group',['Raw Material'=>'Raw Material','Service Material'=>'Service Material'],isset($customer_item->material_group)? $customer_item->material_group:'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Material Group'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('reason',$reasonRejection,isset($customer_item->reason) ? $customer_item->reason : '',array('class'=>'form-control select2  border-radius-0','placeholder'=>'Please select Reason for Rejection'))!!}
                                    </td>
                                    {!!Form::hidden('project_id',$customer_item->project_id)!!}
                                    {!!Form::hidden('phaseid',$customer_item->phaseid)!!}
                                    {!!Form::hidden('task',$customer_item->task)!!}
                                    {!!Form::hidden('cost_center',$customer_item->cost_center)!!}
                                    {!!Form::hidden('processing_status',$customer_item->processing_status)!!}
                                    {!!Form::hidden('company_name',$customer_item->company_name)!!}
                                    {!!Form::hidden('contact_person_name',$customer_item->contact_person_name)!!}
                                    {!!Form::hidden('phone_no',$customer_item->phone_no)!!}
                                    {!!Form::hidden('inquiry_number',$customer_inquiry->inquiry_number)!!}
                                    {!!Form::hidden('short_description',$customer_item->short_description)!!}
                                    {!!Form::hidden('requested_by',$customer_item->requested_by)!!}
                                    {!!Form::hidden('gross_price',$customer_item->gross_price)!!}
                                    {!!Form::hidden('discount',$customer_item->discount)!!}
                                    {!!Form::hidden('discount_amt',$customer_item->discount_amt)!!}
                                    {!!Form::hidden('discount_gross_price',$customer_item->discount_gross_price)!!}
                                    {!!Form::hidden('sales_tax',$customer_item->sales_tax)!!}
                                    {!!Form::hidden('sales_taxamt',$customer_item->sales_taxamt)!!}
                                    {!!Form::hidden('net_price',$customer_item->net_price)!!}
                                    {!!Form::hidden('freight_charges',$customer_item->freight_charges)!!}
                                    {!!Form::hidden('total_price',$customer_item->total_price)!!}
                                </tr>
                                @endforeach  
                                @endif
                            </tbody>
                        </table>
                        <div id="hidden_row" style="display:none;">
                            <table class="table table-list table-responsive margin-top-15 margin-bottom-40">
                                <thead>
                                    <tr>    
                                        <th>Select</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                        <th>Item No.</th>                                    
                                        <th>Material</th>
                                        <th>Material Description</th>
                                        <th>Customer Material NO.</th>
                                        <th>Order Quantity*</th>
                                        <th>Cost per unit*</th>
                                        <th>Total Amount*</th>
                                        <th>Material Group</th>
                                        <th>Reason For Rejection</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id='purchase_hidden_row' class = "form">
                                        <td class="text-center line-height-2">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio" id=''/></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this customer item'); }" class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        </td> 
                                        <td>                                        
                                            <input type="image" src="{{asset('vendors/common/img/red.png')}}" alt="" value="inactive" onclick=" event.preventDefault(); if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">
                                        </td>
                                        <td>
                                            {!!Form::text('item_no','10',array('class'=>'form-control padding-input border-radius-0 width-70','min'=>0))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('material',$material,'',array('class'=>'form-control  border-radius-0 material','placeholder'=>'Please select Material','id'=>'material'))!!}
                                        </td>
                                        <td>
                                            {!!Form::text('material_description','',array('class'=>'form-control border-radius-0 no-resize','placeholder'=>'Enter Description','maxlength'=>50))!!}
                                        </td>
                                        <td>
                                            {!!Form::text('customer_material_no','',array('class'=>'form-control border-radius-0','placeholder'=>'Please select customer material no.'))!!}
                                        </td>
                                        <td>
                                            {!!Form::text('order_qty','',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter Quantity','id'=>'order_qty'))!!}
                                        </td>
                                        <td>
                                            {!!Form::text('cost_unit','',array('class'=>'form-control border-radius-0 padding-input totalamt','placeholder'=>'Please enter cost per unit','id'=>'cost_unit'))!!}
                                        </td>
                                        <td>
                                            {!!Form::text('tota_amt','',array('class'=>'form-control  border-radius-0 padding-input','placeholder'=>'Please enter total amount','readonly'))!!}                                   
                                        </td>
                                        <td>
                                            {!!Form::select('material_group',['Raw Material'=>'Raw Material','Service Material'=>'Service Material'],'',array('class'=>'form-control  border-radius-0','placeholder'=>'Please select Material Group'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('reason',$reasonRejection,'',array('class'=>'form-control  border-radius-0','placeholder'=>'Please select Reason for Rejection'))!!}
                                        </td>
                                        {!!Form::hidden('project_id')!!}
                                        {!!Form::hidden('phaseid')!!}
                                        {!!Form::hidden('task')!!}
                                        {!!Form::hidden('cost_center')!!}
                                        {!!Form::hidden('processing_status')!!}
                                        {!!Form::hidden('company_name')!!}
                                        {!!Form::hidden('contact_person_name')!!}
                                        {!!Form::hidden('phone_no')!!}
                                        {!!Form::hidden('inquiry_number',$customer_inquiry->inquiry_number)!!}
                                        {!!Form::hidden('short_description')!!}
                                        {!!Form::hidden('requested_by')!!}
                                        {!!Form::hidden('gross_price')!!}
                                        {!!Form::hidden('discount')!!}
                                        {!!Form::hidden('discount_amt')!!}
                                        {!!Form::hidden('discount_gross_price')!!}
                                        {!!Form::hidden('sales_tax')!!}
                                        {!!Form::hidden('sales_taxamt')!!}
                                        {!!Form::hidden('net_price')!!}
                                        {!!Form::hidden('freight_charges')!!}
                                        {!!Form::hidden('total_price')!!}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ppm-tabpane">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#Condition" role="tab">Inquiry Item Text</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#inquiry" role="tab">Item Pricing Condition</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#accassign" role="tab">Account Assignment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#status" role="tab">Status</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#deladdress" role="tab">Delivery Address</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#administration" role="tab">Administration</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <form id="Purchase_requisition_two">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="Condition" role="tabpanel">
                                        <div class="tab-header-title">
                                            Inquiry Short Description
                                        </div>
                                        <div class="tab-block">
                                            <div class="form-group row">
                                                {!!Form::textarea('short_description',isset($itemData->short_description) ? $itemData->short_description : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter inquiry short description'))!!}                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="inquiry" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Gross price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('gross_price',isset($itemData->gross_price) ? $itemData->gross_price : '',array('class'=>'form-control border-radius-0','readonly','placeholder'=>'Gross Price'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('discount_amt',isset($itemData->discount_amt) ? $itemData->discount_amt : '',array('class'=>'form-control border-radius-0','placeholder'=>'Discount amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Tax*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('sales_tax',isset($itemData->sales_tax) ? $itemData->sales_tax : '',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter sales tax','id'=>'sales_tax'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Net Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('net_price',isset($itemData->net_price) ? $itemData->net_price : '',array('class'=>'form-control border-radius-0','placeholder'=>'Net price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Total price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('total_price',isset($itemData->total_price) ? $itemData->total_price : '',array('class'=>'form-control border-radius-0','placeholder'=>'Total price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('discount',isset($itemData->discount) ? $itemData->discount : '',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter discount','id'=>'discount'))!!}
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount Gross Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('discount_gross_price',isset($itemData->discount_gross_price) ? $itemData->discount_gross_price : '',array('class'=>'form-control border-radius-0','placeholder'=>'Discount gross price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Tax Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('sales_taxamt',isset($itemData->sales_taxamt) ? $itemData->sales_taxamt : '',array('class'=>'form-control border-radius-0','placeholder'=>'Sales tax amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Freight charges:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('freight_charges',isset($itemData->freight_charges) ? $itemData->freight_charges : '',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter freight charges'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="accassign" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Id*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('project_id',$pid,isset($itemData->project_id) ? $itemData->project_id : '',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Project Id','id'=>'project'))!!}
                                                            @if($errors->has('project_id')) 
                                                            <div style='color:red'>
                                                                {{ $errors->first('project_id') }}
                                                            </div> 
                                                            @endif   
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task Id*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('task',$tid,isset($itemData->task) ? $itemData->task : '',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please enter task','min'=>0,'id'=>'task'))!!}
                                                            @if($errors->has('task')) 
                                                            <div style='color:red'>
                                                                {{ $errors->first('task') }}
                                                            </div> 
                                                            @endif   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phase ID:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('phaseid',$phase_ids,isset($itemData->phaseid) ? $itemData->phaseid : '',array('class'=>'form-control select2','placeholder'=>'Please select Phase Id','id'=>'phase'))!!}
                                                            @if($errors->has('phaseid')) 
                                                            <div style='color:red'>
                                                                {{ $errors->first('phaseid') }}
                                                            </div> 
                                                            @endif 
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Cost Centre:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('cost_center',$cost,isset($itemData->cost_center) ? $itemData->cost_center : '',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select cost center'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="status" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="form-group row padding-bottom-20">
                                                <label class="col-sm-3 control-label">Processing Status:</label>
                                                <div class="col-sm-5">
                                                    {!!Form::select('processing_status',['Created'=>'Created','In progress'=>'In progress','Closed'=>'Closed'],isset($itemData->processing_status) ? $itemData->processing_status : '',array('class'=>'form-control select2','placeholder'=>'Please select Processing Status'))!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="deladdress" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Company Name* :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('company_name',isset($itemData->company_name) ? $itemData->company_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter company name'))!!}  
                                                            @if($errors->has('company_name')) 
                                                            <div style='color:red'>
                                                                {{ $errors->first('company_name') }}
                                                            </div> 
                                                            @endif                                
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Phone No:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('phone_no',isset($itemData->phone_no) ? $itemData->phone_no : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter contact person phone no'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Person Name :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('contact_person_name',isset($itemData->contact_person_name) ? $itemData->contact_person_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter contact person name'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="administration" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Created On* :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('created_on',isset($customer_inquiry->created_on) ? $customer_inquiry->created_on : '',array('class'=>'form-control border-radius-0','readonly'))!!}  
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Changed On* :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('changed_on',isset($customer_inquiry->changed_on) ? $customer_inquiry->changed_on : '',array('class'=>'form-control border-radius-0','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Created By* :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('created_by',isset($created_by->name) ? $created_by->name : '',array('class'=>'form-control border-radius-0','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Changed By* :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('changed_by',isset($changed_by->name) ? $changed_by->name : '',array('class'=>'form-control border-radius-0','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div> 
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="card-footer card-footer-box">
            <div class='error-message' style='display:none;'> </div>       
            {!! Form::button('Save Changes',array('class'=>'btn btn-primary card-btn','id'=>'btn_save')) !!}  
            <a href="{{url('/admin/customer_inquiry')}}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</section>
<!-- End Dashboard -->

<!-- Page Scripts -->
<script type="text/javascript">
                                                                    $.ajaxSetup({async:false});
                                                                    var task_ids = @php echo json_encode($tid); @endphp;
                                                                    var phase_ids = @php echo json_encode($phase_ids); @endphp;
                                                                    var project_ids = @php echo json_encode($pid); @endphp;
                                                                    var errortable = {
                                                                    'inquiry_description': 'Header Note',
                                                                            'inquiry_type' : 'Header Details',
                                                                            'customer' : 'Header Details',
                                                                            'sales_region' : 'Header Details',
                                                                            'sales_organization' : 'Header Details',
                                                                            'order_qty' : 'Item',
                                                                            'cost_unit' : 'Item',
                                                                            'short_description' : 'Inquiry Item Text',
                                                                            'discount' : 'Item Pricing Condition',
                                                                            'sales_tax' : 'Item Pricing Condition',
                                                                            'freight_charges' : 'Item Pricing Condition',
                                                                            'project_id' : 'Account Assignment',
                                                                            'phaseid' : 'Account Assignment',
                                                                            'task' : 'Account Assignment',
                                                                            'processing_status' : 'Status',
                                                                            'company_name' : 'Delivery Address'
                                                                    };
                                                                    (function () {

                                                                    $('#btn_save').click(function (evt) {
                                                                    $('#mask').show();
                                                                            document.querySelector('.error-message').innerHTML = "";
                                                                            var purchase_one = $('#cutomer_inquiry').serializeArray();
                                                                            var purchase_two = $('#Purchase_requisition_three').serializeArray();
                                                                            var rows = document.querySelectorAll('#purchase_item_form tr.form');
                                                                            //
                                                                            var elementdata = [];
                                                                            $(rows).each(function (i, val) {
                                                                    elementdata[i] = {};
                                                                            var elements = $('#' + val.id + ' input');
                                                                            $(elements).each(function (j, ele) {
                                                                    elementdata[i][ele.name] = ele.value;
                                                                    })

                                                                            elements = $('#' + val.id + ' select');
                                                                            $(elements).each(function (j, ele) {
                                                                    elementdata[i][ele.name] = ele.value;
                                                                    })

                                                                            elements = $('#' + val.id + ' textarea')
                                                                            $(elements).each(function (j, ele) {
                                                                    elementdata[i][ele.name] = ele.value;
                                                                    })

                                                                    });
                                                                            console.log(elementdata);
                                                                            var data = [];
                                                                            data.push(purchase_one);
                                                                            data.push(purchase_two);
                                                                            console.log(data);
                                                                            var obj = {};
                                                                            for (var i = 0; i < data.length; i++) {
                                                                    for (x in data[i]) {
                                                                    if (typeof (data[i][x]) == 'object' && data[i][x][name] !== 'undefined')
                                                                            obj[data[i][x].name] = data[i][x].value;
                                                                    }
                                                                    console.log(data[i]);
                                                                    }
                                                                    console.log(obj);
                                                                            var token = $('input[name^=_token]').val();
                                                                            $.ajax({
                                                                            url: "{{url('/admin/customer_inquiry/update/'.$id)}}",
                                                                                    method: "POST",
                                                                                    data: {'_token': token, obj, elementdata},
                                                                                    dataType: "JSON "
                                                                            }).done(function (msg) {
                                                                    if ('redirect_url' in msg)
                                                                    {
                                                                    window.location.href = location.origin + '/' + msg['redirect_url'];
                                                                            $('#mask').hide();
                                                                            $('.error-message').hide();
                                                                    } else
                                                                    {
                                                                    var new_msg = JSON.stringify(msg).replace('[', '').replace(']', '');
                                                                            new_msg = JSON.parse(new_msg);
                                                                            $.each(new_msg, function (key, element) {
                                                                            console.log(element);
                                                                                    $('[name^=' + key + ']')
                                                                                    .each(
                                                                                            function ()
                                                                                            {
                                                                                            if ($(this).val() == '')
                                                                                            {
                                                                                            $(this).css("border", "red solid 1px");
                                                                                            } else {
                                                                                            $(this).css("border", "#ccc solid 1px");
                                                                                            }
                                                                                            });
                                                                                    if (key in errortable)
                                                                                    $('.error-message').append("<p style='color:red' class='text-center' >" + element + " in " + errortable[key] + " Tab </p>");
                                                                                    else
                                                                                    $('.error-message').append("<p style='color:red' class='text-center' >" + element + "</p>");
                                                                                    $('#mask').hide();
                                                                                    $('.error-message').show();
                                                                            });
                                                                    }
                                                                    });
                                                                    });
                                                                            $('#add_row').click(function (evt) {
                                                                    var id = document.querySelectorAll('#purchase_item_form tr').length;
                                                                            var dummy = 1;
                                                                            if (id != 0)
                                                                            dummy = parseInt($('#purchase_item_form tr').eq(id - 1).attr('id').split('_')[2]) + 1;
                                                                            var row = $('#purchase_hidden_row').html();
                                                                            console.log(dummy);
                                                                            row = '<tr id="purchase_item_' + dummy + '" class ="form" >' + row + '</tr>';
                                                                            $('#purchase_item_form').append(row);
                                                                            document.querySelector('#purchase_item_' + dummy + ' >td [type^=radio]').value = '#purchase_item_' + dummy;
                                                                            document.querySelector('#purchase_item_' + dummy + ' >td [type^=radio]').id = dummy;
                                                                            $('#' + dummy).on('change', function(evt){
                                                                    var _item_number = $(this).val();
                                                                            $('select[name=phaseid]').html('');
                                                                            $('select[name=task]').html('');
                                                                            $('select[name=phaseid]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Phase Id</option>');
                                                                            $('select[name=task]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Task Id</option>');
                                                                            for (x in phase_ids){
                                                                    $('select[name=phaseid]').append('<option value="' + x + '" > ' + phase_ids[x] + '</option>');
                                                                    }
                                                                    for (x in task_ids){
                                                                    $('select[name=task]').append('<option value="' + x + '" > ' + task_ids[x] + '</option>');
                                                                    }

                                                                    document.querySelector('#Purchase_requisition_two').reset();
                                                                            $(_item_number + ' [type^=hidden]').each(
                                                                            function(i, ele){
                                                                            if (document.querySelector('#Purchase_requisition_two [name=' + ele.name + ']') != null)
                                                                            {console.log(document.querySelector('#Purchase_requisition_two [name=' + ele.name + ']'));
                                                                                    $('#Purchase_requisition_two [name=' + ele.name + ']').val(ele.value);
                                                                            }
                                                                            else if (document.querySelector('#Purchase_requisition_three [name=' + ele.name + ']') != null)
                                                                            {console.log($('#Purchase_requisition_three [name=' + ele.name + ']'));
                                                                                    $('#Purchase_requisition_three [name=' + ele.name + ']').val(ele.value);
                                                                            }

                                                                            });
                                                                            $('#project,#phase,#task').selectpicker('refresh');
                                                                            $('#Purchase_requisition_two .select2').trigger('change.select2');
                                                                            //getTotal();
                                                                    });
                                                                            document.querySelector('#purchase_item_' + id + ' >td>a').onclick = function (event) {
                                                                    var res = confirm('Are you sure you want to delete this customer inquiry item');
                                                                            if (res)
                                                                            $('table #purchase_item_' + id).remove();
                                                                    };
                                                                            $('#purchase_item_' + id + ' .totalamt').on('change',
                                                                            function(evt){ calculate(evt);
                                                                            }
                                                                    );
                                                                            $('#purchase_item_' + id + ' [name=order_qty],[name="cost_unit"]').on('change', function () {
                                                                    if (!isNaN($(this).val()))
                                                                    {
                                                                    if (parseInt($(this).val()) < 0)
                                                                    {
                                                                    $(this).val( - parseInt($(this).val()));
                                                                    }
                                                                    }
                                                                    });
                                                                            //get Material Description based on material no
                                                                            $('#purchase_item_' + id + ' [name=material]').change(function () {

                                                                    var mid = $('#purchase_item_' + id + ' [name=material]').val();
                                                                            if (mid != '') {
                                                                    $.ajax({
                                                                    type: 'GET',
                                                                            url: '/admin/getMaterialDesc/' + mid,
                                                                            dataType: "json",
                                                                            success: function (response) {
                                                                            console.log(response);
                                                                                    $("#purchase_item_" + id + " input[name = 'material_description']").prop('readonly', true);
                                                                                    $("#purchase_item_" + id + " input[name = 'material_description']").val(response.data.material_description);
                                                                            }
                                                                    });
                                                                    }
                                                                    });
                                                                            if (id != 0)
                                                                    {
                                                                    $('#purchase_item_' + dummy + ' [name^=item_no]').val(parseInt($('#purchase_item_form tr').eq(id - 1).find('[name^=item_no]').val()) + 10);
                                                                    }
                                                                    else
                                                                    {
                                                                    $('#purchase_item_' + dummy + ' [name^=item_no]').val('10');
                                                                    }
                                                                    $('#purchase_item_' + id + ' select').addClass('select2');
                                                                            $("select.select2").select2();
                                                                            $('.datepicker-only-init').datetimepicker({


                                                                    widgetPositioning: {
                                                                    horizontal: 'left'
                                                                    },
                                                                            icons: {
                                                                            time: "fa fa-clock-o",
                                                                                    date: "fa fa-calendar",
                                                                                    up: "fa fa-arrow-up",
                                                                                    down: "fa fa-arrow-down"
                                                                            },
                                                                            format: 'YYYY-MM-DD'
                                                                    });
                                                                    });
                                                                    })();
                                                                    // on radio button select 
                                                                    $('.special-radio').on('change', function(evt){
                                                            var _item_number = $(this).val();
                                                                    $('select[name=phaseid]').html('');
                                                                    $('select[name=task]').html('');
                                                                    $('select[name=phaseid]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Phase Id</option>');
                                                                    $('select[name=task]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Task Id</option>');
                                                                    for (x in phase_ids){
                                                            $('#phase').append('<option value="' + x + '" > ' + phase_ids[x] + '</option>');
                                                            }
                                                            for (x in task_ids){
                                                            $('#task').append('<option value="' + x + '" > ' + task_ids[x] + '</option>');
                                                            }

                                                            document.querySelector('#Purchase_requisition_two').reset();
                                                                    $(_item_number + ' [type^=hidden]').each(
                                                                    function(i, ele){
                                                                    console.log(ele);
                                                                            if (document.querySelector('#Purchase_requisition_two [name=' + ele.name + ']') != null)
                                                                    {console.log(ele);
                                                                            $('#Purchase_requisition_two [name=' + ele.name + ']').val(ele.value);
                                                                    }
                                                                    else if (document.querySelector('#Purchase_requisition_three [name=' + ele.name + ']') != null)
                                                                    {console.log(ele);
                                                                            $('#Purchase_requisition_three [name=' + ele.name + ']').val(ele.value);
                                                                    }

                                                                    });
                                                                    $('#project,#phase,#task').selectpicker('refresh');
                                                                    $('#Purchase_requisition_two .select2').trigger('change.select2');
                                                            });
                                                                    function extend(obj, src) {

                                                                    for (var key in src) {
                                                                    if (src.hasOwnProperty(key))
                                                                            obj[key] = src[key];
                                                                    }
                                                                    return obj;
                                                                    }
                                                            $('#Purchase_requisition_two [name^=project_id],#Purchase_requisition_two [name^=phaseid],#Purchase_requisition_two [name^=task], #Purchase_requisition_two [name^=cost_center],#Purchase_requisition_two [name^=processing_status],#Purchase_requisition_two [name^=customer],#Purchase_requisition_two [name^=company_name],#Purchase_requisition_two [name^=contact_person_name],#Purchase_requisition_two [name^=phone_no],#Purchase_requisition_two [name^=inquiry_type],#Purchase_requisition_two [name^=sales_region],#Purchase_requisition_two [name^=short_description], #Purchase_requisition_two [name^=weight],#Purchase_requisition_two [name^=unit],#Purchase_requisition_two [name^=requested_by],#Purchase_requisition_two [name^=invoice_number]')
                                                                    .on('change', function(evt){

                                                                    var _ele_name = evt.target.name;
                                                                            var _item_number = $('[name^=optradio]:checked').val();
                                                                            console.log(_item_number);
                                                                            $(_item_number + ' [name^=' + _ele_name + ']').val(this.value);
                                                                    });

</script>
@endsection
