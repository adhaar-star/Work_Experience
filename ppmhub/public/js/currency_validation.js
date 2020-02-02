$(function () {
    $("#currencies").validate({        
        errorElement: 'p',         
        rules: { 
            'short_code': "required",
            'fullname': "required" ,
            
        },
        messages: {
            'short_code': "Please enter currency",
            'fullname': "Please enter currency description" ,
            
           
            
            
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            $('#emailError').html('');
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });
   
});

