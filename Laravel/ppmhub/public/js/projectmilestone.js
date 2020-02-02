$(function () {
    $("#projectmilestoneform").validate({
        errorElement: 'p',
        rules: {
           
            'milestone_name':"required",               
              'project_id' : "required",
              'phase_id' : "required",
            
        },
        messages: {
            
            'milestone_name' : "Please enter milestone name",
             'project_id' : "Please enter project id",
             'phase_id' : "Please enter phase id",
            
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            
              $('#emailError').html('');
            
            if(element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            }else
            {
              error.insertAfter(element);
            }  
           
            error.addClass('text-danger');
        }
    });

});

