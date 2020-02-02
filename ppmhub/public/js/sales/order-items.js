$(document).ready(function() {
    $('.select2').select2();

    var delaySearch = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    var updateItemTotal = function () {
        var SO_Quantity = parseInt( $('.SO_Quantity').val() );
        var SO_UnitPrice = parseFloat( $('.SO_UnitPrice').val() );

        var SO_Freight = parseFloat(  $('.SO_Freight').val() );
        var SO_Discount = parseFloat(  $('.SO_Discount').val() );
        var SO_Tax = parseFloat( $('.SO_Tax').val() );
        var SO_ProfitMargin = parseFloat( $('.SO_ProfitMargin').val() );

        var SO_GrossAmount = SO_Quantity * SO_UnitPrice;
        var SO_DiscountAmount = SO_GrossAmount  * SO_Discount / 100;
        var SO_TaxAmount = SO_GrossAmount  * SO_Tax / 100;
        var SO_ProfitMarginAmount = SO_GrossAmount  * SO_ProfitMargin / 100;
        var SO_TotalAmount = SO_GrossAmount;

        if(SO_TotalAmount > 0 ){
            $('.SO_GrossAmount').html(SO_GrossAmount.toFixed(2));
            if(SO_Freight > 0 ){
                $('.SO_FreightAmount').html(SO_Freight.toFixed(2));
                SO_TotalAmount = SO_TotalAmount  +  SO_Freight;
            }
            if(SO_TaxAmount > 0 ){
                $('.SO_TaxAmount').html(SO_TaxAmount.toFixed(2));
                SO_TotalAmount = SO_TotalAmount  +  SO_TaxAmount;
            }
            if(SO_ProfitMarginAmount > 0 ){
                $('.SO_ProfitMarginAmount').html(SO_ProfitMarginAmount.toFixed(2));
                SO_TotalAmount = SO_TotalAmount  +  SO_ProfitMarginAmount;
            }

            if(SO_DiscountAmount > 0 ){
                $('.SO_DiscountAmount').html(SO_DiscountAmount.toFixed(2));
                SO_TotalAmount = SO_TotalAmount  -  SO_DiscountAmount;
            }

            $('.SO_TotalAmount').html(SO_TotalAmount.toFixed(2));
        }
    };

    $('.SO_ManageItems').on("keyup change", '.SO_item', function (e) {
        var qty = $(this).val();
        if (qty > 0) {
            delaySearch(function () {
                updateItemTotal();
            }, 400);
        }
        $(this).attr('data-last',qty);
    });

    $('.salesItemFormContentShowBtn').click(function () {
       $('.salesItemFormContent').slideToggle('slow');
    });

    
    $('.SoProjectOnChange').change( function () {
        var ProjectID = $(this).val();
        var URL = $(this).attr('data-url');
        $.ajax({
            type: "GET",
            cache: false,
            url: URL,
            data: { project_id : ProjectID },
            success: function(json){

                if(json.status == 'success'){

                    $('.projectTaskOnChangeProject').html('<option selected="selected" disabled="disabled" hidden="hidden" value="">Select Task</option>')
                    $('.projectPhaseOnChangeProject').html('<option selected="selected" disabled="disabled" hidden="hidden" value="">Select Phase</option>')
                    $.each( json.tasks, function( key, value ) {
                        $('.projectTaskOnChangeProject').append('<option value="'+key+'">'+ value+'</option>')
                    });
                    $.each( json.phase, function( key, value ) {
                        $('.projectPhaseOnChangeProject').append('<option value="'+key+'">'+ value+'</option>')
                    });

                } else if(json.status == 'false') {

                } else if(json.status == 'validation'){

                }
            },
            error : function(json){

            },
            dataType: "json"
        });
    });



    $('.SoMaterialOnChange').change( function () {
        var ID = $(this).val();
        var URL = $(this).attr('data-url');
        $.ajax({
            type: "GET",
            cache: false,
            url: URL,
            data: { id : ID },
            success: function(json){

                if(json.status == 'success'){

                    $('.SO_UnitPriceOnChangeMaterial').val(json.price);

                } else if(json.status == 'false') {

                } else if(json.status == 'validation'){

                }
            },
            error : function(json){

            },
            dataType: "json"
        });
    });



});