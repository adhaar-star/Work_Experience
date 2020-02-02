$(function () {     
    $("#Actaxform").validate({
        errorElement: 'p',
        rules: {
            glaccount_tax :{
                required:true,
                digits:true
            }            

        },
        messages: {
            glaccount_tax:{
             required: "Please enter gl account tax number type",
             
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
