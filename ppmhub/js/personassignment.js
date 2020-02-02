$(function () {
    $("#Personassignmentform").validate({
        errorElement: 'p',
        rules: {
            'project_id': "required",
           
            'role':{
                required:true,
             
            },
            'task': "required",
            'resource_name': "required",
            'start_date': "required",
            'end_date': "required",
            
            
        },
        messages: {
            'project_id': "Please select project id",
           
            'role':{
                'required' : "Please select role name"
            },
            'task': "Please select task id",
            'resource_name': "Please select resource name",
            'start_date': "Please select start date",
            'end_date': "Please select end date",
            
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {

            $('#emailError').html('');
            if (element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            }else if(element.hasClass("start")){                
                $("#start").append(error);
            }else if(element.hasClass("end")){                
                $("#end").append(error);
            } else
            {
                error.insertAfter(element);
            }

            error.addClass('text-danger');
        }
    });

});

