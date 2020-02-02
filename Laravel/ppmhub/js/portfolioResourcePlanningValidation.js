$(function () {        
    $("#portfolioResourcePlanning").validate({        
        errorElement: 'p',         
        rules: { 
            'portfolio_id' : "required",
            'bucket' : "required",
            'planning_type' : "required",
            'costing_type' : "required",
            'collection_type' : "required",
            'view_type' : "required",
            'planning_start' : "required",
            'planning_end' : "required",
            'total_period' : "required", 
            'distribute' : "required", 
            'planning_unit' : "required",                      
        },
        messages: {
            portfolio_id: "Please select portfolio",
            bucket: "Please select bucket",
            planning_type: "Please select planning type",
            costing_type: "Please select costing type",
            collection_type: "Please select collection type",
            view_type: "Please select view type",
            planning_start: "Please select start date",
            planning_end: "Please select end date", 
            total_period: "Please enter total", 
            distribute: "Please enter distribute", 
            planning_unit: "Please enter planning unit",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
          //  $('#emailError').html('');
              
            if(element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            }else if(element.hasClass("start")){                
                $("#start").append(error);
            }else if(element.hasClass("end")){                
                $("#end").append(error);
            } else
            {
              error.insertAfter(element);
            }                  
            
            error.addClass('text-danger');
        }
    });
   
});

