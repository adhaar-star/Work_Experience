$(function () {
    $("#salesorgform").validate({
        errorElement: 'p',
        rules: {
            'sales_organization': "required"
        },
        messages: {
            'sales_organization': "Please enter sales organization"
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });

    $("#reasonform").validate({
        errorElement: 'p',
        rules: {
            'reason_rejection': "required"
        },
        messages: {
            'reason_rejection': "Please enter reason for rejection"
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });

});

