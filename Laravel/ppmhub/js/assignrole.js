$(function () {
    $("#Assignroleform").validate({
        errorElement: 'p',
        rules: {
            'project_id': "required",
            'resource_name': "required",
            'role': "required",
            'role_type': "required",
            'role_fun': "required",
            'start_date': 'required',
            'end_date': 'required',
        },
        messages: {
            'project_id': "Please select project id",
            'resource_name': "Please select resource name",
            'role': "Please select role name",
            'role_type': "Please select role type",
            'role_fun': "Please select role function",
            'start_date': 'Please select start date',
            'end_date': 'Please select end date',
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {

            if (element.hasClass("select2"))
            {
                error.insertAfter(element.next('span.select2'));
            }
            else if (element.hasClass('datepicker-only-init'))
            {
                error.insertAfter(element.parent());

            }
            else
            {
                error.insertAfter(element);
            }

            error.addClass('text-danger');
        }
    });

});

