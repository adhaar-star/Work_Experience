$(function () {
    $("#working_days_form").validate({
        errorElement: 'p',
        rules: {
            'start_date': "required",
            'country': "required",
            'end_date': "required",
        },
        messages: {
            'start_date': "Please select start date",
            'country': "Please select country",
            'end_date': "Please select end date",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            if (element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            }
            else if (element.hasClass("start")) {
                $("#start").append(error);
            }else if (element.hasClass("end")) {
                $("#end").append(error);
            } 
            else
            {
                error.insertAfter(element);
            }
            error.addClass('text-danger');
        }
    });

});



