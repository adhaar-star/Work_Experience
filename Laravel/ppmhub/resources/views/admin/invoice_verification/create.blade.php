@extends('layout.adminlayout')
@section('title','Create Invoice Verification')

@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/invoice_verification.js') !!}

<section id="create_form" class="panel">
    <!--    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif-->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">
                    <div class="row PageTitleGlobal">
                        <div class="col-md-3">
                            <h1>&nbsp;Invoice Verification</h1>
                        </div>
                        <div class="col-md-9 text-right">

                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    You are here :  <a href="javascript: void(0);">Procurement</a>
                                </li>
                                <li>
                                    <a href="{{url('/admin/invoice_verification')}}">Invoice Verification</a>
                                </li>
                                <li>
                                    <span>Create Invoice Verification</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="togle-btn pull-right">
                    <!--                                        <div class="dropdown inner-drpdwn">
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

                @if(!isset($goods_receipt->id))
                {!! Form::open(array('route' => 'invoice_verification.create','method'=>'post', 'id' => 'GoodsReceiptform')) !!} 
                @else
                {!! Form::open(array('route'=>array('goods_receipt.update',$goods_receipt->id),'method' => 'put','id' => 'GoodsReceiptform')) !!}
                @endif
                {{ csrf_field() }}
                <div class="margin-bottom-50">
                    <!--                    <div class="row">
                                            <div class="col-md-3">
                                              <h1>Manual Capacity Planning</h1>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="margin-bottom-50 text-right">
                                                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                                        <li>
                                                            You are here :    <a href="javascript: void(0);">Procurement</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{url('/admin/invoice_verification')}}">Invoice Verification</a>
                                                        </li>
                                                        <li>
                                                            @if(isset($goods_receipt))
                                                            <span>Edit Invoice Verification</span>
                                                            @else
                                                            <span>Create Invoice Verification</span>
                                                            @endif    
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>-->

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">Create Invoice Verification
                                <div class="col-md-6 pull-right">
                                    <label class="pull-right"><span class="text-danger">*</span>Mandatory fields</label>
                                </div>
                            </h4>
                        </div>
                        <div class="card-block">
                            <div class="row">

                                @if(isset($goods_receipt)!=true)
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">Transaction<span class="text-danger">*</span>:</label>
                                        <div class="col-sm-4">
                                            {!!Form::select('transaction',['Invoice'=>'Invoice', 'Credit memo'=>'Credit memo','Debit memo'=>'Debit memo'],'',array('class'=>'form-control border-radius-0 select2','id' =>'transaction','placeholder'=>'Please select Transaction type'))!!}
                                            @if($errors->has('transaction')) 
                                            <span class="text-danger">
                                                {{ $errors->first('transaction') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row" id="inv_ref_no">
                                        <label class="col-sm-4 col-form-label text-right">Invoice Reference No<span class="text-danger">*</span> :</label>
                                        <div class="col-sm-4">
                                            {!!Form::text('invoice_number','',array('class'=>'form-control border-radius-0','placeholder'=>'Enter Invoice Number','id'=>'invoice_number_org'))!!}
                                            @if($errors->has('invoice_number')) 
                                            <span class="text-danger">
                                                {{ $errors->first('invoice_number') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row" id="inv_ref_no_select" style="display: none">
                                        <label class="col-sm-4 col-form-label text-right">Invoice Reference No :</label>
                                        <div class="col-sm-4">
                                            <div class="form-input-icon">
                                                {!!Form::select('invoice_number_sel',$inv_no,'',array('class'=>'form-control border-radius-0 select2','id'=>'inv_no','placeholder'=>'Please select Invoice number'))!!}
                                                @if($errors->has('invoice_number')) 
                                                <span class="text-danger">
                                                    {{ $errors->first('invoice_number') }}
                                                </span> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">Purchase Order Number<span class="text-danger">*</span>:</label>
                                        <div class="col-sm-4">
                                            <div class="form-input-icon">
                                                {!!Form::select('purchase_order_number',$purchase_no,isset($goods_receipt->purchase_order_number) ? $goods_receipt->purchase_order_number : '',array('class'=>'form-control border-radius-0 select2','id'=>'purchaseno','placeholder'=>'Please select Purchase Order number'))!!}
                                                @if($errors->has('purchase_order_number')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('purchase_order_number') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="display: none;">
                                        <label class="col-sm-4 col-form-label text-right">Purchase Order Number*:</label>
                                        <div class="col-sm-4">
                                            <div class="form-input-icon">
                                                {!!Form::select('purchase_order_number_hidden',$purchase_no,isset($goods_receipt->purchase_order_number) ? $goods_receipt->purchase_order_number : '',array('class'=>'form-control border-radius-0 select2','id'=>'purchaseno_hidden','placeholder'=>'Please select Purchase Order number'))!!}
                                                @if($errors->has('purchase_order_number')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('purchase_order_number') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">Item No:</label>
                                        <div class="col-sm-4">
                                            <div class="form-input-icon">
                                                {!!Form::select('item_no',[],isset($goods_receipt->isset_item_no) ? $goods_receipt->item_no : '',array('class'=>'form-control border-radius-0 select2','id'=>'itemno','placeholder'=>'Please select Item No (optional)'))!!}
                                                @if($errors->has('item_no')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('item_no') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-right">Vendor No:</label>
                                        <div class="col-sm-4">
                                            <div class="form-input-icon">
                                                {!!Form::select('vendor',$vendor,isset($goods_receipt->vendor) ? $goods_receipt->vendor : '',array('class'=>'form-control border-radius-0 select2','id'=>'vendor','placeholder'=>'Please select Vendor'))!!}
                                                @if($errors->has('vendor')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('vendor') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Invoice Date:</label>
                                        <div class="col-sm-4">
                                            {!!Form::text('invoice_date',isset($goods_receipt->document_date)?$goods_receipt->document_date:date('Y-m-d'),array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Invoice date'))!!}
                                            @if($errors->has('document_date')) 
                                            <span class="text-danger">
                                                {{ $errors->first('document_date') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Posting Date:</label>
                                        <div class="col-sm-4">
                                            {!!Form::text('posting_date',isset($goods_receipt->posting_date)?$goods_receipt->posting_date:date('Y-m-d'),array('class'=>'form-control border-radius-0 datepicker-only-init','placeholder'=>'Please select Posting date'))!!}
                                            @if($errors->has('posting_date')) 
                                            <span class="text-danger">
                                                {{ $errors->first('posting_date') }}
                                            </span> 
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                @endif

                                <table class="table table-list table-responsive margin-top-15" id="ivr_table" >
                                    <thead>
                                        <tr>

                                            <th>Item No.</th>
                                            <th>Item Description</th>                            
                                            <th>Goods Receipt Indicator</th>
                                            <th>Purchase Order Value</th>
                                            <th>Goods Receipt Amount</th>
                                            <th>Invoice Value</th>
                                            <th>&nbsp;&nbsp;&nbsp;Difference&nbsp;&nbsp;&nbsp;</th>
                                            <th>Purchase Order Quantity</th>
                                            <th id="quant_rec">Quantity Received</th>
                                            <th>Quantity Remaining</th>
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tax Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>&nbsp;&nbsp;Tax Amount&nbsp;&nbsp;&nbsp</th>
                                            <th>G/L Account</th>
                                            <th>Project Id</th>
                                            <th>Phase Id</th>
                                            <th>Task Id</th>
                                            <th>Cost centre</th>
                                        </tr>
                                    </thead>
                                    <tbody id='purchase_item_form'>
                                    </tbody>
                                </table>

                            </div>                                    
                        </div>
                    </div>
                </div>
                <div class="card-footer card-footer-box text-right">
                    {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                    <a href="{{url('/admin/invoice_verification')}}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
            <!--End Vertical Form--> 
        </div>
        {!! Form::close() !!}
        <!-- dummy table -->
        <table class="table table-list table-responsive margin-top-15" style="display:none;">
            <thead>
                <tr>
                    <th>Item No.</th>
                    <th>Item Description</th>                            
                    <th>Goods Receipt Indicator</th>
                    <th>Purchase order Value</th>
                    <th>Invoice Value</th>
                    <th>&nbsp;&nbsp;Difference&nbsp;&nbsp;</th>
                    <th>Purchase order quantity</th>
                    <th>Quantity received</th>
                    <th>Goods Receipt Amount</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;Tax Code&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Tax Amount</th>
                    <th>G/L Account</th>

                </tr>
            </thead>
            <tbody id='hidden_table'>
                {{csrf_field()}}
                <tr id='purchase_hidden_row' class = "form">

                    <td>
                        {!!Form::text('purchase_order_item_no[]','',array('class'=>'form-control no-resize padding-input','placeholder'=>'Item No','readonly'))!!}
                    </td>
                    <td>
                        {!!Form::textarea('item_description[]','',array('class'=>'form-control no-resize resize-textarea border-radius-0','placeholder'=>'Item Description','readonly'))!!}
                    </td>
                    <td> 
                        {!!Form::text('goods_receipt_indicator[]','',array('class'=>'form-control border-radius-0 padding-input','readonly'))!!}
                    </td>
                    <td>
                        {!!Form::number('purchase_order_value[]','',array('class'=>'form-control border-radius-0 padding-input','placeholder'=>'Purchase Order Value','min'=>0,'readonly'))!!}
                    </td>
                    <td>
                        {!!Form::number('g_r_amount[]','',array('class'=>'form-control border-radius-0 padding-input','min'=>0,'readonly')) !!}
                    </td>
                    <td>
                        {!!Form::number('invoice_value[]','',array('class'=>'form-control border-radius-0 padding-input','min'=>0))!!}
                    </td>
                    <td>
                        {!!Form::number('difference[]','',array('class'=>'form-control border-radius-0 padding-input','min'=>0,'readonly'))!!}
                    </td>
                    <td>
                        {!!Form::number('purchase_order_quantity[]','',array('class'=>'form-control border-radius-0 padding-input','placeholder'=>'Purchase Order Quantity','min'=>0,'readonly'))!!}
                    </td>
                    <td>
                        {!!Form::number('qty_recevied[]','',array('class'=>'form-control border-radius-0 padding-input','min'=>0))!!}
                    </td>
                    <td>
                        {!!Form::text('quantity_remaining[]','',array('class'=>'form-control border-radius-0 padding-input ','min'=>0,'readonly'))!!}
                    </td>
                    <td>
                        {!!Form::select('tax_code[]',['0'=>'Tax free-0','10'=>'Input tax -10%','5'=>'Input tax -5%','12'=>'Input tax -12%','20'=>'Input tax -20%'],'',array('class'=>'form-control border-radius-0 padding-input','placeholder'=>'Select Tax Code','min'=>0))!!}
                    </td>
                    <td>
                        {!!Form::text('tax_amount[]','',array('class'=>'form-control border-radius-0 padding-input ','placeholder'=>'Select Tax Account','min'=>0))!!}
                    </td>
                    <td>
                        {!!Form::select('g_l_account[]',$gl_accounts,'',array('class'=>'form-control border-radius-0 padding-input ','placeholder'=>'Select G/L account','min'=>0,'readonly'))!!}
                    </td>
                    <td>
                        {!!Form::select('project_id[]',$project_ids,'',array('class'=>'form-control border-radius-0 padding-input ','placeholder'=>'Select Project Id','min'=>0,'disabled','style'=>'width:100px;'))!!}
                    </td>
                    <td>
                        {!!Form::select('phase_id[]',$phase_ids,'',array('class'=>'form-control border-radius-0 padding-input ','placeholder'=>'Select Phase Id','min'=>0,'disabled','style'=>'width:100px;'))!!}
                    </td>
                    <td>
                        {!!Form::select('task_id[]',$task_ids,'',array('class'=>'form-control border-radius-0 padding-input ','placeholder'=>'Select task Id','min'=>0,'disabled'))!!}
                    </td>
                    <td>
                        {!!Form::select('cost_centre[]',$cost_centre,'',array('class'=>'form-control border-radius-0 padding-input ','placeholder'=>'','min'=>0,'disabled','style'=>'width:100px;'))!!}
                    </td>

                </tr>

            </tbody>

        </table>
    </div>
</div>
</div>
</section><!--
<!-- End Dashboard -->

<!-- Page Scripts -->
<script type="text/javascript">

  $('#purchaseno').change(function () {
      var purchaseID = $(this).val();
      if ($('#transaction').val() == 'Invoice') {
          if (purchaseID) {
              getPurchaseitemList(purchaseID);
          }
      }
  });
  $('#itemno').change(function () {
      var itemID = $(this).val();
      if ($('#transaction').val() == 'Invoice') {
          if (itemID) {
              getPurchaseitem(itemID);
          }
      }
  });
  $('#purchaseno').select2({
  }).on('change', function () {
      $(this).valid();
  });
  $('#transaction').select2({
  }).on('change', function () {
      $(this).valid();
  });

  $('#itemno').select2({
  }).on('change', function () {
      $(this).valid();
  });
  $('#vendorno').select2({
  }).on('change', function () {
      $(this).valid();
  });
  function getPurchaseitem(itemId) {
      if (itemId == 0)
      {
          itemId = $('#purchaseno').val();
          getPurchaseitemList(itemId);
          return;
      }
      var purchase_order = $('#purchaseno').val();
      var token = $('[name=_token]').val();
      $.ajax({
          type: "POST",
          url: "/admin/api/invPurchaseitem/" + purchase_order + "/" + itemId,
          data: {'_token': token},
          success: function (response) {

              $('#purchase_item_form').html('');
              if (response.status == true)
              {
                  $(response.results).each(function (i, data) {

                      var count = $('#purchase_item_form tr').length;
                      var row = $('#purchase_hidden_row').html();
                      $('#purchase_item_form').append('<tr id="purchase_item_' + count + '" class = "form">' + row + '</tr>');
                      if (data.item_quantity_gr == 0)
                      {
                          $('#purchase_item_' + count + ' [name^=goods_receipt_indicator]').val('Full');
                      }
                      else if (data.item_quantity_gr > 0 && data.item_quantity_gr != data.item_quantity)
                      {
                          $('#purchase_item_' + count + ' [name^=goods_receipt_indicator]').val('Partial');
                      }
                      else if (data.item_quantity_gr == data.item_quantity)
                      {
                          $('#purchase_item_' + count + ' [name^=goods_receipt_indicator]').val('N/A');
                      }
                      $('#purchase_item_' + count + ' [name^=purchase_order_item_no]').val(data.item_no);
                      $('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val(data.purchase_order_quantity);
                      $('#purchase_item_' + count + ' [name^=item_description]').val(data.material_description);
                      $('#purchase_item_' + count + ' [name^=project_id]').val(data.project_id);
                      $('#purchase_item_' + count + ' [name^=task_id]').val(data.task_id);
                      $('#purchase_item_' + count + ' [name^=cost_centre]').val(data.cost_center);
                      $('#purchase_item_' + count + ' [name^=phase_id]').val(data.phase_id);
                      $('#purchase_item_' + count + ' [name^=g_l_account]').val(data.g_l_account);
                      $('#purchase_item_' + count + ' [name^=qty_recevied]').val(data.quantity_received);
                      $('#purchase_item_' + count + ' [name^=quantity_remaining]').val(data.quantity_remaining);
                      $('#purchase_item_' + count + ' [name^=purchase_order_value]').val(data.item_cost * data.item_quantity);
                      $('#purchase_item_' + count + ' [name^=g_r_amount]').val(data.item_cost * data.quantity_received);

                      $('#purchase_item_' + count + ' [name^=invoice_value]').val(data.item_cost * data.quantity_received);

                      $('#purchase_item_' + count + ' [name^=difference]').val((data.item_cost * data.item_quantity) - (data.item_cost * data.quantity_received));
                      $('#purchase_item_' + count + ' [name^=tax_code]').on('change', function () {
                          if (!isNaN(this.value))
                              tax_amount = parseInt($('#purchase_item_' + count + ' [name^=invoice_value]').val()) + parseInt($('#purchase_item_' + count + ' [name^=invoice_value]').val()) * (parseFloat(this.value) / 100);
                          $('#purchase_item_' + count + ' [name^=tax_amount]').val(tax_amount);
                      });
                      $('#purchase_item_' + count + ' [name^=invoice_value]').on('change', function () {
                          var value = parseInt(this.value) - parseInt($('#purchase_item_' + count + ' [name^=g_r_amount]').val());
                          $('#purchase_item_' + count + ' [name^=difference]').val(value);
                      });
                      $('#purchase_item_' + count + ' [name^=qty_recevied]').on('change', function () {
                          if (parseInt($('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val()) < parseInt(this.value))
                          {
                              this.value = parseInt($('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val());
                              var value = parseInt($('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val()) - parseInt(this.value);
                              $('#purchase_item_' + count + ' [name^=quantity_remaining]').val(value);
                          }
                          else
                          {
                              var value = parseInt($('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val()) - parseInt(this.value);
                              $('#purchase_item_' + count + ' [name^=quantity_remaining]').val(value);
                          }
                      });
                  });
              }
              else if (response.status == 'msg')
              {
                  alert(response.results);
              }
          }
      });
  }
  function getPurchaseitemList(purchaseID) {

      $.ajax({type: "GET",
          url: "/admin/api/invPurchaseitems/" + purchaseID,
          success: function (response) {

              $('#purchase_item_form').html('');
              if (response.status == true)
              {
                  $(response.results).each(function (i, data) {

                      var count = $('#purchase_item_form tr').length;
                      var row = $('#purchase_hidden_row').html();
                      if (data != null) {
                          $('#purchase_item_form').append('<tr id="purchase_item_' + count + '" class = "form">' + row + '</tr>');
                          $('#purchase_item_' + count + ' [name^=purchase_order_item_no]').val(data.item_no);
                          if (data.item_quantity_gr == 0)
                          {
                              $('#purchase_item_' + count + ' [name^=goods_receipt_indicator]').val('Full');
                          }
                          else if (data.item_quantity_gr > 0 && data.item_quantity_gr != data.item_quantity)
                          {
                              $('#purchase_item_' + count + ' [name^=goods_receipt_indicator]').val('Partial');
                          }
                          else if (data.item_quantity_gr == data.item_quantity)
                          {
                              $('#purchase_item_' + count + ' [name^=goods_receipt_indicator]').val('N/A');
                          }
                          $('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val(data.purchase_order_quantity);
                          $('#purchase_item_' + count + ' [name^=item_description]').val(data.material_description);
                          $('#purchase_item_' + count + ' [name^=project_id]').val(data.project_id);
                          $('#purchase_item_' + count + ' [name^=task_id]').val(data.task_id);
                          $('#purchase_item_' + count + ' [name^=cost_centre]').val(data.cost_center);
                          $('#purchase_item_' + count + ' [name^=phase_id]').val(data.phase_id);
                          $('#purchase_item_' + count + ' [name^=g_l_account]').val(data.g_l_account);
                          $('#purchase_item_' + count + ' [name^=qty_recevied]').val(data.quantity_received);
                          $('#purchase_item_' + count + ' [name^=quantity_remaining]').val(data.quantity_remaining);
                          $('#purchase_item_' + count + ' [name^=purchase_order_value]').val(data.item_cost * data.item_quantity);
                          $('#purchase_item_' + count + ' [name^=g_r_amount]').val(data.item_cost * data.quantity_received);

                          $('#purchase_item_' + count + ' [name^=invoice_value]').val(data.item_cost * data.quantity_received);
                          $('#purchase_item_' + count + ' [name^=difference]').val((data.item_cost * data.item_quantity) - (data.item_cost * data.quantity_received));
                          $('#purchase_item_' + count + ' [name^=tax_code]').on('change', function () {
                              if (!isNaN(this.value))
                                  tax_amount = parseInt($('#purchase_item_' + count + ' [name^=invoice_value]').val()) + parseInt($('#purchase_item_' + count + ' [name^=invoice_value]').val()) * (parseFloat(this.value) / 100);
                              $('#purchase_item_' + count + ' [name^=tax_amount]').val(tax_amount);
                          });
                          $('#purchase_item_' + count + ' [name^=invoice_value]').on('change', function () {
                              if (!isNaN(this.value))
                              {
                                  var value = parseInt(this.value) - parseInt($('#purchase_item_' + count + ' [name^=g_r_amount]').val());
                                  $('#purchase_item_' + count + ' [name^=difference]').val(value);
                              }

                          });
                          $('#purchase_item_' + count + ' [name^=qty_recevied]').on('change', function () {
                              if (parseInt($('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val()) < parseInt(this.value))
                              {
                                  this.value = parseInt($('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val());
                                  var value = parseInt($('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val()) - parseInt(this.value);
                                  $('#purchase_item_' + count + ' [name^=quantity_remaining]').val(value);
                              }
                              else
                              {
                                  var value = parseInt($('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val()) - parseInt(this.value);
                                  $('#purchase_item_' + count + ' [name^=quantity_remaining]').val(value);
                              }
                          });
                      }
                  });
                  $('#itemno').html('');
                  $('#itemno').append('<option value selected="selected" disabled="disabled" "placeholder"="Please select item no (optional)" >Please select item no (optional)</option>');
                  $(response.item).each(function (i, data) {
                      for (x in data) {
                          $('#itemno').append('<option value="' + x + '"> ' + data[x] + '</option>');
                      }

                  });
                  $('#itemno').trigger('change');
              }
              else if (response.status == 'msg')
              {
                  alert(response.results);
              }
          }
      });
  }


  function calculate(index, evt)
  {
      if (parseInt(evt.target.value) > parseInt($('#purchase_item_' + index + ' [name^=purchase_order_quantity]').val()))
      {
          evt.target.value = parseInt($('#purchase_item_' + index + ' [name^=purchase_order_quantity]').val());
          var value = parseInt($('#purchase_item_' + index + ' [name^=purchase_order_quantity]').val()) - parseInt(evt.target.value);
          $('#purchase_item_' + index + ' [name^=quantity_remaining]').val(value);
      }
      else
      {
          var value = parseInt($('#purchase_item_' + index + ' [name^=purchase_order_quantity]').val()) - parseInt(evt.target.value);
          $('#purchase_item_' + index + ' [name^=quantity_remaining]').val(value);
      }
  }



  @if (Session::has('purchase_order'))
          (function () {
              $('#purchaseno').trigger('change');
          })();
          @endif


</script>
@endsection
