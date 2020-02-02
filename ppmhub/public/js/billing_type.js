$(function () {
    $("#billingform").validate({
        errorElement: 'p',
        rules: {
            'name': "required",
        },
        messages: {
            'name': "Please enter billing name",
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

