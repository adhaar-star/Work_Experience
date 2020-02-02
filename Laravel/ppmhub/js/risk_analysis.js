$(function () {
    //Validation for Qualitative risk
    $("#qualitative_form").validate({
        errorElement: 'p',
        rules: {
            'project_id': "required",
            'qual_category': "required",
            'qual_risk_desc': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            'qual_likelihood': "required",
            'qual_consequence': "required",
            'qual_status': "required",
            'risk_mitigation_action': {
                required: true,
                maxlength: 250
            },
        },
        messages: {
            'project_id': "Please select project id",
            'qual_category': "Please select risk category",
            'qual_risk_desc': {
                required: "Please enter risk description"
            },
            'qual_likelihood': "Please select qualitative likelihood",
            'qual_consequence': "Please select qualitative consequence",
            'qual_status': "Please select status",
            'risk_mitigation_action': {
                required: "Please enter risk mitigation action",
                maxlength: "Allow only 250 characters"
            }
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

    //Validation for qualitative contextform
    $("#qualitativeContextform").validate({
        errorElement: 'p',
        rules: {
            'qual_risk_desc': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
        },
        messages: {
            'qual_risk_desc': {
                required: "Please enter risk description",
                minlength: "Please enter at least 3 characters.",
                maxlength: "Please enter no more than 100 characters."
            },
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });

    //Validation for quantitative contextform
    $("#quantitativeContextform").validate({
        errorElement: 'p',
        rules: {
            'quan_risk_desc': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
        },
        messages: {
            'quan_risk_desc': {
                required: "Please enter risk description",
                minlength: "Please enter at least 3 characters.",
                maxlength: "Please enter no more than 100 characters."
            },
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass('text-danger');
        }
    });

    //Validation for Quantitative risk
    $("#quantitative_form").validate({
        errorElement: 'p',
        rules: {
            'project_id': "required",
            'quan_category': "required",
            'quan_risk_desc': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            'quan_total_loss': {
                required: true,
                digits: true
            },
            'quan_currency': "required",
            'quan_probability':
                    {
                        required: true,
                        digits: true,
                        min: 1,
                        max: 99
                    },
            'status': "required",
            'risk_mitigation_action': {
                required: true,
                maxlength: 250
            },
        },
        messages: {
            'project_id': "Please select project id",
            'quan_category': "Please select risk category",
            'quan_risk_desc': {
                required: "Please enter risk description"
            },
            'quan_total_loss': {
                required: "Please enter total loss",
            },
            'quan_currency': "Please select currency",
            'quan_probability': {
                required: "Please enter probability between 0 to 100",
                minlength: "Please enter a value greater than or equal to 1.",
                maxlength: "Please enter a value less than or equal to 99."
            },
            'status': "Please select status",
            'risk_mitigation_action': {
                required: "Please enter risk mitigation action",
                maxlength: "Allow only 250 characters"
            }
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

//get project description based on project id
$(document).ready(function () {
    $('#projectid').change(function (e) {
        $('#pname', '#portfolioname', '#bucketname').html('');
        var id = $(this).val();
        $.ajax({
            url: '/admin/getprojectDescription/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (response)
            {
                $('#pname').html(response.data.project_desc);
                $('#portfolioname').html('PortfolioName : ' + response.data.portfolioname);
                $('#bucketname').html('BucketName : ' + response.data.bucketname);
            }
        });
    });

    $("#projectid").select2({
    }).on('change', function () {
        $(this).valid();
    });

    $("#qualCategory").select2({
    }).on('change', function () {
        $(this).valid();
    });

    $("#quanCategory").select2({
    }).on('change', function () {
        $(this).valid();
    });

    $("#currency").select2({
    }).on('change', function () {
        $(this).valid();
    });

    $("#qualImpact").select2({
    }).on('change', function () {
        $(this).valid();
    });

    $("#qualprobability").select2({
    }).on('change', function () {
        $(this).valid();
    });

    $("#status").select2({
    }).on('change', function () {
        $(this).valid();
    });

    //get risk score based on impact and probability
    function getriskScore()
    {
        var impact = $('#qualImpact').val();
        var probabiltiy = $('#qualprobability').val();

        $.ajax({
            url: '/admin/getRiskScore/' + impact + '/' + probabiltiy,
            type: 'GET',
            dataType: 'json',
            success: function (response)
            {
                $('#riskscore').val(Math.round(response.data.risk_value));
                $('#risk').html(response.data.risk_score);
            }
        });
    }
    $('#qualprobability').change(function (e) {
        getriskScore();
    });
    $('#qualImpact').change(function (e) {
        getriskScore();
    });
    $('.errorMessage').show(0).delay(5000).hide(2000);
});
