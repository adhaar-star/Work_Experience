$(function () {
    
    $("textarea[maxlength]").on("propertychange input", function () {
        if (this.value.length > this.maxlength) {
            this.value = this.value.substring(0, this.maxlength);
        }
    });

    $("#Purchase_Requisition_form").validate({
        errorElement: 'p',
        rules: {
            'requisition_number': "required",
            'vendor': "required",
            'requesting_department': "required",
            'project_id': "required",
            'phase_id': "required",
            'task_id': "required",
            'purchase_requisition_category': "required",
            'purchase_requisition_type': "required"

        },
        messages: {
            'requisition_number': "Please enter requisition number",
            'vendor': "Please select vendor",
            'requesting_department': "Please select the requesting department",
            'project_id': "Please select project id",
            'phase_id': "Please select phase id",
            'task_id': "Please select task id",
            'purchase_requisition_category': "Please select requisition category",
            'purchase_requisition_type': "Please select requisition type    "
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
    });

});

