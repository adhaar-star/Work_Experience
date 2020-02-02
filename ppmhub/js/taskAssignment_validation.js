/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    $("#taskform").validate({
        errorElement: 'p',
        rules: {
            'project_id': "required",
            'task': "required",
            'role': "required",
            'start_date': "required",
            'end_date': "required",
        },
        messages: {
            'project_id': "Please select Project",
            'task': "Please select Task",
            'role': "Please select Role",
            'start_date': "Please select Start Date",
            'end_date': "Please select End Date",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            
            if (element.hasClass("select2"))
            {
                error.insertAfter(element.next('span.select2'));
            } 
            else if (element.hasClass('datepicker-only-init'))
            {
                  error.insertAfter(element.parent());
            
            }
            else
            {
                error.insertAfter(element);
            }

            error.addClass('text-danger');
        }
    });

});

