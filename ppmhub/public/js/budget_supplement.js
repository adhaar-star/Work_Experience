$(function () {
    $('#period_from').change(function () {
        $('#yearerror').hide();
        var period_from = $(this).val();
        var period_to = $('#period_to').val();
        if (period_to == null) {
            period_to = 0;
        }
        if (period_to != '' && period_to != null) {
            if (period_from > period_to) {
                $('#period').show();
                $('#period').html('Period From should not be greater than peroid to');
                $('#submit').prop('disabled', true);
            } else {
                $('#period').hide();
                $('#submit').prop('disabled', false);
            }
        }
    });
    $('#period_to').change(function () {
        $('#yearerror').hide();
        var period_to = $(this).val();
        var period_from = $('#period_from').val();
        if (period_from == null) {
            period_from = 0;
        }
        if (period_from != '' && period_from != null) {
            if (period_from > period_to) {
                $('#yearerror').show();
                $('#yearerror').html('Period To should not be less than period from');
                $('#submit').prop('disabled', true);
            } else {
                $('#period').hide();
                $('#yearerror').hide();
                $('#submit').prop('disabled', false);
            }
        }
    });

    $('#period_from').change(function () {
        var period_from = $(this).val();
        var period_to = $('#period_to').val();
        var diff = period_to - period_from + 1;
        if (period_to != '' && period_to != null) {
            if (diff > 5) {
                $('#fiveplus').show();
                $('#fiveplus').html('Duration between selected year should be maximum 5 year');
                $('#submit').prop('disabled', true);
            } else {
                $('#fiveplus').hide();
                $('#submit').prop('disabled', false);
            }
        }
    });
    $('#period_to').change(function () {
        var period_to = $(this).val();
        var period_from = $('#period_from').val();
        var diff = period_to - period_from + 1;
        if (period_from != '' && period_from != null) {
            if (diff > 5) {
                $('#fiveplus').show();
                $('#fiveplus').html('Please select 5 Year only.');
                $('#submit').prop('disabled', true);
            } else {
                $('#fiveplus').hide();
                $('#submit').prop('disabled', false);
            }
        }
    });
    jQuery.fn.getNum = function () {
        var val = $.trim($(this).val());
        if (val.indexOf(',') > -1) {
            val = val.replace(',', '.');
        }
        var num = parseFloat(val);
        var num = Math.round(num);
        if (isNaN(num)) {
            num = '';
        }
        return num;
    }

    $('#overall').blur(function () {
        $(this).val($(this).getNum());
    });

    $("#supplementform").validate({
        errorElement: 'p',
        rules: {
            'project_id': "required",
            'period_from': "required",
            'period_to': "required",
            'overall':
                    {
                        required: true

                    },
        },
        messages: {
            'project_id': "Please select project",
            'period_from': "Please select period from",
            'period_to': "Please select period to",
            'overall': "Please enter overall budget",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
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

    $('.select2').change(function () {
        if ($(this).val() != "")
        {
            $(this).valid();
        }
    });

    $('#ProjectListGet').change(function () {
        var project_id = $(this).val();
        $('#current_budget').val("0");
        $.ajax({
            url: "/admin/getcurrentbudget/" + project_id,
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data.original == '') {
                    var original = 0;
                } else {
                    var original = parseInt(data.original[0].overall);
                }
                if (data.supplement == '') {
                    var supplement = 0;
                } else {
                    var supplement = parseInt(data.supplement[0].overall);
                }
                if (data.return == '') {
                    var returnb = 0;
                } else {
                    var returnb = parseInt(data.return[0].overall);
                }
                var current = original + supplement - returnb;
                $('#current_budget').val(current);
            }
        })
    });

});

