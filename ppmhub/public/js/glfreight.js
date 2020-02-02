$(function () {     
    $("#AcFreightform").validate({
        errorElement: 'p',
        rules: {
            glaccount_freight :{
                required:true,
                digits:true,
                unique:true
            }            

        },
        messages: {
            glaccount_freight:{
             required: "Please enter gl account freight number type",
             
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
