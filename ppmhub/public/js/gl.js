$(function () {     
    $("#Acform").validate({
        errorElement: 'p',
        rules: {
            gl_account_number :{
                required:true,
                digits:true
            }            

        },
        messages: {
            gl_account_number:{
                
             required: "Please enter gl account number type",
             
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {


            if (element.hasClass("select2-hidden-accessible")) {
                error.insertAfter(element.next('span.select2'));
            } else
            {
                error.insertAfter(element);
            }

            error.addClass('text-danger');
        }
        }
  
});
});
