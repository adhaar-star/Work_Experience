$(function () {
    $("#Materialform").validate({
        errorElement: 'p',
        rules: {
            'material_name': "required",
            'material_description':
                    {
                        required: true,
                        minlength: 3,
                        maxlength: 191

                    },
            'material_category': "required",
            'material_group': "required",
            'supplier_name': "required",
            'unit_of_measure': "required",
            'ordering_unit': "required",
        },
        messages: {
            'material_name': "Please enter material name",
            'material_description': 
                    {
                required: "Please enter material description",
                minlength: 'material description must be more than 3 character',
                maxlength: 'material description must be less than 191 character'
                    },
            'material_category': "Please select material category",
            'material_group': "Please select material group",
            'supplier_name': "Please select supplier",
            'unit_of_measure': "Please select Unit of measure",
            'ordering_unit': "Please select Orderning unit",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {

            $('#emailError').html('');

            if (element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            } else
            {
                error.insertAfter(element);
            }

            error.addClass('text-danger');
        }
    });

});

