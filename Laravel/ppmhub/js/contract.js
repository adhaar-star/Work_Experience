$(function () {     
    $("#Purchase_requisition_two").validate({
        errorElement: 'p',
        rules: {
            sales_contact :{
                required:true,
                digits:true
            }            

        },
        messages: {
            sales_contact:{
             required: "Please enter contact number type",
             
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
