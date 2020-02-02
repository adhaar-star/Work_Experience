$(function () {
    $("#location").validate({
        errorElement: 'p',
        rules: {
            'subrub': "required",
            'state': "required",
            postcode: {
                required: true,
                digits: true,
            },
            'latitude': "required",
            'longitude': "required"
        },
        messages: {
            'subrub': "Please enter city",
            'state': "Please enter state",
            'postcode': {
                required: "Please enter postcode",
                digits: "Please enter postcode in digits"
            },
            'latitude': "Please enter latitude",
            'longitude': "Please enter longitude"
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

