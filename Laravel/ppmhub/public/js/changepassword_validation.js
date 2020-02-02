$(function () {
    $("#changepassword").validate({
        //errorElement: 'p',
        rules: {
            password: {
                required: true,
                minlength: 6,
                maxlength: 16,
            },
            confirm_password: {
                required: true,                
                minlength: 6,
                maxlength: 16,
                equalTo : "#password"
            }
        },
        messages: {            
            password: {
                required: "Please enter password",  
                minlength: "Please enter minimum 6 characters",
                maxlength: "Please enter maximum 16 characters only"
            },
            confirm_password: {
                required: "Please enter confirm password",                
                minlength: "Please enter minimum 6 characters",
                maxlength: "Please enter maximum 16 characters only",
                equalTo: "Password does not match the confirm password"
            }
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

