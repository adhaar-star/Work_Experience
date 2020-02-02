$(function () {
    $("#Categoryform").validate({
        errorElement: 'p',
        rules: {
            
            'materialcategory': "required",
           
          
            
        },
        messages: {
             
            'materialcategory': "Please enter MaterialCategory",
            
            
           
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });
    
    $("#Groupform").validate({
        errorElement: 'p',
        rules: {
            
           
            'materialgroup': "required",
          
            
        },
        messages: {
             
           
            'materialgroup':"Please enter MaterialGroup"
            
           
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });
    
     $("#Orderingform").validate({
        errorElement: 'p',
        rules: {
            
           
            'orderingunit': "required",
          
            
        },
        messages: {
             
           
            'orderingunit':"Please enter OrderingUnit"
            
           
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });
    
     $("#Unitform").validate({
        errorElement: 'p',
        rules: {
            
           
            'unitofmeasure': "required",
          
            
        },
        messages: {
             
           
            'unitofmeasure':"Please enter UnitOfMeasure"
            
           
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });
    
      
     $("#Bankform").validate({
        errorElement: 'p',
        rules: {
            
           
            'bank_name': "required",
          
            
        },
        messages: {
             
           
            'bank_name':"Please enter Bank name"
            
           
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

