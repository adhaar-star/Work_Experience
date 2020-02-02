$(function () {
    jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
}, "Letters only please"); 
    $("#Userform").validate({
        errorElement: 'p',
        rules: {
            'name': {
                required: true,
                lettersonly : true
            },
             'lname': {
                required: true,
                lettersonly : true
            },
            'phone':{
              required:true,
              digits:true,
            },
            'role_id': "required",
            email: {
                required: true,
                email: true,
                
            }
        },
        messages: {
            'name': {
                required : "Please enter first name",
                lettersonly : "Please enter only letters"
            },
            'lname': {
                required : "Please enter last name",
                lettersonly : "Please enter only letters"
            },
            'phone': {
              required:"Please enter phone",
              digits: 'Please Enter Valid Phone Number'

            },
            'role_id': "Please select role",
            email: {
                required: "Please enter email",
                email: "Please enter valid email",
            }
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
$("#role_id").select2({
        }).on('change', function () {
            $(this).valid();
        });
});

