$(function () {
    $("#CustomerMasterform").validate({
        errorElement: 'p',
        rules: {
            'name': "required",
            'customer_id': "required",
            'fax': "required",
            'street': "required",
            'city': "required",
            'postal_code': "required",
            'country': "required",
            //'office_phone': "required",
            office_phone: {
                required: true,
                digits: true,
            },
            contact_phone: {                                
                digits: true,
            },
            website_address: {
                url: true,
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            contact_email :{
                required: true,
                email: true,
            },
            'state': "required",
            
        },
        messages: {
            'name': "Please enter customer name",
            'customer_id': "Please enter customer id",
            'fax': "Please enter fax number",
            'street': "Please enter street",
            'city': "Please enter city",
            'postal_code': "Please select postal code",
            'country': "Please select country",
            //'office_phone': "Please enter office phone",
            office_phone: {
                required: "Please enter office phone",
                digits: "Please enter only numbers",
            },
            contact_phone: {                
                digits: "Please enter only numbers",
            },
            website_address: {
                url: "Please enter URL",
                required: "Please enter Website Address",
            },
            email: {
                required: "Please enter email.",
                email: "Please enter valid email.",
            },
            contact_email: {
                required: "Please enter contact email.",
                email: "Please enter valid email.",
            },            
            'state': "Please select state",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            $('#emailError').html('');
           if (element.hasClass("select2-hidden-accessible")) {
                error.insertAfter(element.next('span.select2'));
           }else {
                error.insertAfter(element);
            }
            error.addClass('text-danger');
        }
    });

});

