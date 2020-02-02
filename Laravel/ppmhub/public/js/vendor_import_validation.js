
$(document).ready(function(){
    $("form").validate({        
        errorElement: 'p',         
        rules: { 
            'import_file': "required",           
        },
        messages: {
            'import_file': "Please select file.",           
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {                      
            error.insertAfter(element);            
            error.addClass('text-danger');
        }
    });
   
});

