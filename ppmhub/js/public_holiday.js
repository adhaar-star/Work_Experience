$(function () {
    $("#publicHolidaysform").validate({
        errorElement: 'p',
        rules: {
            'date': "required",
            'name_holidays': "required",
            'weekend': "required",
            'country' :"required",
            'state' :"required",
        },
        messages: {
            'date': "Please select date",
            'name_holidays': "Please enter name of holiday",
            'weekend': "Please select weekend",
            'country': "Please select country",
            'state': "Please select state",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            if (element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            }
            else if (element.hasClass("date")) {
                $("#date").append(error);
            } else
            {
                error.insertAfter(element);
            }
            error.addClass('text-danger');
        }
    });

});

