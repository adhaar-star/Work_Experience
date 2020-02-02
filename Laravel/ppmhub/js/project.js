$(function () {
    $("#projectstypeform").validate({
        errorElement: 'p',
        rules: {
            'project_desc': {
                required: true,
                minlength: 3,
                maxlength: 191
            },
            'portfolio_id': 'required',
            'project_name': 'required',
            'start_date': "required",
            'end_date': "required",
            'a_start_date': "required",
            'a_end_date': "required",
            'f_start_date': "required",
            'f_end_date': "required",
            'p_start_date': "required",
            'p_end_date': "required",
            'sch_date': "required",
            'project_type': "required",
            'bucket_id': "required",
            'estimated_cost' : "required",
            'location_id' : "required",
            'cost_centre' : "required",
            'department' : "required",
        },
        messages: {
            'project_desc': {
                required: "Please enter  project description",
                minlength: 'project description must be more than 3 character',
                maxlength: 'project description must be less than 191 character'
            },
            'portfolio_id': 'Please select portfolio',
            'project_name': 'Please enter project name',
            'start_date': "Please select start date",
            'end_date': "Please select end date",
            'a_start_date': "Please select actual start date",
            'a_end_date': "Please select actual end date",
            'f_start_date': "Please select forecast start date",
            'f_end_date': "Please select forecast end date",
            'p_start_date': "Please select planned start date",
            'p_end_date': "Please select planned finish date",
            'sch_date': "Please select schedule  date",
            'project_type': "Please select project type",
            'bucket_id': "Please select bucket id",
            'estimated_cost' : "Please enter estimated cost",
            'location_id' : "Please select project location",
            'cost_centre' : "Please select cost centre",
            'department' : "Please select department"
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {

            $('#emailError').html('');

            if (element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            } else if (element.hasClass("start")) {
                $("#start").append(error);

            } else if (element.hasClass("end")) {
                $("#end").append(error);

            }
            else if (element.hasClass("a_start")) {
                $("#a_start").append(error);

            }
            else if (element.hasClass("a_end")) {
                $("#a_end").append(error);

            }
            else if (element.hasClass("f_start")) {
                $("#f_start").append(error);

            }
            else if (element.hasClass("f_end")) {
                $("#f_end").append(error);

            }
            else if (element.hasClass("p_start")) {
                $("#p_start").append(error);

            }
            else if (element.hasClass("p_end")) {
                $("#p_end").append(error);

            }
            else if (element.hasClass("s_date")) {
                $("#s_date").append(error);

            }
            else if (element.hasClass("sche_date")) {
                $("#sche_date").append(error);
            }
            else
            {
                error.insertAfter(element);
            }

            error.addClass('text-danger');
        }
    });
    $('#port_id').change(function () {
        var id = $("#port_id").val();
        if (id != '') {
            $.ajax({
                type: 'GET', 
                url: '/admin/getportfolioType/' + id,
                dataType: "json",
                success: function (response) {
                    $("[name=portfolio_type]").val(response.name); 
                }
            });
        }
    });
});




