@extends('layout.adminlayout')
@section('title','Create Quotation')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-danger mesg">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
<!-- Quotation-->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/quotation.js') !!}
<!-- Quotation-->
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
    <div id="myModalNeg" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Negative value is not allow.</p>
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
                @if($errors->has('quotation_number')) 
                <script>
                    $('.mesg').hide();</script>
                <div class="alert alert-danger">
                    <ul>
                        {{ $errors->first('quotation_number')}}
                    </ul>
                </div>
                @endif
                <div class="margin-bottom-50">
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            You are here : <a href="javascript: void(0);" style="margin-left: 10px;">Sales Order</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/quotation')}}">Quotation</a>
                        </li>
                        <li>
                            <span>Create Quotation</span>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header card-header-box bg-lightcyan">
                        <h4 class="margin-0">Create Quotation</h4>
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
                            {{ csrf_field() }} 
                            <form id="quotation" method="post" name="quotation" class="quotation">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="inquiry-desc" role="tabpanel">
                                        <div class="tab-header-title">
                                            Quotation Detailed Description
                                        </div>
                                        <div class="tab-block">
                                            <div class="form-group row">
                                                {!!Form::textarea('quotation_description','',array('class'=>'form-control header_note  border-radius-0 no-resize','placeholder'=>'Please enter quotation detailed description','maxlength'=>255))!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="header_item" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Number*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('quotation_number',$quotation_number,array('class'=>'form-control border-radius-0','readonly'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Customer*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::select('customer',$customer_id,'',array('class'=>'form-control border-radius-0 select2 customer','placeholder'=>'Please select customer','id'=>'customer'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Organization*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('sales_organization',$salesorg,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select sales organization','id'=>'sales_organization'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Inquiry Number*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('inquiry',$inquiry_no,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select inquiry number','id'=>'inquiry_no'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"> 
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Type*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">                                               
                                                                {!!Form::select('quotation_type',array('Product Quotation'=>'Product Quotation','Service Quotation'=>'Service Quotation','Support Quotation'=>'Support Quotation','Project Quotation'=>'Project Quotation'),'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select quotation type','id'=>'quotation_type'))!!}                                   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Customer Name :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('customer_name','',array('class'=>'form-control border-radius-0','placeholder'=>'Customer name','readonly'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Region*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('sales_region',$salesregion,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select sales region','id'=>'sales_region'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Requested By:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('requested_by',$requestedby,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select requested by','id'=>'requested_by'))!!}  
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
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Gross Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('quotation_gross_price','',array('class'=>'form-control border-radius-0','readonly','placeholder'=>'Gross Price'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Profit Margin Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('quotation_profit_amt','',array('class'=>'form-control border-radius-0','placeholder'=>'Profit margin amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('quotation_discount','',array('class'=>'form-control border-radius-0','placeholder'=>'Discount','readonly'))!!}
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount Gross Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('quotation_discount_gross_price','',array('class'=>'form-control border-radius-0','placeholder'=>'Discount gross price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Net Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('quotation_net_price','',array('class'=>'form-control border-radius-0','placeholder'=>'Net price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Total Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('quotation_total_price','',array('class'=>'form-control border-radius-0','placeholder'=>'Total price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Profit Margin :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('quotation_profit_margin','',array('class'=>'form-control border-radius-0','placeholder'=>'Profit margin','readonly'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Profit Margin Gross Price :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('quotation_profit_margin_grossprice','',array('class'=>'form-control border-radius-0','placeholder'=>'Profit margin gross price','readonly'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('quotation_discount_amt','',array('class'=>'form-control border-radius-0','placeholder'=>'Discount amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Tax Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('quotation_sales_taxamt','',array('class'=>'form-control border-radius-0','placeholder'=>'Sales tax amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Freight Charges:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('quotation_freight_charges','',array('class'=>'form-control border-radius-0','placeholder'=>'freight charges','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!!Form::hidden('quotation_number',$quotation_number,array('class'=>'form-control border-radius-0','readonly'))!!}
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
                                    <th>Total Amount</th>
                                    <th>Material Group</th>
                                    <th>Reason For Rejection</th>
                                </tr>
                            </thead>
                            <tbody id='purchase_item_form'>
                                {!! Form::button('Add Item',array('class'=>'btn btn-warning width-100','id'=>'add_row')) !!}  
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
                                    <td class="text-center">                                                                          
                                        <input type="image" src="{{asset('vendors/common/img/red.png')}}" alt="" value="inactive" onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">
                                    </td>
                                    <td>
                                        {!!Form::text('item_no','10',array('class'=>'form-control padding-input border-radius-0 width-70','min'=>0))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material',$material,'',array('class'=>'form-control material select2 border-radius-0','placeholder'=>'Please select Material','id'=>'material'))!!}
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
                                        {!!Form::select('material_group',['Raw Material'=>'Raw Material','Service Material'=>'Service Material'],'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Material Group'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('reason',$reasonRejection,'',array('class'=>'form-control select2  border-radius-0','placeholder'=>'Please select Reason for Rejection'))!!}
                                    </td>
                                    {!!Form::hidden('project_id')!!}
                                    {!!Form::hidden('phaseid')!!}
                                    {!!Form::hidden('task')!!}
                                    {!!Form::hidden('cost_center')!!}
                                    {!!Form::hidden('processing_status')!!}
                                    {!!Form::hidden('company_name')!!}
                                    {!!Form::hidden('contact_person_name')!!}
                                    {!!Form::hidden('phone_no')!!}
                                    {!!Form::hidden('quotation_number',$quotation_number)!!}
                                    {!!Form::hidden('short_description')!!}
                                    {!!Form::hidden('requested_by')!!}
                                    {!!Form::hidden('gross_price')!!}
                                    {!!Form::hidden('profit_margin')!!}
                                    {!!Form::hidden('profit_amt')!!}
                                    {!!Form::hidden('profit_gross_price')!!}
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
                                        <th>Total Amount</th>
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
                                            <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this quotation item ?'); }" class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        </td> 
                                        <td class="text-center">                                        
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
                                        {!!Form::hidden('quotation_number',$quotation_number)!!}
                                        {!!Form::hidden('short_description')!!}
                                        {!!Form::hidden('requested_by')!!}
                                        {!!Form::hidden('gross_price')!!}
                                        {!!Form::hidden('profit_margin')!!}
                                        {!!Form::hidden('profit_amt')!!}
                                        {!!Form::hidden('profit_gross_price')!!}
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
                                    <a class="nav-link active" data-toggle="tab" href="#Condition" role="tab">Quotation Item Text</a>
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
                                            Quotation Short Description
                                        </div>
                                        <div class="tab-block">
                                            <div class="form-group row">
                                                {!!Form::textarea('short_description','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter quotation short description'))!!}</div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="inquiry" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Gross Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('gross_price','',array('class'=>'form-control border-radius-0','placeholder'=>'Gross Price','readonly'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Profit Margin Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('profit_amt','',array('class'=>'form-control border-radius-0','placeholder'=>'Profit margin amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('discount','',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter discount','id'=>'discount'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount Gross Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('discount_gross_price','',array('class'=>'form-control border-radius-0','placeholder'=>'Discount gross price','readonly'))!!}  
                                                        </div>
                                                    </div>                                                   
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Tax Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('sales_taxamt','',array('class'=>'form-control border-radius-0','placeholder'=>'Sales tax amount','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Freight Charges:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('freight_charges','',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter freight charges'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Profit Margin :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            <div class="form-input-icon">
                                                                {!!Form::text('profit_margin','',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter profit margin','id'=>'profit'))!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Profit Margin Gross Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('profit_gross_price','',array('class'=>'form-control border-radius-0','placeholder'=>'Profit gross price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount Amount:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('discount_amt','',array('class'=>'form-control border-radius-0','placeholder'=>'Discount amount','readonly'))!!}  
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Tax*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('sales_tax','',array('class'=>'form-control border-radius-0 totalamt','placeholder'=>'Please enter sales tax','id'=>'sales_tax'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Net Price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('net_price','',array('class'=>'form-control border-radius-0','placeholder'=>'Net price','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Total price:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('total_price','',array('class'=>'form-control border-radius-0','placeholder'=>'Total price','readonly'))!!}  
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
                                                            {!!Form::select('project_id',$pid,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Project Id','id'=>'project'))!!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Task Id*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('task',$tid,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please enter task','min'=>0,'id'=>'task'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phase ID*:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('phaseid',$phase_ids,'',array('class'=>'form-control select2','placeholder'=>'Please select Phase Id','id'=>'phase'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Cost Centre:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::select('cost_center',$cost,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select cost center'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="status" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="form-group row padding-bottom-20">
                                                <label class="col-sm-3 control-label">Processing Status*:</label>
                                                <div class="col-sm-5">
                                                    {!!Form::select('processing_status',['Created'=>'Created','In progress'=>'In progress','Closed'=>'Closed'],'',array('class'=>'form-control select2','placeholder'=>'Please select Processing Status'))!!}
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
                                                            {!!Form::text('company_name','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter company name'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Phone No:</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('phone_no','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter contact person phone no'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Person Name :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('contact_person_name','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter contact person name'))!!}  
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
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Created On :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('created_on',$quotation_createdDate,array('class'=>'form-control border-radius-0','readonly'))!!}  
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Changed On :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('changed_on','',array('class'=>'form-control border-radius-0','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Created By :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('created_by','',array('class'=>'form-control border-radius-0','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Changed By :</label>
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                            {!!Form::text('changed_by','',array('class'=>'form-control border-radius-0','readonly'))!!}  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!!Form::hidden('quotation_number',$quotation_number,array('class'=>'form-control border-radius-0','readonly'))!!}
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
            <a href="{{url('/admin/quotation')}}" class="btn btn-danger">Cancel</a>
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
                            'quotation_description': 'Header Note',
                                    'quotation_type' : 'Header Details',
                                    'customer' : 'Header Details',
                                    'sales_region' : 'Header Details',
                                    'sales_organization' : 'Header Details',
                                    'order_qty' : 'Item',
                                    'cost_unit' : 'Item',
                                    'short_description' : 'Quotation Item Text',
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
                                    var purchase_one = $('#quotation').serializeArray();
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
                                    url: "{{url('/admin/quotation/store')}}",
                                            method: "POST",
                                            data: {'_token': token, 'obj':obj, 'elementdata':elementdata},
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
                                                    //$(this).css("border", "red solid 1px");
                                                    } else {
                                                    //$(this).css("border", "#ccc solid 1px");
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
//                                    $('select[name=phaseid]').html('');
//                                    $('select[name=task]').html('');
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
                            var res = confirm('Are you sure you want to delete this quotation item');
                                    if (res)
                                    $('table #purchase_item_' + id).remove();
                            };
                                    $('#purchase_item_' + id + ' [name=order_qty],[name="cost_unit"]').on('change', function () {
                            if (!isNaN($(this).val()))
                            {
                            if (parseInt($(this).val()) < 0)
                            {
                            $(this).val( - parseInt($(this).val()));
                            }
                            }
                            });
                                    $('#purchase_item_' + id + ' .totalamt').on('change',
                                    function(evt){ calculate(evt);
                                    }
                            );
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
                            $('#purchase_item_' + id + ' select').addClass('select2-test');
                                    $("select.select2-test").select2();
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
//                            $('select[name=phaseid]').html('');
//                            $('select[name=task]').html('');
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
                    $('#Purchase_requisition_two [name^=project_id],#Purchase_requisition_two [name^=phaseid],#Purchase_requisition_two [name^=task], #Purchase_requisition_two [name^=cost_center],#Purchase_requisition_two [name^=processing_status],#Purchase_requisition_two [name^=customer],#Purchase_requisition_two [name^=company_name],#Purchase_requisition_two [name^=contact_person_name],#Purchase_requisition_two [name^=phone_no],#Purchase_requisition_two [name^=quotation_type],#Purchase_requisition_two [name^=sales_region],#Purchase_requisition_two [name^=short_description], #Purchase_requisition_two [name^=weight],#Purchase_requisition_two [name^=unit],#Purchase_requisition_two [name^=requested_by],#Purchase_requisition_two [name^=invoice_number]')
                            .on('change', function(evt){

                            var _ele_name = evt.target.name;
                                    var _item_number = $('[name^=optradio]:checked').val();
                                    console.log(_item_number);
                                    $(_item_number + ' [name^=' + _ele_name + ']').val(this.value);
                            });

</script>
@endsection
