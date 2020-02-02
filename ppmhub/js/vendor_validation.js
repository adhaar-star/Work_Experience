$(function () {
    $("#Vendorform").validate({        
        errorElement: 'p',         
        rules: { 
            'name': "required",
            'vendor_id': "required" ,
            'fax' : 
                    {
                        required:true,
                      
                    },
            'street' : "required",
            'city' : "required",
            'postal_code' : "required",
            'country' : "required",
            'office_phone' : 
                    {
                        required:true,
                        
                    },
            
            website_address : {
                url:true,
                required:true,
            },
            email: {
                required: true,
                email: true,
               
            }   
        },
        messages: {
            'name': "Please enter vendor name",
            'vendor_id': "Please enter vendor id" ,
            'fax' : "Please enter fax number",
            'street' : "Please enter street",
            'city' : "Please enter city",
            'postal_code' : "Please select postal code",
            'country' : "Please select country",
            'office_phone' : "Please enter office phone",
           
            
            website_address : {
                url:"Please enter URL" ,
                required:"Please enter Website Address",
            },
            email: {
                required: "Please enter email.",
                email: "Please enter valid email.",
               
            }
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

