$(function () {
    $("#employee").validate({
        errorElement: 'p',
        rules: {
            'employee_personnel_number' : "required",
            'employee_first_name': "required",
            'employee_middle_name': "required",
            'employee_last_name': "required",
             email: {
                required: true,
                email: true,
               
                },  
//            'employee_dob': "required",
            'employee_type': "required",
            'employee_cost_centre': "required",
            'employee_activity_type': "required",
         //   'employee_timesheet_profile' : "required",
            'employee_birth_country' : "required"
          
        },
        messages: {
            'employee_personnel_number':"Please enter personnel number",
           'employee_first_name': "Please enter first name",
            'employee_middle_name': "Please enter middle name",
            'employee_last_name': "Please enter last name",
             email: {
                required: "Please enter email.",
                email: "Please enter valid email.",
               
            },
//            'employee_dob': "Please select date of birth",
            'employee_type': "Please select employee type",
            'employee_cost_centre': "Please select cost center",
            'employee_activity_type': "Please select activity type",
         //   'employee_timesheet_profile' : "Please select timesheet profile",
            'employee_birth_country' : "Please select birth country"
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

