$(function () {
    $("#GoodsReceiptform").validate({
        errorElement: 'p',
        rules: {
            'invoice_number': 'required',
            'transaction': 'required',
            'invoice_number_sel':'required',
            'purchase_order_number':'required'
        },
        messages: {
            'invoice_number': 'Please enter Invoice No',
            'transaction': 'Please select Transaction type',
            'invoice_number_sel':'Please Select Invoice No',
            'purchase_order_number':'Please Select Purchase Order No',
        },
        submitHandler: function (form) {
            var preventFormSubmit=false;
            $('.perror').remove();
            $('#ivr_table [name="tax_code[]"]').each(function(i,ele){
                if(ele.value==''||ele.value==null)
                {   
                    $('<p class="perror text-danger error">Please Select Tax Code</p>').insertAfter(ele);
                    preventFormSubmit = true;
                }
                $(ele).on('change',function(){
                   if(ele.value != null || ele.value != ''){
                       $(this).next('.perror').remove();
                   } 
                });
            });
            $('#ivr_table [name="qty_recevied[]"]').each(function(i,ele){
                if(ele.value==''||ele.value==null)
                {   
                    if($('#quant_rec').html() == "Return Quantity"){
                    $('<p class="perror text-danger error">Please Enter Return Quantity</p>').insertAfter(ele);
                }
                    if($('#quant_rec').html() == "Additional Quantity"){
                    $('<p class="perror text-danger error">Please Enter Additional Quantity</p>').insertAfter(ele);
                }
                    preventFormSubmit = true;
                }
                $(ele).on('change',function(){
                   if(ele.value != null || ele.value != ''){
                       $(this).next('.perror').remove();
                   } 
                });
            });
//            $('#ivr_table [name="tax_amount[]"]').each(function(i,ele){
//                 if(ele.value==''||ele.value==null)
//                {   
//                    $('<p class="perror" style="color:red;">Please Select Tax Amount</p>').insertAfter(ele);
//                    preventFormSubmit = true;
//                }
//                if(ele.value != null && ele.value != ''){
//                      $(this).next('.perror').remove();
//                   } 
//            });
            $('#ivr_table [name="g_l_account[]"]').each(function(i,ele){
                 if(ele.value==''||ele.value==null)
                {   
                    $('<p class="perror text-danger error">Please Select G/L account</p>').insertAfter(ele);
                    preventFormSubmit = true;
                }
                $(ele).on('change',function(){
                   if(ele.value != null || ele.value != ''){
                       $(this).next('.perror').remove();
                   } 
                });
            });
            if(preventFormSubmit==false)
            {
                form.submit();
            }
            else
            {
                return;
            }
            
        },
        errorPlacement: function (error, element) {
            $('#emailError').html('');

            if (element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            } else
            {
                error.insertAfter(element);
            }
            error.addClass('text-danger');
        }
    });

    $(document).ready(function () {
        $('#transaction').change(function () {
            var transaction_type = $(this).val();

            $('#inv_no').val("").trigger('change');
            $('#itemno').val("").trigger('change');
            $('#purchase_item_form').html('');
            if (transaction_type == 'Credit memo') {
                $('#quant_rec').html('Return Quantity');
            }
            if (transaction_type == 'Debit memo') {
                $('#quant_rec').html('Additional Quantity');
            }
            if (transaction_type == 'Invoice') {
                $('#purchaseno').prop("disabled", false);
                $('#quant_rec').html('Quantity received');
                $('#invoice_number_org').val("");
                $('#inv_ref_no').show();
                $('#inv_ref_no_select').hide();
            } else if (transaction_type == 'Credit memo' || transaction_type == 'Debit memo') {
                $('#inv_ref_no').hide();
                $('#inv_ref_no_select').show();
                $('#purchaseno').prop('disabled','disabled');
                $('#inv_no').change(function () {
                    if ($('#transaction').val() == 'Credit memo' || $('#transaction').val() == 'Debit memo') {
                        var inv_id = $(this).val();
                        if (inv_id != '' && inv_id != undefined) {
                            invoiceVerificationData(inv_id, transaction_type);
                        }
                    }
                });
                $('#itemno').change(function () {
                    if ($('#transaction').val() == 'Credit memo' || $('#transaction').val() == 'Debit memo') {
                        var item_id = $(this).val();
                        var inv_id = $('#inv_no').val();
                        if (item_id != '' && item_id != undefined) {
                            invoiceVerificationItemData(inv_id, transaction_type, item_id);
                        }
                    }
                });
            }
        });

        function invoiceVerificationData(inv_id, transaction_type) {
            $.ajax({
                type: "GET",
                url: "/admin/invoice_verification_type/" + transaction_type + "/" + inv_id,
                success: function (response) {
                    $('#purchase_item_form').html('');
                    $('#purchaseno').val(response.purchase_order_no).trigger('change');
                    $('#purchaseno_hidden').val(response.purchase_order_no).trigger('change');
                    $('#invoice_number_org').val(response.invoice_number);
                    $(response.results).each(function (i, data) {
                        console.log(data);
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
                        $('#purchase_item_' + count + ' [name^=purchase_order_item_no]').val(data.purchase_order_item_no);
                        $('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val(data.qty_recevied);
                        $('#purchase_item_' + count + ' [name^=item_description]').val(data.item_description);
                        $('#purchase_item_' + count + ' [name^=project_id]').val(data.project_id);
                        $('#purchase_item_' + count + ' [name^=task_id]').val(data.task_id);
                        $('#purchase_item_' + count + ' [name^=cost_centre]').val(data.cost_center);
                        $('#purchase_item_' + count + ' [name^=phase_id]').val(data.phase_id);
                        $('#purchase_item_' + count + ' [name^=g_l_account]').val(data.g_l_account);
                        $('#purchase_item_' + count + ' [name^=qty_recevied]').val(data.quantity_received);
                        $('#purchase_item_' + count + ' [name^=quantity_remaining]').val(data.quantity_remaining);
                        $('#purchase_item_' + count + ' [name^=purchase_order_value]').val(data.po_order_value);
                        $('#purchase_item_' + count + ' [name^=g_r_amount]').val(data.g_r_amount);

                        $('#purchase_item_' + count + ' [name^=invoice_value]').val(data.invoice_value);

                        $('#purchase_item_' + count + ' [name^=difference]').val((data.po_order_value) - (data.invoice_value));
                        $('#purchase_item_' + count + ' [name^=tax_code]').on('change', function () {
                            if (!isNaN(this.value))
                                tax_amount = parseInt(($('#purchase_item_' + count + ' [name^=qty_recevied]').val()) * (data.item_cost)) * (parseFloat(this.value) / 100);
                            $('#purchase_item_' + count + ' [name^=tax_amount]').val(tax_amount);
                            $('#purchase_item_' + count + ' [name^=invoice_value]').val(($('#purchase_item_' + count + ' [name^=qty_recevied]').val()) * (data.item_cost));
                        });
                        $('#purchase_item_' + count + ' [name^=invoice_value]').on('change', function () {
                            var value = parseInt(this.value) - parseInt($('#purchase_item_' + count + ' [name^=g_r_amount]').val());
                            $('#purchase_item_' + count + ' [name^=difference]').val(value);
                        });

                        $('#purchase_item_' + count + ' [name^=qty_recevied]').on('change', function () {
                            if ($('#transaction').val() == 'Credit memo') {
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
                    });
                }
            });
        }


        function invoiceVerificationItemData(inv_id, transaction_type, item_id) {
            $.ajax({
                type: "GET",
                url: "/admin/invoice_verification_type/" + transaction_type + "/" + inv_id + "/" + item_id,
                success: function (response) {
                    $('#purchase_item_form').html('');
                    $('#purchaseno').val(response.purchase_order_no).trigger('change');
                    $('#purchaseno_hidden').val(response.purchase_order_no).trigger('change');
                    $('#invoice_number_org').val(response.invoice_number);
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
                        $('#purchase_item_' + count + ' [name^=purchase_order_item_no]').val(data.purchase_order_item_no);
                        $('#purchase_item_' + count + ' [name^=purchase_order_quantity]').val(data.qty_recevied);
                        $('#purchase_item_' + count + ' [name^=item_description]').val(data.item_description);
                        $('#purchase_item_' + count + ' [name^=project_id]').val(data.project_id);
                        $('#purchase_item_' + count + ' [name^=task_id]').val(data.task_id);
                        $('#purchase_item_' + count + ' [name^=cost_centre]').val(data.cost_center);
                        $('#purchase_item_' + count + ' [name^=phase_id]').val(data.phase_id);
                        $('#purchase_item_' + count + ' [name^=g_l_account]').val(data.g_l_account);
                        $('#purchase_item_' + count + ' [name^=qty_recevied]').val(data.quantity_received);
                        $('#purchase_item_' + count + ' [name^=quantity_remaining]').val(data.quantity_remaining);
                        $('#purchase_item_' + count + ' [name^=purchase_order_value]').val(data.po_order_value);
                        $('#purchase_item_' + count + ' [name^=g_r_amount]').val(data.g_r_amount);

                        $('#purchase_item_' + count + ' [name^=invoice_value]').val(data.invoice_value);

                        $('#purchase_item_' + count + ' [name^=difference]').val((data.po_order_value) - (data.invoice_value));
                        $('#purchase_item_' + count + ' [name^=tax_code]').on('change', function () {
                            if (!isNaN(this.value))
                                tax_amount = parseInt(($('#purchase_item_' + count + ' [name^=qty_recevied]').val()) * (data.item_cost)) * (parseFloat(this.value) / 100);
                            $('#purchase_item_' + count + ' [name^=tax_amount]').val(tax_amount);
                            $('#purchase_item_' + count + ' [name^=invoice_value]').val(($('#purchase_item_' + count + ' [name^=qty_recevied]').val()) * (data.item_cost));
                        });
                        $('#purchase_item_' + count + ' [name^=invoice_value]').on('change', function () {
                            var value = parseInt(this.value) - parseInt($('#purchase_item_' + count + ' [name^=g_r_amount]').val());
                            $('#purchase_item_' + count + ' [name^=difference]').val(value);
                        });
                        $('#purchase_item_' + count + ' [name^=qty_recevied]').on('change', function () {
                            if ($('#transaction').val() == 'Credit memo') {
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
                            }
                        });
                    });
                }
            });
        }
    });
});

