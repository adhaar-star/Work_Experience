@extends('layout.adminlayout')
@section('title','Edit Purchase Order')
@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}

<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">                   
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            You are here :     <a href="javascript: void(0);">Procurement</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/purchase_order')}}">Purchase Order</a>
                        </li>
                        <li>
                            <span>Edit Purchase Order</span>
                        </li>
                    </ul>
                </div>
                <div class="card card-info-custom">
                    <div class="card-header">
                        <h4 class="margin-bottom-0">Edit Purchase Order | {{$purchase_order->purchase_order_number}}</h4>
                    </div>
                    <div class="card-block">
                        <div class="ppm-tabpane">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#purchase-desc" role="tab">Texts</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                {{ csrf_field() }}                                    
                                <form id="Purchase_requisition_one">
                                    {!!Form::hidden('purchase_order_number',isset($purchase_order->purchase_order_number) ? $purchase_order->purchase_order_number : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter purchase order Number'))!!}
                                    <div class="tab-pane active" id="purchase-desc" role="tabpanel">
                                        <div class="tab-header-title">
                                            Header Note
                                        </div>
                                        <div class="tab-block">
                                            <div class="form-group row">
                                                {!!Form::textarea('header_note',isset($purchase_order->header_note) ? $purchase_order->header_note : '',array('class'=>'form-control border-radius-0 no-resize','placeholder'=>'Please enter Header note','maxlength'=>255))!!}
                                            </div>
                                            <div class="row">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <select class="form-control select2">
                                                            <optgroup>
                                                                <option>Continuous-text editor</option> 
                                                                <option>Continuous-text editor</option> 
                                                                <option>Continuous-text editor</option> 
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- purchase add table -->
                        <table class="table table-list table-responsive margin-top-15">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Delete</th>
                                    <th>Status</th>
                                    <th>Item No.</th>
                                    <th>Item Categories</th>
                                    <th>Item</th>
                                    <th>Item Description</th>
                                    <th>Item Quantity</th>
                                    <th>Quantity</th>
                                    <th>Item Cost</th>
                                    <th>Currency</th>
                                    <th>Delivery</th>
                                    <th>Material Group</th>
                                    <th>Vendor</th>
                                    <th>Requestor</th>
                                    <th>Contract Number</th>
                                    <th>Contract Item Number</th>
                                    <th>Goods Receipt Status</th>
                                    <th>Invoice Verification Status</th>
                                </tr>
                            </thead>
                            <tbody id='purchase_item_form'>
                                {!! Form::button('Add Item',array('class'=>'btn btn-warning width-100','id'=>'add_row')) !!}  
                                @if (count($purchaseorder_item_data)<1)
                                <tr id='purchase_item_0' class = "form">
                                    <td>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" id='0' value='#purchase_item_0' checked=""/></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this purchase item');
                                                    if (res)$('table #purchase_item_0').remove();
                                            }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                    </td> 
                                    <td>                                        
                                        @if(isset($purchaseorder_item->status))
                                        <input type="image" src="{{asset('vendors/common/img/green.png')}}" alt="" value="active"  onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>

                                        @else
                                        <input type="image" src="{{asset('vendors/common/img/red.png')}}" alt="" value="inactive" onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>
                                        @endif    
                                    </td>
                                    <td>
                                        {!!Form::text('item_no',isset($purchaseorder_item->item_no) ? $purchaseorder_item->item_no : 10,array('class'=>'form-control border-radius-0'))!!}

                                    </td>
                                    <td>
                                        {!!Form::select('item_category',['Material'=>'Material','Service'=>'Service','Asset'=>'Asset'],isset($purchaseorder_item->item_category)? $purchaseorder_item->item_category:'',array('class'=>'form-control select2','placeholder'=>'Please select Item Category'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material',$material,isset($purchaseorder_item->material)? $purchaseorder_item->material:'',array('class'=>'form-control select2','placeholder'=>'Please select Material'))!!}
                                    </td>
                                    <td>
                                        {!!Form::textarea('material_description',isset($purchaseorder_item->material_description) ? $purchaseorder_item->material_description : '',array('class'=>'form-control border-radius-0 no-resize resize-textarea','placeholder'=>'Enter Description'))!!}
                                    </td>
                                    <td>
                                        {!!Form::number('item_quantity',isset($purchaseorder_item->item_quantity) ? $purchaseorder_item->quantity : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Quantity','min'=>0,'onchange'=>'{getTotal(event);}'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('quantity_unit',['Liters'=>'Liters','Metric Ton'=>'Metric Ton','Pieces'=>'Pieces'],isset($purchaseorder_item->quantity_unit)? $purchaseorder_item->quantity_unit:'',array('class'=>'form-control select2','placeholder'=>'Please select Quantity Unit'))!!}
                                    </td>
                                    <td>
                                        {!!Form::number('item_cost',isset($purchaseorder_item->item_cost) ? $purchaseorder_item->item_cost : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Item Cost','min'=>0,'onchange'=>'{getTotal(event);}','onkeypress'=>'return isNumber(event)'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('currency',$currency,isset($purchaseorder_item->currency) ? $purchaseorder_item->currency : '',array('class'=>'form-control select2','placeholder'=>'Please enter Item Cost Unit'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('delivery_date',isset($purchaseorder_item->delivery_date) ? $purchaseorder_item->delivery_date : '',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please enter Delivery Date'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material_group',['Raw Material'=>'Raw Material','Service Material'=>'Service Material'],isset($purchaseorder_item->material_group)? $purchaseorder_item->material_group:'',array('class'=>'form-control select2','placeholder'=>'Please select Material Group'))!!}
                                    </td>
                                    <td>     
                                        {!!Form::select('vendor',$vendor,isset($purchaseorder_item->vendor)? $purchaseorder_item->vendor:'',array('class'=>'form-control select2','placeholder'=>'Please select Vendor'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('requestor',$requestedby,isset($purchaseorder_item->requestor) ? $purchaseorder_item->requestor : '',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please enter Requestor id'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('contract_number',['1'=>'1','2'=>'2','3'=>'3'],isset($purchaseorder_item->contract_number)? $purchaseorder_item->contract_number:'',array('class'=>'form-control select2','placeholder'=>'Please select Contract Number'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('contract_item_number',['1'=>'1','2'=>'2','3'=>'3'],isset($purchaseorder_item->contract_item_number)? $purchaseorder_item->contract_item_number:'',array('class'=>'form-control select2','placeholder'=>'Please select Contract Item Number'))!!}
                                    </td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    {!!Form::hidden('project_id')!!}
                                    {!!Form::hidden('phase_id')!!}
                                    {!!Form::hidden('g_l_account')!!}
                                    {!!Form::hidden('task_id')!!}
                                    {!!Form::hidden('cost_center')!!}
                                    {!!Form::hidden('created_by',$created_by)!!}
                                    {!!Form::hidden('changed_by',$changed_by)!!}
                                    {!!Form::hidden('created_on',date('Y-m-d',strtotime('today')))!!}
                                    {!!Form::hidden('processing_status')!!}
                                    {!!Form::hidden('name')!!}
                                    {!!Form::hidden('add1')!!}
                                    {!!Form::hidden('add2')!!}
                                    {!!Form::hidden('postal_code')!!}
                                    {!!Form::hidden('country')!!}
                                </tr>
                                @endif

                                @foreach($purchaseorder_item_data as $purchaseorder_item)   
                                <tr id="purchase_item_{{$loop->index}}" class = "form">
                                    <td>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class='special-radio' value='#purchase_item_{{$loop->index}}' @php if($loop->first)echo 'checked'; @endphp /></label>
                                        </div>
                                    </td>
                                    <td class="text-center">

                                        {!! Form::open(array('url' => array('admin/purchaseorder_item/delete_item',$purchaseorder_item->id), 'method' => 'DELETE','id'=>'delform'.$purchaseorder_item->id)) !!}
                                        <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this purchase order item');
                                                                            document.getElementById('delform{{$purchaseorder_item->id}}').submit();
                                                                                                                        settimeout(function(){$('table #purchase_item_{{$loop->index}}').remove(); }, 1000);
                                                                                                                                                                    }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        {!! Form::close() !!}
                                    </td> 

                                    <td>
                                        @if($purchaseorder_item->status=='active')
                                        <input type="image" src="{{asset('vendors/common/img/green.png')}}" alt="" value="active"  onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>

                                        @else
                                        <input type="image" src="{{asset('vendors/common/img/red.png')}}" alt="" value="inactive" onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>
                                        @endif 
                                    </td>
                                    <td>
                                        {!!Form::text('item_no',isset($purchaseorder_item->item_no) ? $purchaseorder_item->item_no :10,array('class'=>'form-control border-radius-0 padding-input'))!!}

                                    </td>
                                    <td>
                                        {!!Form::select('item_category',['Material'=>'Material','Service'=>'Service','Asset'=>'Asset'],isset($purchaseorder_item->item_category)? $purchaseorder_item->item_category:'',array('class'=>'form-control select2','placeholder'=>'Please select Item Category'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material',$material,isset($purchaseorder_item->material)? $purchaseorder_item->material:'',array('class'=>'form-control select2','placeholder'=>'Please select Material'))!!}
                                    </td>
                                    <td>
                                        {!!Form::textarea('material_description',isset($purchaseorder_item->material_description) ? $purchaseorder_item->material_description : '',array('class'=>'form-control padding-input border-radius-0 no-resize resize-textarea','placeholder'=>'Enter Description'))!!}
                                    </td>
                                    <td>
                                        {!!Form::number('item_quantity',isset($purchaseorder_item->item_quantity) ? $purchaseorder_item->item_quantity : '',array('class'=>'form-control border-radius-0 padding-input','placeholder'=>'Please enter Quantity','min'=>0,'onchange'=>'{getTotal(event);}'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('quantity_unit',['Liters'=>'Liters','Metric Ton'=>'Metric Ton','Pieces'=>'Pieces'],isset($purchaseorder_item->quantity_unit)? $purchaseorder_item->quantity_unit:'',array('class'=>'form-control select2','placeholder'=>'Please select Quantity Unit'))!!}
                                    </td>
                                    <td>
                                        {!!Form::number('item_cost',isset($purchaseorder_item->item_cost) ? $purchaseorder_item->item_cost : '',array('class'=>'form-control border-radius-0 padding-input','placeholder'=>'Please enter Item Cost Unit','min'=>0,'onchange'=>'{getTotal(event);}','onkeypress'=>'return isNumber(event)'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('currency',$currency,isset($purchaseorder_item->currency) ? $purchaseorder_item->currency : '',array('class'=>'form-control border-radius-0 padding-input select2','placeholder'=>'Please enter Item Cost'))!!}
                                    </td>
                                    <td>
                                        {!!Form::text('delivery_date',isset($purchaseorder_item->delivery_date) ? $purchaseorder_item->delivery_date : '',array('class'=>'form-control border-radius-0 padding-input datepicker-only-init','placeholder'=>'Please enter Delivery Date'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material_group',['Raw Material'=>'Raw Material','Service Material'=>'Service Material'],isset($purchaseorder_item->material_group)? $purchaseorder_item->material_group:'',array('class'=>'form-control select2','placeholder'=>'Please select Material Group'))!!}
                                    </td>
                                    <td>     
                                        {!!Form::select('vendor',$vendor,isset($purchaseorder_item->vendor)? $purchaseorder_item->vendor:'',array('class'=>'form-control select2','placeholder'=>'Please select Vendor'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('requestor',$requestedby,isset($purchaseorder_item->requestor) ? $purchaseorder_item->requestor : '',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please enter Requestor id'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('contract_number',['1'=>'1','2'=>'2','3'=>'3'],isset($purchaseorder_item->contract_number)? $purchaseorder_item->contract_number:'',array('class'=>'form-control select2','placeholder'=>'Please select Contract Number'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('contract_item_number',['1'=>'1','2'=>'2','3'=>'3'],isset($purchaseorder_item->contract_item_number)? $purchaseorder_item->contract_item_number:'',array('class'=>'form-control select2','placeholder'=>'Please select Contract Item Number'))!!}
                                    </td>
                                    <td>
                                        @if($purchaseorder_item->item_quantity_gr == 0)
                                        <div class="col-sm-6">
                                            <label class="checkbox"><input type="checkbox" checked disabled/> <span class="padding-left-10">Full</span></label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="checkbox"><input type="checkbox" disabled/> <span class="padding-left-10">Partial</span></label>
                                        </div>
                                        @elseif($purchaseorder_item->item_quantity_gr > 0 && $purchaseorder_item->item_quantity_gr != $purchaseorder_item->item_quantity)
                                        <div class="col-sm-6">
                                            <label class="checkbox"><input type="checkbox" disabled/> <span class="padding-left-10">Full</span></label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="checkbox"><input type="checkbox" checked disabled/> <span class="padding-left-10">Partial</span></label>
                                        </div>
                                        @elseif($purchaseorder_item->item_quantity_gr == $purchaseorder_item->item_quantity)
                                        <div class="col-sm-6">
                                            N/A
                                        </div>   
                                        @endif
                                    </td>
                                    <td>
                                        @if($purchaseorder_item->invoice_status_indicator=='partial')
                                        <div class="col-sm-6">
                                            <label class="checkbox"><input type="checkbox"  disabled/> <span class="padding-left-10">Full</span></label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="checkbox"><input type="checkbox" checked disabled/> <span class="padding-left-10">Partial</span></label>
                                        </div>
                                        @elseif($purchaseorder_item->invoice_status_indicator=='full')
                                        <div class="col-sm-6">
                                            <label class="checkbox"><input type="checkbox" checked disabled/> <span class="padding-left-10">Full</span></label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="checkbox"><input type="checkbox" disabled/> <span class="padding-left-10">Partial</span></label>
                                        </div>
                                        @else
                                        <div class="col-sm-6">
                                            N/A
                                        </div>  
                                        @endif
                                    </td>
                                    {!!Form::hidden('project_id',$purchaseorder_item->project_id)!!}
                                    {!!Form::hidden('phase_id',$purchaseorder_item->phase_id)!!}
                                    {!!Form::hidden('g_l_account',$purchaseorder_item->g_l_account)!!}
                                    {!!Form::hidden('task_id',$purchaseorder_item->task_id)!!}
                                    {!!Form::hidden('cost_center',$purchaseorder_item->cost_center)!!}
                                    {!!Form::hidden('created_by',$purchaseorder_item->created_by)!!}
                                    {!!Form::hidden('changed_by',$purchaseorder_item->changed_by)!!}
                                    {!!Form::hidden('created_on',$purchaseorder_item->created_on)!!}
                                    {!!Form::hidden('processing_status',$purchaseorder_item->processing_status)!!}
                                    {!!Form::hidden('name',$purchaseorder_item->name)!!}
                                    {!!Form::hidden('add1',$purchaseorder_item->add1)!!}
                                    {!!Form::hidden('add2',$purchaseorder_item->add2)!!}
                                    {!!Form::hidden('postal_code',$purchaseorder_item->postal_code)!!}
                                    {!!Form::hidden('country',$purchaseorder_item->country)!!}

                                </tr>
                                @endforeach  

                            </tbody>
                        </table>
                        <div id="hidden_row" style="display:none;">
                            <table class="table table-list table-responsive margin-top-15">
                                <thead>
                                    <tr>
                                        <th>Delete</th>
                                        <th>Status</th>
                                        <th>Item No.</th>
                                        <th>Item Categories</th>
                                        <th>Material</th>
                                        <th>Material Description</th>
                                        <th>Item Quantity</th>
                                        <th>Quantity</th>
                                        <th>Item Cost</th>
                                        <th>Currency</th>
                                        <th>Delivery</th>
                                        <th>Material Group</th>
                                        <th>Vendor</th>
                                        <th>Requestor</th>
                                        <th>Contract Number</th>
                                        <th>Contract Item Number</th>
                                        <th>Goods Receipt Status</th>
                                        <th>Invoice Verification Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id='purchase_hidden_row' class = "form">
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio" name="optradio" id=''/></label>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this purchase item');
                                                                                                                if (res)$('table #purchase_item_0').remove();
                                                                                                        }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                        </td> 
                                        <td>                                        
                                            <input type="image" src="{{asset('vendors/common/img/red.png')}}" alt="" value="inactive" onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                            </input>
                                        </td>
                                        <td>
                                            {!!Form::text('item_no','10',array('class'=>'form-control border-radius-0'))!!}

                                        </td>
                                        <td>
                                            {!!Form::select('item_category',['Material'=>'Material','Service'=>'Service','Asset'=>'Asset'],'',array('class'=>'form-control','placeholder'=>'Please select Item Category'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('material',$material,'',array('class'=>'form-control','placeholder'=>'Please select Material'))!!}
                                        </td>
                                        <td>
                                            {!!Form::textarea('material_description','',array('class'=>'form-control no-resize resize-textarea border-radius-0','placeholder'=>'Please Description'))!!}
                                        </td>
                                        <td>
                                            {!!Form::number('item_quantity','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Quantity','min'=>0,'onchange'=>'{getTotal(event);}'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('quantity_unit',['Liters'=>'Liters','Metric Ton'=>'Metric Ton','Pieces'=>'Pieces'],'',array('class'=>'form-control','placeholder'=>'Please select Quantity Unit'))!!}
                                        </td>
                                        <td>
                                            {!!Form::number('item_cost','',array('class'=>'form-control border-radius-0','min'=>0,'onchange'=>'{getTotal();}','onkeypress'=>'return isNumber(event)'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('currency',$currency,'',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Item Cost Unit'))!!}
                                        </td>
                                        <td>
                                            {!!Form::text('delivery_date','',array('class'=>'form-control datepicker-only-init border-radius-0'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('material_group',['Raw Material'=>'Raw Material','Service Material'=>'Service Material'],'',array('class'=>'form-control border-radius-0','placeholder'=>'Please select Material Group'))!!}
                                        </td>
                                        <td>     
                                            {!!Form::select('vendor',$vendor,'',array('class'=>'form-control border-radius-0','placeholder'=>'Please select Vendor'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('requestor',$requestedby,'',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Requestor id'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('contract_number',['1'=>'1','2'=>'2','3'=>'3'],'',array('class'=>'form-control border-radius-0','placeholder'=>'Please select Contract Number'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('contract_item_number',['1'=>'1','2'=>'2','3'=>'3'],'',array('class'=>'form-control border-radius-0','placeholder'=>'Please select Contract Item Number'))!!}
                                        </td>
                                        <td><div class="col-sm-6">
                                            N/A
                                        </div> </td>
                                        <td><div class="col-sm-6">
                                            N/A
                                        </div> </td>
                                        {!!Form::hidden('project_id')!!}
                                        {!!Form::hidden('phase_id')!!}
                                        {!!Form::hidden('g_l_account')!!}
                                        {!!Form::hidden('task_id')!!}
                                        {!!Form::hidden('cost_center')!!}
                                        {!!Form::hidden('created_by',$created_by)!!}
                                        {!!Form::hidden('changed_by',$changed_by)!!}
                                        {!!Form::hidden('created_on',date('Y-m-d',strtotime('today')))!!}
                                        {!!Form::hidden('processing_status')!!}
                                        {!!Form::hidden('name')!!}
                                        {!!Form::hidden('add1')!!}
                                        {!!Form::hidden('add2')!!}
                                        {!!Form::hidden('postal_code')!!}
                                        {!!Form::hidden('country')!!}
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <div class="ppm-tabpane">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#valuation" role="tab">Valuation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#accassign" role="tab">Account Assignment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#administration" role="tab">Administration</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#status" role="tab">Status</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#deladdress" role="tab">Delivery Address</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <form id="Purchase_requisition_two">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="valuation" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="form-group row">
                                                @if(isset($purchase_order))
                                                @if($purchase_order->gr == 1)
                                                <div class="col-sm-6">
                                                    <label class="checkbox"><input type="checkbox" checked/> <span class="padding-left-10"> Goods Receipt</span></label>
                                                </div>
                                                @else
                                                <div class="col-sm-6">
                                                    <label class="checkbox"><input type="checkbox"/> <span class="padding-left-10"> Goods Receipt</span></label>
                                                </div>
                                                @endif
                                                @endisset
                                                <div class="col-sm-6">
                                                    <label class="checkbox"><input type="checkbox" checked/> <span class="padding-left-10"> Inv.Receipt</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group row padding-bottom-20">
                                                <label class="col-sm-2 control-label">Total Value:</label>
                                                <div class="col-sm-3">
                                                    <input name='total_cost' type="text" class="form-control"  tabindex="-1" aria-hidden="true" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="accassign" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Total Value:</label>
                                                <div class="col-sm-2">
                                                    <input name='total_cost' id="total_cost" type="text" class="form-control"  tabindex="-1" aria-hidden="true">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-5"></div>
                                                <div class="col-sm-7">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Project ID:</label>
                                                        <div class="col-sm-3">
                                                            {!!Form::select('project_id',$project_ids,isset($purchase_order->project_id)?$purchase_order->project_id:'',array('class'=>'form-control select2','placeholder'=>'Please select Project Id','id'=>'project'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Phase ID:</label>
                                                        <div class="col-sm-3">
                                                            {!!Form::select('phase_id',$phase_ids,isset($purchase_order->phase_id)?$purchase_order->phase_id:'',array('class'=>'form-control select2','placeholder'=>'Please select Phase Id','id'=>'phase'))!!}
                                                        </div>
                                                        <label class="col-sm-3 control-label">G/L Account:</label>
                                                        <div class="col-sm-3">
                                                            {!!Form::select('g_l_account',$g_l_account,isset($purchase_order->g_l_account)?$purchase_order->g_l_account:'',array('class'=>'form-control select2','placeholder'=>'Please select G/L account'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Task ID:</label>
                                                        <div class="col-sm-3">
                                                            {!!Form::select('task_id',$task_ids,isset($purchase_order->task_id)?$purchase_order->task_id:'',array('class'=>'form-control select2','placeholder'=>'Please select Task Id','id'=>'task'))!!}
                                                        </div>
                                                        <label class="col-sm-3 control-label">Cost Center:</label>
                                                        <div class="col-sm-3">
                                                            {!!Form::select('cost_center',$cost_center,isset($purchase_order->cost_center)?$purchase_order->cost_center:'',array('class'=>'form-control select2','placeholder'=>'Please select Cost Center'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="administration" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Created By:</label>
                                                <div class="col-sm-4">
                                                    {!!Form::select('created_by',$requestors,'',array('class'=>'form-control select2','disabled'))!!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Created On:</label>
                                                <div class="col-sm-4">
                                                    {!!Form::text('created_on','',array('class'=>'form-control ','disabled'))!!}
                                                </div>
                                            </div>
                                            <div class="form-group row padding-bottom-20">
                                                <label class="col-sm-2 control-label">Changed By:</label>
                                                <div class="col-sm-4">
                                                    {!!Form::select('changed_by',$requestors,'',array('class'=>'form-control select2','disabled'))!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="status" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="form-group row padding-bottom-20">
                                                <label class="col-sm-2 control-label">Processing Status:</label>
                                                <div class="col-sm-5">
                                                    {!!Form::select('processing_status',['Created'=>'Created','Ordered'=>'Ordered','Received'=>'Recevied','Invoiced'=>'Invoiced','Paid'=>'Paid'],'',array('class'=>'form-control select2','placeholder'=>'Please select Processing Status'))!!}

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="deladdress" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Company Name:</label>
                                                <div class="col-sm-4">
                                                    {!!Form::text('name','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Name'))!!}

                                                </div>
                                                <div class="col-sm-6" style="display:none;">
                                                    <button class="btn btn-default pull-right">Address Details</button>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Street/House No.:</label>
                                                <div class="col-sm-4">
                                                    {!!Form::text('add1','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Address'))!!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">District:</label>
                                                <div class="col-sm-4">
                                                    {!!Form::text('add2','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Address'))!!}

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Postal Code:</label>
                                                <div class="col-sm-4">
                                                    {!!Form::text('postal_code','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Postal Code'))!!}
                                                </div>
                                            </div>
                                            <div class="form-group row padding-bottom-20">
                                                <label class="col-sm-2 control-label">Country:</label>
                                                <div class="col-sm-4">
                                                    {!!Form::select('country',$country,'',array('class'=>'form-control select2','placeholder'=>'Please select Country'))!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>     
                        </div>


                        <div class="ppm-tabpane">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#approval" role="tab">Approval</a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <form id="Purchase_requisition_three">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="approval" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="form-group row">
                                                <label class="col-sm-3 control-label">Approver 1:</label>
                                                <div class="col-sm-5">
                                                    {!!Form::select('approver_1',$requestedby,isset($purchase_order->approver_1)? $purchase_order->approver_1:'',array('class'=>'form-control select2','placeholder'=>'Please select Approver 1'))!!}

                                                </div
                                                <span class="col-sm-4 padding-top-10"></span>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 control-label">Approver 2:</label>
                                                <div class="col-sm-5">
                                                    {!!Form::select('approver_2',$requestedby,isset($purchase_order->approver_2)? $purchase_order->approver_2:'',array('class'=>'form-control select2','placeholder'=>'Please select Approver 2'))!!}

                                                </div>
                                                <span class="col-sm-4 padding-top-10"></span>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 control-label">Approver 3:</label>
                                                <div class="col-sm-5">
                                                    {!!Form::select('approver_3',$requestedby,isset($purchase_order->approver_3)? $purchase_order->approver_3:'',array('class'=>'form-control select2','placeholder'=>'Please select Approver 3'))!!}
                                                </div>
                                                <span class="col-sm-4 padding-top-10"></span>

                                            </div>
                                            <div class="form-group row padding-bottom-20">
                                                <label class="col-sm-3 control-label">Approver 4:</label>
                                                <div class="col-sm-5">
                                                    {!!Form::select('approver_4',$requestedby,isset($purchase_order->approver_4)? $purchase_order->approver_4:'',array('class'=>'form-control select2','placeholder'=>'Please select Approver 4'))!!}
                                                </div>
                                                <span class="col-sm-4 padding-top-10"></span>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer card-footer-box">
                                    <div class='error-message' style='display:none;'> </div>    
                                    @if(!isset($purchase_order))
                                    {!! Form::button('Create',array('class'=>'btn btn-primary width-150 card-btn','id'=>'btn_create')) !!}  
                                    @else
                                    {!! Form::button('Save Changes',array('class'=>'btn btn-primary width-150 card-btn','id'=>'btn_save')) !!}  

                                    @endif
                                    <a href="{{url('/admin/purchase_order')}}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>     
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


</section>
<!-- End Dashboard -->

<!-- Page Scripts -->
<script type="text/javascript">
                                                                    $.ajaxSetup({async:false});
                                                                    _evtFlag = true;
                                                                    var task_ids = @php echo json_encode($task_ids); @endphp;
                                                                    var phase_ids = @php echo json_encode($phase_ids); @endphp;
                                                                    var project_ids = @php echo json_encode($project_ids); @endphp;
                                                                    $("textarea[maxlength]").on("propertychange input", function () {
                                                            if (this.value.length > this.maxlength) {
                                                            this.value = this.value.substring(0, this.maxlength);
                                                            }
                                                            });
                                                                    function getTotal(evt) {
                                                                    var total_cost = 0;
                                                                            var item_costs = $('#purchase_item_form tr [name=item_cost]');
                                                                            var item_qtys = $('#purchase_item_form tr [name=item_quantity]');
                                                                            $(item_costs).each(function(i, ele){
                                                                    if (!isNaN(parseInt(ele.value)) && !isNaN(parseInt(item_qtys[i].value)))
                                                                    {
                                                                    console.log(ele);
                                                                            total_cost = parseInt(total_cost) + (parseInt(ele.value) * parseInt(item_qtys[i].value));
                                                                    }
                                                                    });
                                                                            $('[name=total_cost]').val(parseInt(total_cost));
                                                                    }


                                                            (function(){

                                                            var _selected_item = $('[name^=optradio]:checked').val();
                                                                    console.log(_selected_item);
                                                                    $(_selected_item + ' [type^=hidden]').each(function(){

                                                            $('#Purchase_requisition_two [name^=' + this.name + ']').val(this.value);
                                                            });
                                                                    $('#Purchase_requisition_two select.select2').change();
                                                                    getTotal();
                                                            })();
                                                                    var errortable = {'header_note':'Header Note', 'project_id' : 'Account Assignment', 'phase_id':'Account Assignment',
                                                                            'task_id':'Account Assignment',
                                                                            'g_l_account':'Account Assignment',
                                                                            'cost_center':'Account Assignment',
                                                                            'processing_status':'Status',
                                                                            'Approver_1':'Approval',
                                                                            'title':'Delivery Address',
                                                                            'name':'Delivery Address',
                                                                            'postal_code':'Delivery Address',
                                                                            'country':'Delivery Address',
                                                                            'add_1':'Delivery Address - street number '};
                                                                    (function(){

                                                                    $('#btn_save').click(function(evt){
                                                                    $('#mask').show();
                                                                            document.querySelector('.error-message').innerHTML = "";
                                                                            var purchase_one = $('#Purchase_requisition_one').serializeArray();
                                                                            var purchase_two = $('#Purchase_requisition_three').serializeArray();
                                                                            var rows = document.querySelectorAll('#purchase_item_form tr.form'); ;
                                                                            var elementdata = [];
                                                                            $(rows).each(function(i, val){
                                                                    elementdata[i] = {};
                                                                            var elements = $('#' + val.id + ' input');
                                                                            $(elements).each(function(j, ele){
                                                                    elementdata[i][ele.name] = ele.value;
                                                                    })

                                                                            elements = $('#' + val.id + ' select');
                                                                            $(elements).each(function(j, ele){
                                                                    elementdata[i][ele.name] = ele.value;
                                                                    })

                                                                            elements = $('#' + val.id + ' textarea')
                                                                            $(elements).each(function(j, ele){
                                                                    elementdata[i][ele.name] = ele.value;
                                                                    })

                                                                    });
                                                                            console.log(elementdata);
                                                                            var data = [];
                                                                            data.push(purchase_one);
                                                                            data.push(purchase_two);
                                                                            console.log(data);
                                                                            var obj = {};
                                                                            for (var i = 0; i < data.length; i++){
                                                                    for (x in data[i]){
                                                                    if (typeof (data[i][x]) == 'object' && data[i][x][name] !== 'undefined')
                                                                            obj[data[i][x].name] = data[i][x].value;
                                                                    }
                                                                    console.log(data[i]);
                                                                    }
                                                                    console.log(obj);
                                                                            var token = $('input[name^=_token]').val();
                                                                            $.ajax({
                                                                            url: "{{url('/admin/purchase_order/update')}}",
                                                                                    method: "POST",
                                                                                    data: {'_token':token, 'obj':obj, 'elementdata':elementdata},
                                                                                    dataType: "JSON "
                                                                            }).done(function(msg) {
                                                                    if ('redirect_url' in msg)
                                                                    {
                                                                    window.location.href = location.origin + '/' + msg['redirect_url'];
                                                                            $('#mask').hide();
                                                                            $('.error-message').hide();
                                                                    }
                                                                    else
                                                                    { var new_msg = JSON.stringify(msg).replace('[', '').replace(']', '');
                                                                            new_msg = JSON.parse(new_msg);
                                                                            $.each(new_msg, function(key, element){
                                                                            console.log(element);
                                                                                    $('[name^=' + key + ']')
                                                                                    .each(
                                                                                            function()
                                                                                            {
                                                                                            if ($(this).val() == '')
                                                                                            {
                                                                                            $(this).css("border", "red solid 1px");
                                                                                            }
                                                                                            else{
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
                                                                            $('#add_row').click(function(evt){
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
                                                                            //$('select[name=project_id]').html('');
                                                                            $('select[name=phase_id]').html('');
                                                                            $('select[name=task_id]').html('');
                                                                            //$('select[name=project_id]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Project Id</option>');
                                                                            $('select[name=phase_id]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Phase Id</option>');
                                                                            $('select[name=task_id]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Task Id</option>');
                                                                            for (x in phase_ids){
                                                                    $('select[name=phase_id]').append('<option value="' + x + '" > ' + phase_ids[x] + '</option>');
                                                                    }
                                                                    for (x in task_ids){
                                                                    $('select[name=task_id]').append('<option value="' + x + '" > ' + task_ids[x] + '</option>');
                                                                    }

                                                                    document.querySelector('#Purchase_requisition_two').reset();
                                                                            $(_item_number + ' [type^=hidden]').each(
                                                                            function(i, ele){
                                                                            $('#Purchase_requisition_two [name=' + ele.name + ']').val(ele.value);
                                                                                    if ($('#Purchase_requisition_two [name=project_id]').val() == "" && $('#Purchase_requisition_two [name=cost_center]').val() == "")
                                                                            {
                                                                            //blank
                                                                            //$('#Purchase_requisition_two .select2').attr('disabled', 'disabled');
                                                                            }
                                                                            else
                                                                            {
                                                                            if (ele.name == 'cost_center' && ele.value == '')
                                                                            {
                                                                            $('#Purchase_requisition_two #accassign select.select2').removeAttr('disabled');
                                                                                    $('select[name=g_l_account]').removeAttr('disabled');
                                                                                    $('select[name=cost_center]').attr('disabled', 'disabled');
                                                                                    $('select[name=cost_center]').val("");
                                                                                    //$('#Purchase_requisition_two .select2').trigger('change');
                                                                            }
                                                                            if (ele.name == 'project_id' && ele.value == '')
                                                                            {
                                                                            $('#Purchase_requisition_two #accassign select.select2').attr('disabled', 'disabled');
                                                                                    $('select[name=cost_center]').removeAttr('disabled');
                                                                                    $('select[name=g_l_account]').removeAttr('disabled');
                                                                                    $('#Purchase_requisition_two [name^=project_id],#Purchase_requisition_two [name^=phase_id], #Purchase_requisition_two [name^=task_id]').val("")
                                                                            }
                                                                            }
                                                                            });
                                                                            $('#project,#phase,#task').selectpicker('refresh');
                                                                            $('#Purchase_requisition_two .select2').trigger('change.select2');
                                                                            getTotal();
                                                                    });
                                                                            document.querySelector('#purchase_item_' + dummy + ' >td>a').onclick = function(event){
                                                                    var res = confirm('Are you sure you want to delete this purchase item');
                                                                            if (res)$('table #purchase_item_' + dummy).remove();
                                                                    };
                                                                            if (id != 0)
                                                                    {
                                                                    $('#purchase_item_' + dummy + ' [name^=item_no]').val(parseInt($('#purchase_item_form tr').eq(id - 1).find('[name^=item_no]').val()) + 10);
                                                                    }
                                                                    else
                                                                    {
                                                                    $('#purchase_item_' + dummy + ' [name^=item_no]').val('10');
                                                                    }
                                                                    $('#purchase_item_' + dummy + ' select').addClass('select2');
                                                                            $('#purchase_item_' + dummy + ' .select2').select2();
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
                                                                            getTotal();
                                                                    });
                                                                    })();
                                                                    function extend(obj, src) {

                                                                    for (var key in src) {
                                                                    if (src.hasOwnProperty(key)) obj[key] = src[key];
                                                                    }
                                                                    return obj;
                                                                    }


                                                            $("[name*=approver_]").change(function (evt) {

                                                            var parent = evt.target.parentElement.parentElement;
                                                                    var element = parent.querySelector('span.col-sm-4');
                                                                    if (element == undefined || element == null)
                                                            {   return;
                                                                    $('[name=' + evt.target.name + '] span').after('<span class="col-sm-4 padding-top-10"></span>');
                                                            }
                                                            var idPadre = $("[name^=" + evt.target.name + "] option:selected").val();
                                                                    var token = '{{ csrf_token() }}';
                                                                    $.ajax({
                                                                    method: "POST",
                                                                            url: "{{url('admin/getApprovername')}}",
                                                                            data: {id: idPadre, '_token': token}
                                                                    }).done(function (response) {

                                                            element.innerHTML = response.employee_first_name;
                                                            });
                                                            });
                                                                    //  on radio select
                                                                    $('.special-radio').on('change', function(evt){
                                                            var _item_number = $(this).val();
                                                                    $('select[name=phase_id]').html('');
                                                                    $('select[name=task_id]').html('');
                                                                    $('select[name=phase_id]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Phase Id</option>');
                                                                    $('select[name=task_id]').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Please select Task Id</option>');
//                            for (x in project_ids){
//                    $('select[name=project_id]').append('<option value="' + x + '" > ' + project_ids[x] + '</option>');
//                    }
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
                                                                            $('#Purchase_requisition_two [name=' + ele.name + ']').val(ele.value);
                                                                            if ($('#Purchase_requisition_two [name=project_id]').val() == "" && $('#Purchase_requisition_two [name=cost_center]').val() == "")
                                                                    {
                                                                    //blank
                                                                    //$('#Purchase_requisition_two .select2').attr('disabled', 'disabled');
                                                                    }
                                                                    else
                                                                    {
                                                                    if (ele.name == 'cost_center' && ele.value == '')
                                                                    {
                                                                    $('#Purchase_requisition_two .select2').removeAttr('disabled');
                                                                            $('select[name=g_l_account]').removeAttr('disabled');
                                                                            $('select[name=cost_center]').attr('disabled', 'disabled');
                                                                            $('select[name=cost_center]').val("")
                                                                            //$('#Purchase_requisition_two .select2').trigger('change');
                                                                    }
                                                                    if (ele.name == 'project_id' && ele.value == '')
                                                                    {
                                                                    $('#Purchase_requisition_two .select2').attr('disabled', 'disabled');
                                                                            $('select[name=cost_center]').removeAttr('disabled');
                                                                            $('select[name=g_l_account]').removeAttr('disabled');
                                                                            $('#Purchase_requisition_two [name^=project_id],#Purchase_requisition_two [name^=phase_id], #Purchase_requisition_two [name^=task_id]').val("")
                                                                    }
                                                                    }
                                                                    });
                                                                    $('#project,#phase,#task').selectpicker('refresh');
                                                                    $('#Purchase_requisition_two .select2').trigger('change.select2');
                                                                    getTotal();
                                                            });
                                                                    function project() {
                                                                    if ($("#project").val() == 0)
                                                                    {
                                                                    $('#Purchase_requisition_two [name^=project_id],#Purchase_requisition_two [name^=phase_id], #Purchase_requisition_two [name^=task_id]').val("");
                                                                            $('#Purchase_requisition_two #accassign select.select2').trigger('change');
                                                                            $('#Purchase_requisition_two #accassign select.select2').attr('disabled', 'disabled');
                                                                            $('select[name=cost_center]').removeAttr('disabled');
                                                                            $('select[name=g_l_account]').removeAttr('disabled');
                                                                    }
                                                                    var idPadre = $("#project option:selected").val();
                                                                            var token = '{{ csrf_token() }}';
                                                                            if (idPadre !== '') {
                                                                    $.ajax({
                                                                    method: "POST",
                                                                            url: "{{url('admin/getProjectname')}}",
                                                                            data: {id: idPadre, '_token': token}
                                                                    }).done(function (response) {
                                                                    var obj = jQuery.parseJSON(response);
                                                                            var data = obj.phaseList;
                                                                            $('#phase,#task').html('<option value="" selected> Please select </option>');
                                                                            $.each(data, function (index, value) {
                                                                            $('#phase').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                                                                            });
                                                                            $('#phase').off('change', phase);
                                                                            $('#phase,#task').selectpicker('refresh');
                                                                            $('#phase,#task').trigger('change.select2');
                                                                            $('#phase').on('change', phase);
                                                                    });
                                                                    }
                                                                    }


                                                            function phase() {
                                                            var idPadre = $("#phase option:selected").val();
                                                                    var token = '{{ csrf_token() }}';
                                                                    if (idPadre !== '') {
                                                            $.ajax({
                                                            method: "POST",
                                                                    url: "{{url('admin/getProjectPhase')}}",
                                                                    data: {id: idPadre, '_token': token}
                                                            }).done(function (response) {
                                                            var obj = jQuery.parseJSON(response);
                                                                    var data = obj.phaseList;
                                                                    $('#task').html('<option value="" selected>Please select</option>');
                                                                    $.each(data, function (index, value) {
                                                                    $('#task').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                                                                    });
                                                                    $('#phase').off('change', phase);
                                                                    $('#phase,#task').selectpicker('refresh');
                                                                    $('#phase,#task').trigger('change.select2');
                                                                    $('#phase').on('change', phase);
                                                            });
                                                            }
                                                            }


                                                            $('select[name=cost_center]').on('change', function(evt){
                                                            if (evt.target.value == ''){
                                                            return;
                                                            }
                                                            if (evt.target.value == 0){
                                                            $('#Purchase_requisition_two #accassign select.select2').removeAttr('disabled');
                                                                    $('select[name=g_l_account]').removeAttr('disabled');
                                                                    $('select[name=cost_center]').val("");
                                                                    if (_evtFlag == true)
                                                            {
                                                            $('select[name=cost_center]').trigger('change');
                                                                    $('select[name=cost_center]').attr('disabled', 'disabled');
                                                                    _evtFlag = false;
                                                            }


                                                            }
                                                            });
                                                                    $("#project").on('change', project);
                                                                    $("#phase").on('change', phase);
                                                                    $('#Purchase_requisition_two [name^=project_id],#Purchase_requisition_two [name^=phase_id],#Purchase_requisition_two [name^=g_l_account], #Purchase_requisition_two [name^=task_id],#Purchase_requisition_two [name^=cost_center],#Purchase_requisition_two [name^=created_by],#Purchase_requisition_two [name^=changed_by],#Purchase_requisition_two [name^=created_on],#Purchase_requisition_two [name^=processing_status],#Purchase_requisition_two [name^=name],#Purchase_requisition_two [name^=add1],#Purchase_requisition_two [name^=add2],#Purchase_requisition_two [name^=postal_code],#Purchase_requisition_two [name^=country]')
                                                                    .on('change', function(evt){

                                                                    var _ele_name = evt.target.name;
                                                                            var _item_number = $('[name^=optradio]:checked').val();
                                                                            $(_item_number + ' [name^=' + _ele_name + ']').val(this.value);
                                                                            getTotal();
                                                                    });
                                                                    /** cost center or project herarchy group validation, either or.
                                                                     */

</script>
@endsection
