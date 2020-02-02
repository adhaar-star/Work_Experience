$(function () {     
    $("#AcPaymentform").validate({
        errorElement: 'p',
        rules: {
            glaccount_payment :{
                required:true,
                digits:true
            }            

        },
        messages: {
            glaccount_payment:{
             required: "Please enter gl account down payment number type",
             
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
