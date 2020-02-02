$(function () {
    $("#companyform").validate({
        //errorElement: 'p',
        rules: {
            "company_name": "required" ,                
            "address": "required",
            "country":  "required",
            "state":  "required",
                
        },
        messages: {            
            "company_name" : "Please enter company name",                  
            "address": "Please enter company address",
            "country": "Please select the country",
            "state": "Please select the state"
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            $('#emailError').html('');
           if (element.hasClass("select2-hidden-accessible")) {
                error.insertAfter(element.next('span.select2'));
           }else {
                error.insertAfter(element);
            }
            error.addClass('text-danger');
        }
    });

});

$(document).ready(function(){
    $(document).on('change','#country',function(){
        var id = $(this).val();        
        $.ajax({
            type: "GET",
            url: "api/getstate/"+id,
            success: function (response) {
                $("#state").html('');
                var stateOptions = '<option value="" disabled selected>Please select state</option>';
                if (response.status) {
                    for (x in response.results) {
                        stateOptions += '<option value="' + x + '">' + response.results[x] + '</option>';
                    }
                }
                $('#state').html(stateOptions);
            }
        });
    });
});
