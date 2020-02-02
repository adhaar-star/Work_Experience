@extends('layout.adminlayout')

@section('title','Create Contract')



@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/contract.js')!!}

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
                            <a href="{{url('/admin/contract')}}">Contract</a>
                        </li>
                        <li>
                            <span>Create Contract</span>
                        </li>

                    </ul>
                </div>
                <div class="card card-info-custom">
                    <div class="card-header">
                        <h4 class="margin-bottom-0"> Create Contract </h4>
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

                                    <div class="tab-pane active" id="contract-desc" role="tabpanel">
                                        <div class="tab-header-title">
                                            Header Note
                                        </div>
                                        <div class="tab-block">
                                            <div class="form-group row">
                                                {!!Form::textarea('description', '',array('class'=>'form-control border-radius-0 no-resize','placeholder'=>'Please enter Description','maxlength'=>191))!!}
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

                        <div class="ppm-tabpane">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#general" role="tab">General Details</a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <form id="Purchase_requisition_two">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="general" role="tabpanel">
                                        <div class="padding-left-30 padding-right-30">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Agreement No:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        {!!Form::text('agreement_number',rand(5000000, 499999999),array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Agreement Number','readonly'))!!}
                                                        <!--                                                    {!!Form::select('purchase_orderno',$purchase_order_number,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Purchase order'))!!}-->
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Agreement Type:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        {!!Form::select('agreement_type',['Value Contract'=>'Value Contract','Quantity Contract'=>'Quantity Contract'],'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Agreement type'))!!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Target Value:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        {!!Form::number('target_value','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Target Value','min'=>0))!!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Value Unit:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        {!!Form::select('value_unit',$currency,'',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select Value Unit'))!!}

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Agreement Date:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        <label class="input-group datepicker-only-init">
                                                            {!!Form::text('agreement_date','',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please Select Agreement Date'))!!}
                                                            <span class="input-group-addon"> <i class="icmn-calendar"></i> </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Validity Start:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        <label class="input-group datepicker-only-init">
                                                            {!!Form::text('validity_start','',array('class'=>'form-control border-radius-0 datepicker-only-init ','placeholder'=>'Please select Validity Start Date'))!!}
                                                            <span class="input-group-addon"> <i class="icmn-calendar"></i> </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Validity End:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        <label class="input-group datepicker-only-init">
                                                            {!!Form::text('validity_end','',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Validity End Date'))!!}
                                                            <span class="input-group-addon"> <i class="icmn-calendar"></i> </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation Date:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        <label class="input-group datepicker-only-init">
                                                            {!!Form::text('quotation_date','',array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Quotation Date'))!!}
                                                            <span class="input-group-addon"> <i class="icmn-calendar"></i> </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Quotation No:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        {!!Form::number('quotation_no','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Quotation No','min'=>0))!!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Contact:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        {!!Form::text('sales_contact','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Sales Contact','maxlength'=>10))!!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Created On:</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                        {!!Form::text('created_on',date('Y-m-d'),array('class'=>'form-control border-radius-0','readonly'))!!}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </form>     
                        </div>


                        <!-- purchase add table -->
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
                                    <th>Material Group</th>
                                    <th>Vendor</th>
                                    <th>Requestor</th>
                                    <th>Processing Status</th>
                                </tr>
                            </thead>
                            <tbody id='purchase_item_form'>
                                {!! Form::button('Add Item',array('class'=>'btn btn-warning width-100','id'=>'add_row')) !!}  
                                <tr id='purchase_item_0' class = "form">
                                    <td class="text-center">
                                        <a href="javascript:void(0)" onclick="{var res = confirm('Are you sure you want to delete this contract item');
                                            if (res)$('table #purchase_item_0').remove();
                                            }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                    </td> 
                                    <td>                                        
                                        @if(isset($contract_item->status))
                                        <input type="image" src="{{asset('vendors/common/img/green.png')}}" alt="" value="active"  onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>

                                        @else
                                        <input type="image" src="{{asset('vendors/common/img/red.png')}}" alt="" value="inactive" onclick="if (this.value == 'active'){this.value = 'inactive'; this.src = '{{asset('vendors/common/img/red.png')}}' } else{this.value = 'active'; this.src = '{{asset('vendors/common/img/green.png')}}' }" name="status">

                                        </input>
                                        @endif    
                                    </td>
                                    <td>
                                        {!!Form::text('item_no',isset($contract_item->item_no) ? $contract_item->item_no : rand(10,99),array('class'=>'form-control border-radius-0 padding-input'))!!}

                                    </td>
                                    <td>

                                        {!!Form::select('item_category',['Material'=>'Material','Service'=>'Service','Asset'=>'Asset'],'',array('class'=>'form-control select2','placeholder'=>'Please select Item Category'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material',$material,'',array('class'=>'form-control select2','placeholder'=>'Please select Material'))!!}
                                    </td>
                                    <td>
                                        {!!Form::textarea('material_description','',array('class'=>'form-control border-radius-0 no-resize resize-textarea','placeholder'=>'Enter Description','maxlength'=>50))!!}
                                    </td>
                                    <td>
                                        {!!Form::number('item_quantity', '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Quantity','min'=>0))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('quantity_unit',['Liters'=>'Liters','Metric Ton'=>'Metric Ton','Pieces'=>'Pieces'],'',array('class'=>'form-control select2','placeholder'=>'Please select Quantity Unit'))!!}
                                    </td>
                                    <td>
                                        {!!Form::number('item_cost','',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Item Cost','min'=>0))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('currency',$currency,'',array('class'=>'form-control select2','placeholder'=>'Please enter Item Cost Unit'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('material_group',['Raw Material'=>'Raw Material','Service Material'=>'Service Material'],'',array('class'=>'form-control select2','placeholder'=>'Please select Material Group'))!!}
                                    </td>
                                    <td>     
                                        {!!Form::select('vendor',$vendor,'',array('class'=>'form-control select2','placeholder'=>'Please select Vendor'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('requestor',$requestedby,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please enter Requestor id'))!!}
                                    </td>
                                    <td>
                                        {!!Form::select('processing_status',['Created'=>'Created','Released'=>'Released','Closed'=>'Closed'],'',array('class'=>'form-control select2','placeholder'=>'Please select Processing Status'))!!}
                                    </td>


                                </tr>


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
                                        <th>Material Group</th>
                                        <th>Vendor</th>
                                        <th>Requestor</th>
                                        <th>Processing Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id='purchase_hidden_row' class = "form">

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
                                            {!!Form::text('item_no',rand(5000000, 499999999),array('class'=>'form-control border-radius-0 padding-input'))!!}

                                        </td>
                                        <td>
                                            {!!Form::select('item_category',['Material'=>'Material','Service'=>'Service','Asset'=>'Asset'],'',array('class'=>'form-control border-radius-0','placeholder'=>'Please select Item Category'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('material',$material,'',array('class'=>'form-control border-radius-0','placeholder'=>'Please select Material'))!!}
                                        </td>
                                        <td>
                                            {!!Form::textarea('material_description','',array('class'=>'form-control no-resize resize-textarea border-radius-0','placeholder'=>'Please Description','maxlength'=>'50'))!!}
                                        </td>
                                        <td>
                                            {!!Form::number('item_quantity','',array('class'=>'form-control border-radius-0 padding-input','placeholder'=>'Please enter Quantity','min'=>0))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('quantity_unit',['Liters'=>'Liters','Metric Ton'=>'Metric Ton','Pieces'=>'Pieces'],'',array('class'=>'form-control border-radius-0 padding-input','placeholder'=>'Please select Quantity Unit'))!!}
                                        </td>
                                        <td>
                                            {!!Form::number('item_cost','',array('class'=>'form-control border-radius-0 padding-input','min'=>0,'placeholder'=>'Please enter Item Cost'))!!}
                                        </td>
                                        <td>
                                            {!!Form::select('currency',$currency,'',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter Item Cost Unit'))!!}
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
                                            {!!Form::select('processing_status',['Created'=>'Created','Released'=>'Released','Closed'=>'Closed'],'',array('class'=>'form-control border-radius-0','placeholder'=>'Please select Contract Item Number'))!!}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

                <div class="card-footer card-footer-box text-right">
                    <div class='error-message' style='display:none;'> </div>    
                    {!! Form::button('create contract',array('class'=>'btn btn-primary card-btn','id'=>'btn_save')) !!}  
                    <a href="{{url('/admin/contract')}}" class="btn btn-danger">Cancel</a>
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


    var errortable = {
    'header_note':'Header Note',
            'project_id' : 'Account Assignment',
            'phase_id':'Account Assignment',
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
    var purchase_two = $('#Purchase_requisition_two').serializeArray();
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
    url: "{{url('/admin/contract/store')}}",
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
    var row = $('#purchase_hidden_row').html();
    row = '<tr id="purchase_item_' + id + '" class ="form" >' + row + '</tr>';
    $('#purchase_item_form').append(row);
    document.querySelector('#purchase_item_' + id + ' >td>a').onclick = function(event){
    var res = confirm('Are you sure you want to delete this purchase item');
    if (res)$('table #purchase_item_' + id).remove();
    };
    $('#purchase_item_' + id + ' [name^=item_no]').val(parseInt(Math.random() * 100));
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
    function extend(obj, src) {

    for (var key in src) {
    if (src.hasOwnProperty(key)) obj[key] = src[key];
    }
    return obj;
    }




</script>
@endsection
