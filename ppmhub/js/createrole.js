$(function () {
    $("#Createroleform").validate({
        errorElement: 'p',
        rules: {
            'project_id': "required",
            'description':
                    {
                        required: true,
                        minlength: 3,
                        maxlength: 191

                    },
            'role_name':{
                required:true,
//                unique:true                
            },
            'role_type': "required",
            'role_fun': "required",
            'start_date' : "required",
            'end_date' : "required"
            
        },
        messages: {
            'project_id': "Please select project id",
            'description': 
                    {
                required: "Please enter role description",
                minlength: 'description must be more than 3 character',
                maxlength: 'description must be less than 191 character'
                    },
            'role_name':{
                'required' : "Please enter role name"
            },
            'role_type': "Please select role type",
            'role_fun': "Please select role function",
            'start_date':"Please select role start date",
            'end_date' : "Please select role end date"
            
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {

            $('#emailError').html('');

            if (element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            } 
            else if (element.hasClass("start")) {
                $("#start").append(error);

            } else if (element.hasClass("end")) {
                $("#end").append(error);

            }else
            {
                error.insertAfter(element);
            }

            error.addClass('text-danger');
        }
    });

});

