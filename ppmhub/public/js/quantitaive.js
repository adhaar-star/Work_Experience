$(document).ready(function () {

    $('.expected_loss').blur(function () {

        var total_loss = $('input[name="quan_total_loss"]').val();
        var probability = $('input[name="quan_probability"]').val();

        var expected_loss = 0;
        expected_loss = Math.round((total_loss * probability) / 100);
        $("input[name = 'quan_expected_loss']").val(expected_loss);

        $.ajax({
            url: '/admin/getQuantitativeRiskScore/' + expected_loss,
            type: 'GET',
            dataType: 'json',
            success: function (response)
            {
                $('#quan_riskscore').val('');
                $('#risk_status').html('');
                if (response.status == 'msg')
                {
                    $('.message').show();
                    $('#msg').html(response.data);
                } else
                {
                    $('#quan_riskscore').val(response.data.risk_value);
                    $('#risk_status').html(response.data.risk_status);
                }
            }
        });
    });
});


