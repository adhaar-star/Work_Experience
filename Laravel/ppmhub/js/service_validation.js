$(function () {
    $("#Serviceform").validate({
        errorElement: 'p',
        rules: {
            'service_name': "required",
            'service_category': "required",
            'service_group': "required",
            'unit_of_measure': "required",
            'ordering_unit': "required",
            'currency': "required"

        },
        messages: {
            'service_name': "Please enter service name",
            'service_category': "Please select service category",
            'service_group': "Please select service group ",
            'unit_of_measure': "Please select unit of measure",
            'ordering_unit': "Please select ordering unit ",
            'currency': "Please select currency"
        },
        submitHandler: function (form) {
            form.submit();
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

});

