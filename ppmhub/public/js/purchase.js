$(function () {
    $("#Purchaseform").validate({
        errorElement: 'p',
        rules: {
           
             'purchase_requistion' : "required"
              
        },
        messages: {
            
            'purchase_requistion' : "Please select purchase requisition"
         
           
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

