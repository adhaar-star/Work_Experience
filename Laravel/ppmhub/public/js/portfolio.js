$(function () {
    $("#Portfoliotypeform").validate({
        errorElement: 'p',
        rules: {
            'name': "required",
            'type': "required"
        },
        messages: {
            'name': "Please enter name",
            'type': "Please select portfolio type",
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {

            if (element.hasClass("select2-hidden-accessible")) {
                error.insertAfter(element.next('span.select2'));
            } else {
                error.insertAfter(element);
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

                $('.selectRequired').each(function (i, ele) {
                    if (ele.value == '' || ele.value == null)
                    {
                        $(ele.nextSibling).css("border", "#a94442 solid 1px");
                    }
                    else
                    {
                        if (ele.tagName == 'SELECT')
                            $(ele.nextSibling).css("border", "#46be8a solid 1px");
                        else
                            $(ele).css("border", "#46be8a solid 1px");
                    }
                });

                $('.defaultgreen').each(function (i, ele) {
                    if (ele.tagName == 'SELECT')
                        $(ele.nextSibling).css("border", "#46be8a solid 1px");
                    else
                        $(ele).css("border", "#46be8a solid 1px");
                });

            }
            error.addClass('help-block');
        }
    });

    $('.defaultgreen').on('change', function () {
        if (this.tagName == 'SELECT')
            $(this.nextSibling).css("border", "#46be8a solid 1px");
        else
            $(this).css("border", "#46be8a solid 1px");
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
    $('.selectRequired').on('change', function () {
        $('.selectRequired').each(function (i, ele) {
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

    $('#portfolio_type').select2({
    }).on('change', function () {
        $(this).valid();
    });
});

