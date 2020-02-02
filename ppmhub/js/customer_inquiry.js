function header_calculate() {
    var inquiry_gross_price = 0;
    var discount_amt = 0;
    var discount_grossprice = 0;
    var sales_amt = 0;
    var net_price = 0;
    var freight_charges = 0;
    var total_price = 0;
    var amt = 0;
    var discount = 0;

    $('#purchase_item_form .form').each(function (i, row) {
        if (!isNaN(row.querySelector('[name=gross_price]').value))
        {
            var gp = parseInt(row.querySelector('[name=gross_price]').value);
            if (!isNaN(row.querySelector('[name=discount]').value))
            {
                var disc = parseInt(row.querySelector('[name=discount]').value);
                amt += (gp * disc) / 100;
                inquiry_gross_price += parseInt(row.querySelector('[name=gross_price]').value);
                discount = (amt * 100) / inquiry_gross_price;
                if (!isNaN(discount))
                    $('[name=inquiry_discount]').val(discount.toFixed(2));
            }
            if (!isNaN(inquiry_gross_price))
                $('[name=inquiry_gross_price]').val(Math.round(inquiry_gross_price));
        }
        if (!isNaN(row.querySelector('[name=discount_amt]').value))
        {
            discount_amt += parseInt(row.querySelector('[name=discount_amt]').value);
            if (!isNaN(discount_amt))
                $('[name=inquiry_discount_amt]').val(Math.round(discount_amt));
        }
        if (!isNaN(row.querySelector('[name=discount_gross_price]').value))
        {
            discount_grossprice += parseInt(row.querySelector('[name=discount_gross_price]').value);
            if (!isNaN(discount_grossprice))
                $('[name=inquiry_discount_gross_price]').val(Math.round(discount_grossprice));
        }
        if (!isNaN(row.querySelector('[name=sales_taxamt]').value))
        {
            sales_amt += parseInt(row.querySelector('[name=sales_taxamt]').value);
            if (!isNaN(sales_amt))
                $('[name=inquiry_sales_taxamt]').val(Math.round(sales_amt));
        }
        if (!isNaN(row.querySelector('[name=net_price]').value))
        {
            net_price += parseInt(row.querySelector('[name=net_price]').value);
            if (!isNaN(net_price))
                $('[name=inquiry_net_price]').val(Math.round(net_price));
        }
        if (!isNaN(row.querySelector('[name=freight_charges]').value))
        {
            freight_charges += parseInt(row.querySelector('[name=freight_charges]').value);
            if (!isNaN(freight_charges))
                $('[name=inquiry_freight_charges]').val(Math.round(freight_charges));
        }
        if (!isNaN(row.querySelector('[name=total_price]').value))
        {
            total_price += parseInt(row.querySelector('[name=total_price]').value);
            if (!isNaN(total_price))
                $('[name=inquiry_total_price]').val(Math.round(total_price));
        }
    });

}

function calculate(evt) {
    var id = $('[name=optradio]:checked').val();

    var order_qty = $(id + ' input[name="order_qty"]').val();
    var cost_unit = $(id + ' input[name="cost_unit"]').val();

    var total_amt = 0;
    tota_amt = parseInt(order_qty) * parseInt(cost_unit);
    if (!isNaN(tota_amt))
    {
        $(id + " input[name = 'tota_amt']").val(Math.round(tota_amt));
        $('#Purchase_requisition_two input[name=gross_price]').val(Math.round(tota_amt));
        $(id + " input[name = 'gross_price']").val(Math.round(tota_amt));

    }
    disc_calculate(evt);
}
function disc_calculate(evt)
{
    var id = $('[name=optradio]:checked').val();
    var super_total = $('#Purchase_requisition_two input[name=gross_price]').val();
    var discount_amount = 0;

    var discount = $('#Purchase_requisition_two input[name="discount"]').val();
    if (discount == null || discount == '')
    {
        discount = 0;
        $("#discount").val(discount);
    }
    else
    {
        $(id + " input[name = 'discount']").val(discount);
    }
    discount_amount = (parseInt(super_total) * parseFloat(discount)) / 100;
    if (!isNaN(discount_amount)) {
        $('#Purchase_requisition_two [name=discount_amt]').val(Math.round(discount_amount));
        $(id + " input[name = 'discount_amt']").val(Math.round(discount_amount));
    }
    var dis_gross_price = 0;
    dis_gross_price = parseInt(Math.round(super_total)) - parseInt(Math.round(discount_amount));
    if (!isNaN(dis_gross_price))
    {
        $('#Purchase_requisition_two [name=discount_gross_price]').val(Math.round(dis_gross_price));
        $(id + " input[name = 'discount_gross_price']").val(Math.round(dis_gross_price));

    }
    sales_calculate(evt);
}
function sales_calculate(evt)
{
    var id = $('[name=optradio]:checked').val();
    var dis_gross_price = $('#Purchase_requisition_two input[name=discount_gross_price]').val();
    var sales_tax = $('#Purchase_requisition_two input[name="sales_tax"]').val();
    $(id + " input[name = 'sales_tax']").val(sales_tax);
    var sales_taxamt = 0;
    sales_taxamt = (parseInt(dis_gross_price)) * (parseFloat(sales_tax)) / 100;
    if (!isNaN(sales_taxamt))
    {
        $('#Purchase_requisition_two [name=sales_taxamt]').val(Math.round(sales_taxamt));
        $(id + " input[name = 'sales_taxamt']").val(Math.round(sales_taxamt));

    }
    var net_price = 0;
    net_price = parseInt(Math.round(dis_gross_price)) + parseFloat(Math.round(sales_taxamt));
    if (!isNaN(net_price))
    {
        $('#Purchase_requisition_two [name=net_price]').val(Math.round(net_price));
        $(id + " input[name = 'net_price']").val(Math.round(net_price));
    }
    var charges = $('#Purchase_requisition_two input[name="freight_charges"]').val();
    $(id + " input[name = 'freight_charges']").val(Math.round(charges));

    var total_price = 0;
    total_price = parseInt(Math.round(net_price)) + parseInt(Math.round(charges));
    if (!isNaN(total_price))
    {
        $('#Purchase_requisition_two [name=total_price]').val(Math.round(total_price));
        $(id + " input[name = 'total_price']").val(Math.round(total_price));
    }
    header_calculate();
}
$(function () {
    $('[name=order_qty],[name="cost_unit"]').on('change', function () {
        if (!isNaN($(this).val()))
        {
            if (parseInt($(this).val()) < 0)
            {
                $(this).val(-parseInt($(this).val()));
            }
        }
    });
    $('[name=discount]').keyup(function (evt) {
        if ($(this).val() > 100) {
            $('#myModal').modal('show');
            $(this).val('100');
            calculate(evt);
        }
    });
    
    //get Material Description based on material no
    $('#material').change(function () {
        var id = $('.material').val();
        if (id != '') {
            $.ajax({
                type: 'GET', url: '/admin/getMaterialDesc/' + id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $("#purchase_item_0 input[name = 'material_description']").prop('readonly', true);
                    $("#purchase_item_0 input[name = 'material_description']").val(response.data.material_description);
                }
            });
        }
    });

    //get customer name based customer id
    $('#customer').change(function () {
        var id = $('.customer').val();
        if (id != '') {
            $.ajax({
                type: 'GET', url: '/admin/getCustomerName/' + id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $("input[name = 'customer_name']").val(response.data.name);
                }
            });
        }
    });
    //Calculate pricing
    $('.totalamt').change(function (evt) {
        calculate(evt);
    });
    $('#discount').change(function (evt) {
        setTimeout(function () {
            if ($("#discount").val() == '' || $("#discount").val() == undefined || $("#discount").val() == 'undefined') {
                $("#discount").val(0);
                $("input[name = 'discount_amt']").val('');
                $("input[name = 'discount_gross_price']").val('');
                $("input[name = 'sales_tax']").val('');
                $("input[name = 'sales_taxamt']").val('');
                $("input[name = 'net_price']").val('');
                $("input[name = 'freight_charges']").val('');
                $("input[name = 'total_price']").val('');
                $("input[name = 'inquiry_discount']").val('');
                $("input[name = 'inquiry_discount_amt']").val('');
                $("input[name = 'inquiry_discount_gross_price']").val('');
                $("input[name = 'inquiry_sales_taxamt']").val('');
                $("input[name = 'inquiry_net_price']").val('');
                $("input[name = 'inquiry_freight_charges']").val('');
                $("input[name = 'inquiry_total_price']").val('');
                calculate(evt);
            }
            console.log('discount', $("#discount").val());
        }, 400);
    });
    $('#sales_tax').keydown(function (evt) {
        setTimeout(function () {
            if ($("#sales_tax").val() == '' || $("#sales_tax").val() == undefined || $("#sales_tax").val() == 'undefined') {
                $("input[name = 'sales_taxamt']").val('');
                $("input[name = 'net_price']").val('');
                $("input[name = 'freight_charges']").val('');
                $("input[name = 'total_price']").val('');
                $("input[name = 'inquiry_sales_taxamt']").val('');
                $("input[name = 'inquiry_net_price']").val('');
                $("input[name = 'inquiry_freight_charges']").val('');
                $("input[name = 'inquiry_total_price']").val('');
            }
            console.log('sales_tax', $("#sales_tax").val());
        }, 400);
    });
});

