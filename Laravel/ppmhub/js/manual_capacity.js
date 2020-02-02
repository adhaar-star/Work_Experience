$(function () {
    $("#ManualCapacityForm").validate({
        errorElement: 'p',
        rules: {
            'portfolio': "required",
            'bucket': "required",
            hours_day: {
                required: true,
                digits: true,
            },
            'start_date': "required",
            'end_date': "required",
            'planning_unit': "required",
        },
        messages: {
            'portfolio': "Please select portfolio",
            'bucket': "Please select bucket",
            'hours_day': {
                required: "Please enter hours/day",
                digits: "Please enter in digits"
            },
            'start_date': "Please select start date",
            'end_date': "Please select end date",
            'planning_unit': "Please select planning unit",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            if (element.hasClass("select2-hidden-accessible"))
            {
                error.insertAfter(element.next('span.select2'));
            }
            else if (element.hasClass("start")) {
                $("#start").append(error);
            } else if (element.hasClass("end")) {
                $("#end").append(error);
            } else
            {
                error.insertAfter(element);
                console.log(element);
                $('.inputRequired').each(function (i, ele) {
                    if (ele.value == '' || ele.value == null)
                    {
                        $(ele).css("border", "#a94442 solid 1px");
                    }
                    else
                    {
                        $(ele).css("border", "#46be8a solid 1px");
                    }
                });

                $('select').each(function (i, ele) {
                    if (ele.value == '' || ele.value == null)
                    {
                        $(ele.nextSibling).css("border", "#a94442 solid 1px");
                    }
                    else
                    {
                        $(ele.nextSibling).css("border", "#46be8a solid 1px");
                    }
                });

                $('.defaultgreen').each(function (i, ele) {
                    if (ele.value == '' || ele.value == null)
                    {
                        $(ele.nextSibling).css("border", "#46be8a solid 1px");
                    }
                });
            }
            error.addClass('help-block');
        }
    });

    $('.inputRequired').on('dp.change', function (e) {
        if (this.value == '' || this.value == null)
        {
            $(this).css("border", "#a94442 solid 1px");
        }
        else
        {
            $(this).css("border", "#46be8a solid 1px");
        }
    });
    $('.inputRequired').on('change', function () {
        console.log(this);
        $('.inputRequired').each(function (i, ele) {
            if (ele.value == '' || ele.value == null)
            {
                $(ele).css("border", "#a94442 solid 1px");
            }
            else
            {
                $(ele).css("border", "#46be8a solid 1px");
            }
        });

    });
    $('.validRequired').on('change', function () {
        $('.validRequired').each(function (i, ele) {
            if (ele.value == '' || ele.value == null)
            {
                $(ele.nextSibling).css("border", "#a94442 solid 1px");
            }
            else
            {
                $(ele.nextSibling).css("border", "#46be8a solid 1px");
            }
        });
    });
    $('.defaultgreen').on('change', function () {
        $('.defaultgreen').each(function (i, ele) {
            if (ele.value != '' || ele.value != null)
            {
                $(ele.nextSibling).css("border", "#46be8a solid 1px");
            }
        });
    });

    $('#portfolio').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#bucket').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#category').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#group').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#view').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $('#planning_unit').select2({
    }).on('change', function () {
        $(this).valid();
    });
    $("#end_date").on("dp.change", function (e) {
        var period_from = $('[name=start_date]').val();
        var period_to = $('[name=end_date]').val();
        if (period_from > period_to)
        {
            $('#myModal').modal('show');
        }
    });
    //get bucket on selection of portfolioId
    $('#portfolio').change(function () {
        var id = $('#portfolio').val();
        if (id != '') {
            $.ajax({
                type: 'GET', url: '/admin/getBucket/' + id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    //set bucket 
                    $("#bucket").html('');
                    var bucketOptions = '<option value="">Please select bucket</option>';
                    if (response.data) {
                        $.each(response.data, function (bucketKey, bucketVal) {
                            bucketOptions += '<option value="' + bucketVal.id + '">' + bucketVal.bucket_name + '</option>';
                        });
                    }
                    $('#bucket').html(bucketOptions);
                }
            });
        }
    });
    //get category and group
    $('#bucket').change(function () {
        var id = $('#bucket').val();
        if (id != '') {
            $.ajax({
                type: 'GET', url: '/admin/getCategoryGroup/' + id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    //set category
                    $("#category").html('');
                    var categoryOptions = '<option value="">Please select category</option>';
                    if (response.category) {
                        $.each(response.category, function (categortKey, categoryVal) {
                            categoryOptions += '<option value="' + categoryVal.role_fun + '">' + categoryVal.role_fun + '</option>';
                        });
                    }
                    $('#category').html(categoryOptions);
                    //set group
                    $("#group").html('');
                    var groupOptions = '<option value="">Please select group</option>';
                    if (response.group) {
                        $.each(response.group, function (groupKey, groupVal) {
                            groupOptions += '<option value="' + groupVal.role_name + '">' + groupVal.role_name + '</option>';
                        });
                    }
                    $('#group').html(groupOptions);
                }
            });
        }
    });
});

